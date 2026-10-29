<?php

session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['idutilisateur'])) {
    header("Location: page_authentification.php");
    exit();
}

require_once("conf.php");
$con = ouvrirRD();

$idutilisateur = $_SESSION['idutilisateur'];

// Récupération des produits du panier de l'utilisateur connecté
$sql = "SELECT p.idproduit, p.nomproduit, p.prix, p.image, a.date_achat
        FROM achat a
        INNER JOIN produits p ON a.idProduit = p.idproduit
        WHERE a.idutilisateur = ?
        ORDER BY a.date_achat DESC";

$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $idutilisateur);
mysqli_stmt_execute($stmt);
$resultat = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet"
          href="css/style_devoir.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Mon panier</title>

</head>

<body>

<?php include("header.php"); ?>


<!-- CONTENU PRINCIPAL -->

<div class="page-content">

    <h2 class="text-center">
        Mon panier
    </h2>

    <?php if (isset($_GET['success'])): ?>

        <div class="success-message">
            Produit ajouté au panier avec succès.
        </div>

    <?php elseif (isset($_GET['error'])): ?>

        <div class="error-message" style="margin-top: 0; margin-bottom: 20px;">
            <?php

            $messages = [
                'produit_invalide'  => "Le produit sélectionné n'est pas valide.",
                'ajout_echoue'      => "L'ajout du produit au panier a échoué. Veuillez réessayer.",
                'requete_echouee'   => "Une erreur technique est survenue. Veuillez réessayer.",
            ];

            $code = $_GET['error'];

            echo isset($messages[$code])
                ? $messages[$code]
                : "Une erreur est survenue.";

            ?>
        </div>

    <?php endif; ?>


    <?php if (mysqli_num_rows($resultat) == 0): ?>

        <p class="text-center">
            Votre panier est vide pour le moment.
        </p>

        <div class="text-center" style="margin-top: 20px;">
            <a href="cosmetic.php" class="btn btn-primary">
                Continuer mes achats
            </a>
        </div>

    <?php else: ?>

        <div class="panier-table-wrapper">

            <table class="panier-table">

                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Ajouté le</th>
                    </tr>
                </thead>

                <tbody>

                    <?php while ($ligne = mysqli_fetch_assoc($resultat)): ?>

                        <tr>

                            <td class="panier-produit">
                                <img src="image/<?php echo htmlspecialchars($ligne['image']); ?>"
                                     alt="<?php echo htmlspecialchars($ligne['nomproduit']); ?>"
                                     class="panier-img">
                                <span>
                                    <?php echo htmlspecialchars($ligne['nomproduit']); ?>
                                </span>
                            </td>

                            <td class="panier-prix">
                                <?php echo htmlspecialchars($ligne['prix']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($ligne['date_achat']); ?>
                            </td>

                        </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>

        </div>

    <?php endif; ?>

</div>


<?php include("footer.php"); ?>

</body>

</html>

<?php
mysqli_stmt_close($stmt);
mysqli_close($con);
?>
