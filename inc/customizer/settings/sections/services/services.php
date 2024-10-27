<?php

if ( ! function_exists( 'constructionn_customize_register_servpg_service' ) ) :
	/**
	 * Servicepage Service
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_servpg_service( $wp_customize ) {

		$wp_customize->add_section(
			'servpg_service_section',
			array(
				'title'    => __( 'Service Settings', 'constructionn' ),
				'priority' => 10,
				'panel'    => 'Service_page_settings',
			)
		);

		// Add setting for service Image
		$wp_customize->add_setting(
			'servpg_service_image',
			array(
				'default'           => esc_url( get_template_directory_uri() . '/assets/images/Image-placeholder-3.jpg' ),
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		// Add Control for service Image
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'servpg_service_image',
				array(
					'description' => esc_html__( 'Upload Image', 'constructionn' ),
					'section'     => 'servpg_service_section',
				)
			)
		);

		// Add setting for Service Section Heading
		$wp_customize->add_setting(
			'servpg_service_headings',
			array(
				'default'           => __( 'Have any projects ?', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'servpg_service_headings',
			array(
				'selector'        => '.services-section h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'servpg_service_headings', __( 'Have any projects ?', 'constructionn' ) ) );
				},
			)
		);

		// Add setting for Service Section Heading
		$wp_customize->add_control(
			'servpg_service_headings',
			array(
				'label'   => __( 'Heading', 'constructionn' ),
				'section' => 'servpg_service_section',
				'type'    => 'text',
			)
		);

		// Add setting for Service Section Button Text
		$wp_customize->add_setting(
			'servpg_btn_txt',
			array(
				'default'           => __( 'View More', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'servpg_btn_txt',
			array(
				'selector'        => 'section#front-service h2.section-header__title',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'servpg_btn_txt', __( 'View More', 'constructionn' ) ) );
				},
			)
		);

		// Add setting for Service Section Heading
		$wp_customize->add_control(
			'servpg_btn_txt',
			array(
				'label'   => __( 'Button Text', 'constructionn' ),
				'section' => 'servpg_service_section',
				'type'    => 'text',
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_servpg_service' );
