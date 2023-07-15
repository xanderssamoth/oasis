<?php

/* 
 * File: connexion
 * author: Michael Matona
 */
require '../app/Autoloader.php';

app\Autoloader::register();

use app\table\Agent;

$loginMatricule = $_POST['login_matricule'];
$loginMotDePasse = sha1($_POST['login_motDePasse']);

// Vérification des identifiants
$agentEnCours = Agent::findByMatriculeAndMotDePasse($loginMatricule, $loginMotDePasse);

if (!$agentEnCours) {
    header('Location: ../admin/?p=connexion&msg=inconnu');

} else {
    session_start();

    $_SESSION['id'] = $agentEnCours[0]->id;
    $_SESSION['nom'] = $agentEnCours[0]->nom_agent;
    $_SESSION['postnom'] = $agentEnCours[0]->postnom_agent;

    header('Location: ../admin/');
}
