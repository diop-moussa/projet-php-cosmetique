<?php
session_start();  

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['idutilisateur'])) {
    // Si l'utilisateur n'est pas connecté, le rediriger vers la page d'authentification
    header("Location: page_authentification.php"); 
    exit();
}

require("conf.php");
$con = ouvrirRD();  

// Vérifie si le formulaire a été soumis via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupère l'ID du produit depuis le formulaire
    $idproduit = isset($_POST['idproduit']) ? (int)$_POST['idproduit'] : 0;

    // Récupère l'ID de l'utilisateur connecté depuis la session
    $idutilisateur = $_SESSION['idutilisateur']; 

    // Vérifie si l'ID produit est valide (positif)
    if ($idproduit <= 0) {
        header("Location: panier.php?error=produit_invalide");
        exit();
    }

    // Requête SQL pour insérer l'achat dans la base de données
    $sql = "INSERT INTO achat (idutilisateur, idProduit, date_achat) VALUES (?, ?, NOW())";

    // Préparation de la requête
    if ($stmt = mysqli_prepare($con, $sql)) {
        // Lier les paramètres à la requête préparée
        mysqli_stmt_bind_param($stmt, "ii", $idutilisateur, $idproduit);

        // Exécution de la requête
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($con);
            header("Location: panier.php?success=1");
            exit();
        } else {
            mysqli_stmt_close($stmt);
            mysqli_close($con);
            header("Location: panier.php?error=ajout_echoue");
            exit();
        }
    } else {
        mysqli_close($con);
        header("Location: panier.php?error=requete_echouee");
        exit();
    }

} else {
    // Accès direct sans soumission de formulaire
    mysqli_close($con);
    header("Location: panier.php");
    exit();
}
?>
