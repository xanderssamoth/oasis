<?php

namespace app\table;

use app\App;
use app\table\Table;

/**
 * La classe Reservation permet de gérer la table "reservations"
 * de la base des donées
 *
 * @author Ketsia
 */
class Reservation extends Table {

    protected static $table = 'reservations';

    // Enregistrer une réservation
    public static function creer($idUtilisateur, $idEvenement, $date, $heureDebut, $heureFin, $idEtat) {
        $nouvel_id = App::getDb()->mInsertReturnID('INSERT INTO reservations (id_utilisateur, id_evenement, date, heure_debut, heure_fin, id_etat) VALUES (:id_utilisateur, :id_evenement, :date, :heure_debut, :heure_fin, :id_etat);', 
                        array('id_utilisateur' => $idUtilisateur, 'id_evenement' => $idEvenement, 'date' => $date, 'heure_debut' => $heureDebut, 'heure_fin' => $heureFin, 'id_etat' => $idEtat), __CLASS__);
        $reservation = self::trouverParId($nouvel_id);

        return $reservation;
    }

    // Modifier une réservation
    public static function modifier($idUtilisateur, $idEvenement, $date, $heureDebut, $heureFin, $idEtat, $idReservation) {
        return App::getDb()->mInsert('UPDATE reservations SET id_utilisateur = :id_utilisateur, id_evenement = :id_evenement, date = :date, heure_debut = :heure_debut, heure_fin = :heure_fin, id_etat = :id_etat, modifiee_a = NOW() WHERE reservations.id = :id', 
                        array('id_utilisateur' => $idUtilisateur, 'id_evenement' => $idEvenement, 'date' => $date, 'heure_debut' => $heureDebut, 'heure_fin' => $heureFin, 'id_etat' => $idEtat, 'id' => $idReservation), __CLASS__);
    }

    // Modifier l'état de la réservation
    public static function changerEtat($idEtat, $idReservation) {
        return App::getDb()->mInsert('UPDATE reservations SET id_etat = :id_etat, modifiee_a = NOW() WHERE reservations.id = :id', array('id_etat' => $idEtat, 'id' => $idReservation), __CLASS__);
    }

    // Trouver toutes les réservations avec infos détaillés
    public static function trouverToutesAvecDetails() {
        return self::query('SELECT reservations.id id_reserv, reservations.id_utilisateur idUtil_reserv, reservations.id_evenement idEven_reserv, reservations.date date_reserv, '
                        . 'reservations.heure_debut heureDebut_reserv, reservations.heure_fin heureFin_reserv, reservations.creee_a creeeA_reserv, reservations.modifiee_a modifieeA_reserv, reservations.id_etat idEtat_reserv, '
                        . 'utilisateurs.id id_util, utilisateurs.prenom prenom_util, utilisateurs.nom nom_util, utilisateurs.post_nom postnom_util, utilisateurs.email email_util, utilisateurs.telephone telephone_util, '
                        . 'utilisateurs.sexe sexe_util, utilisateurs.date_de_naissance dateDeNaissance_util, utilisateurs.avatar_url profil_util, utilisateurs.creee_a creeeA_util, utilisateurs.modifiee_a modifieeA_util, '
                        . 'utilisateurs.id_role idRole_util, utilisateurs.id_etat idEtat_util, evenements.id id_even, evenements.nom_evenement nom_even, evenements.prix_acompte priAcompt_even, evenements.prix_total priTot_even, '
                        . 'evenements.creee_a creeeA_even, evenements.modifiee_a modifieeA_even, evenements.id_etat idEtat_even, '
                        . 'etats.id id_eta, etats.nom_etat nom_eta, etats.description_etat descript_eta, etats.couleur couleur_eta, etats.creee_a creeeA_eta, etats.modifiee_a modifieeA_eta '
                        . 'FROM reservations, utilisateurs, evenements, etats '
                        . 'WHERE reservations.id_utilisateur = utilisateurs.id AND reservations.id_evenement = evenements.id AND reservations.id_etat = etats.id ORDER BY reservations.creee_a DESC');
    }

    // Trouver une réservation avec infos détaillés
    public static function trouverToutesAvecDetailsParIdUtilisateur($idUtilisateur) {
        return self::query('SELECT reservations.id id_reserv, reservations.id_utilisateur idUtil_reserv, reservations.id_evenement idEven_reserv, reservations.date date_reserv, '
                        . 'reservations.heure_debut heureDebut_reserv, reservations.heure_fin heureFin_reserv, reservations.creee_a creeeA_reserv, reservations.modifiee_a modifieeA_reserv, reservations.id_etat idEtat_reserv, '
                        . 'utilisateurs.id id_util, utilisateurs.prenom prenom_util, utilisateurs.nom nom_util, utilisateurs.post_nom postnom_util, utilisateurs.email email_util, utilisateurs.telephone telephone_util, '
                        . 'utilisateurs.sexe sexe_util, utilisateurs.date_de_naissance dateDeNaissance_util, utilisateurs.avatar_url profil_util, utilisateurs.creee_a creeeA_util, utilisateurs.modifiee_a modifieeA_util, '
                        . 'utilisateurs.id_role idRole_util, utilisateurs.id_etat idEtat_util, evenements.id id_even, evenements.nom_evenement nom_even, evenements.prix_acompte priAcompt_even, evenements.prix_total priTot_even, '
                        . 'evenements.creee_a creeeA_even, evenements.modifiee_a modifieeA_even, evenements.id_etat idEtat_even, '
                        . 'etats.id id_eta, etats.nom_etat nom_eta, etats.description_etat descript_eta, etats.couleur couleur_eta, etats.creee_a creeeA_eta, etats.modifiee_a modifieeA_eta '
                        . 'FROM reservations, utilisateurs, evenements, etats '
                        . 'WHERE reservations.id_utilisateur = utilisateurs.id AND reservations.id_evenement = evenements.id AND reservations.id_etat = etats.id AND utilisateurs.id = ? ORDER BY reservations.creee_a DESC', [$idUtilisateur]);
    }
}
