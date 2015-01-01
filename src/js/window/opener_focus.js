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