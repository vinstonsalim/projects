<?php

namespace VinstonSalim\Learning\PHP\MVC\Config;

# Singleton class for database, connection will be generated once, this connection is reusable
use PDO;

class Database
{
    private static ?PDO $pdo = null;

    /**
     * @param string $env
     * @return PDO
     */
    public static function getConnection(string $env = "test"): PDO {
        if(!(self::$pdo)) {
            require_once __DIR__ . "/../../config/database.php" ;
            $config = getDatabaseConfig();
            self::$pdo = new PDO(
                $config['database'][$env]['url'],
                $config['database'][$env]['username'],
                $config['database'][$env]['password']
            );
        }

        return self::$pdo;
    }

    /**
     * @return void
     */
    public static function beginTransaction(): void {
        self::$pdo->beginTransaction();
    }

    /**
     * @return void
     */
    public static function commit(): void {
        self::$pdo->commit();
    }

    /**
     * @return void
     */
    public static function rollBack(): void {
        self::$pdo->rollBack();
    }
}