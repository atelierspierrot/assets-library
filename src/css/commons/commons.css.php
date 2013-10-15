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
?>
/* --------------------------------
    Global Default CSS Styles
-------------------------------- */

<?php
// reset
echo library_include('css', 'commons', 'reset');
?>

/* body global styles */
body    {
	background-color: #fff; margin: 40px;
	font-size: 82%; font-family: "Lucida Grande", Verdana, Sans-serif; color: #4F5155;
	direction: <?php echo _CSS_DIRECTION; ?>;
}

<?php
// typography
echo library_include('css', 'commons', 'typography');

// form
echo library_include('css', 'commons', 'forms');

// utilities
echo library_include('css', 'commons', 'utilities');
?>
