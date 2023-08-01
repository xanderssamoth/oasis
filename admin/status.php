<?php

use app\table\Etat;

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
                            <h2>Gestion d'états</h2>
                            <div class="bt-option">
<?php
if (isset($_GET['id'])) {
    $etatEnCours = Etat::trouverParId($_GET['id']);
?>
                                <a href="./">Accueil</a>
                                <a href="./status">Etat</a>
                                <span>Editer</span>
<?php
} else {
?>
                                <a href="./">Accueil</a>
                                <span>Etat</span>
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
    $etatEnCours = Etat::trouverParId($_GET['id']);
?>
                    <div class="col-lg-5 col-sm-6 mx-auto">
                        <div class="booking-form pt-0">
                            <h3 class="mb-4 text-warning text-center font-weight-bold">Editer l'état</h3>

                            <form method="POST" action="../operations/editer.php">
                                <input type="hidden" name="objet" value="etat">
                                <input type="hidden" name="id_etat" value="<?= $etatEnCours[0]->id ?>">

                                <div class="check-date">
                                    <label for="register_nom_etat" class="sr-only">Nom de l'état :</label>
                                    <input type="text" name="register_nom_etat" id="register_nom_etat" placeholder="Nom de l'état" value="<?= $etatEnCours[0]->nom_etat ?>" required autofocus>
                                </div>

                                <div class="mb-3 text-center">
                                    <p class="mb-0 small text-muted text-uppercase">Couleur</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="register_couleur" id="success" class="form-check-input" value="success"<?= $etatEnCours[0]->couleur == 'success' ? ' checked' : '' ?>>
                                        <label for="success" class="form-check-label" style="cursor: pointer;">Vert</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="register_couleur" id="warning" class="form-check-input" value="warning"<?= $etatEnCours[0]->couleur == 'warning' ? ' checked' : '' ?>>
                                        <label for="warning" class="form-check-label" style="cursor: pointer;">Orange</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="register_couleur" id="danger" class="form-check-input" value="danger"<?= $etatEnCours[0]->couleur == 'danger' ? ' checked' : '' ?>>
                                        <label for="danger" class="form-check-label" style="cursor: pointer;">Rouge</label>
                                    </div>
                                </div>

                                <div class="check-date">
                                    <label for="register_description_etat" class="sr-only">Description :</label>
                                    <textarea name="register_description_etat" id="register_description_etat" placeholder="Description"><?= $etatEnCours[0]->description_etat ?></textarea>
                                </div>

                                <button type="submit" class="mt-0 mb-3">Enregistrer</button>
                                <a href="./status" class="btn btn-light btn-block border border-default mt-0 mb-3">Annuler</a>
                            </form>
                        </div>
                    </div>
<?php
} else {
?>
                    <div class="col-lg-5 col-sm-6">
                        <div class="booking-form pt-0">
                            <h3 class="mb-4 text-info text-center font-weight-bold">Ajouter un état</h3>

                            <form method="POST" action="../operations/ajouter.php">
                                <input type="hidden" name="objet" value="etat">

                                <div class="check-date">
                                    <label for="register_nom_etat" class="sr-only">Nom de l'état :</label>
                                    <input type="text" name="register_nom_etat" id="register_nom_etat" placeholder="Nom de l'état" required autofocus>
                                </div>

                                <div class="mb-3 text-center">
                                    <p class="mb-0 small text-muted text-uppercase">Couleur</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="register_couleur" id="success" class="form-check-input" value="success">
                                        <label for="success" class="form-check-label" style="cursor: pointer;">Vert</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="register_couleur" id="warning" class="form-check-input" value="warning">
                                        <label for="warning" class="form-check-label" style="cursor: pointer;">Orange</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="register_couleur" id="danger" class="form-check-input" value="danger">
                                        <label for="danger" class="form-check-label" style="cursor: pointer;">Rouge</label>
                                    </div>
                                </div>

                                <div class="check-date">
                                    <label for="register_description_etat" class="sr-only">Description :</label>
                                    <textarea name="register_description_etat" id="register_description_etat" placeholder="Description"></textarea>
                                </div>

                                <button type="submit" class="mt-0 mb-3">Enregistrer</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-7 col-sm-6">
<?php
    if ($compterEtat[0]->nbr > 0) {
?>
                        <ul class="list-group mb-5">
<?php
        foreach ($listeEtats as $etat):
?>
                            <li class="list-group-item">
<?php
            if ($etat->nom_etat != 'Activé') {
?>
                                <div class="dropdown d-inline-block float-right">
                                    <a href="javascript:return false;" class="text-dark" id="menuOperation" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="#menuOperation">
                                        <a class="dropdown-item" href="?id=<?= $etat->id ?>">Modifier</a>
                                        <a class="dropdown-item" href="../operations/supprimer.php?objet=etat&amp;id=<?= $etat->id ?>">Supprimer</a>
                                    </div>
                                </div>
<?php
            }
?>

                                <h3 class="h3-responsive mb-2">
                                    <i class="fa fa-circle mr-3 text-<?= $etat->couleur ?>"></i> <?= $etat->nom_etat ?>
                                </h3>
                                <p class="mb-0 text-secondary"><?= $etat->description_etat ?></p>
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
