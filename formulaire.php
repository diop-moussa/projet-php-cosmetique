<?php

require("conf.php");

$con = ouvrirRD();

$ql = "SELECT idrole FROM role WHERE profile='client'";
$roleResult = mysqli_query($con, $ql);

// Vérifier si un résultat a été retourné
if ($roleResult && mysqli_num_rows($roleResult) > 0) {
    // Récupérer la valeur de l'ID de rôle
    $roleRow = mysqli_fetch_assoc($roleResult);
    $idRole = $roleRow['idrole'];
} else {
    // Gérer le cas où aucun rôle correspondant n'a été trouvé
    die("Erreur : Aucun rôle trouvé pour le profil 'client'.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email       = addslashes($_POST["email"]);
    $mot_pass    = addslashes($_POST["motpasse"]);
    $nom         = addslashes($_POST["nom"]);
    $prenom      = addslashes($_POST["prenom"]);
    $date        = addslashes($_POST["date"]);
    $tel         = addslashes($_POST["tel"]);

    $sql = "INSERT INTO `utilisateur` (`email`, `mot_passe`, `nom`, `prenom`, `date_naissance`, `idrole`, `telephone`)
    VALUES ('$email', '$mot_pass', '$nom', '$prenom', '$date', '$idRole', '$tel')";

    try {

        $resultat = mysqli_query($con, $sql);

        // Succès : on redirige vers la page de connexion
        header("Location: page_authentification.php?success=1");
        exit;

    } catch (mysqli_sql_exception $e) {

        // Code 1062 = entrée en double (ex : email déjà utilisé)
        if ($e->getCode() === 1062) {
            header("Location: creation_compte.php?error=email_exists");
        } else {
            header("Location: creation_compte.php?error=1");
        }
        exit;

    }
}

?>
