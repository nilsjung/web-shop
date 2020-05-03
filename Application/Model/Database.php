<?php

namespace Model;

use Configuration\Configuration;
use PDO;

/**
 * Class Database
 *
 * @package Model
 */
class Database
{
    /**
     * @var null
     */
    private static $database = null;

    /**
     * Database constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return PDO|null
     */
    public static function instance()
    {
        $configuration = Configuration::instance();
        if (is_null(self::$database)) {
            self::$database = new PDO(
                "mysql:host=" .
                    $configuration["DB_HOST"] .
                    ";dbname=" .
                    $configuration["DB_NAME"],
                $configuration["DB_USER"],
                $configuration["DB_PASSWORD"]
            );
        }

        return self::$database;
    }
}
