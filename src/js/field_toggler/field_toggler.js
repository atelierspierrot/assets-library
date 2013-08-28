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


// Keep traces of all fields models by id
var FIELDTOGGLER_MODELS={};

// Keep traces of all dom original innerHTML by id
var FIELDTOGGLER_INNERHTML={};

/**
 * Toggle a field in a dom object
 * @param string id The ID string of the collection holder (parent) | required
 * @param string field_name The name of the toggled field
 * @param string field_model The HTML string to put in the collection item | optional, if not set, the function will try to get
 *                    the "data-prototype" attribute of the parent
 * @param string action The action to execute for the toggling : 'replace' (default) to replace the content, 'add' to add the model after the block content, 
 *                    'back' to put the original content back
 */
function field_toggler( id, field_name, field_model, action )
{
	if (typeof this.window['_dbg_info'] == 'function')
		_dbg_info('[field_toggler()] Toggling field ['+field_name+'] for id=['+id+'] with model=['+field_model+']');
	var _parent = document.getElementById( id ),
		_action = action || 'replace';
	if (_parent)
	{
		if (_action=='replace' || _action=='add')
		{
			// make sure we have a model
			var mod = field_model || FIELDTOGGLER_MODELS[id] || _parent.getAttribute('data-prototype');
			if (FIELDTOGGLER_MODELS[id]==undefined) {
				FIELDTOGGLER_MODELS[id] = mod;
			}
			if (typeof this.window['_dbg'] == 'function') {
				_dbg('getting field model ['+mod+']');
			}
			if (mod==undefined)
			{
				throw new Error('No model set and no data-prototype attribute found!');
				return;
			}
			if (FIELDTOGGLER_INNERHTML[id]==undefined) {
				FIELDTOGGLER_INNERHTML[id] = _parent.innerHTML;
			}
			if (_action=='replace') {
				_parent.innerHTML = FIELDTOGGLER_MODELS[id];
			}
			else if (_action=='add') {
				_parent.innerHTML += FIELDTOGGLER_MODELS[id];
			}
		}
		else if (_action=='back')
		{
			if (FIELDTOGGLER_INNERHTML[id]!=undefined) {
				_parent.innerHTML = FIELDTOGGLER_INNERHTML[id];
			}
		}
	}
}

// Endfile