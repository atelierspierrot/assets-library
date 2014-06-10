<?php
/**
 * Assets Library - The open source PHP/JavaScript/CSS library of Les Ateliers Pierrot
 * Copyleft (c) 2013-2014 Pierre Cassat and contributors
 * <www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>
 * License GPL-3.0 <http://www.opensource.org/licenses/gpl-3.0.html>
 * Sources <http://github.com/atelierspierrot/assets-library>
 *
 * Ce programme est un logiciel libre distribué sous licence GNU/GPL.
 */

if (!class_exists('ComposerManifestParser')) {
    require_once __DIR__.'/ComposerManifestParser.php';
}

class DependenciesManager
{

    protected $composer_manifest    = null;
    protected $dependencies         = null;

    public function __construct($manifest_path)
    {
        try {
            $this->setComposerManifest(new ComposerManifestParser($manifest_path));
        } catch (Exception $e) {
            throw $e;
        }
    }

// setters & getters

    public function setComposerManifest(ComposerManifestParser $composer)
    {
        $this->composer_manifest = $composer;
        $this->setDependencies($this->composer_manifest->getExtraEntry('assets-presets'));
        return $this;
    }

    public function getComposerManifest()
    {
        return $this->composer_manifest;
    }

    public function setDependencies(array $deps = array())
    {
        $this->dependencies = $deps;
        return $this;
    }

    public function getDependencies($name = null)
    {
        return !is_null($name) ? (
            isset($this->dependencies[$name]) ? $this->dependencies[$name] : array()
        ) : $this->dependencies;
    }

    public function findDependencies($entry)
    {
        $deps = $this->getDependencies($entry);
        $assets = array();
        if (!empty($deps)) {
            $requirements = !empty($deps['require']) ? $deps['require'] : null;
            if (!empty($requirements)) {
                foreach ($requirements as $dep_item) {
                    $dep_item_assets = $this->findDependencies($dep_item);
                    $this->_buildAssets($assets, $dep_item_assets);
                }
            }
            unset($deps['require']);
            $this->_buildAssets($assets, $deps);
        }
        return $assets;
    }

    protected function _buildAssets(&$assets, $entry)
    {
        if (!empty($entry)) {
            foreach ($entry as $stack=>$list) {
                if (!isset($assets[$stack])) {
                    $assets[$stack] = array();
                }
                if (!is_array($list)) {
                    $list = array($list);
                }
                foreach ($list as $item) {
                    $assets[$stack][] = $item;
                }
            }
        }
        return;
    }

}

// Endfile