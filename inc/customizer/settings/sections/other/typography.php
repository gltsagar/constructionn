<?php

if ( ! function_exists( 'constructionn_customize_register_typography_body' ) ) :
	/**
	 * Typography Body Settings
	 *
	 * @package Constructionn Pro
	 */
	function constructionn_customize_register_typography_body( $wp_customize ) {
		$defaults = constructionn_get_typography_defaults();

		$wp_customize->add_section(
			'typography_settings',
			array(
				'title'    => __( 'Typography Settings', 'constructionn' ),
				'priority' => 50,
				'panel'    => 'appearance_settings',
			)
		);

		$wp_customize->add_setting(
			'toggle_localgoogle_fonts',
			array(
				'default'           => false,
				'sanitize_callback' => 'constructionn_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'toggle_localgoogle_fonts',
				array(
					'label'   => __( 'Enable to load the google fonts locally.', 'constructionn' ),
					'section' => 'typography_settings',
					'type'    => 'checkbox',
				)
			)
		);

		$wp_customize->add_setting(
			'primary_font[family]',
			array(
				'default'           => $defaults['primary_font']['family'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_setting(
			'primary_font[variants]',
			array(
				'default'           => $defaults['primary_font']['variants'],
				'sanitize_callback' => 'constructionn_sanitize_variants',
			)
		);

		$wp_customize->add_setting(
			'primary_font[category]',
			array(
				'default'           => $defaults['primary_font']['category'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_setting(
			'primary_font[weight]',
			array(
				'default'           => $defaults['primary_font']['weight'],
				'sanitize_callback' => 'sanitize_key',
			)
		);

		$wp_customize->add_setting(
			'primary_font[transform]',
			array(
				'default'           => $defaults['primary_font']['transform'],
				'sanitize_callback' => 'sanitize_key',
			)
		);

		$wp_customize->add_control(
			new GL_Typography_Control(
				$wp_customize,
				'primary_font',
				array(
					'label'    => __( 'Primary Font', 'constructionn' ),
					'section'  => 'typography_settings',
					'settings' => array(
						'family'    => 'primary_font[family]',
						'variant'   => 'primary_font[variants]',
						'category'  => 'primary_font[category]',
						'weight'    => 'primary_font[weight]',
						'transform' => 'primary_font[transform]',
					),
				)
			)
		);

		/** Body Font Size */
		$wp_customize->add_setting(
			'primary_font[font_size]',
			array(
				'default'           => $defaults['primary_font']['font_size'],
				'sanitize_callback' => 'constructionn_sanitize_empty_absint',
			)
		);

		$wp_customize->add_control(
			new GL_Slider_Control(
				$wp_customize,
				'primary_font[font_size]',
				array(
					'label'   => __( 'Primary Font Size', 'constructionn' ),
					'section' => 'typography_settings',
					'choices' => array(
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					),
				)
			)
		);

		/** Line break */
		$wp_customize->add_setting(
			'primary_font_note_text',
			array(
				'default'           => '',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			new Note_Control(
				$wp_customize,
				'primary_font_note_text',
				array(
					'section' => 'typography_settings',
					'label'   => '',
				)
			)
		);

		$wp_customize->add_setting(
			'heading_one[family]',
			array(
				'default'           => $defaults['heading_one']['family'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_setting(
			'heading_one[variants]',
			array(
				'default'           => $defaults['heading_one']['variants'],
				'sanitize_callback' => 'constructionn_sanitize_variants',
			)
		);

		$wp_customize->add_setting(
			'heading_one[category]',
			array(
				'default'           => $defaults['heading_one']['category'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_setting(
			'heading_one[weight]',
			array(
				'default'           => $defaults['heading_one']['weight'],
				'sanitize_callback' => 'sanitize_key',
			)
		);

		$wp_customize->add_setting(
			'heading_one[transform]',
			array(
				'default'           => $defaults['heading_one']['transform'],
				'sanitize_callback' => 'sanitize_key',

			)
		);

		$wp_customize->add_control(
			new GL_Typography_Control(
				$wp_customize,
				'heading_one_typography',
				array(
					'label'    => __( 'Heading One', 'constructionn' ),
					'section'  => 'typography_settings',
					'settings' => array(
						'family'    => 'heading_one[family]',
						'variant'   => 'heading_one[variants]',
						'category'  => 'heading_one[category]',
						'weight'    => 'heading_one[weight]',
						'transform' => 'heading_one[transform]',
					),
				)
			)
		);

		/** Body Font Size */
		$wp_customize->add_setting(
			'heading_one[font_size]',
			array(
				'default'           => $defaults['heading_one']['font_size'],
				'sanitize_callback' => 'constructionn_sanitize_empty_absint',
			)
		);

		$wp_customize->add_control(
			new GL_Slider_Control(
				$wp_customize,
				'heading_one[font_size]',
				array(
					'label'   => __( 'Heading One Font Size', 'constructionn' ),
					'section' => 'typography_settings',
					'choices' => array(
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					),
				)
			)
		);

		/** Line break */
		$wp_customize->add_setting(
			'heading_one_note_text',
			array(
				'default'           => '',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			new Note_Control(
				$wp_customize,
				'heading_one_note_text',
				array(
					'section' => 'typography_settings',
					'label'   => '',
				)
			)
		);

		$wp_customize->add_setting(
			'heading_two[family]',
			array(
				'default'           => $defaults['heading_two']['family'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_setting(
			'heading_two[variants]',
			array(
				'default'           => $defaults['heading_two']['variants'],
				'sanitize_callback' => 'constructionn_sanitize_variants',
			)
		);

		$wp_customize->add_setting(
			'heading_two[category]',
			array(
				'default'           => $defaults['heading_two']['category'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_setting(
			'heading_two[weight]',
			array(
				'default'           => $defaults['heading_two']['weight'],
				'sanitize_callback' => 'sanitize_key',
			)
		);

		$wp_customize->add_setting(
			'heading_two[transform]',
			array(
				'default'           => $defaults['heading_two']['transform'],
				'sanitize_callback' => 'sanitize_key',

			)
		);

		$wp_customize->add_control(
			new GL_Typography_Control(
				$wp_customize,
				'heading_two_typography',
				array(
					'label'    => __( 'Heading Two', 'constructionn' ),
					'section'  => 'typography_settings',
					'settings' => array(
						'family'    => 'heading_two[family]',
						'variant'   => 'heading_two[variants]',
						'category'  => 'heading_two[category]',
						'weight'    => 'heading_two[weight]',
						'transform' => 'heading_two[transform]',
					),
				)
			)
		);

		/** Body Font Size */
		$wp_customize->add_setting(
			'heading_two[font_size]',
			array(
				'default'           => $defaults['heading_two']['font_size'],
				'sanitize_callback' => 'constructionn_sanitize_empty_absint',
			)
		);

		$wp_customize->add_control(
			new GL_Slider_Control(
				$wp_customize,
				'heading_two[font_size]',
				array(
					'label'   => __( 'Heading Two Font Size', 'constructionn' ),
					'section' => 'typography_settings',
					'choices' => array(
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					),
				)
			)
		);

		/** Line break */
		$wp_customize->add_setting(
			'heading_two_note_text',
			array(
				'default'           => '',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			new Note_Control(
				$wp_customize,
				'heading_two_note_text',
				array(
					'section' => 'typography_settings',
					'label'   => '',
				)
			)
		);

		$wp_customize->add_setting(
			'heading_three[family]',
			array(
				'default'           => $defaults['heading_three']['family'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_setting(
			'heading_three[variants]',
			array(
				'default'           => $defaults['heading_three']['variants'],
				'sanitize_callback' => 'constructionn_sanitize_variants',
			)
		);

		$wp_customize->add_setting(
			'heading_three[category]',
			array(
				'default'           => $defaults['heading_three']['category'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_setting(
			'heading_three[weight]',
			array(
				'default'           => $defaults['heading_three']['weight'],
				'sanitize_callback' => 'sanitize_key',
			)
		);

		$wp_customize->add_setting(
			'heading_three[transform]',
			array(
				'default'           => $defaults['heading_three']['transform'],
				'sanitize_callback' => 'sanitize_key',

			)
		);

		$wp_customize->add_control(
			new GL_Typography_Control(
				$wp_customize,
				'heading_three_typography',
				array(
					'label'    => __( 'Heading Three', 'constructionn' ),
					'section'  => 'typography_settings',
					'settings' => array(
						'family'    => 'heading_three[family]',
						'variant'   => 'heading_three[variants]',
						'category'  => 'heading_three[category]',
						'weight'    => 'heading_three[weight]',
						'transform' => 'heading_three[transform]',
					),
				)
			)
		);

		/** Body Font Size */
		$wp_customize->add_setting(
			'heading_three[font_size]',
			array(
				'default'           => $defaults['heading_three']['font_size'],
				'sanitize_callback' => 'constructionn_sanitize_empty_absint',
			)
		);

		$wp_customize->add_control(
			new GL_Slider_Control(
				$wp_customize,
				'heading_three[font_size]',
				array(
					'label'   => __( 'Heading Three Font Size', 'constructionn' ),
					'section' => 'typography_settings',
					'choices' => array(
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					),
				)
			)
		);

		/** Line break */
		$wp_customize->add_setting(
			'heading_three_note_text',
			array(
				'default'           => '',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			new Note_Control(
				$wp_customize,
				'heading_three_note_text',
				array(
					'section' => 'typography_settings',
					'label'   => '',
				)
			)
		);

		$wp_customize->add_setting(
			'heading_four[family]',
			array(
				'default'           => $defaults['heading_four']['family'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_setting(
			'heading_four[variants]',
			array(
				'default'           => $defaults['heading_four']['variants'],
				'sanitize_callback' => 'constructionn_sanitize_variants',
			)
		);

		$wp_customize->add_setting(
			'heading_four[category]',
			array(
				'default'           => $defaults['heading_four']['category'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_setting(
			'heading_four[weight]',
			array(
				'default'           => $defaults['heading_four']['weight'],
				'sanitize_callback' => 'sanitize_key',
			)
		);

		$wp_customize->add_setting(
			'heading_four[transform]',
			array(
				'default'           => $defaults['heading_four']['transform'],
				'sanitize_callback' => 'sanitize_key',

			)
		);

		$wp_customize->add_control(
			new GL_Typography_Control(
				$wp_customize,
				'heading_four_typography',
				array(
					'label'    => __( 'Heading Four', 'constructionn' ),
					'section'  => 'typography_settings',
					'settings' => array(
						'family'    => 'heading_four[family]',
						'variant'   => 'heading_four[variants]',
						'category'  => 'heading_four[category]',
						'weight'    => 'heading_four[weight]',
						'transform' => 'heading_four[transform]',
					),
				)
			)
		);

		/** Body Font Size */
		$wp_customize->add_setting(
			'heading_four[font_size]',
			array(
				'default'           => $defaults['heading_four']['font_size'],
				'sanitize_callback' => 'constructionn_sanitize_empty_absint',
			)
		);

		$wp_customize->add_control(
			new GL_Slider_Control(
				$wp_customize,
				'heading_four[font_size]',
				array(
					'label'   => __( 'Heading Four Font Size', 'constructionn' ),
					'section' => 'typography_settings',
					'choices' => array(
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					),
				)
			)
		);

		/** Line break */
		$wp_customize->add_setting(
			'heading_four_note_text',
			array(
				'default'           => '',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			new Note_Control(
				$wp_customize,
				'heading_four_note_text',
				array(
					'section' => 'typography_settings',
					'label'   => '',
				)
			)
		);

		$wp_customize->add_setting(
			'heading_five[family]',
			array(
				'default'           => $defaults['heading_five']['family'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_setting(
			'heading_five[variants]',
			array(
				'default'           => $defaults['heading_five']['variants'],
				'sanitize_callback' => 'constructionn_sanitize_variants',
			)
		);

		$wp_customize->add_setting(
			'heading_five[category]',
			array(
				'default'           => $defaults['heading_five']['category'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_setting(
			'heading_five[weight]',
			array(
				'default'           => $defaults['heading_five']['weight'],
				'sanitize_callback' => 'sanitize_key',
			)
		);

		$wp_customize->add_setting(
			'heading_five[transform]',
			array(
				'default'           => $defaults['heading_five']['transform'],
				'sanitize_callback' => 'sanitize_key',

			)
		);

		$wp_customize->add_control(
			new GL_Typography_Control(
				$wp_customize,
				'heading_five_typography',
				array(
					'label'    => __( 'Heading Five', 'constructionn' ),
					'section'  => 'typography_settings',
					'settings' => array(
						'family'    => 'heading_five[family]',
						'variant'   => 'heading_five[variants]',
						'category'  => 'heading_five[category]',
						'weight'    => 'heading_five[weight]',
						'transform' => 'heading_five[transform]',
					),
				)
			)
		);

		/** Body Font Size */
		$wp_customize->add_setting(
			'heading_five[font_size]',
			array(
				'default'           => $defaults['heading_five']['font_size'],
				'sanitize_callback' => 'constructionn_sanitize_empty_absint',
			)
		);

		$wp_customize->add_control(
			new GL_Slider_Control(
				$wp_customize,
				'heading_five[font_size]',
				array(
					'label'   => __( 'Heading Five Font Size', 'constructionn' ),
					'section' => 'typography_settings',
					'choices' => array(
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					),
				)
			)
		);

		/** Line break */
		$wp_customize->add_setting(
			'heading_five_note_text',
			array(
				'default'           => '',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			new Note_Control(
				$wp_customize,
				'heading_five_note_text',
				array(
					'section' => 'typography_settings',
					'label'   => '',
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_typography_body' );
