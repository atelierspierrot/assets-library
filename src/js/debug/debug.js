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


// Settings : global javascript options of pages
var settings; if (settings===undefined) settings = [];

/**
 * DEBUGGER - Write 'str' in console (FireBug for example) if present, or alert(str)
 * @param string str The text you want to be displayed
 * @param string title The title of your text | optional
 */
function _dbg(str, title)
{
	if (!title) { title = ""; }
	else { title = title+" : "; }
	if (window.console && window.console.log) { window.console.log(title + str); }
	else if (settings.debugg) { alert(title + str); }
}

/**
 * DEBUGGER INFO - Write 'str' in console (FireBug for example) if present
 * @param string str The text you want to be displayed
 * @param string title The title of your text | optional
 */
function _dbg_info(str, title)
{
	if (!title) { title = ""; }
	else { title = title+" : "; }
	if (window.console && window.console.info) { window.console.info(title + str); }
}

/**
 * DEBUGGER LOG - Write 'str' in console (FireBug for example) if present parsing it with arguments (like a sprintf() completion)
 */
function _dbg_log()
{
	if (window.console && window.console.log) {
		window.console.log.apply(null, arguments);
	}
}

// Endfile