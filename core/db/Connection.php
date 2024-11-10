<?php

namespace Core\DB;

use PDO;

class Connection {
    
    protected static $dbtype = 'mysql';
    protected static $host = 'localhost';
    protected static $dbname = 'farmers';
    protected static $username = 'root';
    protected static $password = '';
    public static PDO|null $connection = null;

    public static function getConnection(): PDO {
        if (is_null(self::$connection)) {
            self::$connection = new PDO(self::getDSN(), self::$username, self::$password);
        }
        return self::$connection;
    }

    protected static function getDSN(): string {
        return self::$dbtype . ':host=' . self::$host . ';dbname=' . self::$dbname;
    }

}
