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
 * Verification of an URL
 *
 * @param string url The url you want to verify
 *
 * @return bool TRUE if url is a valid url (ftp, http or https)
 */
function is_url(url) {
	if (!url) { return; }
	var good_url = /^(f|ht)tp(s)?:\/\/((\d+\.\d+\.\d+\.\d+)|(([\w-]+\.)+([a-z,A-Z][\w-]*)))(:[1-9][0-9]*)?(\/([\w-.\/:%+@&=]+[\w- .\/?:%+@&=]*)?)?(#(.*))?$/i;
	if (!good_url.test(url)) { return false; }
	else { return true; }
}

// Endfie