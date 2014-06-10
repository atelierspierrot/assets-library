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