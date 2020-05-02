<?php

namespace Router;

class Request implements RequestInterface {

    public $serverProtocol;
    public $requestMethod;
    public $redirectQueryString;
    public $redirectUrl;
    public $requestUri;

    function __construct() {
        foreach ( $_SERVER as $key => $value ) {
            $this->{$this->toCamelCase($key)} = $value;
        }
    }

    public function isDefined( String $key ): bool {
        return property_exists($this, $key);
    }

    private function toCamelCase( String $string ) {
        $result = strtolower($string);

        preg_match_all('/_[a-z]/', $result, $matches);

        foreach ( $matches[ 0 ] as $match ) {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }

        return $result;
    }

    public function getBody() {
        if ( $this->requestMethod === "GET" ) {
            return null;
        }

        if ( $this->requestMethod == "POST" ) {
            $body = array();
            foreach ( $_POST as $key => $value ) {
                $body[ $key ] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }

            return $body;
        }
    }

    public function getParams() {
        $params = [];
        if ( $this->redirectQueryString ) {
            $parameterValuePairs = explode("&", $this->redirectQueryString);
            foreach ( $parameterValuePairs as $paramValue ) {
                list($key, $value) = explode("=", $paramValue);
                $params[ $key ] = $value;
            }
        }
        return $params;
    }
}