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

// The global new window variable
var NEWPOPUPWINDOW;

/**
 * <b>Opener Focus</b>
 *
 * Args : (all optionals except url)
 * - opener_window : window object to focus (default is window.opener)
 * - opener_url : new URL to load in the focused window
 */
function opener_focus( opener_window, opener_url ) 
{
	var _opnr = (opener_window!=undefined && opener_window!=null) ? opener_window : (
		(NEWPOPUPWINDOW!=undefined && NEWPOPUPWINDOW!=null) ? NEWPOPUPWINDOW : window.opener
	);
	if (_opnr) {
		if (opener_url!=undefined) {
			_opnr.location.href = opener_url;
		}
		_opnr.focus();
		window.blur();
		return false;
	}
}

// Endfie