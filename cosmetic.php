<?php
session_start();
require("conf.php"); 
$con = ouvrirRD();     

// Récupération des produits populaires
$sql = "SELECT p.nomproduit, p.prix, p.image, COUNT(a.idproduit) AS nombre 
        FROM produits p
        LEFT JOIN achat a ON p.idproduit = a.idproduit
        GROUP BY p.idproduit, p.nomproduit, p.prix, p.image
        ORDER BY nombre DESC";
$resultat = mysqli_query($con, $sql);
if (!$resultat) {
    echo "Impossible d'exécuter la requête";
    exit;
}

if (mysqli_num_rows($resultat) == 0) {
    echo "Aucune catégorie n'est disponible";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_devoir.css"/>
    <script src="js/contact.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>cosmetic</title>
</head>
<body>

<!-- Menu principal -->
<div class="headercl">
    <div class="head container d-flex justify-content-between align-items-center">
        <div class="login">
            <div>
                <a href="cosmetic.php"><img src="image/logo.jpeg" alt="Logo" class="pig"></a>
            </div>
        </div>
         <div class="space"> 

    <ul>

        <?php if (!isset($_SESSION['idutilisateur'])): ?>

            <li>
                <a href="creation_compte.php"
                   class="btn-compte">
                    Créer un compte
                </a>
            </li>

            <li>
                <a href="page_authentification.php"
                   class="btn-compte btn-compte-primaire">
                    Se connecter
                </a>
            </li>

        <?php else: ?>

            <li>
                <a href="deconnexion.php"
                   class="btn-compte btn-compte-danger">
                    deconnexion
                </a>
            </li>

        <?php endif; ?>

    </ul>

</div>
    </div>
    
    <!-- Navigation des catégories -->
    <div class="nav container">
        <ul class="d-flex justify-content-center align-items-center list-unstyled gap-4">
            <?php     
                $sql = "SELECT * FROM categories";
                $resultats = $con->query($sql);

                if ($resultats->num_rows > 0) {
                    // Affichage des catégories sous forme de liens
                    while ($ligne = $resultats->fetch_assoc()) {
                        $idcategorie = $ligne['idcategorie'];
                        $nomcategorie = $ligne['nomcategorie'];
                        echo "<li><a href='list_categ_produit.php?idcategorie=$idcategorie'>$nomcategorie</a></li>";
                    }
                } else {
                    echo "<li>Aucune catégorie disponible</li>";
                }
            ?>
        </ul>
    </div>
</div>

<!-- Slider des produits -->
<div id="produits" class="container mt-5">
    <div class="slider d-flex gap-3">
        <?php 
            $compteur = 0; 
            $requete = "SELECT * FROM produits ORDER BY idproduit DESC LIMIT 2";
            $resul = mysqli_query($con, $requete);
            while ($ligne = mysqli_fetch_assoc($resul)) {
                if ($compteur >= 2) break;
        ?>
        <div class="imag">
            <a href="detail.php?id=<?php echo $ligne['idproduit']; ?>">
                <img src="image/<?php echo htmlspecialchars($ligne['image']); ?>" alt="Produit" class="img-fluid">
            </a>
        </div>
        <?php
            $compteur++;
        }
        ?>
    </div>
</div>

<!-- Header2 + grilles de produits : 2 colonnes alignées -->
<?php
    // Récupération des 2 grandes photos
    $req = "SELECT * FROM produits ORDER BY idproduit ASC LIMIT 2";
    $res = mysqli_query($con, $req);
    $grandes_photos = [];
    while ($ligne = mysqli_fetch_assoc($res)) {
        $grandes_photos[] = $ligne;
    }
?>
<div class="colonnes-wrapper">

    <!-- Colonne 1 : grande photo 1 + ses 4 petites photos -->
    <div class="colonne">
        <?php if (isset($grandes_photos[0])) { $ligne = $grandes_photos[0]; ?>
        <div class="p-2">
            <a href="list_categ_produit.php?idcategorie=<?php echo $ligne['categorie']; ?>">
                <img src="image/<?php echo $ligne['image']; ?>" alt="img1" class="pg img-fluid">
            </a>
        </div>
        <?php } ?>

        <div class="content1">
            <?php
                $compteur = 0;
                while ($ligne = mysqli_fetch_assoc($resultat)) {
                    if ($compteur >= 4) break;
            ?>
            <div class="image-container">
                <p class="cl"><?php echo $ligne['nomproduit']; ?><br></p>
                <p class="cl"><span class="pi"><?php echo $ligne['prix']; ?></span></p>
                <img src="image/<?php echo $ligne['image']; ?>" alt="img1" class="grayscale-img">
            </div>
            <?php
                $compteur++;
            } ?>
        </div>
    </div>

    <!-- Colonne 2 : grande photo 2 + ses 4 petites photos -->
    <div class="colonne">
        <?php if (isset($grandes_photos[1])) { $ligne = $grandes_photos[1]; ?>
        <div class="p-2">
            <a href="list_categ_produit.php?idcategorie=<?php echo $ligne['categorie']; ?>">
                <img src="image/<?php echo $ligne['image']; ?>" alt="img1" class="pg img-fluid">
            </a>
        </div>
        <?php } ?>

        <div class="content3">
            <?php
                $compteur = 0;
                while ($ligne = mysqli_fetch_assoc($resultat)) {
                    if ($compteur >= 4) break;
            ?>
            <div class="image-container">
                <p class="cl"><?php echo $ligne['nomproduit']; ?><br></p>
                <p class="cl"><span class="pi"><?php echo $ligne['prix']; ?></span></p>
                <img src="image/<?php echo $ligne['image']; ?>" alt="img1" class="grayscale-img">
            </div>
            <?php
                $compteur++;
            } ?>
        </div>
    </div>

</div>

<!-- Footer -->
<div class="footer container d-flex justify-content-between align-items-center mt-5">
    <div class="clas1">
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
    </div>
    <div class="clas2">
        <p>M1 MIAGE 2024</p>
    </div>
    <div class="icon d-flex gap-2">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="https://www.linkedin.com/in/moussa-diop-868087363" target="_blank" rel="noopener"><i class="fab fa-linkedin"></i></a>
    </div>
</div>



</body>
</html>
