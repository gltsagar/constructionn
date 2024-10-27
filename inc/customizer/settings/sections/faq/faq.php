<?php

if ( ! function_exists( 'constructionn_customize_register_faqpg_faq' ) ) :
	/**
	 * Faqpage Faq
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_faqpg_faq( $wp_customize ) {
		$wp_customize->add_section(
			'faqpg_faqs_section',
			array(
				'title'    => esc_html__( 'FAQ Settings', 'constructionn' ),
				'priority' => 10,
				'panel'    => 'faq_page_settings',
			)
		);

		// Add setting for Section Heading
		$wp_customize->add_setting(
			'faqpg_faq_headings',
			array(
				'default'           => __( 'We provide solution to every queries!', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'faqpg_faq_headings',
			array(
				'selector'        => '.faqpg-faq h2.section-heading',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'faqpg_faq_headings', __( 'We provide solution to every queries!', 'constructionn' ) ) );
				},
			)
		);

		// Add Control for Section Heading
		$wp_customize->add_control(
			'faqpg_faq_headings',
			array(
				'label'   => esc_html__( 'Heading', 'constructionn' ),
				'section' => 'faqpg_faqs_section',
				'type'    => 'text',
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_faqpg_faq' );
