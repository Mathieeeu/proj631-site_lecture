<?php
if (isset($_GET["search"])){
    $search = $_GET["search"];
    $sql = "SELECT PROJ631_livre.*,PROJ631_auteur.nom_prenom_pseudo from PROJ631_livre join PROJ631_auteur on PROJ631_auteur.id_auteur = PROJ631_livre.id_auteur WHERE id_livre='".$search."'";
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

//affichage image
echo "<img src='../images/livre/".$row["image"].".jpg' alt='page de couverture'>";


//affichage des info du livre 
echo "<h2>".$row["titre"]."</h2>";
echo "<h2>".$row["annee_parution"]."</h2>";
echo "<h2>".$row["genre"]."</h2>";


    //affichage de l'auteur l'auteur 
    echo "<h2>".$row["nom_prenom_pseudo"]."</h2>";
//affichage du res 
echo "<h2>".$row["resume"]."</h2>";


//affichage des avis 

echo "<div id='lesAvis'>";
        while ( $rowAvis = mysqli_fetch_assoc($resultAvis)) {
            echo "<div class='unAvis'>";
            echo"<h4>".$rowAvis["pseudo"]."</h4>";
            echo "<img src='../images/avis/". $rowAvis["note"] ."stars.png' alt='rating' style='max-height: 20px;'>";
            echo "<span class='commentaire'>" . $rowAvis["commentaire"] ." ". "</span>";
            echo "</div>";
          }
        echo "</div>";
    





















?>