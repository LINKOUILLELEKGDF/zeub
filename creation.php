<html>
  <head>
    <title>Créer une nouvelle partie</title>
  </head>
  <body>
    <form action="creer_partie.php" method="post">
      <label for="titre">Titre:</label>
      <input type="text" id="titre" name="titre" required>
      <br>
      <label for="description">Description:</label>
      <textarea id="description" name="description"></textarea>
      <br>
      <label for="date_heure">Date et heure:</label>
      <input type="datetime-local" id="date_heure" name="date_heure" required>
      <br>
      <label for="nombre_joueurs">Nombre de joueurs:</label>
      <input type="number" id="nombre_joueurs" name="nombre_joueurs" min="1" required>
      <br>
      <input type="submit" value="Créer une partie">
    </form>
  </body>
</html>
