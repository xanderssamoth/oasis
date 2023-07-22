<?php

namespace app\table;

use app\App;
use app\table\Table;

/**
 * La classe Evenement permet de gérer la table "evenements"
 * de la base des donées
 *
 * @author Ketsia
 */
class Evenement extends Table {

    protected static $table = 'evenements';

    // Enregistrer un événement
    public static function creer($nomEvenement, $prixAcompte, $prixTotal, $idEtat) {
        return App::getDb()->mInsert('INSERT INTO evenements (nom_evenement, prix_acompte, prix_total, id_etat) '
                        . 'VALUES (:nom_evenement, :prix_acompte, :prix_total, :id_etat);', 
                        array('nom_evenement' => $nomEvenement, 'prix_acompte' => $prixAcompte, 'prix_total' => $prixTotal, 'id_etat' => $idEtat), __CLASS__);
    }

    // Modifier un événement
    public static function modifier($nomEvenement, $prixAcompte, $prixTotal, $idEtat, $idEvenement) {
        return App::getDb()->mInsert('UPDATE evenements SET nom_evenement = :nom_evenement, prix_acompte = :prix_acompte, prix_total = :prix_total, id_etat = :id_etat, modifiee_a = NOW() WHERE evenements.id = :id', 
                        array('nom_evenement' => $nomEvenement, 'prix_acompte' => $prixAcompte, 'prix_total' => $prixTotal, 'id_etat' => $idEtat, 'id' => $idEvenement), __CLASS__);
    }
}
