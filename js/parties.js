function refreshParties() {
  // Effectuer une requête AJAX pour récupérer les parties
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Mettre à jour le contenu de la liste des parties
      document.getElementById("liste-parties").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "Liste_Parties.php", true);
  xhttp.send();
}

// Rafraîchir la liste des parties toutes les 30 secondes
setInterval(refreshParties, 3000);


