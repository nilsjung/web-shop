<?php

namespace Configuration;

/**
 * Class Configuration
 *
 * A singleton to store the database settings
 *
 * @package Configuration
 */
class Configuration
{
    private static $config = null;

    private function __construct()
    {
    }

    public static function instance()
    {
        if (is_null(self::$config)) {
            self::$config = [
                "DB_HOST" => "localhost",
                "DB_PORT" => "3306",
                "DB_USER" => "root",
                "DB_NAME" => "webshop",
                "DB_PASSWORD" => "",
            ];
        }
        return self::$config;
    }
}
