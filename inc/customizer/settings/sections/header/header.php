<?php

if ( ! function_exists( 'constructionn_customize_register_frontopbar' ) ) :
	/**
	 * Headers
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_frontopbar( $wp_customize ) {

		// Create a new section top bar settings----------
		$wp_customize->add_section(
			'top_bar_section',
			array(
				'title'    => esc_html__( 'Header Settings', 'constructionn' ),
				'priority' => 20,
				'panel'    => 'general_settings_panel',
			)
		);

		// Add the toggle control to the section
		$wp_customize->add_setting(
			'topbar_toggle',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'topbar_toggle',
				array(
					'label'       => esc_html__( 'Show/Hide Header', 'constructionn' ),
					'description' => esc_html__( 'Enable to show the header.', 'constructionn' ),
					'section'     => 'top_bar_section',
					'type'        => 'checkbox',
				)
			)
		);
		$wp_customize->add_setting(
			'header_layouts',
			array(
				'default'           => 'one',
				'sanitize_callback' => 'constructionn_radio_sanitization_header',
			)
		);

		$wp_customize->add_control(
			new GL_Radio_Image_Control(
				$wp_customize,
				'header_layouts',
				array(
					'label'           => __( 'Header Layout Settings', 'constructionn' ),
					'description'     => esc_html__( 'Choose the layout of the header for your site.', 'constructionn' ),
					'row'             => '2',
					'section'         => 'top_bar_section',
					'choices'         => array(
						'one'   => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/header-one.jpg',
							'name'  => __( 'Header One', 'constructionn' ),
						),
						'two'   => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/header-two.jpg',
							'name'  => __( 'Header Two', 'constructionn' ),
						),
						'three' => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/header-three.jpg',
							'name'  => __( 'Header Three', 'constructionn' ),
						),
						'four'  => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/header-four.jpg',
							'name'  => __( 'Header Four', 'constructionn' ),
						),
						'five'  => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/header-five.jpg',
							'name'  => __( 'Header Five', 'constructionn' ),
						),
					),
					'active_callback' => 'constructionn_fronttopbar_active_callback',
				)
			)
		);

		// Add setting and control for message text-> header 1, header 3
		$wp_customize->add_setting(
			'message_heading',
			array(
				'default'           => __( 'Summertime discounts sales.', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'message_heading',
			array(
				'selector'        => '.text-holder p',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'message_heading', __( 'Summertime discounts sales.', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'message_heading',
			array(
				'label'           => esc_html__( 'Message Heading', 'constructionn' ),
				'section'         => 'top_bar_section',
				'type'            => 'text',
				'active_callback' => 'constructionn_fronttopbar_active_callback',
			)
		);

		// Adding setting and control for Message Button link-> header 1, header 3
		$wp_customize->add_setting(
			'msg_btn_txt',
			array(
				'default'           => esc_html__( 'Learn More!', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'msg_btn_txt',
			array(
				'selector'        => '.text-holder a',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'msg_btn_txt', __( 'Learn More!', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'msg_btn_txt',
			array(
				'label'           => esc_html__( 'Message Button Text', 'constructionn' ),
				'section'         => 'top_bar_section',
				'type'            => 'text',
				'active_callback' => 'constructionn_fronttopbar_active_callback',
			)
		);

		// Adding setting and control for Message Button link-> header 1, header 3
		$wp_customize->add_setting(
			'msg_btn_link',
			array(
				'default'           => '#',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'msg_btn_link',
			array(
				'label'           => esc_html__( 'Message Button Link', 'constructionn' ),
				'section'         => 'top_bar_section',
				'type'            => 'url',
				'active_callback' => 'constructionn_fronttopbar_active_callback',
			)
		);

		// Adding setting and control for my account text-> header 2
		$wp_customize->add_setting(
			'account_txt',
			array(
				'default'           => esc_html__( 'MY ACCOUNT', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'account_txt',
			array(
				'selector'        => 'ul.header-link-list',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'account_txt', __( 'MY ACCOUNT', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'account_txt',
			array(
				'label'           => esc_html__( 'Account Text', 'constructionn' ),
				'section'         => 'top_bar_section',
				'type'            => 'text',
				'active_callback' => 'constructionn_fronttopbar_active_callback',
			)
		);

		// Adding setting and control for my account link-> header 2
		$wp_customize->add_setting(
			'account_link',
			array(
				'default'           => '#',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'account_link',
			array(
				'label'           => esc_html__( 'Account Link', 'constructionn' ),
				'section'         => 'top_bar_section',
				'type'            => 'url',
				'active_callback' => 'constructionn_fronttopbar_active_callback',
			)
		);

		// Adding setting and control for quotes text-> header 1,2,3,5
		$wp_customize->add_setting(
			'quotes_txt',
			array(
				'default'           => esc_html__( 'REQUEST A QUOTE', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'quotes_txt',
			array(
				'selector'        => 'li.quote-wrap',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'quotes_txt', __( 'REQUEST A QUOTE', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'quotes_txt',
			array(
				'label'           => esc_html__( 'Quotes Text', 'constructionn' ),
				'section'         => 'top_bar_section',
				'type'            => 'text',
				'active_callback' => 'constructionn_fronttopbar_active_callback',
			)
		);

		// Adding setting and control for quotes link-> header 1,2,3,5
		$wp_customize->add_setting(
			'quotes_link',
			array(
				'default'           => '#',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'quotes_link',
			array(
				'label'           => esc_html__( 'Quotes Link', 'constructionn' ),
				'section'         => 'top_bar_section',
				'type'            => 'url',
				'active_callback' => 'constructionn_fronttopbar_active_callback',
			)
		);

		// add setting and control for email-> header 3,4
		$wp_customize->add_setting(
			'email',
			array(
				'default'           => __( 'info@gl-konstruction.com', 'constructionn' ),
				'sanitize_callback' => 'sanitize_email',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'email',
			array(
				'selector'        => '.mail',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'email', __( 'info@gl-konstruction.com', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'email',
			array(
				'label'           => __( 'Email', 'constructionn' ),
				'section'         => 'top_bar_section',
				'type'            => 'email',
				'active_callback' => 'constructionn_fronttopbar_active_callback',
			)
		);

		// add setting and control for ph number -> header 3
		$wp_customize->add_setting(
			'phone_number',
			array(
				'default'           => __( '+1-800-111-2222', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'phone_number',
			array(
				'selector'        => '.phone',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'phone_number', __( '+1-800-111-2222', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'phone_number',
			array(
				'label'           => __( 'Phone Number', 'constructionn' ),
				'section'         => 'top_bar_section',
				'type'            => 'text',
				'active_callback' => 'constructionn_fronttopbar_active_callback',
			)
		);

		// adding setting for email title-->header 4
		$wp_customize->add_setting(
			'header_email_title',
			array(
				'default'           => __( 'Mail Us:', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'header_email_title',
			array(
				'selector'        => '.mail-title',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'header_email_title', 'Mail Us:' ) );
				},
			)
		);

		$wp_customize->add_control(
			'header_email_title',
			array(
				'section'         => 'top_bar_section',
				'label'           => __( 'Email Title', 'constructionn' ),
				'type'            => 'text',
				'active_callback' => 'constructionn_fronttopbar_active_callback',
			)
		);

		// adding setting for location title ->header 4
		$wp_customize->add_setting(
			'header_location_title',
			array(
				'default'           => __( 'Location:', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'header_location_title',
			array(
				'selector'        => 'ul.contact-links.header-four .location',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'header_location_title', __( 'Location:', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'header_location_title',
			array(
				'section'         => 'top_bar_section',
				'label'           => __( 'Location Title', 'constructionn' ),
				'type'            => 'text',
				'active_callback' => 'constructionn_fronttopbar_active_callback',
			)
		);

		// adding setting for location -->header 4
		$wp_customize->add_setting(
			'header_location',
			array(
				'default'           => __( 'Hamburg,Germany', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'header_location',
			array(
				'selector'        => '.mail-title',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'header_location', 'Hamburg,Germany' ) );
				},
			)
		);

		$wp_customize->add_control(
			'header_location',
			array(
				'section'         => 'top_bar_section',
				'label'           => __( 'Location', 'constructionn' ),
				'type'            => 'text',
				'active_callback' => 'constructionn_fronttopbar_active_callback',
			)
		);

		// Adding setting and control for menu label-> header 5
		$wp_customize->add_setting(
			'menu_label',
			array(
				'default'           => esc_html__( 'Menu', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'menu_label',
			array(
				'selector'        => '.ham-wrapper.header-five',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'menu_label', __( 'Menu', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'menu_label',
			array(
				'label'           => esc_html__( 'Menu Label', 'constructionn' ),
				'section'         => 'top_bar_section',
				'type'            => 'text',
				'active_callback' => 'constructionn_fronttopbar_active_callback',
			)
		);

		// Adding setting and control for request quotes text-> header 4
		$wp_customize->add_setting(
			'request_txt',
			array(
				'default'           => esc_html__( 'Request a Quote', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'request_txt',
			array(
				'selector'        => '.top-right a.btn.btn__primary-outline',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'request_txt', __( 'Request a Quote', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'request_txt',
			array(
				'label'           => esc_html__( 'Request Text', 'constructionn' ),
				'section'         => 'top_bar_section',
				'type'            => 'text',
				'active_callback' => 'constructionn_fronttopbar_active_callback',
			)
		);

		// Adding setting and control for request quotes text-> header 4
		$wp_customize->add_setting(
			'request_link',
			array(
				'default'           => '#',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'request_link',
			array(
				'label'           => esc_html__( 'Request Link', 'constructionn' ),
				'section'         => 'top_bar_section',
				'type'            => 'url',
				'active_callback' => 'constructionn_fronttopbar_active_callback',
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_frontopbar' );

function constructionn_fronttopbar_active_callback( $control ) {
	$topbar_toggle  = $control->manager->get_setting( 'topbar_toggle' )->value();
	$header_layouts = $control->manager->get_setting( 'header_layouts' )->value();

	$id = $control->id;

	if ( ! $topbar_toggle ) {
		return false;
	}

	if ( $id == 'header_layouts' ) {
		return true;
	}

	switch ( $header_layouts ) {
		case 'one':
			return in_array( $id, array( 'message_heading', 'msg_btn_txt', 'msg_btn_link', 'quotes_txt', 'quotes_link' ) );
		case 'two':
			return in_array( $id, array( 'account_txt', 'account_link', 'quotes_txt', 'quotes_link' ) );
		case 'three':
			return in_array( $id, array( 'message_heading', 'msg_btn_txt', 'msg_btn_link', 'quotes_txt', 'quotes_link', 'email', 'phone_number' ) );
		case 'four':
			return $id == in_array( $id, array( 'email', 'header_email_title', 'header_location_title', 'header_location', 'request_txt', 'request_link' ) );
		case 'five':
			return in_array( $id, array( 'email', 'phone_number', 'quotes_txt', 'quotes_link', 'menu_label' ) );
		default:
			return false;
	}
}
