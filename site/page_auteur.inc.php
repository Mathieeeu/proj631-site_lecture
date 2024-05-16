<link rel="stylesheet" href="css/page_auteur.inc.css"/>

<?php
/*
    Format table 'PROJ631_auteur':
    id_auteur INT,
    nom_prenom_pseudo VARCHAR,
    date_naissance DATE,
    date_deces DATE,
    biographie TEXT,
    photo VARCHAR,
*/

if (isset($_GET["search"])){
    $search = $_GET["search"];
    $sql = "SELECT * FROM PROJ631_auteur WHERE id_auteur = '".$search."'";
    $result = mysqli_query($conn, $sql);
    
}
else {
    echo "<div id='error-message'>";
    echo "<img src='../images/sad.png' alt='sad face'>";
    echo "<p>Erreur :(<br>Informations probablement erronées...</p>";
    echo "</div>";
    return;
}
if (mysqli_num_rows($result) == 0) {
    echo "<div id='error-message'>";
    echo "<img src='../images/sad.png' alt='sad face'>";
    echo "<p>Erreur :(<br>Informations probablement erronées...</p>";
    echo "</div>";
    return;
}
echo "<div id=infos_auteur>";
$row = mysqli_fetch_assoc($result);

// Organisation en deux colonnes, une pour l'image et une pour les informations, display flex
// Photo de l'auteur et livres à gauche
echo "<div id='gauche'>";
echo "<div id='photo_auteur'>";
echo "<img src='../images/auteur/".$row["photo"].".jpg' alt='photo auteur'>";
echo "</div>";
echo "<p><b>".$row["nom_prenom_pseudo"]."</b></p>";

// afficher la liste des oeuves de l'auteur
echo "<div id='liste_oeuvres'>";
echo "<b>Oeuvres de l'auteur :</b>";
$sql = "SELECT id_livre,titre FROM PROJ631_livre WHERE id_auteur = '".$search."'";
$result = mysqli_query($conn, $sql);
$i = 0;
echo "<ul>";
while ($i<10 && $livre = mysqli_fetch_assoc($result)) {
    echo "<li><a href=?page=livre&search=".$livre["id_livre"].">".$livre["titre"]."</a></li>";
    $i++;
}
echo "</ul>";
echo "</div>";
echo "</div>";

// Informations de l'auteur à droite
setlocale(LC_TIME, 'fr_FR.utf8','fra');
$date_naissance = strftime('%d %B %Y', strtotime($row["date_naissance"]));
$date_deces = strftime('%d %B %Y', strtotime($row["date_deces"]));
echo "<div id='droite'>";
echo "<h2>".$row["nom_prenom_pseudo"]."</h2>";
echo "<p><b>Date de naissance:</b> ".$date_naissance."</p>";
echo "<p><b>Date de décès:</b> ".$date_deces."</p>";
echo "<div id='bio'><p><b>Biographie:<br></b> ".$row["biographie"]."</p></div>";
echo "</div></div>";
?>
