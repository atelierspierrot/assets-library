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
 * Loop on each item of an Array or a Collection
 *
 * @param array|collection collection The array or collection to loop on
 * @param str|function callback A callback function to execute on each item, as `callback( index, value )`
 * @return array|collection Returns the array or collection after execution of the loop
 */
function each(collection, callback) {
    for(var i=0, len=collection.length; i<len; i++) {
        applyCallback( callback, [i, collection[i]] );
    }
    return collection;
}

Array.prototype.each = function(callback) {
    return each(this, callback);
};

// Endfile