<?php
if ( ! function_exists( 'constructionn_customize_register_aboutsort' ) ) :
		/**
		 * About us Sortable function
		 *
		 * @param [type] $wp_customize
		 * @return void
		 */
	function constructionn_customize_register_aboutsort( $wp_customize ) {
		$wp_customize->add_section(
			'sort_aboutpg',
			array(
				'title'    => esc_html__( 'Sort Sections', 'constructionn' ),
				'priority' => 110,
				'panel'    => 'about_page_settings',
			)
		);

		$wp_customize->add_setting(
			'sort_about_sections',
			array(
				'default'           => 'about,case-study',
				'cta',
				'counter',
				'team',
				'project',
				'workingstep',
				'sanitize_callback' => 'constructionn_sortable_sanitization',
			)
		);

		$wp_customize->add_control(
			new GL_Sortable_Control(
				$wp_customize,
				'sort_about_sections',
				array(
					'label'       => __( 'Sort About Page', 'constructionn' ),
					'section'     => 'sort_aboutpg',
					'input_attrs' => array(
						'sortable'  => true,
						'fullwidth' => true,
					),
					'choices'     => array(
						'about'       => __( 'About Us', 'constructionn' ),
						'case-study'  => __( 'Case Study', 'constructionn' ),
						'cta'         => __( 'Cta', 'constructionn' ),
						'counter'     => __( 'Counter', 'constructionn' ),
						'team'        => __( 'Team', 'constructionn' ),
						'project'     => __( 'Project', 'constructionn' ),
						'workingstep' => __( 'Workingstep', 'constructionn' ),

					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_aboutsort' );
