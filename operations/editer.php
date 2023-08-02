<?php

/* 
 * File: ajouter
 * author: Ketsia
 */

use app\table\Etat;
use app\table\Evenement;
use app\table\Reservation;
use app\table\Role;
use app\table\Utilisateur;
use app\Utility;

require '../app/Autoloader.php';
 
app\Autoloader::register();
 
// ESPACE ADMIN
if (isset($_POST['objet']) && $_POST['objet'] === 'role') {
    $idRole = $_POST['id_role'];
    $nomRole = $_POST['register_nom_role'];
    $descriptionRole = $_POST['register_description_role'];

    Role::modifier($nomRole, $descriptionRole, $idRole);

    session_start();

    $_SESSION['reussi'] = 'Rôle modifié';

    header('Location: ../admin/role');

} else if (isset($_POST['objet']) && $_POST['objet'] === 'etat') {
    $idEtat = $_POST['id_etat'];
    $nomEtat = $_POST['register_nom_etat'];
    $descriptionEtat = $_POST['register_description_etat'];
    $couleur = $_POST['register_couleur'];

    Etat::modifier($nomEtat, $descriptionEtat, $couleur, $idEtat);

    session_start();

    $_SESSION['reussi'] = 'Etat modifié';

    header('Location: ../admin/status');

} else if (isset($_POST['objet']) && $_POST['objet'] === 'evenement') {
    $idEvenement = $_POST['id_evenement'];
    $nomEvenement = $_POST['register_nom_evenement'];
    $prixAccompte = $_POST['register_prix_accompte'];
    $prixTotal = $_POST['register_prix_total'];
    $idEtat = $_POST['id_etat'];

    Evenement::modifier($nomEvenement, $prixAccompte, $prixTotal, $idEtat, $idEvenement);

    session_start();

    $_SESSION['reussi'] = 'Evénement modifié';

    header('Location: ../admin/event');

} else if (isset($_POST['objet']) && $_POST['objet'] === 'role_utilisateur') {
    $idUtilisateur = $_POST['id_utilisateur'];
    $idRole = $_POST['id_role'];

    Utilisateur::changerRole($idRole, $idUtilisateur);

    session_start();

    $_SESSION['reussi'] = 'Votre rôle a été changé';

    header('Location: ../admin/role');

} else if (isset($_POST['objet']) && $_POST['objet'] === 'etat_utilisateur') {
    $idUtilisateur = $_POST['id_utilisateur'];
    $idEtat = $_POST['id_etat'];

    Utilisateur::changerEtat($idEtat, $idUtilisateur);

    session_start();

    $_SESSION['reussi'] = 'Votre état a été changé';

    header('Location: ../admin/role');

} else if (isset($_POST['objet']) && $_POST['objet'] === 'etat_evenement') {
    $idEvenement = $_POST['id_evenement'];
    $idEtat = $_POST['id_etat'];

    Evenement::changerEtat($idEtat, $idEvenement);

    session_start();

    $_SESSION['reussi'] = 'Etat de l\'événement changé';

    header('Location: ../admin/event');

} else if (isset($_POST['objet']) && $_POST['objet'] === 'etat_reservation') {
    $idReservation = $_POST['id_reservation'];
    $idEtat = $_POST['id_etat'];
    
    Reservation::changerEtat($idEtat, $idReservation);
    
    session_start();
    
    $_SESSION['reussi'] = 'Etat de la réservation changé';
    $utilisateurEnCours = Utilisateur::trouverAvecRoleEtEtat($_SESSION['id']);

    if ($utilisateurEnCours[0]->nom_rol == 'Administrateur') {
        header('Location: ../admin/bookings');

    } else {
        header('Location: ../bookings');
    }

// ESPACE PUBLIC
} else if (isset($_POST['objet']) && $_POST['objet'] === 'compte') {
    $idUtilisateur = $_POST['id_utilisateur'];
    $prenom = $_POST['register_prenom'];
    $nom = $_POST['register_nom'];
    $postNom = $_POST['register_post_nom'];
    $email = $_POST['register_email'];
    $telephone = $_POST['register_telephone'];
    $sexe = $_POST['register_sexe'];
    $dateDeNaissance = isset($_POST['register_date_de_naissance']) ? explode('/', $_POST['register_date_de_naissance'])[2] . '-' . explode('/', $_POST['register_date_de_naissance'])[1] . '-' . explode('/', $_POST['register_date_de_naissance'])[0] : null;

    Utilisateur::modifier($prenom, $nom, $postNom, $email, $telephone, $sexe, $dateDeNaissance, $idUtilisateur);

    session_start();

    $_SESSION['reussi'] = 'Modification réussie';

    header('Location: ../account');

} else if (isset($_POST['objet']) && $_POST['objet'] === 'mot_de_passe') {
    $idUtilisateur = $_POST['id_utilisateur'];
    $ancienMotDePasse = sha1($_POST['register_ancien_mot_de_passe']);
    $nouveauMotDePasse = sha1($_POST['register_nouveau_mot_de_passe']);
    $confirmerNouveauMotDePasse = $_POST['confirmer_nouveau_mot_de_passe'];
    $verififierAncienMotDePasse = Utilisateur::trouverParIdEtMotDePasse($idUtilisateur, $ancienMotDePasse);

    if (!$verififierAncienMotDePasse) {
        session_start();

        $_SESSION['erreur'] = 'Ancien mot de passe incorrect';

        header('Location: ../account?p=update_password');

    } else {

        if ($_POST['register_nouveau_mot_de_passe'] != $confirmerNouveauMotDePasse) {
            session_start();

            $_SESSION['erreur'] = 'Veuillez confirmer le nouveau mot de passe';

            header('Location: ../account?p=update_password');

        } else {
            Utilisateur::changerMotDePasse($motDePasse, $idUtilisateur);

            session_start();

            $_SESSION['reussi'] = 'Mot de passe modifié';

            header('Location: ../account?p=update_password');
        }
    }

} else if (isset($_POST['objet']) && $_POST['objet'] === 'reservation') {
    $idUtilisateur = $_POST['id_utilisateur'];
    $idEvenement = $_POST['id_evenement'];
    $date = $_POST['register_date'];
    $heureDebut = $_POST['register_heure_debut'];
    $heureFin = $_POST['register_heure_fin'];
    $idEtat = $_POST['id_etat'];

    if ($date == null) {
        session_start();

        $_SESSION['erreur'] = 'Veuillez choisir une date';

        header('Location: ../booking');

    } else if ($heureDebut == null OR $heureDebut == null) {
        session_start();

        $_SESSION['erreur'] = 'Heure de début et de fin obligatoires';

        header('Location: ../booking');

    } else {
        Reservation::creer($idUtilisateur, $idEvenement, $date, $heureDebut, $heureFin, $idEtat);

        session_start();

        $_SESSION['reussi'] = 'Réservation enregistrée';

        header('Location: ../bookings');
    }

} else if (isset($_POST['objet']) && $_POST['objet'] === 'photo') {
    $idUtilisateur = $_POST['id_utilisateur'];
    $data = $_POST['avatar'];
    $image_array_1 = explode(';', $data);
    $image_array_2 = explode(',', $image_array_1[1]);
    $data = base64_decode($image_array_2[1]);
    $image_name = 'C:\\xampp\\htdocs\\img\\oasis\\' . Utility::randomStr() . '.png';

    file_put_contents($image_name, $data);

    $utilisateurEnCours = Utilisateur::trouverParId($idUtilisateur);

    Utilisateur::changerProfil($image_name, $utilisateurEnCours[0]->id);

    return $utilisateurEnCours[0];
}
