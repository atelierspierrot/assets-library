<?php
/**
 * @access private
 */

// Le fichier commun de test de la librairie perso
// The PersoLib core (required for inclusions & tests)
if (!defined('CORE_LOADED')) {
	$_core = '../../';
	require_once $_core.'core.php';
}

@define('_LOREMIPSUM_INTERFACE', 'lorem_ipsum_interface.php');

$javascripts = array(
	PersoLib_Loader::javascriptLoad('popup_set', 'window'),
	PersoLib_Loader::javascriptLoad('get_window_sizes', 'window'),
);
$inline_js = "getWindowSizes();";
$inline_content = "<h1>Test des fonctions de 'window'</h1>"
	."<h2>Test de la fonction js 'popup_set'</h2><p><a href=\"javascript:popup_set('"._HTTP_LOREMIPSUM._LOREMIPSUM_INTERFACE."');\">test popup</a></p>"
	."<h2>Test de la fonction js 'window_size'</h2><p>cf. console _</p>";

require(_DIR_LOREMIPSUM._LOREMIPSUM_INTERFACE);

// endfile