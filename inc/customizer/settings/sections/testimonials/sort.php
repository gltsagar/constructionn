<?php
if ( ! function_exists( 'constructionn_pro_customize_register_testimonialsort' ) ) :
	/**
	 * Testimonial Template Sortable function
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_testimonialsort( $wp_customize ) {
		$wp_customize->add_section(
			'sort_testimonialpg',
			array(
				'title' => __( 'Sort Sections', 'constructionn-pro' ),
				'panel' => 'testimonial_page_settings',
			)
		);
		$wp_customize->add_setting(
			'sort_testimonial_sections',
			array(
				'default'           => 'testimonial,contact,faq',
				'sanitize_callback' => 'constructionn_pro_sortable_sanitization',
			)
		);
		$wp_customize->add_control(
			new GL_Sortable_Control(
				$wp_customize,
				'sort_testimonial_sections',
				array(
					'label'       => __( 'Sort Testimonial Page', 'constructionn-pro' ),
					'section'     => 'sort_testimonialpg',
					'input_attrs' => array(
						'sortable'  => true,
						'fullwidth' => true,
					),
					'choices'     => array(
						'testimonial' => __( 'Testimonial', 'constructionn-pro' ),
						'contact'     => __( 'Contact', 'constructionn-pro' ),
						'faq'         => __( 'Faq', 'constructionn-pro' ),

					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_testimonialsort' );
