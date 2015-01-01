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