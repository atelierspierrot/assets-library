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
 * Window Sizes
 *
 * Returns infos about current window loaded in an array() :
 * -> width : window's width
 * -> height : window's height
 * -> scrol_x : window's scroll X position
 * -> scrol_y : window's scroll Y position
 * -> top : window's top position
 * -> left : window's left position
 */
function getWindowSizes() {
    var sizes = {
        width: (window.innerWidth != null) ?
            window.innerWidth : (document.documentElement && document.documentElement.clientWidth) ?
                document.documentElement.clientWidth : (document.body != null) ?
                    document.body.clientWidth : 0,
        height: (window.innerHeight != null) ?
            window.innerHeight : (document.documentElement && document.documentElement.clientHeight) ?
                document.documentElement.clientHeight : (document.body != null) ?
                    document.body.clientHeight : 0,
        left: (window.screenX != null) ?
            window.screenX : (window.top.screenLeft != null) ?
                window.top.screenLeft : 0,
        top: (window.screenY != null) ?
            window.screenY : (window.top.screenTop != null) ?
                window.top.screenTop : 0,
        right: (this.left != "0") ? this.left+this.width : "0",
        bottom: (this.top != "0") ? this.top+this.height : "0",
        scrol_x: (typeof(window.pageXOffset) != 'undefined') ?
            window.pageXOffset : (document.documentElement && document.documentElement.scrollTop) ?
                document.documentElement.scrollTop : (document.body != null && document.body.scrollTop) ?
                    document.body.scrollTop : 0,
        scrol_y: (typeof(window.pageYOffset) != 'undefined') ?
            window.pageYOffset : (document.documentElement && document.documentElement.scrollLeft) ?
                document.documentElement.scrollLeft : (document.body != null && document.body.scrollLeft) ?
                    document.body.scrollLeft : 0
    };
    if (typeof this.window['_dbg'] == 'function')
        _dbg("width="+sizes['width']+" height="+sizes['height']+" top="+sizes['top']+" left="+sizes['left'], "CURRENT WINDOW DATA");
    return sizes;
}

// Endfie