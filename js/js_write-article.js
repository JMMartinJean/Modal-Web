tinymce.init({
    forced_root_block: 'div',
    selector: '#contenu',
    plugins: [
        'advlist autolink link image lists charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
        'table emoticons template paste help'
    ],

    menu: {
        perso: {title: 'Format', items: 'blockformats fontformats fontsizes | forecolor backcolor'},
    },
    menubar: 'perso edit table link help',
    toolbar: 'undo redo | styleselect | bold italic underline| alignleft aligncenter alignright alignjustify | indent outdent link | '
            + 'strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align lineheight',
    content_css: 'css/write-article.css',
});
