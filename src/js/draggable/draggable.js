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
 * Draggable tool
 * @param object elt The element to work on
 * @param object opts A set of options to overwrite the class defaults
 */
Draggable.version = "1.0.0";
function Draggable(elt, opts) {

    var defaults = {
            outbound: false,                // allow to put the element outside the window
            frame: 'page',                  // 'page' or 'window' to select the outbound scope
            element: 'div',
            className: 'draggable',
            activeClassName: 'dragged',
            useGhost: true,
            ghostClassName: 'ghost',
            handlerElement: 'div',
            handlerClassName: 'dragger',
            handlerTitle: 'Click to drag this element',
            handler: null
        }, _this;


    createGhost = function(element, _this) {
        if (typeof element!=='object') { return; }
        var ghost = element.cloneNode(true), itemPositions;
        itemPositions = getOffset(element);
        addClassName(ghost, _this.options.ghostClassName);
        ghost.style.width = parseInt(itemPositions.width, 10)+'px';
        ghost.style.height = parseInt(itemPositions.height, 10)+'px';
        ghost.style.left = parseInt(itemPositions.left, 10)+'px';
        ghost.style.top = parseInt(itemPositions.top, 10)+'px';
        ghost.innerHtml = '';
        return ghost;
    }

    _mouseDown = function(e, _this) {
        var event = e || window.event, itemPositions;
        if (!_this.isDragged) {
            if (_this.options.useGhost) {
                _this.ghost = createGhost(_this.element, _this);
                _this.element.parentNode.insertBefore(_this.ghost, _this.element);
            }
            document.documentElement.addEventListener('mousemove', dragElt=function(e){ _mouseDrag(e, _this); }, false);
            document.documentElement.addEventListener('mouseup', stopDragElt=function(e){ _mouseUp(e, _this); }, false);
        }
    }
    
    _mouseDrag = function(e, _this) {
        var event = e || window.event;
        if (!_this.isDragged) {
            itemPositions = getOffset(_this.element);
            _this.itemX = parseInt(itemPositions.left, 10);
            _this.itemY = parseInt(itemPositions.top, 10);
            _this.startX = (event.clientX || event.pageX);
            _this.startY = (event.clientY || event.pageY);
            _this.isDragged = true;

console.debug('positions: ', itemPositions);
console.debug({ startX:_this.startX, startY:_this.startY, itemX:_this.itemX, itemY:_this.itemY });

            addClassName(_this.element, _this.options.activeClassName);
        }
        else {
            var eventX, eventY, eventOffsetX, eventOffsetY;
            eventX = (event.clientX || event.pageX);
            eventY = (event.clientY || event.pageY);
            eventOffsetX = eventX - _this.startX;
            eventOffsetY = eventY - _this.startY;

console.debug({ eventX:eventX, eventY:eventY, eventOffsetX:eventOffsetX, eventOffsetY:eventOffsetY });
console.debug('doDrag ', { left:parseInt(_this.itemX + eventOffsetX), top:parseInt(_this.itemY + eventOffsetY) });

            var new_left = parseInt((_this.itemX + eventOffsetX), 10);
            var new_top = parseInt((_this.itemY + eventOffsetY), 10);
            if (!_this.options.outbound) {
                var frameSizes = {}, elementOffset = getOffset(_this.element);
                if (_this.options.frame==='page') {
                    try {
                        frameSizes = getDocumentSizes();
                    } catch(e) {}
                }
                else if (_this.options.frame==='window') {
                    try {
                        frameSizes = getWindowSizes();
                    } catch(e) {}
                }
console.debug(frameSizes);
                if (new_left<0) new_left = 0;
                if (new_left > (frameSizes.width-elementOffset.width)) {
                    new_left = frameSizes.width-elementOffset.width;
                }
                if (new_top<0) new_top = 0;
                if (new_top > frameSizes.height-elementOffset.height) {
                    new_top = frameSizes.height-elementOffset.height;
                }
            }
            _this.element.style.left = new_left+'px';
            _this.element.style.top = new_top+'px';
        }
    }
    
    _mouseUp = function(e, _this) {
        var event = e || window.event;
        if (_this.options.useGhost) {
            _this.element.parentNode.removeChild(_this.ghost);
        }
        removeClassName(_this.element, _this.options.activeClassName);
        document.documentElement.removeEventListener('mousemove', dragElt, false);
        document.documentElement.removeEventListener('mouseup', stopDragElt, false);
        _this.isDragged = false;
    }

    this.options    =extend(clone(defaults), opts);
    this.element    =elt;
    this.ghost      =null;
    this.startX     =0;
    this.startY     =0;
    this.itemX      =0;
    this.itemY      =0;
    this.isDragged  =false;

    addClassName(this.element, this.options.className);
    if (this.options.handler===null) {
        var handler = document.createElement( this.options.handlerElement );
        addClassName(handler, this.options.handlerClassName);
        this.element.appendChild(handler);
        this.options.handler = handler;
    }
    if (this.options.handlerTitle!==undefined && this.options.handlerTitle!==null && this.options.handlerTitle.length>0) {
        this.options.handler.setAttribute('title', this.options.handlerTitle);
    }
    _this = clone(this);
    this.options.handler.onmousedown = function(e){ _mouseDown(e, _this); return false; };
    this.options.handler.onselectstart = function(){ return false; };
    return this;
}

/**
 * Extend the Element prototype to allow "element._draggable(opts)"
 */
Element.prototype._draggable = function(opts) {
    Draggable(this, opts);
};

// Endfile