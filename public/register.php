<?php
session_start();

if (isset($_SESSION['id'])) {
    header('Location: ./');
}

require('../templates/public/entete.php');
?>

        <div class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            <h2>Créer un compte</h2>
                            <div class="bt-option">
                                <a href="./">Accueil</a>
                                <span>Inscription</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="contact-section py-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-sm-7 mx-auto">
                        <div class="booking-form pt-0">
                            <form method="POST" action="./operations/ajouter.php">
<?php
if (isset($_GET['redirect']) && $_GET['redirect'] == 'admin') {
?>
                                <input type="hidden" name="objet" value="admin">
<?php
} else {
?>
                                <input type="hidden" name="objet" value="client">
<?php
}
?>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="check-date">
                                            <label for="register_prenom" class="sr-only">Prénom :</label>
                                            <input type="text" name="register_prenom" id="register_prenom" placeholder="Prénom" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="check-date">
                                            <label for="register_nom" class="sr-only">Nom :</label>
                                            <input type="text" name="register_nom" id="register_nom" placeholder="Nom">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="check-date">
                                            <label for="register_post_nom" class="sr-only">Post-nom :</label>
                                            <input type="text" name="register_post_nom" id="register_post_nom" placeholder="Post-nom">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="check-date">
                                            <label for="register_email" class="sr-only">E-mail :</label>
                                            <input type="email" name="register_email" id="register_email" placeholder="E-mail" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-lg-0 mb-3">
                                    <div class="col-lg-6">
                                        <div class="check-date">
                                            <label for="register_telephone" class="sr-only">Téléphone :</label>
                                            <input type="tel" name="register_telephone" id="register_telephone" placeholder="Téléphone">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 text-center">
                                        <p class="mb-0 small text-muted text-uppercase">Je suis</p>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" name="register_sexe" id="homme" class="form-check-input" value="M">
                                            <label for="homme" class="form-check-label" style="cursor: pointer;">Un homme</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" name="register_sexe" id="femme" class="form-check-input" value="F">
                                            <label for="femme" class="form-check-label" style="cursor: pointer;">Une femme</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="check-date">
                                            <label for="register_date_de_naissance" class="sr-only">Date de naissance :</label>
                                            <input type="tel" name="register_date_de_naissance" id="register_date_de_naissance" placeholder="Date de naissance">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="check-date">
                                            <label for="register_mot_de_passe" class="sr-only">Mot de passe :</label>
                                            <input type="password" name="register_mot_de_passe" id="register_mot_de_passe" placeholder="Mot de passe" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="check-date">
                                            <label for="confirmer_mot_de_passe" class="sr-only">Confirmer mot de passe :</label>
                                            <input type="password" name="confirmer_mot_de_passe" id="confirmer_mot_de_passe" placeholder="Confirmer mot de passe" required>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="mb-3">Enregistrer</button>
                                <p class="mb-0 text-center text-uppercase">
                                    <a href="./" class="btn-link">J'ai déjà un compte</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php
require('../templates/public/pied_de_page.php');
?>
