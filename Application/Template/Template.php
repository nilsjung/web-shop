<?php

namespace Template;

class Template {
    private $_scriptPath;
    public $properties;

    public function __construct() {
        $this->setScriptPath($_SERVER[ "DOCUMENT_ROOT" ] . "/Public/Templates/");
        $this->properties = array();
    }

    public function setScriptPath( $scriptPath ) {
        $this->_scriptPath = $scriptPath;
    }

    /**
     * @param $filename
     * @return false|string
     * @throws TemplateNotFoundException
     */
    public function render( $filename ) {

        ob_start();
        if ( file_exists($this->_scriptPath . $filename) ) {
            include( $this->_scriptPath . $filename );
        } else {
            echo "Template not found";
        }
        return ob_get_clean();
    }

    public function __set( $k, $v ) {
        $this->properties[ $k ] = $v;
    }

    public function __get( $k ) {
        return $this->properties[ $k ];
    }
}