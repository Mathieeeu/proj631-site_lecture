<?php
$sql = "INSERT INTO PROJ631_avis (id_livre, id_utilisateur, note, commentaire) VALUES ('".$_GET["search"]."', (SELECT id_utilisateur FROM _PROJ631_utilisateur WHERE PROJ631_utilisateur.pseudo = '".$_SESSION["identifiant"]."'), '".$_POST["note"]."', \"".$_POST["commentaire"]."\")";
$result = mysqli_query($conn, $sql);
echo "<script>window.location.href='?page=livre&search=".$_GET["search"]."'</script>"


?>

