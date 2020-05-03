<?php

namespace Model;

/**
 * Class Model
 *
 * @package Model
 */
abstract class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::instance();
    }
}
