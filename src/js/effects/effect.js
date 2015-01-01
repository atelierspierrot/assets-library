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
 * Global effect registry
 */
var EffectRegistry = Registry();

/**
 * Global effect object
 */
function Effect(type, id) {
    var type = type, id = id;
    this.effect_id_attribute = 'effectid';
    this.current_id = null;
}

// ---------------
// EXTEND INSTANCE
// ---------------

Effect.prototype.extend = function(_this, _args) {
    var done = false;
    if (_args!==undefined && _args!==null && typeof _args==='string' && _this.presets!==undefined) {
        var _presets = _args.split(' ');
        for (var i in _presets) {
            if (_this.presets[_presets[i]]!==undefined) {
                extend(_this, _this.presets[_presets[i]]);
                done = true;
            }
        }
    }
    else if (done===false) {
        extend(_this, _args);
    }
    return _this;
};

// ---------------
// EFFECT INSTANCE ID
// ---------------

// get effect ID
Effect.prototype.getEffectIdAttribute = function(element) {
    return element.getAttribute(this.effect_id_attribute) || null;
};

// set effect ID
Effect.prototype.setEffectIdAttribute = function(element, _id) {
    element.setAttribute(this.effect_id_attribute, _id);
    EffectRegistry.set( _id, element );
};

// ---------------
// REGISTRY
// ---------------

// set an element instance
Effect.prototype.setInstance = function(obj, data) {
    var _id = EffectRegistry.add( obj );
    if (this.getEffectIdAttribute(obj)===null) {
        this.setEffectIdAttribute( obj, _id );
    }
    if (data!==undefined && data!==null) {
        EffectRegistry.set( _id+'data', data )
    }
    return _id;
};

// get an element instance
Effect.prototype.getInstance = function(id) {
    var obj = EffectRegistry.get( id );
    var data = EffectRegistry.get( id+'data' );
    return {obj: obj, data: data};
};

// set the current element instance ID
Effect.prototype.setCurrentInstanceId = function(obj_id) {
    this.current_id = obj_id;
};

// get the current instance ID
Effect.prototype.getCurrentInstanceId = function() {
    return this.current_id;
};

// set the current element instance
Effect.prototype.setCurrentInstance = function(obj) {
    if (obj.getAttribute('id')) {
        this.setCurrentInstanceId( obj.getAttribute('id') );
    }
};

// get the current element instance
Effect.prototype.getCurrentInstance = function() {
    if (this.getCurrentInstanceId()===null) return null;
    return this.getInstance( this.getCurrentInstanceId() );
};

// ----------------
// INSTANCE ELEMENT & DATA
// ----------------

Effect.prototype.setInstanceElement = function(id, obj) {
    return EffectRegistry.set(id, obj);
};

Effect.prototype.getInstanceElement = function(id) {
    var obj = this.getInstance(id);
    return obj.obj || null;
};

Effect.prototype.setInstanceData = function(id, obj) {
    return EffectRegistry.set(id+'data', obj);
};

Effect.prototype.getInstanceData = function(id) {
    var obj = this.getInstance(id);
    return obj.data || null;
};

// ----------------
// STYLES
// ----------------

// clear an element style attribute
Effect.prototype.clearStyleAttribute = function(obj, attr, val) {
    if (obj===undefined || obj===null || attr===undefined || attr===null) {
        return;
    }
    if (obj.style) {
        obj.style[attr] = '';
    }
};

// set an element style attribute
Effect.prototype.setStyleAttribute = function(obj, attr, val) {
    if (obj===undefined || obj===null || attr===undefined || attr===null) {
        return;
    }
    if (obj.style) {
        obj.style[attr] = val;
    }
};

// get an element style attribute
Effect.prototype.getStyleAttribute = function(obj, attr) {
    return getStyleAttribute(obj, attr);
};

// get an element positions
Effect.prototype.getOffset = function(obj) {
    return getOffset(obj);
};

// Endfile