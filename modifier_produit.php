<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Produit</title>
    <link rel="stylesheet" href="css/different_list.css"/>
</head>
<body>

    <p class="cl">MODIFIER LE PRODUIT</p>

    <div class="actions">
        <a href="liste_produits.php" class="but2">Retour</a>
    </div>

    <?php
    // Vérification que l'ID est passé dans l'URL
    if (isset($_GET['id']) && intval($_GET['id'])) {
        $id = $_GET['id'];
        require("conf.php");
        $con = ouvrirRD();

        // Récupérer les informations du produit à modifier
        $sql = "SELECT * FROM produits WHERE idproduit = $id";
        $resultat = mysqli_query($con, $sql);
        $ligne = mysqli_fetch_array($resultat);

        // Récupérer la liste des catégories
        $requete = "SELECT idcategorie, nomcategorie FROM categories";
        $result = mysqli_query($con, $requete);

        if ($ligne) {
            ?>
            <form method="post" action="modifier_P.php">
                <input type="hidden" name="idproduit" value="<?php echo $ligne["idproduit"]; ?>" />
                <p>
                    <label for="nomproduit">Nom du produit</label>
                    <input type="text" name="nomproduit" id="nomproduit" value="<?php echo $ligne["nomproduit"]; ?>" required>
                </p>
                <p>
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="4" required><?php echo htmlspecialchars($ligne["description"]); ?></textarea>
                </p>
                <p>
                    <label for="prix">Prix</label>
                    <input type="text" name="prix" id="prix" value="<?php echo $ligne["prix"]; ?>" required>
                </p>
                <p>
                    <label for="image">Image</label>
                    <input type="text" name="image" id="image" value="<?php echo $ligne["image"]; ?>" required>
                </p>
                <p>
                    <label for="categorie">Catégorie</label>
                    <select id="categorie" name="categorie" required>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $selected = ($row["idcategorie"] == $ligne["idcategorie"]) ? 'selected' : '';
                            echo "<option value='" . $row["idcategorie"] . "' $selected>" . $row["nomcategorie"] . "</option>";
                        }
                        ?>
                    </select>
                </p>
                <p style="justify-content: center;">
                    <input type="submit" name="Modifier_P" value="Modifier le produit">
                </p>
            </form>
        <?php
        } else {
            echo "<p style='text-align:center; color:white;'>Produit non trouvé.</p>";
        }
    } else {
        echo "<p style='text-align:center; color:white;'>ID de produit manquant.</p>";
    }
    ?>

</body>
</html>