<?php

if ( ! function_exists( 'constructionn_customize_register_panels' ) ) :
	/**
	 * Registering Panel
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_panels( $wp_customize ) {
		$wp_customize->add_panel(
			'appearance_settings',
			array(
				'title'    => esc_html__( 'Appearance Settings', 'constructionn' ),
				'priority' => 10,
			)
		);

		$wp_customize->add_panel(
			'frontpage_settings_panel',
			array(
				'title'       => esc_html__( 'Front Page Settings', 'constructionn' ),
				'description' => esc_html__( 'Static Home Page Settings.', 'constructionn' ),
				'priority'    => 10,
			)
		);

		$wp_customize->add_panel(
			'general_settings_panel',
			array(
				'title'       => esc_html__( 'General Settings', 'constructionn' ),
				'description' => esc_html__( 'General Desc', 'constructionn' ),
				'priority'    => 10,
			)
		);

		// ----contact page settings panel----
		$wp_customize->add_panel(
			'contact_page_settings',
			array(
				'title'       => esc_html__( 'Contact Page Settings', 'constructionn' ),
				'description' => esc_html__( 'Contact Page Desc', 'constructionn' ),
				'priority'    => 10,
			)
		);

		// ----Casestudies page settings panel----
		$wp_customize->add_panel(
			'casestudies_page_settings',
			array(
				'title'       => esc_html__( 'Case Studies Page Settings', 'constructionn' ),
				'description' => esc_html__( 'Case Studies Page Desc', 'constructionn' ),
				'priority'    => 10,
			)
		);

		// ----Team page settings panel----
		$wp_customize->add_panel(
			'team_page_settings',
			array(
				'title'       => esc_html__( 'Team Page Settings', 'constructionn' ),
				'description' => esc_html__( 'Team Page Desc', 'constructionn' ),
				'priority'    => 10,
			)
		);

		// ----Service page settings panel----
		$wp_customize->add_panel(
			'Service_page_settings',
			array(
				'title'       => esc_html__( 'Service Page Settings', 'constructionn' ),
				'description' => esc_html__( 'Service Page Desc', 'constructionn' ),
				'priority'    => 10,
			)
		);

		// ----FAQ page settings panel----
		$wp_customize->add_panel(
			'faq_page_settings',
			array(
				'title'       => esc_html__( 'FAQ Page Settings', 'constructionn' ),
				'description' => esc_html__( 'FAQ Page Desc', 'constructionn' ),
				'priority'    => 10,
			)
		);

		// ----Testimonial page settings panel------------------------
		$wp_customize->add_panel(
			'testimonial_page_settings',
			array(
				'title'       => esc_html__( 'Testimonial Page Settings', 'constructionn' ),
				'description' => esc_html__( 'Testimonial Page Desc', 'constructionn' ),
				'priority'    => 10,
			)
		);

		// ----About page settings panel------------------------
		$wp_customize->add_panel(
			'about_page_settings',
			array(
				'title'       => esc_html__( 'About Page Settings', 'constructionn' ),
				'description' => esc_html__( 'About Page Desc', 'constructionn' ),
				'priority'    => 10,
			)
		);

		// ----Project page settings panel------------------------
		$wp_customize->add_panel(
			'project_page_settings',
			array(
				'title'       => esc_html__( 'Project Page Settings', 'constructionn' ),
				'description' => esc_html__( 'Project Page Desc', 'constructionn' ),
				'priority'    => 10,
			)
		);
		// ----Project Single settings panel------------------------
		$wp_customize->add_panel(
			'project_single_settings',
			array(
				'title'    => esc_html__( 'Project Single Settings', 'constructionn' ),
				'priority' => 10,
			)
		);

		// ----------------------------Details panel------------------------
		$wp_customize->add_panel(
			'details_settings',
			array(
				'title'       => esc_html__( 'Details Settings', 'constructionn' ),
				'description' => esc_html__( 'Details Desc', 'constructionn' ),
				'priority'    => 10,
			)
		);
		// ----Pricing page settings panel----
		$wp_customize->add_panel(
			'pricing_page_settings',
			array(
				'title'       => esc_html__( 'Pricing Page Settings', 'constructionn' ),
				'description' => esc_html__( 'Pricing Page Desc', 'constructionn' ),
				'priority'    => 10,
			)
		);
		// ----------------------------Footer panel------------------------
		$wp_customize->add_panel(
			'footer_settings',
			array(
				'title'       => esc_html__( 'Footer Settings', 'constructionn' ),
				'description' => esc_html__( 'Footer Desc', 'constructionn' ),
				'priority'    => 10,
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_panels' );
