

$("#change_username").click(function() {
    event.preventDefault();
    $.post('scripts/change_stuff.php', {username:$("#username").val()}, function(rep) {
        $("#alert_username").html(rep);
    });
});

var onChange = function(e) {
    $("#change_password").attr('disabled','true');
    var passw1 = $("#new-password").val(),
        passw2 = $("#new-password-confirm").val();
    if (passw1.length < 8) {
        $("#alert_password").html("<div class='errormsg'>Le mot de passe est trop court.</div>");
    } else if (passw1 != passw2) {
        $("#alert_password").html("<div class='errormsg'>Les mots de passe ne correspondent pas.</div>");
    } else {
        $("#alert_password").html("");
        document.getElementById("change_password").disabled = false;
    }
}
onChange();
document.getElementById("new-password").addEventListener("input", onChange);
document.getElementById("new-password-confirm").addEventListener("input", onChange);

$("#change_password").click(function() {
    event.preventDefault();
    $.post('scripts/change_stuff.php', {
        password: $("#currpassword").val(),
        newpassword:$("#new-password").val(),
        newpasswordconfirm:$("#new-password-confirm").val(),
    }, function(rep) {
        console.log(rep);
        $("#alert_password").html(rep);
    });
});