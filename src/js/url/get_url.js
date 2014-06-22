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