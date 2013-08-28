<?php
/*
# ***** BEGIN LICENSE BLOCK *****
# This file is part of the PiWi Framework, an apen source PHP/JavaScript library by Les Ateliers Pierrot
# Copyright (c) 2010 Pierre Cassat and contributors
#
# <http://www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>
#
# PiWi Library is a free software; you can redistribute it and/or modify it under the terms 
# of the GNU General Public License as published by the Free Software Foundation; either version 
# 3 of the License, or (at your option) any later version.
#
# PiWi Library is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; 
# without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License along with this program; 
# if not, write to the :
#     Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
# or see the page :
#    <http://www.opensource.org/licenses/gpl-3.0.html>
#
# Ce programme est un logiciel libre distribué sous licence GNU/GPL.
#
# ***** END LICENSE BLOCK ***** */

/**
 * JS dir
 */
@define('_HTTP_JS', str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__).DIRECTORY_SEPARATOR);

/**
 * JS PHP functions
 */
require_once __DIR__.'/javascript.helper.php';

/**
 * JS header
 */
javascript_header();

?>

// Utiliataire d'inclusion JS
function include(fileName)
{
    "use strict";
	document.write("<script type='text/javascript' src='/<?php echo _HTTP_JS; ?>"+fileName+"'><\/"+"script>" );
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

// Inclusion of debugger
include('debug/debug.js');

// Settings : global javascript options of pages
var settings; if (settings===undefined) settings = [];

// Endfile