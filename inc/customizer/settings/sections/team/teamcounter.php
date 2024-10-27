<?php

if ( ! function_exists( 'constructionn_customize_register_teampg_counter' ) ) :
	/**
	 * Teampage Counter
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_teampg_counter( $wp_customize ) {
		$wp_customize->add_section(
			'teampg_counter_section',
			array(
				'title'    => esc_html__( 'Counter Settings', 'constructionn' ),
				'priority' => 40,
				'panel'    => 'team_page_settings',
			)
		);

		// Add setting for Section Heading
		$wp_customize->add_setting(
			'teampg_counter_headings',
			array(
				'default'           => esc_html__( 'Our goal is to make the design simple and useful.', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'teampg_counter_headings',
			array(
				'selector'        => '.teampg-counter h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'teampg_counter_headings', esc_html__( 'Our goal is to make the design simple and useful.', 'constructionn' ) ) );
				},
			)
		);

		// Add Control for Section Heading
		$wp_customize->add_control(
			'teampg_counter_headings',
			array(
				'label'   => esc_html__( 'Heading', 'constructionn' ),
				'section' => 'teampg_counter_section',
				'type'    => 'text',
			)
		);

		/** Repeater Custom For Teampage Counter Section */
		$wp_customize->add_setting(
			new Constructionn_Repeater_Setting(
				$wp_customize,
				'teampg_counter_repeaters',
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
				'teampg_counter_repeaters',
				array(
					'section'   => 'teampg_counter_section',
					'label'     => __( 'Add Goal Counter', 'constructionn' ),
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

		/** Dynamic Teampage Counter Features Section */
		$wp_customize->add_setting(
			new Constructionn_Repeater_Setting(
				$wp_customize,
				'teampg_count_feature_repeaters',
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
				'teampg_count_feature_repeaters',
				array(
					'section'   => 'teampg_counter_section',
					'label'     => __( 'Add Goal Features', 'constructionn' ),
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
add_action( 'customize_register', 'constructionn_customize_register_teampg_counter' );
