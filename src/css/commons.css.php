<?php @ini_set('display_errors',1); @error_reporting(E_ALL ^ E_NOTICE);
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
 * CSS dir
 */
@define('_HTTP_CSS', str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__).DIRECTORY_SEPARATOR);

/**
 * CSS PHP functions
 */
require_once __DIR__.'/css.helper.php';

/**
 * CSS header
 */
css_header();

/**
 * CSS globals
 */
@define('CSS_DIR', !empty($_GET['dir']) ? $_GET['dir'] : 'ltr');

?>
/* --------------------------------
    Global Default CSS Styles
-------------------------------- */

<?php

// reset
require_once __DIR__.'/commons/reset.css.php';

?>

/* body global styles */
body    {
	background-color: #fff; margin: 40px;
	font-size: 82%; font-family: "Lucida Grande", Verdana, Sans-serif; color: #4F5155;
	direction: <?php echo CSS_DIR; ?>;
}

<?php

// typography
require_once __DIR__.'/commons/typography.css.php';

// form
require_once __DIR__.'/commons/form.css.php';

// utilities
require_once __DIR__.'/commons/utilities.css.php';

?>
