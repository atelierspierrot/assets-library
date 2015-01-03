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


$posts = array();
$posts['myfield'] = isset($_POST['myfield']) ? $_POST['myfield'] : 'What you want ...';

$gets = array();
$gets['myfield'] = isset($_GET['myfield']) ? $_GET['myfield'] : false;
?>
<p>This is a demo of a simple form.</p>
<?php
if(isset($gets['myfield']))
	echo "<p>", $gets['myfield'], "<p>";
if(isset($_POST['myfield']))
	echo "<p>POST : ", $_POST['myfield'], "<p>";
?>
<script language="Javascript" type="text/javascript">
function submitInAjax( form ) {
	return Ajax_Submit({
		url:'test/test.php', 
		method: 'POST',
		form: form,
		timeout: 2000,
		dom_disabled: true,
		dom_id: 'TextDiv',
		success:'successFormSubmit',
		error: function(resp, e) {
    		alert('An error occurred : '+resp);
		}
	});
}
function successFormSubmit(resp) {
	document.getElementById('TextDiv').innerHTML = resp;
}

</script>
<div id="ajaxResponse">&nbsp;</div>
<form name="form1" method="post" action="">
  <p>
    <input type="text" name="myfield" value="<?php echo $posts['myfield']; ?>" />
  </p>
  <p>
    <input type="submit" name="Submit" value="Submit" />
    <input type="button" name="AJaxSubmit" value="Submit in AJAX" onclick="return submitInAjax(this.form);" />
  </p>
</form>
