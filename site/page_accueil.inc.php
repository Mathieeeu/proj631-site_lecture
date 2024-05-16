<?php
if($_SESSION["connecte"]){
    echo "<h1>Bonjour ".$_SESSION["identifiant"]."</h1>";
}
else {
    echo "<h1>Bonjour étranger</h1>";
}
?>
