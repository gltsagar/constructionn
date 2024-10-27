<?php

if ( ! function_exists( 'constructionn_customize_register_frontcta' ) ) :
	/**
	 * Front Cta
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_frontcta( $wp_customize ) {
		$wp_customize->add_section(
			'cta_section',
			array(
				'title'    => __( 'CTA Settings', 'constructionn' ),
				'priority' => 40,
				'panel'    => 'frontpage_settings_panel',
			)
		);

		/* background  image*/
		$wp_customize->add_setting(
			'cta_bg_img',
			array(
				'default'           => esc_url( get_template_directory_uri() . '/assets/images/banner-1.jpg' ),
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'cta_bg_img',
				array(
					'label'   => __( 'Upload Background Image', 'constructionn' ),
					'section' => 'cta_section',
				)
			)
		);

		// Add setting for Cta Title
		$wp_customize->add_setting(
			'front_cta_heading',
			array(
				'default'           => __( 'Have any projects ?', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'front_cta_heading',
			array(
				'selector'        => '.front-cta h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'front_cta_heading', __( 'Have any projects ?', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'front_cta_heading',
			array(
				'label'   => __( 'Heading', 'constructionn' ),
				'section' => 'cta_section',
				'type'    => 'text',
			)
		);

		// Add setting for description
		$wp_customize->add_setting(
			'front_cta_descs',
			array(
				'default'           => __( 'Do not hesitate to contact us and get the best outcomes from our professionals.', 'constructionn' ),
				'sanitize_callback' => 'sanitize_textarea_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'front_cta_descs',
			array(
				'selector'        => '.front-cta p.section-desc',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'front_cta_descs', __( 'Do not hesitate to contact us and get the best outcomes from our professionals.', 'constructionn' ) ) );
				},
			)
		);

		// Add Control for description
		$wp_customize->add_control(
			'front_cta_descs',
			array(
				'label'   => __( 'Description', 'constructionn' ),
				'section' => 'cta_section',
				'type'    => 'textarea',
			)
		);

		// add setting and control for contact number
		$wp_customize->add_setting(
			'contact_number',
			array(
				'default'           => __( '+1-202-555-0133', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'contact_number',
			array(
				'selector'        => '.front-cta a',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'contact_number', __( '+1-202-555-0133', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'contact_number',
			array(
				'label'   => __( 'Contact Number', 'constructionn' ),
				'section' => 'cta_section',
				'type'    => 'text',
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_frontcta' );
