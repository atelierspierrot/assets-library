<?php
/*
# ***** BEGIN LICENSE BLOCK *****
# Assets Library - The open source PHP/JavaScript/CSS library of Les Ateliers Pierrot
# Copyleft (c) 2013-2014 Pierre Cassat and contributors
# <www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>
# License GPL-3.0 <http://www.opensource.org/licenses/gpl-3.0.html>
# Sources <http://github.com/atelierspierrot/assets-library>
#
# Ce programme est un logiciel libre distribu� sous licence GNU/GPL.
#
# ***** END LICENSE BLOCK ***** */

@ini_set('display_errors',1); @error_reporting(E_ALL ^ E_NOTICE); 
require_once __DIR__.'/../../assets-library.php';

$requirements = array(
    'js'=>array('commons'),
    'css'=>array('commons'),
);

?><html>
<head>
<title>Test of Ajax javascript class</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- Requirements -->
<script type="text/javascript" src="<?php echo build_requirements_url('js', $requirements['js']); ?>"></script>
<link href="<?php echo build_requirements_url('css', $requirements['css']); ?>" media="screen" rel="stylesheet" type="text/css" />

<!-- Preset "ajax" -->
<script type="text/javascript" src="<?php echo build_preset_url('js', 'ajax'); ?>"></script>
<link href="<?php echo build_preset_url('css', 'ajax'); ?>" media="screen" rel="stylesheet" type="text/css" />

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
//        if_modified: true,
        url:'test/demo.htm', 
        load_in: 'TextDiv',
        timeout: 2000,
//        loader: "<?php echo _ASSETSLIB_IMG_HTTP; ?>/indicator.gif"
//        loader: "<?php echo _ASSETSLIB_IMG_HTTP; ?>/indicator_mini.gif"
//        loader: "<?php echo _ASSETSLIB_IMG_HTTP; ?>/loadingAnimation.gif"
//        loader: "<?php echo _ASSETSLIB_IMG_HTTP; ?>/loader.gif"
//        loader: "<?php echo _ASSETSLIB_IMG_HTTP; ?>/reloading.gif"
    });
}

function test_ajax_txt_timeout_disabled() {
    return new Ajax({
//        if_modified: true,
        url:'test/demo.htm', 
        load_in: 'TextDiv',
        timeout: 2000,
        dom_disabled: true,
//        loader: "<?php echo _ASSETSLIB_IMG_HTTP; ?>/indicator.gif"
//        loader: "<?php echo _ASSETSLIB_IMG_HTTP; ?>/indicator_mini.gif"
//        loader: "<?php echo _ASSETSLIB_IMG_HTTP; ?>/loadingAnimation.gif"
//        loader: "<?php echo _ASSETSLIB_IMG_HTTP; ?>/loader.gif"
//        loader: "<?php echo _ASSETSLIB_IMG_HTTP; ?>/reloading.gif"
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
        loader: "<?php echo _ASSETSLIB_IMG_HTTP; ?>/"+_loader_
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
+'    alert("qsdfqsdf: ok loaded !");'+"\n"
+'}'+"\n"
+'//-->'+"\n"
+'<'+'/script>'+"\n"
+'<script language="Javascript" type="text/javascript">'+"\n"
+'function testAlert() {'+"\n"
+'    alert("testAlert: ok loaded !");'+"\n"
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
+'    alert("AZERTY ok loaded !");'+"\n"
+'}'+"\n"
+'<'+'/script>'+"\n";

//testAlert();

console.debug(resp);

_evalJavascript( resp );

testAlert();

    function _evalJavascript( _response ) {
//        var _js_mask = "<script[^>]*>([^<"+"/script]*)<"+"/script>",
//        var _js_mask = "(<script[^>]*>)([^<"+"/script]*)(<"+"/script>)",
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
    <hr />
   <div><small>Footer test</small></div>
</body>
</html>