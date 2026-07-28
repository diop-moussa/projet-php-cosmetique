<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

if(isset($_POST["Modifier_P"])){

    require("conf.php");  
    $con = ouvrirRD();
    $idproduit=intval($_POST["idproduit"]); 
    $nomproduit= addslashes($_POST["nomproduit"]);
    $description=addslashes ($_POST["description"]);
    $prix= floatval($_POST["prix"]);
    $image=addslashes( $_POST["image"]);
    $categorie= intval($_POST["categorie"]);
    $sql="UPDATE produits 
        SET  nomproduit='$nomproduit' , 
            description='$description' ,
            prix=  '$prix'              , 
            image= '$image'          , 
            categorie= '$categorie'  
            where idproduit =$idproduit";

    if (mysqli_query($con, $sql)) {
        // Redirection après succès
        header("Location: liste_produits.php?success=1");
        exit();
    } else {
        // Afficher l'erreur en cas d'échec
        echo "Erreur lors de la mise à jour : " . mysqli_error($con);
    }
}
?>

</body>
</html>