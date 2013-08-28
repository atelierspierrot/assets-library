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
 * Adds the class "_class" to "block_id" if "check_id" is checked
 * Removes the class if it is unchecked
 */
function change_class_oncheck(_class, check_id, block_id) 
{
	var checkref = document.getElementById(check_id),
		blockref = document.getElementById(block_id),
		_patrn = new RegExp(_class, 'i');
	if(checkref) { 
		setTimeout(function() {
			if (checkref.checked && blockref) {
				blockref.className += " "+_class;
			} else if (blockref) {
				blockref.className = blockref.className.replace(_patrn, '');
			}
		},10);
	}
	return true;
}

/**
 * Check for all checkboxes with name "check_name" in form "_form" on document load and add class "_class" to parent "block_type"
 * Must be called after the HTML of the concerned form or when document is fully loaded
 */
function change_class_check_onload(_class, _form, check_name, block_type) 
{
	if (_form && _form.nodeName.toLowerCase()==='form') {
		for (i = _form.elements.length - 1; i >= 0; i = i - 1) {
			if (
				(_form.elements[i].name===check_name || _form.elements[i].name===check_name+"[]") &&
				_form.elements[i].checked!==undefined && _form.elements[i].checked && block_type
			) {
				var _node = _form.elements[i];
				while (_node!==null && _node.nodeName.toLowerCase()!==block_type.toLowerCase()) {
					_node = _node.parentNode;
				}
				if (_node) {
					_node.className += " "+_class;
				}
			}
		}
	}
}

// Endfile