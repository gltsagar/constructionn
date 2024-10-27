<?php
if ( ! function_exists( 'constructionn_pro_customize_register_casestudysort' ) ) :
	/**
	 * Case Stuides Template Sortable function
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_casestudysort( $wp_customize ) {
		$wp_customize->add_section(
			'sort_casestudypg',
			array(
				'title'    => esc_html__( 'Sort Sections', 'constructionn-pro' ),
				'priority' => 40,
				'panel'    => 'casestudies_page_settings',
			)
		);
		$wp_customize->add_setting(
			'sort_casestudy_sections',
			array(
				'default'           => 'case-study,team,contact',
				'sanitize_callback' => 'constructionn_pro_sortable_sanitization',
			)
		);
		$wp_customize->add_control(
			new GL_Sortable_Control(
				$wp_customize,
				'sort_casestudy_sections',
				array(
					'label'       => __( 'Sort Case Study Page', 'constructionn-pro' ),
					'section'     => 'sort_casestudypg',
					'input_attrs' => array(
						'sortable'  => true,
						'fullwidth' => true,
					),
					'choices'     => array(
						'case-study' => __( 'Case Study', 'constructionn-pro' ),
						'team'       => __( 'Team', 'constructionn-pro' ),
						'contact'    => __( 'Contact', 'constructionn-pro' ),
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_casestudysort' );
