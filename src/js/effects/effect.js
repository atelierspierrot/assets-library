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