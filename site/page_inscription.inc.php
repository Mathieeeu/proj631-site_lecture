<?php
    echo "<div class='containter'><h1>Inscription</h1>";
    echo "<form action='?page=accueil' method='post'>";
    echo "<input type='text' name='id' placeholder='Identifiant' required><br/>";
    echo "<input type='password' name='mdp1' placeholder='Mot de passe' required><br>";
    echo "<input type='password' name='mdp2' placeholder='Confirmer mot de passe' required><br>";
    echo "<input type='submit' value='Valider'>";
    echo "</div>";
?>