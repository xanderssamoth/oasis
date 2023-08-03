<?php

use app\table\Utilisateur;

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ./');
}

require('../templates/public/entete.php');

$utilisateurEnCours = Utilisateur::trouverParId($_SESSION['id']);
?>

        <div class="breadcrumb-section pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            <h2>Mon compte</h2>
                            <div class="bt-option">
<?php
if (isset($_GET['p']) && $_GET['p'] == 'update_password') {
?>
                                <a href="./">Accueil</a>
                                <a href="./account">Compte</a>
                                <span>Changer mot de passe</span>
<?php
} else {
?>
                                <a href="./">Accueil</a>
                                <span>Compte</span>
<?php
}
?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="contact-section pt-0 pb-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                        <div class="card border border-default z-depth-0 mb-4">
                            <div class="card-body position-relative">
                                <div class="bg-image px-lg-3">
                                    <img src="<?= $utilisateurEnCours[0]->avatar_url != null ? $utilisateurEnCours[0]->avatar_url : './assets/img/user.png' ?>" alt="<?= $utilisateurEnCours[0]->prenom . ' ' . $utilisateurEnCours[0]->nom ?>" class="user-image img-fluid img-thumbnail rounded-circle">
                                    <div class="mask"></div>
                                </div>
                                <form method="post" class="position-absolute" style="bottom: 0.5rem; right: 1.2rem;">
                                    <input type="hidden" name="id_utilisateur" id="id_utilisateur" value="<?= $utilisateurEnCours[0]->id ?>">
                                    <label for="avatar" class="btn btn-primary rounded-pill z-depth-0" title="Changer de profil">
                                        <i class="fa fa-pencil mr-2"></i>Modifier
                                        <input type="file" name="avatar" id="avatar" class="d-none">
                                    </label>
                                </form>
                            </div>

                            <div class="card-body pt-0">
                                <a href="./bookings" class="btn btn-block btn-secondary my-2 z-depth-0">Mes réservations</a>
                                <p class="mb-0 text-center text-uppercase">
                                    <a href="?p=update_password" class="btn-link">Changer mot de passe</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 col-sm-7">
<?php
if (isset($_GET['p']) && $_GET['p'] == 'update_password') {
?>
                        <div class="booking-form pt-0">
                            <form method="POST" action="./operations/editer.php">
                                <input type="hidden" name="objet" value="mot_de_passe">
                                <input type="hidden" name="id_utilisateur" value="<?= $_SESSION['id'] ?>">

                                <div class="check-date">
                                    <label for="register_ancien_mot_de_passe" class="sr-only">Ancien mot de passe :</label>
                                    <input type="password" name="register_ancien_mot_de_passe" id="register_ancien_mot_de_passe" placeholder="Ancien mot de passe" required autofocus>
                                </div>

                                <div class="check-date">
                                    <label for="register_nouveau_mot_de_passe" class="sr-only">Nouveau mot de passe :</label>
                                    <input type="password" name="register_nouveau_mot_de_passe" id="register_nouveau_mot_de_passe" placeholder="Nouveau mot de passe" required>
                                </div>

                                <div class="check-date">
                                    <label for="confirmer_nouveau_mot_de_passe" class="sr-only">Nouveau mot de passe :</label>
                                    <input type="password" name="confirmer_nouveau_mot_de_passe" id="confirmer_nouveau_mot_de_passe" placeholder="Nouveau mot de passe" required>
                                </div>

                                <button type="submit" class="mb-3">Enregistrer</button>
                                <p class="mb-0 text-center text-uppercase">
                                    <a href="./account" class="btn-link">Annuler</a>
                                </p>
                            </form>
                        </div>
<?php
} else {
?>
                        <div class="booking-form pt-0">
                            <form method="POST" action="./operations/editer.php">
                                <input type="hidden" name="objet" value="compte">
                                <input type="hidden" name="id_utilisateur" value="<?= $_SESSION['id'] ?>">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="check-date">
                                            <label for="register_prenom" class="sr-only">Prénom :</label>
                                            <input type="text" name="register_prenom" id="register_prenom" placeholder="Prénom" value="<?= $utilisateurEnCours[0]->prenom ?>" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="check-date">
                                            <label for="register_nom" class="sr-only">Nom :</label>
                                            <input type="text" name="register_nom" id="register_nom" placeholder="Nom" value="<?= $utilisateurEnCours[0]->nom ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="check-date">
                                            <label for="register_post_nom" class="sr-only">Post-nom :</label>
                                            <input type="text" name="register_post_nom" id="register_post_nom" placeholder="Post-nom" value="<?= $utilisateurEnCours[0]->post_nom ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="check-date">
                                            <label for="register_email" class="sr-only">E-mail :</label>
                                            <input type="email" name="register_email" id="register_email" placeholder="E-mail" value="<?= $utilisateurEnCours[0]->email ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-lg-0 mb-3">
                                    <div class="col-lg-6">
                                        <div class="check-date">
                                            <label for="register_telephone" class="sr-only">Téléphone :</label>
                                            <input type="tel" name="register_telephone" id="register_telephone" placeholder="Téléphone" value="<?= $utilisateurEnCours[0]->telephone ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 text-center">
                                        <p class="mb-0 small text-muted text-uppercase">Je suis</p>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" name="register_sexe" id="homme" class="form-check-input" value="M"<?= $utilisateurEnCours[0]->sexe == 'M' ? ' checked' : '' ?>>
                                            <label for="homme" class="form-check-label" style="cursor: pointer;">Un homme</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" name="register_sexe" id="femme" class="form-check-input" value="F"<?= $utilisateurEnCours[0]->sexe == 'F' ? ' checked' : '' ?>>
                                            <label for="femme" class="form-check-label" style="cursor: pointer;">Une femme</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="check-date">
                                            <label for="register_date_de_naissance" class="sr-only">Date de naissance :</label>
                                            <input type="tel" name="register_date_de_naissance" id="register_date_de_naissance" placeholder="Date de naissance" value="<?= explode('-', $utilisateurEnCours[0]->date_de_naissance)[2] . '/' . explode('-', $utilisateurEnCours[0]->date_de_naissance)[1] . '/' . explode('-', $utilisateurEnCours[0]->date_de_naissance)[0] ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                    </div>
                                </div>

                                <button type="submit" class="mb-3">Enregistrer</button>
                                <p class="mb-0 text-center text-uppercase">
                                    <a href="./account" class="btn-link">Annuler</a>
                                </p>
                            </form>
                        </div>
<?php
}
?>
                    </div>
                </div>
            </div>
        </section>

<?php
require('../templates/public/pied_de_page.php')
?>
