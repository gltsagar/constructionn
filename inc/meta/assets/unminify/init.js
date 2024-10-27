jQuery(document).ready(function($) {
    var customUploader;

    $('#constructionn_pro_upload_btn').click(function(e) {
        e.preventDefault();
        
        if (customUploader) {
            customUploader.open();
            return;
        }
    
        customUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
    
        customUploader.on('select', function() {
            var attachment = customUploader.state().get('selection').first().toJSON();
            $('#constructionn_pro_image').val(attachment.url);
            $('#constructionn_pro_image_preview').html('<img src="' + attachment.url + '" style="max-width: 100%;">');
            $('#constructionn_pro_upload_btn').text('Replace Image');
            $('#constructionn_pro_remove_image_button').show();
        });
    
        customUploader.open();
    });
    
    $('#constructionn_pro_btn__wrapper').on('click', '#constructionn_pro_remove_image_button', function() {
        $('#constructionn_pro_image').val('');
        $('#constructionn_pro_image_preview').html('');
        $('#constructionn_pro_upload_btn').text('Upload Image');
        $('#constructionn_pro_remove_image_button').hide();
    });
    
    // Hide the remove button initially if there's no image to replace
    if ($('#constructionn_pro_image').val() === '') {
        $('#constructionn_pro_remove_image_button').hide();
    }
});

