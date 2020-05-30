<?php

namespace Router;

/**
 * Interface RequestInterface
 *
 * @package Router
 */
interface RequestInterface
{
    /**
     * @param String $key
     * @return bool
     */
    public function isDefined(string $key): bool;
}
