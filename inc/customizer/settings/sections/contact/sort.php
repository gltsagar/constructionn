<?php
if ( ! function_exists( 'constructionn_customize_register_contactsort' ) ) :
		/**
		 * Contact us Sortable function
		 *
		 * @param [type] $wp_customize
		 * @return void
		 */
	function constructionn_customize_register_contactsort( $wp_customize ) {
		$wp_customize->add_section(
			'sort_contactpg',
			array(
				'title'    => esc_html__( 'Sort Sections', 'constructionn' ),
				'priority' => 200,
				'panel'    => 'contact_page_settings',
			)
		);
		$wp_customize->add_setting(
			'sort_contact_sections',
			array(
				'default'           => 'contact_form,contact_map,contact_partner',
				'sanitize_callback' => 'constructionn_sortable_sanitization',
			)
		);
		$wp_customize->add_control(
			new GL_Sortable_Control(
				$wp_customize,
				'sort_contact_sections',
				array(
					'label'       => __( 'Sort Contact Page', 'constructionn' ),
					'section'     => 'sort_contactpg',
					'input_attrs' => array(
						'sortable'  => true,
						'fullwidth' => true,
					),
					'choices'     => array(
						'contact_form'    => __( 'Contact', 'constructionn' ),
						'contact_map'     => __( 'Map', 'constructionn' ),
						'contact_partner' => __( 'Partner', 'constructionn' ),

					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_contactsort' );
