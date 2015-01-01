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