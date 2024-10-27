<?php
/**
 * Servie Icon uploader JS conditional rendering
 *
 * @return void
 */
function constructionn_pro_service_icon_admin_scripts() {
	global $post_type;

	if ( 'service' == $post_type ) {
		// Use minified libraries if SCRIPT_DEBUG is false
		$build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? 'unminify/' : '';
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
		wp_enqueue_script(
			'constructionn-pro-department-init',
			get_template_directory_uri() . '/inc/meta/assets/' . $build . 'init' . $suffix . '.js',
			array( 'jquery' ),
			CONSTRUCTIONN_PRO_VERSION,
			true
		);
	}
}
add_action( 'admin_enqueue_scripts', 'constructionn_pro_service_icon_admin_scripts' );

/**
 * Constructionn_Pro Metabox for Sidebar Layout
 *
 * @package Constructionn_Pro
 */
function constructionn_pro_add_sidebar_layout_box() {
	add_meta_box(
		'constructionn_pro_sidebar_layout',
		__( 'Sidebar Layout', 'constructionn-pro' ),
		'constructionn_pro_sidebar_layout_callback',
		array( 'page', 'post', 'service' ),
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'constructionn_pro_add_sidebar_layout_box' );

function constructionn_pro_sidebar_layout_callback( $post ) {
	$sidebar_layout = array(
		'default'       => array(
			'value'     => 'default',
			'label'     => __( 'Default Sidebar', 'constructionn-pro' ),
			'thumbnail' => get_template_directory_uri() . '/assets/images/sidebar/default.png',
		),
		'full-width'    => array(
			'value'     => 'full-width',
			'label'     => __( 'Full Sidebar', 'constructionn-pro' ),
			'thumbnail' => get_template_directory_uri() . '/assets/images/sidebar/full-width.jpg',
		),
		'left-sidebar'  => array(
			'value'     => 'left-sidebar',
			'label'     => __( 'Left Sidebar', 'constructionn-pro' ),
			'thumbnail' => get_template_directory_uri() . '/assets/images/sidebar/left.jpg',
		),
		'right-sidebar' => array(
			'value'     => 'right-sidebar',
			'label'     => __( 'Right Sidebar', 'constructionn-pro' ),
			'thumbnail' => get_template_directory_uri() . '/assets/images/sidebar/right.jpg',
		),
	);
	// Output the nonce field
	wp_nonce_field( 'constructionn_pro_sidebar_nonce', 'constructionn_pro_sidebar_nonce' );
	?>     
	<div>
		<h4>
			<?php esc_html_e( 'Choose Sidebar Template', 'constructionn-pro' ); ?>
		</h4>

		<div class="sidebar-layout" >
			<?php
			foreach ( $sidebar_layout as $layout ) {
				$value = get_post_meta( $post->ID, 'constructionn_pro_sidebar_layout', true );
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

function constructionn_pro_save_sidebar_layout( $post_id ) {

	// Verify the nonce before proceeding.
	if ( ! isset( $_POST['constructionn_pro_sidebar_nonce'] ) || ! wp_verify_nonce( $_POST['constructionn_pro_sidebar_nonce'], 'constructionn_pro_sidebar_nonce' ) ) {
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
			update_post_meta( $post_id, 'constructionn_pro_sidebar_layout', $selected_layout );
		} else {
			// If the selected layout is not valid, default to 'full-width' or handle the error appropriately
			update_post_meta( $post_id, 'constructionn_pro_sidebar_layout', 'full-width' );
		}
	}
}
add_action( 'save_post', 'constructionn_pro_save_sidebar_layout' );

/**
 * Constructionn_Pro Metabox for Icon Uploader for cpt
 *
 * @package Constructionn_Pro
 */
function constructionn_pro_icon_uploader() {
	add_meta_box(
		'constructionn_pro_icon_upload',
		__( 'Upload Post Icon', 'constructionn-pro' ),
		'constructionn_pro_icon_uploader_callback',
		'service',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'constructionn_pro_icon_uploader' );

function constructionn_pro_icon_uploader_callback( $post ) {
	// Add a nonce field
	wp_nonce_field( 'constructionn_pro_img_uploader', 'constructionn_pro_img_meta_box_nonce' );

	// Get the current image URL
	$current_image_url = get_post_meta( $post->ID, '_constructionn_pro_image_url', true );

	// Output the HTML for the image upload field
	?>
	<label for="constructionn_pro_image"><?php esc_html_e( 'Upload Image:', 'constructionn-pro' ); ?></label>
	<input type="hidden" id="constructionn_pro_image" name="constructionn_pro_image" value="<?php echo esc_attr( $current_image_url ); ?>">
	<div id="constructionn_pro_image_preview">
		<?php if ( $current_image_url ) : ?>
			<img src="<?php echo esc_url( $current_image_url ); ?>" style="max-width: 100%;">
		<?php endif; ?>
	</div>
	<div id="constructionn_pro_btn__wrapper">
		<button href="#" id="constructionn_pro_upload_btn" class="button">
			<?php echo $current_image_url ? __( 'Replace Image', 'constructionn-pro' ) : __( 'Upload Image', 'constructionn-pro' ); ?>
		</button>
		<button id="constructionn_pro_remove_image_button" class="button">
			<?php esc_html_e( 'Remove Image', 'constructionn-pro' ); ?>
		</button>
	</div>
	<?php
}

function constructionn_pro_save_icon_uploader( $post_id ) {
	// Check if nonce is set
	if ( ! isset( $_POST['constructionn_pro_img_meta_box_nonce'] ) ) {
		return;
	}

	// Verify nonce
	if ( ! wp_verify_nonce( $_POST['constructionn_pro_img_meta_box_nonce'], 'constructionn_pro_img_uploader' ) ) {
		return;
	}

	// Check if this is an autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Save image URL
	if ( isset( $_POST['constructionn_pro_image'] ) ) {
		update_post_meta( $post_id, '_constructionn_pro_image_url', sanitize_text_field( $_POST['constructionn_pro_image'] ) );
	}
}
add_action( 'save_post', 'constructionn_pro_save_icon_uploader' );

// Register meta box for testimonial
function constructionn_pro_testimonials_meta_box() {
	add_meta_box(
		'testimonial_details_metas',
		__( 'Testimonial Details', 'constructionn-pro' ),
		'constructionn_pro_render_testimonial_meta_box',
		'testimonial',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'constructionn_pro_testimonials_meta_box' );

function constructionn_pro_render_testimonial_meta_box() {
	global $post;

	wp_nonce_field( basename( __FILE__ ), 'constructionn_pro_testimonial_meta_nonce' );
	?>

	<div class="mp-meta-field">
		<?php $designation = get_post_meta( $post->ID, '_constructionn_pro_designation', true ); ?>
		<div class="team-details">
			<div class="clearfix">
				<label class="bold-label float-left input_label" for="lfp_designation"><?php esc_html_e( 'Designation', 'constructionn-pro' ); ?></label>
				<div class="below_row_input float-left"><input id="lfp_designation" type="text" name="lfp_designation" value="<?php echo esc_attr( $designation ); ?>" /></div>
			</div>
		</div>
	</div>
	<?php
}

function constructionn_pro_testimonial_save_callback( $post_id ) {
	// Check if our nonce is set.
	if ( ! isset( $_POST['constructionn_pro_testimonial_meta_nonce'] ) || ! wp_verify_nonce( $_POST['constructionn_pro_testimonial_meta_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( isset( $_POST['post_type'] ) ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	$designation = isset( $_POST['lfp_designation'] ) ? sanitize_text_field( $_POST['lfp_designation'] ) : '';

	update_post_meta( $post_id, '_constructionn_pro_designation', $designation );
}
add_action( 'save_post', 'constructionn_pro_testimonial_save_callback' );


// Register meta box for history
function add_custom_meta_box() {
	add_meta_box(
		'history_details_metas',
		__( 'History Details', 'constructionn-pro' ),
		'constructionn_pro_render_history_meta_box',
		'history',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'add_custom_meta_box' );

function constructionn_pro_render_history_meta_box( $post ) {

	$custom_month = get_post_meta( $post->ID, '_custom_month_meta_key', true );
	$custom_year  = get_post_meta( $post->ID, '_custom_year_meta_key', true );
	?>
		<label for="custom_month"><?php esc_html_e( 'Custom Month', 'constructionn-pro' ); ?></label>
	<select name="custom_month">
		<option value=""><?php esc_html_e( 'Select Month', 'constructionn-pro' ); ?></option>
		<?php
			$months = array(
				'Jan',
				'Feb',
				'March',
				'Apr',
				'May',
				'June',
				'July',
				'Aug',
				'Sep',
				'Oct',
				'Nov',
				'Dec',
			);
			foreach ( $months as $month ) {
				printf(
					'<option value="%s" %s>%s</option>',
					esc_attr( $month ),
					selected( $custom_month, $month, false ),
					esc_html( $month )
				);
			}
			?>
	</select>
	<br>
	<label for="custom_year"><?php esc_html_e( 'Custom Year', 'constructionn-pro' ); ?></label>
	<select name="custom_year">
		<option value=""><?php esc_html_e( 'Select Year', 'constructionn-pro' ); ?></option>
		<?php
			$current_year = date( 'Y' );
		for ( $year = 1900; $year <= $current_year; $year++ ) {
			printf(
				'<option value="%s" %s>%s</option>',
				esc_attr( $year ),
				selected( $custom_year, $year, false ),
				esc_html( $year )
			);
		}
		?>
	</select>
	<?php
	// Add nonce for security and authentication
	wp_nonce_field( 'constructionn_pro_history_meta_box', 'constructionn_pro_history_meta_box_nonce' );
}

function constructionn_pro_datepicker_save_callback( $post_id ) {
	// check if the nonce is set
	if ( ! isset( $_POST['constructionn_pro_history_meta_box_nonce'] ) ) {
		return $post_id;
	}
	// verify the nonce is valid
	if ( ! wp_verify_nonce( $_POST['constructionn_pro_history_meta_box_nonce'], 'constructionn_pro_history_meta_box' ) ) {
		return $post_id;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// check if the suer has permission to edit the post
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	if ( isset( $_POST['custom_month'] ) ) {
		update_post_meta( $post_id, '_custom_month_meta_key', sanitize_text_field( $_POST['custom_month'] ) );
	}

	if ( isset( $_POST['custom_year'] ) ) {
		update_post_meta( $post_id, '_custom_year_meta_key', sanitize_text_field( $_POST['custom_year'] ) );
	}
}
add_action( 'save_post', 'constructionn_pro_datepicker_save_callback' );

/**
 * Team Meta Start from here...
 */

/**
 * Team Single Social Link Meta
 */
function constructionn_pro_add_team_meta_box() {
	add_meta_box(
		'team_social_links',
		__( 'Social Links', 'constructionn-pro' ),
		'constructionn_pro_team_social_links_callback',
		array( 'team', 'case-study' ),
		'side',
		'high',
	);
}
add_action( 'add_meta_boxes', 'constructionn_pro_add_team_meta_box' );

function constructionn_pro_team_social_links_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'team_social_links_nonce' );

	$defaults = constructionn_pro_get_social_icons();

	$social_icons = get_post_meta( $post->ID, '_team_social_icons', true );
	$social_icons = $social_icons ? $social_icons : $defaults;
	?>
	<ul class="gl-sortable-icons">
		<?php foreach ( $social_icons as $key => $value ) { ?>
			<li>
				<label for="<?php echo esc_attr( $key ); ?>">
					<?php printf( esc_html__( '%s :', 'constructionn-pro' ), ucfirst( $key ) ); ?>
				</label>
				<input type="text" name="team_social_icons[<?php echo esc_attr( $key ); ?>]" id="<?php echo esc_attr( $key ); ?>" value="<?php echo isset( $value ) ? esc_attr( $value ) : ''; ?>" class="regular-text" /><br />
				<span class="description"><?php printf( esc_html__( 'Please enter your %s Url.', 'constructionn-pro' ), ucfirst( $key ) ); ?></span>
			</li>
		<?php } ?>
	</ul>
	<?php
}

function constructionn_pro_save_team_social_links( $post_id ) {
	// Check if nonce is set.
	if ( ! isset( $_POST['team_social_links_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['team_social_links_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Sanitize and save the data
	$socials = array();
	if ( isset( $_POST['team_social_icons'] ) ) {
		foreach ( $_POST['team_social_icons'] as $key => $links ) {
			$socials[ $key ] = esc_url_raw( $links );
		}
		update_post_meta( $post_id, '_team_social_icons', $socials );
	}
}
add_action( 'save_post', 'constructionn_pro_save_team_social_links' );

// Register meta box for team designation
function constructionn_pro_team_meta_box() {
	add_meta_box(
		'team_details_metas',
		__( 'Team Details', 'constructionn-pro' ),
		'constructionn_pro_render_team_meta_box',
		'team',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'constructionn_pro_team_meta_box' );

function constructionn_pro_render_team_meta_box() {
	global $post;

	wp_nonce_field( basename( __FILE__ ), 'constructionn_pro_testimonial_meta_nonce' );
	?>

	<div class="mp-meta-field">
		<?php $designation = get_post_meta( $post->ID, '_constructionn_pro_designation', true ); ?>
		<div class="team-details">
			<div class="clearfix">
				<label class="bold-label float-left input_label" for="lfp_designation"><?php esc_html_e( 'Designation', 'constructionn-pro' ); ?></label>
				<div class="below_row_input float-left"><input id="lfp_designation" type="text" name="lfp_designation" value="<?php echo esc_attr( $designation ); ?>" /></div>
			</div>
		</div>
	</div>
	<?php
}

function constructionn_pro_team_save_callback( $post_id ) {
	// Check if our nonce is set.
	if ( ! isset( $_POST['constructionn_pro_testimonial_meta_nonce'] ) || ! wp_verify_nonce( $_POST['constructionn_pro_testimonial_meta_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( isset( $_POST['post_type'] ) ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	$designation = isset( $_POST['lfp_designation'] ) ? sanitize_text_field( $_POST['lfp_designation'] ) : '';

	update_post_meta( $post_id, '_constructionn_pro_designation', $designation );
}
add_action( 'save_post', 'constructionn_pro_team_save_callback' );

// register metabox for team description
function constructionn_pro_team_description_meta_box() {
	add_meta_box(
		'team_description_metas',
		__( 'Team Description', 'constructionn-pro' ),
		'constructionn_pro_render_team_description_meta_box',
		'team',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'constructionn_pro_team_description_meta_box' );

function constructionn_pro_render_team_description_meta_box() {
	global $post;

	wp_nonce_field( basename( __FILE__ ), 'constructionn_pro_team_description_meta_nonce' );
	?>

	<div class="mp-meta-field">
		<?php $description = get_post_meta( $post->ID, '_constructionn_pro_team_description', true ); ?>
		<div class="team-details">
			<div class="clearfix">
				<label class="bold-label float-left input_label" for="cp_team_desc"><?php esc_html_e( 'Description', 'constructionn-pro' ); ?></label>
				<div class="below_row_input float-left">
					<textarea id="cp_team_desc" type="text" name="cp_team_desc" value="<?php echo esc_attr( $description ); ?>">
						<?php echo esc_html( $description ); ?>
					</textarea>
				</div>
			</div>
		</div>
	</div>
	<?php
}

function constructionn_pro_team_description_save_callback( $post_id ) {
	// Check if our nonce is set.
	if ( ! isset( $_POST['constructionn_pro_team_description_meta_nonce'] ) || ! wp_verify_nonce( $_POST['constructionn_pro_team_description_meta_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( isset( $_POST['post_type'] ) ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	$description = isset( $_POST['cp_team_desc'] ) ? sanitize_text_field( $_POST['cp_team_desc'] ) : '';

	update_post_meta( $post_id, '_constructionn_pro_team_description', $description );
}
add_action( 'save_post', 'constructionn_pro_team_description_save_callback' );

// Register metabox for project details
function constructionn_pro_project_details_meta_box() {
	add_meta_box(
		'project_details_metas',
		__( 'Project Details', 'constructionn-pro' ),
		'constructionn_pro_render_project_details_meta_box',
		array( 'project', 'case-study' ),
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'constructionn_pro_project_details_meta_box' );

function constructionn_pro_render_project_details_meta_box() {
	global $post;

	wp_nonce_field( basename( __FILE__ ), 'constructionn_pro_project_details_meta_nonce' );

	// Get meta values
	$location     = get_post_meta( $post->ID, '_constructionn_pro_location', true );
	$client       = get_post_meta( $post->ID, '_constructionn_pro_client', true );
	$date         = get_post_meta( $post->ID, '_constructionn_pro_date', true );
	$service_type = get_post_meta( $post->ID, '_constructionn_pro_service_type', true );

	// Fetch services from the 'service' custom post type
	$services = get_posts(
		array(
			'post_type'      => 'service',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
		)
	);
	?>

	<div class="mp-meta-field">
		<p>
			<label for="cp_project_location"><?php esc_html_e( 'Location:', 'constructionn-pro' ); ?></label>
			<input type="text" id="cp_project_location" name="cp_project_location" value="<?php echo esc_attr( $location ); ?>" />
		</p>

		<p>
			<label for="cp_project_client"><?php esc_html_e( 'Client:', 'constructionn-pro' ); ?></label>
			<input type="text" id="cp_project_client" name="cp_project_client" value="<?php echo esc_attr( $client ); ?>" />
		</p>

		<p>
			<label for="cp_project_date"><?php esc_html_e( 'Date:', 'constructionn-pro' ); ?></label>
			<input type="date" id="cp_project_date" name="cp_project_date" value="<?php echo esc_attr( $date ); ?>" />
		</p>

		<p>
			<label for="cp_project_service_type"><?php esc_html_e( 'Service Type:', 'constructionn-pro' ); ?></label>
			<select id="cp_project_service_type" name="cp_project_service_type">
				<option value=""><?php esc_html_e( 'Select a Service', 'constructionn-pro' ); ?></option>
				<?php if ( ! empty( $services ) ) { ?>
					<?php foreach ( $services as $service ) { ?>
						<option value="<?php echo esc_attr( $service->ID ); ?>" <?php selected( $service_type, $service->ID ); ?>>
							<?php echo esc_html( $service->post_title ); ?>
						</option>
					<?php } ?>
				<?php } ?>
			</select>
		</p>
	</div>
	<?php
}

// Save meta box data
function constructionn_pro_project_details_save_callback( $post_id ) {
	// Verify nonce
	if ( ! isset( $_POST['constructionn_pro_project_details_meta_nonce'] ) || ! wp_verify_nonce( $_POST['constructionn_pro_project_details_meta_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

	// Check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check user capabilities
	if ( isset( $_POST['post_type'] ) && 'project' === $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	// Save Location
	$location = isset( $_POST['cp_project_location'] ) ? sanitize_text_field( $_POST['cp_project_location'] ) : '';
	update_post_meta( $post_id, '_constructionn_pro_location', $location );

	// Save Client
	$client = isset( $_POST['cp_project_client'] ) ? sanitize_text_field( $_POST['cp_project_client'] ) : '';
	update_post_meta( $post_id, '_constructionn_pro_client', $client );

	// Save Date
	$date = isset( $_POST['cp_project_date'] ) ? sanitize_text_field( $_POST['cp_project_date'] ) : '';
	update_post_meta( $post_id, '_constructionn_pro_date', $date );

	// Save Service Type
	$service_type = isset( $_POST['cp_project_service_type'] ) ? sanitize_text_field( $_POST['cp_project_service_type'] ) : '';
	update_post_meta( $post_id, '_constructionn_pro_service_type', $service_type );
}
add_action( 'save_post', 'constructionn_pro_project_details_save_callback' );
