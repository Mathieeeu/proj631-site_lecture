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
                    $_SESSION["connecte"]=true;
                    $_SESSION["identifiant"]=$_POST["id"];
                    echo "<script>alert('Inscription réussie ! :)')</script>";
                    echo "<script>window.location.href='?page=accueil'</script>";
                }
            }
            else{
                echo "<script>alert('Les mots de passe ne sont pas identiques ! :c')</script>";
                echo "<script>window.location.href='?page=inscription'</script>";
             }
        }
    }
?>