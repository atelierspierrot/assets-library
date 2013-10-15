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
require_once __DIR__.'/../../assets-library.php';

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
<title>Test of Nodes javascript functions</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- Requirements -->
<script type="text/javascript" src="<?php echo build_requirements('js', $requirements['js']); ?>"></script>
<link href="<?php echo build_requirements('css', $requirements['css']); ?>" media="screen" rel="stylesheet" type="text/css" />

<!-- Node -->
<script type="text/javascript" src="classes.js"></script>  
<script type="text/javascript" src="select.js"></script>  

<script language="Javascript" type="text/javascript">

function add_red_class() {
	addClassName(
		document.getElementById('block2'),
		'red'
	);
}

function remove_red_class() {
	removeClassName(
		document.getElementById('block2'),
		'red'
	);
}

function test_class( _cls ) {
	var _ok = hasClassName(
		document.getElementById('block1'),
		_cls
	);
	document.getElementById('block1_test_answer').innerHTML = _ok;
}

function error_add_red_class() {
	addClassName(
		'block2',
		'red'
	);
}

function error_remove_red_class() {
	removeClassName(
		document.getElementById('block2')
	);
}

function error_test_class( _cls ) {
	var _ok = hasClassName(
		'block3',
		_cls
	);
	document.getElementById('block3_test_answer').innerHTML = _ok;
}

</script>
<style type="text/css">
.floated { float: left; width: 260px; margin-left: 40px; }

.red { color: red; }

</style>
</head>

<body>
	<p>This page provides tests of the javascript function '<strong>Nodes</strong>'; information is written in console.</p>
	<hr />

<h3>Maecenas libero lectus, eleifend congue</h3>
<p><a href="javascript:test_class('my_class');">Does content below have class "my_class"</a> (must be YES)&nbsp;|&nbsp;<a href="javascript:test_class('another_class');">Does content below have class "another_class"</a> (must be NO)</p>
<p id="block1_test_answer"></p>
<div id="block1" class="my_class">
	<p>hendrerit eu, posuere accumsan, magna. Aenean euismod. Donec lobortis vestibulum sapien. Morbi pharetra ipsum ac nibh. Vestibulum quis mauris. Duis pulvinar lectus quis lectus. In hac habitasse platea dictumst Ut consequat, nunc vel dictu<strong>m faucibus, ante quam iaculis</strong> mi, sed gravida neque justo eu tellus. Sed vel massa vel orci laoreet luctus. Nulla facilisi. In risus. Cras et quam. Praesent sit amet mi. Maecenas consequat. Pellentesque consectetuer. Integer at urna non erat dapibus vehicula. Phasellus eu magna. In purus erat, consequat nec, <i>ultrices a, sollicitudin id, leo.</i></p>
	<p>Integer ultricies fringilla nunc. Fusce tempor augue vel tortor. Nullam at ante. Mauris faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque sodales interdum augue. Vivamus tempor viverra lacus. Mauris rutrum augue sit amet nisi. Mauris eleifend euismod sapien. In augue dui, dictum id, lobortis ac, aliquet in, libero.</p>
	<p>Proin ornare ligula vitae tellus. Pellentesque risus felis, tempus eget, placerat et, elementum at, ipsum. Suspendisse faucibus gravida quam. Fusce odio. Maecenas mattis pharetra felis. Nam in nunc vitae velit vehicula suscipit. Duis accumsan, lorem non tristique rhoncus, lacus purus imperdiet nunc, eget feugiat augue metus eget justo. Donec quis dui a dui condimentum egestas. Nullam eget arcu. In placerat pulvinar lacus.</p>
</div>

<h3>Nunc in ipsum. Mauris id ante.</h3> 
<p><a href="javascript:add_red_class();">Add the "red" class to content below</a>&nbsp;|&nbsp;<a href="javascript:remove_red_class();">Remove the "red" class from content below</a></p>
<div id="block2">
	<p>Fusce lacinia. Nullam laoreet ligula in pede. Vestibulum nunc purus, venenatis quis, blandit eget, congue at, risus. Sed orci. Nulla facilisi. Vestibulum vitae sem. Integer dignissim tortor vitae sem. Donec quis sapien. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas nonummy semper felis.</p>
	<p>Nunc non nibh. Suspendisse potenti. Mauris elementum interdum nunc. Donec sit amet tortor. Morbi vehicula mauris at odio. Maecenas commodo ultricies orci. Vivamus varius quam. Aenean auctor lorem sit amet magna. Fusce quis tellus. Vestibulum placerat vulputate lorem. Nulla elementum mattis nisi. Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.</p>
</div>

<h3>Tests with errors in arguments</h3> 
<p><a href="javascript:error_add_red_class();">Add the "red" class to content below</a>&nbsp;|&nbsp;<a href="javascript:error_remove_red_class();">Remove the "red" class from content below</a></p>
<p><a href="javascript:error_test_class('my_class');">Does content below have class "my_class"</a>&nbsp;|&nbsp;<a href="javascript:error_test_class('another_class');">Does content below have class "another_class"</a></p>
<p id="block3_test_answer"></p>
<div id="block3" class="test hide">
	<p>Nullam elit orci, posuere vel, imperdiet ac, interdum vitae, tellus. Etiam nisl. Mauris iaculis erat eu nisi gravida accumsan. Pellentesque pharetra. Fusce in quam nec ante euismod cursus. Etiam diam. Proin aliquam, nibh malesuada fringilla blandit, ante <a href="http://example.com">orci feugiat sem, ut vehicula risus mauris non augue.</a> Etiam dapibus elit ac massa. Praesent vitae metus. In sed augue. Suspendisse potenti. Vivamus lacinia justo ullamcorper arcu. Duis accumsan urna tempus dolor. Morbi felis. Nullam tortor urna, tincidunt tincidunt, luctus sodales, facilisis in, felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec in tellus.</p>
	<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce pede nisl, suscipit id, bibendum vel, euismod a, urna. Aliquam ut arcu. Nulla ullamcorper mauris ut velit. Etiam consectetuer ipsum id ligula. Nam euismod ipsum vitae felis. Quisque pede ante, pretium et, fermentum vel, tempor eget, dolor. Phasellus eu pede. Suspendisse bibendum, ligula at porta convallis, lacus mauris egestas risus, vitae scelerisque ante mauris a erat. Aenean varius ligula sed dui. Etiam pellentesque facilisis eros. In interdum orci. In augue pede, hendrerit ac, facilisis ut, convallis luctus, sapien. Nulla metus. Vestibulum neque justo, convallis eu, varius egestas, posuere eu, libero. Pellentesque nec elit nec diam commodo euismod. Aliquam aliquet convallis est. Integer consectetuer nibh non urna. Nam ultrices mauris.</p>
</div>

<hr style="clear: both" />

<div id="block_s1" class="blockclass1 allblocks">
	<p class="content">Nullam elit orci, posuere vel, imperdiet ac, interdum vitae, tellus. Etiam nisl. Mauris iaculis erat eu nisi gravida accumsan. Pellentesque pharetra. Fusce in quam nec ante euismod cursus. Etiam diam. Proin aliquam, nibh malesuada fringilla blandit, ante <a href="http://example.com" class="link">orci feugiat sem, ut vehicula risus mauris non augue.</a> Etiam dapibus elit ac massa. Praesent vitae metus. In sed augue. Suspendisse potenti. Vivamus lacinia justo ullamcorper arcu. Duis accumsan urna tempus dolor. Morbi felis. Nullam tortor urna, tincidunt tincidunt, luctus sodales, facilisis in, felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec in tellus.</p>
</div>
<div id="block_s2" class="blockclass2 allblocks">
	<p class="content">Nullam elit orci, posuere vel, imperdiet ac, interdum vitae, tellus. Etiam nisl. Mauris iaculis erat eu nisi gravida accumsan. Pellentesque pharetra. Fusce in quam nec ante euismod cursus. Etiam diam. Proin aliquam, nibh malesuada fringilla blandit, ante <a href="http://example.com" class="link">orci feugiat sem, ut vehicula risus mauris non augue.</a> Etiam dapibus elit ac massa. Praesent vitae metus. In sed augue. Suspendisse potenti. Vivamus lacinia justo ullamcorper arcu. Duis accumsan urna tempus dolor. Morbi felis. Nullam tortor urna, tincidunt tincidunt, luctus sodales, facilisis in, felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec in tellus.</p>
</div>
<div id="block_s3" class="blockclass3 allblocks">
	<p class="content">Nullam elit orci, posuere vel, imperdiet ac, interdum vitae, tellus. Etiam nisl. Mauris iaculis erat eu nisi gravida accumsan. Pellentesque pharetra. Fusce in quam nec ante euismod cursus. Etiam diam. Proin aliquam, nibh malesuada fringilla blandit, ante <a href="http://example.com" class="link">orci feugiat sem, ut vehicula risus mauris non augue.</a> Etiam dapibus elit ac massa. Praesent vitae metus. In sed augue. Suspendisse potenti. Vivamus lacinia justo ullamcorper arcu. Duis accumsan urna tempus dolor. Morbi felis. Nullam tortor urna, tincidunt tincidunt, luctus sodales, facilisis in, felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec in tellus.</p>
</div>

<script language="Javascript" type="text/javascript">
var block1 = Select('#block_s1'); // selection of one element by its ID
console.debug(block1);
var allblocks = Select('.allblocks'); // selection of a set of elements by their class
console.debug(allblocks);
var content1 = Select('#block_s1 .content'); // selection of one element by class in an element with its ID
console.debug(content1);
var links = Select('a'); // selection of a set of elements by tag name
console.debug(links);
var links_class = Select('a .link'); // selection of a set of elements by tag name and filter by class
console.debug(links_class);
</script>

</body>
</html>