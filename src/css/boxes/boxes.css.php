<?php
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
@ini_set('display_errors',1); @error_reporting(E_ALL ^ E_NOTICE); 
require_once __DIR__.'/../../assets-library.php';
css_header();
?>
/* --------------------------------
    Boxes CSS3
-------------------------------- */

/* Border Radius effect */
.border-radius-small {
<?php echo css3_rule( 'border-radius', '3px', false ); ?>
/*
    border-radius:3px; 
*/
}
.border-radius {
<?php echo css3_rule( 'border-radius', '6px', false ); ?>

/*
    border-radius:6px; 
*/
}
.border-radius-big {
<?php echo css3_rule( 'border-radius', '16px', false ); ?>

/*
    border-radius:16px; 
*/
}

/* Shadow effect */
.shadow {
<?php echo css3_rule( 'box-shadow', '0px 0px 5px #CCC' ); ?>

/*
    box-shadow:0px 0px 5px #CCC; 
*/
}

/* Volume effect */
.shadow-volume {
<?php echo css3_rule( 'box-shadow', '0px 6px 6px 0px rgba(0, 0, 0, 0.5),
        0px 6px 6px 0px rgba(200, 200, 200, 0.5) inset' ); ?>
/*
    box-shadow:
        0px 6px 6px 0px rgba(0, 0, 0, 0.5),
        0px 6px 6px 0px rgba(200, 200, 200, 0.5) inset; 
*/
}

/* Hollow effect */
.shadow-hollow {
<?php echo css3_rule( 'box-shadow', '0px 6px 6px 0px rgba(0, 0, 0, 0.5) inset,
        0px 6px 6px 0px rgba(200, 200, 200, 0.5)' ); ?>
/*
    box-shadow:
        0px 6px 6px 0px rgba(0, 0, 0, 0.5) inset,
        0px 6px 6px 0px rgba(200, 200, 200, 0.5); 
*/
}
