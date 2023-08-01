<?php

use app\table\Evenement;
use app\Utility;

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
<?php
if (isset($_GET['id'])) {
    $evenementEnCours = Evenement::trouverParId($_GET['id']);
?>
                                <a href="./">Accueil</a>
                                <a href="./event">Evénement</a>
                                <span>Editer</span>
<?php
} else {
?>
                                <a href="./">Accueil</a>
                                <span>Evénement</span>
<?php
}
?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="contact-section py-0">
            <div class="container">
                <div class="row">
<?php
if (isset($_GET['id'])) {
    $evenementEnCours = Evenement::trouverParId($_GET['id']);
?>
                    <div class="col-lg-5 col-sm-6 mx-auto">
                        <div class="booking-form pt-0">
                            <h3 class="mb-4 text-warning text-center font-weight-bold">Editer l'événement</h3>

                            <form method="POST" action="../operations/editer.php">
                                <input type="hidden" name="objet" value="evenement">
                                <input type="hidden" name="id_evenement" value="<?= $evenementEnCours[0]->id ?>">
                                <input type="hidden" name="id_etat" value="<?= $evenementEnCours[0]->id_etat ?>">

                                <div class="check-date">
                                    <label for="register_nom_evenement" class="sr-only">Nom de l'événement :</label>
                                    <input type="text" name="register_nom_evenement" id="register_nom_evenement" placeholder="Nom de l'événement" value="<?= $evenementEnCours[0]->nom_evenement ?>" required autofocus>
                                </div>

                                <div class="row">
                                    <div class="col-12">Prix en USD</div>
                                    <div class="col-lg-6">
                                        <div class="check-date">
                                            <label for="register_prix_accompte" class="mb-1">Prix acompte en USD :</label>
                                            <input type="number" name="register_prix_accompte" id="register_prix_accompte" placeholder="Prix total en USD" value="<?= $evenementEnCours[0]->prix_acompte ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="check-date">
                                            <label for="register_prix_total" class="mb-1">Prix total en USD :</label>
                                            <input type="number" name="register_prix_total" id="register_prix_total" placeholder="Prix total en USD" value="<?= $evenementEnCours[0]->prix_total ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="mt-0 mb-3">Enregistrer</button>
                                <a href="./event" class="btn btn-light btn-block border border-default mt-0 mb-3">Annuler</a>
                            </form>
                        </div>
                    </div>
<?php
} else {
?>
                    <div class="col-lg-5 col-sm-6">
                        <div class="booking-form pt-0">
                            <h3 class="mb-4 text-info text-center font-weight-bold">Ajouter un événement</h3>

                            <form method="POST" action="../operations/ajouter.php">
                                <input type="hidden" name="objet" value="evenement">
                                <input type="hidden" name="id_etat" value="1">

                                <div class="check-date">
                                    <label for="register_nom_evenement" class="sr-only">Nom de l'événement :</label>
                                    <input type="text" name="register_nom_evenement" id="register_nom_evenement" placeholder="Nom de l'événement" required autofocus>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <div class="check-date">
                                            <label for="register_prix_accompte" class="mb-1">Prix acompte en USD :</label>
                                            <input type="number" name="register_prix_accompte" id="register_prix_accompte" placeholder="Prix acompte en USD" value="0" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="check-date">
                                            <label for="register_prix_total" class="mb-1">Prix total en USD :</label>
                                            <input type="number" name="register_prix_total" id="register_prix_total" placeholder="Prix total en USD" value="0" required>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="mt-0 mb-3">Enregistrer</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-7 col-sm-6">
<?php
    if ($compterEvenement[0]->nbr > 0) {
?>
                        <ul class="list-group mb-5">
<?php
        foreach ($listeEvenements as $evenement):
?>
                            <li class="list-group-item">
                                <div class="dropdown d-inline-block float-right">
                                    <a href="javascript:return false;" class="text-dark" id="menuOperation" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="#menuOperation">
                                        <a class="dropdown-item" href="?id=<?= $evenement->id ?>">Modifier</a>
                                        <a class="dropdown-item" href="../operations/supprimer.php?objet=evenement&amp;id=<?= $evenement->id ?>">Supprimer</a>
                                    </div>
                                </div>

                                <h3 class="h3-responsive mb-2"><?= $evenement->nom_evenement ?></h3>
                                <p class="mb-0 text-secondary"><u>Prix acompte</u> : <?= Utility::formatNumber($evenement->prix_acompte) ?></p>
                                <p class="mb-0 text-secondary"><u>Prix total</u> : <?= Utility::formatNumber($evenement->prix_total) ?></p>
                            </li>
<?php
        endforeach;
?>
                        </ul>
<?php
    } else {
?>
                        <div class="view mb-2 text-center">
                            <img src="../assets/img/bubble-info.png" width="90" alt="">
                            <div class="mask"></div>
                        </div>
                        <h4 class="h4-responsive mb-5 text-center">La liste est encore vide</h4>
<?php
    }
?>
                    </div>
<?php
}
?>
                </div>
            </div>
        </section>

<?php
require('../templates/admin/pied_de_page.php')
?>
