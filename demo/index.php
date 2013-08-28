<?php

/**
 * Show errors at least initially
 *
 * `E_ALL` => for hard dev
 * `E_ALL & ~E_STRICT` => for hard dev in PHP5.4 avoiding strict warnings
 * `E_ALL & ~E_NOTICE & ~E_STRICT` => classic setting
 */
@ini_set('display_errors','1'); @error_reporting(E_ALL);
//@ini_set('display_errors','1'); @error_reporting(E_ALL & ~E_STRICT);
//@ini_set('display_errors','1'); @error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);

/**
 * Set a default timezone to avoid PHP5 warnings
 */
$dtmz = @date_default_timezone_get();
date_default_timezone_set($dtmz?:'Europe/Paris');


$_roothttp = '';
if (empty($_roothttp) && isset($_SERVER['HTTP_HOST']) && !empty($_SERVER['HTTP_HOST'])) {
    $_roothttp = (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS'])!='off') ? 'https://' : 'http://';
    $_roothttp .= $_SERVER['HTTP_HOST'];
    $_roothttp .= str_replace( '\\', '/', dirname($_SERVER['PHP_SELF']));
    if (substr($_roothttp, -1) != '/') $_roothttp .= '/';
}
define('DEMO_HTTP_ROOT', $_roothttp);
define('DEMO_JS_DIR', __DIR__.'/../src/js');
define('DEMO_JS_WEBDIR', $_roothttp.'/../../src/js');
define('DEMO_CSS_DIR', __DIR__.'/../src/css');
define('DEMO_CSS_WEBDIR', $_roothttp.'/../../src/css');
define('DEMO_TEST_FILE', 'test.php');

function _slashDirname($path)
{
    return rtrim($path, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
}

function _getJsWebPath($path)
{
    return str_replace(_slashDirname(DEMO_JS_DIR), _slashDirname(DEMO_JS_WEBDIR), $path);
}

function _getCssWebPath($path)
{
    return str_replace(_slashDirname(DEMO_CSS_DIR), _slashDirname(DEMO_CSS_WEBDIR), $path);
}

if (!empty($_GET['page']) && $_GET['page']==='menu') :
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Test & documentation of "JS Library" package</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="assets/html5boilerplate/css/normalize.css" />
    <link rel="stylesheet" href="assets/html5boilerplate/css/main.css" />
    <script src="assets/html5boilerplate/js/vendor/modernizr-2.6.2.min.js"></script>
	<link rel="stylesheet" href="assets/styles.css" />
</head>
<body>
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->

    <header id="top" role="banner">
        <hgroup>
            <h1>JS Library</h1>
            <h2 class="slogan">The javascript library of Les Ateliers.</h2>
        </hgroup>
    </header>
    <br />
    <h2>Javascripts</h2>
    <ul class="menu" role="navigation">
<?php
foreach (scandir(DEMO_JS_DIR) as $_f) :
    $_fp = _slashDirname(DEMO_JS_DIR).$_f;
    if (!in_array($_f, array('.', '..')) && is_dir($_fp)) :
        $_fp_test = _slashDirname($_fp).DEMO_TEST_FILE;
        if (file_exists($_fp_test)) :
?>
        <li><a href="<?php echo _getJsWebPath($_fp_test); ?>" target="content"><?php echo $_f; ?></a></li>
<?php
        endif;
    endif;
endforeach;
?>
    </ul>
    <h2>CSS</h2>
    <ul class="menu" role="navigation">
<?php
foreach (scandir(DEMO_CSS_DIR) as $_f) :
    $_fp = _slashDirname(DEMO_CSS_DIR).$_f;
    if (!in_array($_f, array('.', '..')) && is_dir($_fp)) :
        $_fp_test = _slashDirname($_fp).DEMO_TEST_FILE;
        if (file_exists($_fp_test)) :
?>
        <li><a href="<?php echo _getCssWebPath($_fp_test); ?>" target="content"><?php echo $_f; ?></a></li>
<?php
        endif;
    endif;
endforeach;
?>
    </ul>

    <div class="info">
        <p><a href="http://github.com/atelierspierrot/js-library">See online on GitHub</a></p>
        <p class="comment">The sources of this plugin are hosted on <a href="http://github.com">GitHub</a>. To follow sources updates, report a bug or read opened bug tickets and any other information, please see the GitHub website above.</p>
    </div>

    <p class="credits" id="user_agent"></p>

    <footer id="footer">
		<div class="credits float-left">
		    This page is <a href="" title="Check now online" id="html_validation">HTML5</a> & <a href="" title="Check now online" id="css_validation">CSS3</a> valid.
		</div>
		<div class="credits float-right">
		    <a href="http://github.com/atelierspierrot/js-library">atelierspierrot/internationalization</a> package by <a href="https://github.com/PieroWbmstr">Piero Wbmstr</a> under <a href="http://opensource.org/licenses/GPL-3.0">GNU GPL v.3</a> license.
		</div>
    </footer>
</body>
</html>
<?php else: ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <title>Test & documentation of "JS Library" package</title>
        <meta name="description" content="" />
    </head>
    <!--
    ======================================================================================================
    This template is available for free download from the Quackit website.

    If you have found it to be useful, please consider linking from your website to http://www.quackit.com

    Thanks!
    ======================================================================================================

    Note the following:
    1. Each frame has it's own 'frame' tag.
    2. Each frame has a name (eg, name="menu"). This is used for when you need to load one frame from another. For example, your left frame might have links that, when clicked on, loads a new page in the right frame. This is acheived by using 'target="content"' within your links/anchor tags.
    3. Each 'frame' tag has a 'src' attribute. This is where you specify the name of the file to be loaded into that frame when the page first loads.
    4. You can change the size of the frames by changing the value of the 'cols' and/or 'rows' attribute. A value of "200" sets the frame at 200 pixels. An asterisk (*) specifies that the frame should use up whatever space is left over from the other frames. You can also use percentage values if desired (i.e. 20%,80%)
    5. To specify a border, set 'frameborder' and 'border' to "1". I included both attributes for maximum browser compatibility.
    6. The 'framespacing' attribute doesn't work in all browsers, but you can set any numeric value you like here.
    7. To learn more about HTML frames, check out: http://www.quackit.com/html/tutorial/html_frames.cfm
    -->
    <frameset cols="200,*" frameborder="0" border="0" framespacing="0">
        <frame name="menu" src="index.php?page=menu" marginheight="0" marginwidth="0" scrolling="auto" noresize>
        <frame name="content" src="" marginheight="0" marginwidth="0" scrolling="auto" noresize>
        <noframes>
            <p>Your browser doesn't support HTML frameset, you will have to navigate <a href="../src/">in the code</a>.</p>
        </noframes>
    </frameset>
    </html>
<?php endif; ?>