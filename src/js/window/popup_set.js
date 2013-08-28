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
 * The following variables and functions are already defined:
 * -   function 'include(filename)' to include a file from javascript
 * -   the array 'settings' wich defines the global page user options
 */

// The global new window variable
var NEWPOPUPWINDOW;

// Settings : global javascript options of pages
var settings; if(settings===undefined) settings = [];

// Options
settings['default_popup_name']='popup';
settings['default_popup_width']='400';
settings['default_popup_height']='400';

// Inclusion of 'join' in Array prototype
include('array/join.js');

/**
 * Popup Set - Function to open a popup window.
 *
 * Args : (all optionals except url)
 * - url : page to open un popup
 * - w : popup width | default is 380px
 * - h : popup height | default is 230px
 * - focus : bool | default is TRUE
 * - options : popup window options, default : resizable=yes, toolbar=no, scrollbars=yes
 * - name : popup name | default is described ahead
 */
function popup_set(url, w, h, focus, options, name) {
	// defaults or args
	var width = (!w || w==="") ? settings.default_popup_width : w;
	var height = (!h || h==="") ? settings.default_popup_height : h;
	var name_f = (!name) ? settings.default_popup_name : name;
	// options
	var opt_set = {
		'directories': 0, 
		'menubar': 0, 
		'status': 0, 
		'location': 1, 
		'scrollbars': 1, 
		'resizable': 1, 
		'fullscreen': 0, 
		'width': width, 
		'height': height,
		'left': (screen.width - width)/2,
		'top': (screen.height - height)/2
	};
	var opt_f = _join(explode_options(options), '', ',');
	// function to analyze options to pass
	function explode_options(options) {
		if (!options) return opt_set;
		var opt_send = opt_set;
		var reg_first = new RegExp("[ ,]+", "g");
		var reg_second = new RegExp("[ =]+", "g");
		var opt_list = options.split(reg_first);
		for (var i=0; i<opt_list.length; i++) {
			var opt_tag = opt_list[i].split(reg_second);
			opt_send[opt_tag[0]] = opt_tag[1];
		}
		return opt_send;
	}
	if (typeof this.window['_dbg'] == 'function') {
		_dbg(url+" , "+name_f+" , "+opt_f, "Opening POPUP");
	}
	// create the new window
	NEWPOPUPWINDOW = window.open(url, name_f, opt_f);
	if (!focus || focus!==false) {
	    NEWPOPUPWINDOW.focus();
	}
	return false;
}

// Endfile