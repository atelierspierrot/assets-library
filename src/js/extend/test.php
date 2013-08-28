<!--
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
--><html>
<head>
<title>Test of Extend javascript functions</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="../commons.js.php"></script>  
<script type="text/javascript" src="extend.js"></script>  
<script language="Javascript" type="text/javascript">

var _obj = {
    prop1: 'property 1',
    prop2: 'property 2',
    foo: 'bar',
    method1: function( arg ){
        console.debug('receiving arg['+arg+'] from method "method1"');
    },
    test: function(){
        console.debug('test: foo is "'+this.foo+'"');
    }
};

var _objunderscored = {
    _prop1: 'property 1',
    _prop2: 'property 2',
    _foo: 'bar',
    _method1: function( arg ){
        console.debug('receiving arg['+arg+'] from method "method1"');
    },
    test: function(){
        console.debug('test: foo is "'+this._foo+'"');
    }
};

// new instance
console.info("Initializing a new '_obj'");
var _extobj = _obj;
console.debug(_extobj);
_extobj.test();
console.info("Extending '_obj'");
extend(_extobj, {
    prop1: 'property 1 extended',
    prop3: 'property 3 extended',
    foo: 'bar extended',
    method1: 'extended'
});
console.debug(_extobj);
_extobj.test();

// new instance
console.info("Initializing a new '_objunderscored'");
var _extobj2 = _objunderscored;
console.debug(_extobj2);
_extobj2.test();
console.info("Extending ...");
extend(_extobj2, {
    prop1: 'property 1 extended',
    prop3: 'property 3 extended',
    foo: 'bar extended',
    method1: 'extended'
}, '_%s');
console.debug(_extobj2);
_extobj2.test();

var _alt_obj = {
    prop1: 'property 1 alt',
    prop2: 'property 2 alt',
    foo: 'bar alt',
    method1: function( arg ){
        console.debug('receiving arg['+arg+'] from method "method1"');
    },
    test: function(){
        console.debug('test: foo is "'+this.foo+'"');
    }
};

// new instance
console.info("Initializing a new '_obj'");
var _extobj3 = _obj;
console.debug(_extobj3);
_extobj3.test();
console.info("Multi-extending ...");
multiExtend(_extobj3, {
    prop1: 'property 1 extended',
    prop3: 'property 3 extended',
    foo: 'bar extended',
    method1: 'extended'
}, _alt_obj);
console.debug(_extobj3);
_extobj3.test();

</script>
</head>

<body>
	<p>This page provides tests of the javascript functions '<strong>Extend</strong>'; information is written in console.</p>
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