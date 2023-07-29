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
                            <h2>Réservations de clients</h2>
                            <div class="bt-option">
                                <a href="./">Accueil</a>
                                <span>Réservations</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
require('../templates/admin/pied_de_page.php')
?>
