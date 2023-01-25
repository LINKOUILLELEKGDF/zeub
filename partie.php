<?php 

session_start()

?>
  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Notre super chat !</title>
</head>
<body>

<header>
        <a href="index.php"> Accueil</a>
    <h1> LE JDR DU FUN ! </h1>
</header>


</form>

</div>
 <body>

      <?php 
        // Récupération de l'ID de la partie à partir de l'URL
        $partie_id = $_GET["id"];

        // Connexion à la base de données
        $host = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "jdr_forum";
        $conn = mysqli_connect($host, $username, $password, $dbname);

        // Vérification de la connexion
        if (!$conn) {
          die("Connexion échouée: " . mysqli_connect_error());
        }

        // Requête SQL pour récupérer les messages de la partie spécifique
        $sql = "SELECT contenu, auteur, date_heure FROM messages WHERE partie_id = $partie_id";
        $result = mysqli_query($conn, $sql);

        // Stocker les résultats de la requête dans un tableau PHP
        $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Boucle pour afficher chaque message
        foreach ($messages as $message) {
          echo "<p>";
          echo "<strong>" . $message["auteur"] . "</strong>";
          echo "<br>" . $message["contenu"];
          echo "<br>" . $message["date_heure"];
          echo "</p>";
        }

        // Libération des résultats
        mysqli_free_result($result);

        // Fermeture de la connexion à la base de données
        mysqli_close($conn);
      ?>

  </body>
</html>

<section class="chat">
    <div class="messages">
     
    <div class="user-inputs">
      <form action="handler.php?task=write" method="POST">
        <input type="text" name="auteur" id="auteur" placeholder="Votre pseudo">
        <input type="text" id="contenu" name="contenu" placeholder="Écrivez votre message">
        <button type="submit">🔥 Send !</button>
      </form>

      </form>
    </div>
    </div>
  </section>
  <button id="roll-dice">Lancer le dé</button>

  </body>
  <script src="js/chat.js"></script>
  <script src="js/dé.js"></script>
</html>