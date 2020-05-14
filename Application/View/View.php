<?php

namespace View;

use Template\Template;

/**
 * Class View
 *
 * @package View
 */
abstract class View
{
    /**
     * @var \Model\Domain\Model
     */
    protected $model;

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
    public function __construct($model)
    {
        $this->model = $model;
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
