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
 * Join all args of an array in a string
 *
 * @param array array The array you want to serialize
 * @param char sep_arg The separator of arguments | optional | default is '='
 * @param char sep_arg The separator of items | optional | default is ';'
 */
function join(array, sep_arg, sep_item) {
    var string = '';
    var s_arg = (!sep_arg || sep_arg == '') ? '=' : sep_arg;
    var s_item = (!sep_item || sep_item == '') ? ';' : sep_item;
    if (typeof(array) != 'object') return;
    else {
        for (var item in array) {
            var value = array[item];
            if (typeof(value) == 'object') {
                string += item+s_arg+'(';
                string += join(value);
                string += ')'+s_item;
            } else {
                string += item+s_arg+value+s_item;
            }
        }
    }
    return string;
}

// Endfile