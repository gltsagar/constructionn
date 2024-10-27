<?php

if ( ! function_exists( 'constructionn_pro_customize_register_abtpg_casestudies' ) ) :
	/**
	 * Aboutpage Casestudies
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_abtpg_casestudies( $wp_customize ) {

		$wp_customize->add_section(
			'abtpg_casestudies_section',
			array(
				'title'    => __( 'Case Studies Settings', 'constructionn-pro' ),
				'priority' => 60,
				'panel'    => 'about_page_settings',
			)
		);

		// Add setting for Casestudies Section Heading
		$wp_customize->add_setting(
			'abtpg_casestudies_heading',
			array(
				'default'           => __( 'Case studies define our success.', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'abtpg_casestudies_heading',
			array(
				'selector'        => '.about-us-case-studies h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'abtpg_casestudies_heading', __( 'Case studies define our success.', 'constructionn-pro' ) ) );
				},
			)
		);

		// Add setting for Casestudies Section Heading
		$wp_customize->add_control(
			'abtpg_casestudies_heading',
			array(
				'label'   => __( 'Heading', 'constructionn-pro' ),
				'section' => 'abtpg_casestudies_section',
				'type'    => 'text',
			)
		);

		// Add setting  and control for Case study explore more button text
		$wp_customize->add_setting(
			'aboutpg_cs_btn_text',
			array(
				'default'           => esc_html__( 'Explore More', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'aboutpg_cs_btn_text',
			array(
				'selector'        => '.about-us-case-studies a.btn.btn__text.has-icon.has-primary-color',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'aboutpg_cs_btn_text', __( 'Explore More', 'constructionn-pro' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'aboutpg_cs_btn_text',
			array(
				'label'   => esc_html__( 'Button Text', 'constructionn-pro' ),
				'section' => 'abtpg_casestudies_section',
				'type'    => 'text',
			)
		);

		/** Dynamic Casestudies Section */
		$wp_customize->add_setting(
			new Constructionn_Pro_Repeater_Setting(
				$wp_customize,
				'abtpg_casestudies_repeater',
				array(
					'default'           => '',
					'sanitize_callback' => array( 'Constructionn_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Pro_Control_Repeater(
				$wp_customize,
				'abtpg_casestudies_repeater',
				array(
					'section'   => 'abtpg_casestudies_section',
					'label'     => __( 'Add Casestudies', 'constructionn-pro' ),
					'fields'    => array(
						'casestudy' => array(
							'type'    => 'select',
							'label'   => __( 'Select Casestudies', 'constructionn-pro' ),
							'choices' => constructionn_pro_get_posts( 'case-study' ),
						),
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __( 'Casestudies', 'constructionn-pro' ),
						'field' => 'title',
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_abtpg_casestudies' );
