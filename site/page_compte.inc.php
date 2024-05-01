<style>

</style>

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


// Bouton wishlist et avis
echo "
    <div> 
        <form action='' method='get'>
        <input type='hidden' name='type_list' value='wishlist'>
        <button type='submit'>WISHLIST</button>
        </form>
        <form action='' method='get'>
        <input type='hidden' name='type_list' value='avis'>
        <button type='submit'>AVIS</button>
        </form>
    </div> 
";

// Affichage boutons wishlist et avis
if(isset( $_GET["type_list"])) {
    if ($_GET["type_list"] == "wishlist") {
        echo "
        Vous verrez apparaitre ici une wishlist
        ";
    } else if ($_GET["type_list"] == "avis") {
        echo "
        Vous verrez apparaitre ici des avis
        ";
    }
}
?>