<?php

if ( ! function_exists( 'constructionn_customize_register_servicepg_team' ) ) :
	/**
	 * Servicepage Team
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_servicepg_team( $wp_customize ) {

		$wp_customize->add_section(
			'servpg_team_section',
			array(
				'title'    => __( 'Team Settings', 'constructionn' ),
				'priority' => 30,
				'panel'    => 'Service_page_settings',
			)
		);

		// Add setting for Team Section Heading
		$wp_customize->add_setting(
			'servpg_team_headings',
			array(
				'default'           => __( 'Our working steps', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'servpg_team_headings',
			array(
				'selector'        => '.servicepg-team h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'servpg_team_headings', __( 'Our working steps', 'constructionn' ) ) );
				},
			)
		);

		// Add setting for Team Section Heading
		$wp_customize->add_control(
			'servpg_team_headings',
			array(
				'label'   => __( 'Heading', 'constructionn' ),
				'section' => 'servpg_team_section',
				'type'    => 'text',
			)
		);

		// Add setting for Team Button Next Text
		$wp_customize->add_setting(
			'servpg_team_btn_next_txt',
			array(
				'default'           => esc_html__( 'Next', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		// Add control for Team Button Next Text
		$wp_customize->add_control(
			'servpg_team_btn_next_txt',
			array(
				'label'   => esc_html__( 'Button Next Text', 'constructionn' ),
				'section' => 'servpg_team_section',
				'type'    => 'text',
			)
		);

		// Add setting for Team Button Previous Text
		$wp_customize->add_setting(
			'servpg_team_btn_prev_txt',
			array(
				'default'           => esc_html__( 'Prev', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		// Add control for Team Button Previous Text
		$wp_customize->add_control(
			'servpg_team_btn_prev_txt',
			array(
				'label'   => esc_html__( 'Button Previous Text', 'constructionn' ),
				'section' => 'servpg_team_section',
				'type'    => 'text',
			)
		);

		/** Dynamic Team Section */
		$wp_customize->add_setting(
			new Constructionn_Repeater_Setting(
				$wp_customize,
				'servpg_team_repeater',
				array(
					'default'           => array(),
					'sanitize_callback' => array( 'Constructionn_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Control_Repeater(
				$wp_customize,
				'servpg_team_repeater',
				array(
					'section'   => 'servpg_team_section',
					'label'     => __( 'Add Teams', 'constructionn' ),
					'fields'    => array(
						'team' => array(
							'type'    => 'select',
							'label'   => __( 'Select Team', 'constructionn' ),
							'choices' => constructionn_get_posts( 'team' ),
						),
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __( 'Team', 'constructionn' ),
						'field' => 'title',
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_servicepg_team' );
