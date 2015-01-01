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
 * Get Url
 *
 * Function that returns current url
 * Params : 'type' : 'param' 'base' or empty to the all url
 *
 * @param string type Set if you want to returns just the url's parametres, or base | optional | default is empty
 * @param string req_url The url you want to analyze | optional | default is current window url
 *
 * @return string
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