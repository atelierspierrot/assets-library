/*
# ***** BEGIN LICENSE BLOCK *****
# Assets Library - The open source PHP/JavaScript/CSS library of Les Ateliers Pierrot
# Copyleft (c) 2013-2014 Pierre Cassat and contributors
# <www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>
# License GPL-3.0 <http://www.opensource.org/licenses/gpl-3.0.html>
# Sources <http://github.com/atelierspierrot/assets-library>
#
# Ce programme est un logiciel libre distribué sous licence GNU/GPL.
#
# ***** END LICENSE BLOCK ***** */


/**
 * Registry class
 *
 * USAGE:
 *
 *    // classic set/get/isset usage:
 *    var _reg = Registry();
 *    _reg.set('foo', 'bar');
 *    _reg.isset('foo'); // => true
 *    _reg.get('foo'); // => 'bar'
 *    _reg.isset('inexistant'); // => false
 *    _reg.get('inexistant'); // => null
 *
 *    // unset usage:
 *    var _reg2 = Registry();
 *    _reg2.set('foo', 'bar');
 *    _reg2.set('hello', 'world');
 *    _reg2.get('foo'); // => 'bar'
 *    _reg2.get('hello'); // => 'world'
 *    _reg2.unset('foo');
 *    _reg2.get('foo'); // => null
 *    _reg2.get('hello'); // => 'world'
 *
 *    // clear usage:
 *    var _reg3 = Registry();
 *    _reg3.set('foo', 'bar');
 *    _reg3.set('hello', 'world');
 *    _reg3.get('foo'); // => 'bar'
 *    _reg3.get('hello'); // => 'world'
 *    _reg3.clear();
 *    _reg3.get('foo'); // => null
 *    _reg3.get('hello'); // => null
 *
 *    // retrieving a member name:
 *    var _reg4 = Registry();
 *    _reg4.set('foo', 'bar');
 *    _reg4.getName('bar'); // => 'foo'
 *    _reg4.getName('inexistant'); // => null
 *
 *    // multi-instances, different registries:
 *    var _reg5 = Registry();
 *    var _reg6 = Registry();
 *    _reg5.set('foo', 'bar');
 *    _reg5.debug(); // => Object { 'foo': 'bar' }
 *    _reg6.debug(); // => Object {}
 *
 *    // the registry data are private:
 *    var _reg7 = Registry();
 *    _reg7.set('foo', 'bar');
 *    console.debug(_reg7.data); // => undefined
 *    console.debug(_reg7.dump()); // => { 'foo': 'bar' }
 *
 */
var Registry = function(){

    // private properties, not accessible
    var data = {};

    // private methods, not accessible
    var init = function() {
        data = {};
    },
    uniqid = function() {
        var newDate = new Date, _id = newDate.getTime();
        while( data[_id]!==undefined ) { _id++; }
        return _id;
    };

    // public methods, accessible
    return {
        // set member "_name" on value "_value"
        set: function(_name, _value) {
            data[_name] = _value;
        },
        // add a new member "_value" creating a unique name and returns it
        add: function(_value) {
            var _name = uniqid();
            data[_name] = _value;
            return _name;
        },
        // get member "_name" value
        get: function(_name) {
            return this.isset(_name) ? data[_name] : null;
        },
        // check if member "_name" is defined
        isset: function(_name) {
            return data[_name]!==undefined;
        },
        // unset member "_name"
        unset: function(_name) {
            data[_name] = undefined;
        },
        // get member name for value "_value"
        getName: function(_value) {
            for(var i in data) {
                if (data[i]===_value) { return i; }
            }
            return null;
        },
        // get the whole registry
        dump: function() {
            return data;
        },
        // clear the whole registry
        clear: function() {
            init();
        },
        // dump the whole registry on console if so
        debug: function() {
            if (window.console && window.console.debug) { console.debug( data ); }
        }
    };
};

// Endfile