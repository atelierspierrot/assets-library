/*
# ***** BEGIN LICENSE BLOCK *****
# Assets Library - The open source PHP/JavaScript/CSS library of Les Ateliers Pierrot
# Copyleft (c) 2013-2014 Pierre Cassat and contributors
# <www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>
# License GPL-3.0 <http://www.opensource.org/licenses/gpl-3.0.html>
# Sources <http://github.com/atelierspierrot/assets-library>
#
# Ce programme est un logiciel libre distribué sous licence GNU/GPL.
#
# ***** END LICENSE BLOCK ***** */

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