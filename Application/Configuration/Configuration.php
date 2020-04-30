<?php

namespace Configuration;

class Configuration {
    private static $config = null;

    private function __construct() {
    }

    public static function instance() {
        if ( is_null(self::$config) ) {
            self::$config = array(
                "DB_HOST" => "localhost",
                "DB_PORT" => "3306",
                "DB_USER" => "root",
                "DB_NAME" => "webshop",
                "DB_PASSWORD" => "",
            );
        }
        return self::$config;
    }
}
