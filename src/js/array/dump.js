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


/**
 * Function : dump()
 *
 * This function was inspired by the print_r function of PHP.
 * This will accept some data as the argument and return a text that will be a more readable
 * version of the array/hash/object that is given.
 *
 * @param arr The data - array,hash(associative array), object
 * @param level - OPTIONAL
 *
 * @return string The textual representation of the array.
 */
function dump(arr, level) {
	var dumped_text = "";
	if (!level) level = 0;
	//The padding given at the beginning of the line.
	var level_padding = "";
	for (var j=0;j<level+1;j++) level_padding += "    ";
	//Array/Hashes/Objects
	if (typeof(arr) == 'object') {
		for (var item in arr) {
			var value = arr[item];
			//If it is an array
 			if (typeof(value) == 'object') {
				dumped_text += level_padding + "'" + item + "' ...\n";
				dumped_text += dump(value,level+1);
			} else {
				if (typeof(value) != 'function')
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