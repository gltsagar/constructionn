<?php

if ( ! function_exists( 'constructionn_customize_register_abtpg_counter' ) ) :
	/**
	 * Aboutpage Counter
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_abtpg_counter( $wp_customize ) {
		$wp_customize->add_section(
			'abtpg_counter_section',
			array(
				'title'    => esc_html__( 'Counter Settings', 'constructionn' ),
				'priority' => 30,
				'panel'    => 'about_page_settings',
			)
		);

		// Add setting for Section Heading
		$wp_customize->add_setting(
			'abtpg_counter_headings',
			array(
				'default'           => esc_html__( 'Our goal is to make the design simple and useful.', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'abtpg_counter_headings',
			array(
				'selector'        => '.aboutpg-counter h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'abtpg_counter_headings', esc_html__( 'Our goal is to make the design simple and useful.', 'constructionn' ) ) );
				},
			)
		);

		// Add Control for Section Heading
		$wp_customize->add_control(
			'abtpg_counter_headings',
			array(
				'label'   => esc_html__( 'Heading', 'constructionn' ),
				'section' => 'abtpg_counter_section',
				'type'    => 'text',
			)
		);

		/** Repeater Custom For Aboutpage Counter Section */
		$wp_customize->add_setting(
			new Constructionn_Repeater_Setting(
				$wp_customize,
				'abtpg_counter_repeaters',
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
				'abtpg_counter_repeaters',
				array(
					'section'   => 'abtpg_counter_section',
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

		/** Dynamic Aboutpage Count Features Section */
		$wp_customize->add_setting(
			new Constructionn_Repeater_Setting(
				$wp_customize,
				'abtpg_count_feature_repeaters',
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
				'abtpg_count_feature_repeaters',
				array(
					'section'   => 'abtpg_counter_section',
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
add_action( 'customize_register', 'constructionn_customize_register_abtpg_counter' );
