<?php
  // Connexion à la base de données
  $host = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "jdr_forum";

  $conn = new mysqli($host, $username, $password, $dbname);

  // Vérifier la connexion
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Sélectionner toutes les parties de la table "parties"
  $sql = "SELECT * FROM parties";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $parties = array();
    while($row = $result->fetch_assoc()) {
      $parties[] = $row;
    }
  } else {
    echo "Aucune partie n'a été créée.";
  }
  $conn->close();
?>

<html>
  <head>
    <title>Liste des parties</title>
  </head>
  <body>
    <div id="liste-parties">
      <?php foreach ($parties as $partie) { ?>
        <div class="partie">
          <h3>Titre: <a href="partie.php?id=<?= $partie["id"] ?>"><?= $partie["titre"] ?></a></h3>
          <p>Description: <?= $partie["description"] ?></p>
          <p>Date et heure: <?= $partie["date_heure"] ?></p>
        <p>Nombre de joueurs: <?= $partie["nombre_joueurs"] ?></p>
        </div>
    <?php } ?>
    </div>
</body>
</html>