<?php
if ( ! function_exists( 'constructionn_customize_register_projectsort' ) ) :
	/**
	 * Case Stuides Template Sortable function
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_projectsort( $wp_customize ) {
		$wp_customize->add_section(
			'sort_projectpg',
			array(
				'title'    => __( 'Sort Sections', 'constructionn' ),
				'priority' => 40,
				'panel'    => 'project_page_settings',
			)
		);
		$wp_customize->add_setting(
			'sort_project_sections',
			array(
				'default'           => 'project,service,workingstep,team',
				'sanitize_callback' => 'constructionn_sortable_sanitization',
			)
		);
		$wp_customize->add_control(
			new GL_Sortable_Control(
				$wp_customize,
				'sort_project_sections',
				array(
					'label'       => __( 'Sort History Page', 'constructionn' ),
					'section'     => 'sort_projectpg',
					'input_attrs' => array(
						'sortable'  => true,
						'fullwidth' => true,
					),
					'choices'     => array(
						'project'     => __( 'Project', 'constructionn' ),
						'service'     => __( 'Service', 'constructionn' ),
						'workingstep' => __( 'Working Step', 'constructionn' ),
						'team'        => __( 'Team', 'constructionn' ),

					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_projectsort' );
