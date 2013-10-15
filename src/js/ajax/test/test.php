<?php
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
    		alert('An error occured : '+resp);
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
