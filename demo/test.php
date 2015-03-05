<?php

/**
 * Show errors at least initially
 *
 * `E_ALL` => for hard dev
 * `E_ALL & ~E_STRICT` => for hard dev in PHP5.4 avoiding strict warnings
 * `E_ALL & ~E_NOTICE & ~E_STRICT` => classic setting
 */
@ini_set('display_errors','1'); @error_reporting(E_ALL);
//@ini_set('display_errors','1'); @error_reporting(E_ALL & ~E_STRICT);
//@ini_set('display_errors','1'); @error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);

/**
 * Set a default timezone to avoid PHP5 warnings
 */
$dtmz = @date_default_timezone_get();
date_default_timezone_set($dtmz?:'Europe/Paris');

require_once __DIR__.'/../src/assets-library.php';
require_once __DIR__.'/../src/DependenciesManager.php';

function prepareRequirements(array $reqs)
{
    $stack = array();
    foreach ($reqs as $type=>$type_reqs) {
        if (!isset($stack[$type])) {
            $stack[$type] = array();
        }
        foreach ($type_reqs as $item) {
            $item = substr($item, strlen($type)+1);         // skip leading 'js/'
            $item = substr($item, 0, -(strlen($type)+1));   // skip trailing '.js'
            
            echo '<br />', $item;
        }
    }
    return $stack;
}

$presets = new DependenciesManager(__DIR__.'/../composer.json');

echo '<pre>';

var_export($presets->getComposerManifest()->getName());
echo '<br />';

$ajax = $presets->findDependencies('ajax');
var_export($ajax);
echo '<br />';
var_export(prepareRequirements($ajax));
echo '<br />';
echo build_requirements_url('js', $ajax['js']);
echo '<br />';
echo build_requirements_url('css', $ajax['css']);
echo '<br />';

echo <<<EOT
<script src="/GitHub_projects/assets-library/src/assets-library.php?type=js&preset=ajax" type="text/javascript">
EOT;
/*
<script src="/GitHub_projects/assets-library/src/assets-library.php?
    type=js&
    commons[]=commons&commons[]=clone&extend&document=document_load&form_serialize&node[]=classes&node[]=get_style_attribute&node[]=get_offset&system=uniqid&array=in_array" type="text/javascript">
<link type="text/css" rel="stylesheet" media="screen" href="/GitHub_projects/assets-library/src/assets-library.php?type=css&commons[]=commons&commons[]=clone&extend&document=document_load&form_serialize">
*/
$accordion = $presets->findDependencies('accordion');
var_export($accordion);
echo '<br />';
echo build_requirements_url('js', $accordion['js']);
echo '<br />';
echo build_requirements_url('css', $accordion['css']);
echo '<br />';

echo '<hr />';
var_export($presets);


