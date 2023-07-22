<?php

namespace app\table;

use app\App;
use app\table\Table;

/**
 * La classe Etat permet de gérer la table "etats"
 * de la base des donées
 *
 * @author Ketsia
 */
class Etat extends Table {

    protected static $table = 'etats';

    // Enregistrer un état
    public static function insertIntoEtat($nom, $description) {
        return App::getDb()->mInsert('INSERT INTO etats (nom_etat, description_etat) VALUES (:nom_etat, :description_etat);', 
                        array('nom_etat' => $nom, 'description_etat' => $description), __CLASS__);
    }

    // Modifier un état
    public static function updateEtat($nom, $description, $id) {
        return App::getDb()->mInsert('UPDATE etats SET nom_etat = :nom_etat, description_etat = :description_etat, modifiee_a = NOW() WHERE etats.id = :id', 
                        array('nom_etat' => $nom, 'description_etat' => $description, 'id' => $id), __CLASS__);
    }
}
