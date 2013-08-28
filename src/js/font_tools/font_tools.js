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


// Settings : global javascript options of pages
var settings; if (settings===undefined) settings = [];

// The default units and range for the font-size tool
settings.defaultFontSizeUnits = [
	[ 'px', 4 ],
	[ 'pt', 3 ],
	[ 'em', 0.3 ],
	[ '%', 25 ]
];

// Keep traces of all original font-sizes by id
var FONTSIZE_ORIGINALS={};

/**
 * Change a font-size of a DOM block by its ID.
 * @param string action The action to execute on font-size : '+' to increase it, '-' to decrease it and '0' for the original size
 * @param string id A dom block ID for selection
 * @param float range The range to use for increase/decrease font-size
 * @param string def The default original font-size to use if it's not set in CSS
 */
function font_size(action, id, range, def) {
	if (typeof this.window['_dbg_info'] == 'function') {
		_dbg_info('[text_size()] New call for action ['+action+'] on dom ID=['+id+'] with range=['+range+'] and default font-size=['+def+']');
	}

	var _unit, _new_size=false,
	getParentFontSize = function(_node) {
		var fontsize = null;
		while (_node!==undefined && (fontsize===null || fontsize==='')) {
			_node = _node.parentNode;
			if (_node!==undefined) {
				if (_node.currentStyle) {
					fontsize = _node.currentStyle['fontSize'];
				}
				else if (document.defaultView && document.defaultView.getComputedStyle) {
					fontsize = document.defaultView.getComputedStyle(_node,null).getPropertyValue('font-size');
				}
				else if (_node.style!==undefined) {
					fontsize = _node.style.fontSize; 
				}
			}
		}
		return fontsize;
	};

	var domobj = document.getElementById( id );
	if (domobj) {
		var current_fs = domobj.style.fontSize || getParentFontSize(domobj) || def;
		if (current_fs===null || current_fs==='') {
			throw new Error('No font-size defined for dom ID ['+id+']!');
			return;
		}
		if (FONTSIZE_ORIGINALS[id]===undefined) {
			FONTSIZE_ORIGINALS[id]=current_fs;
		}
		
		var current_fs_val, _range;
		for (var i in settings.defaultFontSizeUnits) {
			_str = current_fs.replace(settings.defaultFontSizeUnits[i][0], '');
			if (_str!==current_fs) {
				_unit = settings.defaultFontSizeUnits[i][0];
				current_fs_val = parseFloat(_str);
				_range = range || settings.defaultFontSizeUnits[i][1];
			}
		}
		if (typeof this.window['_dbg'] == 'function') {
			_dbg('_unit=['+_unit+'] _range=['+_range+'] current_fs_val=['+current_fs_val+']');
		}

		if (action==='+') { _new_size = (current_fs_val + _range) + _unit; }
		else if (action==='-') { _new_size = (current_fs_val - _range) + _unit; }
		else if (action==='0') { _new_size = FONTSIZE_ORIGINALS[id]; }

		if (_new_size) {
			if (typeof this.window['_dbg'] == 'function') {
				_dbg('setting size on new value = '+_new_size);
			}
			domobj.style.fontSize = _new_size;
		}
	}
}

// Endfile