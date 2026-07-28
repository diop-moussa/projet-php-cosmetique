<?php

session_start();

require_once("conf.php");

$con = ouvrirRD();

if (!$con) {
    die("Connexion non établie.");
}


// =====================================================
// RÉCUPÉRATION DE L'ID DU PRODUIT
// =====================================================

$idprod = isset($_GET['id'])
    ? (int) $_GET['id']
    : 0;


if ($idprod <= 0) {
    die("Produit invalide.");
}


// =====================================================
// RÉCUPÉRATION DU PRODUIT
// =====================================================

$requete = "SELECT *
            FROM produits
            WHERE idproduit = ?";

$stmt = mysqli_prepare($con, $requete);

if (!$stmt) {
    die("Erreur lors de la préparation de la requête.");
}

mysqli_stmt_bind_param($stmt, "i", $idprod);

mysqli_stmt_execute($stmt);

$resultat = mysqli_stmt_get_result($stmt);


// =====================================================
// VÉRIFICATION DU PRODUIT
// =====================================================

if (
    !$resultat ||
    mysqli_num_rows($resultat) == 0
) {
    die("Aucun produit trouvé pour cet ID.");
}


$ligne = mysqli_fetch_assoc($resultat);

?>


<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">


    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <!-- CSS de la page -->
    <link rel="stylesheet"
          href="css/page2.css">


    <title>
        Détails du produit
    </title>

</head>


<body>


<!-- =====================================================
     HEADER
===================================================== -->

<?php include("header.php"); ?>


<!-- =====================================================
     CONTENU PRINCIPAL
===================================================== -->

<div class="containtglob">


    <!-- =================================================
         IMAGE DU PRODUIT
    ================================================== -->

    <div class="containte">

        <div class="art">

            <img
                src="image/<?php echo htmlspecialchars($ligne['image']); ?>"
                alt="<?php echo htmlspecialchars($ligne['nomproduit']); ?>"
            >

        </div>

    </div>


    <!-- =================================================
         INFORMATIONS DU PRODUIT
    ================================================== -->

    <div class="sidebares">


        <!-- NOM DU PRODUIT -->

        <h2>

            <?php

            echo htmlspecialchars(
                $ligne['nomproduit']
            );

            ?>

        </h2>


        <!-- NOM ET PRIX -->

        <div class="sid">


            <span class="gau">

                <?php

                echo htmlspecialchars(
                    $ligne['nomproduit']
                );

                ?>

            </span>


            <span class="dr">

                <?php

                echo htmlspecialchars(
                    $ligne['prix']
                );

                ?>

            </span>


        </div>


        <hr>


        <!-- DESCRIPTION -->

        <p class="pr">

            <?php

            echo nl2br(
                htmlspecialchars(
                    $ligne['description']
                )
            );

            ?>

        </p>


        <!-- =================================================
             BOUTON AJOUTER
        ================================================== -->

        <form
            action="ajout_achat.php"
            method="POST"
            class="panier-form"
        >


            <input
                type="hidden"
                name="idproduit"
                value="<?php echo htmlspecialchars($ligne['idproduit']); ?>"
            >


            <button
                type="submit"
                class="btn-panier"
            >

                <img
                    src="image/panier_icon.png"
                    alt="Panier"
                    class="panier-icon"
                >

                Ajouter

            </button>


        </form>


    </div>


</div>


<!-- =====================================================
     FOOTER
===================================================== -->

<?php include("footer.php"); ?>


</body>

</html>


<?php

mysqli_stmt_close($stmt);

mysqli_close($con);

?>