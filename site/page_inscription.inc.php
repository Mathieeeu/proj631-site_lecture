<head>
<link rel="stylesheet" type="text/css" href="css/page_inscription.inc.css">
</head>

<body>

<div id=principal>

  <div id=requete>
    <div> 
      <h2 id= textprincipal>Inscription</h2>
    </div> 

    <div class="container">
    <?php
    //Formulaire inscription
        echo "<form action='?page=verification_inscription' method='post'>";
        echo "<input class= champRecherche type='text' name='id' placeholder='Identifiant' required><br/>";
        echo "<input class= champRecherche type='password' name='mdp1' placeholder='Mot de passe' required><br>";
        echo "<input class= champRecherche type='password' name='mdp2' placeholder='Confirmer mot de passe' required><br>";
        echo "<input class='bouton' type='submit' value='Valider'>";
    ?>

</div>

</div>
</div>
</body>
