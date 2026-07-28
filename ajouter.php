<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php

    if(isset($_POST["envoyer"])){

        require("conf.php");  
        $con = ouvrirRD();
        $categorie=$_POST["categorie"];
        $sql="INSERT INTO `categories`( `nomcategorie`) VALUES('$categorie')";
        $resultat = mysqli_query($con, $sql);

        if ($resultat) {
            header("location:ajouter_categorie.php?success=1");
        } else {
            header("location:ajouter_categorie.php?success=0");
        }
        exit();
    }
    ?>
    <?php
        echo $categorie ?? '';
    ?>  
</body>
</html>