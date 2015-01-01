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
 * Extension of Array objects, to remove a list of specific items
 * Pierre Cassat - 03_2009
 *
 * Usage : 
 *      theArray.remove( toRemove );
 * With :
 * 'theArray' => a true javascript array : [ a, b, c, d, ]
 * 'toRemove' => comma-separated string list of items to remove, each has to be string
 *              ( numbers must be written between quotes )
 *
 * Full example :
 * var a = [ 1, 3, 8, 9, 11, 35 ]; 
 * var b = [ "entree", "de", "test" ]; 
 * alert(a);
 * alert(a.remove("3"));
 * alert(a.remove("3","11"));
 * alert(b);
 * alert(b.remove("de"));
 * alert(b.remove("de","test"));
 */
function array_remove(arr, items) {
    "use strict";
    if (typeof arr !== "object") { return; }
    var k=arguments.length, i;
    if (k > 1) {
        for (i=1; i<k; i++) { do_array_remove(arr, arguments[i]); }
    } else {
        do_array_remove(arr, items);
    }
    return arr;
}

function do_array_remove(arr, item) {
    "use strict";
    var j;
    for (j=0; j<arr.length; j++) {
        if (typeof arr[j] === 'string') {
            var reg = new RegExp('('+item+') {1}', "g");
            if (arr[j].match(reg)) { arr.splice(j, 1); }
        }
        else if (arr[j] === item) { arr.splice(j, 1); }
    }
    return arr;
}

/**
 * Extension of Array objects, to remove a list of specific items
 * Pierre Cassat - 03_2009
 *
 * Usage : 
 *      theArray.remove( toRemove );
 * With :
 * 'theArray' => a true javascript array : [ a, b, c, d, ]
 * 'toRemove' => comma-separated string list of items to remove, each has to be string
 *          ( numbers must be written between quotes )
 *
 * Full example :
 * var a = [ 1, 3, 8, 9, 11, 35 ]; 
 * var b = [ "entree", "de", "test" ]; 
 * alert(a);
 * alert(a.remove("3"));
 * alert(a.remove("3","11"));
 * alert(b);
 * alert(b.remove("de"));
 * alert(b.remove("de","test"));
 */
Array.prototype.remove = function(items) {
    "use strict";
    if (typeof this !== "object") { return; }
    var k=arguments.length, i;
    if (k > 1) {
        for (i=0; i<k; i++) { this.do_remove(arguments[i]); }
    }
    else { this.do_remove(items); }
    return this;
};

Array.prototype.do_remove = function(item) {
    "use strict";
    var j;
    for (j=0; j<this.length; j++) {
        if (typeof this[j] === 'string') {
            var reg = new RegExp('('+item+') {1}', "g");
            if (this[j].match(reg)) { this.splice(j, 1); }
        }
        else if (this[j] === item) { this.splice(j, 1); }
    }
    return this;
};

// Endfile