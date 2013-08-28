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
# ***** SVN PROPERTIES *****
# $Revision: 605 $
# $Date: 2011-06-23 20:10:17 +0200 (Thu, 23 Jun 2011) $
# $Id: join.js 605 2011-06-23 18:10:17Z pierrecap $
# ***** END LICENSE BLOCK ***** */


/**
 * <b>Join</b>
 * Join all args of an array in a string
 *
 * @param array array The array you want to serialize
 * @param char sep_arg The separator of arguments | optional | default is '='
 * @param char sep_arg The separator of items | optional | default is ';'
 */
function _join(array, sep_arg, sep_item) {
	var string = '';
	var s_arg = (!sep_arg || sep_arg == '') ? '=' : sep_arg;
	var s_item = (!sep_item || sep_item == '') ? ';' : sep_item;
	if(typeof(array) != 'object') return;
	else {
		for(var item in array) {
			var value = array[item];
 			if(typeof(value) == 'object') {
				string += item+s_arg+'(';
				string += _join(value);
				string += ')'+s_item;
			} else {
				string += item+s_arg+value+s_item;
			}
		}
	} 
	return string;
}

// Endfile