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
 * Get an element positions
 * @param object element The element from which to get the attribute
 * @return object An array like { left:X, top:Y, right:W, bottom:Z, width:w, height:h }
 */
function getOffset( element ) {
    if (element===undefined || element===null) {
        return null;
    }
    if (element.getBoundingClientRect!==undefined && typeof element.getBoundingClientRect==='function') {
        var val = element.getBoundingClientRect();
        if (val!==undefined && val!==null) { return val; }
    }
    var _el=element, _x=0, _y=0;
    while( element && !isNaN( element.offsetLeft ) && !isNaN( element.offsetTop ) ) {
        _x += element.offsetLeft - element.scrollLeft;
        _y += element.offsetTop - element.scrollTop;
        element = element.offsetParent;
    }
    return {
        top: _y, bottom: _y+_el.offsetHeight,
        left: _x, right: _x+_el.offsetWidth,
        width: _el.offsetWidth, height: _el.offsetHeight
    };
}

/**
 * Extend the Element prototype to allow "element.getOffset(name)"
 */
Element.prototype.getOffset = function() {
    getOffset(this);
};

// Endfile