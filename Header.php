<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("conf.php");

$con = ouvrirRD();

?>

<!-- HEADER -->
<div class="headercl">

    <!-- Partie supérieure du header -->
    <div class="head container d-flex justify-content-between align-items-center">

        <!-- Logo -->
        <div class="login">
            <a href="cosmetic.php">
                <img src="image/logo.jpeg" alt="Logo" class="pig">
            </a>
        </div>

        <!-- Boutons de connexion -->
        <div class="space">

            <ul>

                <?php if (!isset($_SESSION['idutilisateur'])): ?>

                    <li>
                        <a href="creation_compte.php" class="btn-compte">
                            Créer un compte
                        </a>
                    </li>

                    <li>
                        <a href="page_authentification.php"
                           class="btn-compte btn-compte-primaire">
                            Connecter
                        </a>
                    </li>

                <?php else: ?>

                    <li>
                        <a href="Deconnexion.php"
                           class="btn-compte btn-compte-danger">
                            Déconnexion
                        </a>
                    </li>

                <?php endif; ?>

            </ul>

        </div>

    </div>


    <!-- Navigation des catégories -->
    <div class="nav container">

        <ul>

            <?php

            $sql_cat_header = "SELECT * FROM categories";

            $resultats_cat_header = mysqli_query($con, $sql_cat_header);

            if ($resultats_cat_header && mysqli_num_rows($resultats_cat_header) > 0) {

                while ($ligne_cat = mysqli_fetch_assoc($resultats_cat_header)) {

                    $idcategorie = $ligne_cat['idcategorie'];
                    $nomcategorie = $ligne_cat['nomcategorie'];

                    echo "
                    <li>
                        <a href='list_categ_produit.php?idcategorie=$idcategorie'>
                            $nomcategorie
                        </a>
                    </li>";
                }

            } else {

                echo "<li>Aucune catégorie disponible</li>";
            }

            ?>

        </ul>

    </div>

</div>