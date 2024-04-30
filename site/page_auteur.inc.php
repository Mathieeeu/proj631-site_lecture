<link rel="stylesheet" href="page_auteur.inc.css"/>

<?php
$sql = "SELECT * FROM auteur";
$result = mysqli_query($conn, $sql);
$val = mysqli_fetch_assoc($result);

echo "<b>Les auteurs</b><br>";
echo "<table style='min-width:500px;text-align:center'><tr><th>Photo</th><th>Auteur</th><th>Dates</th><th>Biographie</th></tr>";
?>
