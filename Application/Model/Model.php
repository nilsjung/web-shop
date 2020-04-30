<?php

namespace Model;

use Database\Database;

abstract class Model {
    protected $db;

    public function __construct() {
        $this->db = Database::instance();
    }
}