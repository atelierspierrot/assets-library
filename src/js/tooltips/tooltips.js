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
 * Build some tooltips on element with a specific class with the content of an element's attribute
 *
 * Internal private variables are prefixed by '_tltp'
 */
function TOOLTIP() {

	var self = {},                          // the whole object properties
    	_ie = document.all ? true : false,  // are we in IE ?
        _tltp_id_attribute = 'tltpid',      // the ID attribute added to any tooltip element
        _tltp_wrapper_class = 'tooltip-wrapper-block',     // the ID attribute added to any tooltip element
        _tltp_content_class = 'tooltip-content-block',     // the ID attribute added to any tooltip element
        _tltp_wrapper,                      // the tooltip DOM wrapper
        _tltp_content,                      // the tooltip DOM content
	    _tltp_cache,                        // the tooltip cache
	    _tltp_currentel,                    // the current visible tooltip element
	    registry;                           // the instances registry

// ------------------
// Private methods
// ------------------

// INIT

    // initialization of the tooltips objects	
    function domInit() {
        if (typeof window['_dbg_info'] == 'function')
            _dbg_info('entering domInit searching elements with class '+self._classname);
        var tooltipList = document.getElementsByClassName(self._classname);
        if (tooltipList) {
            for (var i=0, len=tooltipList.length; i<len; i++) {
                setInstance( tooltipList[i] );
                tooltipList[i].onmouseover 	= function() { show(this); };
                tooltipList[i].onmouseout 	= function() { hide(this); };
            }
        }
    };

    // all default properties
    function newInstance() {
        self._tltp_id           = null;
        self._classname 		= 'tooltip';
        self._attribute		    = 'title';
        self._content_class_attribute = null;
        self._wrapper_class 	= 'tooltip_wrapper';
        self._content_class	    = 'tooltip_content';
        self._wrapper_id_prefix = 'tooltip';
        self._content_id_prefix = 'tooltip_content';
        self._topleft_class 	= 'tooltip_tl';
        self._topright_class 	= 'tooltip_tr';
        self._bottomleft_class 	= 'tooltip_bl';
        self._bottomright_class = 'tooltip_br';
        self._top_class 	    = 'tooltip_t';
        self._bottom_class      = 'tooltip_b';
        self._left_class 	    = 'tooltip_l';
        self._right_class 	    = 'tooltip_r';
        self._tooltip_mask	    = null;
		self._fixed             = false
        self._auto_pos		    = true;
        self._top 		        = 3;
        self._left 		        = 3;
        self._bottom 		    = 6;
        self._right 		    = 6;
        self._max_width 		= 300;
        self._speed 		    = 10;
        self._timer 		    = 20;
        self._alpha 		    = 0;
        self._end_alpha 		= 95;
	};

// Registry

	// set an element instance
    function setInstance(el) {
	    if (registry===undefined || registry===null) {
	        registry = Registry();
	    }
	    if (self._tltp_id===null) {
    	    self._tltp_id = registry.add( self );
    	}
        el.setAttribute( _tltp_id_attribute, self._tltp_id );
    };

    // get an element instance
    function getInstance(el) {
        var _tid = el.getAttribute( _tltp_id_attribute );
        return registry.get( _tid );
    };

    // get the current element instance
    function getCurrentInstance() {
	    if (_tltp_currentel===null) return null;
        var _tid = _tltp_currentel.getAttribute( _tltp_id_attribute );
        return registry.get( _tid );
    };

// Tooltips

	// creation of the tooltip wrapper and append it to document
	function initTooltip(el) {
	    var _self = getInstance(el);
		if (_tltp_wrapper===undefined || _tltp_wrapper===null)
		{
            // the wrapper
			_tltp_wrapper = document.createElement('div');
			_tltp_wrapper.setAttribute('id',self._wrapper_id_prefix+'_'+self._tltp_id);
			addClassName(_tltp_wrapper, _tltp_wrapper_class);
			addClassName(_tltp_wrapper, self._wrapper_class);
            // the content
			_tltp_content = document.createElement('div');
			_tltp_content.setAttribute('id',self._content_id_prefix+'_'+self._tltp_id);
			addClassName(_tltp_content, _tltp_content_class);
			addClassName(_tltp_content, self._content_class);
            if (_self._tooltip_mask!==undefined && _self._tooltip_mask!==null) {
				_patrn = new RegExp('\\$\\$content\\$\\$', 'ig');
	            var str = _self._tooltip_mask.replace(_patrn, _tltp_content);
                if (typeof window['_dbg_info'] == 'function')
                    _dbg_info(_tooltip_mask);
    			_tltp_wrapper.appendChild(str);
	        }
	        else {
    			_tltp_wrapper.appendChild(_tltp_content);
    		}
			document.body.appendChild(_tltp_wrapper);
			_tltp_wrapper.style.opacity = 0;
			_tltp_wrapper.style.filter = 'alpha(opacity=0)';
		}
	};

	// update of the tooltip wrapper and show it
	function showTooltip(el) {
	    var _self = getInstance(el);
		_tltp_currentel = el;
		_tltp_cache = _tltp_currentel.getAttribute(_self._attribute);
		_tltp_currentel.setAttribute(_self._attribute, '');
		_tltp_content.innerHTML = _tltp_cache;
		_tltp_wrapper.style.display = 'block';
		_tltp_wrapper.style.width = 'auto';
		if (_ie) {
			_tltp_wrapper.style.width = _tltp_wrapper.offsetWidth;
		}
		if (_tltp_wrapper.offsetWidth > _self._max_width) {
			_tltp_wrapper.style.width = _self._max_width + 'px'
		}
		if (_self._content_class_attribute!==undefined && _self._content_class_attribute!==null) {
			var _cls = el.getAttribute(_self._content_class_attribute);
			if (_cls) {
				addClassName(_tltp_content, _cls);
			}
		}
		if (!_self._fixed) {
    		if (_ie){
                document.attachEvent('onMouseMove', mouseFollow);
            } else {
    		    document.addEventListener('mousemove', mouseFollow, false);
    		}
        } else {
            buildFixedPosition(el);
        }
		clearInterval(_tltp_wrapper.timer);
		_tltp_wrapper.timer = setInterval(function() { fade(1,el); },_self._timer);
	};

	// update of the tooltip wrapper and hide it
	function hideTooltip(el) {
	    var _self = getInstance(el);
		clearInterval(_tltp_wrapper.timer);
		_tltp_wrapper.timer = setInterval(function() { fade(-1,el); },_self._timer);
	};

    // clear the tooltip
	function clearTooltip(el) {
	    var _self = getInstance(el);
		_tltp_wrapper.style.display = 'none';
		clearInterval(_tltp_wrapper.timer);
		el.setAttribute(_self._attribute, _tltp_cache);
		if (_self._content_class_attribute!==undefined && _self._content_class_attribute!==null) {
			var _cls = el.getAttribute(_self._content_class_attribute);
			if (_cls) {
				removeClassName(_tltp_content, _cls);
			}
		}
		_tltp_currentel = null;
		if (!_self._fixed) {
    		if (_ie){
        		document.detachEvent('onMouseMove', mouseFollow);
		    } else {
    		    document.removeEventListener('mousemove', mouseFollow, false);
    		}
		}
	};

	// be sure the old tooltip is cleared before doing next one
	function stopPropagation() {
		if (_tltp_currentel!==undefined && _tltp_currentel!==null) {
			clearTooltip(_tltp_currentel);
		}
	};

// ------------------
// Events treatments
// ------------------

	// show a tooltip on element "el"
	var show = function(el) {
		initTooltip(el);
		stopPropagation();
	    showTooltip(el);
	},

	// hide tooltip on element "el" with fade
	hide = function(el) {
	    hideTooltip(el);
	},

// ------------------
// Utilities
// ------------------

	// position the tooltip in the center of the element
	buildFixedPosition = function(el) {
	    var _self = getCurrentInstance();
	    if (_self===null) return;
		var vattr=null, hattr=null, positions = { top: 'auto', bottom: 'auto', left: 'auto', right: 'auto' };
		if (hasClassName(_tltp_currentel, _self._bottom_class)) { hattr = 'bottom'; }
		else if (hasClassName(_tltp_currentel, _self._left_class)) { vattr = 'left'; }
		else if (hasClassName(_tltp_currentel, _self._right_class)) { vattr = 'right'; }
		else { hattr = 'top'; }

        element_positions = getOffset(el);

		// top or bottom or left or right ?
		var eh = parseInt(_tltp_wrapper.offsetHeight), 
		    ew = parseInt(_tltp_wrapper.offsetWidth),
		    elw = parseInt(element_positions.right-element_positions.left),
		    elh = parseInt(element_positions.bottom-element_positions.top);
		if (hattr==='bottom') { 
			positions.top = parseInt(element_positions.bottom + _self._bottom) + 'px';
    		positions.left = parseInt(element_positions.left + (elw / 2) - (ew / 2)) + 'px';
		}
		else if (vattr==='left') { 
    		positions.top = parseInt(element_positions.top + (elh / 2) - (eh / 2)) + 'px';
			positions.left = parseInt(element_positions.left - ew - _self._left) + 'px';
		}
		else if (vattr==='right') {
    		positions.top = parseInt(element_positions.top + (elh / 2) - (eh / 2)) + 'px';
			positions.left = parseInt(element_positions.right + _self._right) + 'px';
		}
		else {
			positions.top = parseInt(element_positions.top - _self._top - eh) + 'px';
    		positions.left = parseInt(element_positions.left + (elw / 2) - (ew / 2)) + 'px';
		}

		for (var pos in positions) {
			_tltp_wrapper.style[pos] = positions[pos];
		}
	},

	// follow mouse position according to the tooltip class, with automatic position if so
	mouseFollow = function(e) {
	    var _self = getCurrentInstance();
	    if (_self===null) return;
		var vattr=null, hattr=null, positions = { top: 'auto', bottom: 'auto', left: 'auto', right: 'auto' };
		if (hasClassName(_tltp_currentel, _self._bottomright_class)) { vattr = 'right'; hattr = 'bottom'; }
		else if (hasClassName(_tltp_currentel, _self._bottomleft_class)) { vattr = 'left'; hattr = 'bottom'; }
		else if (hasClassName(_tltp_currentel, _self._topright_class)) { vattr = 'right'; hattr = 'top'; }
		else { vattr = 'left'; hattr = 'top'; }

		positions = buildHorizontalPosition(e, positions, hattr);
		positions = buildVerticalPosition(e, positions, vattr);

		for(var pos in positions) {
			_tltp_wrapper.style[pos] = positions[pos];
		}
	},

	// searching the current horizontal position for the tooltip
	buildHorizontalPosition = function(e, positions, el_attr) {
	    var _self = getCurrentInstance();
		var u=0, wh = parseInt(window.innerHeight), eh = parseInt(_tltp_wrapper.offsetHeight);
		// top or bottom ?
		if (el_attr==='bottom') {
			u = _ie ? e.clientY - document.documentElement.scrollBottom : window.innerHeight - e.pageY;
			if (_self._auto_pos && parseInt(eh + _self._bottom) > wh) { 
				return buildHorizontalPosition(e, positions, 'top');
			}
			positions.bottom = parseInt(u - eh + _self._bottom) + 'px';
		}
		else {
			u = _ie ? e.clientY + document.documentElement.scrollTop : e.pageY;
			if (_self._auto_pos && parseInt(eh + _self._top) > parseInt(u)) { 
				return buildHorizontalPosition(e, positions, 'bottom');
			}
			positions.top = parseInt(u - eh + _self._top) + 'px';
		}
		return positions;
	},

	// searching the current vertical position for the tooltip
	buildVerticalPosition = function(e, positions, el_attr) {
	    var _self = getCurrentInstance();
		var l=0, ww = parseInt(window.innerWidth), ew = parseInt(_tltp_wrapper.offsetWidth);
		// left or right ?
		if (el_attr==='right') {
			l = _ie ? e.clientX + document.documentElement.scrollLeft : window.innerWidth - e.pageX;
			if (_self._auto_pos && parseInt(ew + _self._right) > parseInt(l)) {
				return buildVerticalPosition(e, positions, 'left');
			}
			positions.right = parseInt(l + _self._right) + 'px';
		}
		else {
			l = _ie ? e.clientX + document.documentElement.scrollLeft : e.pageX;
			if (_self._auto_pos && parseInt(ew + _self._left) > ww) {
				return buildVerticalPosition(e, positions, 'right');
			}
			positions.left = parseInt(l + _self._left) + 'px';
		}
		return positions;
	},

	// fading the tooltip before it really disappear
	fade = function(d,el) {
	    var _self = getInstance(el);
		var a = _self._alpha;
		if ((a!==_self._end_alpha && d===1) || (a!==0 && d===-1)) {
			var i = _self._speed;
			if (_self._end_alpha - a < _self._speed && d===1) {
				i = _self._end_alpha - a;
			} else if (_self._alpha < _self._speed && d===-1) {
				i = a;
			}
			_self._alpha = a + (i * d);
			_tltp_wrapper.style.opacity = _self._alpha * .01;
			_tltp_wrapper.style.filter = 'alpha(opacity=' + _self._alpha + ')';
		} else {
			clearInterval(_tltp_wrapper.timer);
			if (d===-1) { clearTooltip(el); }
		}
	},

    // get an element position	
	getOffset = function(el) {
        var _el=el, _x=0, _y=0;
        while( el && !isNaN( el.offsetLeft ) && !isNaN( el.offsetTop ) ) {
            _x += el.offsetLeft - el.scrollLeft;
            _y += el.offsetTop - el.scrollTop;
            el = el.offsetParent;
        }
        return {
            top: _y, bottom: _y+_el.offsetHeight,
            left: _x, right: _x+_el.offsetWidth
        };
    };

// ------------------
// The object
// ------------------

    newInstance();
    if (arguments.length) { extend(self, arguments[0], '_%s'); }
    domInit();
    return this;
};

// Endfile