<?php

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=jdr_forum', 'root', 'root');

// Récupération des données du formulaire
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$email = $_POST['email'];

// Préparation de la requête d'insertion
$stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");

// Liaison des variables de la requête avec les données du formulaire
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':email', $email);

// Exécution de la requête
$stmt->execute();

// Redirection vers la page de connexion
header('Location: login.php');
exit;
?>