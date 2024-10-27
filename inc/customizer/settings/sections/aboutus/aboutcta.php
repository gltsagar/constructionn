<?php

if ( ! function_exists( 'constructionn_pro_customize_register_abtpg_cta' ) ) :
	/**
	 * Aboutpage Cta
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_abtpg_cta( $wp_customize ) {
		$wp_customize->add_section(
			'abtpg_cta_section',
			array(
				'title'    => __( 'CTA Settings', 'constructionn-pro' ),
				'priority' => 20,
				'panel'    => 'about_page_settings',
			)
		);

		/* background  image*/
		$wp_customize->add_setting(
			'abtpg_cta_bg_img',
			array(
				'default'           => esc_url( get_template_directory_uri() . '/assets/images/banner-1.jpg' ),
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'abtpg_cta_bg_img',
				array(
					'label'   => __( 'Upload Background Image', 'constructionn-pro' ),
					'section' => 'abtpg_cta_section',
				)
			)
		);

		// Add setting for Cta Title
		$wp_customize->add_setting(
			'abtpg_cta_heading',
			array(
				'default'           => __( 'Have any projects ?', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'abtpg_cta_heading',
			array(
				'selector'        => '.aboutpg-cta h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'abtpg_cta_heading', __( 'Have any projects ?', 'constructionn-pro' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'abtpg_cta_heading',
			array(
				'label'   => __( 'Heading', 'constructionn-pro' ),
				'section' => 'abtpg_cta_section',
				'type'    => 'text',
			)
		);

		// Add setting for description
		$wp_customize->add_setting(
			'abtpg_cta_descs',
			array(
				'default'           => __( 'Do not hesitate to contact us and get the best outcomes from our professionals.', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_textarea_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'abtpg_cta_descs',
			array(
				'selector'        => '.aboutpg-cta p.section-desc',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'abtpg_cta_descs', __( 'Do not hesitate to contact us and get the best outcomes from our professionals.', 'constructionn-pro' ) ) );
				},
			)
		);

		// Add Control for description
		$wp_customize->add_control(
			'abtpg_cta_descs',
			array(
				'label'   => __( 'Description', 'constructionn-pro' ),
				'section' => 'abtpg_cta_section',
				'type'    => 'textarea',
			)
		);

		// add setting and control for contact number
		$wp_customize->add_setting(
			'abtpg_contact_num',
			array(
				'default'           => __( '+1-202-555-0133', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'abtpg_contact_num',
			array(
				'selector'        => '.aboutpg-cta a',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'abtpg_contact_num', __( '+1-202-555-0133', 'constructionn-pro' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'abtpg_contact_num',
			array(
				'label'   => __( 'Contact Number', 'constructionn-pro' ),
				'section' => 'abtpg_cta_section',
				'type'    => 'text',
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_abtpg_cta' );
