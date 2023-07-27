<?php

/* 
 * File: connexion
 * author: Ketsia
 */
require '../app/Autoloader.php';

app\Autoloader::register();

use app\table\Utilisateur;

$loginEmail = $_POST['login_email'];
$loginMotDePasse = sha1($_POST['login_mot_de_passe']);

// Vérification des identifiants
$utilisateurEnCours = Utilisateur::trouverParEmailEtMotDePasse($loginEmail, $loginMotDePasse);

if (!$utilisateurEnCours) {
    session_start();

    $_SESSION['erreur'] = 'E-mail ou mot de passe incorrect';

    header('Location: ../register');

} else {
    session_start();

    $_SESSION['id'] = $utilisateurEnCours[0]->id;
    $_SESSION['nom'] = $utilisateurEnCours[0]->nom;
    $_SESSION['postnom'] = $utilisateurEnCours[0]->post_nom;
    $_SESSION['prenom'] = $utilisateurEnCours[0]->prenom;

    header('Location: ../');
}
