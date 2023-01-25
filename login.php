<header>
        <a href="index.php"> Accueil</a>
    <h1> LE JDR DU FUN ! </h1>

<form method="post" action="login.php">
  <label for="username">Nom d'utilisateur :</label>
  <input type="text" name="username" id="username" required>
  <br>
  <label for="password">Mot de passe :</label>
  <input type="password" name="password" id="password" required>
  <br>
  <input type="submit" value="Connexion">
  <a href="inscription.html"> Vous n'avez pas de compte ? Créez-en un !
</form>

<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur a soumis un formulaire de connexion
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Connexion à la base de données
    $conn = mysqli_connect('localhost', 'root', 'root', 'jdr_forum');
    // Vérifier si la connexion à la base de données a réussi
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Préparer une requête pour récupérer les informations de l'utilisateur
    $stmt = mysqli_prepare($conn, "SELECT id, username, password FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $_POST['username']);
    // Exécuter la requête
    mysqli_stmt_execute($stmt);
    // Récupérer les résultats
    mysqli_stmt_bind_result($stmt, $id, $username, $password_hash);
    if (mysqli_stmt_fetch($stmt)) {
        // Vérifier si le mot de passe est correct
        if (password_verify($_POST['password'], $password_hash)) {
            // Démarrer une nouvelle session
            session_start();
            // Enregistrer des informations de session
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            // Rediriger l'utilisateur vers la page protégée
            header('Location: protected.php');
            exit;
        } else {
            // Afficher un message d'erreur
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } else {
        // Afficher un message d'erreur
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
    // Fermer la connexion à la base de données
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
