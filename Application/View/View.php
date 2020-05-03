<?php

namespace View;

use Controller\Controller;
use Controller\SessionController;
use Model\Model;
use Template\Template;

/**
 * Class View
 *
 * @package View
 */
abstract class View
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Controller
     */
    protected $controller;

    /**
     * @var Template
     */
    protected $template;

    /**
     * View constructor.
     *
     * @param $controller
     * @param $model
     */
    public function __construct($controller, $model)
    {
        $this->model = $model;
        $this->controller = $controller;
        $template = new Template();
        $this->setTemplate($template);
    }

    /**
     * @param $template
     */
    private function setTemplate($template): void
    {
        $this->template = $template;
    }

    /**
     * @param array $properties
     */
    public function setProperties(array $properties): void
    {
        foreach ($properties as $key => $value) {
            $this->template->$key = $value;
        }
    }

    abstract public function render();
}
