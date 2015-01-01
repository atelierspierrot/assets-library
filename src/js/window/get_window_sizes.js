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