<?php

if ( ! function_exists( 'constructionn_customize_register_colors' ) ) :
	/**
	 * Colors Settings
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_colors( $wp_customize ) {
		$wp_customize->add_setting(
			'primary_color',
			array(
				'default'           => sanitize_hex_color( '#0A204E' ),
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'primary_color',
				array(
					'label'   => __( 'Primary Color', 'constructionn' ),
					'section' => 'colors',
				)
			)
		);

		$wp_customize->add_setting(
			'secondary_color',
			array(
				'default'           => sanitize_hex_color( '#FCA311' ),
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'secondary_color',
				array(
					'label'   => __( 'Secondary Color', 'constructionn' ),
					'section' => 'colors',
				)
			)
		);

		$wp_customize->add_setting(
			'fallback_bg_color',
			array(
				'default'           => sanitize_hex_color( '#003262' ),
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'fallback_bg_color',
				array(
					'label'   => __( 'Fallback Background Image Color', 'constructionn' ),
					'section' => 'colors',
				)
			)
		);

		$wp_customize->add_setting(
			'white_color',
			array(
				'default'           => sanitize_hex_color( '#FFFFFF' ),
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'white_color',
				array(
					'label'   => __( 'White Color', 'constructionn' ),
					'section' => 'colors',
				)
			)
		);

		$wp_customize->add_setting(
			'bg_tertiary_color',
			array(
				'default'           => sanitize_hex_color( '#FAFBFB' ),
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'bg_tertiary_color',
				array(
					'label'   => __( 'Background Secondary Color', 'constructionn' ),
					'section' => 'colors',
				)
			)
		);

		$wp_customize->add_setting(
			'text_primary',
			array(
				'default'           => sanitize_hex_color( '#141414' ),
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'text_primary',
				array(
					'label'   => __( 'Text Primary Color', 'constructionn' ),
					'section' => 'colors',
				)
			)
		);

		$wp_customize->add_setting(
			'text_secondary',
			array(
				'default'           => sanitize_hex_color( '#686868' ),
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'text_secondary',
				array(
					'label'   => __( 'Text Secondary Color', 'constructionn' ),
					'section' => 'colors',
				)
			)
		);

		$wp_customize->add_setting(
			'text_tertiary',
			array(
				'default'           => sanitize_hex_color( '#EEEEEE' ),
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'text_tertiary',
				array(
					'label'   => __( 'Text Tertiary Color', 'constructionn' ),
					'section' => 'colors',
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_colors' );
