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
 * Get an element positions
 * @param object element The element from which to get the attribute
 * @return object An array like ( left:X, top:Y, right:W, bottom:Z, width:w, height:h )
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