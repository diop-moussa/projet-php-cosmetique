<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>
    <link rel="stylesheet" href="css/different_list.css"/>
</head>
<body>

    <p class="cl">AJOUTER UN PRODUIT</p>

    <?php
    require("conf.php");
    $con = ouvrirRD();
    $requete = "SELECT idcategorie, nomcategorie FROM categories";
    $resultat = mysqli_query($con, $requete);

    if (!$resultat) {
        print("Impossible d'exécuter la requête");
        exit;
    }
    ?>

    <?php if (isset($_GET['success']) && $_GET['success'] == '0') { ?>
        <p style="text-align:center; color: red; background-color: #ffe6e6; padding: 10px; margin: 15px auto; width: 300px; border: 1px solid red;">
            ❌ Erreur lors de l'ajout du produit.
        </p>
    <?php } ?>

    <?php if (mysqli_num_rows($resultat) == 0) { ?>
        <p style="text-align:center; color:white;">Aucune catégorie n'est disponible. Ajoutez d'abord une catégorie.</p>
    <?php } else { ?>

    <form method="post" action="ajouter_P.php" enctype="multipart/form-data">
        <p>
            <label for="produit">Nom du produit</label>
            <input type="text" id="produit" name="produit" required>
        </p>
        <p>
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" required></textarea>
        </p>
        <p>
            <label for="prix">Prix</label>
            <input type="text" id="prix" name="prix" required>
        </p>
        <p>
            <label for="categorie">Catégorie</label>
            <select id="categorie" name="categorie" required>
                <option value="">Sélectionner une catégorie</option>
                <?php
                while ($ligne = mysqli_fetch_assoc($resultat)) {
                    echo "<option value='" . $ligne["idcategorie"] . "'>" . $ligne["nomcategorie"] . "</option>";
                }
                ?>
            </select>
        </p>
        <p>
            <label for="image">Image</label>
            <input type="file" id="image" name="image" required>
        </p>
        <p style="justify-content: center;">
            <input type="submit" name="envoyer" value="Enregistrer dans la base">
        </p>
    </form>

    <?php } ?>

    <button class="but2" style="float:none; display:block; margin: 20px auto;">
        <a href="liste_produits.php">Retour</a>
    </button>

</body>
</html>