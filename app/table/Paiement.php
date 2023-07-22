<?php

namespace app\table;

use app\App;
use app\table\Table;

/**
 * La classe Paiement permet de gérer la table "paiements"
 * de la base des donées
 *
 * @author Ketsia
 */
class Paiement extends Table {

    protected static $table = 'paiements';

    // Enregistrer un paiement
    public static function creer($reference, $referenceFournisseur, $numeroCommande, $montant, $montantClient, $monnaie, $canal, $idUtilisateur, $idReservation, $idEtat) {
        return App::getDb()->mInsert('INSERT INTO paiements (reference, reference_fournisseur, numero_commande, montant, montant_client, monnaie, canal, id_utilisateur, id_reservation, id_etat) '
                        . 'VALUES (:reference, :reference_fournisseur, :numero_commande, :montant, :montant_client, :monnaie, :canal, :id_utilisateur, :id_reservation, :id_etat);', 
                        array('reference' => $reference, 'reference_fournisseur' => $referenceFournisseur, 'numero_commande' => $numeroCommande, 'montant' => $montant, 'montant_client' => $montantClient, 'monnaie' => $monnaie, 'canal' => $canal, 'id_utilisateur' => $idUtilisateur, 'id_reservation' => $idReservation, 'id_etat' => $idEtat), __CLASS__);
    }

    // Modifier un paiement
    public static function modifier($reference, $referenceFournisseur, $numeroCommande, $montant, $montantClient, $monnaie, $canal, $idUtilisateur, $idReservation, $idEtat, $idPaiement) {
        return App::getDb()->mInsert('UPDATE paiements SET reference = :reference, reference_fournisseur = :reference_fournisseur, numero_commande = :numero_commande, montant = :montant, montant_client = :montant_client, monnaie = :monnaie, canal = :canal, id_utilisateur = :id_utilisateur, id_reservation = :id_reservation, id_etat = :id_etat, modifiee_a = NOW() WHERE paiements.id = :id', 
                        array('reference' => $reference, 'reference_fournisseur' => $referenceFournisseur, 'numero_commande' => $numeroCommande, 'montant' => $montant, 'montant_client' => $montantClient, 'monnaie' => $monnaie, 'canal' => $canal, 'id_utilisateur' => $idUtilisateur, 'id_reservation' => $idReservation, 'id_etat' => $idEtat, 'id' => $idPaiement), __CLASS__);
    }

    // Modifier l'état du paiement
    public static function changerEtat($idEtat, $idPaiement) {
        return App::getDb()->mInsert('UPDATE paiements SET id_etat = :id_etat, modifiee_a = NOW() WHERE paiements.id = :id', array('id_etat' => $idEtat, 'id' => $idPaiement), __CLASS__);
    }

    // Trouver tous les paiements avec infos détaillés
    public static function trouverToutesAvecDetails() {
        return self::query('SELECT paiements.id id_paiem, paiements.reference ref_paiem, paiements.reference_fournisseur refFournis_paiem, paiements.numero_commande numComm_paiem, '
                        . 'paiements.montant montan_paiem, paiements.montant_client montanClien_paiem, paiements.monnaie monnaie_paiem, paiements.canal canal_paiem, paiements.creee_a creeeA_paiem, '
                        . 'paiements.modifiee_a modifieeA_paiem, paiements.id_utilisateur idUtil_paiem, paiements.id_reservation idReserv_paiem, paiements.id_etat idEtat_paiem, '
                        . 'reservations.id id_reserv, reservations.id_utilisateur idUtil_reserv, reservations.id_evenement idEven_reserv, reservations.date date_reserv, '
                        . 'reservations.email email_reserv, reservations.telephone telephone_reserv, reservations.sexe sexe_reserv, reservations.date_de_naissance dateDeNaissance_reserv, '
                        . 'reservations.heure_debut heureDebut_reserv, reservations.heure_fin heureFin_reserv, reservations.creee_a creeeA_reserv, reservations.modifiee_a modifieeA_reserv, '
                        . 'reservations.id_etat idEtat_reserv, utilisateurs.id id_util, utilisateurs.prenom prenom_util, utilisateurs.nom nom_util, utilisateurs.post_nom postnom_util, '
                        . 'utilisateurs.email email_util, utilisateurs.telephone telephone_util, utilisateurs.sexe sexe_util, utilisateurs.date_de_naissance dateDeNaissance_util, '
                        . 'utilisateurs.avatar_url profil_util, utilisateurs.creee_a creeeA_util, utilisateurs.modifiee_a modifieeA_util, utilisateurs.id_role idRole_util, utilisateurs.id_etat idEtat_util, '
                        . 'etats.id id_eta, etats.nom_etat nom_eta, etats.description_etat descript_eta, etats.creee_a creeeA_eta, etats.modifiee_a modifieeA_eta '
                        . 'FROM paiements, utilisateurs, reservations, etats '
                        . 'WHERE paiements.id_utilisateur = utilisateurs.id AND paiements.id_reservation = reservations.id AND paiements.id_etat = etats.id');
    }

    // Trouver un paiement avec infos détaillés
    public static function trouverToutesAvecDetailsParIdUtilisateur($idUtilisateur) {
        return self::query('SELECT paiements.id id_paiem, paiements.reference ref_paiem, paiements.reference_fournisseur refFournis_paiem, paiements.numero_commande numComm_paiem, '
                        . 'paiements.montant montan_paiem, paiements.montant_client montanClien_paiem, paiements.monnaie monnaie_paiem, paiements.canal canal_paiem, paiements.creee_a creeeA_paiem, '
                        . 'paiements.modifiee_a modifieeA_paiem, paiements.id_utilisateur idUtil_paiem, paiements.id_reservation idReserv_paiem, paiements.id_etat idEtat_paiem, '
                        . 'reservations.id id_reserv, reservations.id_utilisateur idUtil_reserv, reservations.id_evenement idEven_reserv, reservations.date date_reserv, '
                        . 'reservations.email email_reserv, reservations.telephone telephone_reserv, reservations.sexe sexe_reserv, reservations.date_de_naissance dateDeNaissance_reserv, '
                        . 'reservations.heure_debut heureDebut_reserv, reservations.heure_fin heureFin_reserv, reservations.creee_a creeeA_reserv, reservations.modifiee_a modifieeA_reserv, '
                        . 'reservations.id_etat idEtat_reserv, utilisateurs.id id_util, utilisateurs.prenom prenom_util, utilisateurs.nom nom_util, utilisateurs.post_nom postnom_util, '
                        . 'utilisateurs.email email_util, utilisateurs.telephone telephone_util, utilisateurs.sexe sexe_util, utilisateurs.date_de_naissance dateDeNaissance_util, '
                        . 'utilisateurs.avatar_url profil_util, utilisateurs.creee_a creeeA_util, utilisateurs.modifiee_a modifieeA_util, utilisateurs.id_role idRole_util, utilisateurs.id_etat idEtat_util, '
                        . 'etats.id id_eta, etats.nom_etat nom_eta, etats.description_etat descript_eta, etats.creee_a creeeA_eta, etats.modifiee_a modifieeA_eta '
                        . 'FROM paiements, utilisateurs, reservations, etats '
                        . 'WHERE paiements.id_utilisateur = utilisateurs.id AND paiements.id_reservation = reservations.id AND paiements.id_etat = etats.id AND utilisateurs.id = ?', [$idUtilisateur]);
    }
}
