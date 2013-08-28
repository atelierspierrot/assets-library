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

/**
 * DEBUGGER - Write 'str' in console (FireBug for example) if present, or alert(str)
 * @param string str The text you want to be displayed
 * @param string title The title of your text | optional
 */
function _dbg(str, title)
{
	if (!title) { title = ""; }
	else { title = title+" : "; }
	if (window.console && window.console.log) { window.console.log(title + str); }
	else if (settings.debugg) { alert(title + str); }
}

/**
 * DEBUGGER INFO - Write 'str' in console (FireBug for example) if present
 * @param string str The text you want to be displayed
 * @param string title The title of your text | optional
 */
function _dbg_info(str, title)
{
	if (!title) { title = ""; }
	else { title = title+" : "; }
	if (window.console && window.console.info) { window.console.info(title + str); }
}

/**
 * DEBUGGER LOG - Write 'str' in console (FireBug for example) if present parsing it with arguments (like a sprintf() completion)
 */
function _dbg_log()
{
	if (window.console && window.console.log) {
		window.console.log.apply(null, arguments);
	}
}

// Endfile