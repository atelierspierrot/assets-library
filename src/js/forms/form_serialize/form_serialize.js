/*
# ***** BEGIN LICENSE BLOCK *****
# Assets Library - The open source PHP/JavaScript/CSS library of Les Ateliers Pierrot
# Copyleft (c) 2013 Pierre Cassat and contributors
# <www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>
# License GPL-3.0 <http://www.opensource.org/licenses/gpl-3.0.html>
# Sources <http://github.com/atelierspierrot/assets-library>
#
# Ce programme est un logiciel libre distribué sous licence GNU/GPL.
#
# ***** END LICENSE BLOCK ***** */


/*****************************************/

// FORM SERIALIZE
// based on <http://code.google.com/p/form-serialize/>

/******************************************/

HTMLFormElement.prototype.getValues = function() {
	var el = this.getElements(), q={};
	for(var i=0; i<el.length; i++) {
		if (el[i].serializable) {
			q[ el[i].label ] = encodeURIComponent( el[i].value );
		}
	}
	return q;
};

HTMLFormElement.prototype.serialize = function() {
	var el = this.getElements(), q=[];
	for(var i=0; i<el.length; i++) {
		if (el[i].serializable) {
			q.push( el[i].label + "=" + encodeURIComponent( el[i].value ) );
		}
	}
	return q.join("&");
};

HTMLFormElement.prototype.debug = function() {
	var el = this.getElements(), str='';
	if (window.console && window.console.debug) { window.console.debug(el); }
	for (var i=0; i<el.length; i++) {
		str += el[i].label +" = " + el[i].value + "\n"
	}
	return str;
};

HTMLFormElement.prototype.getElements = function() {
	var i, j, el=[];
	for (i = this.elements.length - 1; i >= 0; i = i - 1) {
		if (this.elements[i].name === "") {
			continue;
		}
		switch (this.elements[i].nodeName.toLowerCase()) {
		case 'input':
			switch (this.elements[i].type.toLowerCase()) {
			case 'text':
			case 'hidden':
			case 'password':
			case 'button':
			case 'reset':
			case 'submit':
			case 'file':
				element = new Object();
				element.value = this.elements[i].value;
				element.label = this.elements[i].name;
				element.element = this.elements[i];
				if (isDisabled(this.elements[i])) {
					element.disabled = true;
				} else {
					element.serializable = true;
				}
				el.push( element );
				break;
			case 'checkbox':
			case 'radio':
				if (this.elements[i].checked) {
					element = new Object();
					element.value = this.elements[i].value;
					element.label = this.elements[i].name;
					element.element = this.elements[i];
					if (isDisabled(this.elements[i])) {
						element.disabled = true;
					} else {
						element.serializable = true;
					}
					el.push( element );
				}						
				break;
			}
			break;			 
		case 'textarea':
			element = new Object();
			element.value = this.elements[i].value;
			element.label = this.elements[i].name;
			element.element = this.elements[i];
			if (isDisabled(this.elements[i])) {
				element.disabled = true;
			} else {
				element.serializable = true;
			}
			el.push( element );
			break;
		case 'select':
			switch (this.elements[i].type.toLowerCase()) {
			case 'select-one':
				element = new Object();
				element.value = this.elements[i].value;
				element.label = this.elements[i].name;
				element.element = this.elements[i];
				if (isDisabled(this.elements[i])) {
					element.disabled = true;
				} else {
					element.serializable = true;
				}
				el.push( element );
				break;
			case 'select-multiple':
				var values = [];
				for (j = this.elements[i].options.length - 1; j >= 0; j = j - 1) {
					if (this.elements[i].options[j].selected) {
						var _isOptgroup = this.elements[i].options[j].parentNode.tagName.toLowerCase()=='optgroup';
						element = new Object();
						element.value = this.elements[i].options[j].value;
						element.label = this.elements[i].name;
						element.element = this.elements[i].options[j];
						if (_isOptgroup) {
							_optgroup = this.elements[i].options[j].parentNode;
							optgroup = new Object();
							optgroup.label = _optgroup.label;
							optgroup.element = _optgroup;
							element.optgroup = optgroup;
						}
						if (_isOptgroup && isDisabled(_optgroup)) {
							element.disabled = true;
						} else {
							if (isDisabled(this.elements[i])) {
								element.disabled = true;
							} else {
								element.serializable = true;
							}
						}
						el.push( element );
						values.push( this.elements[i].options[j].value );
					}
				}
				element = new Object();
				element.value = values;
				element.label = this.elements[i].name;
				element.element = this.elements[i].options[j];
				if (isDisabled(this.elements[i])) {
					element.disabled = true;
				}
				el.push( element );
				break;
			}
			break;
		case 'button':
			switch (this.elements[i].type.toLowerCase()) {
			case 'reset':
			case 'submit':
			case 'button':
				element = new Object();
				element.value = this.elements[i].value;
				element.label = this.elements[i].name;
				element.element = this.elements[i];
				if (isDisabled(this.elements[i])) {
					element.disabled = true;
				} else {
					element.serializable = true;
				}
				el.push( element );
				break;
			}
			break;
		}
	}
	
	function isDisabled( obj ) {
		return (obj.disabled || obj.disabled=='disabled');
	}
	
	return el;
};

// Endfile