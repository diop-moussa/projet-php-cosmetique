
window.onload = function () {
// Ajout des écouteurs d'événements 'blur' pour chaque champ
document.getElementById("nom").addEventListener("blur", validateNom);
document.getElementById("prenom").addEventListener("blur", validatePrenom);
document.getElementById("tel").addEventListener("blur", validateTel);
document.getElementById("email").addEventListener("blur", validateEmail);
document.getElementById("confirmation").addEventListener("blur", validateConfirmationEmail);
document.getElementById("mot").addEventListener("blur", validateMotDePasse);
document.getElementById("confirmation_mot").addEventListener("blur", validateConfirmationMotDePasse);
document.getElementById("date").addEventListener("blur", validateDate);

// Validation globale au clic sur le bouton "Envoyer"
document.getElementById("test").addEventListener("submit", function (e) {
let isValid = true;

// Appeler toutes les fonctions de validation
isValid = validateNom() && isValid;
isValid = validatePrenom() && isValid;
isValid = validateTel() && isValid;
isValid = validateEmail() && isValid;
isValid = validateConfirmationEmail() && isValid;
isValid = validateMotDePasse() && isValid;
isValid = validateConfirmationMotDePasse() && isValid;
isValid = validateDate() && isValid;

// Bloquer la soumission si la validation échoue
if (!isValid) {
    e.preventDefault(); // Empêche la soumission si des champs sont invalides
}
// Sinon, les données sont transmises normalement
});
};

// Fonction de validation pour chaque champ (inchangée)
function validateNom() {
var nom = document.getElementById("nom").value;
var nomError = document.getElementById("nomError");
var nameRegex = /^[A-Za-zéèàêîïôûç]+$/;
if (nom.trim() === "" || !nameRegex.test(nom)) {
nomError.textContent = "Le nom doit être valide.";
return false;
} else {
nomError.textContent = "";
return true;
}
}

function validatePrenom() {
var prenom = document.getElementById("prenom").value;
var prenomError = document.getElementById("prenomError");
var nameRegex = /^[A-Za-zéèàêîïôûç]+$/;
if (prenom.trim() === "" || !nameRegex.test(prenom)) {
prenomError.textContent = "Le prénom doit être valide.";
return false;
} else {
prenomError.textContent = "";
return true;
}
}

function validateTel() {
var tel = document.getElementById("tel").value;
var telError = document.getElementById("telError");
var telRegex = /^[0-9]{9}$/;
if (!telRegex.test(tel)) {
telError.textContent = "Le téléphone doit être valide.";
return false;
} else {
telError.textContent = "";
return true;
}
}

function validateEmail() {
var email = document.getElementById("email").value;
var emailError = document.getElementById("emailError");
var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
if (!emailRegex.test(email)) {
emailError.textContent = "L'email doit être valide.";
return false;
} else {
emailError.textContent = "";
return true;
}
}

function validateConfirmationEmail() {
var email = document.getElementById("email").value;
var confirmationEmail = document.getElementById("confirmation").value;
var confirmationEmailError = document.getElementById("confirmationEmailError");
if (confirmationEmail !== email) {
confirmationEmailError.textContent = "Les emails doivent correspondre.";
return false;
} else {
confirmationEmailError.textContent = "";
return true;
}
}

function validateMotDePasse() {
var mot = document.getElementById("mot").value;
var motError = document.getElementById("motError");
if (mot.length < 6) {
motError.textContent = "6 caractères minimum.";
return false;
}
motError.textContent = "";
return true;
}

function validateConfirmationMotDePasse() {
var mot = document.getElementById("mot").value;
var confirmationMot = document.getElementById("confirmation_mot").value;
var confirmationMotError = document.getElementById("confirmationMotError");
if (confirmationMot !== mot) {
confirmationMotError.textContent = "Les mots de passe doivent correspondre.";
return false;
}
confirmationMotError.textContent = "";
return true;
}

function validateDate() {
var date = document.getElementById("date").value;
var dateError = document.getElementById("dateError");
if (date.trim() === "") {
dateError.textContent = "La date est obligatoire.";
return false;
}
dateError.textContent = "";
return true;
}

/*window.onload = function () {
    // Ajout des écouteurs d'événements 'blur' pour chaque champ
    document.getElementById("nom").addEventListener("blur", validateNom);
    document.getElementById("prenom").addEventListener("blur", validatePrenom);
    document.getElementById("tel").addEventListener("blur", validateTel);
    document.getElementById("email").addEventListener("blur", validateEmail);
    document.getElementById("confirmation").addEventListener("blur", validateConfirmationEmail);
    document.getElementById("mot").addEventListener("blur", validateMotDePasse);
    document.getElementById("confirmation_mot").addEventListener("blur", validateConfirmationMotDePasse);
    document.getElementById("date").addEventListener("blur", validateDate);

    // Ajout de la validation globale au bouton "Envoyer"
    document.getElementById("test").addEventListener("submit", function (e) {
        e.preventDefault(); // Empêche l'envoi par défaut pour vérifier les champs

        let isValid = true;

        // Appeler toutes les fonctions de validation
        isValid = validateNom() && isValid;
        isValid = validatePrenom() && isValid;
        isValid = validateTel() && isValid;
        isValid = validateEmail() && isValid;
        isValid = validateConfirmationEmail() && isValid;
        isValid = validateMotDePasse() && isValid;
        isValid = validateConfirmationMotDePasse() && isValid;
        isValid = validateDate() && isValid;

        // Si tout est valide, autoriser l'envoi
        if (isValid) {
            this.submit();
        }
    });
};
// Fonction de validation pour chaque champ
function validateNom() {
    var nom = document.getElementById("nom").value;
    var nomError = document.getElementById("nomError");
    var nameRegex = /^[A-Za-zéèàêîïôûç]+$/; // Regex pour les lettres et caractères spéciaux
    if (nom.trim() === "" || !nameRegex.test(nom)) {
        nomError.textContent = "Le nom doit être une chaîne de caractères valide.";
        return false;
    } else {
        nomError.textContent = "";
        return true;
    }
}

function validatePrenom() {
    var prenom = document.getElementById("prenom").value;
    var prenomError = document.getElementById("prenomError");
    var nameRegex = /^[A-Za-zéèàêîïôûç]+$/;
    if (prenom.trim() === "" || !nameRegex.test(prenom)) {
        prenomError.textContent = "Le prénom doit être une chaîne de caractères valide.";
        return false;
    } else {
        prenomError.textContent = "";
        return true;
    }
}

function validateTel() {
    var tel = document.getElementById("tel").value;
    var telError = document.getElementById("telError");
    var telRegex = /^[0-9]{9}$/;
    if (!telRegex.test(tel)) {
        telError.textContent = "Le numéro de téléphone doit être valide.";
        return false;
    } else {
        telError.textContent = "";
        return true;
    }
}

function validateEmail() {
    var email = document.getElementById("email").value;
    var emailError = document.getElementById("emailError");
    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailRegex.test(email)) {
        emailError.textContent = "L'email doit être valide (ex: example@domain.com).";
        return false;
    } else {
        emailError.textContent = "";
        return true;
    }
}

function validateConfirmationEmail() {
    var email = document.getElementById("email").value;
    var confirmationEmail = document.getElementById("confirmation").value;
    var confirmationEmailError = document.getElementById("confirmationEmailError");
    if (confirmationEmail !== email) {
        confirmationEmailError.textContent = "Les emails ne correspondent pas.";
        return false;
    } else {
        confirmationEmailError.textContent = "";
        return true;
    }
}

function validateMotDePasse() {
    var mot = document.getElementById("mot").value;
    var motError = document.getElementById("motError");
    var motRegex = /.*[0-9].*/
    /*
    if (mot.length < 6) {
        motError.textContent = "Le mot de passe doit comporter au moins 6 caractères.";
        return false;
    } else if (!motRegex.test(mot)) {
        motError.textContent = "Le mot de passe doit contenir au moins un chiffre.";
        return false;
    } else {
        motError.textContent = "";
        return true;
    }
}

function validateConfirmationMotDePasse() {
    var mot = document.getElementById("mot").value;
    var confirmationMot = document.getElementById("confirmation_mot").value;
    var confirmationMotError = document.getElementById("confirmationMotError");
    if (confirmationMot !== mot) {
        confirmationMotError.textContent = "Les mots de passe ne correspondent pas.";
        return false;
    } else {
        confirmationMotError.textContent = "";
        return true;
    }
}

function validateDate() {
    var date = document.getElementById("date").value;
    var dateError = document.getElementById("dateError");
    if (date.trim() === "") {
        dateError.textContent = "La date de naissance est obligatoire.";
        return false;
    } else {
        dateError.textContent = "";
        return true;
    }
}*/

