<?php

if ( ! function_exists( 'constructionn_pro_customize_register_frontteam' ) ) :
	/**
	 * Front Team
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_frontteam( $wp_customize ) {

		$wp_customize->add_section(
			'front_team_section',
			array(
				'title'    => __( 'Team Settings', 'constructionn-pro' ),
				'priority' => 60,
				'panel'    => 'frontpage_settings_panel',
			)
		);

		// Add setting for Team Section Heading
		$wp_customize->add_setting(
			'front_team_headings',
			array(
				'default'           => __( 'Our working steps', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'front_team_headings',
			array(
				'selector'        => '.front-team h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'front_team_headings', __( 'Our working steps', 'constructionn-pro' ) ) );
				},
			)
		);

		// Add setting for Team Section Heading
		$wp_customize->add_control(
			'front_team_headings',
			array(
				'label'   => __( 'Heading', 'constructionn-pro' ),
				'section' => 'front_team_section',
				'type'    => 'text',
			)
		);

		// Add setting for Team Button Next Text
		$wp_customize->add_setting(
			'frontteam_btn_next_txt',
			array(
				'default'           => esc_html__( 'Next', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		// Add control for Team Button Next Text
		$wp_customize->add_control(
			'frontteam_btn_next_txt',
			array(
				'label'   => esc_html__( 'Button Next Text', 'constructionn-pro' ),
				'section' => 'front_team_section',
				'type'    => 'text',
			)
		);

		// Add setting for Team Button Previous Text
		$wp_customize->add_setting(
			'frontteam_btn_prev_txt',
			array(
				'default'           => esc_html__( 'Prev', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		// Add control for Team Button Previous Text
		$wp_customize->add_control(
			'frontteam_btn_prev_txt',
			array(
				'label'   => esc_html__( 'Button Previous Text', 'constructionn-pro' ),
				'section' => 'front_team_section',
				'type'    => 'text',
			)
		);

		/** Dynamic Team Section */
		$wp_customize->add_setting(
			new Constructionn_Pro_Repeater_Setting(
				$wp_customize,
				'front_team_repeater',
				array(
					'default'           => array(),
					'sanitize_callback' => array( 'Constructionn_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Pro_Control_Repeater(
				$wp_customize,
				'front_team_repeater',
				array(
					'section'   => 'front_team_section',
					'label'     => __( 'Add Teams', 'constructionn-pro' ),
					'fields'    => array(
						'team' => array(
							'type'    => 'select',
							'label'   => __( 'Select Team', 'constructionn-pro' ),
							'choices' => constructionn_pro_get_posts( 'team' ),
						),
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __( 'Team', 'constructionn-pro' ),
						'field' => 'title',
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_frontteam' );
