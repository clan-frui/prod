jQuery(document).ready(function () {
    $("#uploadPicUser").fileinput({
        language: 'fr',
        showCaption: true,
        showPreview : true,
        showUpload : false,
        allowedFileExtensions : ['jpg', 'png'],
        maxFileCount: 1,
        maxFileSize : 5000,
        layoutTemplates: {
            main1: "{preview}\n" +
            "<div class=\'input-group {class}\'>\n" +
            "   <div class=\'input-group-btn\'>\n" +
            "       {browse}\n" +
            "       {upload}\n" +
            "       {remove}\n" +
            "   </div>\n" +
            "   {caption}\n" +
            "</div>"
        }
    });
});