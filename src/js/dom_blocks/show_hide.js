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
 * Show/Hide toggler
 */

// Settings : global javascript options of pages
var settings; if (settings===undefined) settings = [];

// Settings : global javascript options for ShowHide functionality
var ShowHideSettings = {};

/**
 * For accessibility : hidden blocks will be visibles if JS disabled
 *
 * Options can be :
 * -   'hide_class' (string) : the class used to hide a block
 * -   'show_class' (string) : the class used to show a block
 * -   'handler_hide_class' (string) : the class used on handler when a block is hidden
 * -   'handler_show_class' (string) : the class used on handler when a block is shown
 * -   'handler_hidden_content' (string) : the content of a handler when a block is hidden
 * -   'handler_shown_content' (string) : the content of a handler when a block is shown
 *
 * @param array|object The options table
 */
function show_hide_init(options) {
	hide_class = options.hide_class || settings.hide_class || null;
	if (hide_class!==null) {
		ShowHideSettings.hide_class = hide_class;
		document.write(
			"<style type='text/css'"+">"
			+"."+ShowHideSettings.hide_class+"{display:none;visibility:hidden}"
			+"<\/"+"style>"
		);
	}
	show_class = options.show_class || settings.show_class || null;
	if (show_class!==null) {
		ShowHideSettings.show_class = show_class;
		document.write(
			"<style type='text/css'"+">"
			+"."+ShowHideSettings.show_class+"{display:block;visibility:visible}"
			+"<\/"+"style>"
		);
	}
	handler_hide_class = options.handler_hide_class || settings.handler_hide_class || null;
	if (handler_hide_class!==null) {
		ShowHideSettings.handler_hide_class = handler_hide_class;
	}
	handler_show_class = options.handler_show_class || settings.handler_show_class || null;
	if (handler_show_class!==null) {
		ShowHideSettings.handler_show_class = handler_show_class;
	}
	handler_hidden_content = options.handler_hidden_content || settings.handler_hidden_content || null;
	if (handler_hidden_content!==null) {
		ShowHideSettings.handler_hidden_content = handler_hidden_content;
	}
	handler_shown_content = options.handler_shown_content || settings.handler_shown_content || null;
	if (handler_shown_content!==null) {
		ShowHideSettings.handler_shown_content = handler_shown_content;
	}
}

/**
 * Call of the "toggleShowHide" function with a return (for onclick usage for example)
 * See "toggleShowHide()" for parameters
 */
function show_hide(id, handler_id, options) {
	var toggler = toggleShowHide( id, handler_id, options );
	return true===toggler;
}

/**
 * Show or hide the block with ID "id"
 *
 * Options can be :
 * -   any of the settings values concerning the ShowHide tool (see above)
 * -   'hash_tag: true' (default false) : add or remove the handler ID as a hash in document location
 * -   'toggle_handler_class: false' (default true) : toggle the handler block class if "handler_hide_class" and "handler_show_class" are defined in settings
 * -   'toggle_handler_content: false' (default true) : toggle the handler block content if "handler_hidden_content" and "handler_shown_content" are defined in settings
 * -   'display: str' : the default "display" CSS attribute
 *
 * @param string id The ID string of the toggled block (required)
 * @param string handler_id The ID string of the handler (optional)
 * @param array|object options A set of options to override current ShowHide settings (optional)
 */
function toggleShowHide(id, handler_id, options) {
	this.options = options;
	var domobj = document.getElementById( id ),
		_hbs = false, // Has Been Shown
		_hbh = false; // Has Been Hidden
	if (domobj) {
		if (typeof this.window['_dbg_info'] == 'function') {
			_dbg_info('[toggleShowHide()] Working for id=['+id+'] on DOM=['+domobj+'] with handler_id=['+handler_id+']');
		}
		if (options && typeof this.window['_dbg_log'] == 'function') {
			_dbg_log('options are : ', options);
		}
		var _visible = domobj.style.visibility,
			classes = getClasses(domobj),
			showcls_i = getOption('show_class')!==undefined && getClassNameIndex(domobj, getOption('show_class')),
			hidecls_i = getOption('hide_class')!==undefined && getClassNameIndex(domobj, getOption('hide_class')),
			handler_el = handler_id ? document.getElementById( handler_id ) : null;

		if (hidecls_i) {
			if (getOption('show_class')!==undefined) {
				classes[hidecls_i] = getOption('show_class');
			} else {
				classes[hidecls_i] = null;
			}
			_hbs=true;
			domobj.className = classes.join(" ");
		} else if (showcls_i) {
			if (getOption('hide_class')!==undefined) {
				classes[showcls_i] = getOption('hide_class');
			} else {
				classes[showcls_i] = null;
			}
			_hbh = true;
			domobj.className = classes.join(" ");
		} else if (getOption('hide_class')!==undefined) {
			classes.push( getOption('hide_class') );
			_hbh = true;
			domobj.className = classes.join(" ");
		} else {
			if (_visible==='hidden') {
				domobj.style.visibility='visible';
				domobj.style.display= getOption('display') || 'block';
				_hbs = true;
			} else {
				domobj.style.visibility='hidden';
				domobj.style.display='none';
				_hbh = true;
			}
		}

		if (handler_id!==undefined && getOption('hash_tag', false)===true) {
			if (_hbs && window.location.hash!=='#'+handler_id) {
				window.location.hash = handler_id;
			}
			else if (_hbh && window.location.hash==='#'+handler_id) {
				window.location.hash = '#';
			}
		}

		if (handler_el) {
			var _h_classes = getClasses(handler_el),
				_h_showcls_i = getOption('handler_show_class')!==undefined && getClassNameIndex(handler_el, getOption('handler_show_class')),
				_h_hidecls_i = getOption('handler_hide_class')!==undefined && getClassNameIndex(handler_el, getOption('handler_hide_class'));
			if (getOption('toggle_handler_class', true)===true) {
				if (_hbs) {
					if (getOption('handler_show_class') != undefined) {
						_h_classes[_h_hidecls_i] = getOption('handler_show_class');
					} else {
						_h_classes[_h_hidecls_i] = null;
					}
				}
				else if (_hbh) {
					if (getOption('handler_show_class') != undefined) {
						_h_classes[_h_showcls_i] = getOption('handler_hide_class');
					} else {
						_h_classes[_h_showcls_i] = null;
					}
				}
				handler_el.className = _h_classes.join(" ");
			}
			if (getOption('toggle_handler_content', true)===true) {
				if (_hbs && getOption('handler_shown_content')!==undefined) {
					handler_el.innerHTML = getOption('handler_shown_content');
				}
				else if (_hbh && getOption('handler_hidden_content')!==undefined) {
					handler_el.innerHTML = getOption('handler_hidden_content');
				}
			}
		}

	} else {
		// for onclick triggers on a non-existant dom object
		return true;
	}
	
	function getOption( str, def ) {
		if (this.options!==undefined && this.options[str]!==undefined)
			return this.options[str];
		if (ShowHideSettings[str]!==undefined)
			return ShowHideSettings[str];
		if (settings[str]!==undefined)
			return settings[str];
		if (def!==undefined)
			return def;
		return undefined;
	}

}

// Endfile