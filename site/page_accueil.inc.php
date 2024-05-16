<?php
    if (isset($_POST["id"]) && isset($_POST["mdp1"]) && isset($_POST["mdp2"])){
        $sql1 = "SELECT pseudo FROM PROJ631_utilisateur WHERE pseudo LIKE '".$_POST["id"]."'";
        $result1 = mysqli_query($conn, $sql1);
        if(mysqli_num_rows($result1) != 0){
            echo "<script>alert('Identifiant déjà pris ! :c')</script>";
            echo "<script>window.location.href='?page=inscription'</script>";
        }
        else{
            if ($_POST["mdp1"] == $_POST["mdp2"]){
                $sql = "INSERT INTO PROJ631_utilisateur (pseudo,mot_de_passe,date_inscription) VALUES('".$_POST['id']."','".password_hash($_POST["mdp1"], PASSWORD_DEFAULT)."', NOW())";
                $result = mysqli_query($conn, $sql);

                $sql_verif = "SELECT* FROM PROJ631_utilisateur WHERE pseudo LIKE '".$_POST["id"]."'";
                $result_verif = mysqli_query($conn, $sql_verif);
                if (mysqli_num_rows($result_verif) == 0){
                    echo "<script>alert('Erreur liée à la base de données... :c')</script>";
                    echo "<script>window.location.href='?page=inscription'</script>";
                }
                else{
                    echo "<script>alert('Inscription réussie ! :)')</script>";
                }
            }
            else{
                echo "<script>alert('Les mots de passe ne sont pas identiques ! :c')</script>";
                echo "<script>window.location.href='?page=inscription'</script>";
             }
        }
    }
?>
<form action="" method="get">
  <input type="text" name="q" placeholder="Rechercher...">
  <button type="submit">Rechercher</button>
</form>
<div>
<?php
    if (isset($_GET["q"])) {
        // Récupérer la requête de recherche
        $q = $_GET["q"];        

        // Se connecter à la base de données
        $logs = file("../logs.txt");
        $conn = @mysqli_connect("tp-epua:3308", substr($logs[0],0,-2), substr($logs[1],0,-2));
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        } else {
            mysqli_select_db($conn, substr($logs[0],0,-2));
            mysqli_query($conn, "SET NAMES UTF8");
        }
        // Effectuer une recherche dans la base de données
        $requete = "SELECT * FROM PROJ631_livre WHERE titre LIKE '" .$q."%'";
        $result = mysqli_query($conn, $requete);
        // Afficher les résultats de la recherche
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<p>' . $row['titre'] . '</p>';
        }
    }
?>
</div>

