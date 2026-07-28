<?php


require_once("admin_auth.php");
require_once("conf.php");

$con = ouvrirRD();

$requete = "SELECT idcategorie, nomcategorie
            FROM categories
            ORDER BY idcategorie";

$resultat = mysqli_query($con, $requete);

if (!$resultat) {
    die("Impossible d'exécuter la requête : " . mysqli_error($con));
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Liste des catégories</title>


    <link rel="stylesheet"
          href="css/different_list.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>


<!-- HEADER COMMUN -->




<!-- CONTENU PRINCIPAL -->

<div class="page-content categorie-page">


    <h2 class="cl">
        BIENVENUE SUR LA PAGE LISTE DES CATÉGORIES
    </h2>


    <div class="actions">

        <a href="ajouter_categorie.php"
           class="but1">

            Ajouter une catégorie

        </a>


        <a href="global_view.php"
           class="but2">

            Retour

        </a>

    </div>


    <?php if (mysqli_num_rows($resultat) == 0): ?>


        <p class="aucune-categorie">

            Aucune catégorie n'est disponible

        </p>


    <?php else: ?>


        <div class="table-container">

            <table>

                <thead>

                    <tr>

                       

                        <th>
                            Nom catégorie
                        </th>

                        <th>
                            Modifier
                        </th>

                        <th>
                            Supprimer
                        </th>

                    </tr>

                </thead>


                <tbody>


                    <?php while ($ligne = mysqli_fetch_assoc($resultat)): ?>


                        <tr>

                           


                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $ligne["nomcategorie"]
                                );
                                ?>
                            </td>


                            <td class="index1">

                                <a href="modifier_categorie.php?id=<?php echo $ligne["idcategorie"]; ?>">

                                    Modifier

                                </a>

                            </td>


                            <td class="index2">

                                <a href="Supprimer_categorie.php?id=<?php echo $ligne["idcategorie"]; ?>"
                                   onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie ?');">

                                    Supprimer

                                </a>

                            </td>

                        </tr>


                    <?php endwhile; ?>


                </tbody>

            </table>

        </div>


    <?php endif; ?>


</div>


<!-- FOOTER COMMUN -->




</body>

</html>


<?php

fermeture($con);

?>