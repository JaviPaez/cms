tinymce.init({
    /* replace textarea having class .tinymce with tinymce editor */
    selector: "textarea.tinymce",
    language: "es_MX",
    entity_encoding: "raw",

    /* toolbar */
    toolbar_mode: 'wrap',
    toolbar: "insertfile undo redo | fontfamily fontsize styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | forecolor backcolor | print preview fullscreen |  charmap emoticons | removeformat | codesample code | help",

    /* statusbar */
    //statusbar: false,

    /* additional plugins */
    plugins: ['lists', 'link', 'image', 'media', 'table', 'charmap', 'emoticons', 'preview', 'fullscreen', 'searchreplace', 'code', 'codesample', 'wordcount', 'help'],

    /* Upgrade button */
    promotion: false,
});