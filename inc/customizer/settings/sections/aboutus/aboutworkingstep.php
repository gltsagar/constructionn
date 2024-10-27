<?php

if ( ! function_exists( 'constructionn_customize_register_abtpg_workingstep' ) ) :
	/**
	 * Aboutpage Working Step
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_abtpg_workingstep( $wp_customize ) {
		$wp_customize->add_section(
			'abtpg_workingstep_section',
			array(
				'title'    => esc_html__( 'Working Step Settings', 'constructionn' ),
				'priority' => 70,
				'panel'    => 'about_page_settings',
			)
		);

		// Add setting for Section Heading
		$wp_customize->add_setting(
			'abtpg_workstep_headings',
			array(
				'default'           => __( 'Our working steps', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'abtpg_workstep_headings',
			array(
				'selector'        => '.aboutpage-workingstep h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'abtpg_workstep_headings', __( 'Our working steps', 'constructionn' ) ) );
				},
			)
		);

		// Add Control for Section Heading
		$wp_customize->add_control(
			'abtpg_workstep_headings',
			array(
				'label'   => esc_html__( 'Heading', 'constructionn' ),
				'section' => 'abtpg_workingstep_section',
				'type'    => 'text',
			)
		);

		/** Dynamic workingstep Section */
		$wp_customize->add_setting(
			new Constructionn_Repeater_Setting(
				$wp_customize,
				'abtpg_workstep_repeaters',
				array(
					'default'           => array(
						array(
							'text'        => esc_html__( '> Project planning and design', 'constructionn' ),
							'description' => esc_html__( 'In this initial phase, requirements and goals are defined, and the design concept.  The project requirements and goals are defined', 'constructionn' ),
							'image'       => false,
						),

						array(
							'text'        => esc_html__( 'Detailed proposal', 'constructionn' ),
							'description' => esc_html__( 'In this initial phase, requirements and goals are defined, and the design concept.  The project requirements and goals are defined', 'constructionn' ),
							'image'       => false,
						),

						array(
							'text'        => esc_html__( 'Planning implementation', 'constructionn' ),
							'description' => esc_html__( 'In this initial phase, requirements and goals are defined, and the design concept.  The project requirements and goals are defined', 'constructionn' ),
							'image'       => false,
						),

						array(
							'text'        => esc_html__( 'Project installation process', 'constructionn' ),
							'description' => esc_html__( 'In this initial phase, requirements and goals are defined, and the design concept.  The project requirements and goals are defined', 'constructionn' ),
							'image'       => false,
						),

						array(
							'text'        => esc_html__( 'Final inspection', 'constructionn' ),
							'description' => esc_html__( 'In this initial phase, requirements and goals are defined, and the design concept.  The project requirements and goals are defined', 'constructionn' ),
							'image'       => false,
						),
					),
					'sanitize_callback' => array( 'Constructionn_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Control_Repeater(
				$wp_customize,
				'abtpg_workstep_repeaters',
				array(
					'section'   => 'abtpg_workingstep_section',
					'label'     => __( 'Add Features', 'constructionn' ),
					'fields'    => array(
						'image'       => array(
							'type'  => 'image',
							'label' => __( 'Upload Image', 'constructionn' ),
						),
						'text'        => array(
							'type'  => 'text',
							'label' => __( 'Add Title', 'constructionn' ),
						),
						'description' => array(
							'type'  => 'textarea',
							'label' => __( 'Add Description', 'constructionn' ),
						),
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __( 'Features', 'constructionn' ),
						'field' => 'title',
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_abtpg_workingstep' );
