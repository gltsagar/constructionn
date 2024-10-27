<?php
if ( ! function_exists( 'constructionn_customize_register_frontestimonial' ) ) :
	/**
	 * Fronttestimonial
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_frontestimonial( $wp_customize ) {

		$wp_customize->add_section(
			'testimonial_section',
			array(
				'title'    => __( 'Testimonial Settings', 'constructionn' ),
				'priority' => 130,
				'panel'    => 'frontpage_settings_panel',
			)
		);

		// Add setting for Section Heading
		$wp_customize->add_setting(
			'testimonials_headings',
			array(
				'default'           => __( 'What clients say about us', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'testimonials_headings',
			array(
				'selector'        => '.sec-testimon h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'testimonials_headings', __( 'What clients say about us', 'constructionn' ) ) );
				},
			)
		);

		// Add Control for Section Heading
		$wp_customize->add_control(
			'testimonials_headings',
			array(
				'label'   => __( 'Heading', 'constructionn' ),
				'section' => 'testimonial_section',
				'type'    => 'text',
			)
		);

		// Add setting for Testimonial Button Next Text
		$wp_customize->add_setting(
			'testimonial_btn_next_txt',
			array(
				'default'           => esc_html__( 'Next', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		// Add control for Testimonial Button Next Text
		$wp_customize->add_control(
			'testimonial_btn_next_txt',
			array(
				'label'   => esc_html__( 'Button Next Text', 'constructionn' ),
				'section' => 'testimonial_section',
				'type'    => 'text',
			)
		);

		// Add setting for Testimonial Button Previous Text
		$wp_customize->add_setting(
			'testimonial_btn_prev_txt',
			array(
				'default'           => esc_html__( 'Prev', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		// Add control for Testimonial Button Previous Text
		$wp_customize->add_control(
			'testimonial_btn_prev_txt',
			array(
				'label'   => esc_html__( 'Button Previous Text', 'constructionn' ),
				'section' => 'testimonial_section',
				'type'    => 'text',
			)
		);

		/** Dynamic Testimonial Section */
		$wp_customize->add_setting(
			new Constructionn_Repeater_Setting(
				$wp_customize,
				'front_testimonial_repeater',
				array(
					'default'           => array(),
					'sanitize_callback' => array( 'Constructionn_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Control_Repeater(
				$wp_customize,
				'front_testimonial_repeater',
				array(
					'section'   => 'testimonial_section',
					'label'     => __( 'Add Testimonial', 'constructionn' ),
					'fields'    => array(
						'testimonial' => array(
							'type'    => 'select',
							'label'   => __( 'Select Testimonial', 'constructionn' ),
							'choices' => constructionn_get_posts( 'testimonial' ),
						),
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __( 'Testimonial', 'constructionn' ),
						'field' => 'title',
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_frontestimonial' );
