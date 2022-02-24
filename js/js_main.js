$(document).on("click", ".navigate",function() {
    $.post('scripts/main_all-articles.php', {page: this.dataset['page']}, function(rep) {
        $("#main_all").html(rep);
    });
});


