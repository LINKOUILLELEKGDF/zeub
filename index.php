<?php 
session_start()

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <a href="index.php"> Accueil</a>
    <h1> LE JDR DU FUN ! </h1>

    <?php
if (isset($_SESSION['username'])) {
    echo "Bienvenue, <a href='protected.php'>" . $_SESSION['username'] . "</a>";
} else {
    echo "Connectez-vous <a href='login.php'>ici</a>";
}
?>


</header>

<form action="creation.php">
    <input type="submit" value="Créez votre partie !" />
</form>

<form action="partie_lister.php">
    <input type="submit" value="Rejoignez une partie !" />
</form>

</body>
</html>