<?php

if ( ! function_exists( 'constructionn_pro_customize_register_single_project_cta' ) ) :
	/**
	 * Project Single CTA
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_single_project_cta( $wp_customize ) {
		$wp_customize->add_section(
			'project_single_cta_section',
			array(
				'title'    => __( 'CTA Settings', 'constructionn-pro' ),
				'priority' => 10,
				'panel'    => 'project_single_settings',
			)
		);

		/* background  image*/
		$wp_customize->add_setting(
			'project_single_cta_bg_img',
			array(
				'default'           => esc_url( get_template_directory_uri() . '/assets/images/banner-1.jpg' ),
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'project_single_cta_bg_img',
				array(
					'label'   => __( 'Upload Background Image', 'constructionn-pro' ),
					'section' => 'project_single_cta_section',
				)
			)
		);

		// Add setting for Cta Title
		$wp_customize->add_setting(
			'project_single_cta_heading',
			array(
				'default'           => __( 'Have any projects ?', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'project_single_cta_heading',
			array(
				'selector'        => 'section#front-quotes h2.section-header__title',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'project_single_cta_heading', __( 'Have any projects ?', 'constructionn-pro' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'project_single_cta_heading',
			array(
				'label'   => __( 'Heading', 'constructionn-pro' ),
				'section' => 'project_single_cta_section',
				'type'    => 'text',
			)
		);

		// Add setting for description
		$wp_customize->add_setting(
			'project_single_cta_descs',
			array(
				'default'           => __( 'Do not hesitate to contact us and get the best outcomes from our professionals.', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_textarea_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'project_single_cta_descs',
			array(
				'selector'        => 'section#front-quotes .fau-desig',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'project_single_cta_descs', __( 'Do not hesitate to contact us and get the best outcomes from our professionals.', 'constructionn-pro' ) ) );
				},
			)
		);

		// Add Control for description
		$wp_customize->add_control(
			'project_single_cta_descs',
			array(
				'label'   => __( 'Description', 'constructionn-pro' ),
				'section' => 'project_single_cta_section',
				'type'    => 'textarea',
			)
		);

		// add setting and control for contact number
		$wp_customize->add_setting(
			'project_single_contact_number',
			array(
				'default'           => __( '+1-202-555-0133', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'project_single_contact_number',
			array(
				'selector'        => '.tel',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'project_single_contact_number', __( '+1-202-555-0133', 'constructionn-pro' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'project_single_contact_number',
			array(
				'label'   => __( 'Contact Number', 'constructionn-pro' ),
				'section' => 'project_single_cta_section',
				'type'    => 'text',
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_single_project_cta' );
