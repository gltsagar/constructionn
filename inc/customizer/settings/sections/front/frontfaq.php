<?php

if ( ! function_exists( 'constructionn_customize_register_frontfaq' ) ) :
	/**
	 * Front FAQ Section
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_frontfaq( $wp_customize ) {

		$wp_customize->add_section(
			'faqs_section',
			array(
				'title'    => __( 'FAQ Settings', 'constructionn' ),
				'priority' => 110,
				'panel'    => 'frontpage_settings_panel',
			)
		);

		// Add setting for Section Heading
		$wp_customize->add_setting(
			'faq_heading_settings',
			array(
				'default'           => __( 'We provide solution to every queries!', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'faq_heading_settings',
			array(
				'selector'        => '.front-faq h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'faq_heading_settings', __( 'We provide solution to every queries!', 'constructionn' ) ) );
				},
			)
		);

		// Add Control for Section Heading
		$wp_customize->add_control(
			'faq_heading_settings',
			array(
				'label'   => __( 'Heading', 'constructionn' ),
				'section' => 'faqs_section',
				'type'    => 'text',
			)
		);

		/** Dynamic Faq Section */
		$wp_customize->add_setting(
			new Constructionn_Repeater_Setting(
				$wp_customize,
				'front_faq_repeater',
				array(
					'default'           => array(),
					'sanitize_callback' => array( 'Constructionn_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Control_Repeater(
				$wp_customize,
				'front_faq_repeater',
				array(
					'section'   => 'faqs_section',
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
add_action( 'customize_register', 'constructionn_customize_register_frontfaq' );
