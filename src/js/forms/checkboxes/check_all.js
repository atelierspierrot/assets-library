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