<?php
namespace core;

use PDO;

class Database {
    private static $conn;

    /**
     * Stablish connection with db using vars from config.php file
    */
    public static function connect() {
        if (!self::$conn) {
            self::$conn = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                DB_USER,
                DB_PASS,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        }
        return self::$conn;
    }
}
