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


/**
 * @param str value The cookie value [1]
 * @param str name The cookie name [2]
 * @param date|int expires The cookie expiration date or number of seconds [3 ; optional]
 * @param str path The cookie validity path [4 ; optional]
 * @param str domain The cookie validity domain [5 ; optional]
 * @param bool secure The cookie securisation [6 ; optional ; default is false]
 */
function setCookie(value, name) {
    var argv = setCookie.arguments;
    var argc = setCookie.arguments.length;
    if (value===undefined || value===null) {
		throw new Error('No value defined for cookie!');
        return false;
    }
    if (name===undefined || name===null) {
		throw new Error('No name defined for cookie!');
        return false;
    }
    var expires = (argc > 2) ? argv[2] : null;
    var path = (argc > 3) ? argv[3] : null;
    var domain = (argc > 4) ? argv[4] : null;
    var secure = (argc > 5) ? argv[5] : false;
    if (expires!==null) {
        if (!(expires instanceof Date)) {
            var today = new Date(),
                expires_date = new Date( today.getTime() + (expires*1000) );
            expires = expires_date;
        }
    }
    if (typeof window['_dbg_info'] == 'function')
        _dbg_info("Creating a new cookie with data :"
            +"\n name: "+name
            +"\n value: "+value
            +"\n expires: "+expires
            +"\n path: "+path
            +"\n domain: "+domain
            +"\n secure: "+secure
        );
    document.cookie = name+"="+escape(value)
        +((expires===null) ? "" : (";expires="+expires.toGMTString()))
        +((path===null) ? "" : (";path="+path))
        +((domain===null) ? "" : (";domain="+domain))
        +((secure===true) ? ";secure" : "");
    return true;
}

function getCookie(name) {
    if (name===undefined || name===null) {
		throw new Error('No name defined for cookie!');
        return false;
    }
    var arg = name+"=";
    var alen = arg.length;
    var i=0, clen = document.cookie.length;
    while (i<clen)
    {
        var j=i+alen;
        if (document.cookie.substring(i, j)===arg) {
            return getCookieValue(j);
        }
        i = document.cookie.indexOf(" ",i)+1;
        if (i===0) { break; }
    }
    return null;
}

function getCookieValue(offset) {
    var endstr = document.cookie.indexOf(";", offset);
    if (endstr===-1) {
        endstr=document.cookie.length;
    }
    return unescape(document.cookie.substring(offset, endstr));
}

function deleteCookie(name) {
    if (name===undefined || name===null) {
		throw new Error('No name defined for cookie!');
        return false;
    }
    var _zero = new Date( 0 );
    return setCookie(getCookie(name), name, _zero);
}

// Endfile