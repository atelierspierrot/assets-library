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
require_once __DIR__.'/../../assets-library.php';

$requirements = array(
    'js'=>array(
    ),
    'css'=>array(
        'commons'
    ),
);

?><html>
<head>
<title>Test of CSS MESSAGES</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<!-- Requirements -->
<link href="<?php echo build_requirements_url('css', $requirements['css']); ?>" media="screen" rel="stylesheet" type="text/css" />

<script language="Javascript" type="text/javascript">
</script>
<style type="text/css">

.message.message-icon {
    background: #eee url("<?php echo _ASSETSLIB_IMG_HTTP; ?>/help.png") no-repeat 14px center;
    padding-left: 44px;
}

.message.message-icon.ok {
    background-color: #e0f2cb;
    background-image: url("<?php echo _ASSETSLIB_IMG_HTTP; ?>/tick.png");
}

.message.message-icon.error {
    background-color: #fbd3b1;
    background-image: url("<?php echo _ASSETSLIB_IMG_HTTP; ?>/exclamation.png");
}

.message.message-icon.info {
    background-color: #e4edf5;
    background-image: url("<?php echo _ASSETSLIB_IMG_HTTP; ?>/information.png");
}

.message.message-icon.warning {
    background-color: #fff4cc;
    background-image: url("<?php echo _ASSETSLIB_IMG_HTTP; ?>/error.png");
}
</style>
</head>

<body>
	<p>This page provides tests of the CSS '<strong>messages</strong>' construction.</p>
	<hr />

<h3>Base message box</h3>

<div class="message">
    <p class="title">message</p>
	<p>Nunc non nibh. Suspendisse potenti. Mauris elementum interdum nunc. <a href="#">Donec sit amet tortor.</a> Morbi vehicula mauris at odio. Maecenas commodo ultricies orci. Vivamus varius quam. Aenean auctor lorem sit amet magna. Fusce quis tellus. Vestibulum placerat vulputate lorem. Nulla elementum mattis nisi. Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.</p>
</div>

<div class="message message-icon">
    <p class="title">message icon</p>
	<p>Nunc non nibh. Suspendisse potenti. Mauris elementum interdum nunc. <a href="#">Donec sit amet tortor.</a> Morbi vehicula mauris at odio. Maecenas commodo ultricies orci. Vivamus varius quam. Aenean auctor lorem sit amet magna. Fusce quis tellus. Vestibulum placerat vulputate lorem. Nulla elementum mattis nisi. Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.</p>
</div>

<br class="clear" />
<h3>Predefined messages</h3>

<div class="message ok">
    <p class="title">OK message</p>
	<p>Nunc non nibh. Suspendisse potenti. Mauris elementum interdum nunc. <a href="#">Donec sit amet tortor.</a> Morbi vehicula mauris at odio. Maecenas commodo ultricies orci. Vivamus varius quam. Aenean auctor lorem sit amet magna. Fusce quis tellus. Vestibulum placerat vulputate lorem. Nulla elementum mattis nisi. Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.</p>
</div>

<div class="message info">
    <p class="title">Info message</p>
	<p>Nunc non nibh. Suspendisse potenti. Mauris elementum interdum nunc. <a href="#">Donec sit amet tortor.</a> Morbi vehicula mauris at odio. Maecenas commodo ultricies orci. Vivamus varius quam. Aenean auctor lorem sit amet magna. Fusce quis tellus. Vestibulum placerat vulputate lorem. Nulla elementum mattis nisi. Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.</p>
</div>

<div class="message error">
    <p class="title">Error message</p>
	<p>Nunc non nibh. Suspendisse potenti. Mauris elementum interdum nunc. <a href="#">Donec sit amet tortor.</a> Morbi vehicula mauris at odio. Maecenas commodo ultricies orci. Vivamus varius quam. Aenean auctor lorem sit amet magna. Fusce quis tellus. Vestibulum placerat vulputate lorem. Nulla elementum mattis nisi. Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.</p>
</div>

<div class="message warning">
    <p class="title">Warning message</p>
	<p>Nunc non nibh. Suspendisse potenti. Mauris elementum interdum nunc. <a href="#">Donec sit amet tortor.</a> Morbi vehicula mauris at odio. Maecenas commodo ultricies orci. Vivamus varius quam. Aenean auctor lorem sit amet magna. Fusce quis tellus. Vestibulum placerat vulputate lorem. Nulla elementum mattis nisi. Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.</p>
</div>

<br class="clear" />
<h3>Predefined messages with icons</h3>

<div class="message message-icon ok">
    <p class="title">OK message</p>
	<p>Nunc non nibh. Suspendisse potenti. Mauris elementum interdum nunc. <a href="#">Donec sit amet tortor.</a> Morbi vehicula mauris at odio. Maecenas commodo ultricies orci. Vivamus varius quam. Aenean auctor lorem sit amet magna. Fusce quis tellus. Vestibulum placerat vulputate lorem. Nulla elementum mattis nisi. Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.</p>
</div>

<div class="message message-icon info">
    <p class="title">Info message</p>
	<p>Nunc non nibh. Suspendisse potenti. Mauris elementum interdum nunc. <a href="#">Donec sit amet tortor.</a> Morbi vehicula mauris at odio. Maecenas commodo ultricies orci. Vivamus varius quam. Aenean auctor lorem sit amet magna. Fusce quis tellus. Vestibulum placerat vulputate lorem. Nulla elementum mattis nisi. Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.</p>
</div>

<div class="message message-icon error">
    <p class="title">Error message</p>
	<p>Nunc non nibh. Suspendisse potenti. Mauris elementum interdum nunc. <a href="#">Donec sit amet tortor.</a> Morbi vehicula mauris at odio. Maecenas commodo ultricies orci. Vivamus varius quam. Aenean auctor lorem sit amet magna. Fusce quis tellus. Vestibulum placerat vulputate lorem. Nulla elementum mattis nisi. Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.</p>
</div>

<div class="message message-icon warning">
    <p class="title">Warning message</p>
	<p>Nunc non nibh. Suspendisse potenti. Mauris elementum interdum nunc. <a href="#">Donec sit amet tortor.</a> Morbi vehicula mauris at odio. Maecenas commodo ultricies orci. Vivamus varius quam. Aenean auctor lorem sit amet magna. Fusce quis tellus. Vestibulum placerat vulputate lorem. Nulla elementum mattis nisi. Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.</p>
</div>

<br class="clear" />

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

<br class="clear" />
<h3>Tests of messages</h3>

<div class="message message-icon ok">
	<p>Nunc non nibh. Suspendisse potenti. Mauris elementum interdum nunc. <a href="#">Donec sit amet tortor.</a></p>
</div>

<div class="message message-icon info">
    <p class="title">Info message</p>
</div>

<div class="message error">
	<p>Nunc non nibh. Suspendisse potenti.</p>
</div>

<div class="message message-icon warning">
	<p>Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.</p>
</div>

<div class="message message-icon warning">
	Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.
</div>

<br class="clear" />

<h3>Maecenas libero lectus, eleifend congue</h3>
<div>
	<p>hendrerit eu, posuere accumsan, magna. Aenean euismod. Donec lobortis vestibulum sapien. Morbi pharetra ipsum ac nibh. Vestibulum quis mauris. Duis pulvinar lectus quis lectus. In hac habitasse platea dictumst. Ut consequat, nunc vel dictu<strong>m faucibus, ante quam iaculis</strong> mi, sed gravida neque justo eu tellus. Sed vel massa vel orci laoreet luctus. Nulla facilisi. In risus. Cras et quam. Praesent sit amet mi. Maecenas consequat. Pellentesque consectetuer. Integer at urna non erat dapibus vehicula. Phasellus eu magna. In purus erat, consequat nec, <i>ultrices a, sollicitudin id, leo.</i></p>
	<p>Integer ultricies fringilla nunc. Fusce tempor augue vel tortor. Nullam at ante. Mauris faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque sodales interdum augue. Vivamus  tempor viverra lacus. Mauris rutrum augue sit amet nisi. Mauris eleifend euismod sapien. In augue dui, dictum id, lobortis ac, aliquet in, libero.</p>
</div>

</body>
</html>