<head>
  <link rel="stylesheet" type="text/css" href="css/page_compte.inc.css">
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
$pseudo_oskour = "camasl";
$pseudo = $_SESSION['identifiant'];
// Recup user_pp (profil picture)
//$img_profil = "../images/".$_SESSION["pseudo"]."_pp.jpg";

$test_pseudo_pp = "bernard_tapin";
$img_profil = "../images/".$test_pseudo_pp."_pp.jpg";


// Affichage image de profil, pseudo et date d'inscription
$sql = "SELECT id_utilisateur, date_inscription FROM PROJ631_utilisateur WHERE pseudo = '".$pseudo."'";
$result_date = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error( $conn )."\n".$sql);
$val_date = mysqli_fetch_assoc($result_date);

echo "<div id='debut'> ";
echo "
<div id='container_info_user'> 
    <div id='info_user'> 
        <picture>
            <source media='(min-width: 650px)' srcset='{$img_profil}'>
            <source media='(min-width: 465px)' srcset='{$img_profil}'>
            <img id='pfp' src='{$img_profil}' alt='Profil pic' style='width: auto;'>
        </picture>
        <p> Pseudo : ". $pseudo ."</p>
        <p> Date d'inscription : ". $val_date["date_inscription"] ."</p>
    </div> 
    <div id='decoration_user'> 
    </div> 
</div> 
";


echo "<div id='btn_avis_wishlist'>";
// Bouton wishlist et avis
echo "
        <form action='' method='get'>
        <input type='hidden' name='page' value='compte'>
        <input type='hidden' name='type_list' value='wishlist'>
        <button type='submit'>WISHLIST</button>
        </form>
        <form action='' method='get'>
        <input type='hidden' name='page' value='compte'>
        <input type='hidden' name='type_list' value='avis'>
        <button type='submit'>AVIS</button>
        </form>";
echo "</div>";

// Requetes pour la wishlist

//$sql = "SELECT l.titre, l.resume, l.annee_parution, l.genre, l.image FROM PROJ631_livre as l
//        JOIN PROJ631_wishlist as w ON l.id_livre = w.id_livre
//        WHERE id_utilisateur = ".$_SESSION['identifiant'].";"
$sql = "SELECT l.titre, l.resume, l.annee_parution, l.genre, l.image, au.nom_prenom_pseudo
        FROM PROJ631_livre as l
        JOIN PROJ631_wishlist as w ON l.id_livre = w.id_livre
        JOIN PROJ631_auteur au ON au.id_auteur = l.id_auteur
        WHERE id_utilisateur = ".$val_date["id_utilisateur"].";";

$result_wishlist = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error( $conn )."\n".$sql);
//$val_wishlist = mysqli_fetch_assoc($result_wishlist);

// Requetes pour les avis
$sql = "SELECT a.note, a.commentaire, l.titre, l.annee_parution, au.nom_prenom_pseudo FROM PROJ631_avis a 
JOIN PROJ631_utilisateur u ON u.id_utilisateur = a.id_utilisateur 
JOIN PROJ631_livre l ON l.id_livre = a.id_livre
JOIN PROJ631_auteur au ON au.id_auteur = l.id_auteur
WHERE pseudo ='".$pseudo."'";
$result_avis = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error( $conn )."\n".$sql);
//$val_avis = mysqli_fetch_assoc($result_avis);


// Affichage boutons wishlist et avis
if(isset( $_GET["type_list"])) {
    if ($_GET["type_list"] == "wishlist") {
        if (mysqli_num_rows($result_wishlist) > 0) {
            echo "<div id='laWishlist'>";
            while ($row = mysqli_fetch_assoc($result_wishlist)) {
                echo "<div class='unWish'>";
                    echo "<div class='info_livre'>";
                        echo "<div> Titre : " . $row["titre"] ." ". "</div><br>";
                        echo "<div> Résumé : " . $row["resume"] ." ". "</div><br>";
                        echo "<div> Auteur : " . $row["nom_prenom_pseudo"] ." ". "</div><br>";
                        echo "<div> Année de parution : " . $row["annee_parution"] ." ". "</div><br>";
                        echo "<div> Genre : " . $row["genre"] ." ". "</div><br>";
                    echo "</div>";
                    echo "<div class='photo'>";
                        echo "<img src='../images/livre/".$row["image"] . ".jpg' alt='book_pic' style='max-height: 200px;'>";
                    echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<p>Aucun résultat trouvé.</p>";
        }
    } else if ($_GET["type_list"] == "avis") {
        if (mysqli_num_rows($result_wishlist) > 0) {
            echo "<div id='lesAvis'>";
            while ($row = mysqli_fetch_assoc($result_avis)) {
                echo "<div class='unAvis'>";
                    echo "<div class='infoAvis'>";
                        echo "<div> Titre : " . $row["titre"] ." ". "</div>";
                        echo "<div> Année de parution : " . $row["annee_parution"] ." ". "</div>";
                        echo "<div> Auteur : " . $row["nom_prenom_pseudo"] ." ". "</div>";
                        echo "<img src='../images/avis/". $row["note"] ."stars.png' alt='rating' style='max-height: 20px;'>";

                    echo "</div>";
                    //echo "<span class='commentaire'>" . $row["commentaire"] ." ". "</span>";
                    echo "<span class='commentaire'>" . (strlen($row["commentaire"]) > 300 ? substr($row["commentaire"], 0, 300) . "<button class='lire-la-suite'>Lire la suite</button><span class='suite-cachee'>" . substr($row["commentaire"], 300) . "</span>" : $row["commentaire"]) . "</span>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<p>Aucun résultat trouvé.</p>";
        }
    }
}
echo "</div> ";
?>