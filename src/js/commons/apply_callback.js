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
 * Apply a callback function on args
 *
 * @param str|function callback The callback function name or closure to execute
 * @param misc args The argument(s) to pass for the callback execution
 * @return misc The result of the callback execution
 */
function applyCallback(callback, args) {
    var result = null;
    if (!Array.isArray(args)) { args = [ args ]; }

    // case of a closure
    if (typeof callback==='function') {
        result = callback.apply( null, args );
    }
    // case of a function name
    else if (typeof callback==='string' && typeof window[callback]==='function') {
        eval( 'result = '+callback+'.apply( null, args );' );
    }

    return result;
}

// Endfile