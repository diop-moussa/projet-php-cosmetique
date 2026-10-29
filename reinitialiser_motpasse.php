<?php

session_start();

require_once("conf.php");

$con = ouvrirRD();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: formpasswordoublie.php");
    exit();
}

$email        = isset($_POST['email']) ? trim($_POST['email']) : '';
$nouveau      = isset($_POST['nouveau_motpasse']) ? $_POST['nouveau_motpasse'] : '';
$confirmation = isset($_POST['confirmation_motpasse']) ? $_POST['confirmation_motpasse'] : '';

// Vérification des champs
if ($email === '' || $nouveau === '' || $confirmation === '') {
    header("Location: formpasswordoublie.php?error=champs_vides");
    exit();
}

// Vérification de la correspondance des mots de passe
if ($nouveau !== $confirmation) {
    header("Location: formpasswordoublie.php?error=mismatch");
    exit();
}

// Vérification que l'email existe bien dans la base
$sqlCheck = "SELECT idutilisateur FROM utilisateur WHERE email = ?";
$stmtCheck = mysqli_prepare($con, $sqlCheck);
mysqli_stmt_bind_param($stmtCheck, "s", $email);
mysqli_stmt_execute($stmtCheck);
$resultCheck = mysqli_stmt_get_result($stmtCheck);

if (mysqli_num_rows($resultCheck) === 0) {
    mysqli_stmt_close($stmtCheck);
    mysqli_close($con);
    header("Location: formpasswordoublie.php?error=email_introuvable");
    exit();
}

mysqli_stmt_close($stmtCheck);

// Mise à jour du mot de passe
$motpasse_echappe = addslashes($nouveau);

$sqlUpdate = "UPDATE utilisateur SET mot_passe = ? WHERE email = ?";
$stmtUpdate = mysqli_prepare($con, $sqlUpdate);
mysqli_stmt_bind_param($stmtUpdate, "ss", $motpasse_echappe, $email);
mysqli_stmt_execute($stmtUpdate);

mysqli_stmt_close($stmtUpdate);
mysqli_close($con);

header("Location: page_authentification.php?reset=1");
exit();

?>
