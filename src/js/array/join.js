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
 * Join all args of an array in a string
 *
 * @param array array The array you want to serialize
 * @param char sep_arg The separator of arguments | optional | default is '='
 * @param char sep_arg The separator of items | optional | default is ';'
 */
function join(array, sep_arg, sep_item) {
    var string = '';
    var s_arg = (!sep_arg || sep_arg == '') ? '=' : sep_arg;
    var s_item = (!sep_item || sep_item == '') ? ';' : sep_item;
    if (typeof(array) != 'object') return;
    else {
        for (var item in array) {
            var value = array[item];
            if (typeof(value) == 'object') {
                string += item+s_arg+'(';
                string += join(value);
                string += ')'+s_item;
            } else {
                string += item+s_arg+value+s_item;
            }
        }
    }
    return string;
}

// Endfile