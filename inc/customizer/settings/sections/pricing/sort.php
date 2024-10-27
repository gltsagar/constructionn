<?php
if ( ! function_exists( 'constructionn_pro_customize_register_pricingsort' ) ) :
	/**
	 * Pricing Template Sortable function
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_pricingsort( $wp_customize ) {
		$wp_customize->add_section(
			'sort_pricingpg',
			array(
				'title'    => esc_html__( 'Sort Sections', 'constructionn-pro' ),
				'priority' => 200,
				'panel'    => 'pricing_page_settings',
			)
		);
		$wp_customize->add_setting(
			'sort_pricing_sections',
			array(
				'default'           => 'pricing,faq,contact_form',
				'sanitize_callback' => 'constructionn_pro_sortable_sanitization',
			)
		);
		$wp_customize->add_control(
			new GL_Sortable_Control(
				$wp_customize,
				'sort_pricing_sections',
				array(
					'label'       => __( 'Sort Pricing Page', 'constructionn-pro' ),
					'section'     => 'sort_pricingpg',
					'input_attrs' => array(
						'sortable'  => true,
						'fullwidth' => true,
					),
					'choices'     => array(
						'pricing'      => __( 'Pricing & Plans', 'constructionn-pro' ),
						'faq'          => __( 'FAQ', 'constructionn-pro' ),
						'contact_form' => __( 'Contact', 'constructionn-pro' ),
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_pricingsort' );
