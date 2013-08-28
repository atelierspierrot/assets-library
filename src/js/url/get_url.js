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
# ***** SVN PROPERTIES *****
# $Revision: 605 $
# $Date: 2011-06-23 20:10:17 +0200 (Thu, 23 Jun 2011) $
# $Id: get_url.js 605 2011-06-23 18:10:17Z pierrecap $
# ***** END LICENSE BLOCK ***** */


/**
 * <b>Get Url</b>
 * Function that returns current url
 * Params : 'type' : 'param' 'base' or empty to the all url
 *
 * @param string type Set if you want to returns just the url's parametres, or base | optional | default is empty
 * @param string req_url The url you want to analyze | optional | default is current window url
 */
function get_url(type, req_url) {
	var url;
	if(req_url) url = req_url;
	else url = document.URL;
	var p_index = url.indexOf("?"), d_index = url.indexOf("#"), 
	t_url = (d_index!==-1) ? url.substring(0, d_index) : url;
	switch(type) {
		case 'param':
			var f_url = t_url.substr(p_index+1);
		break;
		case 'base':
			var f_url= t_url.substr(0,p_index);
		break;
		default:
			var f_url= t_url;
		break;
	}
	if(typeof this.window['_dbg'] == 'function')
		_dbg(f_url, "URL Analyze ("+type+")");
	return f_url;
}

// Endfie