<?php
  $titre = $_POST["titre"];
  $description = $_POST["description"];
  $date_heure = $_POST["date_heure"];
  $nombre_joueurs = $_POST["nombre_joueurs"];

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

  // Insérer les données dans la table "parties"
  $sql = "INSERT INTO parties (titre, description, date_heure, nombre_joueurs)
          VALUES ('$titre', '$description', '$date_heure', '$nombre_joueurs')";

  if ($conn->query($sql) === TRUE) {
    $partie_id = $conn->insert_id;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
?>

<?php
header('Location: partie_lister.php');
exit;
?>
  