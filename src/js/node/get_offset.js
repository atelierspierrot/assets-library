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