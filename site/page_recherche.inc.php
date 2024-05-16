<?php

    // Récupérer la requête de recherche
    $q = $_GET['q'];        

    // Se connecter à la base de données
    $logs = file("../logs.txt");
    $conn = @mysqli_connect("tp-epua:3308", substr($logs[0],0,-2), substr($logs[1],0,-2));
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } else {
        mysqli_select_db($conn, substr($logs[0],0,-2));
        mysqli_query($conn, "SET NAMES UTF8");
    }
    // Effectuer une recherche dans la base de données
    $requete = "SELECT * FROM PROJ631_livre WHERE titre LIKE " .$q;
    $result = mysqli_query($conn, $sql);
    // Afficher les résultats de la recherche
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<p>' . $row['titre'] . '</p>';
    }

?>


<form action="" method="get">
  <input type="text" name="q" placeholder="Rechercher...">
  <button type="submit">Rechercher</button>
</form>