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
 * Fade effect
 */
function Fade(id) {

    // extendable options
    this.speed = 7; // speed
    this.timer = 10; // refresh rate

    // effect presets
    this.presets = {
        // speed
        slow: { speed: 16, timer: 14 },
        default: { speed: 7, timer: 10 },
        fast: { speed: 2, timer: 7 },
    };

    // variables
    var self, data, effect = new Effect('fade');

    // initialization
    this.init = function(id) {
    	self = this.getObject(id);
        var _id = effect.getEffectIdAttribute(self);
        if (_id===null) {
            if (arguments[1]!==undefined) {
                effect.extend(this, arguments[1]);
            }
    	    data = this.getObjectData(self);
        	_id = effect.setInstance(self, data);
        }
        else {
        	self = effect.getInstanceElement(_id);
        	data = effect.getInstanceData(_id);
        }
//console.debug('working on div with id['+_id+'] getting self: ', self, ' and data: ', data);
        if (data.isCollapsed===true) {
            clearInterval(self.t);
            self.t = setInterval('this.fadeIn("'+_id+'")', data.timer);
        }
        else {
            clearInterval(self.t);
            self.t = setInterval('this.fadeOut("'+_id+'")', data.timer);
        }
    };

    this.getObject = function(id) {
        self = {};
        self = document.getElementById(id);
        return self;
    };

    this.getObjectData = function(self) {
        data = {};
        data.maxOpacity = getOpacity(self);
        data.speed = this.speed;
        data.timer = this.timer;
        data.isCollapsed = false;
        return data;
    };

// --------------
// Sliding
// --------------

    // increase the opacity of the div exponentially
    this.fadeIn = function(id) {
//console.debug('expanding el ', id);
    	self = effect.getInstanceElement(id);
    	data = effect.getInstanceData(id);
        var elo = getOpacity(self)*100;
        var maxo = data.maxOpacity*100;
        if (elo < maxo) {
            var v = (elo + Math.round((maxo - elo) / data.speed));
            if (v < maxo && v!=elo) {
                setOpacity(self, parseFloat(v / maxo));
                return;
            }
        }
        setOpacity(self,data.maxOpacity);
        clearInterval(self.t);
        data.isCollapsed = false;
        effect.setInstanceData(id, data);
    };

    // reduce the opacity of the div exponentially
    this.fadeOut = function(id) {
//console.debug('collapsing el ', id);
    	self = effect.getInstanceElement(id);
    	data = effect.getInstanceData(id);
        var elo = getOpacity(self)*100;
        if (elo > 0) {
            var v = (elo - Math.round(elo / data.speed));
            if (v > 0 && v!=elo) {
                setOpacity(self, parseFloat(v/100));
                return;
            }
        }
        setOpacity(self,0);
        clearInterval(self.t);
        data.isCollapsed = true;
        effect.setInstanceData(id, data);
    };

// --------------
// Utilities
// --------------

    // get the current opacity style of the div
    function getOpacity(d) {
        return effect.getStyleAttribute(d, 'opacity');
    };

    // set the current opacity style of the div
    function setOpacity(d,v) {
        effect.setStyleAttribute(d, 'opacity', v);
        effect.setStyleAttribute(d, 'filter', 'alpha(opacity='+(v * 100)+');');
    };

// ------------------
// Slide Effect
// ------------------

    init.apply(this, arguments);
    return false;
}

// Endfile