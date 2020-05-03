<?php

namespace Router;

/**
 * Interface RequestInterface
 *
 * @package Router
 */
interface RequestInterface {
    /**
     * @return mixed
     */
    public function getBody();

    /**
     * @return mixed
     */
    public function getParams();

    /**
     * @param String $key
     * @return bool
     */
    public function isDefined( String $key ): bool;
}