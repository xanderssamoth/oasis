<?php

namespace app\table;

use \app\App;

/**
 * La classe Table contient toutes les méthodes 
 * de gestion des tables de la base des données
 *
 * @author Ketsia
 */
class Table {

    protected static $table;

    private static function getTable() {
        if (static::$table === NULL) {
            $class_name = explode('\\', get_called_class());
            static::$table = strtolower(end($class_name));
        }
        return static::$table;
    }

    public static function compterTout() {
        return App::getDb()->mQuery('SELECT COUNT(*) FROM ' . static::$table, get_called_class());
    }

    public static function trouverTout() {
        return App::getDb()->mQuery('SELECT * FROM ' . static::$table, get_called_class());
    }

    public static function trouverParId($id) {
        return App::getDb()->mPrepare('SELECT * FROM ' . static::$table . ' WHERE id = ?', [$id], get_called_class());
    }

    public static function supprimer($id) {
        return App::getDb()->mDelete('DELETE FROM ' . static::$table . ' WHERE id = ?', [$id], get_called_class());
    }

    public static function query($statement, $attributes = NULL, $one = false) {
        if ($attributes) {
            return App::getDb()->mPrepare($statement, $attributes, get_called_class(), $one);
        } else {
            return App::getDb()->mQuery($statement, get_called_class(), $one);
        }
    }

    public function __get($key) {
        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method;

        return $this->$key;
    }
}
