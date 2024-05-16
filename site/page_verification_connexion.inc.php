<?php
if(isset( $_POST["connexion_ok"])){
  $sql="SELECT mot_de_passe FROM PROJ631_utilisateur WHERE pseudo LIKE '".$_POST["id"]."'";
  $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error( $conn )."\n".$sql);
  $val = mysqli_fetch_array($result);

  if (mysqli_num_rows($result) == 0){
    echo "<script>alert('Erreur - Utilisateur inconnu !')</script>";
    echo "<script>window.location.href='?page=inscription'</script>";
  }
  else if (password_verify($_POST['mdp'], $val['mot_de_passe'])){
    $_SESSION["connecte"]=true; 
    $_SESSION["identifiant"]=$_POST["id"];
    echo "<script>window.location.href='?page=accueil'</script>";
  }

  else{
    echo "<script>alert('Erreur - Identifiants incorrects !')</script>";
    echo "<script>window.location.href='?page=connexion'</script>";
  }
}
?>