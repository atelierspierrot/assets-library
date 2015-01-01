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


// Settings : global javascript options of pages
var settings; if (settings===undefined) settings = [];

/**
 * DEBUGGER - Write 'str' in console (FireBug for example) if present, or alert(str)
 * @param string str The text you want to be displayed
 * @param string title The title of your text | optional
 */
function _dbg(str, title)
{
    if (window.settings['debug']!==undefined && window.settings['debug']==false) {
        return;
    }
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
    if (window.settings['debug']!==undefined && window.settings['debug']==false) {
        return;
    }
    if (!title) { title = ""; }
    else { title = title+" : "; }
    if (window.console && window.console.info) { window.console.info(title + str); }
}

/**
 * DEBUGGER LOG - Write 'str' in console (FireBug for example) if present parsing it with arguments (like a sprintf() completion)
 */
function _dbg_log()
{
    if (window.settings['debug']!==undefined && window.settings['debug']==false) {
        return;
    }
    if (window.console && window.console.log) {
        window.console.log.apply(null, arguments);
    }
}

// Endfile