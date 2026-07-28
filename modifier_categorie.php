<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une catégorie</title>
    <link rel="stylesheet" href="css/different_list.css"/>
</head>
<body>

    <p class="cl">MODIFIER LA CATEGORIE</p>

    <div class="actions">
        <a href="list_categorie.php" class="but2">Retour</a>
    </div>

    <?php
    $id = $_GET["id"];
    if (intval($id)) {
        require("conf.php");
        $con = ouvrirRD();
        $sql = "SELECT * FROM  categories WHERE idcategorie = $id";
        $resultat = mysqli_query($con, $sql);
        $ligne = mysqli_fetch_array($resultat);
        ?>
        <form method="post" action="modifier.php">
            <input type="hidden" name="idd" value="<?php echo $ligne["idcategorie"]; ?>" />
            <p>
                <label for="categorie">Catégorie</label>
                <input type="text" name="categorie" id="categorie" value="<?php echo $ligne["nomcategorie"]; ?>" required>
            </p>
            <p style="justify-content: center;">
                <input type="submit" name="Modifier" value="Modifier">
            </p>
        </form>
    <?php } else { ?>
        <p style="text-align:center; color:white; margin-top:50px;">Identifiant de catégorie invalide.</p>
    <?php } ?>

</body>
</html>
