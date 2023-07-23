<?php

require './app/Autoloader.php';

app\Autoloader::register();
session_start();

use app\table\Evenement;
use app\table\Utilisateur;

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
        <link rel="shortcut icon" type="images/png" href="assets/img/icon.png">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

        <!-- Css Styles -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="assets/css/elegant-icons.css" type="text/css">
        <link rel="stylesheet" href="assets/css/flaticon.css" type="text/css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css" type="text/css">
        <link rel="stylesheet" href="assets/css/nice-select.css" type="text/css">
        <link rel="stylesheet" href="assets/css/jquery-ui.min.css" type="text/css">
        <link rel="stylesheet" href="assets/css/magnific-popup.css" type="text/css">
        <link rel="stylesheet" href="assets/css/slicknav.min.css" type="text/css">
        <link rel="stylesheet" href="assets/css/style.css" type="text/css">

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
                <a href="./">
                    <img src="assets/img/logo.png" alt="logo" width="100">
                </a>
            </div>
            <div class="header-configure-area">
                <a href="./booking" class="bk-btn">Réserver la salle</a>
            </div>
            <nav class="mainmenu mobile-menu">
                <ul>
                    <li class="active"><a href="./">Accueil</a></li>
                    <li><a href="./about">A propos</a></li>
                    <li><a href="./booking">Réserver</a></li>
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>

<?php
if (isset($_SESSION['id'])) {
    $utilisateurEnCours = Utilisateur::trouverParId($_SESSION['id']);
?>
            <div class="dropdown mt-4 search-switch">
                <a href="#" role="button" class="btn dropdown-toggle" id="menuProfil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?= $utilisateurEnCours->avatar_url != null ? $utilisateurEnCours->avatar_url : 'assets/img/user.png' ?>" alt="" width="40" class="photo-profil rounded-circle mr-2">
                    <span class="d-inline-block align-middle text-dark"><?= $utilisateurEnCours->prenom ?></span>
                </a>

                <div class="dropdown-menu" aria-labelledby="#menuProfil">
                    <a class="dropdown-item" href="./account">Mon compte</a>
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
                                    <img src="assets/img/logo.png" alt="" width="80">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="nav-menu">
                                <nav class="mainmenu">
                                    <ul>
                                        <li class="active"><a href="./">Accueil</a></li>
                                        <li><a href="./about">A propos</a></li>
                                        <li><a href="./booking">Réserver</a></li>
                                    </ul>
                                </nav>

<?php
if (isset($_SESSION['id'])) {
    $utilisateurEnCours = Utilisateur::trouverParId($_SESSION['id']);
?>
                                <div class="dropdown nav-right search-switch">
                                    <a href="#" role="button" class="btn py-0 dropdown-toggle" id="menuProfil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="<?= $utilisateurEnCours->avatar_url != null ? $utilisateurEnCours->avatar_url : 'assets/img/user.png' ?>" alt="" width="40" class="photo-profil rounded-circle mr-2">
                                        <span class="d-inline-block align-middle text-dark"><?= $utilisateurEnCours->prenom ?></span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="#menuProfil">
                                        <a class="dropdown-item" href="./account">Mon compte</a>
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

        <!-- Hero Section Begin -->
        <section class="hero-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="hero-text">
                            <h1>Salle <span class="text-warning">Oasis</span></h1>
                            <p style="font-size: 1.3rem;">Location pour les fêtes, les funérailles, les conférences et autres événements.</p>
                            <a href="#" class="primary-btn">Réserver la salle</a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
                        <div class="booking-form">
                            <h3 class="text-center">Se connecter</h3>
                            <form action="./operations/connexion.php">
                                <div class="check-date">
                                    <label for="login_email" class="sr-only">E-mail :</label>
                                    <input type="text" name="login_email" id="login_email" placeholder="E-mail" style="text-transform: inherit!important;">
                                    <i class="icon_profile"></i>
                                </div>

                                <div class="check-date">
                                    <label for="login_password" class="sr-only">Mot de passe :</label>
                                    <input type="password" name="login_password" id="login_password" placeholder="Mot de passe" style="text-transform: inherit!important;">
                                    <i class="icon_lock-open_alt"></i>
                                </div>

                                <button type="submit">Connexion</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-slider owl-carousel">
                <div class="hs-item set-bg" data-setbg="assets/img/hero/hero-2.jpg"></div>
                <div class="hs-item set-bg" data-setbg="assets/img/hero/hero-3.jpg"></div>
            </div>
        </section>
        <!-- Hero Section End -->

        <!-- About Us Page Section Begin -->
        <section class="aboutus-page-section spad py-5">
            <div class="container">
                <div class="about-page-text">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="ap-title">
                                <h2 class="mb-4">Bienvenue</h2>
                                <p>La salle polyvalente Oasis oeuvre dans le service commercial avec comme but d'aider la population surtout ceux qui n'ont pas assez d'espace avec leur espace à bien faire leurs activités.</p>
                            </div>
                        </div>
                        <div class="col-lg-5 offset-lg-1">
                            <ul class="ap-services">
<?php
foreach ($listeEvenements as $evenement):
?>
                                <li><i class="icon_check"></i> <?= $evenement->nom_evenement ?></li>
<?php
endforeach;
?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Us Page Section End -->

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
        <script src="assets/js/jquery-3.3.1.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.magnific-popup.min.js"></script>
        <script src="assets/js/jquery.nice-select.min.js"></script>
        <script src="assets/js/jquery-ui.min.js"></script>
        <script src="assets/js/jquery.slicknav.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>