<?php

use app\table\Reservation;

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ./');
}

require('../templates/public/entete.php');

$listeReservations = Reservation::trouverToutesAvecDetailsParIdUtilisateur($_SESSION['id']);
?>

        <div class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            <h2>Mes réservations</h2>
                            <div class="bt-option">
                                <a href="./">Accueil</a>
                                <a href="./account">Compte</a>
                                <span>Réservations</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="contact-section pt-0 pb-5">
            <div class="container">
                <div class="row">
                <div class="col-12">
                        <table id="dataList" class="table table-striped w-100 mb-4">
                            <thead>
                                <tr>
                                    <th class="text-uppercase">Evénement</th>
                                    <th class="text-uppercase">Date</th>
                                    <th class="text-uppercase">Débute à</th>
                                    <th class="text-uppercase">Termine à</th>
                                    <th class="text-uppercase">Montant payé</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
setlocale(LC_ALL, 'fr_FR.UTF-8', 'fr_FR','fr','fr','fra','fr_FR@euro');

foreach ($listeReservations as $reservation):
?>
                                <tr>
                                    <td><?= $reservation->nom_even ?></td>
                                    <td><?= utf8_encode(strftime('%A %d %B %Y',strtotime($reservation->date_reserv))) ?></td>
                                    <td><?= date('H\hi\'', strtotime($reservation->heureDebut_reserv)) ?></td>
                                    <td><?= date('H\hi\'', strtotime($reservation->heureFin_reserv)) ?></td>
                                    <td>
<?php
    if ($reservation->id_eta == 5) {
?>
                                        <span class="d-inline-block">Totalité</span>
<?php
    } else {
?>
                                        <form method="POST" action="./operations/editer.php">
                                            <input type="hidden" name="objet" value="etat_reservation">
                                            <input type="hidden" name="id_reservation" value="<?= $reservation->id_reserv ?>">
                                            <input type="hidden" name="id_etat" value="5">

                                            <span class="d-inline-block">Acompte</span>
                                            <button type="submit" class="btn btn-primary ml-2 py-0 rounded-pill z-depth-0">Solder</button>
                                        </form>
<?php
    }
?>
                                        </select>
                                    </td>
                                </tr>
<?php
endforeach;
?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </section>

<?php
require('../templates/public/pied_de_page.php')
?>
