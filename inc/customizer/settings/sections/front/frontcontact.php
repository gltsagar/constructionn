<?php

if ( ! function_exists( 'constructionn_customize_register_frontcontact' ) ) :
	/**
	 * Frontcontact
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_frontcontact( $wp_customize ) {
		$wp_customize->add_section(
			'contact_section',
			array(
				'title'    => __( 'Contact Settings', 'constructionn' ),
				'priority' => 120,
				'panel'    => 'frontpage_settings_panel',
			)
		);

		$wp_customize->add_setting(
			'contact_headings',
			array(
				'default'           => __( 'Let’s get started to make your next appointment.', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'contact_headings',
			array(
				'selector'        => '.front-contact h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'contact_headings', __( 'Let’s get started to make your next appointment.', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'contact_headings',
			array(
				'label'   => __( 'Heading', 'constructionn' ),
				'section' => 'contact_section',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			'contact_descriptions',
			array(
				'default'           => __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'constructionn' ),
				'sanitize_callback' => 'wp_kses_post',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'contact_descriptions',
			array(
				'selector'        => '.front-contact p.section-desc',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'contact_descriptions', __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'contact_descriptions',
			array(
				'label'   => __( 'Description', 'constructionn' ),
				'section' => 'contact_section',
				'type'    => 'textarea',
			)
		);

		/** Shortcode*/
		$wp_customize->add_setting(
			'fcontact_form_shortcode',
			array(
				'default'           => '',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'fcontact_form_shortcode',
			array(
				'label'   => __( 'Enter Shortcode', 'constructionn' ),
				'type'    => 'text',
				'section' => 'contact_section',
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_frontcontact' );
