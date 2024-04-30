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

if (!isset($_GET["search"])){
    $sql = "SELECT * FROM PROJ631_auteur";
    $result = mysqli_query($conn, $sql);
}
else {
        $search = $_GET["search"];
        $sql = "SELECT * FROM PROJ631_auteur WHERE nom_prenom_pseudo LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);
}

echo "<div id='recherche'><h2>Recherche<h2>";
echo "<form action='rectoverso.php?page=auteur' method='get'>";
echo "<input type='hidden' name='page' value='auteur'>";
if (isset($_GET["search"])){
    echo "<input id='textbox' type='text' name='search' value='".$_GET["search"]."'>";
}
else {
    echo "<input id='textbox' type='text' name='search' placeholder='Rechercher un auteur'>";
}
echo "<input id='submit' type='submit' value='Rechercher'>";
echo "</form>";
echo "</div>";

echo "<div id='liste_auteurs'><h2>Liste des auteurs</h2>";

if (mysqli_num_rows($result) == 0) {
    echo "<div id='error-message'>";
    echo "<img src='../images/sad.png' alt='sad face'>";
    echo "<p>Aucun auteur trouvé avec ce nom  :(</p>";
    echo "</div>";
}
else {
    echo "<table><tr><th>Photo</th><th>Auteur</th><th>Dates</th><th>Biographie</th></tr>";

    while($val = mysqli_fetch_assoc($result)){
        
        echo "<tr><td><img src='".$val['photo']."' alt='alt: ".$val['nom_prenom_pseudo']."'></td>";
        echo "<td>".$val['nom_prenom_pseudo']."</td>";
        $annee_naissance = date('Y', strtotime($val['date_naissance']));
        $annee_deces = date('Y', strtotime($val['date_deces']));
        echo "<td>".$annee_naissance." - ".$annee_deces."</td>";
        echo "<td>".$val['biographie']."</td></tr>";
    }
    echo "</table></div>";
}

?>
