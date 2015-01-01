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
 * @var string Realpath of the package
 */
@define('_ASSETSLIB_ROOTPATH', realpath(__DIR__.'/../'));

/**
 * @var string Realpath of package manifest to load presets dependencies
 */
@define('_ASSETSLIB_MANIFEST', _ASSETSLIB_ROOTPATH.'/composer.json');

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

if (!function_exists('build_preset_url'))
{
    /**
     * Build the URL for preset calls
     *
     * @param string $type
     * @param string $preset
     * @return string
     */
    function build_preset_url($type, $preset)
    {
        return urldecode(_ASSETSLIB_HTTP.'?type='.$type.'&preset='.$preset);
    }
}

if (!function_exists('prepare_preset_include'))
{
    /**
     * Build a preset requirements and include it
     *
     * @param string $type 'js' or 'css'
     * @param string $preset
     * @return void
     */
    function prepare_preset_include($type, $preset)
    {
        require_once __DIR__.'/DependenciesManager.php';
        $presets = new DependenciesManager(_ASSETSLIB_MANIFEST);
        $deps = $presets->findDependencies($preset);
        if (!empty($deps) && isset($deps[$type])) {
            $str = '';
            foreach ($deps[$type] as $item) {
                $str .= library_include($item);
            }
            if (!empty($str)) {
                if ($type==='css') {
                    css_header();
                } elseif ($type==='js') {
                    javascript_header();
                }
                echo $str;
            }
        }
    }
}

if (!function_exists('build_requirements_url'))
{
    /**
     * Include a library script script
     *
     * @param string $type
     * @param array $requirements
     * @return string
     */
    function build_requirements_url($type, array $requirements = null)
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

if (!function_exists('prepare_library_include'))
{
    /**
     * Prepare the inclusion of a library script
     *
     * @param string $type
     * @param string $tool_name
     * @param string $file_name
     * @return string
     */
    function prepare_library_include($type, $tool_name, $file_name = null)
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
            $str = library_include($root_dir.$tool_name.DIRECTORY_SEPARATOR.(!empty($file_name) ? $file_name : $tool_name).'.'.$extension);
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
                        $str .= prepare_library_include($type, $tool, $_file);
                    }
                } elseif (!empty($i)) {
                    $str .= prepare_library_include($type, $tool, $i);
                } else {
                    $str .= prepare_library_include($type, $tool);
                }
            }
        }
        return $str;
    }
}

if (!function_exists('library_include'))
{
    /**
     * Include a library script
     *
     * @param string $file_name
     * @return string
     */
    function library_include($file_name)
    {
        $str = '';
        if (!empty($file_name)) {
            if (false!==($end = substr($file_name, -(strlen('.php')))) && $end==='.php') {
                $file_name = substr($file_name, 0, -(strlen('.php')));
            }
            if (!file_exists($file_name) && (
                file_exists(_ASSETSLIB_PATH.$file_name) || file_exists(_ASSETSLIB_PATH.$file_name.'.php')
            )) {
                $file_name = _ASSETSLIB_PATH.$file_name;
            }
            $cc_type = strtoupper(pathinfo($file_name, PATHINFO_EXTENSION));
            if (file_exists($file_name)) {
                $ctt = file_get_contents($file_name);
                $str = "\n".'/* LIBRARY TOOL : Insert '.$cc_type.' file "'.$file_name.'" */'
                    ."\n".strip_license_block($ctt);

            } elseif (file_exists($file_name.'.php')) {
                $file_name .= '.php';
                ob_start();
                include $file_name;
                $str = "\n".'/* LIBRARY TOOL (PHP source) : Insert '.$cc_type.' file "'.$file_name.'" */'
                    ."\n".strip_license_block(ob_get_contents());
                ob_end_clean();
            } else {
                $str = "\n".'/* LIBRARY TOOL ERROR : '.$cc_type.' file "'.$file_name.'" not found ! */';
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

// 'preset' case
$preset = null;
if (isset($request['preset'])) {
    $preset = $request['preset'];
    unset($request['preset']);
}

// process the rest
$str = '';
switch ($type) {
    case 'js': case 'javascript':
        if (!empty($preset)) {
            $str .= prepare_preset_include('js', $preset);
        }
        $str .= treat_request('js', $request);
        if (!empty($str)) {
            javascript_header();
            echo $str;
        }
        break;
    case 'css': case 'stylesheet':
        if (!empty($preset)) {
            $str .= prepare_preset_include('css', $preset);
        }
        $str .= treat_request('css', $request);
        if (!empty($str)) {
            css_header();
            echo $str;
        }
        break;
}

// Endfile