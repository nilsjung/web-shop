<?php

namespace Router;

/**
 * Class Request
 *
 * @package Router
 */
class Request implements RequestInterface {

    public $serverProtocol;
    public $requestMethod;
    public $redirectQueryString;
    public $redirectUrl;
    public $requestUri;

    /**
     * Request constructor.
     */
    function __construct() {
        foreach ( $_SERVER as $key => $value ) {
            $this->{$this->toCamelCase($key)} = $value;
        }
    }

    /**
     * @param String $key
     * @return bool
     */
    public function isDefined( String $key ): bool {
        return property_exists($this, $key);
    }

    /**
     * @param String $string
     * @return mixed|string
     */
    private function toCamelCase( String $string ) {
        $result = strtolower($string);

        preg_match_all('/_[a-z]/', $result, $matches);

        foreach ( $matches[ 0 ] as $match ) {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }

        return $result;
    }

    /**
     * @return array|null
     */
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

    /**
     * @return array
     */
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