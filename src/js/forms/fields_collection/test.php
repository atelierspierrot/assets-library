<?php
/*
# ***** BEGIN LICENSE BLOCK *****
# Assets Library - The open source PHP/JavaScript/CSS library of Les Ateliers Pierrot
# Copyleft (c) 2013-2014 Pierre Cassat and contributors
# <www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>
# License GPL-3.0 <http://www.opensource.org/licenses/gpl-3.0.html>
# Sources <http://github.com/atelierspierrot/assets-library>
#
# Ce programme est un logiciel libre distribu� sous licence GNU/GPL.
#
# ***** END LICENSE BLOCK ***** */

@ini_set('display_errors',1); @error_reporting(E_ALL ^ E_NOTICE); 
require_once __DIR__.'/../../../assets-library.php';

$requirements = array(
    'js'=>array(
        'commons',
    ),
    'css'=>array(
        'commons',
    ),
);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Test of Fields_Collection javascript functions</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- Requirements -->
<script type="text/javascript" src="<?php echo build_requirements_url('js', $requirements['js']); ?>"></script>
<link href="<?php echo build_requirements_url('css', $requirements['css']); ?>" media="screen" rel="stylesheet" type="text/css" />

<!-- Preset "fields-collection" -->
<script type="text/javascript" src="<?php echo build_preset_url('js', 'fields-collection'); ?>"></script>
<link href="<?php echo build_preset_url('css', 'fields-collection'); ?>" media="screen" rel="stylesheet" type="text/css" />

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