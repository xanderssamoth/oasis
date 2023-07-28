<?php

require '../app/Autoloader.php';

app\Autoloader::register();

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../');
}

use app\table\Evenement;
use app\table\Role;
use app\table\Utilisateur;

$utilisateurEnCours = Utilisateur::trouverAvecRoleEtEtat($_SESSION['id']);
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

        <title>Oasis | Accueil</title>
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
<?php
if (isset($_SESSION['id'])) {
?>
                <a href="../" class="bk-btn">Réserver la salle</a>
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
                    <li class="active"><a href="../">Accueil</a></li>
                    <li><a href="../about">A propos</a></li>
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>

            <div class="dropdown mt-4 search-switch">
                <a href="#" role="button" class="btn dropdown-toggle" id="menuProfil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?= $utilisateurEnCours[0]->profil_util != null ? $utilisateurEnCours[0]->profil_util : 'assets/img/user.png' ?>" alt="" width="40" class="photo-profil rounded-circle mr-2">
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
                                        <li class="active"><a href="../">Tableau de bord</a></li>
                                        <li><a href="./role">Role</a></li>
                                        <li><a href="./status">Etat</a></li>
                                        <li><a href="./event">Evénement</a></li>
                                        <li><a href="./bookings">Réservations</a></li>
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

        <!-- Dashboard Section Begin -->
        <section class="aboutus-page-section spad pt-5 pb-0">
            <div class="container">
                <div class="about-page-text">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="view">
                                <img src="../assets/img/admin-illustration.png" alt="admin-illustration" class="img-fluid">
                                <div class="mask"></div>
                            </div>
                            <div class="ap-title">
                                <h2 class="mb-4">Administration</h2>
                                <p class="mb-0">Espace de gestion des rôles, des états, des événements et des réservations de clients.</p>
                            </div>
                        </div>

                        <div class="col-sm-6 d-inline-flex align-items-center">
                            <div class="w-100">
                                <a href="./role" class="btn btn-block btn-dark mb-2 pl-5 py-3 z-depth-0 text-left">
                                    <i class="fa fa-chevron-right mr-2"></i> Gérer des rôles
                                </a>
                                <a href="./status" class="btn btn-block btn-dark mb-2 pl-5 py-3 z-depth-0 text-left">
                                    <i class="fa fa-chevron-right mr-2"></i> Gérer des états
                                </a>
                                <a href="./event" class="btn btn-block btn-dark mb-2 pl-5 py-3 z-depth-0 text-left">
                                    <i class="fa fa-chevron-right mr-2"></i> Gérer des événements
                                </a>
                                <a href="./bookings" class="btn btn-block btn-primary mb-2 pl-5 py-3 z-depth-0 text-left">
                                    <i class="fa fa-chevron-right mr-2"></i> Gérer des réservations
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Dashboard Section End -->

        <!-- Footer Section Begin -->
        <footer class="footer-section">
            <div class="copyright-option">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="co-text text-center">
                                <p class="mb-0">
                                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> Tous droits réservés
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Section End -->

        <!-- Js Plugins -->
        <script src="../assets/js/jquery-3.3.1.min.js"></script>
        <script src="../assets/js/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.magnific-popup.min.js"></script>
        <script src="../assets/js/jquery.nice-select.min.js"></script>
        <script src="../assets/js/jquery-ui.min.js"></script>
        <script src="../assets/js/jquery.slicknav.js"></script>
        <script src="../assets/js/owl.carousel.min.js"></script>
        <script src="../assets/js/main.js"></script>
    </body>
</html>
<?php
if (isset($_SESSION['reussi'])) {
    unset($_SESSION['reussi']);
}
if (isset($_SESSION['erreur'])) {
    unset($_SESSION['erreur']);
}
?>