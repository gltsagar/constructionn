<?php

if ( ! function_exists( 'constructionn_pro_customize_register_frontsort' ) ) :
	/**
	 * Frontsort
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_frontsort( $wp_customize ) {

		$wp_customize->add_section(
			'sort_sections',
			array(
				'title'    => __( 'Sort Sections', 'constructionn-pro' ),
				'priority' => 180,
				'panel'    => 'frontpage_settings_panel',
			)
		);
		$wp_customize->add_setting(
			'sort_front_sections',
			array(
				'default'           => 'banner,about,cta,service,project,testimonial,case-studies,counter,workingstep,team,contact,faq,blog,partner',
				'sanitize_callback' => 'constructionn_pro_sortable_sanitization',
			)
		);
		$wp_customize->add_control(
			new GL_Sortable_Control(
				$wp_customize,
				'sort_front_sections',
				array(
					'label'       => __( 'Sort Frontpage', 'constructionn-pro' ),
					'section'     => 'sort_sections',
					'input_attrs' => array(
						'sortable'  => true,
						'fullwidth' => true,
					),
					'choices'     => array(
						'banner'       => __( 'Banner', 'constructionn-pro' ),
						'about'        => __( 'About Us', 'constructionn-pro' ),
						'cta'          => __( 'CTA', 'constructionn-pro' ),
						'service'      => __( 'Service', 'constructionn-pro' ),
						'project'      => __( 'Project', 'constructionn-pro' ),
						'testimonial'  => __( 'Testimonial', 'constructionn-pro' ),
						'case-studies' => __( 'Case Studies', 'constructionn-pro' ),
						'team'         => __( 'Team', 'constructionn-pro' ),
						'contact'      => __( 'Contact', 'constructionn-pro' ),
						'faq'          => __( 'FAQ', 'constructionn-pro' ),
						'blog'         => __( 'Blog', 'constructionn-pro' ),
						'partner'      => __( 'Partner', 'constructionn-pro' ),
						'counter'      => __( 'Counter', 'constructionn-pro' ),
						'workingstep'  => __( 'Workingstep', 'constructionn-pro' ),

					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_frontsort' );
