<?php

session_start();

require_once("conf.php");

$con = ouvrirRD();

if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && isset($_POST["se_connecter"])
) {

    $email = trim($_POST["email"]);
    $mot_pass = trim($_POST["motpasse"]);


    $sql = "SELECT
                u.idutilisateur,
                u.mot_passe,
                r.profile
            FROM utilisateur u
            INNER JOIN role r
                ON r.idrole = u.idrole
            WHERE u.email = ?";


    $stmt = mysqli_prepare($con, $sql);

    if (!$stmt) {
        die("Erreur lors de la préparation de la requête.");
    }


    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $email
    );


    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);


    if (
        $result &&
        mysqli_num_rows($result) > 0
    ) {

        $user = mysqli_fetch_assoc($result);


        // Mot de passe enregistré en clair
        if ($mot_pass === $user['mot_passe']) {


            $_SESSION['idutilisateur']
                = $user['idutilisateur'];


            $_SESSION['profile']
                = $user['profile'];


            if ($user['profile'] === 'admin') {

                header("Location: global_view.php");
                exit();

            }


            if ($user['profile'] === 'client') {

                header("Location: cosmetic.php");
                exit();

            }

        }

    }


    echo "Identifiants incorrects.";


    mysqli_stmt_close($stmt);

}


fermeture($con);

?>