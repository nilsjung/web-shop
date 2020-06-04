<?php

namespace Template;

/**
 * Class Template
 *
 *
 *
 * @package Template
 */
class Template
{
    private $_scriptPath;
    public $hasValidationError = false;
    public $properties;

    /**
     * Template constructor.
     */
    public function __construct()
    {
        $this->setScriptPath(
            $_SERVER["DOCUMENT_ROOT"] . "/Application/Templates/"
        );
        $this->properties = [];
    }

    /**
     * @param $scriptPath
     */
    public function setScriptPath($scriptPath)
    {
        $this->_scriptPath = $scriptPath;
    }

    /**
     * @param $filename
     * @return false|string
     */
    public function render($filename)
    {
        ob_start();
        if (file_exists($this->_scriptPath . $filename)) {
            include $this->_scriptPath . $filename;
            include $this->_scriptPath . "MainFooter.inc";
        } else {
            echo "Template not found";
        }
        return ob_get_clean();
    }

    public function renderPartial($filename)
    {
        ob_start();
        if (file_exists($this->_scriptPath . $filename)) {
            include $this->_scriptPath . $filename;
        } else {
            echo "Template not found";
        }
        return ob_get_clean();
    }

    /**
     * @param $k
     * @param $v
     */
    public function __set($k, $v)
    {
        $this->properties[$k] = $v;
    }

    /**
     * @param $k
     * @return mixed
     */
    public function __get($k)
    {
        return $this->properties[$k];
    }
}
