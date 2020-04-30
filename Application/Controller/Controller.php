<?php

namespace Controller;

abstract class Controller {
    public $model;

    public function __constructor($model) {
        $this->model = $model;
    }
}
