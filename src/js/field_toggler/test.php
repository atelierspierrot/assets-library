<?php @ini_set('display_errors',1); @error_reporting(E_ALL ^ E_NOTICE); ?><!--
/*
# ***** BEGIN LICENSE BLOCK *****
# This file is part of the PiWi Framework, an apen source PHP/JavaScript library by Les Ateliers Pierrot
# Copyright (c) 2010 Pierre Cassat and contributors
#
# <http://www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>
#
# PiWi Library is a free software; you can redistribute it and/or modify it under the terms 
# of the GNU General Public License as published by the Free Software Foundation; either version 
# 3 of the License, or (at your option) any later version.
#
# PiWi Library is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; 
# without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License along with this program; 
# if not, write to the :
#     Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
# or see the page :
#    <http://www.opensource.org/licenses/gpl-3.0.html>
#
# Ce programme est un logiciel libre distribu� sous licence GNU/GPL.
#
# ***** END LICENSE BLOCK ***** */
--><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Test of Field_Toggler javascript functions</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- Commons -->
<script type="text/javascript" src="../commons.js.php"></script>
<link href="../../css/commons.css.php" rel="stylesheet" type="text/css" />

<!-- Field Toggler -->
<script type="text/javascript" src="field_toggler.js"></script>  

<script language="Javascript" type="text/javascript">

</script>
<style type="text/css">
table { margin: 0; }
td { padding: 4px; text-align: left; vertical-align: top;border: 1px dotted #eee; }
</style>
</head>
<?php
$MODEL_MASK = <<<EOT
<label for="fileField">File field</label>
<input type="file" id="fileField" name="fileField" />
&nbsp;[<a href="javascript:field_toggler( 'uploader_holder', 'fileField', '<?php echo protect_model($MODEL_MASK, true); ?>', 'back' );" title="Back to the file and keep it">back</a>]
EOT;

$MODEL_MASK_2 = <<<EOT
<label for="fileField_2">File field 2</label>
<input type="file" id="fileField_2" name="fileField_2" />
&nbsp;[<a href="javascript:field_toggler( 'uploader_holder_2', 'fileField_2', null, 'back' );" title="Back to the file and keep it">back</a>]
EOT;

$MODEL_MASK_3 = <<<EOT
<label for="fileField_3">File field 3</label>
<input type="file" id="fileField_3" name="fileField_3" />
EOT;

$MODEL_MASK_4 = <<<EOT
<label for="fileField_4">File field 4</label>
<input type="file" id="fileField_4" name="fileField_4" />
EOT;

function protect_model( $model, $protect_quotes=false )
{
	$model = preg_replace('/\s\s+/', ' ', $model);
	$model = htmlentities($model);
	if (true===$protect_quotes)
	{
		$model = str_replace("'", "\'", $model);
		$model = str_replace('"', '\"', $model);
	}
	return $model;
}

function getFileField( $name )
{
	if (!empty($_FILES) && isset($_FILES[$name]) && !empty($_FILES[$name]['tmp_name']))
	{
		$_f = 'tmp/'.uniqid();
		$a = copy($_FILES[$name]['tmp_name'], $_f);
		return $_f;
	}
	elseif (!empty($_POST) && isset($_POST[$name]))
	{
		return $_POST[$name];
	}
	return false;
}
?>
<body>
	<p>This page provides tests of the javascript 'function' '<strong>field_toggler</strong>'; information is written in console.</p>

<?php if (!empty($_POST)) { 
	ksort($_POST);
?>
	<h3>Posted values</h3>
	<pre><?php var_export($_POST); ?></pre>
	<small><a href="test.php">clear</a></small>
<?php } ?>

<?php if (!empty($_FILES)) { 
	ksort($_FILES);
?>
	<h3>Files values</h3>
	<pre><?php var_export($_FILES); ?></pre>
	<small><a href="test.php">clear</a></small>
<?php } ?>

	<h3>The form</h3>
	<form name="form1" method="post" action="" enctype="multipart/form-data">
	<table>
	<tr>
		<td>
		<p>
			<strong>File input field (with no HTML5 feature)</strong>
		</p>
		<div id="uploader_holder">
<?php if ($_f = getFileField('fileField')) : ?>
		
		<img src="<?php echo $_f; ?>" border="1" />
		<input type="hidden" name="fileField" value="<?php echo $_f; ?>" />

	    [<a href="javascript:field_toggler( 'uploader_holder', 'fileField', '<?php echo protect_model($MODEL_MASK, true); ?>' );" title="Upload a new file">change</a>]

<?php else: ?>

		<p>
    	    <label for="fileField">File field</label>
			<input type="file" id="fileField" name="fileField" />
		</p>

<?php endif; ?>
		</div>
		</td>
		<td>
		<p>
			<strong>File input field (with HTML5 feature)</strong>
		</p>
		<div id="uploader_holder_2" data-prototype="<?php echo protect_model($MODEL_MASK_2, true); ?>">
<?php if ($_f = getFileField('fileField_2')) : ?>
		
		<img src="<?php echo $_f; ?>" border="1" />
		<input type="hidden" name="fileField_2" value="<?php echo $_f; ?>" />

	    [<a href="javascript:field_toggler( 'uploader_holder_2', 'fileField_2' );" title="Upload a new file">change</a>]

<?php else: ?>

		<p>
    	    <label for="fileField_2">File field HTML5</label>
			<input type="file" id="fileField_2" name="fileField_2" />
		</p>

<?php endif; ?>
		</div>
		</td>
	</tr><tr>
		<td>
		<p>
			<strong>File input field (with no HTML5 feature) with "add' functionality</strong>
		</p>
		<div id="uploader_holder_3">
<?php if ($_f = getFileField('fileField_3')) : ?>
		
		<img src="<?php echo $_f; ?>" border="1" />
		<input type="hidden" name="fileField_3" value="<?php echo $_f; ?>" />

	    [<a href="javascript:field_toggler( 'uploader_holder_3', 'fileField_3', '<?php echo protect_model($MODEL_MASK_3, true); ?>', 'add' );" title="Upload a new file">change</a>]

<?php else: ?>

		<p>
    	    <label for="fileField_3">File field</label>
			<input type="file" id="fileField_3" name="fileField_3" />
		</p>

<?php endif; ?>
		</div>
		</td>
		<td>
		<p>
			<strong>File input field (with HTML5 feature) with "add" functionality</strong>
		</p>
		<div id="uploader_holder_4" data-prototype="<?php echo protect_model($MODEL_MASK_4, true); ?>">
<?php if ($_f = getFileField('fileField_4')) : ?>
		
		<img src="<?php echo $_f; ?>" border="1" />
		<input type="hidden" name="fileField_4" value="<?php echo $_f; ?>" />

	    [<a href="javascript:field_toggler( 'uploader_holder_4', 'fileField_4', null, 'add' );" title="Upload a new file">change</a>]

<?php else: ?>

		<p>
    	    <label for="fileField_4">File field HTML5</label>
			<input type="file" id="fileField_4" name="fileField_4" />
		</p>

<?php endif; ?>
		</div>
		</td>
	</tr><tr>
		<td colspan="2">
		<p>
			<input type="submit" />
			<input type="reset" />
		</p>
		</td>
	</tr>
	</table>
	</form>

</body>
</html>