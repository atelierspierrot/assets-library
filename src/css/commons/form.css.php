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

