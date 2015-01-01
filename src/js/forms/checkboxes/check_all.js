/**
 * This file is part of the AssetsLibrary package.
 * The open source PHP/JavaScript/CSS library of Les Ateliers Pierrot.
 *
 * Copyleft (ↄ) 2013-2015 Pierre Cassat <me@e-piwi.fr> and contributors
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * The source code of this package is available online at 
 * <http://github.com/atelierspierrot/assets-library>.
 */


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