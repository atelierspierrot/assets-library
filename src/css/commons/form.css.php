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
    Form styles
-------------------------------- */

form            { margin: 1em 2px; display: block; position: relative; }
fieldset        { margin: 1px; padding: 6px; border: 1px dotted #ccc; }
legend          { font-weight: bold; }
label           { width: auto; display: inline-block; margin: 0 10px; }
input           { display: inline-block;  }
input[type="numeric"] 
                { width: 10%;  }
input[type="checkbox"] 
                { float: none; }
button, input[type="button"], input[type="submit"], input[type="reset"] 
                { margin-left: 6px; }
textarea        { display: inline-block; }

