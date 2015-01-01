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
 * Extend an object with a set of options, methods are not extended or replaced
 * @param object obj The object to extend
 * @param object opts The values to use extending the object
 * @param string mask A mask to build the property name correspondance (must contain "%s" replaced with opts property name)
 * @return object The original object with properties extended by the opts values if so
 */
function extend(obj, opts, mask) {
    var prop, propname;
    for (prop in opts) {
        if (mask!==undefined) {
            propname = mask.replace('%s', prop);
        } else {
            propname = prop;
        }
        if (obj.hasOwnProperty(propname) && typeof obj[propname]!=="function") {
//console.debug('setting prop "'+propname+'" on value "'+opts[prop]+'"');
            obj[propname] = opts[prop];
        }        
    }
    return obj;
}

/**
 * Multi extend of an object
 * @return object The original object with properties extended by each other argument
 */
function multiExtend() {
    var _args = arguments, obj = _args[0];
    for (var i in arguments) {
        if (i!==0) { obj = extend(obj, _args[i]); }
    }
    return obj;
}

// Endfile