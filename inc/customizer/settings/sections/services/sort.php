<?php
if ( ! function_exists( 'constructionn_customize_register_servicesort' ) ) :
	/**
	 * Service Template Sortable function
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_servicesort( $wp_customize ) {
		$wp_customize->add_section(
			'sort_servicepg',
			array(
				'title'    => esc_html__( 'Sort Sections', 'constructionn' ),
				'priority' => 200,
				'panel'    => 'Service_page_settings',
			)
		);
		$wp_customize->add_setting(
			'sort_service_sections',
			array(
				'default'           => 'service-post,team,project',
				'sanitize_callback' => 'constructionn_sortable_sanitization',
			)
		);
		$wp_customize->add_control(
			new GL_Sortable_Control(
				$wp_customize,
				'sort_service_sections',
				array(
					'label'       => __( 'Sort Service Page', 'constructionn' ),
					'section'     => 'sort_servicepg',
					'input_attrs' => array(
						'sortable'  => true,
						'fullwidth' => true,
					),
					'choices'     => array(
						'service-post' => __( 'Service', 'constructionn' ),
						'team'         => __( 'Team', 'constructionn' ),
						'project'      => __( 'Project', 'constructionn' ),

					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_servicesort' );
