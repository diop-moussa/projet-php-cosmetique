<?php

// Protection de la page administrateur
require_once("admin_auth.php");

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/view.css">

    <title>Dashboard</title>

</head>

<body>

<!-- =====================================================
     BOUTON DECONNEXION
===================================================== -->

<div class="space">

    <ul>

        <li>

            <button class="bu">

                <a href="Deconnexion.php" class="d">
                    Déconnexion
                </a>

            </button>

        </li>

    </ul>

</div>


<!-- =====================================================
     DASHBOARD
===================================================== -->

<div class="dashboard-container">


    <!-- TITRE -->

    <div class="dashboard-header">

        <p>Admin Dashboard</p>

    </div>


    <!-- CONTENU DU DASHBOARD -->

    <div class="dashboard-body">


        <!-- SIDEBAR -->

        <div class="sidebar">

            <ul>

                <li>
                    <a href="liste_produits.php">
                        Liste des produits
                    </a>
                </li>


                <li>
                    <a href="list_categorie.php">
                        Liste des catégories
                    </a>
                </li>


                <li>
                    <a href="list_achats.php">
                        Liste des achats
                    </a>
                </li>

            </ul>

        </div>


        <!-- CONTENU PRINCIPAL -->

        <div class="main-content">

            <h1>
                Bienvenue sur votre tableau de bord
            </h1>

            <p>
                Gérez vos produits, catégories et achats directement
                depuis ce tableau de bord.
            </p>

            <p>
                Ajoutez, modifiez ou supprimez des éléments selon
                vos besoins en toute simplicité.
            </p>

        </div>

    </div>

</div>


<!-- =====================================================
     FOOTER
===================================================== -->

<footer>

    <p>

        &copy; 2024 Beauty Cosmetics |

        <a href="cosmetic.php">
            Visitez notre site
        </a>

    </p>

</footer>

</body>

</html>