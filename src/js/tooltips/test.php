<?php
/**
 * This file is part of the AssetsLibrary package.
 * The open source PHP/JavaScript/CSS library of Les Ateliers Pierrot.
 *
 * Copyleft (ↄ) 2013-2015 Pierre Cassat <me@e-piwi.fr> and contributors
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * The source code of this package is available online at 
 * <http://github.com/atelierspierrot/assets-library>.
 */

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
});

function init_tooltips() {
    var ttl = new TOOLTIP({
//        classname: 'myclass',
        content_class_attribute: 'data-class' // HTML5
    });
}

</script>
<style type="text/css">

body { font-size: 80%; font-family: 'Lucida Grande', Verdana, Arial, Sans-Serif; }

.tooltip2 {
    background-color: #eee;
    color: #404040;
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
    <p><a href="test2.php">Page 2</a></p>
    <hr />

<h3>Test of tooltips with default positioning (top left)</h3>
<div id="block1">
    <p>Lorem ipsum dolor sit amet,
        <a href="#" class="tooltip" title="<?php echo getSampleString(); ?>">consectetuer adipiscing</a>
         elit. Aliquam id tellus. Nulla orci enim, vulputate et, pharetra eget, imperdiet non, sem. Mauris sit amet mi nec nulla porttitor dapibus. Curabitur leo sem, lacinia sed, commodo eu, mattis sit amet, felis. Ut tortor. Donec 
         <a href="#" class="tooltip" title="<?php echo getSampleString(); ?>">porttitor orci</a>
          et neque. Curabitur eget diam at libero egestas suscipit. In tortor est, ullamcorper eu, dapibus et, condimentum nec, nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis vel 
          <a href="#" class="tooltip" title="<?php echo getSampleString(); ?>">purus eget diam</a> 
          aliquam luctus. Nullam risus ipsum, aliquam et, lacinia sit amet, fermentum vel, mi. In hac habitasse platea dictumst. Maecenas et dui non tortor lobortis feugiat. Donec eleifend iaculis arcu. Cras vitae leo nec nunc rhoncus laoreet. Integer eget enim. Nunc 
          <a href="#" class="tooltip" title="<?php echo getSampleString(); ?>">dignissim cursus</a> 
          mi. Donec eros.</p>
    <p>Proin ornare ligula vitae tellus. Pellentesque risus felis, tempus eget, placerat et, elementum at, ipsum. 
        <a href="#" class="tooltip" title="<?php echo getSampleString(); ?>">Suspendisse faucibus gravida quam</a>
        . Fusce odio. Maecenas mattis pharetra felis. Nam in nunc 
        <a href="#" class="tooltip" title="<?php echo getSampleString(); ?>">vitae velit vehicula suscipit</a>
        . Duis accumsan, lorem non tristique rhoncus, lacus purus imperdiet nunc, eget feugiat augue metus eget justo. Donec quis dui a dui condimentum egestas.  Nullam eget arcu. In placerat pulvinar lacus.</p>
    <p>Fusce lacinia. Nullam laoreet ligula in pede. Vestibulum nunc purus, 
        <a href="#" class="tooltip" title="<?php echo getSampleString(); ?>">venenatis quis</a>
        , blandit eget, congue at, risus. Sed orci. Nulla facilisi. Vestibulum vitae sem. Integer dignissim tortor vitae sem. Donec quis sapien. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas nonummy semper felis.</p>
</div>

<h3>Test of tooltips with positioning</h3>
<div id="block2">
    <p>Lorem ipsum dolor sit amet,
        <a href="#" class="tooltip tooltip_bl" title="<?php echo getSampleString(); ?>" data-class="tooltip2">[bottom left] consectetuer adipiscing</a>
         elit. Aliquam id tellus. Nulla orci enim, vulputate et, pharetra eget, imperdiet non, sem. Mauris sit amet mi nec nulla porttitor dapibus. Curabitur leo sem, lacinia sed, commodo eu, mattis sit amet, felis. Ut tortor. Donec 
         <a href="#" class="tooltip tooltip_br" title="<?php echo getSampleString(); ?>" data-class="tooltip2">[bottom right] porttitor orci</a>
          et neque. Curabitur eget diam at libero egestas suscipit. In tortor est, ullamcorper eu, dapibus et, condimentum nec, nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis vel 
          <a href="#" class="tooltip tooltip_tl" title="<?php echo getSampleString(); ?>" data-class="tooltip2">[top left] purus eget diam</a> 
          aliquam luctus. Nullam risus ipsum, aliquam et, lacinia sit amet, fermentum vel, mi. In hac habitasse platea dictumst. Maecenas et dui non tortor lobortis feugiat. Donec eleifend iaculis arcu. Cras vitae leo nec nunc rhoncus laoreet. Integer eget enim. Nunc 
          <a href="#" class="tooltip tooltip_tr" title="<?php echo getSampleString(); ?>" data-class="tooltip2">[top right] dignissim cursus</a> 
          mi. Donec eros.</p>
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