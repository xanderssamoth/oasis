<?php

require '../app/Autoloader.php';

app\Autoloader::register();

if (!isset($_SESSION['id'])) {
    header('Location: ../');

}

use app\table\Evenement;
use app\table\Role;
use app\table\Utilisateur;

$racineDossier = '/webapp/oasis/admin';
$utilisateurEnCours = Utilisateur::trouverAvecRoleEtEtat($_SESSION['id']);

if ($utilisateurEnCours[0]->nom_rol != 'Administrateur') {
    header('Location: ../');
}

$compterRole = Role::compterTout();
$listeEvenements = Evenement::trouverTout();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Sona Template">
        <meta name="keywords" content="Sona, unica, creative, html">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Favicon -->
        <link rel="shortcut icon" type="images/png" href="../assets/img/icon.png">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

        <!-- Css Styles -->
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/elegant-icons.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/flaticon.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/owl.carousel.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/nice-select.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/jquery-ui.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/magnific-popup.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/slicknav.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

        <title>
<?php
if ($_SERVER['PHP_SELF'] == $racineDossier . '/role.php') {
?>
            Rôle
<?php
}

if ($_SERVER['PHP_SELF'] == $racineDossier . '/status.php') {
?>
            Etat
<?php
}

if ($_SERVER['PHP_SELF'] == $racineDossier . '/event.php') {
?>
            Evénement
<?php
}

if ($_SERVER['PHP_SELF'] == $racineDossier . '/event.php') {
?>
            Réservations des clients
<?php
}
?>
        </title>
    </head>

    <body>
        <!-- Page Preloder -->
        <div id="preloder">
            <div class="loader"></div>
        </div>

        <!-- Offcanvas Menu Section Begin -->
        <div class="offcanvas-menu-overlay"></div>
        <div class="canvas-open">
            <i class="icon_menu"></i>
        </div>
        <div class="offcanvas-menu-wrapper">
            <div class="canvas-close mb-5">
                <i class="icon_close"></i>
            </div>
            <div class="text-center mb-4">
                <a href="../">
                    <img src="../assets/img/logo.png" alt="logo" width="100">
                </a>
            </div>
            <div class="header-configure-area">
            </div>
            <nav class="mainmenu mobile-menu">
                <ul>
                    <li><a href="./">Tableau de bord</a></li>
                    <li class="<?= $_SERVER['PHP_SELF'] == $racineDossier . '/role.php' ? 'active' : '' ?>"><a href="./role">Rôle</a></li>
                    <li class="<?= $_SERVER['PHP_SELF'] == $racineDossier . '/status.php' ? 'active' : '' ?>"><a href="./status">Etat</a></li>
                    <li class="<?= $_SERVER['PHP_SELF'] == $racineDossier . '/event.php' ? 'active' : '' ?>"><a href="./event">Evénement</a></li>
                    <li class="<?= $_SERVER['PHP_SELF'] == $racineDossier . '/bookings.php' ? 'active' : '' ?>"><a href="./bookings">Réservations</a></li>
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>

            <div class="dropdown mt-4 search-switch">
                <a href="#" role="button" class="btn dropdown-toggle" id="menuProfil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?= $utilisateurEnCours[0]->profil_util != null ? $utilisateurEnCours[0]->profil_util : '../assets/img/user.png' ?>" alt="" width="40" class="photo-profil rounded-circle mr-2">
                    <span class="d-inline-block align-middle text-dark"><?= $utilisateurEnCours[0]->prenom_util ?></span>
                </a>

                <div class="dropdown-menu" aria-labelledby="#menuProfil">
                    <a class="dropdown-item" href="../account">Mon compte</a>
                    <a class="dropdown-item" href="../">Espace public</a>
                    <a class="dropdown-item" href="../operations/deconnexion.php">Déconnexion</a>
                </div>
            </div>
        </div>
        <!-- Offcanvas Menu Section End -->

        <!-- Header Section Begin -->
        <header class="header-section header-normal">
            <div class="menu-item">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="logo">
                                <a href="./">
                                    <img src="../assets/img/logo.png" alt="" width="80">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="nav-menu">
                                <nav class="mainmenu">
                                    <ul>
                                        <li><a href="./">Tableau de bord</a></li>
                                        <li class="<?= $_SERVER['PHP_SELF'] == $racineDossier . '/role.php' ? 'active' : '' ?>"><a href="./role">Rôle</a></li>
                                        <li class="<?= $_SERVER['PHP_SELF'] == $racineDossier . '/status.php' ? 'active' : '' ?>"><a href="./status">Etat</a></li>
                                        <li class="<?= $_SERVER['PHP_SELF'] == $racineDossier . '/event.php' ? 'active' : '' ?>"><a href="./event">Evénement</a></li>
                                        <li class="<?= $_SERVER['PHP_SELF'] == $racineDossier . '/bookings.php' ? 'active' : '' ?>"><a href="./bookings">Réservations</a></li>
                                    </ul>
                                </nav>

                                <div class="dropdown nav-right search-switch">
                                    <a href="#" role="button" class="btn py-0 dropdown-toggle" id="menuProfil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="<?= $utilisateurEnCours[0]->profil_util != null ? $utilisateurEnCours[0]->profil_util : '../assets/img/user.png' ?>" alt="" width="40" class="photo-profil rounded-circle mr-2">
                                        <span class="d-inline-block align-middle text-dark"><?= $utilisateurEnCours[0]->prenom_util ?></span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="#menuProfil">
                                        <a class="dropdown-item" href="../account">Mon compte</a>
                                        <a class="dropdown-item" href="../">Espace public</a>
                                        <a class="dropdown-item" href="../operations/deconnexion.php">Déconnexion</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header End -->

<?php
if (isset($_SESSION['reussi'])) {
?>
        <!-- Alert Begin -->
        <div class="container position-relative">
            <div class="row position-absolute w-100" style="top: -20px; z-index: 999;">
                <div class="col-lg-5 col-sm-7 col-11 mx-auto">
                    <div class="alert alert-success alert-dismissible fade show px-2 py-4 text-center" role="alert">
                        <i class="fa fa-info-circle mr-2"></i><?= $_SESSION['reussi'] ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Alert End -->
<?php
}

if (isset($_SESSION['erreur'])) {
?>
        <!-- Alert Begin -->
        <div class="container position-relative">
            <div class="row position-absolute w-100" style="top: -20px; z-index: 999;">
                <div class="col-lg-5 col-sm-7 col-11 mx-auto">
                    <div class="alert alert-danger alert-dismissible fade show px-2 py-4 text-center" role="alert">
                        <i class="fa fa-exclamation-triangle mr-2"></i><?= $_SESSION['erreur'] ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Alert End -->
<?php
}
?>

