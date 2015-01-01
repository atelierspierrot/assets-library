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
 * <b>Is defined ?</b>
 * Returns TRUE if 'str' is already defined 
 * (and optionnaly TRUE if it's defined as the 'type' you want)
 *
 * @param ? str The string you want to verify (can be a string or anything else)
 * @param string type The type you want verify 'str' is | optional
 */
function is_defined(str, type){
    try {
        str = (str.charAt(str.length-1) == ')') ? str.substring(0, str.length-2) : str;
    } catch(e) { }
    try {
        var tested = self.eval(str);
        if(tested != undefined && typeof(tested) != undefined){
            if(!type) return true;
            else {
                if(typeof(tested) == type) return true;
                else return false;
            }
        }
    } catch(e) {
        return false;
    }
    return false;
}
