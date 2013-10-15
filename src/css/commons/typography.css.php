<?php
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
@ini_set('display_errors',1); @error_reporting(E_ALL ^ E_NOTICE); 
require_once __DIR__.'/../../assets-library.php';

$dir_left = defined('_CSS_DIRECTION') && _CSS_DIRECTION==='rtl' ? 'right' : 'left';
$dir_right = defined('_CSS_DIRECTION') && _CSS_DIRECTION==='rtl' ? 'left' : 'right';

?>
/* --------------------------------
    Typography
-------------------------------- */

a               { color: #003399; font-weight: normal; font-size: inherit; }
a:hover         { color: #7A63AA; }
a:visited       { color: #4a6b82; }
h1,h2,h3        { color: #444; }
h1              { font-size: 1.6em; font-weight: bold; margin: 2em 0 1em 0;padding: 5px 0 6px 0;}
h2              { font-size: 1.4em; font-weight: bold; margin: 1em 0 .6em 0;padding: 5px 0 6px 0;}
h3              { font-size: 1.2em; font-weight: bold; margin: .6em 0;}
div, span, p    { padding: 0; margin: 0; }
img             { border: 0; margin: .2em; }
p, blockquote, ul, ol, dl, li, table, pre
                { margin: 1em 0; font-size: 1em; }
h1 + p, h2 + p, h3 + p, h4 + p, h5 + p, h6 + p
                { margin-top: 0; }
var             { font-family: "Courier New","Andale Mono",monospace; font-style: normal; color: #003399; font-weight: normal; font-size: .96em; }
code, cite, pre { font-family: Monaco, Verdana, Sans-serif; background-color: #f9f9f9; border: 1px solid #D0D0D0; 
                color: #002166; font-size: 12px; text-indent:0; }
code            { font-family: "Courier New","Andale Mono",monospace; padding: 0 .6em; display: inline; margin:0; }
cite            { font-size: .9em; display: block; margin: 1em; padding: 0; padding-<?php echo $dir_left; ?>: 2em; }
blockquote      { font-size: .9em; display: block; margin: 1em; padding: 0; padding-<?php echo $dir_left; ?>: 2em; border: none; 
                border-<?php echo $dir_left; ?>: 2px solid #ddd; }
pre             { font-size: 12px; display: block; margin: 1em 0; padding: .6em; overflow: auto; max-height: 320px; }
pre code        { border: none; text-indent:0; padding: 0; }
pre, blockquote {
    overflow-x: auto; /* Use horizontal scroller if needed; for Firefox 2, not needed in Firefox 3 */
    white-space: -moz-pre-wrap !important; /* Mozilla, since 1999 */
    white-space: -pre-wrap; /* Opera 4-6 */
    white-space: -o-pre-wrap; /* Opera 7 */ 
    word-wrap: break-word; /* Internet Explorer 5.5+ */
}
abbr            { cursor: help; }
ol, ul          { padding:0; margin: 0; margin-<?php echo $dir_left; ?>: 15px; }
li              { padding:0; margin: 0; padding-<?php echo $dir_left; ?>: 5px; margin-bottom: 8px; text-indent: 0; }
ul li           { margin-<?php echo $dir_left; ?>: 15px; list-style-type: disc; }
ol li           { margin-<?php echo $dir_left; ?>: 15px; }
table           { margin: 1em; border-collapse:collapse; border: none; width: auto; }
th              { padding: 6px; text-align: <?php echo $dir_left; ?>; }
td              { padding: 6px; }
thead td, thead td a, thead th, thead th a 
                { font-size: .86em; font-weight: bold; }
tfoot td, tfoot td a, tfoot th, tfoot th a 
                { font-size: .86em; font-weight: normal; }
tbody td        { font-size: .9em; }
thead tr, tfoot tr 
                { background-color: #ddd; }

