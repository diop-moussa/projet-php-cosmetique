<?php

// Démarrer la session uniquement si elle n'est pas encore active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idutilisateur'])) {

    header("Location: page_authentification.php");
    exit();

}

// Vérifier si l'utilisateur est administrateur
if (
    !isset($_SESSION['profile']) ||
    $_SESSION['profile'] !== 'admin'
) {

    header("Location: cosmetic.php");
    exit();

}

?>