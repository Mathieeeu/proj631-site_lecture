<link rel="stylesheet" href="page_auteur.inc.css"/>

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
$sql = "SELECT * FROM PROJ631_auteur";
$result = mysqli_query($conn, $sql);

echo "<h2>Les auteurs</h2><br>";
echo "<div id='table_auteurs'><table style='min-width:500px;text-align:center'><tr><th>Photo</th><th>Auteur</th><th>Dates</th><th>Biographie</th></tr>";

while($val = mysqli_fetch_assoc($result)){
    echo "<tr><td><img src='".$val['photo']."' alt='alt: ".$val['nom_prenom_pseudo']."' style='max-width:100px;max-height:100px'></td>";
    echo "<td>".$val['nom_prenom_pseudo']."</td>";
    $annee_naissance = date('Y', strtotime($val['date_naissance']));
    $annee_deces = date('Y', strtotime($val['date_deces']));
    echo "<td>".$annee_naissance." - ".$annee_deces."</td>";
    echo "<td>".$val['biographie']."</td></tr>";
}
echo "</table></div>"

?>
