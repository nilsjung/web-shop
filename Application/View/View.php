<?php

namespace View;

abstract class View {
    protected $model;
    protected $controller;

    protected $template;

    public function __construct( $controller, $model ) {
        $this->model = $model;
        $this->controller = $controller;
    }

    public function setTemplate( $template ) {
        $this->template = $template;
    }

    public function setProperties( Array $properties ) {
        foreach ($properties as $key => $value) {
            $this->template->$key = $value;
        }
    }

    abstract public function render();
}