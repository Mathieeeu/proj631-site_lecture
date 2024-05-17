/*Gestion de la session*/
<?php
if (!isset($_SESSION)){
    session_start([
        'cookie_lifetime' => 86400,
    ]);

    if (!isset($_SESSION["connecte"])){
        $_SESSION["connecte"] = false;
        $_SESSION["identifiant"] = "";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recto Verso</title>
    <html lang="fr">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/rectoverso.css">
</head>

<?php
    /* Connection à la bdd locale*/
    $url = "127.0.0.1";
    $user = "root";
    $password = "";
    $database = "proj631";
    $conn = @mysqli_connect($url, $user, $password);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } else {
        mysqli_select_db($conn, $database);
        mysqli_query($conn, "SET NAMES UTF8");
    }
?>

<body>
    <div id='Barre_horizontale'>

        <?php
        /*Si une personne connectée*/
        if($_SESSION["connecte"]) {
        echo "<a href='?page=compte'><img class=compte src = '../images/compte.png'   /></a>";
        echo "<a href='?page=accueil'><img class=home src = '../images/home.png' /></a>";
        echo "<a href='?page=deconnexion'><img class=deconnexion src = '../images/deconnexion.png' /></a>";
        echo "<h1>Recto Verso</h1> ";
        }
        else { /*Barre si pas de connexion*/
            echo "<a href='?page=accueil'><img class=home src = '../images/home.png' /></a>";
            echo "<a href='?page=connexion'><img class=login src = '../images/login.png'/></a>";
            echo "<a href='?page=inscription'><img class=inscription src = '../images/inscription.png' /></a>";
            echo "<h1>Recto Verso</h1>" ;
        }
        ?>

   <!-- Inclusion des pages -->
    </div>
    <div id="contenu">
      <?php
      if(!isset($_GET["page"]) ) { 
          $page="accueil"; //page accueil par défaut
      } else {
          $page=$_GET["page"];
      }

      if (file_exists("page_".$page.".inc.php")){
          include("page_".$page.".inc.php");
      }
      else{
          include("page_introuvable.inc.php");
      }
      ?>

    </div>
    <div id="pied">
        <hr> 
        <span>
        <?php
        if($_SESSION["connecte"]){
            echo "Connecté en tant que : ".$_SESSION["identifiant"]." - ";
        }
        else {
            echo "Non connecté</span> - ";
        }
        ?>
        Polytech Annecy-Chambéry - PROJ631 - Mini projet n°3</span>
    </div>
</body>
