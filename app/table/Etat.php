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
    public static function insertIntoEtat($nom, $description, $couleur) {
        return App::getDb()->mInsert('INSERT INTO etats (nom_etat, description_etat, couleur) VALUES (:nom_etat, :description_etat, :couleur);', 
                        array('nom_etat' => $nom, 'description_etat' => $description, 'couleur' => $couleur), __CLASS__);
    }

    // Modifier un état
    public static function updateEtat($nom, $description, $couleur, $id) {
        return App::getDb()->mInsert('UPDATE etats SET nom_etat = :nom_etat, description_etat = :description_etat, couleur = :couleur, modifiee_a = NOW() WHERE etats.id = :id', 
                        array('nom_etat' => $nom, 'description_etat' => $description, 'couleur' => $couleur, 'id' => $id), __CLASS__);
    }
}
