<?php
/**
 * constructionn_pro Metabox for User Profile
 *
 * @package constructionn_pro
 */
function constructionn_pro_sortable_scripts( $hook ) {
	// Use minified libraries if SCRIPT_DEBUG is false
	$build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? 'unminify/' : '';
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	if ( $hook === 'profile.php' || $hook === 'user-edit.php' ||
		( $hook === 'post.php' || $hook === 'post-new.php' ) && get_post_type() === 'team' ) {
		wp_enqueue_script(
			'constructionn-pro-admin-user-sortable',
			get_template_directory_uri() . '/inc/meta/assets/' . $build . 'sortable' . $suffix . '.js',
			array( 'jquery', 'jquery-ui-sortable' ),
			CONSTRUCTIONN_PRO_VERSION,
			true
		);
	}
}
add_action( 'admin_enqueue_scripts', 'constructionn_pro_sortable_scripts' );

/**
 * User Profile Extra Fields
 */
function constructionn_pro_user_fields( $user ) {

	wp_nonce_field( basename( __FILE__ ), '_social_profile_fields_nonce' );

	if ( is_string( $user ) === true ) {
		$user = new stdClass();// create a new
		$id   = -9999;
		unset( $user );
	} else {
		$id = $user->ID;
	}

	$defaults     = constructionn_pro_get_social_icons();
	$social_icons = get_user_meta( $id, '_constructionn_pro_user_social_icons', true );

	$social_icons = $social_icons ? $social_icons : $defaults; ?>
	
	<h3><?php esc_html_e( 'User Social Link', 'constructionn-pro' ); ?></h3>
	
	<ul class="gl-sortable-icons">    
		<?php foreach ( $social_icons as $k => $v ) { ?>        
		<li>
			<label for="<?php echo esc_attr( $k ); ?>"><?php printf( esc_html__( '%s :', 'constructionn-pro' ), ucfirst( $k ) ); ?></label>            
			<input type="text" name="constructionn_pro_user_social_icons[<?php echo esc_attr( $k ); ?>]" id="<?php echo esc_attr( $k ); ?>" value="<?php echo isset( $v ) ? esc_attr( $v ) : ''; ?>" class="regular-text" /><br />
			<span class="description"><?php printf( esc_html__( 'Please enter your %s Url.', 'constructionn-pro' ), ucfirst( $k ) ); ?></span>
		<?php } ?>                  
	</ul>
	<?php
}
add_action( 'show_user_profile', 'constructionn_pro_user_fields' );
add_action( 'edit_user_profile', 'constructionn_pro_user_fields' );
add_action( 'user_new_form', 'constructionn_pro_user_fields' );

/**
 * Saving Extra User Profile Information
 */
function constructionn_pro_save_user_fields( $user_id ) {
	$socials = array();
	// Check if our nonce is set.
	if ( ! isset( $_POST['_social_profile_fields_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['_social_profile_fields_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

	if ( isset( $_POST['constructionn_pro_user_social_icons'] ) ) {
		foreach ( $_POST['constructionn_pro_user_social_icons'] as $key => $links ) {
			$socials[ $key ] = esc_url_raw( $links );
		}
		update_user_meta( $user_id, '_constructionn_pro_user_social_icons', $socials );
	}
}
add_action( 'personal_options_update', 'constructionn_pro_save_user_fields' );
add_action( 'edit_user_profile_update', 'constructionn_pro_save_user_fields' );
add_action( 'user_register', 'constructionn_pro_save_user_fields' );
