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
 * Execute a function after document is fully loaded
 *
 * USAGE:
 *     onDocumentLoad(function() {
 *       my_func( some, arguments);
 *       etc ...
 *     });
 */
function onDocumentLoad() {
    var _args = arguments[0],
        _doc_loaded_done=false,
        onDocumentLoaded = function() {
            if (_doc_loaded_done) { return; }
            _doc_loaded_done=true;
            if (_args) {
                try { _args.apply(); }
                catch(e) { _dbg("[onDocumentLoad::ERROR] "+e); }
            }
        },
        onDocumentLoaded_readyStateCheckInterval = setInterval(function() {
            if (document.readyState === "complete") {
                onDocumentLoaded();
                clearInterval(onDocumentLoaded_readyStateCheckInterval);
            }
        }, 10);
}

// Endfile