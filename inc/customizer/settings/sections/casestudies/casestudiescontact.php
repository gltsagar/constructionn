<?php

if ( ! function_exists( 'constructionn_pro_customize_register_casestudypg_contact' ) ) :
	/**
	 * CasestudyPage Contact
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_casestudypg_contact( $wp_customize ) {
		$wp_customize->add_section(
			'cspg_contact_section',
			array(
				'title'    => __( 'Contact Settings', 'constructionn-pro' ),
				'priority' => 30,
				'panel'    => 'casestudies_page_settings',
			)
		);

		$wp_customize->add_setting(
			'cspg_contact_headings',
			array(
				'default'           => __( 'Let’s get started to make your next appointment.', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'cspg_contact_headings',
			array(
				'selector'        => '.casestudypg-contact h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'cspg_contact_headings', __( 'Let’s get started to make your next appointment.', 'constructionn-pro' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'cspg_contact_headings',
			array(
				'label'   => __( 'Heading', 'constructionn-pro' ),
				'section' => 'cspg_contact_section',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			'cspg_contact_descs',
			array(
				'default'           => __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'constructionn-pro' ),
				'sanitize_callback' => 'wp_kses_post',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'cspg_contact_descs',
			array(
				'selector'        => '.casestudypg-contact p.section-desc',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'cspg_contact_descs', __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'constructionn-pro' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'cspg_contact_descs',
			array(
				'label'   => __( 'Description', 'constructionn-pro' ),
				'section' => 'cspg_contact_section',
				'type'    => 'textarea',
			)
		);

		/** Shortcode*/
		$wp_customize->add_setting(
			'cspg_contact_form_shortcode',
			array(
				'default'           => '',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'cspg_contact_form_shortcode',
			array(
				'label'   => __( 'Enter Shortcode', 'constructionn-pro' ),
				'type'    => 'text',
				'section' => 'cspg_contact_section',
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_casestudypg_contact' );
