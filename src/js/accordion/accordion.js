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
 * Build a set of accordion effect from a list of handlers links toggling a list of contents.
 */
Accordion.version = "1.0.0";
function Accordion() {

    // all object default properties
    this._headers_blocks 		= {};
    this._contents_blocks 		= {};
    this._indexed_blocks_ids 	= [];
    this._container_id 			= 'accordion';
    this._item_header_mask_id 	= 'accordion-header%s';
    this._item_content_mask_id 	= 'accordion-content%s';
    this._show_class 			= 'selected';
    this._hide_class 			= 'hide';
    this._collapsible			= false;
    this._cookie_name 			= 'jsaccordion';
    this._use_cookie			= true;
    this._silent				= false;

	// initialization of the whole TAB object	
	this.init = function() {
		var container = document.getElementById(this._container_id);
		if (container) {
			// grab the tab links and content divs from the page
			var children = container.childNodes,
			    _header_str = new RegExp( this._item_header_mask_id.replace('%s', '') ),
			    _content_str = new RegExp( this._item_content_mask_id.replace('%s', '') );
			for (var i=0, len=children.length; i<len; i++) {
                var _id = children[i].id,
                    _uniqid = _id && _id.replace(_header_str, '').replace(_content_str, '');
                // header
				if (_header_str.test(_id)) {
					this._headers_blocks[_uniqid] 	= children[i];
					this._indexed_blocks_ids.push(_uniqid);
				}
                // content
				else if (_content_str.test(_id)) {
					this._contents_blocks[_uniqid] 	= children[i];
				}
			}

			// get the cookie value if so
			var _cookie, _collapse;
			if (this._use_cookie) {
				var _cookie = getCookie( this._cookie_name );
				if (_cookie && -1!=_cookie.lastIndexOf(':')) {
					var _cook_tbl = _cookie.split(":");
					_cookie = _cook_tbl[1];
					_collapse = _cook_tbl[0];
				}
			}

			// assign onclick events to the tab links
			// highlight the first tab
			var i=0, _this=this;
			for (var id in this._headers_blocks) {
				this._headers_blocks[id].onclick = function(e){ return toggleEvent(e, this, _this); };
				if (this._use_cookie && _cookie!==null) {
					if (_cookie===id) {
						if (_collapse!==undefined && _collapse==="collapse") {
							this.showItem( this._contents_blocks[id], true );
						}
						else {
							this.showItem( this._contents_blocks[id] );
						}
					}
				}
				else if (i==0) {
					this.showItem( this._contents_blocks[id] );
				}
				i++;
			}
		}
		else if (!this._silent) {
			throw new Error('Handlers list for ACCORDION not found!');
		}
	};

// ------------------
// PUBLIC METHODS
// ------------------

	// show a specific tab by its ID (and collapse it if "_collapse==true")	
	this.showItem = function(_sel, _collapse) {
		var collapse = _collapse || false;
		var sel = this.getItemUniqId(_sel) || null;

		// Highlight the selected tab, and dim all others.
		// Also show the selected content div, and hide all others.
		for (var id in this._contents_blocks) {
			if (id===sel) {
				if (collapse && this._collapsible && !hasClassName(this._contents_blocks[id], this._hide_class)) {
					removeClassName( this._headers_blocks[id], this._show_class );
					addClassName( this._contents_blocks[id], this._hide_class );
					if (this._use_cookie) {
						setCookie( 'collapse:'+id, this._cookie_name );
					}
				}
				else {
					addClassName( this._headers_blocks[id], this._show_class );
					removeClassName( this._contents_blocks[id], this._hide_class );
					if (this._use_cookie) {
						setCookie( id, this._cookie_name );
					}
				}
			}
			else {
				removeClassName( this._headers_blocks[id], this._show_class );
				addClassName( this._contents_blocks[id], this._hide_class );
			}
		}
	};

	// open next tab
	this.nextItem = function() {
		var j, _selected = this.getSelectedItem();
		for (var i=0, len=this._indexed_blocks_ids.length; i<len; i++) {
			j = parseInt(i+1);
			if (this._indexed_blocks_ids[i]==_selected) {
				if (i===len-1) {
					return this.showItem(this._indexed_blocks_ids[0]);
				}
				else {
					return this.showItem(this._indexed_blocks_ids[j]);
				}
			}
		}
	};

	// open previous tab
	this.previousItem = function() {
		var j, _selected = this.getSelectedItem();
		for (var i=0, len=this._indexed_blocks_ids.length; i<len; i++) {
			j = parseInt(i-1);
			if (this._indexed_blocks_ids[i]==_selected) {
				if (i===0) {
					return this.showItem(this._indexed_blocks_ids[len-1]);
				}
				else {
					return this.showItem(this._indexed_blocks_ids[j]);
				}
			}
		}
	};

	// get selected tab ID
	this.getSelectedItem = function() {
		for (var id in this._contents_blocks) {
			if (!hasClassName(this._contents_blocks[id], this._hide_class)) {
				return id;
			}
		}
		return false;
	};

	// get a selection uniq ID
	this.getItemUniqId = function(sel) {
		var _header_str = new RegExp( this._item_header_mask_id.replace('%s', '') ),
			_content_str = new RegExp( this._item_content_mask_id.replace('%s', '') );
		if (sel.id) {
            return sel.id.replace(_header_str, '').replace(_content_str, '');
        }
        return false;
	};

// ------------------
// PRIVATE METHODS
// ------------------

	// toggle the "showItem()" method on click event	
	var toggleEvent = function( e, sel, _this ) {
		_this.showItem( sel, true );
		// stop the browser following the link
		return false;
	};

    if (arguments.length) { extend(this, arguments[0], '_%s'); }
    if (typeof window['_dbg_info'] == 'function')
        _dbg_info("[ACCORDION] Creating new accordion with :"
            +"\n _container_id: "+this._container_id
            +"\n _item_header_mask_id: "+this._item_header_mask_id
            +"\n _item_content_mask_id: "+this._item_content_mask_id
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