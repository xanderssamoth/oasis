<?php

/* 
 * File: deconnexion
 * author: Michael Matona
 */
session_start();

$_SESSION = array();

session_destroy();
// Supprimer tous les cookies de la connexion automatique
setcookie('nom', '');
setcookie('postnom', '');
header('Location: ../admin/');
?>
