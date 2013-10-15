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