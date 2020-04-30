<?php

namespace Database;

use Configuration\Configuration;
use PDO;

class Database {

    private static $database = null;

    private function __construct() {
    }

    public static function instance() {
        $configuration = Configuration::instance();
        if ( is_null(self::$database) ) {
            self::$database = new PDO("mysql:host=" . $configuration[ "DB_HOST" ] . ";dbname=" . $configuration[ "DB_NAME" ], $configuration[ "DB_USER" ], $configuration[ "DB_PASSWORD" ]);
        }

        return self::$database;
    }

}