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