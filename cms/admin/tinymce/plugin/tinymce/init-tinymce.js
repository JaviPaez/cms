tinymce.init({
    /* replace textarea having class .tinymce with tinymce editor */
    selector: "textarea.tinymce",
    language: "es_MX",

    /* toolbar */
    toolbar: "insertfile undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | removeformat | code | help",

    /* statusbar */
    //statusbar: false,

    /* additional plugins */
    plugins: ['lists', 'image', 'link', 'media', 'table', 'charmap', 'preview', 'searchreplace', 'code', 'wordcount', 'help'],

    /* Upgrade button */
    promotion: false,
});