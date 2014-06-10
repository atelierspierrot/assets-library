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
        'commons','extend'
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
    <h1>Javascript Test Class</h1>
	<p>This page provides tests of building a class in javascript; information is written in console.</p>

    <h4>MENU</h4>
    <br />
	<ul id="menu">
        <li><a href="#baseproblem">The base problem</a></li>	
        <li><a href="#methodchaining">The method chaining</a></li>
        <li><a href="#extendplugin">Extend a class with a plugin</a></li>
	</ul>

    <br class="clear" />

<h2 id="baseproblem">The base problem</h2>
<div>

	<p>The base problem is to create a javascript class, callable with keyword "<var>new</var>". This is possible writing a simple function named "<var>MyClass</var>".</p>
	<pre>
function MyClass(){}
var myobject = new MyClass;
_write('typeof myobject', 'console_baseproblem1');
_write('myobject instanceof MyClass', 'console_baseproblem1');
	</pre>
    <div id="console_baseproblem1"></div>
<script language="Javascript" type="text/javascript">
function MyClass(){}
var myobject = new MyClass;
_write('typeof myobject', 'console_baseproblem1');
_write('myobject instanceof MyClass', 'console_baseproblem1');
</script>

	<p>The instance of the class must have its proper properties values. Let's take the example of a "<var>name</var>" property.</p>
	<pre>
function MyClass( arg ) {
    this.name = arg;
}
var myobject1 = new MyClass( 'my name 1' );
var myobject2 = new MyClass( 'my name 2' );
_write('myobject1.name', 'console_baseproblem2');
_write('myobject2.name', 'console_baseproblem2');
	</pre>
    <div id="console_baseproblem2"></div>
<script language="Javascript" type="text/javascript">
function MyClass( arg ) {
    this.name = arg;
}
var myobject1 = new MyClass( 'my name 1' );
console.debug(myobject1);
var myobject2 = new MyClass( 'my name 2' );
console.debug(myobject2);
_write('myobject1.name', 'console_baseproblem2');
_write('myobject2.name', 'console_baseproblem2');
</script>
    <br class="clear" />

	<p>The instance of the class must also have some private properties that can not be accessed directly. Let's take the example of the private property "<var>classname</var>".</p>
	<pre>
function MyClass( arg ) {
    this.name = arg;
    var classname = 'MyClass name';
    this.getName = function(){
        return classname;
    };
}
var myobject1 = new MyClass( 'my name 1' );
console.debug(myobject1);
var myobject2 = new MyClass( 'my name 2' );
console.debug(myobject2);
_write('myobject1.getName()', 'console_baseproblem3');
_write('myobject2.getName()', 'console_baseproblem3');
myobject2.classname = 'New name';
_write('myobject2.getName()', 'console_baseproblem3');
	</pre>
    <div id="console_baseproblem3"></div>
<script language="Javascript" type="text/javascript">
function MyClass( arg ) {
    this.name = arg;
    var classname = 'MyClass name';
    this.getName = function(){
        return classname;
    };
}
var myobject1 = new MyClass( 'my name 1' );
console.debug(myobject1);
var myobject2 = new MyClass( 'my name 2' );
console.debug(myobject2);
_write('myobject1.getName()', 'console_baseproblem3');
_write('myobject2.getName()', 'console_baseproblem3');
myobject2.classname = 'New name';
_write('myobject2.getName()', 'console_baseproblem3');
</script>
    <br class="clear" />

	<p>The class must have some private methods that can not be accessed directly.</p>
	<pre>
function MyClass( arg ) {
    this.name = arg;
    var classname = 'MyClass name';
    this.getName = function() {
        return classname;
    };
    this.getTest = function( str ) {
        return test( str );
    };
    
    function test( str ){
        return 'test : '+str;
    }

}
var myobject1 = new MyClass( 'my name 1' );
console.debug(myobject1);
_write('myobject1.getName()', 'console_baseproblem4');
_write('myobject1.test(\'yo\')', 'console_baseproblem4');
_write('myobject1.getTest(\'yo\')', 'console_baseproblem4');
	</pre>
    <div id="console_baseproblem4"></div>
<script language="Javascript" type="text/javascript">
function MyClass( arg ) {
    this.name = arg;
    var classname = 'MyClass name';
    this.getName = function() {
        return classname;
    };
    this.getTest = function( str ) {
        return test( str );
    };
    
    function test( str ){
        return 'test : '+str;
    }

}
var myobject1 = new MyClass( 'my name 1' );
console.debug(myobject1);
_write('myobject1.getName()', 'console_baseproblem4');
_write('myobject1.test(\'yo\')', 'console_baseproblem4');
_write('myobject1.getTest(\'yo\')', 'console_baseproblem4');
</script>
    <br class="clear" />

</div>

<h3>Overview</h3>
<div>
	<p>Finally, the class can be written like :</p>
	<pre>
// class "MyClass" callable with keyword "new"
function MyClass( arg ) {

    // public property
    this.name = arg;

    // private property
    var classname = 'MyClass name';

    // public method
    this.getName = function(){
        return classname;
    };

    // private method
    function test( str ){
        return 'test : '+str;
    }
}
	</pre>
    <br class="clear" />

</div>

    <small><a href="#top">Back to top</a></small>
    <br class="clear" />

<h2 id="methodchaining">The method chaining</h2>
<div>

	<p>The method chaining must allowed to write something like "<var>object.method1(args).method2(args2);</var>" ; the <var>method1()</var> must return the object itself.</p>
	<pre>
function MyClass(){
    this.method1 = function(arg){
        console.debug('argument from method1() ', arg);
        return this;
    };
    this.method2 = function(arg){
        console.debug('argument from method2() ', arg);
    };
}
var myobject = new MyClass;
_write('myobject.method1("test 1").method2("test 2");', 'console_methodchaining1');
	</pre>
    <div id="console_methodchaining1"></div>
<script language="Javascript" type="text/javascript">
function MyClass(){
    this.method1 = function(arg){
        console.debug('argument from method1() ', arg);
        return this;
    };
    this.method2 = function(arg){
        console.debug('argument from method2() ', arg);
    };
}
var myobject = new MyClass;
_write('myobject.method1("test 1").method2("test 2");', 'console_methodchaining1');
</script>
    <br class="clear" />

</div>

    <small><a href="#top">Back to top</a></small>
    <br class="clear" />

<h2 id="extendplugin">Extend a class with a plugin</h2>
<div>

	<p>A class should be extensible with the definition of another function, outside the first definition of the class. We can call our new extension function <strong>a plugin</strong>.</p>

	<p>Let's take the example of the class <var>MyClass</var> extended by the plugin <var>MyPlugin</var>.</p>
	<pre>
function MyClass( arg ) {
    this.name = arg;
    var classname = 'MyClass name';
    this.getName = function(){
        return classname;
    };
    function test( str ){
        return 'test : '+str;
    }
}
var myobject1 = new MyClass( 'my name 1' );
console.debug(myobject1);
_write('myobject1.getName()', 'console_extendplugin1');
_write('myobject1.test(\'yo\')', 'console_extendplugin1');
_write('myobject1.getTest(\'yo\')', 'console_extendplugin1');
	</pre>
    <div id="console_extendplugin1"></div>
<script language="Javascript" type="text/javascript">
function MyClass( arg ) {
    this.name = arg;
    var classname = 'MyClass name';
    this.getName = function(){
        return classname;
    };
    function test( str ){
        return 'test : '+str;
    };
}

MyClass.plugIn = function(obj) {
console.debug('plugIn ', obj);
    for(var _var in obj) {
console.debug( 'evaluating : MyClass.prototype.'+_var+' = '+obj[_var]+';' );
        eval( 'MyClass.prototype.'+_var+' = '+obj[_var]+';' );
    }
};

var myobject1 = new MyClass( 'my name 1' );
console.debug(myobject1);
_write('myobject1.name', 'console_extendplugin1');
_write('myobject1.getName()', 'console_extendplugin1');
_write('myobject1.test(\'yo\')', 'console_extendplugin1');

    MyClass.plugIn({
        MyPlugin1: function(str) {
            console.debug('MyPlugin1 ', str);
            console.debug('MyPlugin1 name ', this.name);
        },
        MyPlugin2: function() {
            return classname;
        },
        MyPlugin3: function() {
            return this.getName();
        }
    });
_write('myobject1.MyPlugin1("yo plugin");', 'console_extendplugin1');
_write('myobject1.MyPlugin2();', 'console_extendplugin1');
_write('myobject1.MyPlugin3();', 'console_extendplugin1');

(function(MyClass) {

console.debug('this in extension ', this);
console.debug('MyClass in extension ', MyClass);

    MyClass.plugIn({
        MyPlugin: function(str) {
            console.debug(this.name);
        }
    });
    
})(MyClass);

_write('myobject1.MyPlugin("yo plugin");', 'console_extendplugin1');
</script>
    <br class="clear" />

</div>

    <small><a href="#top">Back to top</a></small>
    <br class="clear" />

<h2>Searching ...</h2>
<div>

	<pre>
function MyClass( arg ) {
    this.name = arg;
    var classname = 'MyClass name';
    this.getName = function() {
        return classname;
    };
    this.getTest = function( str ) {
        return test( str );
    };
    
    function test( str ){
        return 'test : '+str;
    }

}
var myobject1 = new MyClass( 'my name 1' );
console.debug(myobject1);
_write('myobject1.getName()', 'console4');
_write('myobject1.test(\'yo\')', 'console4');
_write('myobject1.getTest(\'yo\')', 'console4');
	</pre>
    <div id="console5"></div>
<script language="Javascript" type="text/javascript">
function MyClass( arg ) {

    this.name = arg;

    this.debug = function() {
        console.debug( this );
    };
    
    this.setInFunction = function() {
        this.newvar = 'yo';
    };
    
}
var myobject1 = new MyClass( 'my name 1' );
console.debug(myobject1);
myobject1.setInFunction();
console.debug(myobject1);
</script>

</div>

    <small><a href="#top">Back to top</a></small>
    <br /><br />

</body>
</html>