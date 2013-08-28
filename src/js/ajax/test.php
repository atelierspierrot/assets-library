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
<title>Test of Ajax javascript class</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- Commons -->
<script type="text/javascript" src="../commons.js.php"></script>
<link href="../../css/commons.css.php" rel="stylesheet" type="text/css" />

<!-- Requirements : clone | extend | document load | form_serialize | node/classes | node/get_style_attribute | node/get_offset | system/uniqid | array/in_array -->
<script type="text/javascript" src="../library.js.php?clone&extend&document=document_load&form_serialize&node[]=classes&node[]=get_style_attribute&node[]=get_offset&system=uniqid&array=in_array"></script>
<link href="../library.css.php?clone&extend&document=document_load&form_serialize" media="screen" rel="stylesheet" type="text/css" />

<!-- Ajax -->
<script type="text/javascript" src="ajax.js"></script>  

<script language="Javascript" type="text/javascript">

function test_ajax_txt() {
	return new Ajax({
		url:'test/demo.htm', 
		success:function(resp, e) {
			document.getElementById('TextDiv').innerHTML = resp;
		} 
	});
}

function test_ajax_txt_synch() {
	return new Ajax({
		url:'test/demo.htm', 
		asynch: false,
		success:function(resp, e) {
			document.getElementById('TextDiv').innerHTML = resp;
		} 
	});
}

function test_ajax_xml() {
	return new Ajax({
		url:'test/xml_test.xml', 
		format: 'XML',
		load_in: 'TextDiv',
		success:function(resp, e) {
			var element = resp.getElementsByTagName('root').item(0);
			document.getElementById('TextDiv').innerHTML = element.firstChild.data;
		} 
	});
}

function test_load_txt() {
	return new ajaxLoad('TextDiv' ,'test/demo.htm');
}

function test_ajax_txt_timeout() {
	return new Ajax({
//		if_modified: true,
		url:'test/demo.htm', 
		load_in: 'TextDiv',
		timeout: 2000,
//		loader: "img/indicator.gif"
//		loader: "img/indicator_mini.gif"
//		loader: "img/loadingAnimation.gif"
//		loader: "img/loader.gif"
//		loader: "img/reloading.gif"
	});
}

function test_ajax_txt_timeout_disabled() {
	return new Ajax({
//		if_modified: true,
		url:'test/demo.htm', 
		load_in: 'TextDiv',
		timeout: 2000,
		dom_disabled: true,
//		loader: "img/indicator.gif"
//		loader: "img/indicator_mini.gif"
//		loader: "img/loadingAnimation.gif"
//		loader: "img/loader.gif"
//		loader: "img/reloading.gif"
	});
}

function test_ajax_file_error() {
	Ajax({
		url:'test/abcdefgh.htm', 
		success:function(resp, e) {
			document.getElementById('TextDiv').innerHTML = resp;
		},
		error: function(resp, e) {
    			alert('An error occured : '+resp);
		}
	});
}

function test_ajax_form() {
	Ajax({
		url:'test/test.php', 
		success:function(resp, e) {
			document.getElementById('TextDiv').innerHTML = resp;
		},
		error: function(resp, e) {
    			alert('An error occured : '+resp);
		}
	});
}

function test_ajax_loader( _loader_ ) {
	Ajax({
		url:'test/test_sleep.php', 
		load_in: 'TextDiv',
		loader: "img/"+_loader_
	});
}

function test_ajax_form_sleep() {
	Ajax({
		url:'test/test_sleep.php', 
		load_in: 'TextDiv'
	});
}

function test_ajax_form_get() {
	Ajax({
		url:'test/test.php', 
		data: { myfield: 'an info getted via AJAX' },
		success:function(resp, e) {
			document.getElementById('TextDiv').innerHTML = resp;
		},
		error: function(resp, e) {
    			alert('An error occured : '+resp);
		}
	});
}

function test_ajax_form_post() {
	Ajax({
		url:'test/test.php', 
		method: 'POST',
		data: "myfield="+escape('an info posted via AJAX'),
		success:function(resp, e) {
			document.getElementById('TextDiv').innerHTML = resp;
		},
		error: function(resp, e) {
    			alert('An error occured : '+resp);
		}
	});
}
/*
resp = '<p>This is a demo of a simple form.</p>'+"\n"
+'<p><p><p>POST : an info posted via AJAX<p>'+"\n"
+'<script language="Javascript" type="text/javascript">'+"\n"
+'<!--'+"\n"
+'function qsdfqsdf() {'+"\n"
+'	alert("qsdfqsdf: ok loaded !");'+"\n"
+'}'+"\n"
+'//-->'+"\n"
+'<'+'/script>'+"\n"
+'<script language="Javascript" type="text/javascript">'+"\n"
+'function testAlert() {'+"\n"
+'	alert("testAlert: ok loaded !");'+"\n"
+'}'+"\n"
+''+"\n"
+'<'+'/script>'+"\n"
+'<form name="form1" method="post" action="test/test.php">'+"\n"
+'  <p>'+"\n"
+'    <input type="text" name="myfield" value="an info posted via AJAX" />'+"\n"
 +' </p>'+"\n"
+'  <p>'+"\n"
+'    <input type="submit" name="Submit" value="Submit" />'+"\n"
+'    <input type="button" name="AJaxSubmit" value="Submit in AJAX" onclick="return submitInAjax(this);" />'+"\n"
+'  </p>'+"\n"
+'</form>'
+'<script language="Javascript" type="text/javascript">'+"\n"
+'function azerty() {'+"\n"
+'	alert("AZERTY ok loaded !");'+"\n"
+'}'+"\n"
+'<'+'/script>'+"\n";

//testAlert();

console.debug(resp);

_evalJavascript( resp );

testAlert();

	function _evalJavascript( _response ) {
//		var _js_mask = "<script[^>]*>([^<"+"/script]*)<"+"/script>",
//		var _js_mask = "(<script[^>]*>)([^<"+"/script]*)(<"+"/script>)",
		var _js_mask = "<script[^>]*>([^<]*)<"+"/script>",
			_patrn = new RegExp(_js_mask.replace('/', '\/'), 'gim'),
			matches = _response.match(_patrn),
			js_code;
console.debug("pattern : "+_patrn);

		if (matches) {
			for (i=0; i<matches.length; i++) {
				js_code = matches[i].replace(_patrn, "$1");
				if (js_code && js_code!='') {
		        	 // http://blog.client9.com/2008/11/javascript-eval-in-global-scope.html
					eval.call(null, js_code);
				}
			}
		}
	}
*/
function test_ajax_args_error() {
	Ajax({
		success:function(resp, e) {
			document.getElementById('TextDiv').innerHTML = resp;
		},
		error: function(resp, e) {
    			alert('An error occured : '+resp);
		}
	});
}

function test_load_args_error() {
	ajaxLoad('TextDiv');
}

function test() {
	if(arguments.length) alert('Arguments');
	else alert('no args');
}

function successFormSubmit(resp) {
	document.getElementById('TextDiv').innerHTML = resp;
}

</script>
<style type="text/css">
.disabled {
opacity:0.4;
filter:alpha(opacity=40);
}
</style>
</head>

<body>
	<p>This page provides tests of the javascript 'class' '<strong>Ajax</strong>'; information is written in console.</p>
	<table cellspacing=30><tr>
	<td>
	<h3>Functionality tests</h3>
   <ul>
	   <li><a href="#" onclick="test_ajax_txt();">Test text Ajax</a></li>
	   <li><a href="#" onclick="test_ajax_xml();">Test XML Ajax</a></li>
	   <li><a href="#" onclick="test_ajax_txt_timeout();">Test text Ajax with timeout</a></li>
	   <li><a href="#" onclick="test_ajax_txt_timeout_disabled();">Test text Ajax with timeout and div disabled</a></li>	   
	   <li><a href="#" onclick="test_ajax_form_sleep();">Test text Ajax with long time response</a></li>
	   <li><a href="#" onclick="test_load_txt();">Test text ajaxLoad</a></li>
	   <li><a href="#" onclick="test_ajax_form();">Test form Ajax</a></li>
	   <li><a href="#" onclick="test_ajax_form_get();">Test form Ajax with get</a></li>
	   <li><a href="#" onclick="test_ajax_form_post();">Test form Ajax with post</a></li>
	   <li><a href="#" onclick="test_ajax_txt_synch();">Test text Ajax synchronous</a></li>
	</ul>
	</td>
	<td>
	<h3>Errors tests</h3>
   <ul>
	   <li><a href="#" onclick="test_ajax_file_error();">Test error Ajax : file not found</a></li>
	   <li><a href="#" onclick="test_ajax_args_error();">Test error Ajax : no URL specified</a></li>
	   <li><a href="#" onclick="test_load_args_error();">Test error ajaxLoad : argument missing (1 argument) </a></li>
   </ul>
	<h3>Loader image tests</h3>
   <ul>
	   <li><a href="#" onclick="test_ajax_loader('indicator.gif');">Test 'indicator.gif' (default)</a></li>
	   <li><a href="#" onclick="test_ajax_loader('indicator_mini.gif');">Test 'indicator_mini.gif'</a></li>
	   <li><a href="#" onclick="test_ajax_loader('loader.gif');">Test 'loader.gif'</a></li>
	   <li><a href="#" onclick="test_ajax_loader('loadingAnimation.gif');">Test 'loadingAnimation.gif'</a></li>
	   <li><a href="#" onclick="test_ajax_loader('reloading.gif');">Test 'reloading.gif'</a></li>
	</ul>
	</td>
	</tr></table>
	<hr />
   <div id="TextDiv">Text</div>
</body>
</html>