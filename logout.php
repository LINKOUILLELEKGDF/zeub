<?php
session_start();
// Supprimer les informations de session
session_unset();
// Détruire la session
session_destroy();
// Rediriger l'utilisateur vers la page de connexion
header('Location: login.php');
exit;
?>
