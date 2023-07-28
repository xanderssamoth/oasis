<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ./');
}

require('../templates/public/entete.php')
?>

        <div class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            <h2>A propos de nous</h2>
                            <div class="bt-option">
                                <a href="./">Accueil</a>
                                <span>A propos</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
require('../templates/public/pied_de_page.php')
?>
