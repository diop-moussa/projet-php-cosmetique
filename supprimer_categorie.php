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
if (isset($_GET['id']) && intval($_GET['id']) > 0) {
     $id = intval($_GET['id']); 

     require("conf.php");
     $con = ouvrirRD();  

     if (!$con) {
          die("Connection failed: " . mysqli_connect_error());
     }

     $sql = "DELETE FROM categories WHERE idcategorie = ?";

     if ($stmt = mysqli_prepare($con, $sql)) {
          mysqli_stmt_bind_param($stmt, "i", $id);

          if (mysqli_stmt_execute($stmt)) {
          
               header("Location: list_categorie.php?success=1");
               exit();
          } else {
               echo "Erreur lors de la suppression : " . mysqli_stmt_error($stmt);
          }

          mysqli_stmt_close($stmt);
     } else {
          echo "Erreur de préparation de la requête : " . mysqli_error($con);
     }

     mysqli_close($con);
} else {
     echo "ID invalide ou manquant.";
}
?>
</body>
</html>
