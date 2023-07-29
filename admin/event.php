<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ./');
}

require('../templates/admin/entete.php')
?>

        <div class="breadcrumb-section pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            <h2>Gestion d'événements</h2>
                            <div class="bt-option">
                                <a href="./">Accueil</a>
                                <span>Evénement</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
require('../templates/admin/pied_de_page.php')
?>
