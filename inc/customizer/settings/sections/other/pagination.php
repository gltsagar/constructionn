<?php

if ( ! function_exists( 'constructionn_customize_register_pagination_settings' ) ) :
	/**
	 * Pagination Settings
	 *
	 * @package Constructionn
	 */
	function constructionn_customize_register_pagination_settings( $wp_customize ) {
		/** Pagination Settings */
		$wp_customize->add_section(
			'pagination_settings',
			array(
				'title'    => __( 'Pagination Settings', 'constructionn' ),
				'panel'    => 'general_settings_panel',
				'priority' => 80,
			)
		);

		/** Pagination Type */
		$wp_customize->add_setting(
			'pagination_type',
			array(
				'default'           => 'numbered',
				'sanitize_callback' => 'constructionn_radio_sanitization_header',
			)
		);

		$wp_customize->add_control(
			'pagination_type',
			array(
				'type'        => 'radio',
				'section'     => 'pagination_settings',
				'label'       => __( 'Pagination Type', 'constructionn' ),
				'description' => __( 'Select pagination of your choice.', 'constructionn' ),
				'choices'     => array(
					'default'  => __( 'Default (Older / Newer)', 'constructionn' ),
					'numbered' => __( 'Numbered (1 2 3 4...)', 'constructionn' ),
				),
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_pagination_settings' );
