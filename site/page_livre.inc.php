
<head>
<link rel="stylesheet" href="css/page_livre.inc.css"/>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $(".lire-la-suite").click(function() {
        $(this).next(".suite-cachee").show();
        $(this).hide();
      });
    });
  </script>
</head> 

<?php
if (isset($_GET["search"])){
    $search = $_GET["search"];
    $sql = "SELECT PROJ631_livre.*,PROJ631_auteur.nom_prenom_pseudo,PROJ631_auteur.id_auteur from PROJ631_livre join PROJ631_auteur on PROJ631_auteur.id_auteur = PROJ631_livre.id_auteur WHERE id_livre='".$search."'";
    $sqlavis="SELECT PROJ631_avis.* , PROJ631_utilisateur.pseudo FROM PROJ631_avis JOIN PROJ631_utilisateur ON PROJ631_avis.id_utilisateur = PROJ631_utilisateur.id_utilisateur WHERE id_livre ='".$search."'";
    $result = mysqli_query($conn, $sql);
    $resultAvis=mysqli_query($conn, $sqlavis);
}
else {
    echo "<div id='error-message'>";
    echo "<img src='../images/sad.png' alt='sad face'>";
    echo "<p>Erreur :(<br>Informations probablement erronées...</p>";
    echo "</div>";
    return;
}

if (mysqli_num_rows($result) == 0) {
    echo "<div id='error-message'>";
    echo "<img src='../images/sad.png' alt='sad face'>";
    echo "<p>Erreur :(<br>Informations probablement erronées...</p>";
    echo "</div>";
    return;
}

$row = mysqli_fetch_assoc($result);
echo "<div id=infos_auteur>";
//affichage image
echo "<div id='gauche'>";
echo "<div id='photo_auteur'>";
echo "<img src='../images/livre/".$row["image"].".jpg' alt='page de couverture'>";

echo "<div id='liste_oeuvres'>";
echo "<b>Auteur :</b>";
echo "<a href=?page=auteur&search=".$row["id_auteur"]."><h4>".$row["nom_prenom_pseudo"]."</h4></a>";
     
echo"</div>";
echo "</div></div>";

//affichage des info du livre 
echo "<div id='droite'>";
echo"<div id='test'>";
if ($_SESSION["connecte"]){
    $sql_dans_wishlist = "SELECT * FROM PROJ631_wishlist JOIN PROJ631_utilisateur ON PROJ631_utilisateur.id_utilisateur = PROJ631_wishlist.id_utilisateur WHERE PROJ631_utilisateur.pseudo = '".$_SESSION["identifiant"]."' AND id_livre = '".$_GET["search"]."'";
    $result_dans_wishlist = mysqli_query($conn, $sql_dans_wishlist);
    if (mysqli_num_rows($result_dans_wishlist) > 0) {
        

        //bouton pour retirer de la wishlist
        echo "<div><a href='?page=retirer_wishlist&search=".$_GET["search"]."' ><button class='bouton'>Retirer de la wishlist</button></a></div>";
        
    } else {
        //bouton pour ajouter à la wishlist
        echo "<div><a href='?page=ajouter_wishlist&search=".$_GET["search"]."'><button  class='bouton'>Ajouter à la wishlist</button></a></div>";

    
    }
    echo "<div id=publication_commentaire>";
    echo"<h5>Laissez un avis !</h5>";
    echo "<form action='?page=ajout_avis&search=".$row["id_livre"]."' method='post'>";
    echo "<label class='text'>note/5</label>";
    echo "<input type='text' name='note' id='note' >";
    echo "<label class='text'>commentaire</label>";
    echo "<input type='text' name='commentaire' id='commentaire'>";
    echo "<input type='submit' value='Publier' id='publier'>";
    echo "</form>";
    echo "</div>";
    
}
else {
    echo"<h4>Pour laisser un avis, connecte toi à ton compte !</h4>";
}

echo "</div>";
echo "<h2>".$row["titre"]."</h2>";
echo "<p><b>Année de parution: </b>" .$row["annee_parution"]."</p>";
echo "<p><b>Genre: </b>".$row["genre"]."</p>";


    //affichage du nom de l'auteur 
    
//affichage du res 
echo "<div id='bio'>";
echo "<h4>".$row["resume"]."</h4>";
echo"</div>";
echo"</div>";
//affichage des avis 
echo "</div>";




echo "<div id='lesAvis'>";
        while ( $rowAvis = mysqli_fetch_assoc($resultAvis) ) {
            echo "<div class='unAvis'>";
            echo"<h4 class='text'>".$rowAvis["pseudo"]."</h4>";
            echo "<img src='../images/avis/". $rowAvis["note"] ."stars.png' alt='rating' style='max-height: 20px;'>";
            //echo "<span class='commentaire'>" . $rowAvis["commentaire"] ." ". "</span>";
            echo "<span class='commentaire'>" . (strlen($rowAvis["commentaire"]) > 300 ? substr($rowAvis["commentaire"], 0, 300) . "<button class='lire-la-suite'>Lire la suite</button><span class='suite-cachee'>" . substr($rowAvis["commentaire"], 300) . "</span>" : $rowAvis["commentaire"]) . "</span>";
            echo "</div>";
          }
        echo "</div>";
        
    





















?>