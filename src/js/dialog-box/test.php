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

/*
$requirements = array(
    'js'=>array(
        'commons'=>array(
            'commons',
            'clone',
        ),
        'extend',
        'document'=>array(
            'document_load',
            'get_document_sizes',
        ),
        'form_serialize',
        'draggable',
        'node'=>array(
            'classes',
            'get_style_attribute',
            'get_offset',
        ),
        'window'=>'get_window_sizes',
        'system'=>'uniqid',
        'array'=>'in_array',
        'ajax'
    ),
    'css'=>array(
        'commons'=>array(
            'commons',
            'clone',
        ),
        'extend',
        'document'=>'document_load',
        'form_serialize',
        'ajax',
        'draggable',
    ),
);
            "dialog-box": {
                "js": "js/dialog-box/dialog-box.js",
                "css": "js/dialog-box/dialog-box.css",
                "require": [ "draggable", "classes", "window-sizes", "ajax" ]
            }
*/

?><html>
<head>
<title>Test of Dialog Box javascript class</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- Requirements -->
<script type="text/javascript" src="<?php echo build_requirements_url('js', $requirements['js']); ?>"></script>
<link href="<?php echo build_requirements_url('css', $requirements['css']); ?>" media="screen" rel="stylesheet" type="text/css" />

<!-- Preset "dialog-box" -->
<script type="text/javascript" src="<?php echo build_preset_url('js', 'dialog-box'); ?>"></script>
<link href="<?php echo build_preset_url('css', 'dialog-box'); ?>" media="screen" rel="stylesheet" type="text/css" />

<script language="Javascript" type="text/javascript">

function openPopup( content, title, width, height, callback ) {
    DialogBox('open', content, title, width, height, callback);
    return false;
}

function test_open() {
    openPopup('yo', 'My title');
}

function test_openContent(_w,_h) {
    var ctt = document.getElementById('block4').innerHTML;
    openPopup(ctt, 'Long content', (_w||400), (_h||320));
}

function test_openForm(){

    var l = document.createElement("label");
    l.setAttribute('for',"field");
    l.innerHTML = 'My field label:';

    var i = document.createElement("input");
    i.setAttribute('type',"text");
    i.setAttribute('name',"field");
    i.setAttribute('id',"field");
    i.setAttribute('placeholder','fill in this field');

    var m = document.createElement("label");
    m.setAttribute('for',"field");
    m.innerHTML = 'My field label in "error" state:';

    var j = document.createElement("input");
    j.setAttribute('type',"text");
    j.setAttribute('name',"field");
    j.setAttribute('id',"field");
    j.setAttribute('class',"error");
    j.setAttribute('placeholder','fill in this field');

    DialogBox('openForm', [l,i,m,j], 'Test form', null, 'auto', function(data){
console.debug(arguments);
        alert(arguments);
        successFormSubmit(data);
        return 'yo';
    });
}

function test_openPrompt(){
    var result;
    DialogBox('prompt', 'my prompted info', 'Test form', 'yo', function(data){
        result = data;
        alert(result);
    });
}

function successFormSubmit(resp) {
    if (typeof resp!=='string') {
        var str = '';
        for(var i in resp) {
            str += i+': '+resp[i]+'<br />';
        }
        resp = str;
    }
    document.getElementById('TextDiv').innerHTML = '<h3>Form results</h3>'+resp;
}

function test_ajaxLoad(){
    DialogBox('ajaxLoad', 'ajax_test.htm', 'Test ajax', 420);
}

/*
onDocumentLoad(function(){
var db = new DialogBox();
db.open();
db.close();
});
*/
</script>
<style type="text/css">
</style>
</head>

<body>
    <p>This page provides tests of the javascript 'class' '<strong>Dialog Box</strong>'; information is written in console.</p>

    <h3>Functionality tests</h3>
   <ul>
       <li><a href="#" onclick="test_open();">Test open simple dialogbox</a></li>
       <li><a href="#" onclick="test_openContent();">Test open dialogbox getting long content</a></li>
       <li><a href="#" onclick="test_openContent(3000,3000);">Test open dialogbox getting long content and very big sizes</a></li>
       <li><a href="#" onclick="test_openForm();">Test open dialogbox with a form</a></li>
       <li><a href="#" onclick="test_openPrompt();">Test open dialogbox to prompt user</a></li>
       <li><a href="#" onclick="test_ajaxLoad();">Test open dialogbox with ajax content</a></li>
    </ul>

<div id="TextDiv"></div>

<h3>Maecenas libero lectus, eleifend congue</h3>
<div id="block4">
    <p>hendrerit eu, posuere accumsan, magna. Aenean euismod. Donec lobortis vestibulum sapien. Morbi pharetra ipsum ac nibh. Vestibulum quis mauris. Duis pulvinar lectus quis lectus. In hac habitasse platea dictumst. Ut consequat, nunc vel dictu<strong>m faucibus, ante quam iaculis</strong> mi, sed gravida neque justo eu tellus. Sed vel massa vel orci laoreet luctus. Nulla facilisi. In risus. Cras et quam. Praesent sit amet mi. Maecenas consequat. Pellentesque consectetuer. Integer at urna non erat dapibus vehicula. Phasellus eu magna. In purus erat, consequat nec, <i>ultrices a, sollicitudin id, leo.</i></p>
    <p>Integer ultricies fringilla nunc. Fusce tempor augue vel tortor. Nullam at ante. Mauris faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque sodales interdum augue. Vivamus  tempor viverra lacus. Mauris rutrum augue sit amet nisi. Mauris eleifend euismod sapien. In augue dui, dictum id, lobortis ac, aliquet in, libero.</p>
    <p>Proin ornare ligula vitae tellus. Pellentesque risus felis, tempus eget, placerat et, elementum at, ipsum. Suspendisse faucibus gravida quam. Fusce odio. Maecenas mattis pharetra felis. Nam in nunc vitae velit vehicula suscipit. Duis accumsan, lorem non tristique rhoncus, lacus purus imperdiet nunc, eget feugiat augue metus eget justo. Donec quis dui a dui condimentum egestas.  Nullam eget arcu. In placerat pulvinar lacus.</p>
    <p>Fusce lacinia. Nullam laoreet ligula in pede. Vestibulum nunc purus, venenatis quis, blandit eget, congue at, risus. Sed orci. Nulla facilisi. Vestibulum vitae sem. Integer dignissim tortor vitae sem. Donec quis sapien. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas nonummy semper felis.</p>
    <p>Nunc non nibh. Suspendisse potenti. Mauris elementum interdum nunc. Donec sit amet tortor. Morbi vehicula mauris at odio. Maecenas commodo ultricies orci. Vivamus varius quam. Aenean auctor lorem sit amet magna. Fusce quis tellus. Vestibulum placerat vulputate lorem. Nulla elementum mattis nisi. Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.</p>
    <p>Nullam elit orci, posuere vel, imperdiet ac, interdum vitae, tellus. Etiam nisl. Mauris iaculis erat eu nisi gravida accumsan. Pellentesque pharetra. Fusce in quam nec ante euismod cursus. Etiam diam. Proin aliquam, nibh malesuada fringilla blandit, ante <a href="http://example.com">orci feugiat sem, ut vehicula risus mauris non augue.</a> Etiam dapibus elit ac massa. Praesent vitae metus. In sed augue. Suspendisse potenti. Vivamus lacinia justo ullamcorper arcu. Duis accumsan urna tempus dolor. Morbi felis. Nullam tortor urna, tincidunt tincidunt, luctus sodales, facilisis in, felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec in tellus.</p>
    <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce pede nisl, suscipit id, bibendum vel, euismod a, urna. Aliquam ut arcu. Nulla ullamcorper mauris ut velit. Etiam consectetuer ipsum id ligula. Nam euismod ipsum vitae felis. Quisque pede ante, pretium et, fermentum vel, tempor eget, dolor. Phasellus eu pede. Suspendisse bibendum, ligula at porta convallis, lacus mauris egestas risus, vitae scelerisque ante mauris a erat. Aenean varius ligula sed dui. Etiam pellentesque facilisis eros. In interdum orci. In augue pede, hendrerit ac, facilisis ut, convallis luctus, sapien. Nulla metus. Vestibulum neque justo, convallis eu, varius egestas, posuere eu, libero. Pellentesque nec elit nec diam commodo euismod. Aliquam aliquet convallis est. Integer consectetuer nibh non urna. Nam ultrices mauris.</p>
    <p>hendrerit eu, posuere accumsan, magna. Aenean euismod. Donec lobortis vestibulum sapien. Morbi pharetra ipsum ac nibh. Vestibulum quis mauris. Duis pulvinar lectus quis lectus. In hac habitasse platea dictumst. Ut consequat, nunc vel dictu<strong>m faucibus, ante quam iaculis</strong> mi, sed gravida neque justo eu tellus. Sed vel massa vel orci laoreet luctus. Nulla facilisi. In risus. Cras et quam. Praesent sit amet mi. Maecenas consequat. Pellentesque consectetuer. Integer at urna non erat dapibus vehicula. Phasellus eu magna. In purus erat, consequat nec, <i>ultrices a, sollicitudin id, leo.</i></p>
    <p>Integer ultricies fringilla nunc. Fusce tempor augue vel tortor. Nullam at ante. Mauris faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque sodales interdum augue. Vivamus  tempor viverra lacus. Mauris rutrum augue sit amet nisi. Mauris eleifend euismod sapien. In augue dui, dictum id, lobortis ac, aliquet in, libero.</p>
    <p>Proin ornare ligula vitae tellus. Pellentesque risus felis, tempus eget, placerat et, elementum at, ipsum. Suspendisse faucibus gravida quam. Fusce odio. Maecenas mattis pharetra felis. Nam in nunc vitae velit vehicula suscipit. Duis accumsan, lorem non tristique rhoncus, lacus purus imperdiet nunc, eget feugiat augue metus eget justo. Donec quis dui a dui condimentum egestas.  Nullam eget arcu. In placerat pulvinar lacus.</p>
    <p>Fusce lacinia. Nullam laoreet ligula in pede. Vestibulum nunc purus, venenatis quis, blandit eget, congue at, risus. Sed orci. Nulla facilisi. Vestibulum vitae sem. Integer dignissim tortor vitae sem. Donec quis sapien. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas nonummy semper felis.</p>
    <p>Nunc non nibh. Suspendisse potenti. Mauris elementum interdum nunc. Donec sit amet tortor. Morbi vehicula mauris at odio. Maecenas commodo ultricies orci. Vivamus varius quam. Aenean auctor lorem sit amet magna. Fusce quis tellus. Vestibulum placerat vulputate lorem. Nulla elementum mattis nisi. Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.</p>
</div>

</body>
</html>