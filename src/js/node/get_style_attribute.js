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
 * Get an element style attribute (transformed if so)
 * @param object element The element from which to get the attribute
 * @param string attribute The attribute name to get
 * @param string actions A list of actions, separated by space, to treat on value (parseInt, strip_px)
 * @return The value retrieved, treated by the requested actions if so
 */
function getStyleAttribute( element, attribute, action ) {
    value = null;
    if (element===undefined || element===null || attribute===undefined || attribute===null) {
        return value;
    }
    
    // getting value
    if (element.currentStyle) {
        value = element.currentStyle[attribute] || null;
    }
    else if (window.getComputedStyle) {
        var _dom = document.defaultView.getComputedStyle(element,null);
        if (_dom) {
            value = _dom.getPropertyValue(attribute.replace('offset', '')) || null;
        }
    }
    else if (element.style) {
        value = element.style[attribute] || null;
    }
    
    // treatments
    if (value && action!==undefined && action!==null) {
        var actions = action.split(' ');
        for (var index in actions) {
            if (actions[index]==='strip_px') {
                value = value.replace('/px/i', '');
            }
            if (actions[index]==='parseInt') {
                value = parseInt(value, 10);
            }
        }
    }

    return value;
}

/**
 * Extend the Element prototype to allow "element.getStyleAttribute(name)"
 */
Element.prototype.getStyleAttribute = function(attribute, action) {
    getStyleAttribute(this, attribute, action);
};

// Endfile