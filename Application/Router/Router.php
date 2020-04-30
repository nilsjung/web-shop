<?php

namespace Router;

class Router {
    private $request;
    private $supportedHttpMethods = array(
        "GET",
        "POST",
    );

    function __construct( RequestInterface $request ) {
        $this->request = $request;
    }

    function __call( $name, $args ) {
        list($route, $method) = $args;

        if ( !in_array(strtoupper($name), $this->supportedHttpMethods) ) {
            $this->invalidMethodHandler();
        }

        $this->{strtolower($name)}[ $this->formatRoute($route) ] = $method;
    }

    /**
     * Removes trailing forward slashes from the right of the route.
     *
     * @param route (string)
     * @return string
     */
    private function formatRoute( $route ) {
        $result = rtrim($route, '/');
        if ( $result === '' ) {
            return '/';
        }
        return $result;
    }

    private function invalidMethodHandler() {
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
    }

    private function defaultRequestHandler() {
        header("{$this->request->serverProtocol} 404 Not Found");
    }

    /**
     * Resolves a route
     */
    function resolve() {
        $methodDictionary = $this->{strtolower($this->request->requestMethod)};
        if (($this->request->isDefined('redirectUri'))) {
            $formattedRoute = $this->formatRoute($this->request->redirectUrl);
        } else {
            $formattedRoute = $this->formatRoute($this->request->requestUri);
        }
        $method = $methodDictionary[ $formattedRoute ];

        if ( is_null($method) ) {
            $this->defaultRequestHandler();
            return;
        }

        echo call_user_func_array($method, array( $this->request ));
    }

    function __destruct() {
        $this->resolve();
    }
}