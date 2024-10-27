<?php

if ( ! function_exists( 'constructionn_customize_register_teampg_team' ) ) :
	/**
	 * Teampage Team
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_teampg_team( $wp_customize ) {

		$wp_customize->add_section(
			'teampg_team_section',
			array(
				'title'    => __( 'Team Settings', 'constructionn' ),
				'priority' => 10,
				'panel'    => 'team_page_settings',
			)
		);

		// Add setting for Team Section Heading
		$wp_customize->add_setting(
			'teampg_team_headings',
			array(
				'default'           => __( 'Our working steps', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'teampg_team_headings',
			array(
				'selector'        => '.teams-section h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'teampg_team_headings', __( 'Our working steps', 'constructionn' ) ) );
				},
			)
		);

		// Add setting for Team Section Heading
		$wp_customize->add_control(
			'teampg_team_headings',
			array(
				'label'   => __( 'Heading', 'constructionn' ),
				'section' => 'teampg_team_section',
				'type'    => 'text',
			)
		);

		// Add setting for Team Button Next Text
		$wp_customize->add_setting(
			'tpg_team_btn_next_txt',
			array(
				'default'           => esc_html__( 'Next', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		// Add control for Team Button Next Text
		$wp_customize->add_control(
			'tpg_team_btn_next_txt',
			array(
				'label'   => esc_html__( 'Button Next Text', 'constructionn' ),
				'section' => 'teampg_team_section',
				'type'    => 'text',
			)
		);

		// Add setting for Team Button Previous Text
		$wp_customize->add_setting(
			'tpg_team_btn_prev_txt',
			array(
				'default'           => esc_html__( 'Prev', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		// Add control for Team Button Previous Text
		$wp_customize->add_control(
			'tpg_team_btn_prev_txt',
			array(
				'label'   => esc_html__( 'Button Previous Text', 'constructionn' ),
				'section' => 'teampg_team_section',
				'type'    => 'text',
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_teampg_team' );
