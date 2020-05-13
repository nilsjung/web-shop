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
     * @param \Model\Domain\Model $model
     */
    public function __constructor(\Model\Domain\Model $model)
    {
        $this->model = $model;
    }
}
