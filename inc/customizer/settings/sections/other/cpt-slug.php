<?php

if ( ! function_exists( 'constructionn_customize_register_cpt_slug' ) ) :
	/**
	 * Custom post type slug
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_cpt_slug( $wp_customize ) {
		// Add setting for cpt slug for team
		$wp_customize->add_section(
			'cpt_slug',
			array(
				'title'    => __( 'CPT Slug Settings', 'constructionn' ),
				'priority' => 70,
				'panel'    => 'general_settings_panel',
			)
		);

		$wp_customize->add_setting(
			'cpt_slug_team',
			array(
				'default'           => __( 'team', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Add control for cpt slug for team
		$wp_customize->add_control(
			'cpt_slug_team',
			array(
				'label'   => __( 'Team Slug', 'constructionn' ),
				'section' => 'cpt_slug',
				'type'    => 'text',
			)
		);

		// Add setting for cpt slug for service
		$wp_customize->add_setting(
			'cpt_slug_service',
			array(
				'default'           => __( 'service', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Add control for cpt slug for service
		$wp_customize->add_control(
			'cpt_slug_service',
			array(
				'label'   => __( 'Service Slug', 'constructionn' ),
				'section' => 'cpt_slug',
				'type'    => 'text',
			)
		);

		// Add setting for cpt slug for project
		$wp_customize->add_setting(
			'cpt_slug_project',
			array(
				'default'           => __( 'project', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Add control for cpt slug for project
		$wp_customize->add_control(
			'cpt_slug_project',
			array(
				'label'   => __( 'Project Slug', 'constructionn' ),
				'section' => 'cpt_slug',
				'type'    => 'text',
			)
		);

		// Add setting for cpt slug for casestudy
		$wp_customize->add_setting(
			'cpt_slug_casestudies',
			array(
				'default'           => __( 'case study', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Add control for cpt slug for casestudy
		$wp_customize->add_control(
			'cpt_slug_casestudies',
			array(
				'label'   => __( 'Case Study Slug', 'constructionn' ),
				'section' => 'cpt_slug',
				'type'    => 'text',
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_cpt_slug' );
