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
    'js'=>array('commons'),
    'css'=>array('commons'),
);

?><html>
<head>

<!-- Requirements -->
<script type="text/javascript" src="<?php echo build_requirements_url('js', $requirements['js']); ?>"></script>
<link href="<?php echo build_requirements_url('css', $requirements['css']); ?>" media="screen" rel="stylesheet" type="text/css" />

<!-- Preset "window" -->
<script type="text/javascript" src="<?php echo build_preset_url('js', 'window'); ?>"></script>
<link href="<?php echo build_preset_url('css', 'window'); ?>" media="screen" rel="stylesheet" type="text/css" />

</head>
<body>
	<strong>Second popup window</strong>
	<ul>
		<li><a href="#" onclick="return opener_focus();">opener focus</a></li>
		<li><a href="#" onclick="window.close();">close this window</a></li>
	</ul>
</body>
</html>