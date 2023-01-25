<?php
date_default_timezone_set('Europe/Paris');

/**
 * Connexion simple à la base de données via PDO !
 */
$db = new PDO('mysql:host=localhost;dbname=jdr_forum;charset=utf8', 'root', 'root', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

$task = "list";

if(array_key_exists("task", $_GET)){
  $task = $_GET['task'];
}

if($task == "write"){
  postMessage();
} else {
  getMessages();
}

/**
 * Si on veut récupérer, il faut envoyer du JSON
 */
function getMessages(){
  global $db;
  // 1. On requête la base de données pour sortir les 20 derniers messages
  $resultats = $db->query("SELECT * FROM messages ORDER BY date_heure DESC LIMIT 20");
  // 2. On traite les résultats
  $messages = $resultats->fetchAll();
  // 3. On affiche les données sous forme de JSON
  echo json_encode($messages);
}
/**
 * Si on veut écrire au contraire, il faut analyser les paramètres envoyés en POST et les sauver dans la base de données
 */
function postMessage(){
  global $db;

  // Récupération de l'ID de la partie à partir de l'URL
  if(array_key_exists("id", $_GET)){
    $id = $_GET["id"];
    $connard = $db->prepare("SELECT id FROM Parties WHERE id = :id");
    $connard->execute(array('id' => $id));
    $parties = $connard->fetch();
  }

  // Analyser les paramètres passés en POST (author, content)
  if(!array_key_exists('auteur', $_POST) || !array_key_exists('contenu', $_POST)){

    echo json_encode(["status" => "error", "message" => "One field or many have not been sent"]);
    return;
  }

  $auteur = $_POST['auteur'];
  $contenu = $_POST['contenu'];

  // Insertion du message dans la base de données
  $stmt = $db->prepare("INSERT INTO messages (contenu, auteur, date_heure, partie_id) VALUES (?, ?, ?, ?)");
  $stmt->execute([$contenu, $auteur, date("Y-m-d H:i:s"), $id]);
  echo json_encode(["status" => "success", "message" => "Message added"]);
}
