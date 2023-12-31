<?php

use app\table\Role;

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
                            <h2>Gestion de rôles</h2>
                            <div class="bt-option">
<?php
if (isset($_GET['id'])) {
    $roleEnCours = Role::trouverParId($_GET['id']);
?>
                                <a href="./">Accueil</a>
                                <a href="./role">Rôle</a>
                                <span>Editer</span>
<?php
} else {
?>
                                <a href="./">Accueil</a>
                                <span>Rôle</span>
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
    $roleEnCours = Role::trouverParId($_GET['id']);
?>
                    <div class="col-lg-5 col-sm-6 mx-auto">
                        <div class="booking-form pt-0">
                            <h3 class="mb-4 text-warning text-center font-weight-bold">Editer le rôle</h3>

                            <form method="POST" action="../operations/editer.php">
                                <input type="hidden" name="objet" value="role">
                                <input type="hidden" name="id_role" value="<?= $roleEnCours[0]->id ?>">

                                <div class="check-date">
                                    <label for="register_nom_role" class="sr-only">Nom du rôle :</label>
                                    <input type="text" name="register_nom_role" id="register_nom_role" placeholder="Nom du rôle" value="<?= $roleEnCours[0]->nom_role ?>" required autofocus>
                                </div>

                                <div class="check-date">
                                    <label for="register_description_role" class="sr-only">Description :</label>
                                    <textarea name="register_description_role" id="register_description_role" placeholder="Description"><?= $roleEnCours[0]->description_role ?></textarea>
                                </div>

                                <button type="submit" class="mt-0 mb-3">Enregistrer</button>
                                <a href="./role" class="btn btn-light btn-block border border-default mt-0 mb-3">Annuler</a>
                            </form>
                        </div>
                    </div>
<?php
} else {
?>
                    <div class="col-lg-5 col-sm-6">
                        <div class="booking-form pt-0">
                            <h3 class="mb-4 text-info text-center font-weight-bold">Ajouter un rôle</h3>

                            <form method="POST" action="../operations/ajouter.php">
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

                    <div class="col-lg-7 col-sm-6">
<?php
    if ($compterRole[0]->nbr > 0) {
?>
                        <ul class="list-group mb-5">
<?php
        foreach ($listeRoles as $role):
?>
                            <li class="list-group-item">
<?php
            if ($role->nom_role != 'Administrateur') {
?>
                                <div class="dropdown d-inline-block float-right">
                                    <a href="javascript:return false;" class="text-dark" id="menuOperation" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="#menuOperation">
                                        <a class="dropdown-item" href="?id=<?= $role->id ?>">Modifier</a>
                                        <a class="dropdown-item" href="../operations/supprimer.php?objet=role&amp;id=<?= $role->id ?>">Supprimer</a>
                                    </div>
                                </div>
<?php
            }
?>
                                <h3 class="h3-responsive mb-2"><?= $role->nom_role ?></h3>
                                <p class="mb-0 text-secondary"><?= $role->description_role ?></p>
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
