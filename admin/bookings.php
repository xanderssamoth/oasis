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

        <section class="contact-section pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <table id="dataList" class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th class="text-uppercase">Client</th>
                                    <th class="text-uppercase">Evénement</th>
                                    <th class="text-uppercase">Date</th>
                                    <th class="text-uppercase">Débute à</th>
                                    <th class="text-uppercase">Termine à</th>
                                    <th class="text-uppercase">Montant payé</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
/*
    Pour afficher la date, on devrait utiliser "IntlDateFormatter" puisque les fonctions 
    "utf8_encode" et "strftime" que nous avons utilisées sont dépréciées.

    L'objet "IntlDateFormatter" est défini comme suit :
    ===================================================
    $fmt = new IntlDateFormatter('fr_FR', IntlDateFormatter::NONE, IntlDateFormatter::NONE);
    $fmt->setPattern('EEEE dd MMMM YYYY');
    $fmt->format($reservation->date_reserv);
*/
setlocale(LC_ALL, 'fr_FR.UTF-8', 'fr_FR','fr','fr','fra','fr_FR@euro');

foreach ($listeReservations as $reservation):
?>
                                <tr>
                                    <td>
                                        <img src="<?= $reservation->profil_util != null ? $reservation->profil_util : '../assets/img/user.png' ?>" alt="" width="40" class="rounded-circle mr-2" style="vertical-align: middle;">
                                        <?= $reservation->prenom_util . ' ' . $reservation->nom_util ?>
                                    </td>
                                    <td><?= $reservation->nom_even ?></td>
                                    <td><?= utf8_encode(strftime('%A %d %B %Y',strtotime($reservation->date_reserv))) ?></td>
                                    <td><?= $reservation->heureDebut_reserv ?></td>
                                    <td><?= $reservation->heureFin_reserv ?></td>
                                    <td>
                                        <select id="price-<?= $reservation->id_reserv ?>" class="form-control pt-0" aria-status="<?= $reservation->nom_eta ?>" onchange="changeReservationStatus('price-<?= $reservation->id_reserv ?>')">
<?php
    foreach ($listeEtats as $etat):
        if ($etat->id > 3) {
?>
                                            <option value="<?= $etat->id ?>"<?= $reservation->id_eta == $etat->id ? ' selected' : '' ?>><?= $etat->nom_etat ?></option>
<?php
        }
    endforeach;
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
require('../templates/admin/pied_de_page.php')
?>
