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

(function(window, undefined) {

    var PiwiInit = false;
    var error_str_mask = '[ERROR] %d : %s';
    var error_codes = {
        load: 1,
        type: 2,
    };

    // Piwi errors
    function PiwiError(msg,url,lno) {
        throw new Error(msg);
/*
        throw { 
            name:        "Piwi Error", 
            level:       "Show Stopper", 
            message:     msg, 
            htmlMessage: msg 
        };
*/
    };

    // Piwi loader
    function PiwiLoader(fct,filename,path) {
        if (window[fct]===undefined) {
//            include( (path!==undefined && path!==null ? path : '')+filename );
            addJavascript( (path!==undefined && path!==null ? path : '')+filename );
        }
        return (window[fct]!==undefined);
    };

    // PHP ucfirst() equivalent
    function capitaliseFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    };

    var PiwiFramework = function() {

        this.options = {
            console: null,
            debug: false
        };

        return {

            // initialize the framework setting options
            init: function(args) {
                if (!PiwiInit) {
                    for (var index in args) {
                        this.setOption(index, args[index]);
                    }
                    PiwiInit = true;
                }
                return this;
            },

            // set option `opt` on value `val`
            setOption: function(opt,val) {
console.debug('setting option '+opt+' on value '+val);
                options.opt = val;
                return this;
            },

            // get option `opt` value or default `def`
            getOption: function(opt,def) {
                return options[opt] || def || null;
            },

            // load the js file `file` in current document if function `fct` doesn't exist
            load: function(fct, file, path) {
                PiwiLoader(fct, file, path);
                return this;
            },

            // throw a `PiwiError`
            error: function(str, _code) {
                var code = _code || 0,
                    error_str = error_str_mask.replace('%d', code).replace('%s', str);
                PiwiError(error_str);
                return this;
            },

// DEPENDENCIES
            
            select: function(what) {
                if (typeof window.Select==='function') {
                    return Select(what);
                }
            },
            
            onDocReady: function(what) {
                if (typeof window.onDocumentLoad==='function') {
                    return onDocumentLoad(what);
                }
                return this;
            }

        };
    };

    return(
    	window.Piwi = PiwiFramework,
    	window.$ = PiwiFramework()
    );
})(window);

// Endfile