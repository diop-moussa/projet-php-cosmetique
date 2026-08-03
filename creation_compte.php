<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet"
          href="css/style_devoir.css">
    <script src="js/script_java.js"></script>
    <script src="js/password-toggle.js"></script>


    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Créer un compte</title>

</head>

<body>

<?php include("header.php"); ?>


<!-- CONTENU PRINCIPAL -->

<div class="page-content">

    <h2 class="text-center">
        Formulaire d'inscription
    </h2>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'email_exists'): ?>

        <div class="error-message" style="margin-top: 0; margin-bottom: 20px;">
            Un compte existe déjà avec cet email. <a href="page_authentification.php" style="color: white; text-decoration: underline;">Se connecter</a> ?
        </div>

    <?php elseif (isset($_GET['error'])): ?>

        <div class="error-message" style="margin-top: 0; margin-bottom: 20px;">
            Une erreur est survenue lors de la création du compte. Veuillez réessayer.
        </div>

    <?php endif; ?>

    <form id="test"
          method="post"
          action="formulaire.php">


        <div class="form-group">

            <label for="email">
                Email :
            </label>

            <input type="email"
                   id="email"
                   name="email"
                   required>

            <span id="emailError"
                  class="text-danger">
            </span>

        </div>


        <div class="form-group">

            <label for="confirmation">
                Confirmation Email :
            </label>

            <input type="email"
                   id="confirmation"
                   name="confirmation"
                   required>

            <span id="confirmationEmailError"
                  class="text-danger">
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
                  class="text-danger">
            </span>

        </div>


        <div class="form-group">

            <label for="confirmation_mot">
                Confirmation Mot de passe :
            </label>

            <div class="password-wrapper">

                <input type="password"
                       id="confirmation_mot"
                       name="confirmation_mot"
                       required>

                <button type="button"
                        class="password-toggle"
                        data-target="confirmation_mot"
                        onclick="togglePassword(this)"
                        aria-label="Afficher le mot de passe">
                    <i class="fas fa-eye"></i>
                </button>

            </div>

            <span id="confirmationMotError"
                  class="text-danger">
            </span>

        </div>


        <div class="form-group">

            <label for="nom">
                Nom :
            </label>

            <input type="text"
                   id="nom"
                   name="nom"
                   required>

            <span id="nomError"
                  class="text-danger">
            </span>

        </div>


        <div class="form-group">

            <label for="prenom">
                Prénom :
            </label>

            <input type="text"
                   id="prenom"
                   name="prenom"
                   required>

            <span id="prenomError"
                  class="text-danger">
            </span>

        </div>


        <div class="form-group">

            <label for="date">
                Date de naissance :
            </label>

            <input type="date"
                   id="date"
                   name="date"
                   required>

            <span id="dateError"
                  class="text-danger">
            </span>

        </div>


        <div class="form-group">

            <label for="tel">
                Téléphone :
            </label>

            <input type="tel"
                   id="tel"
                   name="tel"
                   required>

            <span id="telError"
                  class="text-danger">
            </span>

        </div>


        <div class="form-group text-center">

            <button type="submit"
                    class="btn btn-primary">

                Créer

            </button>

        </div>

    </form>

</div>


<?php include("footer.php"); ?>



</body>

</html>
