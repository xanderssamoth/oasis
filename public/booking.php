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
                            <h2>Réserver la salle</h2>
                            <div class="bt-option">
                                <a href="./">Accueil</a>
                                <span>Réserver</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="contact-section py-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-sm-5 offset-lg-1 d-sm-inline-block d-none">
                        <div class="card bg-light z-depth-0">
                            <div class="card-body d-flex justify-content-between">
                                <h2><i class="fa fa-info-circle" style="color: #555;"></i></h2>
                                <span class="d-inline-block ml-3 lead" style="color: #555;">Pour réserver une salle, veuillez choisir l'événement que vous voulez organiser, la date de cet événement, l'heure du début et l'heure de la fin de l'événement.</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-sm-7">
                        <div class="booking-form pt-0">
                            <form method="POST" action="./operations/ajouter.php">
                                <input type="hidden" name="objet" value="reservation">
                                <input type="hidden" name="id_utilisateur" value="<?= $_SESSION['id'] ?>">

                                <div class="check-date pt-0">
                                    <label for="register_date" class="sr-only">Date de l'événement :</label>
                                    <input type="tel" name="register_date" id="register_date" placeholder="Date de l'événement">
                                </div>

                                <div class="check-date">
                                    <label for="register_heure_debut" class="sr-only">Heure de début :</label>
                                    <input type="tel" name="register_heure_debut" id="register_heure_debut" placeholder="Heure de début">
                                </div>

                                <div class="check-date">
                                    <label for="register_heure_fin" class="sr-only">Heure de fin :</label>
                                    <input type="tel" name="register_heure_fin" id="register_heure_fin" placeholder="Heure de fin">
                                </div>

                                <select name="id_evenement" id="id_evenement" class="form-control w-100 h-100 mb-3">
                                    <option class="small" selected disabled>Choisir un événement</option>
<?php
if ($compterEvenement[0]->nbr > 0) {
    foreach ($listeEvenements as $evenement):
        if ($evenement->id_etat == 1) {
?>
                                    <option value="<?= $evenement->id ?>"><?= $evenement->nom_evenement ?></option>
<?php
        }
    endforeach;
}
?>
                                </select>

                                <select name="id_etat" id="id_etat" class="form-control w-100 h-100 mb-3">
                                    <option class="small" selected disabled>Mode de paiement</option>
<?php
foreach ($listeEtats as $etat):
    if ($etat->id > 3) {
?>
                                    <option value="<?= $etat->id ?>"><?= $etat->nom_etat ?></option>
<?php
    }
endforeach;
?>
                                </select>

                                <button type="submit" class="mt-0 mb-3">Enregistrer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php
require('../templates/public/pied_de_page.php')
?>
