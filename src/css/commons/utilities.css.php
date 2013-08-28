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
 * CSS PHP functions
 */
require_once __DIR__.'/../css.helper.php';

/**
 * CSS header
 */
css_header();

$dir_left = defined('CSS_DIR') && CSS_DIR==='rtl' ? 'right' : 'left';
$dir_right = defined('CSS_DIR') && CSS_DIR==='rtl' ? 'left' : 'right';

?>
/* --------------------------------
    Utilities classes
-------------------------------- */

/* Messages */
.message, .message-icon, .ok_message, .error_message, .info_message, .warning_message
                { margin: 10px 10em; padding: 8px 20px; font-weight: bold; font-size: .9em;
                border: 1px solid #404040; background-color: #eee; border-radius: 12px; }
.message p      { color: inherit; margin: .5em 0; }
.message p.title{ font-size: 1.1em; }
.message.ok     { border-color: #ccebac; background-color: #e0f2cb; }
.message.ok, .ok, .message.ok a, .ok a
                { color: #58990b; }
.message.error  { border-color: #f5c69a; background-color: #fbd3b1; }
.message.error, .error, .message.error a, .error a
                { color: #ce2737; }
.message.info   { border-color: #d8e1e9; background-color: #e4edf5; }
.message.info, .info, .message.info a, .info a
                { color: #2e74b2; }
.message.warning{ border-color: #f8e3ac; background-color: #fff4cc; }
.message.warning, .warning, .message.warning a, .warning a
                { color: #e79300; }
.message.ok a:hover, .ok a:hover, .message.error a:hover, .error a:hover, 
.message.info a:hover, .info a:hover, .message.warning a:hover, .warning a:hover
                { color: #404040; }

/* Blocks */
.contentblock   { margin: 1em; }
.footer         { color: #444; padding-top: 12px; border-top: 1px solid #D0D0D0; font-size: .76em; margin: 1em 0; }

/* Utilities classes */
.nofloat        { clear: none; float: none; }
.clear          { clear: both; }
.clearleft      { clear: <?php echo $dir_left; ?>; }
.clearright     { clear: <?php echo $dir_right; ?>; }
.left           { float: <?php echo $dir_left; ?>; }
.right          { float: <?php echo $dir_right; ?>; }