/*
# ***** BEGIN LICENSE BLOCK *****
# Assets Library - The open source PHP/JavaScript/CSS library of Les Ateliers Pierrot
# Copyleft (c) 2013-2014 Pierre Cassat and contributors
# <www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>
# License GPL-3.0 <http://www.opensource.org/licenses/gpl-3.0.html>
# Sources <http://github.com/atelierspierrot/assets-library>
#
# Ce programme est un logiciel libre distribué sous licence GNU/GPL.
#
# ***** END LICENSE BLOCK ***** */


/*****************************************/

// FORM FIELDS COLLECTION
// based on <http://symfony.com/doc/2.0/reference/forms/types/collection.html>

/******************************************/

// Keep traces of all collection counters by id
var COLLECTION_COUNTERS={};

// Keep traces of all collection models by id
var COLLECTION_MODELS={};

/**
 * Add a new item in a collection
 *
 * The model HTML string needs to be escaped and HTML tags need to be entities. The keywords "$$counter$$" and "$$value$$" will
 * be replaced by their corresponding content if so.
 * For example :
 *
 *     &lt;label for=&quot;myFieldName_$$counter$$&quot;&gt;My field $$counter$$&lt;/label&gt;&lt;input type=&quot;text&quot; id=&quot;myFieldName_$$counter$$&quot; name=&quot;myFieldName[$$counter$$]&quot; value=&quot;&quot; /&gt;&amp;nbsp;[&lt;a href=&quot;javascript:remove_collection_field( 'my-fields-list-$$counter$$' );&quot; title=&quot;Remove this email field&quot;&gt;-&lt;/a&gt;]
 *
 * To set an array of values (if there is an array of fields), you have to inform the function of each value name (and default value if so),
 * as follow :
 *
 *     var values = {
 *         first_field_name: 'first_field_default_value',
 *         second_field_name: '', // this will set a blank default value but the field name declaration is required
 *         ...
 *     };
 *     add_collection_field( 'fields-list-id', 'tag_name', null, null, values );
 *
 * Basic usage :
 *
 *     <ul id="my-fields-list">
 *     </ul>
 *     [<a href="javascript:add_collection_field( 'my-fields-list', 'li', '0', '&lt;label for=&quot;myFieldName_$$counter$$&quot;&gt;My field $$counter$$&lt;/label&gt;&lt;input type=&quot;text&quot; id=&quot;myFieldName_$$counter$$&quot; name=&quot;myFieldName[$$counter$$]&quot; value=&quot;&quot; /&gt;&amp;nbsp;[&lt;a href=&quot;javascript:remove_collection_field( 'my-fields-list-$$counter$$' );&quot; title=&quot;Remove this email field&quot;&gt;-&lt;/a&gt;]', 'first value' );" title="Add a new field">+</a>]
 *
 * HTML5 usage :
 *
 *     <ul id="my-fields-list"
 *         data-prototype="&lt;label for=&quot;myFieldName_$$counter$$&quot;&gt;My field $$counter$$&lt;/label&gt;&lt;input type=&quot;text&quot; id=&quot;myFieldName_$$counter$$&quot; name=&quot;myFieldName[$$counter$$]&quot; value=&quot;&quot; /&gt;&amp;nbsp;[&lt;a href=&quot;javascript:remove_collection_field( 'my-fields-list-$$counter$$' );&quot; title=&quot;Remove this email field&quot;&gt;-&lt;/a&gt;]"
 *         data-counter="0">
 *     </ul>
 *     [<a href="javascript:add_collection_field( 'my-fields-list', 'li' );" title="Add a new field">+</a>]
 *
 * @param string id The ID string of the collection holder (parent) | required
 * @param tag_name child_type The name of the tag to create in the parent for the new item | required
 * @param num counter The counter where to begin the collection count | optional, if not set, the function will try to get the
 *                    "data-counter" attribute of the parent, and by default, will count the parent's children entries
 * @param string field_model The HTML string to put in the collection item | optional, if not set, the function will try to get
 *                    the "data-prototype" attribute of the parent
 * @param string _value The value to insert in the new collection item if so | optional, default is ''
 */
function add_collection_field( id, child_type, counter, field_model, _value )
{
	if (typeof this.window['_dbg_info'] == 'function')
		_dbg_info('[add_collection_field()] Adding a field for id=['+id+']'
			+"\n"+' with counter=['+(counter || COLLECTION_COUNTERS[id])+']'
			+"\n"+' with model=['+(field_model || COLLECTION_MODELS[id])+']'
			+"\n"+' with child_type=['+child_type+']'
			+"\n"+' with _value=['+_value+']');
	var _parent = document.getElementById( id );
	if (_parent)
	{
		// make sure we have a count
		var count = COLLECTION_COUNTERS[id] || counter ||
		 	_parent.getAttribute('data-counter') || _parent.getElementsByTagName( child_type ).length+1;
		if (COLLECTION_COUNTERS[id]==undefined)
			COLLECTION_COUNTERS[id] = count;
		if (typeof this.window['_dbg'] == 'function')
			_dbg('getting counter : ['+count+']');

		// make sure we have a model
		var mod = field_model || COLLECTION_MODELS[id] || _parent.getAttribute('data-prototype');
		if (mod==undefined)
		{
			throw new Error('No model set and no data-prototype attribute found!');
			return;
		}
		if (COLLECTION_MODELS[id]==undefined)
			COLLECTION_MODELS[id] = mod;
		if (typeof this.window['_dbg'] == 'function')
			_dbg('getting field model : ['+mod+']');

		// create our new node
		var _new_id = id+'-'+count;
		var val = _value || '';
		if (typeof this.window['_dbg'] == 'function')
			_dbg('getting value : ['+val+']');

		var new_child = document.createElement( child_type );
		if (new_child)
		{
			new_child.id = _new_id;
            mod = mod.replace(/\$\$counter\$\$/g, count);
			if (typeof(_value) == 'object') {
				for(var key in _value) {
					_patrn = new RegExp('\\$\\$value\\['+key+'\\]\\$\\$', 'ig');
					_dbg('pattern is : ['+_patrn+']');
		            mod = mod.replace(_patrn, _value[key]);
				}
			} else {
				_patrn = new RegExp('\\$\\$value\\$\\$', 'ig');
				_dbg('pattern is : ['+_patrn+']');
	            mod = mod.replace(_patrn, val);
	        }
			if (typeof this.window['_dbg'] == 'function')
				_dbg('new model is : ['+mod+']');
		    new_child.innerHTML = mod;
	    	_parent.appendChild( new_child );
			COLLECTION_COUNTERS[id]++;
	    }
	}
}

/**
 * Remove an item of a collection by its ID
 *
 * @param string id The ID string of the collection item to remove | required
 */
function remove_collection_field( id )
{
	if (typeof this.window['_dbg_info'] == 'function')
		_dbg_info('[remove_collection_field] removing a field for id['+id+']');
	var _node = document.getElementById( id );
	if (_node)
	{
		_node.parentNode.removeChild( _node );
	}
}

// Endfile