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
 * Checks or unckecks all checkboxes with name "check_name" in form "form" 
 */
function checkAll( form, check_name, handler ) 
{
	var _form = typeof(form)==='object' ? form : eval("document."+form);
	if (typeof this.window['_dbg_info']==='function') {
		_dbg_info('[checkAll()] Working on form=['+form+'] | check_name=['+check_name+'] | handler=['+handler+'] | our working form is '+_form);
	}
	var check_all = handler || check_name+'_all',
		form_chkall = typeof(form)=='object' ? form.check_all : eval("document."+form+"."+check_all);
	if (form_chkall===undefined) {
		for (var i = _form.elements.length - 1; i >= 0; i = i - 1) {
			if (_form.elements[i].name===check_all) {
				form_chkall = _form.elements[i];
			}
		}
	}
	if (form_chkall!==undefined) {
		setTimeout(function() {
			for (var i = _form.elements.length - 1; i >= 0; i = i - 1) {
				var el = _form.elements[i];
				if (el.name == check_name) {
					el.checked = form_chkall.checked;
				}
				else if (el.name == check_name+"[]") {
					el.checked = form_chkall.checked;
				}
			}
		},10);
		return true;
	}
	if (typeof this.window['_dbg'] == 'function') {
		_dbg('ERROR: check_name "'+check_name+'" not found!');
	}
	return false;
}

// Endfile