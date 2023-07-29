<?php

/* 
 * File: deconnexion
 * author: Ketsia
 */

session_start();

$_SESSION = array();

session_destroy();
// Supprimer tous les cookies créés pendant la session
setcookie('id', '');
setcookie('reussi', '');
setcookie('erreur', '');
// Rédiriger vers l'accueil
header('Location: ../');
?>
