<?php

if ( ! function_exists( 'constructionn_customize_register_frontcounter' ) ) :
	/**
	 * Front Counter
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_frontcounter( $wp_customize ) {
		$wp_customize->add_section(
			'counter_section',
			array(
				'title'    => esc_html__( 'Counter Settings', 'constructionn' ),
				'priority' => 20,
				'panel'    => 'frontpage_settings_panel',
			)
		);

		// Add setting for Section Heading
		$wp_customize->add_setting(
			'counter_headings',
			array(
				'default'           => esc_html__( 'Our goal is to make the design simple and useful.', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'counter_headings',
			array(
				'selector'        => '.front-counter h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'counter_headings', esc_html__( 'Our goal is to make the design simple and useful.', 'constructionn' ) ) );
				},
			)
		);

		// Add Control for Section Heading
		$wp_customize->add_control(
			'counter_headings',
			array(
				'label'   => esc_html__( 'Heading', 'constructionn' ),
				'section' => 'counter_section',
				'type'    => 'text',
			)
		);

		/** Repeater Custom For Frontpage Counter Section */
		$wp_customize->add_setting(
			new Constructionn_Repeater_Setting(
				$wp_customize,
				'front_counter_repeaters',
				array(
					'default'           =>
					array(
						array(
							'title'   => __( 'Destinations', 'constructionn' ),
							'counter' => __( '150', 'constructionn' ),
							'prefix'  => __( '+', 'constructionn' ),
						),
						array(
							'title'   => __( 'Happy clients', 'constructionn' ),
							'counter' => __( '100', 'constructionn' ),
							'prefix'  => __( '+', 'constructionn' ),
						),
						array(
							'title'   => __( 'Years of experience', 'constructionn' ),
							'counter' => __( '12', 'constructionn' ),
							'prefix'  => __( '+', 'constructionn' ),
						),
					),
					'sanitize_callback' => array( 'Constructionn_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Control_Repeater(
				$wp_customize,
				'front_counter_repeaters',
				array(
					'section'   => 'counter_section',
					'label'     => __( 'Add Counter', 'constructionn' ),
					'fields'    => array(
						'title'   => array(
							'type'  => 'text',
							'label' => __( 'Add Title', 'constructionn' ),
						),
						'counter' => array(
							'type'  => 'text',
							'label' => __( 'Add Count', 'constructionn' ),
						),
						'prefix'  => array(
							'type'  => 'text',
							'label' => __( 'Add Prefix', 'constructionn' ),
						),
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __( 'Counter', 'constructionn' ),
						'field' => 'title',
					),
				)
			)
		);

		/** Dynamic Front Count Features Section */
		$wp_customize->add_setting(
			new Constructionn_Repeater_Setting(
				$wp_customize,
				'front_count_feature_repeaters',
				array(
					'default'           => array(
						array(
							'text'        => esc_html__( 'Our Mission', 'constructionn' ),
							'description' => esc_html__( 'Reimagine how world develops by integrating the complete building lifecycle into a seamless platform.', 'constructionn' ),
						),

						array(
							'text'        => esc_html__( 'Our Core Values', 'constructionn' ),
							'description' => esc_html__( 'Reimagine how world develops by integrating the complete building lifecycle into a seamless platform.', 'constructionn' ),
						),

						array(
							'text'        => esc_html__( 'Our Vision', 'constructionn' ),
							'description' => esc_html__( 'Reimagine how world develops by integrating the complete building lifecycle into a seamless platform.', 'constructionn' ),
						),
					),
					'sanitize_callback' => array( 'Constructionn_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Control_Repeater(
				$wp_customize,
				'front_count_feature_repeaters',
				array(
					'section'   => 'counter_section',
					'label'     => __( 'Add Features', 'constructionn' ),
					'fields'    => array(
						'text'        => array(
							'type'  => 'text',
							'label' => __( 'Add Title', 'constructionn' ),
						),
						'description' => array(
							'type'  => 'textarea',
							'label' => __( 'Add Description', 'constructionn' ),
						),
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __( 'Features', 'constructionn' ),
						'field' => 'title',
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_frontcounter' );
