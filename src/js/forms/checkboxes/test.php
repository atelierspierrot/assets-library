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

?><html>
<head>
<title>Test of checkboxes javascript functions</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- Requirements -->
<script type="text/javascript" src="<?php echo build_requirements_url('js', $requirements['js']); ?>"></script>
<link href="<?php echo build_requirements_url('css', $requirements['css']); ?>" media="screen" rel="stylesheet" type="text/css" />

<!-- Preset "checkboxes" -->
<script type="text/javascript" src="<?php echo build_preset_url('js', 'checkboxes'); ?>"></script>
<link href="<?php echo build_preset_url('css', 'checkboxes'); ?>" media="screen" rel="stylesheet" type="text/css" />

<script language="Javascript" type="text/javascript">

</script>
<style type="text/css">
table { margin: 1em; font-size: 1em; }
tr.checked_on { background-color: red; }
th { border-bottom: 1px dotted #ccc; padding: 4px; }
td { border-bottom: 1px dotted #ddd; padding: 4px; }
.floated { float: left; width: 260px; margin-left: 40px; }
</style>
</head>

<body>
    <p>This page provides tests of the javascript function '<strong>checkboxes</strong>'; information is written in console.</p>

<?php if (!empty($_GET)) { ?>
    <h3>GET arguments</h3>
    <pre><?php var_export($_GET); ?></pre>
    <small><a href="test.php">clear</a></small>
<?php } ?>

    <hr />

<form method="get" action="#" name="rubrique">

<table><thead>
<tr>
    <th>
        <label class="invisible" for="rubrique_checker_all">Check/unckeck all</label>
        <input type="checkbox" id="rubrique_checker_all" name="rubrique_checker_all" value="1" title="Check all/Uncheck all" onchange="checkAll('rubrique', 'rubrique_checker');" />
    </th>
        <th>
        <label class="invisible" for="handler">Check/unckeck all by handler</label>
        <input type="checkbox" id="handler" name="handler" value="1" title="Check all/Uncheck all with handler" onchange="checkAll('rubrique', 'rubrique_checker', 'handler');" />
            </th>
            <th>
        <label class="invisible" for="handler2">Check/unckeck all with form obj</label>
        <input type="checkbox" id="handler2" name="handler2" value="1" title="Check all/Uncheck all by form" onchange="checkAll(this.form, 'rubrique_checker', 'handler2');" />
            <th>
        <label class="invisible" for="handler_error">Check/unckeck all with an error</label>
        <input type="checkbox" id="handler_error" name="handler_error" value="1" title="Check all/Uncheck all with an error" onchange="checkAll(this.form, 'rubrique_checker', 'azerty');" />
                    </th>
            <th>
                    <a href="#index.php?a=table&amp;l=10&amp;t=rubrique&amp;ob=title&amp;ow=asc" title="Sort by that column">
                Title            </a>
                    </th>
            <th>
                    <a href="#index.php?a=table&amp;l=10&amp;t=rubrique&amp;ob=content&amp;ow=asc" title="Sort by that column">
                Content            </a>
                &nbsp;<small>[<abbr title="Content that can use Markdown syntax">MD</abbr>]</small>    </th>
            <th>
                    <a href="#index.php?a=table&amp;l=10&amp;t=rubrique&amp;ob=created_at&amp;ow=asc" title="Sort by that column">
                Created at            </a>
                    </th>
            <th>
                    <a href="#index.php?a=table&amp;l=10&amp;t=rubrique&amp;ob=updated_at&amp;ow=asc" title="Sort by that column">
                Updated at            </a>
                    </th>
        <th></th>
    <th></th>
    <th></th>
</tr></thead>
<tbody>
<tr id="rubrique_1" class="odd">
    <td class="overview_entry">
        <label class="invisible" for="rubrique_checker-1">Check/unckeck this line</label>
        <input type="checkbox" id="rubrique_checker-1" name="rubrique_checker[]" value="1" onchange="change_class_oncheck('checked_on', 'rubrique_checker-1', 'rubrique_1');" />
    </td>

        <td class="overview_entry">1</td>
    

        <td class="overview_entry"></td>
    

        <td class="overview_entry"><abbr title="Bit value setted on 1" class="toggler_on">ok</abbr></td>
    

        <td class="overview_entry">
        <strong>Premi�re rubrique</strong></td>

    

        <td class="overview_entry">MKLj qkjsdfmqlksjdf jkMLKj dfkjqmsdlkfj jmlkj **mlkjmlkj**</td>
    

        <td class="overview_entry">2012-10-20 22:18:06</td>
    

        <td class="overview_entry">2012-10-23 11:58:31</td>
    
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=read&amp;i=1&amp;c=crud" title="View this entry">read</a>
    </td>
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=edit&amp;i=1&amp;c=crud" title="Edit this entry">edit</a>
    </td>
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=delete&amp;i=1&amp;c=crud" title="Delete this entry" onclick="return confirm('Are you sure you want to delete this entry?');">delete</a>
    </td>
</tr>
<tr id="rubrique_2" class="even">
    <td class="overview_entry">
        <label class="invisible" for="rubrique_checker-2">Check/unckeck this line</label>
        <input type="checkbox" id="rubrique_checker-2" name="rubrique_checker[]" value="2" onchange="change_class_oncheck('checked_on', 'rubrique_checker-2', 'rubrique_2');" />
    </td>

        <td class="overview_entry">2</td>
    

        <td class="overview_entry"></td>
    

        <td class="overview_entry"><abbr title="Bit value setted on 1" class="toggler_on">ok</abbr></td>
    

        <td class="overview_entry">
        <strong>Deuxi�me rub.</strong></td>

    

        <td class="overview_entry">## mlkjlmkj

mqlskdjf jfmqlskdjf kqjsdmflkqjsmdlfkj</td>
    

        <td class="overview_entry">2012-10-20 22:18:25</td>
    

        <td class="overview_entry"></td>
    
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=read&amp;i=2&amp;c=crud" title="View this entry">read</a>
    </td>
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=edit&amp;i=2&amp;c=crud" title="Edit this entry">edit</a>
    </td>
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=delete&amp;i=2&amp;c=crud" title="Delete this entry" onclick="return confirm('Are you sure you want to delete this entry?');">delete</a>
    </td>
</tr>
<tr id="rubrique_3" class="odd">
    <td class="overview_entry">
        <label class="invisible" for="rubrique_checker-3">Check/unckeck this line</label>
        <input type="checkbox" id="rubrique_checker-3" name="rubrique_checker[]" value="3" onchange="change_class_oncheck('checked_on', 'rubrique_checker-3', 'rubrique_3');" />
    </td>

        <td class="overview_entry">3</td>
    

        <td class="overview_entry"></td>
    

        <td class="overview_entry"><abbr title="Bit value setted on 0" class="toggler_off">x</abbr></td>
    

        <td class="overview_entry">
        <strong>qsdfqsdf1</strong></td>

    

        <td class="overview_entry">qsdfqsdfqsdf</td>
    

        <td class="overview_entry">2012-10-23 09:25:55</td>
    

        <td class="overview_entry">2012-10-23 10:08:34</td>
    
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=read&amp;i=3&amp;c=crud" title="View this entry">read</a>
    </td>
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=edit&amp;i=3&amp;c=crud" title="Edit this entry">edit</a>
    </td>
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=delete&amp;i=3&amp;c=crud" title="Delete this entry" onclick="return confirm('Are you sure you want to delete this entry?');">delete</a>
    </td>
</tr>
<tr id="rubrique_4" class="even">
    <td class="overview_entry">
        <label class="invisible" for="rubrique_checker-5">Check/unckeck this line</label>
        <input type="checkbox" id="rubrique_checker-5" name="rubrique_checker[]" value="5" onchange="change_class_oncheck('checked_on', 'rubrique_checker-5', 'rubrique_4');" />
    </td>

        <td class="overview_entry">5</td>
    

        <td class="overview_entry"></td>
    

        <td class="overview_entry"><abbr title="Bit value setted on 0" class="toggler_off">x</abbr></td>
    

        <td class="overview_entry">
        <strong>qsqsdfqsdf</strong></td>

    

        <td class="overview_entry">qsdfqsdfqsdf</td>
    

        <td class="overview_entry">2012-10-23 09:36:37</td>
    

        <td class="overview_entry"></td>
    
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=read&amp;i=5&amp;c=crud" title="View this entry">read</a>
    </td>
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=edit&amp;i=5&amp;c=crud" title="Edit this entry">edit</a>
    </td>
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=delete&amp;i=5&amp;c=crud" title="Delete this entry" onclick="return confirm('Are you sure you want to delete this entry?');">delete</a>
    </td>
</tr>
<tr id="rubrique_5" class="odd">
    <td class="overview_entry">
        <label class="invisible" for="rubrique_checker-6">Check/unckeck this line</label>
        <input type="checkbox" id="rubrique_checker-6" name="rubrique_checker[]" value="6" onchange="change_class_oncheck('checked_on', 'rubrique_checker-6', 'rubrique_5');" />
    </td>

        <td class="overview_entry">6</td>
    

        <td class="overview_entry"></td>
    

        <td class="overview_entry"><abbr title="Bit value setted on 0" class="toggler_off">x</abbr></td>
    

        <td class="overview_entry">
        <strong>qsdf</strong></td>

    

        <td class="overview_entry">qsdfqsdfqsdf</td>
    

        <td class="overview_entry">2012-10-23 09:39:16</td>
    

        <td class="overview_entry"></td>
    
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=read&amp;i=6&amp;c=crud" title="View this entry">read</a>
    </td>
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=edit&amp;i=6&amp;c=crud" title="Edit this entry">edit</a>
    </td>
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=delete&amp;i=6&amp;c=crud" title="Delete this entry" onclick="return confirm('Are you sure you want to delete this entry?');">delete</a>
    </td>
</tr>
<tr id="rubrique_6" class="even">
    <td class="overview_entry">
        <label class="invisible" for="rubrique_checker-7">Check/unckeck this line</label>
        <input type="checkbox" id="rubrique_checker-7" name="rubrique_checker[]" value="7" onchange="change_class_oncheck('checked_on', 'rubrique_checker-7', 'rubrique_6');" />
    </td>

        <td class="overview_entry">7</td>
    

        <td class="overview_entry"></td>
    

        <td class="overview_entry"><abbr title="Bit value setted on 0" class="toggler_off">x</abbr></td>
    

        <td class="overview_entry">
        <strong>qsqsdfqsdf</strong></td>

    

        <td class="overview_entry">qsdfqsdfqsdf</td>
    

        <td class="overview_entry">2012-10-23 09:54:39</td>
    

        <td class="overview_entry"></td>
    
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=read&amp;i=7&amp;c=crud" title="View this entry">read</a>
    </td>
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=edit&amp;i=7&amp;c=crud" title="Edit this entry">edit</a>
    </td>
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=delete&amp;i=7&amp;c=crud" title="Delete this entry" onclick="return confirm('Are you sure you want to delete this entry?');">delete</a>
    </td>
</tr>
<tr id="rubrique_7" class="odd">
    <td class="overview_entry">
        <label class="invisible" for="rubrique_checker-8">Check/unckeck this line</label>
        <input type="checkbox" id="rubrique_checker-8" name="rubrique_checker[]" value="8" onchange="change_class_oncheck('checked_on', 'rubrique_checker-8', 'rubrique_7');" />
    </td>

        <td class="overview_entry">8</td>
    

        <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=read&amp;i=3&amp;c=crud" title="See this rubrique">qsdfqsdf1</a></td>

    

        <td class="overview_entry"><abbr title="Bit value setted on 0" class="toggler_off">x</abbr></td>
    

        <td class="overview_entry">
        <strong>azerty</strong></td>

    

        <td class="overview_entry">qsdfqsdfqsdf</td>
    

        <td class="overview_entry">2012-10-23 09:55:20</td>
    

        <td class="overview_entry"></td>
    
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=read&amp;i=8&amp;c=crud" title="View this entry">read</a>
    </td>
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=edit&amp;i=8&amp;c=crud" title="Edit this entry">edit</a>
    </td>
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=delete&amp;i=8&amp;c=crud" title="Delete this entry" onclick="return confirm('Are you sure you want to delete this entry?');">delete</a>
    </td>
</tr>
<tr id="rubrique_8" class="even">
    <td class="overview_entry">
        <label class="invisible" for="rubrique_checker-9">Check/unckeck this line</label>
        <input type="checkbox" id="rubrique_checker-9" name="rubrique_checker[]" value="9" onchange="change_class_oncheck('checked_on', 'rubrique_checker-9', 'rubrique_8');" />
    </td>

        <td class="overview_entry">9</td>
    

        <td class="overview_entry"></td>
    

        <td class="overview_entry"><abbr title="Bit value setted on 0" class="toggler_off">x</abbr></td>
    

        <td class="overview_entry">
        <strong>qsdf</strong></td>

    

        <td class="overview_entry">qsdfqsdf</td>
    

        <td class="overview_entry">2012-10-23 09:58:03</td>
    

        <td class="overview_entry"></td>
    
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=read&amp;i=9&amp;c=crud" title="View this entry">read</a>
    </td>
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=edit&amp;i=9&amp;c=crud" title="Edit this entry">edit</a>
    </td>
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=delete&amp;i=9&amp;c=crud" title="Delete this entry" onclick="return confirm('Are you sure you want to delete this entry?');">delete</a>
    </td>
</tr>
<tr id="rubrique_9" class="odd">
    <td class="overview_entry">
        <label class="invisible" for="rubrique_checker-10">Check/unckeck this line</label>
        <input type="checkbox" id="rubrique_checker-10" name="rubrique_checker[]" value="10" onchange="change_class_oncheck('checked_on', 'rubrique_checker-10', 'rubrique_9');" />
    </td>

        <td class="overview_entry">10</td>
    

        <td class="overview_entry"></td>
    

        <td class="overview_entry"><abbr title="Bit value setted on 0" class="toggler_off">x</abbr></td>
    

        <td class="overview_entry">
        <strong>qsqsdfqsdf</strong></td>

    

        <td class="overview_entry">qsdfqsdfqsdf</td>
    

        <td class="overview_entry">2012-10-23 10:08:26</td>
    

        <td class="overview_entry"></td>
    
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=read&amp;i=10&amp;c=crud" title="View this entry">read</a>
    </td>
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=edit&amp;i=10&amp;c=crud" title="Edit this entry">edit</a>
    </td>
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=delete&amp;i=10&amp;c=crud" title="Delete this entry" onclick="return confirm('Are you sure you want to delete this entry?');">delete</a>
    </td>
</tr>
<tr id="rubrique_10" class="even">
    <td class="overview_entry">
        <label class="invisible" for="rubrique_checker-11">Check/unckeck this line</label>
        <input type="checkbox" id="rubrique_checker-11" name="rubrique_checker[]" value="11" onchange="change_class_oncheck('checked_on', 'rubrique_checker-11', 'rubrique_10');" />
    </td>

        <td class="overview_entry">11</td>
    

        <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=read&amp;i=3&amp;c=crud" title="See this rubrique">qsdfqsdf1</a></td>

    

        <td class="overview_entry"><abbr title="Bit value setted on 0" class="toggler_off">x</abbr></td>
    

        <td class="overview_entry">
        <strong>lkh</strong></td>

    

        <td class="overview_entry"></td>
    

        <td class="overview_entry">2012-10-24 00:06:04</td>
    

        <td class="overview_entry"></td>
    
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=read&amp;i=11&amp;c=crud" title="View this entry">read</a>
    </td>
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=edit&amp;i=11&amp;c=crud" title="Edit this entry">edit</a>
    </td>
    <td class="overview_entry">
        <a href="#index.php?m=rubrique&amp;a=delete&amp;i=11&amp;c=crud" title="Delete this entry" onclick="return confirm('Are you sure you want to delete this entry?');">delete</a>
    </td>
</tr>
<tbody></table>

    <input type="submit" />
    </form>

<script language="Javascript" type="text/javascript">
// this must be called after concerned form or when document is fully loaded
change_class_check_onload('checked_on', document.forms.rubrique, 'rubrique_checker', 'tr');

// this is one will send an error (not found block_type)
change_class_check_onload('checked_on', document.forms.rubrique, 'rubrique_checker', 'pre');

// this is one will send an error (too few arguments)
change_class_check_onload('checked_on', document.forms.rubrique, 'rubrique_checker');
</script>
<h3>Maecenas libero lectus, eleifend congue</h3>
<div id="block1">
    <p>hendrerit eu, posuere accumsan, magna. Aenean euismod. Donec lobortis vestibulum sapien. Morbi pharetra ipsum ac nibh. Vestibulum quis mauris. Duis pulvinar lectus quis lectus. In hac habitasse platea dictumst Ut consequat, nunc vel dictu<strong>m faucibus, ante quam iaculis</strong> mi, sed gravida neque justo eu tellus. Sed vel massa vel orci laoreet luctus. Nulla facilisi. In risus. Cras et quam. Praesent sit amet mi. Maecenas consequat. Pellentesque consectetuer. Integer at urna non erat dapibus vehicula. Phasellus eu magna. In purus erat, consequat nec, <i>ultrices a, sollicitudin id, leo.</i></p>
    <p>Integer ultricies fringilla nunc. Fusce tempor augue vel tortor. Nullam at ante. Mauris faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque sodales interdum augue. Vivamus tempor viverra lacus. Mauris rutrum augue sit amet nisi. Mauris eleifend euismod sapien. In augue dui, dictum id, lobortis ac, aliquet in, libero.</p>
    <p>Proin ornare ligula vitae tellus. Pellentesque risus felis, tempus eget, placerat et, elementum at, ipsum. Suspendisse faucibus gravida quam. Fusce odio. Maecenas mattis pharetra felis. Nam in nunc vitae velit vehicula suscipit. Duis accumsan, lorem non tristique rhoncus, lacus purus imperdiet nunc, eget feugiat augue metus eget justo. Donec quis dui a dui condimentum egestas. Nullam eget arcu. In placerat pulvinar lacus.</p>
    <p>Fusce lacinia. Nullam laoreet ligula in pede. Vestibulum nunc purus, venenatis quis, blandit eget, congue at, risus. Sed orci. Nulla facilisi. Vestibulum vitae sem. Integer dignissim tortor vitae sem. Donec quis sapien. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas nonummy semper felis.</p>
    <p>Nunc non nibh. Suspendisse potenti. Mauris elementum interdum nunc. Donec sit amet tortor. Morbi vehicula mauris at odio. Maecenas commodo ultricies orci. Vivamus varius quam. Aenean auctor lorem sit amet magna. Fusce quis tellus. Vestibulum placerat vulputate lorem. Nulla elementum mattis nisi. Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.</p>
</div>

<hr />

<div class="floated">
<h3>Maecenas libero lectus, eleifend congue</h3>
<div id="block4">
    <p>hendrerit eu, posuere accumsan, magna. Aenean euismod. Donec lobortis vestibulum sapien. Morbi pharetra ipsum ac nibh. Vestibulum quis mauris. Duis pulvinar lectus quis lectus. In hac habitasse platea dictumst. Ut consequat, nunc vel dictu<strong>m faucibus, ante quam iaculis</strong> mi, sed gravida neque justo eu tellus. Sed vel massa vel orci laoreet luctus. Nulla facilisi. In risus. Cras et quam. Praesent sit amet mi. Maecenas consequat. Pellentesque consectetuer. Integer at urna non erat dapibus vehicula. Phasellus eu magna. In purus erat, consequat nec, <i>ultrices a, sollicitudin id, leo.</i></p>
    <p>Integer ultricies fringilla nunc. Fusce tempor augue vel tortor. Nullam at ante. Mauris faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque sodales interdum augue. Vivamus  tempor viverra lacus. Mauris rutrum augue sit amet nisi. Mauris eleifend euismod sapien. In augue dui, dictum id, lobortis ac, aliquet in, libero.</p>
    <p>Proin ornare ligula vitae tellus. Pellentesque risus felis, tempus eget, placerat et, elementum at, ipsum. Suspendisse faucibus gravida quam. Fusce odio. Maecenas mattis pharetra felis. Nam in nunc vitae velit vehicula suscipit. Duis accumsan, lorem non tristique rhoncus, lacus purus imperdiet nunc, eget feugiat augue metus eget justo. Donec quis dui a dui condimentum egestas.  Nullam eget arcu. In placerat pulvinar lacus.</p>
</div>
</div>

<div class="floated">
<h3>Nunc in ipsum. Mauris id ante.</h3> 
<div id="block5">
    <p>Fusce lacinia. Nullam laoreet ligula in pede. Vestibulum nunc purus, venenatis quis, blandit eget, congue at, risus. Sed orci. Nulla facilisi. Vestibulum vitae sem. Integer dignissim tortor vitae sem. Donec quis sapien. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas nonummy semper felis.</p>
    <p>Nunc non nibh. Suspendisse potenti. Mauris elementum interdum nunc. Donec sit amet tortor. Morbi vehicula mauris at odio. Maecenas commodo ultricies orci. Vivamus varius quam. Aenean auctor lorem sit amet magna. Fusce quis tellus. Vestibulum placerat vulputate lorem. Nulla elementum mattis nisi. Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.</p>
</div>
</div>

<div class="floated">
<h3>Donec pretium velit ut massa hendrerit bibendum.</h3> 
<div id="block6">
    <p>Nullam elit orci, posuere vel, imperdiet ac, interdum vitae, tellus. Etiam nisl. Mauris iaculis erat eu nisi gravida accumsan. Pellentesque pharetra. Fusce in quam nec ante euismod cursus. Etiam diam. Proin aliquam, nibh malesuada fringilla blandit, ante <a href="http://example.com">orci feugiat sem, ut vehicula risus mauris non augue.</a> Etiam dapibus elit ac massa. Praesent vitae metus. In sed augue. Suspendisse potenti. Vivamus lacinia justo ullamcorper arcu. Duis accumsan urna tempus dolor. Morbi felis. Nullam tortor urna, tincidunt tincidunt, luctus sodales, facilisis in, felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec in tellus.</p>
    <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce pede nisl, suscipit id, bibendum vel, euismod a, urna. Aliquam ut arcu. Nulla ullamcorper mauris ut velit. Etiam consectetuer ipsum id ligula. Nam euismod ipsum vitae felis. Quisque pede ante, pretium et, fermentum vel, tempor eget, dolor. Phasellus eu pede. Suspendisse bibendum, ligula at porta convallis, lacus mauris egestas risus, vitae scelerisque ante mauris a erat. Aenean varius ligula sed dui. Etiam pellentesque facilisis eros. In interdum orci. In augue pede, hendrerit ac, facilisis ut, convallis luctus, sapien. Nulla metus. Vestibulum neque justo, convallis eu, varius egestas, posuere eu, libero. Pellentesque nec elit nec diam commodo euismod. Aliquam aliquet convallis est. Integer consectetuer nibh non urna. Nam ultrices mauris.</p>
</div>
</div>

</body>
</html>