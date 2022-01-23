document.getElementById("green_btn").addEventListener("click", function () {
    document.getElementById("newstatut").value = "valide";
    document.getElementById("form_validation").submit();
});
document.getElementById("red_btn").addEventListener("click", function () {
    document.getElementById("newstatut").value = "refuse";
    document.getElementById("form_validation").submit();
});

