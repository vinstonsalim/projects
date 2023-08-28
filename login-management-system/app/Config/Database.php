<?php

namespace VinstonSalim\Learning\PHP\MVC\Config;

# Singleton class for database, connection will be generated once, this connection is reusable
class Database
{
    private static ?\PDO $pdo = null;

    public static function getConnection(string $env = "test"): \PDO {
        if(!(self::$pdo)) {
            require_once __DIR__ . "/../../config/database.php" ;
            $config = getDatabaseConfig();
            self::$pdo = new \PDO(
                $config['database'][$env]['url'],
                $config['database'][$env]['username'],
                $config['database'][$env]['password']
            );
        }

        return self::$pdo;
    }
}