<?php
if ( ! function_exists( 'constructionn_customize_register_faqsort' ) ) :
	/**
	 * FAQ Template Sortable function
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_faqsort( $wp_customize ) {
		$wp_customize->add_section(
			'sort_faqpg',
			array(
				'title'    => esc_html__( 'Sort Sections', 'constructionn' ),
				'priority' => 200,
				'panel'    => 'faq_page_settings',
			)
		);
		$wp_customize->add_setting(
			'sort_faq_sections',
			array(
				'default'           => 'faq,contact,partner',
				'sanitize_callback' => 'constructionn_sortable_sanitization',
			)
		);
		$wp_customize->add_control(
			new GL_Sortable_Control(
				$wp_customize,
				'sort_faq_sections',
				array(
					'label'       => __( 'Sort FAQ Page', 'constructionn' ),
					'section'     => 'sort_faqpg',
					'input_attrs' => array(
						'sortable'  => true,
						'fullwidth' => true,
					),
					'choices'     => array(
						'faq'     => __( 'FAQ', 'constructionn' ),
						'contact' => __( 'Contact', 'constructionn' ),
						'partner' => __( 'Partner', 'constructionn' ),
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_faqsort' );
