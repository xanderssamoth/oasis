<?php
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
                            <h2>Mon compte</h2>
                            <div class="bt-option">
                                <a href="./">Accueil</a>
                                <span>Compte</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
require('../templates/public/pied_de_page.php')
?>
