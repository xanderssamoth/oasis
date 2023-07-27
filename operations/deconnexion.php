<?php

/* 
 * File: deconnexion
 * author: Ketsia
 */
session_start();

$_SESSION = array();

session_destroy();
// Supprimer tous les cookies de la connexion automatique
setcookie('id', '');
setcookie('nom', '');
setcookie('postnom', '');
setcookie('prenom', '');
setcookie('reussi', '');
setcookie('erreur', '');
header('Location: ../');
?>
