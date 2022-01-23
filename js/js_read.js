$(document).on("click", ".navigate",function() {
    $.post('scripts/comments.php', {idArticle: this.dataset['idarticle'], page: this.dataset['page']}, function(rep) {
        $("#commentaires").html(rep);
    });
});
