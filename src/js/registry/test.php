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
require_once __DIR__.'/../../assets-library.php';

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
<title>Test of Registry javascript functions</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- Requirements -->
<script type="text/javascript" src="<?php echo build_requirements_url('js', $requirements['js']); ?>"></script>
<link href="<?php echo build_requirements_url('css', $requirements['css']); ?>" media="screen" rel="stylesheet" type="text/css" />

<!-- Preset "ajax" -->
<script type="text/javascript" src="<?php echo build_preset_url('js', 'registry'); ?>"></script>
<link href="<?php echo build_preset_url('css', 'registry'); ?>" media="screen" rel="stylesheet" type="text/css" />

<script language="Javascript" type="text/javascript">


// new instance
console.info("Initializing a new registry in '_reg'");
var _reg = Registry();
console.debug("dumping '_reg'");
_reg.debug();

// set test
console.info("Setting registry '_reg' members : foo=bar, foo2=bar2, boolt=true, boolf=false");
_reg.set("foo", "bar");
_reg.set("foo2", "bar2");
_reg.set("boolt", true);
_reg.set("boolf", false);
console.debug("dumping '_reg'");
_reg.debug();

// members test
console.info("Getting member 'foo' and loading it in var 'v'");
var v = _reg.get("foo");
console.debug("v=" + v +" registry[foo]=" + _reg.get("foo"));
v = 'foobar';
console.debug("overwriting 'v' on 'foobar' does not overwrite member 'foo'");
console.debug("v=" + v +" registry[foo]=" + _reg.get("foo"));

// get and isset test
console.info("Checking members in '_reg'");
console.debug("checking member 'boolt': get["+_reg.get("boolt")+"] isset["+_reg.isset("boolt")+"]");
console.debug("checking member 'boolf': get["+_reg.get("boolf")+"] isset["+_reg.isset("boolf")+"]");
console.debug("checking inexistant member 'other': get["+_reg.get("other")+"] isset["+_reg.isset("other")+"]");

// getName test
console.info("Searching member names in '_reg'");
console.debug("getName (bar) : "+_reg.getName("bar"));
console.debug("getName (other) : "+_reg.getName("other"));

// unset test
console.info("Unsetting 'foo2' in '_reg'");
_reg.unset('foo2');
console.debug("checking prop 'foo2' : get["+_reg.get("foo2")+"] isset["+_reg.isset("foo2")+"]");
console.debug("dumping '_reg'");
_reg.debug();

// dump test
console.info("Dumping '_reg' in var 'yo'");
var yo = _reg.dump();
console.debug("yo=", yo);

// dump test
console.info("Adding new values in '_reg' getting their names");
var newid = _reg.add('a value with unique ID');
var newid2 = _reg.add('a second value with unique ID');
console.debug("newid=", newid, " newid2=", newid2);
console.debug("checking prop '"+newid+"' : get["+_reg.get(newid)+"] isset["+_reg.isset(newid)+"]");
console.debug("checking prop '"+newid2+"' : get["+_reg.get(newid2)+"] isset["+_reg.isset(newid2)+"]");
console.debug("dumping '_reg'");
_reg.debug();

// new instance
console.info("Initializing a new registry in '_newreg'");
var _newreg = Registry();
console.debug("dumping '_newreg' (must be empty)");
_newreg.debug();
console.debug("dumping '_reg' (must NOT be empty)");
_reg.debug();

// private access test
console.info("Trying to access the 'data' property of registries");
console.debug("'_reg' data ? ", _reg.data);
console.debug("'_newreg' data ? ", _newreg.data);

// clear test
console.info("Clearing '_reg'");
_reg.clear();
console.debug("dumping '_reg'");
_reg.debug();

</script>
</head>

<body>
    <p>This page provides tests of the javascript functions '<strong>debug</strong>'; information is written in console.</p>
    <hr />
        <h3>JS console</h3>
        <div id="console"></div>

    <hr />
<h3>Maecenas libero lectus, eleifend congue</h3>
<div id="block1" style="font-size:1.1em;">
    <p>hendrerit eu, posuere accumsan, magna. Aenean euismod. Donec lobortis vestibulum sapien. Morbi pharetra ipsum ac nibh. Vestibulum quis mauris. Duis pulvinar lectus quis lectus. In hac habitasse platea dictumst Ut consequat, nunc vel dictu<strong>m faucibus, ante quam iaculis</strong> mi, sed gravida neque justo eu tellus. Sed vel massa vel orci laoreet luctus. Nulla facilisi. In risus. Cras et quam. Praesent sit amet mi. Maecenas consequat. Pellentesque consectetuer. Integer at urna non erat dapibus vehicula. Phasellus eu magna. In purus erat, consequat nec, <i>ultrices a, sollicitudin id, leo.</i></p>
    <p>Integer ultricies fringilla nunc. Fusce tempor augue vel tortor. Nullam at ante. Mauris faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque sodales interdum augue. Vivamus tempor viverra lacus. Mauris rutrum augue sit amet nisi. Mauris eleifend euismod sapien. In augue dui, dictum id, lobortis ac, aliquet in, libero.</p>
    <p>Proin ornare ligula vitae tellus. Pellentesque risus felis, tempus eget, placerat et, elementum at, ipsum. Suspendisse faucibus gravida quam. Fusce odio. Maecenas mattis pharetra felis. Nam in nunc vitae velit vehicula suscipit. Duis accumsan, lorem non tristique rhoncus, lacus purus imperdiet nunc, eget feugiat augue metus eget justo. Donec quis dui a dui condimentum egestas. Nullam eget arcu. In placerat pulvinar lacus.</p>
    <p>Fusce lacinia. Nullam laoreet ligula in pede. Vestibulum nunc purus, venenatis quis, blandit eget, congue at, risus. Sed orci. Nulla facilisi. Vestibulum vitae sem. Integer dignissim tortor vitae sem. Donec quis sapien. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas nonummy semper felis.</p>
    <p>Nunc non nibh. Suspendisse potenti. Mauris elementum interdum nunc. Donec sit amet tortor. Morbi vehicula mauris at odio. Maecenas commodo ultricies orci. Vivamus varius quam. Aenean auctor lorem sit amet magna. Fusce quis tellus. Vestibulum placerat vulputate lorem. Nulla elementum mattis nisi. Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.</p>
    <p>Nullam elit orci, posuere vel, imperdiet ac, interdum vitae, tellus. Etiam nisl. Mauris iaculis erat eu nisi gravida accumsan. Pellentesque pharetra. Fusce in quam nec ante euismod cursus. Etiam diam. Proin aliquam, nibh malesuada fringilla blandit, ante <a href="http://example.com">orci feugiat sem, ut vehicula risus mauris non augue.</a> Etiam dapibus elit ac massa. Praesent vitae metus. In sed augue. Suspendisse potenti. Vivamus lacinia justo ullamcorper arcu. Duis accumsan urna tempus dolor. Morbi felis. Nullam tortor urna, tincidunt tincidunt, luctus sodales, facilisis in, felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec in tellus.</p>
    <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce pede nisl, suscipit id, bibendum vel, euismod a, urna. Aliquam ut arcu. Nulla ullamcorper mauris ut velit. Etiam consectetuer ipsum id ligula. Nam euismod ipsum vitae felis. Quisque pede ante, pretium et, fermentum vel, tempor eget, dolor. Phasellus eu pede. Suspendisse bibendum, ligula at porta convallis, lacus mauris egestas risus, vitae scelerisque ante mauris a erat. Aenean varius ligula sed dui. Etiam pellentesque facilisis eros. In interdum orci. In augue pede, hendrerit ac, facilisis ut, convallis luctus, sapien. Nulla metus. Vestibulum neque justo, convallis eu, varius egestas, posuere eu, libero. Pellentesque nec elit nec diam commodo euismod. Aliquam aliquet convallis est. Integer consectetuer nibh non urna. Nam ultrices mauris.</p>
</div>

</body>
</html>