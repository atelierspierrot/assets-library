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
