<link rel="stylesheet" href="css/page_accueil.inc.css"/>

<div class='accueil'>
<?php
    
    echo "<form action='' method='get' class='search'>";
    if (isset($_GET["q"])) {
        echo "<input type='text' name='q' placeholder='Rechercher...' value = ". $_GET["q"] . ">  </input>";
    }
    else {
        echo "<input type='text' name='q' placeholder='Rechercher...'></input>";
    }
    echo "<button type='submit'>Rechercher</button>";
    echo "</form>";
    echo "<div>";
    if (isset($_GET["q"])) {
        // Récupérer la requête de recherche
        $q = $_GET["q"];        

        // Effectuer une recherche dans la base de données
        $requete_livre = "SELECT * FROM PROJ631_livre WHERE titre LIKE '%" .$q."%'";
        $result_livre = mysqli_query($conn, $requete_livre);
        
        // Afficher les résultats de la recherche
        while ($row = mysqli_fetch_assoc($result_livre)) {
            $sql = "SELECT id_livre,image FROM PROJ631_livre WHERE id_livre = ".$row['id_livre']."";
            $result= mysqli_query($conn, $sql);
            $val = mysqli_fetch_assoc($result);
            echo '<diV class=livre>';
            echo "<a href ='?page=livre&search=".$val['id_livre']."'> ". $row['titre']. "</a>";
            echo "<img src='../images/livre/".$val["image"].".jpg' alt='photo livre'>";
            echo '</div>';
        }
        //Recherche les auteurs
        $requete_auteur = "SELECT * FROM PROJ631_auteur WHERE nom_prenom_pseudo LIKE '%" .$q."%'";
        $result_auteur = mysqli_query($conn, $requete_auteur);
        // Afficher les résultats de la recherche
        while ($row2 = mysqli_fetch_assoc($result_auteur)) {
            $sql_auteur = "SELECT id_auteur,photo FROM PROJ631_auteur WHERE id_auteur = ".$row2['id_auteur']."";
            $result_auteur= mysqli_query($conn, $sql_auteur);
            $val_auteur = mysqli_fetch_assoc($result_auteur);
            echo '<diV class=auteur>';
            echo "<a href ='?page=auteur&search=".$val_auteur['id_auteur']."'> ". $row2['nom_prenom_pseudo']. "</a>";
            echo "<img src='../images/auteur/".$val_auteur["photo"].".jpg' alt='photo auteur'>";
            echo '</div>';
            
        }
    }
    else{
      $sql = "SELECT * FROM PROJ631_livre LIMIT 3";
      $result = mysqli_query($conn, $sql); 
      while ($val = mysqli_fetch_assoc($result)){
        echo '<diV class=livre>';
        echo "<a href ='?page=livre&search=".$val['id_livre']."'> ". $val['titre']. "</a>";
        echo "<img src='../images/livre/".$val["image"].".jpg' alt='photo livre'>";
        echo '</div>';
      }
    }
?>
</div>