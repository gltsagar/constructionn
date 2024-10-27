<?php
/**
 * Constructionn Metabox for Sidebar Layout
 *
 * @package Constructionn
 */
function constructionn_add_sidebar_layout_box() {
	add_meta_box(
		'constructionn_sidebar_layout',
		__( 'Sidebar Layout', 'constructionn' ),
		'constructionn_sidebar_layout_callback',
		array( 'page', 'post', 'service' ),
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'constructionn_add_sidebar_layout_box' );

function constructionn_sidebar_layout_callback( $post ) {
	$sidebar_layout = array(
		'default'       => array(
			'value'     => 'default',
			'label'     => __( 'Default Sidebar', 'constructionn' ),
			'thumbnail' => get_template_directory_uri() . '/assets/images/sidebar/default.png',
		),
		'full-width'    => array(
			'value'     => 'full-width',
			'label'     => __( 'Full Sidebar', 'constructionn' ),
			'thumbnail' => get_template_directory_uri() . '/assets/images/sidebar/full-width.jpg',
		),
		'left-sidebar'  => array(
			'value'     => 'left-sidebar',
			'label'     => __( 'Left Sidebar', 'constructionn' ),
			'thumbnail' => get_template_directory_uri() . '/assets/images/sidebar/left.jpg',
		),
		'right-sidebar' => array(
			'value'     => 'right-sidebar',
			'label'     => __( 'Right Sidebar', 'constructionn' ),
			'thumbnail' => get_template_directory_uri() . '/assets/images/sidebar/right.jpg',
		),
	);
	// Output the nonce field
	wp_nonce_field( 'constructionn_sidebar_nonce', 'constructionn_sidebar_nonce' );
	?>     
	<div>
		<h4>
			<?php esc_html_e( 'Choose Sidebar Template', 'constructionn' ); ?>
		</h4>

		<div class="sidebar-layout" >
			<?php
			foreach ( $sidebar_layout as $layout ) {
				$value = get_post_meta( $post->ID, 'constructionn_sidebar_layout', true );
				?>
					<div class="sidebar-option">
						<input 
							id="<?php echo esc_attr( $layout['value'] ); ?>" 
							type="radio" 
							name="mp_sidebar_layout" 
							value="<?php echo esc_attr( $layout['value'] ); ?>" 
							<?php
							checked( $layout['value'], $value );
							if ( empty( $value ) ) {
								checked( $layout['value'], 'default' );
							}
							?>
						/>
						<label class="description" for="<?php echo esc_attr( $layout['value'] ); ?>">
							<img src="<?php echo esc_url( $layout['thumbnail'] ); ?>" />                               
						</label>
					</div>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}

function constructionn_save_sidebar_layout( $post_id ) {

	// Verify the nonce before proceeding.
	if ( ! isset( $_POST['constructionn_sidebar_nonce'] ) || ! wp_verify_nonce( $_POST['constructionn_sidebar_nonce'], 'constructionn_sidebar_nonce' ) ) {
		return;
	}

	// Check if the user has permission to edit the post
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( isset( $_POST['mp_sidebar_layout'] ) ) {
		$selected_layout = sanitize_key( $_POST['mp_sidebar_layout'] );

		$valid_layouts = array(
			'default',
			'full-width',
			'left-sidebar',
			'right-sidebar',
		);

		if ( in_array( $selected_layout, $valid_layouts ) ) {
			update_post_meta( $post_id, 'constructionn_sidebar_layout', $selected_layout );
		} else {
			// If the selected layout is not valid, default to 'full-width' or handle the error appropriately
			update_post_meta( $post_id, 'constructionn_sidebar_layout', 'full-width' );
		}
	}
}
add_action( 'save_post', 'constructionn_save_sidebar_layout' );