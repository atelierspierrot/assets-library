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
    CSS Reset for browsers compatibility
-------------------------------- */

*           { padding:0; margin:0; }
img         { border:0; padding:0; margin:0; }
em          { font-style: italic; }
b,strong    { font-weight: bold;  }
html,body   { height: 100%; }
div         { text-align: <?php echo (defined('_CSS_DIRECTION') && _CSS_DIRECTION==='rtl' ? 'right' : 'left'); ?>; }

