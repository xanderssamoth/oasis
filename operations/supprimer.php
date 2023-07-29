<?php

/* 
 * File: supprimer
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
if (isset($_GET['objet']) && $_GET['objet'] === 'role') {
    $idRole = $_GET['id'];

    Role::supprimer($idRole);

    session_start();

    $_SESSION['reussi'] = 'Rôle supprimé';

    header('Location: ../admin/role');

} else if (isset($_GET['objet']) && $_GET['objet'] === 'etat') {
    $idEtat = $_GET['id'];

    Etat::supprimer($idEtat);

    session_start();

    $_SESSION['reussi'] = 'Etat supprimé';

    header('Location: ../admin/status');

} else if (isset($_GET['objet']) && $_GET['objet'] === 'evenement') {
    $idEvenement = $_GET['id'];

    Evenement::supprimer($idEvenement);

    session_start();

    $_SESSION['reussi'] = 'Evénement supprimé';

    header('Location: ../admin/event');

// ESPACE PUBLIC
} else if (isset($_GET['objet']) && $_GET['objet'] === 'reservation') {
    $idReservation = $_GET['id'];

    Reservation::supprimer($idReservation);

    session_start();

    $_SESSION['reussi'] = 'Evénement supprimé';

    header('Location: ../bookings');

} else if (isset($_GET['objet']) && $_GET['objet'] === 'Utilisateur') {
    $idUtilisateur = $_GET['id'];

    Utilisateur::supprimer($idUtilisateur);

    session_start();

    $_SESSION = array();

    session_destroy();
    setcookie('id', '');

    header('Location: ../');
}
