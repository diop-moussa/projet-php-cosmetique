<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une catégorie</title>
    <link rel="stylesheet" href="css/different_list.css"/>
</head>
<body>

    <p class="cl">AJOUTER UNE CATEGORIE</p>

    <?php if (isset($_GET['success'])) { ?>
        <?php if ($_GET['success'] == '1') { ?>
            <p style="text-align:center; color: green; background-color: #e6ffe6; padding: 10px; margin: 15px auto; width: 300px; border: 1px solid green;">
                ✅ Catégorie ajoutée avec succès.
            </p>
        <?php } else { ?>
            <p style="text-align:center; color: red; background-color: #ffe6e6; padding: 10px; margin: 15px auto; width: 300px; border: 1px solid red;">
                ❌ Erreur lors de l'ajout de la catégorie.
            </p>
        <?php } ?>
    <?php } ?>

    <form method="post" action="ajouter.php">
        <p>
            <label for="categorie">Catégorie</label>
            <input type="text" name="categorie" id="categorie" required>
        </p>
        <p style="justify-content: center;">
            <input type="submit" name="envoyer" value="Enregistrer dans la base">
        </p>
    </form>

    <button class="but2" style="float:none; display:block; margin: 20px auto;">
        <a href="list_categorie.php">Retour</a>
    </button>

</body>
</html>
