<?php

namespace Controller;

abstract class Controller {
    protected $model;

    /**
     * @param $model
     */
    public function __constructor( $model ) {
        $this->model = $model;
    }
}
