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
# Ce programme est un logiciel libre distribué sous licence GNU/GPL.
#
# ***** END LICENSE BLOCK ***** */
--><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Test of Fields_Collection javascript functions</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- Commons -->
<script type="text/javascript" src="../commons.js.php"></script>
<link href="../../css/commons.css.php" rel="stylesheet" type="text/css" />

<!-- Fields Collection -->
<script type="text/javascript" src="fields_collection.js"></script>  
<script language="Javascript" type="text/javascript">
</script>
<style type="text/css">
table { margin: 0; }
td { padding: 4px; text-align: left; vertical-align: top;border: 1px dotted #eee; }
</style>
</head>
<?php
$MODEL_MASK = <<<EOT
<label for="emailField_\$\$counter\$\$">Email field \$\$counter\$\$</label>
<input type="text" id="emailField_\$\$counter\$\$" name="emailField[\$\$counter\$\$]" value="\$\$value\$\$" />
&nbsp;[<a href="javascript:remove_collection_field( 'email-fields-list-\$\$counter\$\$' );" title="Remove this email field">-</a>]
EOT;

$MODEL_MASK_2 = <<<EOT
<label for="newField_\$\$counter\$\$">New field \$\$counter\$\$</label>
<input type="text" id="newField_\$\$counter\$\$" name="newField[\$\$counter\$\$]" value="\$\$value\$\$" />
&nbsp;[<a href="javascript:remove_collection_field( 'new-fields-list-\$\$counter\$\$' );" title="Remove this field">-</a>]
EOT;

$MODEL_MASK_COMPLEX = <<<EOT
<label for="complexFields_name_\$\$counter\$\$">Name \$\$counter\$\$</label>
<input type="text" id="complexFields_name_\$\$counter\$\$" name="complexFields[\$\$counter\$\$][name]" value="\$\$value[name]\$\$" />
<label for="complexFields_email_\$\$counter\$\$">Email \$\$counter\$\$</label>
<input type="text" id="complexFields_email_\$\$counter\$\$" name="complexFields[\$\$counter\$\$][email]" value="\$\$value[email]\$\$" />
&nbsp;[<a href="javascript:remove_collection_field( 'complex-fields-list-\$\$counter\$\$' );" title="Remove this field">-</a>]
EOT;

function collection_protect_model( $model, $protect_quotes=false )
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
?>
<body>
	<p>This page provides tests of the javascript 'function' '<strong>fields_collection</strong>'; information is written in console.</p>

<?php if (!empty($_POST)) { 
	ksort($_POST);
?>
	<h3>Posted values</h3>
	<pre><?php var_export($_POST); ?></pre>
	<small><a href="test.php">clear</a></small>
<?php } ?>

	<h3>The form</h3>
	<form name="form1" method="post" action="" enctype="multipart/form-data">
	<table>
	<tr>
		<td>
		<p>
			<strong>First input field sample</strong>
		</p>
		<p>
    	    <label for="emailField_sample">Email field sample</label>
			<input type="text" id="emailField_sample" name="emailField_sample" value="<?php echo isset($_POST['emailField_sample']) ? $_POST['emailField_sample'] : 'an empty value ...'; ?>" />
		</p>

		<p>
			<strong>New fields will be written below</strong>
		</p>

	    <ul id="email-fields-list" data-prototype="<?php echo collection_protect_model($MODEL_MASK); ?>" data-counter="<?php echo isset($_POST['emailField']) ? max(array_keys($_POST['emailField']))+1 : 0; ?>">
	    <?php if (!empty($_POST['emailField'])) foreach($_POST['emailField'] as $i=>$emailField) : ?>
	        <li id="email-fields-list-<?php echo $i; ?>">
    	        <label for="emailField_<?php echo $i; ?>">Email field <?php echo $i; ?></label>
				<input type="text" id="emailField_<?php echo $i; ?>" name="emailField[<?php echo $i; ?>]" value="<?php echo $emailField; ?>" />
			    &nbsp;[<a href="javascript:remove_collection_field( 'email-fields-list-<?php echo $i; ?>' );" title="Remove this email field">-</a>]
	        </li>
	    <?php endforeach; ?>
	    </ul>
	    [<a href="javascript:add_collection_field( 'email-fields-list', 'li', null, null, 'yo' );" title="Add another email field">+</a>]

		</td>
		<td>
		<p>
			<strong>Second input field sample</strong>
		</p>
		<p>
    	    <label for="newField_sample">New field sample</label>
			<input type="text" id="newField_sample" name="newField_sample" value="<?php echo isset($_POST['newField_sample']) ? $_POST['newField_sample'] : 'an empty value ...'; ?>" />
		</p>

		<p>
			<strong>New fields with no HTML5 properties will be written below</strong>
		</p>

	    <ul id="new-fields-list">
	    <?php if (!empty($_POST['newField'])) foreach($_POST['newField'] as $i=>$newField) : ?>
	        <li id="new-fields-list-<?php echo $i; ?>">
    	        <label for="newField_<?php echo $i; ?>">New field <?php echo $i; ?></label>
				<input type="text" id="newField_<?php echo $i; ?>" name="newField[<?php echo $i; ?>]" value="<?php echo $newField; ?>" />
			    &nbsp;[<a href="javascript:remove_collection_field( 'new-fields-list-<?php echo $i; ?>' );" title="Remove this field">-</a>]
	        </li>
	    <?php endforeach; ?>
	    </ul>
	    [<a href="javascript:add_collection_field( 'new-fields-list', 'li', '<?php echo isset($_POST['newField']) ? max(array_keys($_POST['newField']))+1 : 0; ?>', '<?php echo collection_protect_model($MODEL_MASK_2, true); ?>', 'first value' );" title="Add a new field">+</a>]

		<td>
	</tr>
	<tr>
		<td>
		<p>
			<input type="submit" />
			<input type="reset" />
		</p>
		</td>
		<td>

		<p>
			<strong>Complex fields sample</strong>
		</p>
		<p>
    	    <label for="complexFields_name_sample">Name sample</label>
			<input type="text" id="complexFields_name_sample" name="complexFields_sample[name]" value="<?php echo isset($_POST['complexFields_sample']['name']) ? $_POST['complexFields_sample']['name'] : 'a name'; ?>" />
    	    <label for="complexFields_email_sample">Email sample</label>
			<input type="text" id="complexFields_email_sample" name="complexFields_sample[email]" value="<?php echo isset($_POST['complexFields_sample']['email']) ? $_POST['complexFields_sample']['email'] : '...'; ?>" />
		</p>

		<p>
			<strong>A complex set of fields will be written below</strong>
		</p>

	    <ul id="complex-fields-list" data-prototype="<?php echo collection_protect_model($MODEL_MASK_COMPLEX); ?>" data-counter="<?php echo isset($_POST['complexFields']) ? max(array_keys($_POST['complexFields']))+1 : 0; ?>">
	    <?php if (!empty($_POST['complexFields'])) foreach($_POST['complexFields'] as $i=>$complexFields) : ?>
	        <li id="complex-fields-list-<?php echo $i; ?>">
	    	    <label for="complexFields_name_<?php echo $i; ?>">Name <?php echo $i; ?></label>
				<input type="text" id="complexFields_name_<?php echo $i; ?>" name="complexFields[<?php echo $i; ?>][name]" value="<?php echo isset($_POST['complexFields'][$i]['name']) ? $_POST['complexFields'][$i]['name'] : ''; ?>" />
    		    <label for="complexFields_email_<?php echo $i; ?>">Email <?php echo $i; ?></label>
				<input type="text" id="complexFields_email_<?php echo $i; ?>" name="complexFields[<?php echo $i; ?>][email]" value="<?php echo isset($_POST['complexFields'][$i]['email']) ? $_POST['complexFields'][$i]['email'] : ''; ?>" />
			    &nbsp;[<a href="javascript:remove_collection_field( 'complex-fields-list-<?php echo $i; ?>' );" title="Remove this email field">-</a>]
	        </li>
	    <?php endforeach; ?>
	    </ul>
	    [<a href="javascript:add_collection_field( 'complex-fields-list', 'li', null, null, {name:'yo',email:'ya'} );" title="Add another email field">+</a>]

		</td>
	</tr>
	</table>
	</form>

</body>
</html>