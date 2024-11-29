<?php
if(isset( $_POST["connexion_ok"])){ //si bouton cliqué
  $sql="SELECT mot_de_passe FROM _PROJ631_utilisateur WHERE pseudo LIKE '".$_POST["id"]."'";
  $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error( $conn )."\n".$sql);
  $val = mysqli_fetch_array($result);

  if (mysqli_num_rows($result) == 0){ //si pas de résultat (utilisateur n'existe pas)
    echo "<script>alert('Erreur - Utilisateur inconnu !')</script>";
    echo "<script>window.location.href='?page=inscription'</script>"; //redirection page inscription
  }
  else if (password_verify($_POST['mdp'], $val['mot_de_passe'])){ //si mot de passe rentré est le même que celui enregistré
    //initialisation de la session
    $_SESSION["connecte"]=true; 
    $_SESSION["identifiant"]=$_POST["id"];
    echo "<script>window.location.href='?page=accueil'</script>"; //redirection page accueil
  }

  else{ //Si 
    echo "<script>alert('Erreur - Identifiants incorrects !')</script>";
    echo "<script>window.location.href='?page=connexion'</script>"; 
  }
}
?>