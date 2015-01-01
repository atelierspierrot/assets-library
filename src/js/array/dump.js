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