var onChange = function(e) {
    document.getElementById("creercompte").disabled = true;
    var passw1 = document.getElementById("password").value,
        passw2 = document.getElementById("checkPassword").value;
    if (passw1.length < 8) {
        document.getElementById("messagePassw").innerHTML = "Le mot de passe est trop court.";
    } else if (passw1 != passw2) {
        document.getElementById("messagePassw").innerHTML = "Les mots de passe ne correspondent pas.";
    } else {
        document.getElementById("messagePassw").innerHTML = "<br>";
        document.getElementById("creercompte").disabled = false;
    }
}
onChange();
document.getElementById("password").addEventListener("input", onChange);
document.getElementById("checkPassword").addEventListener("input", onChange);
