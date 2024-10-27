<?php

if ( ! function_exists( 'constructionn_customize_register_scrolltotop' ) ) :
	/**
	 * Scroll Button
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_scrolltotop( $wp_customize ) {

		$wp_customize->add_section(
			'scroll_button_section',
			array(
				'title'    => esc_html__( 'Scroll Settings', 'constructionn' ),
				'panel'    => 'general_settings_panel',
				'priority' => 100,
			)
		);

		// Add the toggle control to the section
		$wp_customize->add_setting(
			'scroll_button_display_setting',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'scroll_button_display_setting',
				array(
					'label'       => esc_html__( 'Show/Hide Scroll To Top Button', 'constructionn' ),
					'description' => esc_html__( 'Enable to show Scroll Button', 'constructionn' ),
					'section'     => 'scroll_button_section',
					'type'        => 'checkbox',
				)
			)
		);

		// Add setting for scroll to top Heading
		$wp_customize->add_setting(
			'scroll_text',
			array(
				'default'           => __( 'Back to top', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'scroll_text',
			array(
				'label'   => __( 'Heading', 'constructionn' ),
				'section' => 'scroll_button_section',
				'type'    => 'text',
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_scrolltotop' );
