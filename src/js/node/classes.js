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

// IE "getElementsByClassName()" hack
if (document.getElementsByClassName===undefined)
{
	document.getElementsByClassName = function(className)
	{
		var hasClassName = new RegExp("(?:^|\\s)" + className + "(?:$|\\s)");
		var allElements = document.getElementsByTagName("*");
		var results = [];
		var element;
		for (var i=0; (element = allElements[i])!==null; i++) {
			var elementClass = element.className;
			if (elementClass && elementClass.indexOf(className)!==-1 && hasClassName.test(elementClass)) {
				results.push(element);
			}
		}
		return results;
	}
}

// ------------------
// Classes utilities
// ------------------

/**
 * Get an array of classes of element "domobj" 
 * @param element domobj A DOM element node
 * @return array The array of element classes or an empty array otherwise
 */
function getClasses(domobj) {
    "use strict";
    if (domobj === undefined || domobj === null) {
        return [];
    }
    var _classes = domobj.className;
    if (_classes !== undefined && _classes !== null) {
        return _classes.split(" ");
    }
    return [];
}

/**
 * Add class "clsname" to element "domobj" 
 * @param element domobj A DOM element node
 * @param string clsname The class name to add
 * @return void
 */
function addClassName(domobj, clsname) {
    "use strict";
    var classes = getClasses(domobj), len = classes.length;
    if (len>0) {
        for (var i=0; i<len; i++) {
            if (classes[i] === clsname) return;
        }
        classes.push( clsname );
        domobj.className = classes.join(" ");
    }
    return;
}

/**
 * Remove class "clsname" from element "domobj" 
 * @param element domobj A DOM element node
 * @param string clsname The class name to remove
 * @return void
 */
function removeClassName(domobj, clsname) {
    "use strict";
    var classes = getClasses(domobj), len = classes.length;
    if (len>0) {
        for (var i=0; i<len; i++) {
            if (classes[i] === clsname) classes[i] = null;
        }
        domobj.className = classes.join(" ");
    }
    return;
}

/**
 * Check if the element "domobj" has class "clsname"
 * @param element domobj A DOM element node
 * @param string clsname The class name to check
 * @return bool True if the element has the class, false otherwise
 */
function hasClassName(domobj, clsname) {
    "use strict";
    var classes = getClasses(domobj), len = classes.length;
    if (len>0) {
        for (var i=0; i<len; i++) {
            if (classes[i] === clsname) return true;
        }
    }
    return false;
}

/**
 * Get the index of class "clsname" in the element "domobj"
 * @param element domobj A DOM element node
 * @param string clsname The class name to check
 * @return int|bool The index of the classname if so, false otherwise
 */
function getClassNameIndex(domobj, clsname) {
    "use strict";
    var classes = getClasses(domobj), len = classes.length;
    if (len>0) {
        for (var i=0; i<len; i++) {
            if (classes[i] === clsname) return i;
        }
    }
    return false;
}

// Endfile