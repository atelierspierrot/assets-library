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


/*****************************************/
// dialog-box

(function(window, undefined) {

    var _this = this,
        isOpened = false,
        isInited = false,
        templates = {}, 
        promptResult = null,    
        prompterDefaults = {
            fieldName: 'promptfield',
            info: null,
            title: null,
            placeholder: null,
            callback: function(data){ promptResult = data; return promptResult; }
        },
        defaults = {
        // sizes
            width: 320,
            height: 120,
            safeMargin: 80,
        // templates
            // overlay
            overlayClass: 'dialogbox-overlay',
            // global wrapper
            wrapperClass: 'dialogbox',
            // dialogbox content
            contentClass: 'dialogbox-content',
            // dialogbox header
            headerClass: 'dialogbox-header',
            titleblockClass: 'dialogbox-title',
            titleblockElement: 'h3',
            closerblockClass: 'dialogbox-closer',
            closerHandlerClass: 'closer-text',
            closerHandlerText: 'Close',
            closerTitle: 'Close this window (or press ESC)',
            closerXContent: '&times;',
            closerXClass: 'closer-x',
            // dialogbox footer
            footerClass: 'dialogbox-footer',
            btnblockClass: 'dialogbox-footer-content',
        // utilities
            loadingImg: 'loader.gif',
            formName: 'dialog-box-form',
            formMethod: 'post',
            buttons: {
                submit: {
                    text: 'OK',
                    _class: 'dialogbox-button submit-btn',
                    click: "DialogBox('submitForm');"
                },
            },
            draggable: true,
            draggableOptions: {
                outbound: false,
                frame: 'window',
                useGhost: false,
                handlerTitle: 'Click to drag this dialog box'
            },
        // contents
            title: 'Dialog',
            content: '',
            callback: function(){}
        };

    DialogBox = function(method) {
        if (typeof method==='string') {
            if (!isInited) {
                _this = new DialogBox();
            }
            if (_this[method]) {
                return _this[method].apply(this, Array.prototype.slice.call(arguments, 1));
            }
            else {
                throw 'Method '+method+' does not exist on DialogBox!';
            }    
        }
        else if (typeof method==='object' || !method) {
            return this.init.apply(this, arguments);
        }
    };

// ------------------
// Public methods
// ------------------

    DialogBox.prototype.init = function( opts ) {
        if (!isInited) {
            _this = this;
            this.options = {};
            cloneObject(this.options, defaults);
            extendObject(this.options, opts);
            drawTemplate();
            document.onkeydown = function(evt) {
                evt = evt || window.event;
                if (evt.keyCode == 27) {
                    if (isOpened) { DialogBox('close'); }
                }
            };
            isInited = true;
        }
        return _this;
    };

    DialogBox.prototype.open = function( content, title, width, height, callback ) {
        console.debug('opening dialog box');
        _this.update(content, title);
        refreshSizes();
        positionBox(width, height);
        if (callback!==undefined && callback!==null && typeof callback==='function') {
            _this.options.callback = callback;
        }
        templates.overlay.style.visibility = "visible";
        templates.wrapper.style.visibility = "visible";
        isOpened = true;
        return false;
    };

    DialogBox.prototype.close = function() {
        console.debug('closing dialog box');
        templates.overlay.style.visibility = "hidden";
        templates.wrapper.style.visibility = "hidden";
        isOpened = false;
        return false;
    };

    DialogBox.prototype.openForm = function( fields, title, width, height, callback ) {
        var _form = document.createElement('form');
        _form.setAttribute('name',_this.options.formName);
        _form.setAttribute('id',_this.options.formName);
        _form.setAttribute('method',_this.options.formMethod);
        _form.setAttribute('action',"#");
        _form.setAttribute('onSubmit',"DialogBox('formSubmit');");
        for(var _ind in fields) {
            if (fields[_ind]!==undefined && fields[_ind]!==null && typeof fields[_ind]==='object') {
                _form.appendChild(fields[_ind]);
            }
        }
        _this.updateFooter();
        showFooter();
        _this.open(_form, title, width, (height || 180), callback);
    };

    DialogBox.prototype.submitForm = function() {
        var _form = document.getElementById(_this.options.formName);
        if (_form.getValues===undefined || typeof _form.getValues!=='function') {
            throw 'Function "getValues()" on "FormElement" prototype is not loaded!';
        }
        var data = _form.getValues();
        _this.update( getLoader() );
        // user callback if so
        result = _this.options.callback.apply( this, [data] );
        if (result!==undefined && result!==null) {
            hideFooter();
            _this.update(result);
        }
        else {
            hideFooter();
            _this.close();
        }
        return false;
    };

    DialogBox.prototype.prompt = function( info, title, placeholder, callback ) {
        _this.prompter = {};
        cloneObject(_this.prompter, prompterDefaults);
        extendObject(_this.prompter, {
            info:info, title:title, placeholder:placeholder,callback:callback
        });
        var label = document.createElement("label"),
            input = document.createElement("input");
        label.setAttribute('for',_this.prompter.fieldName);
        label.innerHTML = info;
        input.setAttribute('type',"text");
        input.setAttribute('name',_this.prompter.fieldName);
        input.setAttribute('id',_this.prompter.fieldName);
        input.setAttribute('placeholder', (placeholder || ''));
        _this.openForm( [label,input], title, null, null, _this.promptCallback);
    };
    
    DialogBox.prototype.promptCallback = function( data ) {
        prompterResult = data[_this.prompter.fieldName] || '';
        result = _this.prompter.callback.apply( this, [prompterResult] );
        if (result!==undefined && result!==null) {
            hideFooter();
            _this.update(result);
        }
        else {
            hideFooter();
            _this.close();
        }
        return prompterResult;
    };

    DialogBox.prototype.ajaxLoad = function( url, title, width, height, callback ) {
        if (window['Ajax']===undefined || typeof Ajax!=='function') {
            throw 'Function "Ajax" is not loaded! Ajax loading is aborted.';
        }
        _this.open(getLoader(), title, width, height, callback);
        Ajax({
            url: url, 
            success:function(resp, e) {
                _this.update( resp );
                positionBox( null, 'auto' );
            },
            error: function(resp, e) {
                _this.update( 'An error occured : '+resp );
            }
        });
    };

    DialogBox.prototype.updateFooter = function() {
        templates.btnblock.innerHTML = '';
        for(var _ind in _this.options.buttons) {
            var btn = document.createElement('input');
            btn.setAttribute('type',_ind);
            btn.setAttribute('value',_this.options.buttons[_ind].text);
            btn.setAttribute('class', (_this.options.buttons[_ind]._class || ''));
            btn.setAttribute('onclick', (_this.options.buttons[_ind].click || ''));
            templates.btnblock.appendChild(btn);
        }
    };

    DialogBox.prototype.update = function( content, title ) {
        if (content!==undefined && content!==null) {
            this.options.content = content;
            templates.content.innerHTML = '';
            if (typeof this.options.content==='object') {
                templates.content.appendChild(this.options.content);
            }
            else {
                templates.content.innerHTML = this.options.content;
            }
        }
        if (title!==undefined && title!==null) {
            this.options.title = title;
            templates.titleblock.innerHTML = this.options.title;
        }
    };

// ------------------
// Private methods
// ------------------

    function extendObject( obj, opts ) {
        for (var prop in opts) {
            if (opts[prop]!==undefined && obj.hasOwnProperty(prop)) {
                obj[prop] = opts[prop];
            }        
        }
    };

    function cloneObject( obj, original ) {
        for (var prop in original) {
            obj[prop] = original[prop];
        }
    };

    function drawHeader() {
        // header block
        templates.header = document.createElement('div');
        templates.header.setAttribute('class',_this.options.headerClass);
        // title block
        templates.titleblock = document.createElement(_this.options.titleblockElement);
        templates.titleblock.setAttribute('class',_this.options.titleblockClass);
        // closer block
        templates.closerblock = document.createElement('div');
        templates.closerblock.setAttribute('class',_this.options.closerblockClass);
        // closer handler
        var closer = document.createElement('a'),
            closer_handler = document.createElement('span'),
            closer_x = document.createElement('span');
        closer_handler.setAttribute('class',_this.options.closerHandlerClass);
        closer_handler.innerHTML = _this.options.closerHandlerText;
        closer.setAttribute('title',_this.options.closerTitle);
        closer.setAttribute('href','#');
        closer.setAttribute('onclick','return DialogBox(\'close\');');
        closer.appendChild(closer_handler);
        closer_x.innerHTML = _this.options.closerXContent;
        closer_x.setAttribute('class',_this.options.closerXClass);
        closer.appendChild(closer_x);
        templates.closerblock.appendChild( closer );

        // build the whole thing
        templates.header.appendChild( templates.titleblock );
        templates.header.appendChild( templates.closerblock );
        templates.wrapper.appendChild( templates.header );
    }
    
    function drawFooter() {
        templates.footer = document.createElement('div');
        templates.footer.setAttribute('class',_this.options.footerClass);
        templates.btnblock = document.createElement('div');
        templates.btnblock.setAttribute('class',_this.options.btnblockClass);
        templates.footer.appendChild( templates.btnblock );
    }
    function showFooter() {
        templates.wrapper.appendChild( templates.footer );
    }
    function hideFooter() {
        try {
            templates.wrapper.removeChild( templates.footer );
        } catch(e) {}
    }
    
    function drawContent() {
        templates.content = document.createElement('div');
        templates.content.setAttribute('class',_this.options.contentClass);
        templates.wrapper.appendChild( templates.content );
    }
    
    function drawTemplate() {
        // overlay
        templates.overlay = document.createElement('div');
        templates.overlay.setAttribute('class',_this.options.overlayClass);
        // wrapper
        templates.wrapper = document.createElement('div');
        templates.wrapper.setAttribute('class',_this.options.wrapperClass);
        templates.wrapper.setAttribute('draggable','true');

        // dialogbox blocks
        drawHeader();
        drawContent();
        drawFooter();

        // adding the whole thing to document
        var _body = document.getElementsByTagName('body')[0];
        _body.appendChild( templates.overlay );
        _body.appendChild( templates.wrapper );
        if (_this.options.draggable) {
            var _opts = clone(_this.options.draggableOptions);
            _opts.handler = templates.titleblock;
            templates.wrapper._draggable(_opts);
        }
    }
    
    function refreshSizes() {
        extendObject(_this.options, {
            width: defaults.width,
            height: defaults.height
        });
    }

    function getLoader() {
        var loader = document.createElement('img');
        loader.setAttribute('src', _this.options.loadingImg);
        loader.setAttribute('alt', 'Loading ...');
        return loader;
    }

    function positionBox( width, height ) {
        console.debug('positioning dialog box');

        // document sizes
        // from: http://stackoverflow.com/questions/1145850/get-height-of-entire-document-with-javascript
        var body = document.body,
            html = document.documentElement,
            docWidth =  Math.max( body.scrollWidth, body.offsetWidth, html.clientWidth, html.scrollWidth, html.offsetWidth ),
            docHeight =  Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight );

        // overlay sizes
        templates.overlay.style.width = docWidth + "px";
        templates.overlay.style.height = docHeight + "px";

        // window sizes
        var windowWidth = (window.innerWidth != null) ? 
                window.innerWidth : (document.documentElement && document.documentElement.clientWidth) ?
                    document.documentElement.clientWidth : (document.body != null) ? 
                        document.body.clientWidth : 0,
            windowHeight = (window.innerHeight != null) ? 
                window.innerHeight : (document.documentElement && document.documentElement.clientHeight) ?  
                    document.documentElement.clientHeight : (document.body != null) ? 
                        document.body.clientHeight : 0;
    
        // dialogbox wrapper positions & sizes
        if (width!==undefined && width!==null) {
            _this.options.width = width;
        }
        if (_this.options.width>windowWidth) {
            var wrapper_margins_horizontal = 
                getStyleAttribute(templates.wrapper, 'padding-left', 'strip_px parseInt')
                + getStyleAttribute(templates.wrapper, 'padding-right', 'strip_px parseInt')
                + getStyleAttribute(templates.wrapper, 'margin-left', 'strip_px parseInt')
                + getStyleAttribute(templates.wrapper, 'margin-right', 'strip_px parseInt');
            _this.options.width = windowWidth - (_this.options.safeMargin+wrapper_margins_horizontal);
        }
        if (height!==undefined && height!==null) {
            if (height==='auto') {
                _this.options.height = 
                    estimateHeight( _this.options.content )
                    + templates.header.offsetHeight
                    + templates.footer.offsetHeight;
            }
            else {
                _this.options.height = height;
            }
        }
        if (_this.options.height>windowHeight) {
            var wrapper_margins_vertical = 
                getStyleAttribute(templates.wrapper, 'padding-top', 'strip_px parseInt')
                + getStyleAttribute(templates.wrapper, 'padding-bottom', 'strip_px parseInt')
                + getStyleAttribute(templates.wrapper, 'margin-top', 'strip_px parseInt')
                + getStyleAttribute(templates.wrapper, 'margin-bottom', 'strip_px parseInt');
            _this.options.height = windowHeight - (_this.options.safeMargin+wrapper_margins_vertical);
        }
        templates.wrapper.style.left = parseInt((windowWidth - _this.options.width)/2) + "px";
        templates.wrapper.style.top = parseInt((windowHeight - _this.options.height)/2) + "px";
        templates.wrapper.style.width = _this.options.width + "px";
        templates.wrapper.style.height = _this.options.height + "px";

        // dialogbox content sizes
        var ctt_margins_horizontal = 
            getStyleAttribute(templates.content, 'padding-left', 'strip_px parseInt')
            + getStyleAttribute(templates.content, 'padding-right', 'strip_px parseInt')
            + getStyleAttribute(templates.content, 'margin-left', 'strip_px parseInt')
            + getStyleAttribute(templates.content, 'margin-right', 'strip_px parseInt');
        var ctt_margins_vertical = 
            getStyleAttribute(templates.content, 'padding-top', 'strip_px parseInt')
            + getStyleAttribute(templates.content, 'padding-bottom', 'strip_px parseInt')
            + getStyleAttribute(templates.content, 'margin-top', 'strip_px parseInt')
            + getStyleAttribute(templates.content, 'margin-bottom', 'strip_px parseInt')
            + templates.header.offsetHeight
            + templates.footer.offsetHeight;

        templates.content.style.width = (_this.options.width - ctt_margins_horizontal) + "px";
        templates.content.style.height = (_this.options.height - ctt_margins_vertical) + "px";
    }

    function estimateHeight( element ) {
        var wrapper = document.createElement('div'),
            content = document.createElement('div'),
            _body = document.getElementsByTagName('body')[0],
            el_clone;

        if (element.cloneNode) {
            el_clone = element.cloneNode(true);
        }
        else {
            var text = document.createElement('div');
            text.innerHTML = element;
            el_clone = text.cloneNode(true);
        }
console.debug(el_clone);
        
        wrapper.setAttribute('class',_this.options.wrapperClass);
        content.setAttribute('class',_this.options.contentClass);
        content.appendChild( el_clone );
        wrapper.appendChild( content );
        wrapper.style.visibility = 'hidden';
        wrapper.style.position = 'absolute';
        _body.appendChild( wrapper );
        var result = wrapper.offsetHeight;
console.debug(result);
        _body.removeChild( wrapper );
        return result;
    }

})(window);

// Endfile