<?php

if ( ! function_exists( 'constructionn_customize_register_front_casestudies' ) ) :
	/**
	 * Front Casestudies
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_front_casestudies( $wp_customize ) {

		$wp_customize->add_section(
			'front_casestudies_section',
			array(
				'title'    => __( 'Case Studies Settings', 'constructionn' ),
				'priority' => 80,
				'panel'    => 'frontpage_settings_panel',
			)
		);

		// Add setting for Casestudies Section Heading
		$wp_customize->add_setting(
			'front_casestudies_heading',
			array(
				'default'           => __( 'Case studies define our success.', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'front_casestudies_heading',
			array(
				'selector'        => '.front-casestudies h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'front_casestudies_heading', __( 'Case studies define our success.', 'constructionn' ) ) );
				},
			)
		);

		// Add setting for Casestudies Section Heading
		$wp_customize->add_control(
			'front_casestudies_heading',
			array(
				'label'   => __( 'Heading', 'constructionn' ),
				'section' => 'front_casestudies_section',
				'type'    => 'text',
			)
		);

		// Add setting  and control for Case study explore more button text
		$wp_customize->add_setting(
			'cs_btn_text',
			array(
				'default'           => esc_html__( 'Explore More', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'cs_btn_text',
			array(
				'selector'        => '.front-casestudies a.btn.btn__text.has-icon.has-primary-color',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'cs_btn_text', __( 'Explore More', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'cs_btn_text',
			array(
				'label'   => esc_html__( 'Button Text', 'constructionn' ),
				'section' => 'front_casestudies_section',
				'type'    => 'text',
			)
		);

		/** Dynamic Casestudies Section */
		$wp_customize->add_setting(
			new Constructionn_Repeater_Setting(
				$wp_customize,
				'front_casestudies_repeater',
				array(
					'default'           => '',
					'sanitize_callback' => array( 'Constructionn_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Control_Repeater(
				$wp_customize,
				'front_casestudies_repeater',
				array(
					'section'   => 'front_casestudies_section',
					'label'     => __( 'Add Casestudies', 'constructionn' ),
					'fields'    => array(
						'casestudy' => array(
							'type'    => 'select',
							'label'   => __( 'Select Casestudies', 'constructionn' ),
							'choices' => constructionn_get_posts( 'case-study' ),
						),
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __( 'Casestudies', 'constructionn' ),
						'field' => 'title',
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_front_casestudies' );
