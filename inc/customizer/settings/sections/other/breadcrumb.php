<?php

if ( ! function_exists( 'constructionn_customize_register_breadcrumb' ) ) :
	/**
	 * Breadcrumb Setings
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_breadcrumb( $wp_customize ) {
		// Create breadcrumb sections----------
		$wp_customize->add_section(
			'breadcrumb_settings',
			array(
				'title'    => __( 'Breadcrumb Settings', 'constructionn' ),
				'priority' => 70,
				'panel'    => 'general_settings_panel',
			)
		);

		// Add the toggle control to the section
		$wp_customize->add_setting(
			'breadcrumb_toggle',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'breadcrumb_toggle',
				array(
					'label'       => __( 'Show/Hide Breadcrumb', 'constructionn' ),
					'description' => __( 'Enable to show the Breadcrumb.', 'constructionn' ),
					'section'     => 'breadcrumb_settings',
					'type'        => 'checkbox',
				)
			)
		);

		$wp_customize->add_setting(
			'breadcrumb_home_text',
			array(
				'default'           => __( 'Home', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'breadcrumb_home_text',
			array(
				'label'           => __( 'Breadcrumb Home Text', 'constructionn' ),
				'section'         => 'breadcrumb_settings',
				'active_callback' => 'constructionn_breadcrumb_active_callback',
			)
		);

		$wp_customize->add_setting(
			'breadcrumb_show_title',
			array(
				'default'           => false,
				'sanitize_callback' => 'constructionn_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'breadcrumb_show_title',
				array(
					'label'           => __( 'Show Title', 'constructionn' ),
					'section'         => 'breadcrumb_settings',
					'type'            => 'checkbox',
					'active_callback' => 'constructionn_breadcrumb_active_callback',
				)
			)
		);

		// Add setting for breadcrumb image
		$wp_customize->add_setting(
			'breadcrumb_image',
			array(
				'default'           => '',
				'sanitize_callback' => 'absint',
			)
		);

		// Add Control for breadcrumb image
		$wp_customize->add_control(
			new WP_Customize_Cropped_Image_Control(
				$wp_customize,
				'breadcrumb_image',
				array(
					'label'           => __( 'Upload Image', 'constructionn' ),
					'description'     => __( 'Upload background image for breadcrumbs.', 'constructionn' ),
					'section'         => 'breadcrumb_settings',
					'height'          => 205,
					'width'           => 1520,
					'flex_width'      => true,
					'flex_height'     => true,
					'active_callback' => 'constructionn_breadcrumb_active_callback',
				)
			)
		);

		// Breadcrumb color selector
		$wp_customize->add_setting(
			'breadcrumb_bg_color',
			array(
				'default'           => '#0F5299',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'breadcrumb_bg_color',
				array(
					'label'           => __( 'Fallback Background Color', 'constructionn' ),
					'description'     => __( 'Doesn\'t work if background image is set for breadcrumbs.', 'constructionn' ),
					'section'         => 'breadcrumb_settings',
					'active_callback' => 'constructionn_breadcrumb_active_callback',
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_breadcrumb' );

function constructionn_breadcrumb_active_callback( $control ) {

	$breadcrumb_toggle = $control->manager->get_setting( 'breadcrumb_toggle' )->value();
	$id                = $control->id;

	if ( $breadcrumb_toggle && $id == 'breadcrumb_home_text' ) {
		return true;
	}
	if ( $breadcrumb_toggle && $id == 'breadcrumb_image' ) {
		return true;
	}
	if ( $breadcrumb_toggle && $id == 'breadcrumb_bg_color' ) {
		return true;
	}
	if ( $breadcrumb_toggle && $id == 'breadcrumb_show_title' ) {
		return true;
	}

	return false;
}
