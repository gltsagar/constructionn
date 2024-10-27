<?php

if ( ! function_exists( 'constructionn_pro_customize_register_testimonialpg_testimonial' ) ) :
	/**
	 * Testimonialpage Testimonial
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_testimonialpg_testimonial( $wp_customize ) {

		$wp_customize->add_section(
			'testimonialpg_testimon_section',
			array(
				'title'    => __( 'Testimonial Settings', 'constructionn-pro' ),
				'priority' => 10,
				'panel'    => 'testimonial_page_settings',
			)
		);

		// Add setting for Section Heading
		$wp_customize->add_setting(
			'testimonialpg_testimon_headings',
			array(
				'default'           => __( 'What clients say about us', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'testimonialpg_testimon_headings',
			array(
				'selector'        => '.testimonpg h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'testimonialpg_testimon_headings', __( 'What clients say about us', 'constructionn-pro' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'testimonialpg_testimon_headings',
			array(
				'label'   => __( 'Heading', 'constructionn-pro' ),
				'section' => 'testimonialpg_testimon_section',
				'type'    => 'text',
			)
		);

		// Add setting for Testimonial Button Next Text
		$wp_customize->add_setting(
			'testimonialpg_btn_next_txt',
			array(
				'default'           => esc_html__( 'Next', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		// Add control for Testimonial Button Next Text
		$wp_customize->add_control(
			'testimonialpg_btn_next_txt',
			array(
				'label'   => esc_html__( 'Button Next Text', 'constructionn-pro' ),
				'section' => 'testimonialpg_testimon_section',
				'type'    => 'text',
			)
		);

		// Add setting for Testimonial Button Previous Text
		$wp_customize->add_setting(
			'testimonialpg_btn_prev_txt',
			array(
				'default'           => esc_html__( 'Prev', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		// Add control for Testimonial Button Previous Text
		$wp_customize->add_control(
			'testimonialpg_btn_prev_txt',
			array(
				'label'   => esc_html__( 'Button Previous Text', 'constructionn-pro' ),
				'section' => 'testimonialpg_testimon_section',
				'type'    => 'text',
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_testimonialpg_testimonial' );
