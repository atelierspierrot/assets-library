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

class ComposerManifestParser
{

    protected $file_path    = null;
    protected $raw_data     = null;
    protected $data         = array();

    public function __construct($file_path = null)
    {
        if (!is_null($file_path)) {
            $this->load($file_path);
        }
    }
    
    public function load($file_path)
    {
        if (file_exists($file_path)) {
            $this->setFilePath($file_path);
            if ($file_content = file_get_contents($this->getFilePath())) {
                $this->setRawData($file_content);
                if ($json = json_decode($this->getRawData(), true)) {
                    $this->setData($json);
                } else {
                    throw new Exception(
                        sprintf("File '%s' can't be parsed ; returning json error '%s:%s'!",
                            $file_path,
                            json_last_error(),
                            json_last_error_msg()
                    ));
                }
            } else {
                throw new Exception(sprintf("File '%s' can't be loaded!", $file_path));
            }
        } else {
            throw new Exception(sprintf("File '%s' not found!", $file_path));
        }
        return $this;
    }

// setters & getters

    public function setFilePath($path)
    {
        $this->file_path = $path;
        return $this;
    }

    public function getFilePath()
    {
        return $this->file_path;
    }

    public function setRawData($data)
    {
        $this->raw_data = $data;
        return $this;
    }

    public function getRawData()
    {
        return $this->raw_data;
    }

    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function getData($field_name = null, $default = null)
    {
        return !is_null($field_name) ? (
            isset($this->data[$field_name]) ? $this->data[$field_name] : $default
        ) : $this->data;
    }

// aliases

    public function getName()
    {
        return self::getData('name');
    }

    public function getType()
    {
        return self::getData('type');
    }

    public function getDescription()
    {
        return self::getData('description');
    }

    public function getLicense()
    {
        return self::getData('license');
    }

    public function getAuthors()
    {
        return self::getData('authors');
    }

    public function getRequire()
    {
        return self::getData('require');
    }

    public function getRequireDev()
    {
        return self::getData('require-dev');
    }

    public function getAutoload()
    {
        return self::getData('autoload');
    }

    public function getAutoloadPsr()
    {
        $dta = self::getData('autoload');
        return (!empty($dta) && isset($dta['PSR-0'])) ? $dta['PSR-0'] : array();
    }

    public function getAutoloadClassmap()
    {
        $dta = self::getData('autoload');
        return (!empty($dta) && isset($dta['classmap'])) ? $dta['classmap'] : array();
    }

    public function getAutoloadFiles()
    {
        $dta = self::getData('autoload');
        return (!empty($dta) && isset($dta['files'])) ? $dta['files'] : array();
    }

    public function getExtra()
    {
        return self::getData('extra');
    }

    public function getExtraEntry($entry_name)
    {
        $extra = self::getExtra();
        return (!empty($extra) && isset($extra[$entry_name])) ? $extra[$entry_name] : null;
    }

}

// Endfile