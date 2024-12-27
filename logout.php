<?php
// Démarrer la session
session_start();

// Détruire toutes les variables de session
session_unset();
session_destroy();

// Rediriger vers la page de connexion
header("Location: login.php");
exit;
?>