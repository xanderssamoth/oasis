<?php

namespace app\table;

use app\App;
use app\table\Table;

/**
 * La classe Utilisateur permet de gérer la table "utilisateurs"
 * de la base des donées
 *
 * @author Ketsia
 */
class Utilisateur extends Table {

    protected static $table = 'utilisateurs';

    // Enregistrer un utilisateur
    public static function creer($prenom, $nom, $postNom, $email, $telephone, $sexe, $dateDeNaissance, $motDePasse, $idRole, $idEtat) {
        $nouvel_id = App::getDb()->mInsertReturnID('INSERT INTO utilisateurs (prenom, nom, post_nom, email, telephone, sexe, date_de_naissance, mot_de_passe, id_role, id_etat) '
                        . 'VALUES (:prenom, :nom, :post_nom, :email, :telephone, :sexe, :date_de_naissance, :mot_de_passe, :id_role, :id_etat);', 
                        array('prenom' => $prenom, 'nom' => $nom, 'post_nom' => $postNom, 'email' => $email, 'telephone' => $telephone, 'sexe' => $sexe, 'date_de_naissance' => $dateDeNaissance, 'mot_de_passe' => $motDePasse, 'id_role' => $idRole, 'id_etat' => $idEtat), __CLASS__);
        $utilisateur = self::trouverParId($nouvel_id);

        return $utilisateur;
    }

    // Modifier un utilisateur
    public static function modifier($prenom, $nom, $postNom, $email, $telephone, $sexe, $dateDeNaissance, $idUtilisateur) {
        return App::getDb()->mInsert('UPDATE utilisateurs SET prenom = :prenom, nom = :nom, post_nom = :post_nom, email = :email, telephone = :telephone, sexe = :sexe, date_de_naissance = :date_de_naissance, modifiee_a = NOW() WHERE utilisateurs.id = :id', 
                        array('prenom' => $prenom, 'nom' => $nom, 'post_nom' => $postNom, 'email' => $email, 'telephone' => $telephone, 'sexe' => $sexe, 'date_de_naissance' => $dateDeNaissance, 'id' => $idUtilisateur), __CLASS__);
    }

    // Modifier l'URL de la photo de profil
    public static function changerProfil($avatarURL, $idUtilisateur) {
        return App::getDb()->mInsert('UPDATE utilisateurs SET avatar_url = :avatar_url, modifiee_a = NOW() WHERE utilisateurs.id = :id', array('avatar_url' => $avatarURL, 'id' => $idUtilisateur), __CLASS__);
    }

    // Modifier le rôle de l'utilisateur
    public static function changerRole($idRole, $idUtilisateur) {
        return App::getDb()->mInsert('UPDATE utilisateurs SET id_role = :id_role, modifiee_a = NOW() WHERE utilisateurs.id = :id', array('id_role' => $idRole, 'id' => $idUtilisateur), __CLASS__);
    }

    // Modifier l'état de l'utilisateur
    public static function changerEtat($idEtat, $idUtilisateur) {
        return App::getDb()->mInsert('UPDATE utilisateurs SET id_etat = :id_etat, modifiee_a = NOW() WHERE utilisateurs.id = :id', array('id_etat' => $idEtat, 'id' => $idUtilisateur), __CLASS__);
    }

    // Modifier le mot de passe d'un utilisateur
    public static function changerMotDePasse($motDePasse, $idUtilisateur) {
        return App::getDb()->mInsert('UPDATE utilisateurs SET mot_de_passe = :mot_de_passe, modifiee_a = NOW() WHERE utilisateurs.id = :id', array('mot_de_passe' => $motDePasse, 'id' => $idUtilisateur), __CLASS__);
    }

    // Trouver un utilisateur par id et mot de passe
    public static function trouverParIdEtMotDePasse($id, $motDePasse) {
        return self::query('SELECT * FROM utilisateurs WHERE id = :id AND mot_de_passe = :mot_de_passe', array('id' => $id, 'mot_de_passe' => $motDePasse));
    }

    // Trouver un utilisateur par e-mail et mot de passe
    public static function trouverParEmailEtMotDePasse($eMail, $motDePasse) {
        return self::query('SELECT * FROM utilisateurs WHERE email = :email AND mot_de_passe = :mot_de_passe', array('email' => $eMail, 'mot_de_passe' => $motDePasse));
    }

    // Trouver un utilisateur par téléphone et mot de passe
    public static function trouverParTelephoneEtMotDePasse($telephone, $motDePasse) {
        return self::query('SELECT * FROM utilisateurs WHERE telephone = :telephone AND mot_de_passe = :mot_de_passe', array('telephone' => $telephone, 'mot_de_passe' => $motDePasse));
    }

    // Trouver un utilisateur avec son rôle et son état
    public static function trouverAvecRoleEtEtat($id) {
        return self::query('SELECT utilisateurs.id id_util, utilisateurs.prenom prenom_util, utilisateurs.nom nom_util, utilisateurs.post_nom postnom_util, '
                        . 'utilisateurs.email email_util, utilisateurs.telephone telephone_util, utilisateurs.sexe sexe_util, utilisateurs.date_de_naissance dateDeNaissance_util, '
                        . 'utilisateurs.avatar_url profil_util, utilisateurs.creee_a creeeA_util, utilisateurs.modifiee_a modifieeA_util, utilisateurs.id_role idRole_util, utilisateurs.id_etat idEtat_util, '
                        . 'roles.id id_rol, roles.nom_role nom_rol, roles.description_role descript_rol, roles.creee_a creeeA_rol, roles.modifiee_a modifieeA_rol, '
                        . 'etats.id id_eta, etats.nom_etat nom_eta, etats.description_etat descript_eta, etats.couleur couleur_eta, etats.creee_a creeeA_eta, etats.modifiee_a modifieeA_eta '
                        . 'FROM utilisateurs '
                        . 'INNER JOIN roles '
                        . 'INNER JOIN etats '
                        . 'ON utilisateurs.id_role = roles.id AND utilisateurs.id_etat = etats.id AND utilisateurs.id = ?', [$id]);
    }
}
