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
 * Blind effect
 */
function Blind(id) {

    // extendable options
    this.speed = 7; // speed
    this.timer = 10; // refresh rate
    this.expand = 'bottom'; // effect way down
    this.collapse = 'top'; // effect way up

    // effect presets
    this.presets = {
        // speed
        slow: { speed: 16, timer: 14 },
        default: { speed: 7, timer: 10 },
        fast: { speed: 2, timer: 7 },
        // way
        bottom: { expand: 'bottom', collapse: 'top' },
        top: { expand: 'top', collapse: 'bottom' },
        left: { expand: 'left', collapse: 'right' },
        right: { expand: 'right', collapse: 'left' }
    };

    // variables
    var self, data, effect = new Effect('blind');

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
    //        if (getDisplay(self)==='none') {
        if (data.isCollapsed===true) {
            clearInterval(self.t);
            var expand_meth = 'expandTo'+capitaliseFirstLetter( data.expand );
            self.t = setInterval('this.'+expand_meth+'("'+_id+'")', data.timer);
        }
        else {
            clearInterval(self.t);
            var collapse_meth = 'collapseTo'+capitaliseFirstLetter( data.collapse );
            self.t = setInterval('this.'+collapse_meth+'("'+_id+'")', data.timer);
        }
    };

    this.getObject = function(id) {
        self = {};
        self = document.getElementById(id);
        effect.setStyleAttribute(self, 'overflow', 'hidden');
        return self;
    };

    this.getObjectData = function(self) {
        data = {};
        data.positions = getPositions(self);
        data.maxHeight = getMaxHeight(self);
        data.maxWidth = getMaxWidth(self);
        data.speed = this.speed;
        data.timer = this.timer;
        data.expand = this.expand;
        data.collapse = this.collapse;
        data.isCollapsed = false;
        return data;
    };

// --------------
// Sliding
// --------------

    // increase the height of the div exponentially
    this.expandToBottom = function(id) {
    //console.debug('expanding el ', id);
        self = effect.getInstanceElement(id);
        data = effect.getInstanceData(id);
        setDisplay(self,'block');
        var elh = parseFloat( getHeight(self) );
        if (elh < data.maxHeight) {
            var v = Math.round((data.maxHeight - elh) / data.speed);
            v = (v<1) ? 1 : v;
            v = (elh + v);
            if (v<data.maxHeight) {
                setHeight(self, v);
                setOpacity(self, (v / data.maxHeight));
                return;
            }
        }
        setHeight(self,data.maxHeight);
        setOpacity(self,0);
        clearInterval(self.t);
        data.isCollapsed = false;
        effect.setInstanceData(id, data);
    };

    // increase the width of the div exponentially
    this.expandToRight = function(id) {
    //console.debug('expanding el ', id);
        self = effect.getInstanceElement(id);
        data = effect.getInstanceData(id);
        var elw = parseFloat( getWidth(self) );
        if (elw < data.maxWidth) {
            var v = Math.round((data.maxWidth - elw) / data.speed);
            v = (v<1) ? 1 : v;
            v = (elw + v);
            if (v<data.maxWidth) {
                setWidth(self, v);
                setOpacity(self, (v / data.maxWidth));
                return;
            }
        }
        setWidth(self,data.maxWidth);
        setOpacity(self,0);
        clearInterval(self.t);
        data.isCollapsed = false;
        effect.setInstanceData(id, data);
    };

    // increase the width of the div exponentially and position it as wanted
    this.expandToLeft = function(id) {
    //console.debug('expanding el ', id);
        self = effect.getInstanceElement(id);
        data = effect.getInstanceData(id);
        var elw = parseFloat( getWidth(self) );
        if (elw < data.maxWidth) {
            var v = Math.round((data.maxWidth - elw) / data.speed);
            v = (v<1) ? 1 : v;
            v = (elw + v);
            if (v<data.maxWidth) {
                setWidth(self, v);
                setPositionX(self, (data.maxWidth - v));
                setOpacity(self, (v / data.maxWidth));
                return;
            }
        }
        setWidth(self,data.maxWidth);
        setPositionX(self, (data.positions.left + data.maxWidth - v));
        setOpacity(self,0);
        clearInterval(self.t);
        data.isCollapsed = false;
        effect.setInstanceData(id, data);
    };

    // reduce the height of the div exponentially
    this.collapseToTop = function(id) {
    //console.debug('collapsing el ', id);
        self = effect.getInstanceElement(id);
        data = effect.getInstanceData(id);
        var elh = parseFloat( getHeight(self) );
        if (elh > 0) {
            var v = Math.round(elh / data.speed);
            v = (v<1) ? 1 : v;
            v = (elh - v);
            if (v>1) {
                setHeight(self,v);
                setOpacity(self,(v / data.maxHeight));
                return;
            }
        }
        setHeight(self,0);
        setDisplay(self,'none');
        clearInterval(self.t);
        data.isCollapsed = true;
        effect.setInstanceData(id, data);
    };

    // reduce the width of the div exponentially
    this.collapseToLeft = function(id) {
    //console.debug('collapsing el ', id);
        self = effect.getInstanceElement(id);
        data = effect.getInstanceData(id);
        setHeight(self,data.maxHeight);
        var elw = parseFloat( getWidth(self) );
        if (elw > 0) {
            var v = Math.round(elw / data.speed);
            v = (v<1) ? 1 : v;
            v = (elw - v);
            if (v>1) {
                setWidth(self,v);
                setOpacity(self,(v / data.maxWidth));
                return;
            }
        }
        setWidth(self,0);
        clearInterval(self.t);
        data.isCollapsed = true;
        effect.setInstanceData(id, data);
    };

    // reduce the width of the div exponentially and position it as wanted
    this.collapseToRight = function(id) {
    //console.debug('collapsing el ', id);
        self = effect.getInstanceElement(id);
        data = effect.getInstanceData(id);
        setHeight(self,data.maxHeight);
        var elw = parseFloat( getWidth(self) );
        if (elw > 0) {
            var v = Math.round(elw / data.speed);
            v = (v<1) ? 1 : v;
            v = (elw - v);
            if (v>1) {
                setWidth(self,v);
                setPositionX(self, (data.positions.left + v));
                setOpacity(self,(v / data.maxWidth));
                return;
            }
        }
        setWidth(self,0);
        setPositionX(self,data.maxWidth);
        clearInterval(self.t);
        data.isCollapsed = true;
        effect.setInstanceData(id, data);
    };

// --------------
// Utilities
// --------------

    // get the max height of a div
    function getMaxHeight(d) {
        var original_visibility = getVisibility(d),
            original_display = getDisplay(d),
            result;
        setVisibility(d,'hidden');
        setDisplay(d,'block');
        result = parseInt( getHeight(d) );
        setDisplay(d,original_display);
        setVisibility(d,original_visibility);
        return result;
    };

    // get the max width of a div
    function getMaxWidth(d) {
        var original_visibility = getVisibility(d),
            original_display = getDisplay(d),
            result;
        setVisibility(d,'hidden');
        setDisplay(d,'block');
        result = parseInt( getWidth(d) );
        setDisplay(d,original_display);
        setVisibility(d,original_visibility);
        return result;
    };

    // get the height of a div
    function getHeight(d) {
        return effect.getStyleAttribute(d, 'offsetHeight').replace('px', '');
    };

    // set the height of a div
    function setHeight(d,v) {
        return effect.setStyleAttribute(d, 'height', v+'px');
    };

    // get the height of a div
    function getWidth(d) {
        return effect.getStyleAttribute(d, 'offsetWidth').replace('px', '');
    };

    // set the height of a div
    function setWidth(d,v) {
        return effect.setStyleAttribute(d, 'width', v+'px');
    };

    // get the current display style of the div
    function getDisplay(d) {
        return effect.getStyleAttribute(d, 'display');
    };

    // set the current display style of the div
    function setDisplay(d,v) {
        effect.setStyleAttribute(d, 'display', v);
    };

    // get the current visibility style of the div
    function getVisibility(d) {
        return effect.getStyleAttribute(d, 'visibility');
    };

    // set the current visibility style of the div
    function setVisibility(d,v) {
        effect.setStyleAttribute(d, 'visibility', v);
    };

    // set the current display style of the div
    function setOpacity(d,v) {
        if (v===0) {
            effect.clearStyleAttribute(d, 'opacity');
            effect.clearStyleAttribute(d, 'filter');
        }
        else {
            effect.setStyleAttribute(d, 'opacity', v);
            effect.setStyleAttribute(d, 'filter', 'alpha(opacity='+(v * 100)+');');
        }
    };

    // get the current positions of the div
    function getPositions(d) {
        return effect.getOffset(d);
    };

    // get the current positions of the div
    function setPositionX(d,v) {
        effect.setStyleAttribute(d, 'left', v+'px');
    };

    // get the current positions of the div
    function setPositionY(d,v) {
        effect.setStyleAttribute(d, 'top', v+'px');
    };

    function capitaliseFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    };

// ------------------
// Slide Effect
// ------------------

    init.apply(this, arguments);
    return false;
}

// Endfile