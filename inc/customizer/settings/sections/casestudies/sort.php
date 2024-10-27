<?php
if ( ! function_exists( 'constructionn_customize_register_casestudysort' ) ) :
	/**
	 * Case Stuides Template Sortable function
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_casestudysort( $wp_customize ) {
		$wp_customize->add_section(
			'sort_casestudypg',
			array(
				'title'    => esc_html__( 'Sort Sections', 'constructionn' ),
				'priority' => 40,
				'panel'    => 'casestudies_page_settings',
			)
		);
		$wp_customize->add_setting(
			'sort_casestudy_sections',
			array(
				'default'           => 'case-study,team,contact',
				'sanitize_callback' => 'constructionn_sortable_sanitization',
			)
		);
		$wp_customize->add_control(
			new GL_Sortable_Control(
				$wp_customize,
				'sort_casestudy_sections',
				array(
					'label'       => __( 'Sort Case Study Page', 'constructionn' ),
					'section'     => 'sort_casestudypg',
					'input_attrs' => array(
						'sortable'  => true,
						'fullwidth' => true,
					),
					'choices'     => array(
						'case-study' => __( 'Case Study', 'constructionn' ),
						'team'       => __( 'Team', 'constructionn' ),
						'contact'    => __( 'Contact', 'constructionn' ),
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_casestudysort' );
