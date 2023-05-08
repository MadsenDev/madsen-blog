tinymce.init({
    selector: 'textarea#content', // Change this to target the desired textarea
    plugins: 'lists link image charmap preview', // Choose the plugins you want to include
    toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image | charmap preview',
    height: 400,
    images_upload_url: 'upload.php', // Add the image upload script URL
    file_picker_types: 'image', // Enable image picker
    file_picker_callback: function (callback, value, meta) {
        // Open the media gallery
        tinyMCE.activeEditor.windowManager.openUrl({
        title: 'Media Gallery',
        url: 'media_gallery.php', // URL of the media gallery script
        onMessage: function (api, data) {
            if (data.mceAction === 'selectImage') {
            callback(data.url, { alt: data.alt });
            api.close();
            }
        },
        });
    },
});