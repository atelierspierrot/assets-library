<?php
/*
# ***** BEGIN LICENSE BLOCK *****
# Assets Library - The open source PHP/JavaScript/CSS library of Les Ateliers Pierrot
# Copyleft (c) 2013 Pierre Cassat and contributors
# <www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>
# License GPL-3.0 <http://www.opensource.org/licenses/gpl-3.0.html>
# Sources <http://github.com/atelierspierrot/assets-library>
#
# Ce programme est un logiciel libre distribué sous licence GNU/GPL.
#
# ***** END LICENSE BLOCK ***** */

@ini_set('display_errors',1); @error_reporting(E_ALL ^ E_NOTICE); 
require_once __DIR__.'/../../src/assets-library.php';

$requirements = array(
    'js'=>array(
        'commons'=>array(
            'commons', 'apply_callbock'
        ),
        'array'=>'each',
        'node'=>'select',
        'document'=>'document_load',
    ),
    'css'=>array(
        'commons',
    ),
);

?><html>
<head>
<title>Test of the Piwi javascript framework</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- Requirements -->
<script type="text/javascript" src="<?php echo build_requirements_url('js', $requirements['js']); ?>"></script>
<link href="<?php echo build_requirements_url('css', $requirements['css']); ?>" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="Piwi.js"></script>
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


console.debug(Piwi);
//console.debug($.error('test'));


var pf = Piwi().init({ debug: true });
console.debug(pf);

//console.debug($.load('test', 'mlkj')); // => error

function callbackTest(i, obj) {
    console.debug('callbackTest ', obj.getAttribute('href') );
}

$.onDocReady(function() {

    console.debug(typeof Select);

    var block1 = Select('#block1'); // selection of one element by its ID
    _write('block1', 'console');

    var block2 = $.select('#block2'); // selection of one element by its ID
    _write('block2', 'console');

    var dblock1 = $.select('#block1'); // selection of one element by its ID
    _write('dblock1', 'console');
    var dallblocks = $.select('.allblocks'); // selection of a set of elements by their class
    _write('dallblocks', 'console');
    var dcontent1 = $.select('#block1 .content'); // selection of one element by class in an element with its ID
    _write('dcontent1', 'console');
    var dlinks = $.select('a'); // selection of a set of elements by tag name
    _write('dlinks', 'console');
    var dlinks_class = $.select('a .link'); // selection of a set of elements by tag name and filter by class
    _write('dlinks_class', 'console');

    dlinks_class
        .each(function(i, obj){
            console.debug( obj.getAttribute('href') );
        })
        .each('callbackTest');

});
</script>
<script language="Javascript" type="text/javascript">
</script>
</head>

<body>
	<p>This page provides tests of the javascript framework '<strong>Piwi</strong>'; information is written in console.</p>
	<hr />
	    <br />
        <h3>JS console</h3>
        <div id="console"></div>
	    <br />
	<hr />
	    <br />

<h3>Maecenas libero lectus, eleifend congue</h3>
<div id="block1" class="blockclass1 allblocks">
	<p class="content">Nullam elit orci, posuere vel, imperdiet ac, interdum vitae, tellus. Etiam nisl. Mauris iaculis erat eu nisi gravida accumsan. Pellentesque pharetra. Fusce in quam nec ante euismod cursus. Etiam diam. Proin aliquam, nibh malesuada fringilla blandit, ante <a href="http://example.com" class="link">orci feugiat sem, ut vehicula risus mauris non augue.</a> Etiam dapibus elit ac massa. Praesent vitae metus. In sed augue. Suspendisse potenti. Vivamus lacinia justo ullamcorper arcu. Duis accumsan urna tempus dolor. Morbi felis. Nullam tortor urna, tincidunt tincidunt, luctus sodales, facilisis in, felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec in tellus.</p>
</div>
<div id="block2" class="blockclass2 allblocks">
	<p class="content">Nullam elit orci, posuere vel, imperdiet ac, interdum vitae, tellus. Etiam nisl. Mauris iaculis erat eu nisi gravida accumsan. Pellentesque pharetra. Fusce in quam nec ante euismod cursus. Etiam diam. Proin aliquam, nibh malesuada fringilla blandit, ante <a href="http://example.com" class="link">orci feugiat sem, ut vehicula risus mauris non augue.</a> Etiam dapibus elit ac massa. Praesent vitae metus. In sed augue. Suspendisse potenti. Vivamus lacinia justo ullamcorper arcu. Duis accumsan urna tempus dolor. Morbi felis. Nullam tortor urna, tincidunt tincidunt, luctus sodales, facilisis in, felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec in tellus.</p>
</div>
<div id="block3" class="blockclass3 allblocks">
	<p class="content">Nullam elit orci, posuere vel, imperdiet ac, interdum vitae, tellus. Etiam nisl. Mauris iaculis erat eu nisi gravida accumsan. Pellentesque pharetra. Fusce in quam nec ante euismod cursus. Etiam diam. Proin aliquam, nibh malesuada fringilla blandit, ante <a href="http://example.com" class="link">orci feugiat sem, ut vehicula risus mauris non augue.</a> Etiam dapibus elit ac massa. Praesent vitae metus. In sed augue. Suspendisse potenti. Vivamus lacinia justo ullamcorper arcu. Duis accumsan urna tempus dolor. Morbi felis. Nullam tortor urna, tincidunt tincidunt, luctus sodales, facilisis in, felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec in tellus.</p>
</div>

<h3>Maecenas libero lectus, eleifend congue</h3>
<div id="block4" style="font-size:1.1em;">
	<p>hendrerit eu, posuere accumsan, magna. Aenean euismod. Donec lobortis vestibulum sapien. Morbi pharetra ipsum ac nibh. Vestibulum quis mauris. Duis pulvinar lectus quis lectus. In hac habitasse platea dictumst Ut consequat, nunc vel dictu<strong>m faucibus, ante quam iaculis</strong> mi, sed gravida neque justo eu tellus. Sed vel massa vel orci laoreet luctus. Nulla facilisi. In risus. Cras et quam. Praesent sit amet mi. Maecenas consequat. Pellentesque consectetuer. Integer at urna non erat dapibus vehicula. Phasellus eu magna. In purus erat, consequat nec, <i>ultrices a, sollicitudin id, leo.</i></p>
	<p>Integer ultricies fringilla nunc. Fusce tempor augue vel tortor. Nullam at ante. Mauris faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque sodales interdum augue. Vivamus tempor viverra lacus. Mauris rutrum augue sit amet nisi. Mauris eleifend euismod sapien. In augue dui, dictum id, lobortis ac, aliquet in, libero.</p>
	<p>Proin ornare ligula vitae tellus. Pellentesque risus felis, tempus eget, placerat et, elementum at, ipsum. Suspendisse faucibus gravida quam. Fusce odio. Maecenas mattis pharetra felis. Nam in nunc vitae velit vehicula suscipit. Duis accumsan, lorem non tristique rhoncus, lacus purus imperdiet nunc, eget feugiat augue metus eget justo. Donec quis dui a dui condimentum egestas. Nullam eget arcu. In placerat pulvinar lacus.</p>
	<p>Fusce lacinia. Nullam laoreet ligula in pede. Vestibulum nunc purus, venenatis quis, blandit eget, congue at, risus. Sed orci. Nulla facilisi. Vestibulum vitae sem. Integer dignissim tortor vitae sem. Donec quis sapien. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas nonummy semper felis.</p>
	<p>Nunc non nibh. Suspendisse potenti. Mauris elementum interdum nunc. Donec sit amet tortor. Morbi vehicula mauris at odio. Maecenas commodo ultricies orci. Vivamus varius quam. Aenean auctor lorem sit amet magna. Fusce quis tellus. Vestibulum placerat vulputate lorem. Nulla elementum mattis nisi. Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.</p>
	<p>Nullam elit orci, posuere vel, imperdiet ac, interdum vitae, tellus. Etiam nisl. Mauris iaculis erat eu nisi gravida accumsan. Pellentesque pharetra. Fusce in quam nec ante euismod cursus. Etiam diam. Proin aliquam, nibh malesuada fringilla blandit, ante <a href="http://example.com">orci feugiat sem, ut vehicula risus mauris non augue.</a> Etiam dapibus elit ac massa. Praesent vitae metus. In sed augue. Suspendisse potenti. Vivamus lacinia justo ullamcorper arcu. Duis accumsan urna tempus dolor. Morbi felis. Nullam tortor urna, tincidunt tincidunt, luctus sodales, facilisis in, felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec in tellus.</p>
	<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce pede nisl, suscipit id, bibendum vel, euismod a, urna. Aliquam ut arcu. Nulla ullamcorper mauris ut velit. Etiam consectetuer ipsum id ligula. Nam euismod ipsum vitae felis. Quisque pede ante, pretium et, fermentum vel, tempor eget, dolor. Phasellus eu pede. Suspendisse bibendum, ligula at porta convallis, lacus mauris egestas risus, vitae scelerisque ante mauris a erat. Aenean varius ligula sed dui. Etiam pellentesque facilisis eros. In interdum orci. In augue pede, hendrerit ac, facilisis ut, convallis luctus, sapien. Nulla metus. Vestibulum neque justo, convallis eu, varius egestas, posuere eu, libero. Pellentesque nec elit nec diam commodo euismod. Aliquam aliquet convallis est. Integer consectetuer nibh non urna. Nam ultrices mauris.</p>
</div>

</body>
</html>