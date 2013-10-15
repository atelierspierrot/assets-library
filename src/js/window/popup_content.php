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

$requirements = array(
    'js'=>array(
        'commons',
        'array'=>'join'
    ),
    'css'=>array(
        'commons',
    ),
);

?><html>
<head>

<!-- Requirements -->
<script type="text/javascript" src="<?php echo build_requirements('js', $requirements['js']); ?>"></script>
<link href="<?php echo build_requirements('css', $requirements['css']); ?>" media="screen" rel="stylesheet" type="text/css" />

<!-- Window -->
<script type="text/javascript" src="popup_set.js"></script>
<script type="text/javascript" src="get_window_sizes.js"></script>
<script type="text/javascript" src="opener_focus.js"></script>

</head>
<body>
	<ul>
		<li><a href="#" onclick="return opener_focus();">opener focus</a></li>
		<li><a href="#" onclick="window.close();">close this window</a></li>
	</ul>
</body>
</html>