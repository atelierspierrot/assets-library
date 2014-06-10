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
 * Resizable tool
 * @param object elt The element to work on
 * @param object opts A set of options to overwrite the class defaults
 */
Resizable.version = "1.0.0";
function Resizable( elt, opts ) {

    var defaults = {
            className: 'resizable',
            activeClassName: 'resize-active',
            resizerElement: 'div',
            resizerClassName: 'resizer',
            resizerTitle: 'Click to resize this element',
            resizer: null
        }, _this;

    _mouseDown = function(e, _this) {
        var event = e || window.event;
//console.debug(arguments);
        _this.startX = event.clientX;
        _this.startY = event.clientY;
        _this.startWidth = parseInt(getStyleAttribute(_this.element, 'width'), 10);
        _this.startHeight = parseInt(getStyleAttribute(_this.element, 'height'), 10);
        addClassName(_this.element, this.options.activeClassName);
        document.documentElement.addEventListener('mousemove', dragElt=function(e){ _mouseDrag(e, _this); }, false);
        document.documentElement.addEventListener('mouseup', stopDragElt=function(e){ _mouseUp(e, _this); }, false);
    }
    
    _mouseDrag = function(e, _this) {
        var event = e || window.event;
//console.debug(arguments);
        _this.element.style.width = parseInt(_this.startWidth + event.clientX - _this.startX) + 'px';
        _this.element.style.height = parseInt(_this.startHeight + event.clientY - _this.startY) + 'px';
    }
    
    _mouseUp = function(e, _this) {
        var event = e || window.event;
//console.debug(arguments);
        removeClassName(_this.element, this.options.activeClassName);
        document.documentElement.removeEventListener('mousemove', dragElt, false);
        document.documentElement.removeEventListener('mouseup', stopDragElt, false);
    }

    this.element        =elt;
    this.options        =extend(clone(defaults), opts);
    this.startX         =0;
    this.startY         =0;
    this.startWidth     =0;
    this.startHeight    =0;

    addClassName(this.element, this.options.className);
    if (this.options.resizer===null) {
        var resizer = document.createElement( this.options.resizerElement );
        addClassName(resizer, this.options.resizerClassName);
        resizer.setAttribute('title', this.options.resizerTitle);
        this.element.appendChild(resizer);
        this.options.resizer = resizer;
    }
    _this = clone(this);
    this.options.resizer.onmousedown = function(e){ _mouseDown(e, _this); return false; };
    this.options.resizer.onselectstart = function(){ return false; };
    return this;
}

/**
 * Extend the Element prototype to allow "element.resizable(opts)"
 */
Element.prototype.resizable = function(opts) {
    Resizable(this, opts);
};

// Endfile