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
 * Build a set of tabs from a list of handlers links toggling a list of tab contents.
 */
function TabContent() {

    // all object default properties
    this._selectors_tabs 			= {};
    this._handlers_tabs 			= {};
    this._contents_tabs 			= {};
    this._indexed_tabs_ids 			= [];
    this._silent					= false;
    this._handler_list_id 			= 'tabs';
    this._handler_list_el 			= 'ul';
    this._handler_item_el 			= 'li';
    this._tab_selector_el 			= 'a';
    this._tab_selector_attribute 	= 'href';
    this._show_class 				= 'selected';
    this._hide_class 				= 'hide';
    this._collapsible				= false;
    this._cookie_name 				= 'jstabs';
    this._use_cookie				= true;

	// initialization of the whole TAB object	
	this.init = function() {
		var _cookie, _collapse,
			tabList = document.getElementById(this._handler_list_id);
		if (tabList) {
			// grab the tab links and content divs from the page
			var children = tabList.childNodes;
			for (var i=0, len=children.length; i<len; i++) {
				if (children[i].nodeName.toLowerCase()===this._handler_item_el) {
					var tabLink = getFirstChildByTagName( children[i], this._tab_selector_el );
					if (tabLink) {
						var id = getHash( tabLink.getAttribute(this._tab_selector_attribute) );
						if (id) {
							this._indexed_tabs_ids.push(id);
							this._handlers_tabs[id] 	= children[i];
							this._selectors_tabs[id]    = tabLink;
							this._contents_tabs[id] 	= document.getElementById( id );
						}
					}
				}
			}

			// get the cookie value if so
			if (this._use_cookie) {
				var _cookie = getCookie( this._cookie_name );
				if (_cookie && -1!=_cookie.lastIndexOf(':')) {
					_cook_tbl = _cookie.split(":");
					_cookie = _cook_tbl[1];
					_collapse = _cook_tbl[0];
				}
			}

			// assign onclick events to the tab links
			// highlight the first tab
			var i=0, _this=this;
			for (var id in this._selectors_tabs) {
				this._selectors_tabs[id].onclick = function(e,s){ return toggleTabEvent(e, s, _this); };
				this._selectors_tabs[id].onfocus = function(e){ this.blur(); };
				if (this._use_cookie && _cookie!==null) {
					if (_cookie===id) {
						if (_collapse!==undefined && _collapse==="collapse") {
							this.showTab( getHash( this._selectors_tabs[id].getAttribute(this._tab_selector_attribute) ), true );
						}
						else {
							this.showTab( getHash( this._selectors_tabs[id].getAttribute(this._tab_selector_attribute) ) );
						}
					}
				}
				else if (i==0) {
					this.showTab( getHash( this._selectors_tabs[id].getAttribute(this._tab_selector_attribute) ) );
				}
				i++;
			}
		}
		else if (!this._silent) {
			throw new Error('Handlers list for TABS not found!');
		}
	};

// ------------------
// PUBLIC METHODS
// ------------------

	// show a specific tab by its ID (and collapse it if "_collapse==true")	
	this.showTab = function(_sel, _collapse) {
		var sel = _sel || getHash( this.getAttribute(this._tab_selector_attribute) );
		var collapse = _collapse || false;

		// Highlight the selected tab, and dim all others.
		// Also show the selected content div, and hide all others.
		for (var id in this._contents_tabs) {
			if (id===sel) {
				if (collapse && this._collapsible && !hasClassName(this._contents_tabs[id], this._hide_class)) {
					removeClassName( this._selectors_tabs[id], this._show_class );
					removeClassName( this._handlers_tabs[id], this._show_class );
					addClassName( this._contents_tabs[id], this._hide_class );
					if (this._use_cookie) {
						setCookie( 'collapse:'+id, this._cookie_name );
					}
				}
				else {
					addClassName( this._selectors_tabs[id], this._show_class );
					addClassName( this._handlers_tabs[id], this._show_class );
					removeClassName( this._contents_tabs[id], this._hide_class );
					if (this._use_cookie) {
						setCookie( id, this._cookie_name );
					}
				}
			}
			else {
				removeClassName( this._selectors_tabs[id], this._show_class );
				removeClassName( this._handlers_tabs[id], this._show_class );
				addClassName( this._contents_tabs[id], this._hide_class );
			}
		}
	};

	// open next tab
	this.nextTab = function() {
		var j, _selected = this.getSelectedTab();
		for (var i=0, len=this._indexed_tabs_ids.length; i<len; i++) {
			j = parseInt(i+1);
			if (this._indexed_tabs_ids[i]==_selected) {
				if (i===len-1) {
					return this.showTab(this._indexed_tabs_ids[0]);
				}
				else {
					return this.showTab(this._indexed_tabs_ids[j]);
				}
			}
		}
	};

	// open previous tab
	this.previousTab = function() {
		var j, _selected = this.getSelectedTab();
		for (var i=0, len=this._indexed_tabs_ids.length; i<len; i++) {
			j = parseInt(i-1);
			if (this._indexed_tabs_ids[i]==_selected) {
				if (i===0) {
					return this.showTab(this._indexed_tabs_ids[len-1]);
				}
				else {
					return this.showTab(this._indexed_tabs_ids[j]);
				}
			}
		}
	};

	// get selected tab ID
	this.getSelectedTab = function() {
		for (var id in this._contents_tabs) {
			if (!hasClassName(this._contents_tabs[id], this._hide_class)) {
				return id;
			}
		}
		return false;
	};

// ------------------
// PRIVATE METHODS
// ------------------

	// toggle the "showTab()" method on click event	
	var toggleTabEvent = function( e, _sel, _this ) {
		var sel = _sel || getHash( e.target.getAttribute(_this._tab_selector_attribute) );
		_this.showTab( sel, true );
		// stop the browser following the link
		return false;
	},

	getFirstChildByTagName = function( element, tagName ) {
		for (var i=0; i<element.childNodes.length; i++) {
			if (element.childNodes[i].nodeName.toLowerCase()===tagName) {
				return element.childNodes[i];
			}
		}
	},

	getHash = function( url ) {
		if (url===undefined || url===null) { return false; }
		var hashPos = url.lastIndexOf('#');
		return url.substring( hashPos+1 );
	};

    if (arguments.length) { extend(this, arguments[0], '_%s'); }
    if (typeof window['_dbg_info'] == 'function')
        _dbg_info("[Tab Content] Creating new tabs with :"
            +"\n _handler_list_id: "+this._handler_list_id
            +"\n _handler_list_el: "+this._handler_list_el
            +"\n _handler_item_el: "+this._handler_item_el
            +"\n _tab_selector_el: "+this._tab_selector_el
            +"\n _tab_selector_attribute: "+this._tab_selector_attribute
            +"\n _show_class: "+this._show_class
            +"\n _hide_class: "+this._hide_class
            +"\n _collapsible: "+this._collapsible
            +"\n _use_cookie: "+this._use_cookie
            +"\n _cookie_name: "+this._cookie_name
            +"\n _silent: "+this._silent
        );
    this.init();
    return this;
};

// Endfile