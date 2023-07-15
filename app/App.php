<?php

namespace app;

use app\Database;

/**
 * Information de la base des données
 *
 * @author Ketsia
 */
class App {

    const DB_NAME = 'oasis';
    const DB_USER = 'root';
    const DB_PASSWORD = '';
    const DB_HOST = 'localhost';

    private static $database;

    public static function getDb() {

        if (self::$database === NULL) {
            self::$database = new Database(self::DB_NAME, self::DB_USER, self::DB_PASSWORD, self::DB_HOST);
        }

        return self::$database;
    }
}
