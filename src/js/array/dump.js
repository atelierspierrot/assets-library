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
# $Id: dump.js 605 2011-06-23 18:10:17Z pierrecap $
# ***** END LICENSE BLOCK ***** */


/**
 * Function : dump()
 * Arguments: The data - array,hash(associative array),object
 *    The level - OPTIONAL
 * Returns  : The textual representation of the array.
 * This function was inspired by the print_r function of PHP.
 * This will accept some data as the argument and return a
 * text that will be a more readable version of the
 * array/hash/object that is given.
*/
function _dump(arr,level) {
	var dumped_text = "";
	if(!level) level = 0;
	//The padding given at the beginning of the line.
	var level_padding = "";
	for(var j=0;j<level+1;j++) level_padding += "    ";
	//Array/Hashes/Objects
	if(typeof(arr) == 'object') {
		for(var item in arr) {
			var value = arr[item];
			//If it is an array
 			if(typeof(value) == 'object') {
				dumped_text += level_padding + "'" + item + "' ...\n";
				dumped_text += _dump(value,level+1);
			} else {
				if(typeof(value) != 'function')
					dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
			}
		}
	} 
	//Stings/Chars/Numbers etc.
	else { 
		dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
	}
	return dumped_text;
}

// Endfile