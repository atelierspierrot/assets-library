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
javascript_header();
?>
// Utiliataire d'inclusion JS
function include(fileName)
{
    "use strict";
    document.write("<script type='text/javascript' src='/<?php echo _ASSETSLIB_JS_HTTP; ?>"+fileName+"'><\/"+"script>" );
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
echo prepare_library_include('js', 'debug');
?>

// Endfile