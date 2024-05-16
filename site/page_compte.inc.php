<head>
  <link rel="stylesheet" type="text/css" href="css/page_compte.css">
</head>

<?php 
    $logs = file("../logs.txt");
    $conn = @mysqli_connect("tp-epua:3308", substr($logs[0],0,-2), substr($logs[1],0,-2));
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } else {
        mysqli_select_db($conn, substr($logs[0],0,-2));
        mysqli_query($conn, "SET NAMES UTF8");
    }
?>

<?php

// $_SESSION["pseudo"]

// Recup user_pp (profil picture)
//$img_profil = "../images/".$_SESSION["pseudo"]."_pp.jpg";

$test_pseudo_pp = "bernard_tapin";
$img_profil = "../images/".$test_pseudo_pp."_pp.jpg";


// Affichage image de profil et pseudo
echo "
    <div> 
        <picture>
            <source media='(min-width: 650px)' srcset='{$img_profil}'>
            <source media='(min-width: 465px)' srcset='{$img_profil}'>
            <img src='{$img_profil}' alt='Profil pic' style='width: auto;'>
        </picture>
        <p>Bernard Tap-in</p>
    </div> 
";

echo "<div id='btn_avis_wishlist'>";
// Bouton wishlist et avis
echo "
        <form action='' method='get'>
        <input type='hidden' name='type_list' value='wishlist'>
        <button type='submit'>WISHLIST</button>
        </form>
        <form action='' method='get'>
        <input type='hidden' name='type_list' value='avis'>
        <button type='submit'>AVIS</button>
        </form>";

echo "</div>";

// Requetes pour la wishlist

//$sql = "SELECT l.titre, l.resume, l.annee_parution, l.genre, l.image FROM PROJ631_livre as l
//        JOIN PROJ631_wishlist as w ON l.id_livre = w.id_livre
//        WHERE id_utilisateur = ".$_SESSION['id_utilisateur'].";"
$sql = "SELECT l.titre, l.resume, l.annee_parution, l.genre, l.image FROM PROJ631_livre as l
        JOIN PROJ631_wishlist as w ON l.id_livre = w.id_livre
        WHERE id_utilisateur = 1";

$result_wishlist = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error( $conn )."\n".$sql);
//$val_wishlist = mysqli_fetch_assoc($result_wishlist);

// Requetes pour les avis
$sql = "SELECT note, commentaire FROM PROJ631_avis";
$result_avis = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error( $conn )."\n".$sql);
//$val_avis = mysqli_fetch_assoc($result_avis);




// Affichage boutons wishlist et avis
if(isset( $_GET["type_list"])) {
    if ($_GET["type_list"] == "wishlist") {
          
        echo "<div id='laWishlist'>";
        while ($row = mysqli_fetch_assoc($result_wishlist)) {
            echo "<div class='unWish'>";
            echo "<span>" . $row["titre"] ." ". "</span>";
            echo "<span>" . $row["resume"] ." ". "</span>";
            echo "<span>" . $row["annee_parution"] ." ". "</span>";
            echo "<span>" . $row["genre"] ." ". "</span>";
            echo "<span>" . $row["image"] ." ". "</span>";
            echo "<img src='" . $row["image"] . "' alt='book_pic' style='width: auto;'>";
            echo "</div>";
          }
        echo "</div>";
    } else if ($_GET["type_list"] == "avis") {
        echo "<div id='lesAvis'>";
        while ($row = mysqli_fetch_assoc($result_avis)) {
            echo "<div class='unAvis'>";
            echo "<span>" . $row["note"] ." ". "</span>";
            echo "<span>" . $row["commentaire"] ." ". "</span>";
            echo "</div>";
          }
        echo "</div>";
    }
}
?>