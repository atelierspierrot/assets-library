<?php
/*
# ***** BEGIN LICENSE BLOCK *****
# Assets Library - The open source PHP/JavaScript/CSS library of Les Ateliers Pierrot
# Copyleft (c) 2013-2014 Pierre Cassat and contributors
# <www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>
# License GPL-3.0 <http://www.opensource.org/licenses/gpl-3.0.html>
# Sources <http://github.com/atelierspierrot/assets-library>
#
# Ce programme est un logiciel libre distribué sous licence GNU/GPL.
#
# ***** END LICENSE BLOCK ***** */

@ini_set('display_errors',1); @error_reporting(E_ALL ^ E_NOTICE); 
require_once __DIR__.'/../src/assets-library.php';

$requirements = array(
    'js'=>array(
        'commons',
    ),
    'css'=>array(
        'commons',
    ),
);

?><html>
<head>
<title>Test javascript page</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- Requirements -->
<script type="text/javascript" src="<?php echo build_requirements_url('js', $requirements['js']); ?>"></script>
<link href="<?php echo build_requirements_url('css', $requirements['css']); ?>" media="screen" rel="stylesheet" type="text/css" />
<style type="text/css">
pre { color: #404040; border: 1px dotted #ccc; padding: 4px; }
.console { color: red; background: #ccc; padding: 4px; width: 100%; position: relative; display: block; }
.console span.what { color: blue; width: auto; min-width: 120px; padding-right: 20px; }
.console span.ok { color: green; }
.console span.error { color: red; }
</style>
<script language="Javascript" type="text/javascript">
function _write( what, where )
{
    var str,
        dom = document.getElementById( where ),
    	div_console = document.createElement('div'),
    	span_info = document.createElement('span'),
    	span_str = document.createElement('span');
    try {
        str = eval(what);
    	span_str.setAttribute('class', 'ok');
    } catch(e) {
        str = 'Error while evaluating "'+what+'" ('+e+')';
    	span_str.setAttribute('class', 'error');
    }
    console.debug(str);
    if (dom) {
    	div_console.setAttribute('class', 'console');
    	span_info.setAttribute('class', 'what');
        span_info.innerHTML = what;
        div_console.appendChild(span_info);
        span_str.innerHTML = str;
        div_console.appendChild(span_str);
        dom.appendChild(div_console);
    }
}
</script>
</head>
<body>
    <a name="top"></a>
    <h1>Javascript Test Selectors</h1>
	<p>This page provides tests of building an element(s) selector handler in javascript; information is written in console.</p>

    <h4>MENU</h4>
    <br />
	<ul id="menu">
        <li><a href="#baseproblem">The base problem</a></li>	
        <li><a href="#firsttests">The first tests</a></li>	
	</ul>

    <br class="clear" />

<h2 id="baseproblem">The base problem</h2>
<div>

	<p>The goal here is to bild a function to help selecting one or many dom elements by an ID, a class or a complex set of both ; the base example is the way <em>jQuery</em> allows to write something like <var>$('#dom_id .el_class')</var>.
	The selection strings must be written as a CSS selector (even for tag names).</p>

	<p>For this work, we will construct the following HTML content :</p>
	<pre>
&lt;div id="block1" class="blockclass1 allblocks"&gt;
	&lt;p class="content"&gt;Nullam elit orci, posuere vel, imperdiet ac, interdum vitae, tellus. Etiam nisl. Mauris iaculis erat eu nisi gravida accumsan.
	Pellentesque pharetra. Fusce in quam nec ante euismod cursus. Etiam diam. Proin aliquam, nibh malesuada fringilla blandit, ante 
	&lt;a href="http://example.com" class="link"&gt;orci feugiat sem, ut vehicula risus mauris non augue.&lt;/a&gt;.&lt;/p&gt;
&lt;/div&gt;
&lt;div id="block2" class="blockclass2 allblocks"&gt;
	&lt;p class="content"&gt;Nullam elit orci, posuere vel, imperdiet ac, interdum vitae, tellus. Etiam nisl. Mauris iaculis erat eu nisi gravida accumsan.
	Pellentesque pharetra. Fusce in quam nec ante euismod cursus. Etiam diam. Proin aliquam, nibh malesuada fringilla blandit, ante 
	&lt;a href="http://example.com" class="link"&gt;orci feugiat sem, ut vehicula risus mauris non augue.&lt;/a&gt;.&lt;/p&gt;
&lt;/div&gt;
&lt;div id="block3" class="blockclass3 allblocks"&gt;
	&lt;p class="content"&gt;Nullam elit orci, posuere vel, imperdiet ac, interdum vitae, tellus. Etiam nisl. Mauris iaculis erat eu nisi gravida accumsan.
	Pellentesque pharetra. Fusce in quam nec ante euismod cursus. Etiam diam. Proin aliquam, nibh malesuada fringilla blandit, ante 
	&lt;a href="http://example.com" class="link"&gt;orci feugiat sem, ut vehicula risus mauris non augue.&lt;/a&gt;.&lt;/p&gt;
&lt;/div&gt;
	</pre>

<div id="block1" class="blockclass1 allblocks">
	<p class="content">Nullam elit orci, posuere vel, imperdiet ac, interdum vitae, tellus. Etiam nisl. Mauris iaculis erat eu nisi gravida accumsan. Pellentesque pharetra. Fusce in quam nec ante euismod cursus. Etiam diam. Proin aliquam, nibh malesuada fringilla blandit, ante <a href="http://example.com" class="link">orci feugiat sem, ut vehicula risus mauris non augue.</a> Etiam dapibus elit ac massa. Praesent vitae metus. In sed augue. Suspendisse potenti. Vivamus lacinia justo ullamcorper arcu. Duis accumsan urna tempus dolor. Morbi felis. Nullam tortor urna, tincidunt tincidunt, luctus sodales, facilisis in, felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec in tellus.</p>
</div>
<div id="block2" class="blockclass2 allblocks">
	<p class="content">Nullam elit orci, posuere vel, imperdiet ac, interdum vitae, tellus. Etiam nisl. Mauris iaculis erat eu nisi gravida accumsan. Pellentesque pharetra. Fusce in quam nec ante euismod cursus. Etiam diam. Proin aliquam, nibh malesuada fringilla blandit, ante <a href="http://example.com" class="link">orci feugiat sem, ut vehicula risus mauris non augue.</a> Etiam dapibus elit ac massa. Praesent vitae metus. In sed augue. Suspendisse potenti. Vivamus lacinia justo ullamcorper arcu. Duis accumsan urna tempus dolor. Morbi felis. Nullam tortor urna, tincidunt tincidunt, luctus sodales, facilisis in, felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec in tellus.</p>
</div>
<div id="block3" class="blockclass3 allblocks">
	<p class="content">Nullam elit orci, posuere vel, imperdiet ac, interdum vitae, tellus. Etiam nisl. Mauris iaculis erat eu nisi gravida accumsan. Pellentesque pharetra. Fusce in quam nec ante euismod cursus. Etiam diam. Proin aliquam, nibh malesuada fringilla blandit, ante <a href="http://example.com" class="link">orci feugiat sem, ut vehicula risus mauris non augue.</a> Etiam dapibus elit ac massa. Praesent vitae metus. In sed augue. Suspendisse potenti. Vivamus lacinia justo ullamcorper arcu. Duis accumsan urna tempus dolor. Morbi felis. Nullam tortor urna, tincidunt tincidunt, luctus sodales, facilisis in, felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec in tellus.</p>
</div>

    <small><a href="#top">Back to top</a></small>
    <br class="clear" />

</div>

<h2 id="firsttests">The first tests</h2>
<div>

	<p>What we want to do should be something like :</p>

	<pre>
var block1 = Select('#block1'); // selection of one element by its ID
var allblocks = Select('.allblocks'); // selection of a set of elements by their class
var content1 = Select('#block1 .content'); // selection of one element by class in an element with its ID
var links = Select('a'); // selection of a set of elements by tag name
var links_class = Select('a .link'); // selection of a set of elements by tag name and filter by class
	</pre>

    <div id="console_firsttests1"></div>
<script language="Javascript" type="text/javascript">
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

var block1 = Select('#block1'); // selection of one element by its ID
var allblocks = Select('.allblocks'); // selection of a set of elements by their class
var content1 = Select('#block1 .content'); // selection of one element by class in an element with its ID
var links = Select('a'); // selection of a set of elements by tag name
var links_class = Select('a .link'); // selection of a set of elements by tag name and filter by class
_write('block1', 'console_firsttests1');
_write('allblocks', 'console_firsttests1');
_write('content1', 'console_firsttests1');
_write('links', 'console_firsttests1');
_write('links_class', 'console_firsttests1');

/**
 * Apply a callback function on args
 *
 * @param str|function callback The callback function name or closure to execute
 * @param misc args The argument(s) to pass for the callback execution
 * @return misc The result of the callback execution
 */
function applyCallback(callback, args) {
    var result = null;
    if (!Array.isArray(args)) { args = [ args ]; }

    // case of a closure
    if (typeof callback==='function') {
        result = callback.apply( null, args );
    }
    // case of a function name
    else if (typeof callback==='string' && typeof window[callback]==='function') {
        eval( 'result = '+callback+'.apply( null, args );' );
    }

    return result;
}

/**
 * Loop on each item of an Array or a Collection
 *
 * @param array|collection collection The array or collection to loop on
 * @param str|function callback A callback function to execute on each item, as `callback( index, value )`
 * @return array|collection Returns the array or collection after execution of the loop
 */
function each(collection, callback) {
    for(var i=0, len=collection.length; i<len; i++) {
        applyCallback( callback, [i, collection[i]] );
    }
    return collection;
}

Array.prototype.each = function(callback) {
    return each(this, callback);
};

function callbackTest(i, obj) {
    console.debug('callbackTest ', obj.getAttribute('href') );
}

links_class
    .each(function(i, obj){
        console.debug( obj.getAttribute('href') );
    })
    .each('callbackTest');
</script>
    <br class="clear" />

</div>

    <small><a href="#top">Back to top</a></small>
    <br /><br />

</body>
</html>