 var rollDiceButton = document.getElementById("roll-dice");

  rollDiceButton.addEventListener("click", function(){
    var roll = Math.floor(Math.random() * 20) + 1; // génère un nombre aléatoire entre 1 et 20
    if(roll === 1){
      alert("Réussite critique !!");
    } else if(roll === 20) {
      alert("Échec critique !!");
    } else {
      alert("Vous avez obtenu un " + roll);
    }
  });