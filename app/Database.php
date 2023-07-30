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

    /**
     * Récuperation de la base des données
     * 
     * @return  \PDO
     */
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

    /**
     * Requête pour récupérer les données
     * 
     * @param  string $statement
     * @param  object $class_name
     * @param  boolean $one
     * 
     * @return  \PDOStatement
     */
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

    /**
     * Requête pour modifier les données
     * 
     * @param  string $statement
     * @param  array $attributes
     * @param  object $class_name
     * @param  boolean $one
     * 
     * @return  \PDOStatement
     */
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

    /**
     * Requête pour enregister les données
     * 
     * @param  string $statement
     * @param  array $attributes
     * @param  object $class_name
     */
    public function mInsert($statement, $attributes, $class_name) {
        //On prepare la requête
        $req = $this->getPDO()->prepare($statement);

        //On exécute la requête
        $req->execute($attributes);
        //On définit le mode de récupération par défaut. Ce sera l'objet en cours
        $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
    }

    /**
     * Requête pour enregister les données et récupérer l'ID de cet enregistrement
     * 
     * @param  string $statement
     * @param  array $attributes
     * @param  object $class_name
     * 
     * @return  \PDO
     */
    public function mInsertReturnID($statement, $attributes, $class_name) {
        //Utiliser l'erreur PDO en tant qu'exception
        $this->getPDO()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //On prepare la requête
        $req = $this->getPDO()->prepare($statement);

        //On exécute la requête
        $req->execute($attributes);
        //On définit le mode de récupération par défaut. Ce sera l'objet en cours
        $req->setFetchMode(PDO::FETCH_CLASS, $class_name);

        return $this->getPDO()->lastInsertId();
    }

    /**
     * Requête pour supprimer les données
     * 
     * @param  string $statement
     * @param  array $attributes
     * @param  object $class_name
     */
    public function mDelete($statement, $attributes, $class_name) {
        //On prepare la requête
        $req = $this->getPDO()->prepare($statement);

        //On exécute la requête
        $req->execute($attributes);
        //On définit le mode de récupération par défaut. Ce sera l'objet en cours
        $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
    }
}
