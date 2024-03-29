<?php
declare(strict_types=1);

namespace App\Config;

use PDO;

class DB
{
    private static ?string $dbHost = null;
    private static ?string $dbUser = null;
    private static ?string $dbPass = null;
    private static ?string $dbName = null;

    /**
     * @return void
     */
    // Function initialize database credentials from .env
    private static function init(): void
    {
        self::$dbHost = $_ENV['DB_HOST'];
        self::$dbUser = $_ENV['DB_USER'];
        self::$dbPass = $_ENV['DB_PASS'];
        self::$dbName = $_ENV['DB_NAME'];
    }

//    /**
//     * @return mysqli
//     */
//    public static function getConnection(): mysqli
//    {
//        if(!self::$dbHost) {
//            self::init();
//        }
//
//        return new mysqli(self::$dbHost, self::$dbUser, self::$dbPass, self::$dbName);
//    }

    /**
     * @return PDO
     */
    public static function getConnection(): PDO
    {
        if(!self::$dbHost) {
            self::init();
        }

        $dsn = "mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        return new PDO($dsn, self::$dbUser, self::$dbPass, $options);
    }
}