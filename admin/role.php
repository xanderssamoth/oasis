<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ./');
}

require('../templates/admin/entete.php')
?>

        <div class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            <h2>Gestion de rôles</h2>
                            <div class="bt-option">
                                <a href="./">Accueil</a>
                                <span>Rôle</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="contact-section py-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-sm-6">
                        <div class="booking-form pt-0">
                            <form method="POST" action="./operations/ajouter.php">
                                <input type="hidden" name="objet" value="role">

                                <div class="check-date">
                                    <label for="register_nom_role" class="sr-only">Nom du rôle :</label>
                                    <input type="text" name="register_nom_role" id="register_nom_role" placeholder="Nom du rôle" required autofocus>
                                </div>

                                <div class="check-date">
                                    <label for="register_description_role" class="sr-only">Description :</label>
                                    <textarea name="register_description_role" id="register_description_role" placeholder="Description"></textarea>
                                </div>

                                <button type="submit" class="mt-0 mb-3">Enregistrer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php
require('../templates/admin/pied_de_page.php')
?>
