<?php

class Database
{
    private static $host, $username, $password, $name;

    private static $connect = NULL;

    public static function connect()
    {
        if (!isset(self::$connect)) {
            try {
                //get value from .env file
                self::$host = $_ENV['DATABASE_HOST'];
                self::$username = $_ENV['DATABASE_USERNAME'];
                self::$password = $_ENV['DATABASE_PASSWORD'];
                self::$name = $_ENV['DATABASE_NAME'];

                //init connect to DB service
                self::$connect = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$name, self::$username, self::$password);
                self::$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                return false;
            }
        }
        return self::$connect;
    }
}
