<?php

namespace View;

use Controller\SessionController;
use Model\QueryResult;
use mysql_xdevapi\Session;
use Template\Template;

/**
 * Class View
 *
 * @package View
 */
abstract class View
{
    /**
     * @var QueryResult
     */
    protected $model;

    /**
     * @var Template
     */
    protected $template;

    protected $token;

    /**
     * View constructor.
     *
     * @param QueryResult $queryResult
     */
    public function __construct(QueryResult $queryResult)
    {
        $this->model = $queryResult;
        $template = new Template();
        $this->setTemplate($template);

        $this->template->token = SessionController::getCSRFToken();
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
