<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet"
          href="css/style_devoir.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Mot de passe oublié</title>

</head>

<body>

<?php include("header.php"); ?>


<!-- CONTENU PRINCIPAL -->

<div class="page-content connexion-page">

    <div class="login-card">

        <h2 class="text-center">
            Mot de passe oublié
        </h2>

        <?php if (isset($_GET['error'])): ?>

            <div class="error-message" style="margin-top: 0; margin-bottom: 20px;">
                <?php

                $messages = [
                    'email_introuvable'  => "Aucun compte n'est associé à cet email.",
                    'mismatch'           => "Les deux mots de passe ne correspondent pas.",
                    'champs_vides'       => "Veuillez remplir tous les champs.",
                ];

                $code = $_GET['error'];

                echo isset($messages[$code])
                    ? $messages[$code]
                    : "Une erreur est survenue. Veuillez réessayer.";

                ?>
            </div>

        <?php endif; ?>


        <form method="post"
              action="reinitialiser_motpasse.php">


            <div class="form-group">

                <label for="email">
                    Email :
                </label>

                <input type="email"
                       id="email"
                       name="email"
                       required>

            </div>


            <div class="form-group">

                <label for="mot1">
                    Nouveau mot de passe :
                </label>

                <div class="password-wrapper">

                    <input type="password"
                           id="mot1"
                           name="nouveau_motpasse"
                           required>

                    <button type="button"
                            class="password-toggle"
                            data-target="mot1"
                            onclick="togglePassword(this)"
                            aria-label="Afficher le mot de passe">
                        <i class="fas fa-eye"></i>
                    </button>

                </div>

            </div>


            <div class="form-group">

                <label for="mot2">
                    Confirmer le nouveau mot de passe :
                </label>

                <div class="password-wrapper">

                    <input type="password"
                           id="mot2"
                           name="confirmation_motpasse"
                           required>

                    <button type="button"
                            class="password-toggle"
                            data-target="mot2"
                            onclick="togglePassword(this)"
                            aria-label="Afficher le mot de passe">
                        <i class="fas fa-eye"></i>
                    </button>

                </div>

            </div>


            <div class="form-group text-center">

                <button type="submit"
                        class="btn btn-primary">

                    RÉINITIALISER

                </button>

            </div>

            <div class="form-group text-center">

                <p class="oublier">

                    <a href="page_authentification.php">
                        Retour à la connexion
                    </a>

                </p>

            </div>

        </form>

    </div>

</div>


<?php include("footer.php"); ?>

<script src="js/password-toggle.js"></script>

</body>

</html>