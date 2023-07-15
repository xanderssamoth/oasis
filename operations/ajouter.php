<?php

/* 
 * File: ajouter
 * author: Michael Matona
 */
require '../app/Autoloader.php';

app\Autoloader::register();

use app\table\Agent;
use app\table\Fonction;
use app\table\FormeJurique;
use app\table\SecteurActivite;
use app\table\Taxe;

if (isset($_POST['objet']) && $_POST['objet'] === 'admin') {
    // Enregistrer l'agent avec la fonction "Administrateur"
    $matricule = $_POST['enregistrer_matricule'];
    $nom = $_POST['enregistrer_nom'];
    $postnom = $_POST['enregistrer_postnom'];
    $telephone = $_POST['enregistrer_telephone'];
    $motDePasse = sha1($_POST['enregistrer_motDePasse']);
    $confirmerMotDePasse = $_POST['confirmer_motDePasse'];
    $fonction = 'Administrateur';

    if ($_POST['enregistrer_motDePasse'] != $confirmerMotDePasse) {
        header('Location: ../admin/?msg=confirmermotdepasse');

    } else {
        Agent::insertIntoAgentAndFonction($matricule, $nom, $postnom, $telephone, $motDePasse, $fonction);

        header('Location: ../admin/?p=connexion&msg=inscrit');
    }

} else if (isset($_POST['objet']) && $_POST['objet'] === 'fonction') {
    $fonction = $_POST['enregistrer_nomFonction'];

    Fonction::insertIntoFonction($fonction);

    header('Location: ../admin/?p=fonction&msg=enregistree');

} else if (isset($_POST['objet']) && $_POST['objet'] === 'agent') {
    // Enregistrer un agent avec sa fonction
    $matricule = $_POST['enregistrer_matricule'];
    $nom = $_POST['enregistrer_nom'];
    $postnom = $_POST['enregistrer_postnom'];
    $telephone = $_POST['enregistrer_telephone'];
    $motDePasse = sha1($_POST['enregistrer_motDePasse']);
    $confirmerMotDePasse = $_POST['confirmer_motDePasse'];
    $idFonction = $_POST['id_fonction'];

    if ($_POST['enregistrer_motDePasse'] != $confirmerMotDePasse) {
        header('Location: ../admin/?p=agent&msg=confirmermotdepasse');

    } else {
        Agent::insertIntoAgent($matricule, $nom, $postnom, $telephone, $motDePasse, $idFonction);

        header('Location: ../admin/?p=agent&msg=enregistre');
    }

} else if (isset($_POST['objet']) && $_POST['objet'] === 'secteur') {
    $secteur = $_POST['enregistrer_nomSecteur'];

    SecteurActivite::insertIntoSecteurActivite($secteur);

    header('Location: ../admin/?p=secteur&msg=enregistre');

} else if (isset($_POST['objet']) && $_POST['objet'] === 'taxe') {
    $taxe = $_POST['enregistrer_nomTaxe'];

    Taxe::insertIntoTaxe($taxe);

    header('Location: ../admin/?p=taxe&msg=enregistree');

} else if (isset($_POST['objet']) && $_POST['objet'] === 'forme_juridique') {
    $formeJurique = $_POST['enregistrer_nomForme'];
    $abreviation = $_POST['enregistrer_abreviation'];

    FormeJurique::insertIntoFormeJurique($formeJurique, $abreviation);

    header('Location: ../admin/?p=forme_juridique&msg=enregistree');

} else if (isset($_POST['objet']) && $_POST['objet'] === 'photo') {
    $id_agent = $_POST['id_agent'];
    $data = $_POST['avatar'];
    $image_array_1 = explode(';', $data);
    $image_array_2 = explode(',', $image_array_1[1]);
    $data = base64_decode($image_array_2[1]);
    $image_name = 'C:\\xampp\\htdocs\\img\\agents_site_env\\' . $id_agent . '.png';

    file_put_contents($image_name, $data);

    echo $image_name;

// ENREGISTRER LES FICHIERS DANS LE SERVEUR
} else if (isset($_POST['objet']) && $_POST['objet'] === 'document') {
    if (isset($_POST['envoyer'])) {
 
        // Récupérer tous les fichiers
        $countfiles = count($_FILES['fichier']['nom_document']);

        for ($i = 0; $i < $countfiles; $i++) {
            $filename = $_FILES['fichier']['name'][$i];

            // Uploader les fichiers
            move_uploaded_file($_FILES['fichier']['tmp_name'][$i], 'C:\\xampp\\htdocs\\img\\agents_site_env\\' . $filename);

            echo $image_name;
        }
    }
}
