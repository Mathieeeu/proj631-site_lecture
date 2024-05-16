<!DOCTYPE html>
<html>
<head>
    <title>Recto Verso</title>
    <html lang="fr">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style_accueil.css">
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

<body>
    <div id='Barre_horizontale'>
        <?php
        if(1==1) {
        echo "<img class=compte src = '../images/compte.png'  />";
        echo "<img class=home src = '../images/home.png'  />";
        echo "<img class=deconnexion src = '../images/deconnexion.png'  />";
        echo "<h1>Recto Verso</h1> ";
        }
        else {
            echo "<img class=home src = '../images/home.png' />";
            echo "<img class=login src = '../images/login.png' />";
            echo "<img class=inscription src = '../images/inscription.png' />";
            echo "<h1>Recto Verso</h1>" ;
        }
        ?>
        
    </div>

    
    <div id="contenu">
      <?php
      if(!isset($_GET["page"]) ) { 
          $page="connexion";
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
        <span> Polytech Annecy-Chambéry - PROJ631 - Mini projet n°3</span>
    </div>
</body>
