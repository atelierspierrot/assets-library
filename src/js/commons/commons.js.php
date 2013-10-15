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
// Utiliataire d'inclusion JS
function include(fileName)
{
    "use strict";
	document.write("<script type='text/javascript' src='/<?php echo _JS_HTTP; ?>"+fileName+"'><\/"+"script>" );
	if (typeof window._dbg === 'function') {
		_dbg("Inclusion of file ["+fileName+"]");
	}
}

// from http://javascript.about.com/library/bladdjs.htm
function addJavascript(filepath, _tag) {
    var tag = _tag || 'head';
    var th = document.getElementsByTagName(tag)[0];
    var s = document.createElement('script');
    s.setAttribute('type','text/javascript');
    s.setAttribute('src',filepath);
    th.appendChild(s);
}

// Settings : global javascript options of pages
var settings; if (settings===undefined) settings = [];

<?php
// Inclusion of debugger
echo library_include('js', 'debug');
?>

// Endfile