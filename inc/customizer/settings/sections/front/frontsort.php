<?php

if ( ! function_exists( 'constructionn_customize_register_frontsort' ) ) :
	/**
	 * Frontsort
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_frontsort( $wp_customize ) {

		$wp_customize->add_section(
			'sort_sections',
			array(
				'title'    => __( 'Sort Sections', 'constructionn' ),
				'priority' => 180,
				'panel'    => 'frontpage_settings_panel',
			)
		);
		$wp_customize->add_setting(
			'sort_front_sections',
			array(
				'default'           => 'banner,about,cta,service,project,testimonial,case-studies,counter,workingstep,team,contact,faq,blog,partner',
				'sanitize_callback' => 'constructionn_sortable_sanitization',
			)
		);
		$wp_customize->add_control(
			new GL_Sortable_Control(
				$wp_customize,
				'sort_front_sections',
				array(
					'label'       => __( 'Sort Frontpage', 'constructionn' ),
					'section'     => 'sort_sections',
					'input_attrs' => array(
						'sortable'  => true,
						'fullwidth' => true,
					),
					'choices'     => array(
						'banner'       => __( 'Banner', 'constructionn' ),
						'about'        => __( 'About Us', 'constructionn' ),
						'cta'          => __( 'CTA', 'constructionn' ),
						'service'      => __( 'Service', 'constructionn' ),
						'project'      => __( 'Project', 'constructionn' ),
						'testimonial'  => __( 'Testimonial', 'constructionn' ),
						'case-studies' => __( 'Case Studies', 'constructionn' ),
						'team'         => __( 'Team', 'constructionn' ),
						'contact'      => __( 'Contact', 'constructionn' ),
						'faq'          => __( 'FAQ', 'constructionn' ),
						'blog'         => __( 'Blog', 'constructionn' ),
						'partner'      => __( 'Partner', 'constructionn' ),
						'counter'      => __( 'Counter', 'constructionn' ),
						'workingstep'  => __( 'Workingstep', 'constructionn' ),

					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_frontsort' );
