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
    $dateDeNaissance = isset($_POST['register_date_de_naissance']) ? explode('/', $_POST['register_date_de_naissance'])[2] . '-' . explode('/', $_POST['register_date_de_naissance'])[1] . '-' . explode('/', $_POST['register_date_de_naissance'])[0] : null;
    $motDePasse = sha1($_POST['register_mot_de_passe']);
    $confirmerMotDePasse = $_POST['confirmer_mot_de_passe'];

    if ($_POST['register_mot_de_passe'] != $confirmerMotDePasse) {
        session_start();

        $_SESSION['erreur'] = 'Veuillez confirmer le mot de passe';

        header('Location: ../register');

    } else {
        $etat_active = Etat::creer('Activé', 'Fonctionnement normal dans tous les espaces de l\'application.', 'success');
        $role_admin = Role::creer('Administrateur', 'Gestion des clients, des réservations, des événements et autres.');
        $utilisateurEnCours = Utilisateur::creer($prenom, $nom, $postNom, $email, $telephone, $sexe, $dateDeNaissance, $motDePasse, $role_admin[0]->id, $etat_active[0]->id);

        session_start();

        $_SESSION['id'] = $utilisateurEnCours[0]->id;
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

    header('Location: ../admin/status');

} else if (isset($_POST['objet']) && $_POST['objet'] === 'evenement') {
    $nomEvenement = $_POST['register_nom_evenement'];
    $prixAccompte = $_POST['register_prix_accompte'];
    $prixTotal = $_POST['register_prix_total'];
    $idEtat = $_POST['id_etat'];

    Evenement::creer($nomEvenement, $prixAccompte, $prixTotal, $idEtat);

    session_start();

    $_SESSION['reussi'] = 'Evénement enregistré';

    header('Location: ../admin/event');

// ESPACE PUBLIC
} else if (isset($_POST['objet']) && $_POST['objet'] === 'client') {
    $prenom = $_POST['register_prenom'];
    $nom = $_POST['register_nom'];
    $postNom = $_POST['register_post_nom'];
    $email = $_POST['register_email'];
    $telephone = $_POST['register_telephone'];
    $sexe = $_POST['register_sexe'];
    $dateDeNaissance = isset($_POST['register_date_de_naissance']) ? explode('/', $_POST['register_date_de_naissance'])[2] . '-' . explode('/', $_POST['register_date_de_naissance'])[1] . '-' . explode('/', $_POST['register_date_de_naissance'])[0] : null;
    $motDePasse = sha1($_POST['register_mot_de_passe']);
    $confirmerMotDePasse = $_POST['confirmer_mot_de_passe'];

    if ($_POST['register_mot_de_passe'] != $confirmerMotDePasse) {
        session_start();

        $_SESSION['erreur'] = 'Veuillez confirmer le mot de passe';

        header('Location: ../register');

    } else {
        $role_client = Role::trouverParNom('Client');
        $etat_active = Etat::trouverParNom('Activé');
        $utilisateurEnCours = Utilisateur::creer($prenom, $nom, $postNom, $email, $telephone, $sexe, $dateDeNaissance, $motDePasse, $role_client[0]->id, $etat_active[0]->id);

        session_start();

        $_SESSION['id'] = $utilisateurEnCours[0]->id;
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
    // Sélectionner les réservation pour vérifier si l'enregistrement en cours est déjà pris
    $listeReservations = Reservation::trouverTout();

    if ($idEtat == null) {
        session_start();

        $_SESSION['erreur'] = 'Veuillez choisir le mode de paiement';

        header('Location: ../booking');

    } else if ($date == null) {
        session_start();

        $_SESSION['erreur'] = 'Veuillez donner la date de l\'événement';

        header('Location: ../booking');

    } else if ($idEvenement == null) {
        session_start();

        $_SESSION['erreur'] = 'Veuillez choisir un événement';

        header('Location: ../booking');

    } else if ($heureDebut == null OR $heureFin == null) {
        session_start();

        $_SESSION['erreur'] = 'Heure de début et de fin obligatoires';

        header('Location: ../booking');

    } else {
        // Formater la date selon la disposition de la base des données
        $dateFormatee = explode('/', $_POST['register_date'])[2] . '-' . explode('/', $_POST['register_date'])[1] . '-' . explode('/', $_POST['register_date'])[0];

        foreach ($listeReservations as $autre_reservation):
            // Si c'est une date passée, envoyer une erreur
            if (strtotime($dateFormatee) < strtotime(date('Y-m-d'))) {
                session_start();

                $_SESSION['erreur'] = 'Les dates anciennes sont érronées';

                header('Location: ../booking');

            // Si la date existe
            } else if (strtotime($dateFormatee) == strtotime($autre_reservation->date)) {
                // Si l'heure choisi existe déjà
                if ($heureDebut == $autre_reservation->heure_debut OR $heureFin == $autre_reservation->heure_fin) {
                    session_start();

                    $_SESSION['erreur'] = 'Cette heure est déjà choisie';
    
                    header('Location: ../booking');
                }

                // Si l'heure choisi se trouve dans l'intervalle entre une heure de début et de fin, renvoyer une erreur
                if (strtotime($heureDebut) >= strtotime($autre_reservation->heure_debut) AND strtotime($heureFin) <= strtotime($autre_reservation->heure_fin)) {
                    session_start();

                    $_SESSION['erreur'] = 'Veuillez choisir une heure au-delà de ' . $autre_reservation->heure_fin;

                    header('Location: ../booking');
                }

            } else {
                Reservation::creer($idUtilisateur, $idEvenement, $dateFormatee, $heureDebut, $heureFin, $idEtat);

                session_start();

                $_SESSION['reussi'] = 'Réservation enregistrée';

                header('Location: ../bookings');
            }
        endforeach;
    }
}
