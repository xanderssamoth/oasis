<?php

/* 
 * File: editer
 * author: Michael Matona
 */

require '../app/Autoloader.php';

app\Autoloader::register();

use app\table\Agent;
use app\table\Fonction;

if (isset($_POST['objet']) && $_POST['objet'] === 'agent') {
    // Modifier l'agent en cours
    $idAgent = $_POST['id_agent'];
    $matricule = $_POST['enregistrer_matricule'];
    $nom = $_POST['enregistrer_nom'];
    $postnom = $_POST['enregistrer_postnom'];
    $telephone = $_POST['enregistrer_telephone'];
    $motDePasse = sha1($_POST['enregistrer_motDePasse']);
    $idFonction = $_POST['id_fonction'];

    Agent::updateAgent($matricule, $nom, $postnom, $telephone, $idFonction, $idAgent);

    // On détruit la session en cours
    session_destroy();
    setcookie('nom', $nom);
    setcookie('postnom', $postnom);

    // On crée une autre session avec les nouvelles informations du compte
    session_start();

    $_SESSION['id'] = $idAgent;
    $_SESSION['nom'] = $nom;
    $_SESSION['postnom'] = $postnom;

    header('Location: ../admin/?p=compte&msg=modifie');

} else if (isset($_POST['objet']) && $_POST['objet'] === 'mot_de_passe') {
    $idAgent = $_POST['id_agent'];
    // Sélectionner les informations de l'agent en cours pour tester la validité du mot de passe
    $currentAgent = Agent::findById($idAgent);
    // Modifier le mot de passe de l'agent en cours
    $ancienMotDePasse = sha1($_POST['ancien_motDePasse']);
    $nouveauMotDePasse = $_POST['nouveau_motDePasse'];
    $confirmerNouveauMotDePasse = $_POST['confirmer_nouveau_motDePasse'];

    if ($ancienMotDePasse != $currentAgent[0]->mot_de_passe) {
        header('Location: ../admin/?p=changer_mot_de_passe&msg=motdepasse');

    } else if ($confirmerNouveauMotDePasse != $nouveauMotDePasse) {
        header('Location: ../admin/?p=changer_mot_de_passe&msg=confirmermotdepasse');

    } else {
        Agent::updateMotDePasse(sha1($nouveauMotDePasse), $idAgent);

        header('Location: ../admin/?p=changer_mot_de_passe&msg=modifie');
    }

} else if (isset($_POST['objet']) && $_POST['objet'] === 'fonction') {
    $fonction = $_POST['enregistrer_nomFonction'];

    Fonction::updateFonction($fonction);

    header('Location: ../admin/?p=fonction&msg=enregistree');

} else if (isset($_POST['objet']) && $_POST['objet'] === 'agent') {

} else if (isset($_POST['objet']) && $_POST['objet'] === 'secteur') {

} else if (isset($_POST['objet']) && $_POST['objet'] === 'taxe') {

} else if (isset($_POST['objet']) && $_POST['objet'] === 'forme_juridique') {

} else if (isset($_POST['objet']) && $_POST['objet'] === 'photo') {
    $id_agent = $_POST['id_agent'];
    $data = $_POST['avatar'];
    $image_array_1 = explode(';', $data);
    $image_array_2 = explode(',', $image_array_1[1]);
    $data = base64_decode($image_array_2[1]);
    $image_name = 'C:\\xampp\\htdocs\\img\\agents_site_env\\' . $id_agent . '.png';

    file_put_contents($image_name, $data);

    echo $image_name;
}

 