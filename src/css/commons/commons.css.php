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
css_header();
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
echo prepare_library_include('css', 'commons', 'typography');

// form
echo prepare_library_include('css', 'commons', 'form');

// utilities
echo prepare_library_include('css', 'commons', 'utilities');
?>
