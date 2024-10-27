<?php

if ( ! function_exists( 'constructionn_pro_customize_register_abtpg_workingstep' ) ) :
	/**
	 * Aboutpage Working Step
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_abtpg_workingstep( $wp_customize ) {
		$wp_customize->add_section(
			'abtpg_workingstep_section',
			array(
				'title'    => esc_html__( 'Working Step Settings', 'constructionn-pro' ),
				'priority' => 70,
				'panel'    => 'about_page_settings',
			)
		);

		// Add setting for Section Heading
		$wp_customize->add_setting(
			'abtpg_workstep_headings',
			array(
				'default'           => __( 'Our working steps', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'abtpg_workstep_headings',
			array(
				'selector'        => '.aboutpage-workingstep h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'abtpg_workstep_headings', __( 'Our working steps', 'constructionn-pro' ) ) );
				},
			)
		);

		// Add Control for Section Heading
		$wp_customize->add_control(
			'abtpg_workstep_headings',
			array(
				'label'   => esc_html__( 'Heading', 'constructionn-pro' ),
				'section' => 'abtpg_workingstep_section',
				'type'    => 'text',
			)
		);

		/** Dynamic workingstep Section */
		$wp_customize->add_setting(
			new Constructionn_Pro_Repeater_Setting(
				$wp_customize,
				'abtpg_workstep_repeaters',
				array(
					'default'           => array(
						array(
							'text'        => esc_html__( '> Project planning and design', 'constructionn-pro' ),
							'description' => esc_html__( 'In this initial phase, requirements and goals are defined, and the design concept.  The project requirements and goals are defined', 'constructionn-pro' ),
							'image'       => false,
						),

						array(
							'text'        => esc_html__( 'Detailed proposal', 'constructionn-pro' ),
							'description' => esc_html__( 'In this initial phase, requirements and goals are defined, and the design concept.  The project requirements and goals are defined', 'constructionn-pro' ),
							'image'       => false,
						),

						array(
							'text'        => esc_html__( 'Planning implementation', 'constructionn-pro' ),
							'description' => esc_html__( 'In this initial phase, requirements and goals are defined, and the design concept.  The project requirements and goals are defined', 'constructionn-pro' ),
							'image'       => false,
						),

						array(
							'text'        => esc_html__( 'Project installation process', 'constructionn-pro' ),
							'description' => esc_html__( 'In this initial phase, requirements and goals are defined, and the design concept.  The project requirements and goals are defined', 'constructionn-pro' ),
							'image'       => false,
						),

						array(
							'text'        => esc_html__( 'Final inspection', 'constructionn-pro' ),
							'description' => esc_html__( 'In this initial phase, requirements and goals are defined, and the design concept.  The project requirements and goals are defined', 'constructionn-pro' ),
							'image'       => false,
						),
					),
					'sanitize_callback' => array( 'Constructionn_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Pro_Control_Repeater(
				$wp_customize,
				'abtpg_workstep_repeaters',
				array(
					'section'   => 'abtpg_workingstep_section',
					'label'     => __( 'Add Features', 'constructionn-pro' ),
					'fields'    => array(
						'image'       => array(
							'type'  => 'image',
							'label' => __( 'Upload Image', 'constructionn-pro' ),
						),
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
add_action( 'customize_register', 'constructionn_pro_customize_register_abtpg_workingstep' );
