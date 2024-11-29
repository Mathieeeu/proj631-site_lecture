<?php
$sql = "INSERT INTO `PROJ631_wishlist` (`id_livre`, `id_utilisateur`) VALUES ('".$_GET["search"]."', (SELECT id_utilisateur FROM _PROJ631_utilisateur WHERE PROJ631_utilisateur.pseudo = '".$_SESSION["identifiant"]."'))";
$result = mysqli_query($conn, $sql);
echo "<script>window.location.href='?page=livre&search=".$_GET["search"]."'</script>"
?>