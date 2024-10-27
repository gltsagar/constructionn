/** 
 * Scripts for the editor and the admin dashboard
 */
ConPro = jQuery.noConflict();
ConPro(function($) {
    $(document).on('click', '.gl-custom-admin-notice .notice-dismiss', function() {
        $.ajax({
            url: constructionn_pro_admin_data.ajax_url,
            type: 'POST',
            data: {
                action   : 'lfp_dismiss_admin_notice',
                nonce    : constructionn_pro_admin_data.nonce
            },
            success: function(response) {
                console.log(  response );
                if (response.success) {
                    $('.gl-custom-admin-notice').hide();
                }
            }
        });
    });
});