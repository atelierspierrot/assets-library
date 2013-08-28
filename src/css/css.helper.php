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

if (!function_exists('css_header'))
{
/**
 * CSS PHP header
 */
    function css_header()
    {
        if (!headers_sent()) header("content-type: text/css");
    }
}

if (!function_exists('css_include'))
{
/**
 * CSS include script
 */
    function css_include( $tool_name, $file_name=null )
    {
        $_f = $tool_name.'/'.(!empty($file_name) ? $file_name : $tool_name).'.css';
        if (@file_exists($_f)) {
            $css_ctt = file_get_contents($_f);
            echo "\n".'/* LIBRARY TOOL : Insert CSS file "'.$_f.'" */'
                ."\n".$css_ctt;
        }
    }
}

if (!function_exists('css3_rule'))
{
/**
 * Write a full set of CSS3 rules
 *
 * Example :
 *     css3_rule( 'box-shadow', '0px 0px 5px #CCC' );
 * will return :
 *     -moz-box-shadow:0px 0px 5px #CCC; 
 *     -webkit-box-shadow:0px 0px 5px #CCC; 
 *     -o-box-shadow:0px 0px 5px #CCC; 
 *     box-shadow:0px 0px 5px #CCC; 
 *
 * @param str $property The CSS3 property name
 * @param str $value The CSS value to define
 * @param bool $indent Indent the code or not (default is true)
 * @return str The CSS3 definition string to display
 */
    function css3_rule( $property, $value, $indent=true )
    {
        $browsers_prefix = array('-moz-', '-webkit-', '-o-', '');
        $str = '';
        foreach($browsers_prefix as $_prefix)
        {
            if (true===$indent)
            {
                $str .= (strlen($str) ? "\n" : '')."\t";
            }
            $str .= $_prefix.$property.':'.$value.';';
        }
        return $str.(true===$indent ? "\n" : '');
    }
}

// Endfile