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