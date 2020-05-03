<?php

namespace Model;

abstract class Model {
    protected $db;

    public function __construct() {
        $this->db = Database::instance();
    }
}