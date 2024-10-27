<?php

if ( ! function_exists( 'constructionn_pro_customize_register_faqpg_contact' ) ) :
	/**
	 * FAQ Page Contact
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_faqpg_contact( $wp_customize ) {
		$wp_customize->add_section(
			'faqpg_contact_section',
			array(
				'title'    => __( 'Contact Settings', 'constructionn-pro' ),
				'priority' => 10,
				'panel'    => 'faq_page_settings',
			)
		);

		$wp_customize->add_setting(
			'faqpg_contact_headings',
			array(
				'default'           => __( 'Let’s get started to make your next appointment.', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'faqpg_contact_headings',
			array(
				'selector'        => '.faqpg-contact h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'faqpg_contact_headings', __( 'Let’s get started to make your next appointment.', 'constructionn-pro' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'faqpg_contact_headings',
			array(
				'label'   => __( 'Heading', 'constructionn-pro' ),
				'section' => 'faqpg_contact_section',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			'faqpg_contact_desc',
			array(
				'default'           => __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'constructionn-pro' ),
				'sanitize_callback' => 'wp_kses_post',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'faqpg_contact_desc',
			array(
				'selector'        => '.faqpg-contact p.section-desc',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'faqpg_contact_desc', __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'constructionn-pro' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'faqpg_contact_desc',
			array(
				'label'   => __( 'Description', 'constructionn-pro' ),
				'section' => 'faqpg_contact_section',
				'type'    => 'textarea',
			)
		);

		/** Shortcode*/
		$wp_customize->add_setting(
			'faq_pg_contactform_shortcode',
			array(
				'default'           => '',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'faq_pg_contactform_shortcode',
			array(
				'label'   => __( 'Enter Shortcode', 'constructionn-pro' ),
				'type'    => 'text',
				'section' => 'faqpg_contact_section',
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_faqpg_contact' );
