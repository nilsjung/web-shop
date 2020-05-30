<?php

namespace Router;

/**
 * Class Request
 *
 * @package Router
 */
class Request implements RequestInterface
{
    public $serverProtocol;
    public $requestMethod;
    public $redirectQueryString;
    public $redirectUrl;
    public $requestUri;
    public $params = [];

    /**
     * Request constructor.
     */
    function __construct()
    {
        foreach ($_SERVER as $key => $value) {
            $this->{$this->toCamelCase($key)} = $value;
        }

        $this->createParameterFromRequest();
    }

    /**
     * @param String $key
     * @return bool
     */
    public function isDefined(string $key): bool
    {
        return property_exists($this, $key);
    }

    /**
     * @param String $string
     * @return mixed|string
     */
    private function toCamelCase(string $string)
    {
        $result = strtolower($string);

        preg_match_all('/_[a-z]/', $result, $matches);

        foreach ($matches[0] as $match) {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }

        return $result;
    }

    /**
     * read and validate user input for GET and POST
     */
    private function createParameterFromRequest(): void
    {
        if ($this->requestMethod === "GET") {
            foreach ($_GET as $key => $value) {
                $this->params[$key] = filter_input(
                    INPUT_GET,
                    $key,
                    FILTER_SANITIZE_SPECIAL_CHARS
                );
            }
        }

        if ($this->requestMethod == "POST") {
            foreach ($_POST as $key => $value) {
                $this->params[$key] = filter_input(
                    INPUT_POST,
                    $key,
                    FILTER_SANITIZE_SPECIAL_CHARS
                );
            }
        }
    }

    protected function getParams(): array
    {
        return $this->params;
    }

    public function getParam(string $param): ?string
    {
        if (array_key_exists($param, $this->getParams())) {
            return $this->getParams()[$param];
        } else {
            return null;
        }
    }
}
