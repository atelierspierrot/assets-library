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