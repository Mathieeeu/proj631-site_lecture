<?php
$sql = "DELETE FROM `PROJ631_wishlist` WHERE `id_livre` = '".$_GET["search"]."' AND `id_utilisateur` = (SELECT id_utilisateur FROM _PROJ631_utilisateur WHERE PROJ631_utilisateur.pseudo = '".$_SESSION["identifiant"]."')";
$result = mysqli_query($conn, $sql);
echo "<script>window.location.href='?page=livre&search=".$_GET["search"]."'</script>"
?>