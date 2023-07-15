<?php

namespace app;

use \PDO;

/**
 * La classe Database permet de connecter l'application à la base des données
 *
 * @author Ketsia
 */
class Database {

    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $pdo;

    public function __construct($db_name, $db_user = 'root', $db_pass = '', $db_host = 'localhost') {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
    }

    public function getPDO() {
        if ($this->pdo === NULL) {
            //La classe PDO permet de connecter à la DB
            $pdo = new \PDO('mysql:dbname=oasis;host=localhost', 'root', '');
            //La méthode setAttribute permet d'afficher les erreurs de la DB sur la page
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }

        return $this->pdo;
    }

    public function mQuery($statement, $class_name, $one = false) {
        $req = $this->getPDO()->query($statement);
        $req->setFetchMode(PDO::FETCH_CLASS, $class_name);

        if ($one) {
            $datas = $req->fetch();
        } else {
            $datas = $req->fetchAll();
        }

        return $datas;
    }

    public function mPrepare($statement, $attributes, $class_name, $one = false) {
        //On prepare la requête
        $req = $this->getPDO()->prepare($statement);
        //On exécute la requête
        $req->execute($attributes);

        //On vérifie s'il y a une seule ou plusieurs données avant d'afficher
        $req->setFetchMode(PDO::FETCH_CLASS, $class_name);

        if ($one) {
            $datas = $req->fetch();
        } else {
            $datas = $req->fetchAll();
        }

        return $datas;
    }

    public function mInsert($statement, $attributes, $class_name) {
        //On prepare la requête
        $req = $this->getPDO()->prepare($statement);
        //On exécute la requête
        $req->execute($attributes);
        //On vérifie s'il y a une seule ou plusieurs données avant d'afficher
        $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
    }

    public function mDelete($statement, $attributes, $class_name) {
        //On prepare la requête
        $req = $this->getPDO()->prepare($statement);
        //On exécute la requête
        $req->execute($attributes);
        //On vérifie s'il y a une seule ou plusieurs données avant d'afficher
        $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
    }

    public function mInsertReturnID($statement, $attributes) {
        //Utiliser l'erreur PDO en tant qu'exception
        $this->getPDO()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $req = $this->getPDO()->prepare($statement);

        $req->execute($attributes);

        return $this->getPDO()->lastInsertId();
    }
}
