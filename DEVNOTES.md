Assets Library - Development notes
==================================


## Build 'composer.json'

The 'composer.json' file is built from a template to facilitate "presets" definitions. The
original template is `build/composer.json.build` and can be parsed to construct the final
"composer.json" at the root of the package running:

    cd root/dir/of/package
    ./build/build-composer-json.sh

The key point of this package is to declare and maintain the list of "presets" defined in
the "composer.json" file as they will finally be used to load dependencies. Take a look at
the [Assets Manager](https://github.com/atelierspierrot/assets-manager) package for more
informations about "presets".


## Demonstration and test files

A single demonstration file is designed at `demo/index.php` and will load any CSS or JS feature
in a simple left-bar menu. When loading a feature clicking on a menu item, the result is to
load any `test.php` file found in the related directory in the frame on the right.

### Per feature test file

When writing a test file for a specific feature, you can use the following methods to load
JS and CSS dependencies:

-   `build_requirements_url( type , array )` which will build the "href" or "src" URL to load
    related files requested in the second argument's array ; the final URL is something like:
    
        .../assets-library.php?type=js&commons&form_serialize

-   `build_preset_url( type , preset )` which will build the "href" or "src" URL to load
    a preset and all its dependendices ; the final URL is something like:
    
        .../assets-library.php?type=js&preset=ajax

### Basic test file

A set of "commons" JS and CSS definitions are defined to homogenize the result and a default
`test.php` template should be:

    <?php
    /*
    # ***** BEGIN LICENSE BLOCK *****
    # Assets Library - The open source PHP/JavaScript/CSS library of Les Ateliers Pierrot
    # Copyleft (c) 2013 Pierre Cassat and contributors
    # <www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>
    # License GPL-3.0 <http://www.opensource.org/licenses/gpl-3.0.html>
    # Sources <http://github.com/atelierspierrot/assets-library>
    #
    # Ce programme est un logiciel libre distribué sous licence GNU/GPL.
    #
    # ***** END LICENSE BLOCK ***** */

    @ini_set('display_errors',1); @error_reporting(E_ALL ^ E_NOTICE); 
    require_once __DIR__.'/../../assets-library.php';

    $requirements = array(
        'js'=>array('commons'),
        'css'=>array('commons'),
    );

    ?><html>
    <head>
    <title>Test of XXX feature</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

    <!-- Commons -->
    <script type="text/javascript" src="<?php echo build_requirements_url('js', $requirements['js']); ?>"></script>
    <link href="<?php echo build_requirements_url('css', $requirements['css']); ?>" media="screen" rel="stylesheet" type="text/css" />

    <!-- Preset -->
    <script type="text/javascript" src="<?php echo build_preset_url('js', 'XXX'); ?>"></script>
    <link href="<?php echo build_preset_url('css', 'XXX'); ?>" media="screen" rel="stylesheet" type="text/css" />

    </head>
    <body>
        Test content page
    </body>
    </html>

You can add any other requirements in the `$requirements` array, keeping in mind that the
`preset` calls will load all dependencies declared in the "composer.json" file.

