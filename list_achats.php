<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("admin_auth.php");
require_once("conf.php");

$con = ouvrirRD();

$sql = "SELECT
            p.nomproduit,
            c.nomcategorie,
            u.prenom,
            u.nom,
            u.telephone,
            a.date_achat
        FROM achat a
        INNER JOIN produits p
            ON a.idProduit = p.idproduit
        INNER JOIN categories c
            ON p.categorie = c.idcategorie
        INNER JOIN utilisateur u
            ON a.idUtilisateur = u.idutilisateur
        ORDER BY a.date_achat DESC";

$result = mysqli_query($con, $sql);

if ($result === false) {
    die(
        "Erreur dans la requête SQL : "
        . mysqli_error($con)
    );
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Liste des achats</title>

    

    <link rel="stylesheet"
          href="css/different_list.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>


<!-- HEADER COMMUN -->




<!-- CONTENU PRINCIPAL -->

<div class="page-content liste-page">


    <h2 class="cl">
        BIENVENUE SUR LA PAGE LISTE DES ACHATS
    </h2>


    <!-- Bouton retour -->

    <div class="actions">

        <a href="global_view.php"
           class="but2">

            Retour

        </a>

    </div>


    <?php if (mysqli_num_rows($result) == 0): ?>


        <p class="aucun-produit">

            Aucun achat n'est disponible.

        </p>


    <?php else: ?>


        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>
                            Nom produit
                        </th>

                        <th>
                            Nom catégorie
                        </th>

                        <th>
                            Prénom client
                        </th>

                        <th>
                            Nom client
                        </th>

                        <th>
                            Téléphone client
                        </th>

                        <th>
                            Date achat
                        </th>

                    </tr>

                </thead>


                <tbody>


                    <?php while ($ligne = mysqli_fetch_assoc($result)): ?>


                        <tr>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $ligne["nomproduit"]
                                );
                                ?>
                            </td>


                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $ligne["nomcategorie"]
                                );
                                ?>
                            </td>


                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $ligne["prenom"]
                                );
                                ?>
                            </td>


                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $ligne["nom"]
                                );
                                ?>
                            </td>


                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $ligne["telephone"]
                                );
                                ?>
                            </td>


                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $ligne["date_achat"]
                                );
                                ?>
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