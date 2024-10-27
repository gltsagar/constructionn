<?php

if ( ! function_exists( 'constructionn_pro_customize_register_abtpg_counter' ) ) :
	/**
	 * Aboutpage Counter
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_abtpg_counter( $wp_customize ) {
		$wp_customize->add_section(
			'abtpg_counter_section',
			array(
				'title'    => esc_html__( 'Counter Settings', 'constructionn-pro' ),
				'priority' => 30,
				'panel'    => 'about_page_settings',
			)
		);

		// Add setting for Section Heading
		$wp_customize->add_setting(
			'abtpg_counter_headings',
			array(
				'default'           => esc_html__( 'Our goal is to make the design simple and useful.', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'abtpg_counter_headings',
			array(
				'selector'        => '.aboutpg-counter h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'abtpg_counter_headings', esc_html__( 'Our goal is to make the design simple and useful.', 'constructionn-pro' ) ) );
				},
			)
		);

		// Add Control for Section Heading
		$wp_customize->add_control(
			'abtpg_counter_headings',
			array(
				'label'   => esc_html__( 'Heading', 'constructionn-pro' ),
				'section' => 'abtpg_counter_section',
				'type'    => 'text',
			)
		);

		/** Repeater Custom For Aboutpage Counter Section */
		$wp_customize->add_setting(
			new Constructionn_Pro_Repeater_Setting(
				$wp_customize,
				'abtpg_counter_repeaters',
				array(
					'default'           =>
					array(
						array(
							'title'   => __( 'Destinations', 'constructionn-pro' ),
							'counter' => __( '150', 'constructionn-pro' ),
							'prefix'  => __( '+', 'constructionn-pro' ),
						),
						array(
							'title'   => __( 'Happy clients', 'constructionn-pro' ),
							'counter' => __( '100', 'constructionn-pro' ),
							'prefix'  => __( '+', 'constructionn-pro' ),
						),
						array(
							'title'   => __( 'Years of experience', 'constructionn-pro' ),
							'counter' => __( '12', 'constructionn-pro' ),
							'prefix'  => __( '+', 'constructionn-pro' ),
						),
					),
					'sanitize_callback' => array( 'Constructionn_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Pro_Control_Repeater(
				$wp_customize,
				'abtpg_counter_repeaters',
				array(
					'section'   => 'abtpg_counter_section',
					'label'     => __( 'Add Counter', 'constructionn-pro' ),
					'fields'    => array(
						'title'   => array(
							'type'  => 'text',
							'label' => __( 'Add Title', 'constructionn-pro' ),
						),
						'counter' => array(
							'type'  => 'text',
							'label' => __( 'Add Count', 'constructionn-pro' ),
						),
						'prefix'  => array(
							'type'  => 'text',
							'label' => __( 'Add Prefix', 'constructionn-pro' ),
						),
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __( 'Counter', 'constructionn-pro' ),
						'field' => 'title',
					),
				)
			)
		);

		/** Dynamic Aboutpage Count Features Section */
		$wp_customize->add_setting(
			new Constructionn_Pro_Repeater_Setting(
				$wp_customize,
				'abtpg_count_feature_repeaters',
				array(
					'default'           => array(
						array(
							'text'        => esc_html__( 'Our Mission', 'constructionn-pro' ),
							'description' => esc_html__( 'Reimagine how world develops by integrating the complete building lifecycle into a seamless platform.', 'constructionn-pro' ),
						),

						array(
							'text'        => esc_html__( 'Our Core Values', 'constructionn-pro' ),
							'description' => esc_html__( 'Reimagine how world develops by integrating the complete building lifecycle into a seamless platform.', 'constructionn-pro' ),
						),

						array(
							'text'        => esc_html__( 'Our Vision', 'constructionn-pro' ),
							'description' => esc_html__( 'Reimagine how world develops by integrating the complete building lifecycle into a seamless platform.', 'constructionn-pro' ),
						),
					),
					'sanitize_callback' => array( 'Constructionn_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Pro_Control_Repeater(
				$wp_customize,
				'abtpg_count_feature_repeaters',
				array(
					'section'   => 'abtpg_counter_section',
					'label'     => __( 'Add Features', 'constructionn-pro' ),
					'fields'    => array(
						'text'        => array(
							'type'  => 'text',
							'label' => __( 'Add Title', 'constructionn-pro' ),
						),
						'description' => array(
							'type'  => 'textarea',
							'label' => __( 'Add Description', 'constructionn-pro' ),
						),
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __( 'Features', 'constructionn-pro' ),
						'field' => 'title',
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_abtpg_counter' );
