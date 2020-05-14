<?php

namespace Controller;

/**
 * Class Controller
 *
 * @package Controller
 */
abstract class Controller
{
    protected $model;

    /**
     * @param \Model\Model $model
     */
    public function __constructor(\Model\Model $model)
    {
        $this->setModel($model);
    }

    public function setModel(\Model\Model $model)
    {
        $this->model = $model;
    }
}
