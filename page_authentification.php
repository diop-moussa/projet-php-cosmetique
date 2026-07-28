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

    <title>Connexion</title>

</head>

<body>

<?php include("header.php"); ?>


<!-- CONTENU PRINCIPAL -->

<div class="page-content connexion-page">

    <div class="login-card">

        <h2 class="text-center">
            Connexion
        </h2>

        <?php if (isset($_GET['success'])): ?>

            <div class="success-message">
                Votre compte a été créé avec succès ! Vous pouvez maintenant vous connecter.
            </div>

        <?php endif; ?>


        <form method="post"
              action="conn.php">


            <div class="form-group">

                <label for="email">
                    Email :
                </label>

                <input type="email"
                       id="email"
                       name="email"
                       required>

                <span id="emailError"
                      class="error">
                </span>

            </div>


            <div class="form-group">

                <label for="mot">
                    Mot de passe :
                </label>

                <div class="password-wrapper">

                    <input type="password"
                           id="mot"
                           name="motpasse"
                           required>

                    <button type="button"
                            class="password-toggle"
                            data-target="mot"
                            onclick="togglePassword(this)"
                            aria-label="Afficher le mot de passe">
                        <i class="fas fa-eye"></i>
                    </button>

                </div>

                <span id="motError"
                      class="error">
                </span>

            </div>


            <div class="form-group text-center">

                <p class="oublier">

                    <a href="formpasswordOublie.php">
                        Mot de passe oublié ?
                    </a>

                </p>


                <button type="submit"
                        name="se_connecter"
                        class="btn btn-primary">

                    SE CONNECTER

                </button>

            </div>

        </form>

    </div>

</div>


<?php include("footer.php"); ?>

<script src="js/password-toggle.js"></script>

</body>

</html>
