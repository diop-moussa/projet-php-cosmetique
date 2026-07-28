<?php

// Démarrage de la session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Connexion à la base de données
require_once("conf.php");

$con = ouvrirRD();


// Récupération de l'identifiant de la catégorie
$idcateg = isset($_GET['idcategorie'])
    ? (int) $_GET['idcategorie']
    : 0;


// Vérification de l'identifiant
if ($idcateg <= 0) {
    die("Catégorie invalide.");
}


// Récupération du nom de la catégorie
$sqlCategorie = "SELECT nomcategorie
                 FROM categories
                 WHERE idcategorie = ?";

$stmtCategorie = mysqli_prepare($con, $sqlCategorie);

mysqli_stmt_bind_param(
    $stmtCategorie,
    "i",
    $idcateg
);

mysqli_stmt_execute($stmtCategorie);

$resultCategorie = mysqli_stmt_get_result($stmtCategorie);

$categorie = mysqli_fetch_assoc($resultCategorie);


// Requête pour récupérer les produits
$requete = "SELECT *
            FROM produits
            WHERE categorie = ?";

$stmt = mysqli_prepare($con, $requete);

if (!$stmt) {
    die("Erreur lors de la préparation de la requête.");
}

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $idcateg
);

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
          href="css/script_page_list.css">

<script src="js/contact.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>
        Produits par catégorie
    </title>

</head>

<body>


<!-- =====================================================
     HEADER
===================================================== -->

<div class="headercl">

    <div class="head">

        <div class="login">

            <a href="cosmetic.php">

                <img src="image/logo.jpeg"
                     alt="Logo">

            </a>

        </div>


        <div class="space">

            <ul>

                <?php if (!isset($_SESSION['idutilisateur'])): ?>

                    <li>

                        <a href="creation_compte.php">

                            Créer un compte

                        </a>

                    </li>


                    <li>

                        <a href="page_authentification.php">

                            Se connecter

                        </a>

                    </li>

                <?php else: ?>

                    <li>

                        <a href="Deconnexion.php">

                            Déconnexion

                        </a>

                    </li>

                <?php endif; ?>

            </ul>

        </div>

    </div>


    <!-- =================================================
         NAVIGATION DES CATÉGORIES
    ================================================== -->

    <div class="nav">

        <ul>

            <?php

            $sqlCategories = "SELECT *
                              FROM categories";

            $resultats = mysqli_query(
                $con,
                $sqlCategories
            );


            if (
                $resultats
                && mysqli_num_rows($resultats) > 0
            ) {

                while (
                    $ligneCategorie =
                    mysqli_fetch_assoc($resultats)
                ) {

                    $idcategorie =
                        $ligneCategorie['idcategorie'];

                    $nomcategorie =
                        $ligneCategorie['nomcategorie'];

            ?>

                    <li>

                        <a href="list_categ_produit.php?idcategorie=<?php echo $idcategorie; ?>">

                            <?php

                            echo htmlspecialchars(
                                $nomcategorie
                            );

                            ?>

                        </a>

                    </li>

            <?php

                }

            } else {

            ?>

                <li>

                    Aucune catégorie disponible

                </li>

            <?php

            }

            ?>

        </ul>

    </div>

</div>


<!-- =====================================================
     CONTENU PRINCIPAL
===================================================== -->

<div class="page-content">


    <h2 class="text-center">

        <?php

        if ($categorie) {

            echo "Produits de la catégorie : "
                 . htmlspecialchars(
                     $categorie['nomcategorie']
                 );

        } else {

            echo "Produits de la catégorie";

        }

        ?>

    </h2>


    <?php

    if (
        mysqli_num_rows($resultat) > 0
    ):

    ?>

        <!-- GRILLE DES PRODUITS -->

        <div class="products-grid">


            <?php

            while (
                $ligne =
                mysqli_fetch_assoc($resultat)
            ):

            ?>

                <div class="product-card">


                    <!-- Nom du produit -->

                    <h3>

                        <?php

                        echo htmlspecialchars(
                            $ligne['nomproduit']
                        );

                        ?>

                    </h3>


                    <!-- Prix -->

                    <p class="price">

                        <?php

                        echo htmlspecialchars(
                            $ligne['prix']
                        );

                        ?>

                    </p>


                    <!-- Image -->

                    <a href="detail.php?id=<?php echo $ligne['idproduit']; ?>">

                        <img src="image/<?php echo htmlspecialchars($ligne['image']); ?>"
                             alt="<?php echo htmlspecialchars($ligne['nomproduit']); ?>">

                    </a>


                </div>

            <?php

            endwhile;

            ?>


        </div>


    <?php

    else:

    ?>

        <div class="empty-message">

            Aucun produit disponible dans cette catégorie.

        </div>

    <?php

    endif;

    ?>


</div>


<!-- =====================================================
     FOOTER
===================================================== -->

<footer class="footer">

    <div class="footer-links">

        <div class="contact-wrapper">
            <button type="button" class="contact-trigger" onclick="toggleContactBox(event)">
                Contactez-nous
            </button>
            <div class="contact-popup" id="contactPopup">
                <button type="button" class="contact-close" onclick="toggleContactBox(event)">&times;</button>
                <p><i class="fas fa-phone"></i> 77 206 49 64</p>
                <p><i class="fas fa-envelope"></i> moussadiop427m@gmail.com</p>
            </div>
        </div>

        <a href="#">

            Services

        </a>

        <a href="#">

            Liens légaux

        </a>

    </div>


    <div class="footer-title">

        M1 MIAGE 2024

    </div>


    <div class="social-icons">

        <a href="#">

            <i class="fab fa-facebook"></i>

        </a>

        <a href="#">

            <i class="fab fa-twitter"></i>

        </a>

        <a href="#">

            <i class="fab fa-instagram"></i>

        </a>

        <a href="https://www.linkedin.com/in/moussa-diop-868087363" target="_blank" rel="noopener">

            <i class="fab fa-linkedin"></i>

        </a>

    </div>

</footer>





</body>

</html>


<?php

// Fermeture des requêtes
mysqli_stmt_close($stmt);

mysqli_stmt_close($stmtCategorie);


// Fermeture de la connexion
fermeture($con);

?>