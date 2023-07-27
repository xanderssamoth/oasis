<?php

/* 
 * File: ajouter
 * author: Ketsia
 */

use app\table\Etat;
use app\table\Evenement;
use app\table\Role;
use app\table\Utilisateur;

require '../app/Autoloader.php';

app\Autoloader::register();

// ESPACE ADMIN
if (isset($_POST['objet']) && $_POST['objet'] === 'admin') {
    $prenom = $_POST['register_prenom'];
    $nom = $_POST['register_nom'];
    $postNom = $_POST['register_post_nom'];
    $email = $_POST['register_email'];
    $telephone = $_POST['register_telephone'];
    $sexe = $_POST['register_sexe'];
    $dateDeNaissance = explode('/', $_POST['register_date_de_naissance'])[2] . '-' . explode('/', $_POST['register_date_de_naissance'])[1] . explode('/', $_POST['register_date_de_naissance'])[0];
    $motDePasse = sha1($_POST['register_mot_de_passe']);
    $confirmerMotDePasse = $_POST['confirmer_mot_de_passe'];

    if ($_POST['register_mot_de_passe'] != $confirmerMotDePasse) {
        session_start();

        $_SESSION['erreur'] = 'Veuillez confirmer le mote de passe';

        header('Location: ../register');

    } else {
        $etat_active = Etat::creer('Activé', 'Fonctionnement normal dans tous les espaces de l\'application.', 'success');
        $role_admin = Role::creer('Administrateur', 'Gestion des clients, des réservations, des événements et autres.');

        Utilisateur::creer($prenom, $nom, $postNom, $email, $telephone, $sexe, $dateDeNaissance, $role_admin->id, $etat_active->id);

        session_start();

        $_SESSION['reussi'] = 'Inscription réussie';

        header('Location: ../admin/');
    }

} else if (isset($_POST['objet']) && $_POST['objet'] === 'role') {
    $nomRole = $_POST['register_nom_role'];
    $descriptionRole = $_POST['register_description_role'];

    Role::creer($nomRole, $descriptionRole);

    session_start();

    $_SESSION['reussi'] = 'Rôle enregistré';

    header('Location: ../admin/role');

} else if (isset($_POST['objet']) && $_POST['objet'] === 'etat') {
    $nomEtat = $_POST['register_nom_etat'];
    $descriptionEtat = $_POST['register_description_etat'];
    $couleur = $_POST['register_couleur'];

    Etat::creer($nomEtat, $descriptionEtat, $couleur);

    session_start();

    $_SESSION['reussi'] = 'Etat enregistré';

    header('Location: ../admin/etat');

} else if (isset($_POST['objet']) && $_POST['objet'] === 'evenement') {
    $nomEvenement = $_POST['register_nom_evenement'];
    $prixAccompte = $_POST['register_prix_accompte'];
    $prixTotal = $_POST['register_prix_total'];
    $idEtat = $_POST['id_etat'];

    Evenement::creer($nomEvenement, $prixAccompte, $prixTotal, $idEtat);

    session_start();

    $_SESSION['reussi'] = 'Evénement enregistré';

    header('Location: ../admin/evenement');

// ESPACE PUBLIC
} else if (isset($_POST['objet']) && $_POST['objet'] === 'client') {
    $prenom = $_POST['register_prenom'];
    $nom = $_POST['register_nom'];
    $postNom = $_POST['register_post_nom'];
    $email = $_POST['register_email'];
    $telephone = $_POST['register_telephone'];
    $sexe = $_POST['register_sexe'];
    $dateDeNaissance = explode('/', $_POST['register_date_de_naissance'])[2] . '-' . explode('/', $_POST['register_date_de_naissance'])[1] . explode('/', $_POST['register_date_de_naissance'])[0];
    $motDePasse = sha1($_POST['register_mot_de_passe']);
    $confirmerMotDePasse = $_POST['confirmer_mot_de_passe'];
    $idRole = $_POST['id_role'];
    $idEtat = $_POST['id_etat'];

    if ($_POST['register_mot_de_passe'] != $confirmerMotDePasse) {
        session_start();

        $_SESSION['erreur'] = 'Veuillez confirmer le mot de passe';

        header('Location: ../register');

    } else {
        $utilisateurEnCours = Utilisateur::creer($prenom, $nom, $postNom, $email, $telephone, $sexe, $dateDeNaissance, $idRole, $idEtat);

        session_start();

        $_SESSION['id'] = $utilisateurEnCours[0]->id;
        $_SESSION['nom'] = $utilisateurEnCours[0]->nom;
        $_SESSION['postnom'] = $utilisateurEnCours[0]->post_nom;
        $_SESSION['prenom'] = $utilisateurEnCours[0]->prenom;
        $_SESSION['reussi'] = 'Inscription réussie';

        header('Location: ../');
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
        Utilisateur::creer($prenom, $nom, $postNom, $email, $telephone, $sexe, $dateDeNaissance, $idRole, $idEtat);

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
    $image_name = 'C:\\xampp\\htdocs\\img\\oasis\\' . $idUtilisateur . '.png';

    file_put_contents($image_name, $data);

    echo $image_name;
}
