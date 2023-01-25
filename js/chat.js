function getMessages(){
  // 1. Elle doit créer une requête AJAX pour se connecter au serveur, et notamment au fichier handler.php
  const requeteAjax = new XMLHttpRequest();
  requeteAjax.open("GET", `handler.php`);

  // 2. Quand elle reçoit les données, il faut qu'elle les traite (en exploitant le JSON) et il faut qu'elle affiche ces données au format HTML
  requeteAjax.onload = function(){
    const resultat = JSON.parse(requeteAjax.responseText);
    const html = resultat.reverse().map(function(message){
      return `
        <div class="message">
          <span class="date">${message.date_heure.substring(11, 16)}</span>
          <span class="auteur">${message.auteur}</span> : 
          <span class="contenu">${message.contenu}</span>
          </div>
          `
        }).join('');
    
        const messages = document.querySelector('.messages');
    
        messages.innerHTML = html;
        messages.scrollTop = messages.scrollHeight;
      }
    
      // 3. On envoie la requête
      requeteAjax.send();
    }
    
    /**
     * Il nous faut une fonction pour envoyer le nouveau
     * message au serveur et rafraichir les messages
     */
    
    function postMessage(event){
      // Stop the submit of the form
      event.preventDefault();
    
      // Get the data from the form
      const auteur = document.querySelector('#auteur');
      const contenu = document.querySelector('#contenu');
    
      // Prepare the data
      const data = new FormData();
      data.append('auteur', auteur.value);
      data.append('contenu', contenu.value);
    
      // Create the AJAX request
      const requeteAjax = new XMLHttpRequest();
      requeteAjax.open('POST', 'handler.php?task=write');
    
      requeteAjax.onload = function(){
        // Clear the input fields and focus on the author field
        auteur.value = '';
        contenu.value = '';
        auteur.focus();
    
        // Get the messages again and update the messages area
        getMessages();
      }
    
      // Send the request
      requeteAjax.send(data);
    }
    