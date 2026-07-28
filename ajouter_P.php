<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
require("conf.php");
$con = ouvrirRD();

if (isset($_POST['envoyer'])) {
    $nom = addslashes($_POST['produit']);
    $description = addslashes($_POST['description']);
    $id_categorie = intval($_POST['categorie']);
    $prix = floatval($_POST['prix']);

    // Vérifiez si un fichier a été téléchargé
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = basename($_FILES['image']['name']);
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];

        // Répertoire des images : dossier "image/" à la racine du projet
        // (fonctionne quel que soit le serveur / dossier de projet, contrairement à un chemin Windows codé en dur)
        $target_dir = __DIR__ . "/image/";
        $target_file = $target_dir . $image;

        // Vérification de l'extension du fichier (par exemple JPG, PNG, etc.)
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Vérifier si l'image est une image réelle
        if (getimagesize($image_tmp_name) === false) {
            echo "Ce fichier n'est pas une image.";
            exit;
        }

        // Vérifier si l'image est trop grande
        if ($image_size > 5000000) {
            echo "Désolé, votre image est trop grande.";
            exit;
        }

        // Vérification de l'extension du fichier
        if (!in_array($image_file_type, ['jpg', 'jpeg', 'png', 'gif'])) {
            echo "Désolé, seules les images JPG, JPEG, PNG et GIF sont autorisées.";
            exit;
        }

        // Déplacer le fichier téléchargé vers le répertoire cible
        if (move_uploaded_file($image_tmp_name, $target_file)) {

            // Insertion des informations du produit dans la base de données
            $requete = "INSERT INTO produits (nomproduit, description, prix, image, categorie)
                        VALUES ('$nom', '$description', '$prix', '$image', '$id_categorie')";

            $resultat = mysqli_query($con, $requete);
            if ($resultat) {
                header("Location: liste_produits.php?success=1");
                exit();
            } else {
                header("Location: ajouter_produit.php?success=0");
                exit();
            }
        } else {
            echo "Désolé, il y a eu une erreur lors du téléchargement de votre fichier.";
        }
    } else {
        echo "Veuillez sélectionner une image valide.";
    }
}
?>
</body>
</html>
