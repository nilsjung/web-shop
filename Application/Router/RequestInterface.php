<?php

namespace Router;

interface RequestInterface {
    public function getBody();
    public function getParams();
    public function isDefined(String $key) : bool;
}