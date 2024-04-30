<!DOCTYPE html>

<html>
<head>
    <title>Recto Verso</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<?php 
    $conn = @mysqli_connect("tp-epua:3308", "docherm", "lsldGmJz");
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } else {
        mysqli_select_db($conn, "camasl");
        mysqli_query($conn, "SET NAMES UTF8");
    }
?>

<body>
    <div id="entete">
        <h1>Recto Verso</h1>
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
          echo "Page non trouvée";
      }
      ?>
    </div>
    <div id="pied">
        <span> Polytech Annecy-Chambéry - PROJ631 - Mini projet n°3</span>
    </div>
</body>
