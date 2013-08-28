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


/**
 * Execute a function after document is fully loaded
 *
 * USAGE:
 *     onDocumentLoad(function() {
 *     	  my_func( some, arguments);
 *     	  etc ...
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