<?php

if ( ! function_exists( 'constructionn_customize_register_casestudypg_casestudies' ) ) :
	/**
	 * Casestudiespage Casestudies
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_casestudypg_casestudies( $wp_customize ) {

		$wp_customize->add_section(
			'cspg_casestudies_section',
			array(
				'title'    => __( 'Case Studies Settings', 'constructionn' ),
				'priority' => 10,
				'panel'    => 'casestudies_page_settings',
			)
		);

		// Add setting for Casestudies Section Heading
		$wp_customize->add_setting(
			'cspg_casestudies_heading',
			array(
				'default'           => __( 'Case studies define our success.', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'cspg_casestudies_heading',
			array(
				'selector'        => '.case_studies-section.has-tabs h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'cspg_casestudies_heading', __( 'Case studies define our success.', 'constructionn' ) ) );
				},
			)
		);

		// Add setting for Casestudies Section Heading
		$wp_customize->add_control(
			'cspg_casestudies_heading',
			array(
				'label'   => __( 'Heading', 'constructionn' ),
				'section' => 'cspg_casestudies_section',
				'type'    => 'text',
			)
		);

		// Add setting  and control for Case study explore more button text
		$wp_customize->add_setting(
			'cspg_btn_text',
			array(
				'default'           => esc_html__( 'Explore More', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'cspg_btn_text',
			array(
				'selector'        => '.case_studies-section.has-tabs a.btn.btn__text.has-icon.has-primary-color',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'cspg_btn_text', __( 'Explore More', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'cspg_btn_text',
			array(
				'label'   => esc_html__( 'Button Text', 'constructionn' ),
				'section' => 'cspg_casestudies_section',
				'type'    => 'text',
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_casestudypg_casestudies' );
