tinymce.init({
    /* replace textarea having class .tinymce with tinymce editor */
    selector: "textarea.tinymce",
    language: "es_MX",

    /* toolbar */
    toolbar: "insertfile undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | code",

    /* statusbar */
    //statusbar: false

    /* additional plugins */
    plugins: 'code',

    /* Upgrade button */
    promotion: false

});