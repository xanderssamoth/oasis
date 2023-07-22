<?php

namespace app\table;

use app\App;
use app\table\Table;

/**
 * La classe Role permet de gérer la table "roles"
 * de la base des donées
 *
 * @author Ketsia
 */
class Role extends Table {

    protected static $table = 'roles';

    // Enregistrer un rôle
    public static function insertIntoRole($nom, $description) {
        return App::getDb()->mInsert('INSERT INTO roles (nom_role, description_role) VALUES (:nom_role, :description_role);', 
                        array('nom_role' => $nom, 'description_role' => $description), __CLASS__);
    }

    // Modifier un rôle
    public static function updateRole($nom, $description, $id) {
        return App::getDb()->mInsert('UPDATE roles SET nom_role = :nom_role, description_role = :description_role, modifiee_a = NOW() WHERE roles.id = :id', 
                        array('nom_role' => $nom, 'description_role' => $description, 'id' => $id), __CLASS__);
    }
}
