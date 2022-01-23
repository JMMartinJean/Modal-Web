var like = document.getElementById("like");
like.isFull = false;
like.display = function (state, highlight) {
    this.src = "images/like_" + state + ".png";
    this.style.border = "solid gray " + (highlight ? "5" : "1") + "px";
    this.style.margin = (highlight ? "1px" : "5px");
};
like.to = function (state) {
    this.src = "images/like_" + state + ".png";
    this.style.border = "solid gray 1px";
    this.style.margin = "5px";
    this.isFull = (state === "full");
    console.log("test");
    $.post('scripts/like_unlike.php', {increment:(state==="full" ? 1 : -1)}, function(rep) {alert(rep);});
};

like.addEventListener("mouseover", function () {
    if (this.isFull) {
        this.display("empty", true);
    } else {
        this.display("full", true);
    }
});
like.addEventListener("mouseout", function () {
    if (this.isFull) {
        this.display("full", false);
    } else {
        this.display("empty", false);
    }
});
like.addEventListener("click", function () {
    if (this.isFull) {
        this.to("empty");
    } else {
        this.to("full");
    }
});
