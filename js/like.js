var like = document.getElementById("like");
like.isFull = (like.src.split('/').pop() === "like_full.png");
//console.log(like.src.split('/').pop()); console.log(like.isFull);
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
    $.post('scripts/like_unlike.php', {increment: (state === "full" ? 1 : -1), id_article: this.dataset['id_article']}, function (rep) {
        $("#debug").html(rep);
    });
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
    //console.log($(".navigate"));
});
like.addEventListener("click", function () {
    if (this.isFull) {
        this.to("empty");
    } else {
        this.to("full");
    }
});
