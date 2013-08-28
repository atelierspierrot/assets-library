<!--
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
--><html>
<head>
<title>Test javascript page</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="../../css/commons.css.php" type="text/css" />
<script type="text/javascript" src="../commons.js.php"></script>  
<script type="text/javascript" src="../extend/extend.js"></script>  
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

    <div id="console_extendplugin1"></div>
<script language="Javascript" type="text/javascript">
/////// John Resig tests

/* Simple JavaScript Inheritance
 * By John Resig http://ejohn.org/
 * MIT Licensed.
 */
// Inspired by base2 and Prototype
(function(){
  var initializing = false, fnTest = /xyz/.test(function(){xyz;}) ? /\b_super\b/ : /.*/;

  // The base Class implementation (does nothing)
  this.Class = function(){};
 
  // Create a new Class that inherits from this class
  Class.extend = function(prop) {
    var _super = this.prototype;
   
    // Instantiate a base class (but only create the instance, don't run the init constructor)
    initializing = true;
    var prototype = new this();
    initializing = false;
   
    // Copy the properties over onto the new prototype
    for (var name in prop) {
      // Check if we're overwriting an existing function
      prototype[name] = 
        typeof prop[name] == "function" && typeof _super[name] == "function" && fnTest.test(prop[name])
        ?
        (function(name, fn){
          return function() {
            var tmp = this._super;

            // Add a new ._super() method that is the same method but on the super-class
            this._super = _super[name];
           
            // The method only need to be bound temporarily, so we remove it when we're done executing
            var ret = fn.apply(this, arguments);       
            this._super = tmp;
           
            return ret;
          };
        })(name, prop[name]) :
        prop[name];
    }
   
    // The dummy class constructor
    function Class() {
      // All construction is actually done in the init method
      if ( !initializing && this.init )
        this.init.apply(this, arguments);
    }
   
    // Populate our constructed prototype object
    Class.prototype = prototype;
   
    // Enforce the constructor to be what we expect
    Class.prototype.constructor = Class;

    // And make this class extendable
    Class.extend = arguments.callee;
   
    return Class;
  };
})();

var Person = Class.extend({
  init: function(isDancing){
    this.dancing = isDancing;
  },
  dance: function(){
    return this.dancing;
  }
});

var Ninja = Person.extend({
  init: function(){
    this._super( false );
  },
  dance: function(){
    // Call the inherited version of dance()
    return this._super();
  },
  swingSword: function(){
    return true;
  }
});

var p = new Person(true);
_write('p.dance();', 'console_extendplugin1'); // => true

var n = new Ninja();
_write('n.dance();', 'console_extendplugin1'); // => false
_write('n.swingSword();', 'console_extendplugin1'); // => true

// Should all be true
_write('p instanceof Person && p instanceof Class && n instanceof Ninja && n instanceof Person && n instanceof Class', 'console_extendplugin1');


/////// !!! John Resig tests
</script>

</div>

</body>
</html>