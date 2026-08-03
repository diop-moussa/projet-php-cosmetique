function togglePassword(btn) {

    console.log("Bouton cliqué");

    var targetId = btn.dataset.target;
    console.log("Target :", targetId);

    var input = document.getElementById(targetId);
    console.log(input);

    if (!input) {
        alert("Champ introuvable !");
        return;
    }

    var icon = btn.querySelector("i");

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }

    console.log("Type :", input.type);
}