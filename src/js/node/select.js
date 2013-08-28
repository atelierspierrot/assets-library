/*
# ***** BEGIN LICENSE BLOCK *****
# This file is part of the PiWi Framework, an apen source PHP/JavaScript library by Les Ateliers Pierrot
# Copyright (c) 2010 Pierre Cassat and contributors
#
# <http://www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>
#
# PiWi Library is a free software; you can redistribute it and/or modify it under the terms 
# of the GNU General Public License as published by the Free Software Foundation; either version 
# 3 of the License, or (at your option) any later version.
#
# PiWi Library is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; 
# without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License along with this program; 
# if not, write to the :
#     Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
# or see the page :
#    <http://www.opensource.org/licenses/gpl-3.0.html>
#
# Ce programme est un logiciel libre distribué sous licence GNU/GPL.
#
# ***** END LICENSE BLOCK ***** */

/**
 * Get one or more DOM objects calling them with CSS selectors
 * @param str what A selection string written as CSS selectors
 * @return The result can be a single element or a classic Array of elements
 */
function Select( what ) {

    /** 
     * The real work is here
     * @return This function will always return an array (even empty)
     */
    function get(_dom, _type, _str) {
        var _meth_child = 'getBy'+capitaliseFirstLetter(_type),
            _meth_self = 'has'+capitaliseFirstLetter(_type);
        if (eval("typeof "+_meth_child) !== 'function') {
            throw new Error('Method "'+_meth_child+'" not found!');
        }
        if (eval("typeof "+_meth_self) !== 'function') {
            var _old_methself = _meth_self;
            _meth_self = 'is'+capitaliseFirstLetter(_type);
            if (eval("typeof "+_meth_self) !== 'function') {
                throw new Error('Method "'+_meth_self+'" or method "'+_old_methself+'" not found!');
            }
        }
        
        if (!isArray(_dom)) { _dom = [ _dom ]; }

        var len = _dom.length, _res = [];
        for(var i=0; i<len; i++) {
            var _node = _dom[i], _new_result, _done=false;

            // filter children
            if (isElement(_node)) {
                _new_result = eval(_meth_child+"(_node, _str)");
            }
            else if (isArray(_node)) {
                _new_result = get(_node, _type, _str);
            }
            if (!isEmpty(_new_result)) {
                _res.push(_new_result);
                _done=true;
            }

            // filter node itself
            if (!_done) {
                if (isElement(_node)) {
                    _new_result = eval(_meth_self+"(_node, _str)");
                    if (_new_result) {
                        _res.push(_node);
                    }
                }
            }

        }
        return _res;
    };

// TESTS

    function isElement(_dom) {
        return (_dom.nodeType && _dom.nodeType>0);
    };

    function isArray(_dom) {
/*
        if (typeof Array.isArray==='function') {
            return Array.isArray(_dom);
        }
*/
        return (!isString(_dom) && !isElement(_dom) && _dom.length!==null);
    };

    function isString(_dom) {
        return (typeof _dom==='string');
    };

    function isEmpty(_dom) {
        if (isElement(_dom)) {
            return false;
        }
        else if (isArray(_dom)) {
            return _dom.length===0;
        }
        else if (isString(_dom)) {
            return _dom==="";
        }
        return false;
    };

// ELEMENTS FILTERS

    function getById(_dom, str){
        return _dom.getElementById( str ) || null;
    };

    function getByClass(_dom, str){
        return _dom.getElementsByClassName( str ) || null;
    };

    function getByTag(_dom, str){
        return _dom.getElementsByTagName( str ) || null;
    };

    function hasId(_dom, str){
        return (_dom.getAttribute('id') && _dom.getAttribute('id')===str);
    };

    function hasClass(_dom, str){
        return hasClassName(_dom, str);
    };

    function isTag(_dom, str){
        return (_dom.tagName && _dom.tagName===str);
    };

// UTILS
    
    function capitaliseFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    };

    function hasClassName(domobj, clsname) {
        var classes = getClasses(domobj), len = classes.length;
        if (len>0) {
            for (var i=0; i<len; i++) {
                if (classes[i] === clsname) return true;
            }
        }
        return false;
    };

    function getClasses(domobj) {
        if (domobj === undefined || domobj === null) {
            return [];
        }
        var _classes = domobj.className;
        if (_classes !== undefined && _classes !== null) {
            return _classes.split(" ");
        }
        return [];
    };

    function getSecuredArray(_obj) {
        if (!isArray(_obj)) {
            return [ _obj ];
        }
        if (_obj instanceof HTMLCollection) {
            return Array.prototype.slice.call( _obj );
        }
        return _obj;
    };

// OBJECT

    var _selectors = what.split(' '),
        _result = window.document,
        _mustReturnArray = true;
    for (var i=0, len=_selectors.length; i<len; i++) {
        var _sel = _selectors[i],
            _firstletter = _sel.charAt(0);

        // # : ID
        if (_firstletter==='#') {
//console.debug('searching by ID ', _sel.slice(1), ' in _dom ', _result);
            var tmp_result = get( _result, 'id', _sel.slice(1) );
            if (tmp_result!=null) {
                _result = tmp_result.length===1 ? tmp_result[0] : tmp_result;
                _mustReturnArray = false;
            }
        }    

        // . : class
        else if (_firstletter==='.') {
//console.debug('searching by class ', _sel.slice(1), ' in _dom ', _result);
            var tmp_result = get( _result, 'class', _sel.slice(1) );
            if (tmp_result!=null) {
                _result = tmp_result.length===1 ? tmp_result[0] : tmp_result;
                _mustReturnArray = true;
            }
        }    

        // else : tag
        else {
//console.debug('searching by tag ', _sel, ' in _dom ', _result);
            var tmp_result = get( _result, 'tag', _sel );
            if (tmp_result!=null) {
                _result = tmp_result.length===1 ? tmp_result[0] : tmp_result;
                _mustReturnArray = true;
            }
        }    
    }
    
    return (_mustReturnArray===true || isArray(_result) ? getSecuredArray(_result) : _result);
}

// Endfile