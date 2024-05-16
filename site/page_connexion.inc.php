<head>

<link rel="stylesheet" type="text/css" href="css/page_connexion.css">
</head>

<body>

<div id=principal>

  <div id=requete>
    <div> 
      <h2 id= textprincipal>Connexion</h2>
    </div> 
  
  <div class="container">
  <form method='post' action='?page=verification_connexion'>
  <input class= champRecherche type='text' name='id' placeholder='Identifiant' required><br/>
  <input class= champRecherche type='password' name='mdp' placeholder='Mot de passe' required></br>
  <button  class="bouton" name='connexion_ok' type='submit' value="Popup">Connexion</button>
  </form>
  <button class="bouton">
    <a href="?page=inscription" class="bouton">Inscription</a>
  </button>
  </div>

</div>
</div>
</body>
