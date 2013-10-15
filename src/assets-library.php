<?php
/**
 * Assets Library - The open source PHP/JavaScript/CSS library of Les Ateliers Pierrot
 * Copyleft (c) 2013 Pierre Cassat and contributors
 * <www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>
 * License GPL-3.0 <http://www.opensource.org/licenses/gpl-3.0.html>
 * Sources <http://github.com/atelierspierrot/assets-library>
 *
 * Ce programme est un logiciel libre distribué sous licence GNU/GPL.
 */

// -------------------------
// Settings
// -------------------------

// show errors
@ini_set('display_errors',1); @error_reporting(E_ALL ^ E_NOTICE);

// interface request
$request = array();
if (!empty($_GET)) {
    $request = array_merge($request, $_GET);
}
if (!empty($_POST)) {
    $request = array_merge($request, $_POST);
}

// -------------------------
// Constants
// -------------------------

/**
 * @var string Realpath of this file
 */
@define('_ASSETSLIB_PATH', realpath(__FILE__));

/**
 * @var string Web access to this file
 */
@define('_ASSETSLIB_HTTP', str_replace($_SERVER['DOCUMENT_ROOT'], '/', _ASSETSLIB_PATH));

/**
 * @var string Name of this file
 */
@define('_ASSETSLIB_FILE', basename(_ASSETSLIB_PATH));

/**
 * @var string Realpath of JS directory
 */
@define('_ASSETSLIB_JS_PATH', realpath(__DIR__.DIRECTORY_SEPARATOR.'js').DIRECTORY_SEPARATOR);

/**
 * @var string Web JS directory
 */
@define('_ASSETSLIB_JS_HTTP', str_replace($_SERVER['DOCUMENT_ROOT'], '/', _ASSETSLIB_JS_PATH));

/**
 * @var string Realpath of CSS directory
 */
@define('_ASSETSLIB_CSS_PATH', realpath(__DIR__.DIRECTORY_SEPARATOR.'css').DIRECTORY_SEPARATOR);

/**
 * @var string Web CSS directory
 */
@define('_ASSETSLIB_CSS_HTTP', str_replace($_SERVER['DOCUMENT_ROOT'], '/', _ASSETSLIB_CSS_PATH));

/**
 * @var string Realpath of IMG directory
 */
@define('_ASSETSLIB_IMG_PATH', realpath(__DIR__.DIRECTORY_SEPARATOR.'img').DIRECTORY_SEPARATOR);

/**
 * @var string Web IMG directory
 */
@define('_ASSETSLIB_IMG_HTTP', str_replace($_SERVER['DOCUMENT_ROOT'], '/', _ASSETSLIB_IMG_PATH));

/**
 * @var string CSS orientation
 */
@define('_CSS_DIRECTION', isset($request['dir']) ? $request['dir'] : 'ltr');

// -------------------------
// Library
// -------------------------

if (!function_exists('build_requirements'))
{
    /**
     * Include a library script script
     *
     * @param string $type
     * @param array $requirements
     * @return string
     */
    function build_requirements($type, array $requirements = null)
    {
        $url_args[] = 'type='.$type;
        if (!empty($requirements)) {
            foreach ($requirements as $tool=>$i) {
                if (!empty($i) && is_array($i)) {
                    foreach ($i as $k=>$v) {
                        $url_args[] = $tool.'[]='.$v;
                    }
                } elseif (is_numeric($tool)) {
                    $url_args[] = $i;
                } else {
                    $url_args[] = $tool.'='.$i;
                }
            }
        }
        return urldecode(_ASSETSLIB_HTTP.'?'.implode('&', $url_args));
    }
}

if (!function_exists('library_include'))
{
    /**
     * Include a library script
     *
     * @param string $type
     * @param string $tool_name
     * @param string $file_name
     * @return string
     */
    function library_include($type, $tool_name, $file_name = null)
    {
        $str = '';
        if (!empty($tool_name)) {
            $cc_type = strtoupper($type);
            switch ($type) {
                case 'js':
                    $extension = 'js';
                    $root_dir = _ASSETSLIB_JS_PATH;
                    $http_dir = _ASSETSLIB_JS_HTTP;
                    break;
                case 'css':
                    $extension = 'css';
                    $root_dir = _ASSETSLIB_CSS_PATH;
                    $http_dir = _ASSETSLIB_CSS_HTTP;
                    break;
                default:
                    $extension = $root_dir = $http_dir = '';
                    break;
            }
            $_f = $tool_name.DIRECTORY_SEPARATOR.(!empty($file_name) ? $file_name : $tool_name).'.'.$extension;
            if (file_exists($root_dir.$_f)) {
                $ctt = file_get_contents($root_dir.$_f);
                $str = "\n".'/* LIBRARY TOOL : Insert '.$cc_type.' file "'.$_f.'" */'
                    ."\n".strip_license_block($ctt);

            } elseif (file_exists($root_dir.$_f.'.php')) {
                $_f .= '.php';
                ob_start();
                include $root_dir.$_f;
                $str = "\n".'/* LIBRARY TOOL : Insert '.$cc_type.' file "'.$_f.'" */'
                    ."\n".strip_license_block(ob_get_contents());
                ob_end_clean();
            } else {
                $str = "\n".'/* LIBRARY TOOL ERROR : '.$cc_type.' file "'.$_f.'" not found ! */';
            }
        }
        return $str;
    }
}

if (!function_exists('treat_request'))
{
    /**
     * Include scripts from request
     *
     * For each tool to add, just pass a GET parameter like:
     * -   "tool_name=true"
     * -   "tool_dir=tool_name"
     * -   "tool_family[]=tool_name"
     *
     * @param string $type
     * @param array $request
     * @return string
     */
    function treat_request($type, array $request = null)
    {
        $str = '';
        if (!empty($request)) {
            foreach ($request as $tool=>$i) {
                if (!empty($i) && is_array($i)) {
                    foreach ($i as $_file) {
                        $str .= library_include($type, $tool, $_file);
                    }
                } elseif (!empty($i)) {
                    $str .= library_include($type, $tool, $i);
                } else {
                    $str .= library_include($type, $tool);
                }
            }
        }
        return $str;
    }
}

if (!function_exists('css_header'))
{
    /**
     * CSS PHP header
     */
    function css_header()
    {
        if (!headers_sent()) header("content-type: text/css");
    }
}

if (!function_exists('javascript_header'))
{
    /**
     * JavaScript PHP header
     */
    function javascript_header()
    {
        if (!headers_sent()) header("content-type: application/x-javascript");
    }
}

if (!function_exists('strip_license_block'))
{
    /**
     * Strip the license block above from a string (file_get_contents for example)
     */
    function strip_license_block($str = '')
    {
        return preg_replace('!/\*\n# \*\*\*\*\* BEGIN LICENSE BLOCK \*\*\*\*\*(.*)?\n# \*\*\*\*\* END LICENSE BLOCK \*\*\*\*\* \*/!s', '', $str);
    }
}

if (!function_exists('css3_rule'))
{
    /**
     * Write a full set of CSS3 rules
     *
     * Example :
     *     css3_rule( 'box-shadow', '0px 0px 5px #CCC' );
     * will return :
     *     -moz-box-shadow:0px 0px 5px #CCC; 
     *     -webkit-box-shadow:0px 0px 5px #CCC; 
     *     -o-box-shadow:0px 0px 5px #CCC; 
     *     box-shadow:0px 0px 5px #CCC; 
     *
     * @param str $property The CSS3 property name
     * @param str $value The CSS value to define
     * @param bool $indent Indent the code or not (default is true)
     * @return str The CSS3 definition string to display
     */
    function css3_rule($property, $value, $indent = true)
    {
        $browsers_prefix = array('-moz-', '-webkit-', '-o-', '');
        $str = '';
        foreach ($browsers_prefix as $_prefix) {
            if (true===$indent) {
                $str .= (strlen($str) ? "\n" : '')."\t";
            }
            $str .= $_prefix.$property.':'.$value.';';
        }
        return $str.(true===$indent ? "\n" : '');
    }
}

// -------------------------
// Interface
// -------------------------

// page type
$type = isset($request['type']) ? $request['type'] : null;
if (is_null($type)) {
    return '';
} else {
    unset($request['type']);
}

// process
switch ($type) {
    case 'js': case 'javascript':
        $str = treat_request('js', $request);
        if (!empty($str)) {
            javascript_header();
            echo $str;
        }
        break;
    case 'css':
        $str = treat_request('css', $request);
        if (!empty($str)) {
            css_header();
            echo $str;
        }
        break;
}

// Endfile