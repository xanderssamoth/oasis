<?php

/* 
 * File: supprimer
 * author: Michael Matona
 */
require '../app/Autoloader.php';

app\Autoloader::register();

// use app\table\Agent;
use app\table\Fonction;

if (isset($_GET['objet']) && $_GET['objet'] === 'fonction') {
    $idFonction = $_GET['id_fonction'];

    Fonction::delete($idFonction);

    header('Location: ../admin/?p=fonction&msg=supprimee');

} else if (isset($_GET['objet']) && $_GET['objet'] === 'agent') {

} else if (isset($_GET['objet']) && $_GET['objet'] === 'secteur') {

} else if (isset($_GET['objet']) && $_GET['objet'] === 'taxe') {

} else if (isset($_GET['objet']) && $_GET['objet'] === 'forme_juridique') {

}
