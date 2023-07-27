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
    public static function creer($nom, $description) {
        $nouvel_id = App::getDb()->mInsertReturnID('INSERT INTO roles (nom_role, description_role) VALUES (:nom_role, :description_role);', 
                        array('nom_role' => $nom, 'description_role' => $description), __CLASS__);
        $role = self::trouverParId($nouvel_id);

        return $role;
    }

    // Modifier un rôle
    public static function modifier($nom, $description, $id) {
        return App::getDb()->mInsert('UPDATE roles SET nom_role = :nom_role, description_role = :description_role, modifiee_a = NOW() WHERE roles.id = :id', 
                        array('nom_role' => $nom, 'description_role' => $description, 'id' => $id), __CLASS__);
    }
}
