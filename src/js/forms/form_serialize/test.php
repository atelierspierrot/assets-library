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
<title>Test of Form_Serialize javascript functions</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- Requirements -->
<script type="text/javascript" src="<?php echo build_requirements_url('js', $requirements['js']); ?>"></script>
<link href="<?php echo build_requirements_url('css', $requirements['css']); ?>" media="screen" rel="stylesheet" type="text/css" />

<!-- Preset "form-serialize" -->
<script type="text/javascript" src="<?php echo build_preset_url('js', 'form-serialize'); ?>"></script>
<link href="<?php echo build_preset_url('css', 'form-serialize'); ?>" media="screen" rel="stylesheet" type="text/css" />

<script language="Javascript" type="text/javascript">
function formSerialize( form ) 
{
    console.debug('serialization of form '+form);
//    var serial = form_serialize( form ),
    var serial = form.serialize(),
        _div = document.getElementById('serial'),
        _str = '<p>Serialized form values : '+serial+'</p>'
            +'<p><a href="'
            + document.location.href+'?'+serial
            +'">Try to send the form by GET URI</a></p>';
    _div.innerHTML = _str;
    return false;
}

function formDebug( form ) 
{
    console.debug('debug of form '+form);
    var serial = form.debug(),
        _div = document.getElementById('serial'),
        _str = '<p>Debugging form values : <pre>'+serial+'</pre></p>';
    _div.innerHTML = _str;
    return false;
}
</script>
<style type="text/css">
table { margin: 0; }
td { padding: 4px; text-align: left; vertical-align: top;border: 1px dotted #eee; }
</style>
</head>
<?php 

function get_value( $what, $default='' ) {
    return !empty($_POST[$what]) ? $_POST[$what] : (
        !empty($_GET[$what]) ? $_GET[$what] : ( 
            !empty($_FILES[$what]) ? $_FILES[$what]['name'] : $default
        )
    );
} 

?>
<body>
    <p>This page provides tests of the javascript 'function' '<strong>form_serialize</strong>'; information is written in console.</p>

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

<?php if (!empty($_GET)) { 
    ksort($_GET);
?>
    <h3>Getted values</h3>
    <pre><?php var_export($_GET); ?></pre>
    <small><a href="test.php">clear</a></small>
<?php } ?>

    <h3>Serialized values</h3>
    <div id="serial">&nbsp;</div>

    <h3>The form</h3>
    <form name="form1" method="post" action="" enctype="multipart/form-data">
        <input type="hidden" id="myfield_hidden" name="myfield_hidden" value="hidden content" />
    
    <table><tr>
    <td>
        <p><strong>Classic input fileds</strong></p>
        <p>
            <label for="myfield_text">Input text</label>
            <input type="text" id="myfield_text" name="myfield_text" value="<?php echo get_value('myfield_text', 'Any content ...'); ?>" />
        </p>
        <p>
            <label for="myfield_pass">Input password</label>
            <input type="password" id="myfield_pass" name="myfield_pass" value="<?php echo get_value('myfield_pass', 'Password content'); ?>" />
        </p>
        <p>
            <label for="myfield_file">Input file</label>
            <input type="file" id="myfield_file" name="myfield_file" value="<?php echo get_value('myfield_file'); ?>" />
        </p>
        <p>
            <label for="myfield_button">Simple button</label>
            <input type="button" id="myfield_button" name="myfield_button" value="<?php echo get_value('myfield_button', 'Button content'); ?>" />
        </p>
    </td>
    <td>
        <p><strong>Classic select menus</strong></p>
        <p>
            <label for="myfield_select">Selection</label>
            <select id="myfield_select" name="myfield_select">
                <option value="option 1">Option 1</option>
                <option value="option 2">Option 2</option>
                <option value="option 3">Option 3</option>
                <option value="option 4">Option 4</option>
                <option value="option 5">Option 5</option>
            </select>
        </p>
        <p>
            <label for="myfield_selectmultiple">Selection multiple</label>
            <select id="myfield_selectmultiple" name="myfield_selectmultiple[]" multiple="true">
                <option value="option multiple 1">Option 1</option>
                <option value="option multiple 2">Option 2</option>
                <option value="option multiple 3">Option 3</option>
                <option value="option multiple 4">Option 4</option>
                <option value="option multiple 5">Option 5</option>
            </select>
        </p>
        <p>
            <label for="myfield_selectgroup">Selection with groups</label>
            <select id="myfield_selectgroup" name="myfield_selectgroup[]" multiple="true">
                <option value="option group multiple 1">Option 1</option>
                <option value="option group multiple 2">Option 2</option>
                <optgroup label="group 1">
                    <option value="option group multiple 3">Option 3</option>
                    <option value="option group multiple 4">Option 4</option>
                    <option value="option group multiple 5">Option 5</option>
                </optgroup>
                <optgroup label="group 2" disabled="disabled">
                    <option value="option group2 multiple 6" selected="selected">Option 6</option>
                    <option value="option group2 multiple 7">Option 7</option>
                    <option value="option group2 multiple 8">Option 8</option>
                </optgroup>
            </select>
        </p>
    </td>
    </tr><tr>
    <td>
        <p><strong>Classic choices fields</strong></p>
        <p>
            <label for="myfield_radios">Radios</label>
            <label><input type="radio" id="myfield_radios_1" name="myfield_radios" value="radio 1" /> Radio 1</label>
            <label><input type="radio" id="myfield_radios_2" name="myfield_radios" value="radio 2" /> Radio 2</label>
            <label><input type="radio" id="myfield_radios_3" name="myfield_radios" value="radio 3" /> Radio 3</label>
            <label><input type="radio" id="myfield_radios_4" name="myfield_radios" value="radio 4" /> Radio 4</label>
            <label><input type="radio" id="myfield_radios_5" name="myfield_radios" value="radio 5" /> Radio 5</label>
        </p>
        <p>
            <label for="myfield_checks">Checkboxes</label>
            <label><input type="checkbox" id="myfield_checks_1" name="myfield_checks[]" value="check 1" /> Check 1</label>
            <label><input type="checkbox" id="myfield_checks_2" name="myfield_checks[]" value="check 2" /> Check 2</label>
            <label><input type="checkbox" id="myfield_checks_3" name="myfield_checks[]" value="check 3" /> Check 3</label>
            <label><input type="checkbox" id="myfield_checks_4" name="myfield_checks[]" value="check 4" /> Check 4</label>
            <label><input type="checkbox" id="myfield_checks_5" name="myfield_checks[]" value="check 5" /> Check 5</label>
        </p>
    </td>
    <td>
        <p><strong>Classic text area</strong></p>
        <p>
            <label for="myfield_textarea">Text area</label>
            <textarea id="myfield_textarea" name="myfield_textarea" cols="22" rows="6"><?php echo get_value('myfield_textarea', 'Any content ...'); ?></textarea>
        </p>
    </td>
    </tr><tr>
    <td>
        <p><strong>Special input fields</strong></p>
        <p>
            <label for="myfield_image">Input image</label>
            <input type="image" id="myfield_image" name="myfield_image" src="<?php echo get_value('myfield_image', 'assets/PW_microbutton.png'); ?>" value="<?php echo get_value('myfield_image', 'assets/PW_microbutton.png'); ?>" />
        </p>
        <p>
            <label for="myfield_text_disabled">Input disabled</label>
            <input type="text" id="myfield_text_disabled" name="myfield_text_disabled" value="<?php echo get_value('myfield_text_disabled', 'Any content ...'); ?>" disabled="disabled" />
        </p>
        <p>
            <label for="myfield_text_readonly">Input read-only</label>
            <input type="text" id="myfield_text_readonly" name="myfield_text_readonly" value="<?php echo get_value('myfield_text_readonly', 'Any content ...'); ?>" readonly />
        </p>
    </td>
    <td>
        <p>
            <input type="button" name="form_serialize" value="Serialize" onclick="return formSerialize(document.forms.form1);" />
            <input type="button" name="form_debug" value="Debug" onclick="return formDebug(document.forms.form1);" />
            <input type="submit" />
            <input type="reset" />
        </p>
    </td>
    </tr></table>
    </form>

</body>
</html>