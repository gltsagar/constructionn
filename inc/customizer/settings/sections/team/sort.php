<?php
if ( ! function_exists( 'constructionn_customize_register_teamsort' ) ) :
	/**
	 * Team Template Sortable function
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_teamsort( $wp_customize ) {
		$wp_customize->add_section(
			'sort_teampg',
			array(
				'title'    => esc_html__( 'Sort Sections', 'constructionn' ),
				'priority' => 200,
				'panel'    => 'team_page_settings',
			)
		);
		$wp_customize->add_setting(
			'sort_team_sections',
			array(
				'default'           => 'team,service,cta,counter',
				'sanitize_callback' => 'constructionn_sortable_sanitization',
			)
		);
		$wp_customize->add_control(
			new GL_Sortable_Control(
				$wp_customize,
				'sort_team_sections',
				array(
					'label'       => __( 'Sort Team Page', 'constructionn' ),
					'section'     => 'sort_teampg',
					'input_attrs' => array(
						'sortable'  => true,
						'fullwidth' => true,
					),
					'choices'     => array(
						'service' => __( 'Service', 'constructionn' ),
						'team'    => __( 'Teams', 'constructionn' ),
						'cta'     => __( 'CTA', 'constructionn' ),
						'counter' => __( 'Counter', 'constructionn' ),
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_teamsort' );
