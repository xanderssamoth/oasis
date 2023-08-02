<?php

require '../app/Autoloader.php';

app\Autoloader::register();

use app\table\Evenement;
use app\table\Utilisateur;

$racineDossier = '/oasis/public';
$compterEvenement = Evenement::compterTout();
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
        <link rel="shortcut icon" type="images/png" href="./assets/img/icon.png">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

        <!-- Css Styles -->
        <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/elegant-icons.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/flaticon.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/owl.carousel.min.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/nice-select.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/jquery-ui.min.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/jquery.timepicker.min.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/magnific-popup.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/slicknav.min.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/cropper.min.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/sweetalert2.min.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/style.css">

        <style>
            .booking-form input {text-transform: inherit!important;}
        </style>

        <title>
            Oasis | 
<?php
if ($_SERVER['PHP_SELF'] == $racineDossier . '/register.php') {
?>
            Inscription
<?php
}

if ($_SERVER['PHP_SELF'] == $racineDossier . '/account.php') {
?>
            Profil
<?php
}

if ($_SERVER['PHP_SELF'] == $racineDossier . '/booking.php') {
?>
            Réserver
<?php
}

if ($_SERVER['PHP_SELF'] == $racineDossier . '/bookings.php') {
?>
            Mes réservations
<?php
}
?>

        </title>
    </head>

    <body>
        <!-- Modal crop image -->
        <div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cropModalLabel">Recadrer avant d'enregistrer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 mb-sm-0 mb-4">
                                    <div class="bg-image">
                                        <img src="" id="retrieved_image" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <input type="hidden" name="id_utilisateur" id="id_utilisateur" value="<?= $_SESSION['id'] ?>">
                        <button type="button" class="btn btn-light border border-default shadow-0" data-dismiss="modal">Annuler</button>
                        <button type="button" id="crop" class="btn btn-primary shadow-0">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>

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
                <a href="./">
                    <img src="./assets/img/logo.png" alt="logo" width="100">
                </a>
            </div>
            <div class="header-configure-area">
<?php
if (isset($_SESSION['id'])) {
?>
                <a href="./booking" class="bk-btn">Réserver la salle</a>
<?php
} else {
?>
                <a href="javascript:return false;" class="bk-btn" onclick="document.querySelector('.offcanvas-menu-wrapper').classList.remove('show-offcanvas-menu-wrapper'); document.querySelector('.offcanvas-menu-overlay').classList.remove('active'); document.getElementById('login_warning').classList.remove('d-none'); document.getElementById('login_email').focus();">Réserver la salle</a>
<?php
}
?>
            </div>
            <nav class="mainmenu mobile-menu">
                <ul>
                    <li class="active"><a href="./">Accueil</a></li>
                    <li><a href="./about">A propos</a></li>
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>

            <?php
if (isset($_SESSION['id'])) {
    $utilisateurEnCours = Utilisateur::trouverAvecRoleEtEtat($_SESSION['id']);
?>
            <div class="dropdown mt-4 search-switch">
                <a href="#" role="button" class="btn dropdown-toggle" id="menuProfil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?= $utilisateurEnCours[0]->profil_util != null ? $utilisateurEnCours[0]->profil_util : 'assets/img/user.png' ?>" alt="" width="40" class="photo-profil rounded-circle mr-2">
                    <span class="d-inline-block align-middle text-dark"><?= $utilisateurEnCours[0]->prenom_util ?></span>
                </a>

                <div class="dropdown-menu" aria-labelledby="#menuProfil">
                    <a class="dropdown-item" href="./account">Mon compte</a>
<?php
    if ($utilisateurEnCours[0]->nom_rol == 'Administrateur') {
?>
                    <a class="dropdown-item" href="./admin/">Administration</a>
<?php
    }
?>
                    <a class="dropdown-item" href="./operations/deconnexion.php">Déconnexion</a>
                </div>
            </div>
<?php
}
?>
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
                                    <img src="./assets/img/logo.png" alt="" width="80">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="nav-menu">
                                <nav class="mainmenu">
                                    <ul>
                                        <li><a href="./">Accueil</a></li>
                                        <li class="<?= $_SERVER['PHP_SELF'] == $racineDossier . '/about.php' ? 'active' : '' ?>"><a href="./about">A propos</a></li>
                                        <li class="<?= $_SERVER['PHP_SELF'] == $racineDossier . '/booking.php' ? 'active' : '' ?>"><a href="./booking">Réserver</a></li>
                                    </ul>
                                </nav>

<?php
if (isset($_SESSION['id'])) {
    $utilisateurEnCours = Utilisateur::trouverAvecRoleEtEtat($_SESSION['id']);
?>
                                <div class="dropdown nav-right search-switch">
                                    <a href="#" role="button" class="btn py-0 dropdown-toggle" id="menuProfil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="<?= $utilisateurEnCours[0]->profil_util != null ? $utilisateurEnCours[0]->profil_util : 'assets/img/user.png' ?>" alt="" width="40" class="photo-profil rounded-circle mr-2">
                                        <span class="d-inline-block align-middle text-dark"><?= $utilisateurEnCours[0]->prenom_util ?></span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="#menuProfil">
                                        <a class="dropdown-item" href="./account">Mon compte</a>
<?php
    if ($utilisateurEnCours[0]->nom_rol == 'Administrateur') {
?>
                                        <a class="dropdown-item" href="./admin/">Administration</a>
<?php
    }
?>
                                        <a class="dropdown-item" href="./operations/deconnexion.php">Déconnexion</a>
                                    </div>
                                </div>
<?php
}
?>
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
