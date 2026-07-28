<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/different_list.css"/>
    <title>Document</title>
</head>
<body>
<?php

if(isset($_POST["Modifier"])){

    require("conf.php");  
    $con = ouvrirRD();
    $id=addslashes($_POST["idd"]); 
    $categorie = addslashes($_POST["categorie"]);
    $sql="UPDATE categories SET  nomcategorie='$categorie' where idcategorie =".$id;
    $resultat = mysqli_query($con, $sql);
    header("location:list_categorie.php");
}
?>
<?php
    echo "la categorie est bien modifier dans la base";
?>
</body>
</html>