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
<title>Test of Tooltips javascript functions</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- Requirements -->
<script type="text/javascript" src="<?php echo build_requirements_url('js', $requirements['js']); ?>"></script>
<link href="<?php echo build_requirements_url('css', $requirements['css']); ?>" media="screen" rel="stylesheet" type="text/css" />

<!-- Preset "tooltips" -->
<script type="text/javascript" src="<?php echo build_preset_url('js', 'tooltips'); ?>"></script>
<link href="<?php echo build_preset_url('css', 'tooltips'); ?>" media="screen" rel="stylesheet" type="text/css" />

<script language="Javascript" type="text/javascript">

onDocumentLoad(function() {
    init_tooltips();
    init_tooltips_help();
    init_tooltips_input();
});

function init_tooltips() {
    return new TOOLTIP({
        classname: 'ttlp',
        attribute: 'data-tooltip',
        wrapper_class: 'ttlp',
        content_class: 'ttlp_content'
    });
}

function init_tooltips_help() {
    return new TOOLTIP({
        classname: 'tooltip_help',
        wrapper_class: 'ttlp_help',
        content_class: 'ttlp_help_content'
    });
}

function init_tooltips_input() {
    return new TOOLTIP({
        classname: 'input_ttlp',
        wrapper_class: 'ttlp_help',
        content_class: 'ttlp_help_content',
        fixed: true
    });
}

</script>
<style type="text/css">

body { font-size: 80%; font-family: 'Lucida Grande', Verdana, Arial, Sans-Serif; }

.ttlp_content {
    padding:6px;
    margin-left:5px;
    background:#eee;
    color:#404040;
    -moz-border-radius-topleft: 4px;
    -moz-border-radius-topright: 4px;
    -moz-border-radius-bottomright: 4px;
    -moz-border-radius-bottomleft: 4px;
    border-top-left-radius:4px;
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
    border-bottom-left-radius: 4px; 
}

.ttlp_content p, .ttlp_content h1,
.ttlp_content table, .ttlp_content th, .ttlp_content td
{
    color:#404040; font-size: 1em;
}

.ttlp_help_content {
    padding:6px;
    margin-left:5px;
    background:#fff;
    border: 1px dotted #ccc;
    color:#404040;
    -moz-border-radius-topleft: 4px;
    -moz-border-radius-topright: 4px;
    -moz-border-radius-bottomright: 4px;
    -moz-border-radius-bottomleft: 4px;
    border-top-left-radius:4px;
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
    border-bottom-left-radius: 4px; 
}

.ttlp_help_content p, .ttlp_help_content h1,
.ttlp_help_content table, .ttlp_help_content th, .ttlp_help_content td
{
    color:#404040; font-size: 1em;
}

</style>
</head>
<?php

$GLOBALS['test_strings'] = array(
    'Testing 123 <strong>Testing 123</strong>',
    'Testing 123<br />Testing 123',
    '<img src="http://upload.wikimedia.org/wikipedia/commons/7/70/Example.png" />',
    '<strong>Lorem ipsum dolor sit amet</strong><br />Consectetuer adipiscing elit. Praesent lacinia, dui ut consequat bibendum, lorem dolor tristique tellus, at faucibus nibh est in orci. In pede.',
    '<h3>Lorem ipsum dolor sit amet</h3><p>Consectetuer adipiscing elit. Praesent lacinia, dui ut consequat bibendum, lorem dolor tristique tellus, at faucibus nibh est in orci. In pede.</p><p>Fusce lacinia. Nullam laoreet ligula in pede. Vestibulum nunc purus, venenatis quis, blandit eget, congue at, risus. Sed orci. Nulla facilisi. Vestibulum vitae sem. Integer dignissim tortor vitae sem. Donec quis sapien. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas nonummy semper felis.</p>',
    '<table><tr><th>First row</th><th>Second row</th></tr><tr><td>Title</td><td>Value</td></tr><tr><td>Title</td><td>Value</td></tr><tr><td>Title</td><td>Value</td></tr><tr><td>Title</td><td>Value</td></tr><tr><td>Title</td><td>Value</td></tr><tr><td>Title</td><td>Value</td></tr></table>',
);

function getSampleString()
{
    return protectString(
        $GLOBALS['test_strings'][ array_rand($GLOBALS['test_strings']) ], true
    );
}

function protectString( $string, $protect_quotes=false )
{
    $string = preg_replace('/\s\s+/', ' ', $string);
    $string = htmlentities($string);
    if (true===$protect_quotes)
    {
        $string = str_replace("'", "\'", $string);
        $string = str_replace('"', '\"', $string);
    }
    return $string;
}

?>
<body>
    <p>This page provides tests of the javascript function '<strong>tooltips</strong>'; information is written in console.</p>
    <p><a href="test.php">Page 1</a></p>
    <hr />

<h3>Tests with a fixed tooltip on inputs.</h3>
<div>
    <p>Integer ultricies fringilla nunc. Fusce tempor augue vel tortor. Nullam at ante. Mauris faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque sodales interdum augue. Vivamus  tempor viverra lacus. Mauris rutrum augue sit amet nisi. Mauris eleifend euismod sapien. In augue dui, dictum id, lobortis ac, aliquet in, libero.</p>
    <p>Proin ornare ligula vitae tellus. Pellentesque risus felis, tempus eget, placerat et, elementum at, ipsum. Suspendisse faucibus gravida quam. Fusce odio. Maecenas mattis pharetra felis. Nam in nunc vitae velit vehicula suscipit. Duis accumsan, lorem non tristique rhoncus, lacus purus imperdiet nunc, eget feugiat augue metus eget justo. Donec quis dui a dui condimentum egestas.  Nullam eget arcu. In placerat pulvinar lacus.</p>
    <p>Integer ultricies fringilla nunc. Fusce tempor augue vel tortor.
        <label>My input with fixed tooltip on the left : <input type="text" name="myinput" value="" class="input_ttlp tooltip_l" title="<?php echo getSampleString(); ?>" /></label>
    </p>
    <p>Integer ultricies fringilla nunc. Fusce tempor augue vel tortor.
        <label>My input with fixed tooltip on the right : <input type="text" name="myinput" value="" class="input_ttlp tooltip_r" title="<?php echo getSampleString(); ?>" /></label>
    </p>
    <p>Integer ultricies fringilla nunc. Fusce tempor augue vel tortor.
        <label>My input with fixed tooltip on bottom : <input type="text" name="myinput" value="" class="input_ttlp tooltip_b" title="<?php echo getSampleString(); ?>" /></label>
    </p>
    <p>Integer ultricies fringilla nunc. Fusce tempor augue vel tortor.
        <label>My input with fixed tooltip on top : <input type="text" name="myinput" value="" class="input_ttlp tooltip_t" title="<?php echo getSampleString(); ?>" /></label>
    </p>
    <p>Integer ultricies fringilla nunc. Fusce tempor augue vel tortor. Nullam at ante. Mauris faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque sodales interdum augue. Vivamus  tempor viverra lacus. Mauris rutrum augue sit amet nisi. Mauris eleifend euismod sapien. In augue dui, dictum id, lobortis ac, aliquet in, libero.</p>
    <p>Proin ornare ligula vitae tellus. Pellentesque risus felis, tempus eget, placerat et, elementum at, ipsum. Suspendisse faucibus gravida quam. Fusce odio. Maecenas mattis pharetra felis. Nam in nunc vitae velit vehicula suscipit. Duis accumsan, lorem non tristique rhoncus, lacus purus imperdiet nunc, eget feugiat augue metus eget justo. Donec quis dui a dui condimentum egestas.  Nullam eget arcu. In placerat pulvinar lacus.</p>
</div>

    <hr />

<p>Tests with custom classes and HTML5 feature "data-tooltip" for tooltips content.</p>

<h3>Test of tooltips with default positioning (top left)</h3>
<div id="block1">
    <p>Lorem ipsum dolor sit amet,
        <a href="#" class="ttlp" data-tooltip="<?php echo getSampleString(); ?>">consectetuer adipiscing</a>
         elit. Aliquam id tellus. Nulla orci enim, vulputate et, pharetra eget, imperdiet non, sem. Mauris sit amet mi nec nulla porttitor dapibus. Curabitur leo sem, lacinia sed, commodo eu, mattis sit amet, felis. Ut tortor. Donec 
         <a href="#" class="ttlp" data-tooltip="<?php echo getSampleString(); ?>">porttitor orci</a>
          et neque. Curabitur eget diam at libero egestas suscipit. In tortor est, ullamcorper eu, dapibus et, condimentum nec, nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis vel 
          <a href="#" class="ttlp" data-tooltip="<?php echo getSampleString(); ?>">purus eget diam</a> 
          aliquam luctus. Nullam risus ipsum, aliquam et, lacinia sit amet, fermentum vel, mi. In hac habitasse platea dictumst. Maecenas et dui non tortor lobortis feugiat. Donec eleifend iaculis arcu. Cras vitae leo nec nunc rhoncus laoreet. Integer eget enim. Nunc 
          <a href="#" class="ttlp" data-tooltip="<?php echo getSampleString(); ?>">dignissim cursus</a> 
          mi. Donec eros.</p>
    <p>Proin ornare ligula vitae tellus. Pellentesque risus felis, tempus eget, placerat et, elementum at, ipsum. 
        <a href="#" class="ttlp" data-tooltip="<?php echo getSampleString(); ?>">Suspendisse faucibus gravida quam</a>
        . Fusce odio. Maecenas mattis pharetra felis. Nam in nunc 
        <a href="#" class="ttlp" data-tooltip="<?php echo getSampleString(); ?>">vitae velit vehicula suscipit</a>
        . Duis accumsan, lorem non tristique rhoncus, lacus purus imperdiet nunc, eget feugiat augue metus eget justo. Donec quis dui a dui condimentum egestas.  Nullam eget arcu. In placerat pulvinar lacus.</p>
    <p>Fusce lacinia. Nullam laoreet ligula in pede. Vestibulum nunc purus, 
        <a href="#" class="ttlp" data-tooltip="<?php echo getSampleString(); ?>">venenatis quis</a>
        , blandit eget, congue at, risus. Sed orci. Nulla facilisi. Vestibulum vitae sem. Integer dignissim tortor vitae sem. Donec quis sapien. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas nonummy semper felis.</p>
</div>

<h3>Test of tooltips with positioning</h3>
<div id="block2">
    <p>Lorem ipsum dolor sit amet,
        <a href="#" class="ttlp tooltip_bl" data-tooltip="<?php echo getSampleString(); ?>">[bottom left] consectetuer adipiscing</a>
         elit. Aliquam id tellus. Nulla orci enim, vulputate et, pharetra eget, imperdiet non, sem. Mauris sit amet mi nec nulla porttitor dapibus. Curabitur leo sem, lacinia sed, commodo eu, mattis sit amet, felis. Ut tortor. Donec 
         <a href="#" class="ttlp tooltip_br" data-tooltip="<?php echo getSampleString(); ?>">[bottom right] porttitor orci</a>
          et neque. Curabitur eget diam at libero egestas suscipit. In tortor est, ullamcorper eu, dapibus et, condimentum nec, nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis vel 
          <a href="#" class="ttlp tooltip_tl" data-tooltip="<?php echo getSampleString(); ?>">[top left] purus eget diam</a> 
          aliquam luctus. Nullam risus ipsum, aliquam et, lacinia sit amet, fermentum vel, mi. In hac habitasse platea dictumst. Maecenas et dui non tortor lobortis feugiat. Donec eleifend iaculis arcu. Cras vitae leo nec nunc rhoncus laoreet. Integer eget enim. Nunc 
          <a href="#" class="ttlp tooltip_tr" data-tooltip="<?php echo getSampleString(); ?>">[top right] dignissim cursus</a> 
          mi. Donec eros.</p>
    <p>Nunc non nibh. Suspendisse potenti. Mauris elementum interdum nunc. Donec sit amet tortor. Morbi vehicula mauris at odio. Maecenas commodo ultricies orci. Vivamus varius quam. Aenean auctor lorem sit amet magna. Fusce quis tellus. Vestibulum placerat vulputate lorem. Nulla elementum mattis nisi. Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.</p>
</div>

<hr style="clear: both" />

<h3>Test of helper tooltip</h3>
<div>
    <img src="img/help.png" class="tooltip_help" title="<?php echo getSampleString(); ?>" />
    <p>Lorem ipsum dolor sit amet,
        <a href="#" class="ttlp tooltip_bl" data-tooltip="<?php echo getSampleString(); ?>">[bottom left] consectetuer adipiscing</a>
         elit. Aliquam id tellus. Nulla orci enim, vulputate et, pharetra eget, imperdiet non, sem. Mauris sit amet mi nec nulla porttitor dapibus. Curabitur leo sem, lacinia sed, commodo eu, mattis sit amet, felis. Ut tortor. Donec 
         <a href="#" class="ttlp tooltip_br" data-tooltip="<?php echo getSampleString(); ?>">[bottom right] porttitor orci</a>
          et neque. Curabitur eget diam at libero egestas suscipit. In tortor est, ullamcorper eu, dapibus et, condimentum nec, nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis vel 
          <a href="#" class="ttlp tooltip_tl" data-tooltip="<?php echo getSampleString(); ?>">[top left] purus eget diam</a> 
          aliquam luctus. Nullam risus ipsum, aliquam et, lacinia sit amet, fermentum vel, mi. In hac habitasse platea dictumst. Maecenas et dui non tortor lobortis feugiat. Donec eleifend iaculis arcu. Cras vitae leo nec nunc rhoncus laoreet. Integer eget enim. Nunc 
          <a href="#" class="ttlp tooltip_tr" data-tooltip="<?php echo getSampleString(); ?>">[top right] dignissim cursus</a> 
          mi. Donec eros.</p>
    <p>Fusce lacinia. Nullam laoreet ligula in pede. Vestibulum nunc purus, venenatis quis, blandit eget, congue at, risus. Sed orci. Nulla facilisi. Vestibulum vitae sem. Integer dignissim tortor vitae sem. Donec quis sapien. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas nonummy semper felis.</p>
    <p>Nunc non nibh. Suspendisse potenti. Mauris elementum interdum nunc. Donec sit amet tortor. Morbi vehicula mauris at odio. Maecenas commodo ultricies orci. Vivamus varius quam. Aenean auctor lorem sit amet magna. Fusce quis tellus. Vestibulum placerat vulputate lorem. Nulla elementum mattis nisi. Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.</p>
</div>


<hr style="clear: both" />

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