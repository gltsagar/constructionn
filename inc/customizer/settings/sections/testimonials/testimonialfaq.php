<?php

if ( ! function_exists( 'constructionn_customize_register_testimonialfaq' ) ) :
	/**
	 * Testimonialpage FAQ Section
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_testimonialfaq( $wp_customize ) {

		$wp_customize->add_section(
			'testimonialpg_faq_section',
			array(
				'title'    => __( 'FAQ Settings', 'constructionn' ),
				'priority' => 30,
				'panel'    => 'testimonial_page_settings',
			)
		);

		// Add setting for Section Heading
		$wp_customize->add_setting(
			'testimonpg_faq_headings',
			array(
				'default'           => __( 'We provide solution to every queries!', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'testimonpg_faq_headings',
			array(
				'selector'        => '.testimonialpg-faq h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'testimonpg_faq_headings', __( 'We provide solution to every queries!', 'constructionn' ) ) );
				},
			)
		);

		// Add Control for Section Heading
		$wp_customize->add_control(
			'testimonpg_faq_headings',
			array(
				'label'   => __( 'Heading', 'constructionn' ),
				'section' => 'testimonialpg_faq_section',
				'type'    => 'text',
			)
		);

		/** Dynamic Faq Section */
		$wp_customize->add_setting(
			new Constructionn_Repeater_Setting(
				$wp_customize,
				'testimonpg_faq_repeater',
				array(
					'default'           => array(),
					'sanitize_callback' => array( 'Constructionn_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Control_Repeater(
				$wp_customize,
				'testimonpg_faq_repeater',
				array(
					'section'   => 'testimonialpg_faq_section',
					'label'     => __( 'Add Faqs', 'constructionn' ),
					'fields'    => array(
						'faq' => array(
							'type'    => 'select',
							'label'   => __( 'Select faq', 'constructionn' ),
							'choices' => constructionn_get_posts( 'faq' ),
						),
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __( 'Faq', 'constructionn' ),
						'field' => 'title',
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_testimonialfaq' );
