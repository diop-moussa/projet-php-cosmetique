<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("admin_auth.php");

require_once("conf.php");

$con = ouvrirRD();

$requete = "SELECT p.*, c.nomcategorie
            FROM produits p , categories c
            where  p.categorie = c.idcategorie
            ORDER BY p.idproduit";

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

    <title>Liste des produits</title>


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
        BIENVENUE SUR LA PAGE LISTE DES PRODUITS
    </h2>


    <!-- Message de succès -->

    <?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>

        <p class="message-success">

            ✅ Opération effectuée avec succès.

        </p>

    <?php endif; ?>


    <!-- Boutons -->

    <div class="actions">

        <a href="ajouter_produit.php"
           class="but1">

            Ajouter un produit

        </a>


        <a href="global_view.php"
           class="but2">

            Retour

        </a>

    </div>


    <?php if (mysqli_num_rows($resultat) == 0): ?>


        <p class="aucun-produit">

            Aucun produit n'est disponible

        </p>


    <?php else: ?>


        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>
                            Nom du produit
                        </th>

                        <th>
                            Prix
                        </th>

                        <th>
                            Catégorie
                        </th>

                        <th>
                            Image
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
                                    $ligne["nomproduit"]
                                );
                                ?>

                            </td>


                            <td>

                                <?php
                                echo htmlspecialchars(
                                    $ligne["prix"]
                                );
                                ?>

                            </td>


                            <td>

                                <?php
                                echo htmlspecialchars(
                                    $ligne["nomcategorie"]
                                    ?? "Aucune catégorie"
                                );
                                ?>

                            </td>


                            <td>

                                <?php if (!empty($ligne["image"])): ?>

                                    <img
                                        src="image/<?php echo htmlspecialchars($ligne["image"]); ?>"
                                        alt="<?php echo htmlspecialchars($ligne["nomproduit"]); ?>"
                                        class="product-image">

                                <?php else: ?>

                                    Aucune image

                                <?php endif; ?>

                            </td>


                            <td class="index1">

                                <a href="modifier_produit.php?id=<?php echo $ligne["idproduit"]; ?>">

                                    Modifier

                                </a>

                            </td>


                            <td class="index2">

                                <a
                                    href="supprimer_produit.php?id=<?php echo $ligne["idproduit"]; ?>"
                                    onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?');">

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