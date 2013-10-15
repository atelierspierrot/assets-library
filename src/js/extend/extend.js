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