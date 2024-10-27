<?php

if ( ! function_exists( 'constructionn_pro_customize_register_frontservice' ) ) :
	/**
	 * FrontService
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_frontservice( $wp_customize ) {

		$wp_customize->add_section(
			'service_section',
			array(
				'title'    => __( 'Service Settings', 'constructionn-pro' ),
				'priority' => 30,
				'panel'    => 'frontpage_settings_panel',
			)
		);

		// Add setting for service Image
		$wp_customize->add_setting(
			'service_image',
			array(
				'default'           => esc_url( get_template_directory_uri() . '/assets/images/Image-placeholder-3.jpg' ),
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		// Add Control for service Image
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'service_image',
				array(
					'description' => esc_html__( 'Upload Image', 'constructionn-pro' ),
					'section'     => 'service_section',
				)
			)
		);

		// Add setting for Service Section Heading
		$wp_customize->add_setting(
			'service_headings',
			array(
				'default'           => __( 'Have any projects ?', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'service_headings',
			array(
				'selector'        => '.front-service h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'service_headings', __( 'Have any projects ?', 'constructionn-pro' ) ) );
				},
			)
		);

		// Add setting for Service Section Heading
		$wp_customize->add_control(
			'service_headings',
			array(
				'label'   => __( 'Heading', 'constructionn-pro' ),
				'section' => 'service_section',
				'type'    => 'text',
			)
		);

		// Add setting for Service Section Button Text
		$wp_customize->add_setting(
			'service_btn_txt',
			array(
				'default'           => __( 'View More', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'service_btn_txt',
			array(
				'selector'        => 'section#front-service h2.section-header__title',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'service_btn_txt', __( 'View More', 'constructionn-pro' ) ) );
				},
			)
		);

		// Add setting for Service Section Heading
		$wp_customize->add_control(
			'service_btn_txt',
			array(
				'label'   => __( 'Button Text', 'constructionn-pro' ),
				'section' => 'service_section',
				'type'    => 'text',
			)
		);

		/** Dynamic Services Section */
		$wp_customize->add_setting(
			new Constructionn_Pro_Repeater_Setting(
				$wp_customize,
				'front_services_repeater',
				array(
					'default'           => '',
					'sanitize_callback' => array( 'Constructionn_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Pro_Control_Repeater(
				$wp_customize,
				'front_services_repeater',
				array(
					'section'   => 'service_section',
					'label'     => __( 'Add Services', 'constructionn-pro' ),
					'fields'    => array(
						'service' => array(
							'type'    => 'select',
							'label'   => __( 'Select Service', 'constructionn-pro' ),
							'choices' => constructionn_pro_get_posts( 'service' ),
						),
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __( 'Services', 'constructionn-pro' ),
						'field' => 'title',
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_frontservice' );
