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
# Ce programme est un logiciel libre distribué sous licence GNU/GPL.
#
# ***** END LICENSE BLOCK ***** */


sleep(4);
$posts = array();
$posts['myfield'] = isset($_POST['myfield']) ? $_POST['myfield'] : 'What you want ...';

$gets = array();
$gets['myfield'] = isset($_GET['myfield']) ? $_GET['myfield'] : false;
?>
<p>This is a demo of the simple textarea based bbcode editor. This is the simplest, fast loading and easy to use bbcode editor i have coded with very basic functionality. Feel free to use it for any of your personal or commercial projects.</p>
<?php
if(isset($gets['myfield']))
	echo "<p>", $gets['myfield'], "<p>";
?>
<form name="form1" method="post" action="">
  <p>
    <input type="text" name="myfield" value="<?php echo $posts['myfield']; ?>" />
  </p>
  <p>
    <input type="submit" name="Submit" value="Submit" />
  </p>
</form>
