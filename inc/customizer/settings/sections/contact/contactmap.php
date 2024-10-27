<?php

if ( ! function_exists( 'constructionn_pro_customize_register_contactmap' ) ) :
	/**
	 * ContactPage Map Section
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_contactmap( $wp_customize ) {
		$wp_customize->add_section(
			'contact_map_section',
			array(
				'title'    => esc_html__( 'Map Section', 'constructionn-pro' ),
				'priority' => 20,
				'panel'    => 'contact_page_settings',
			)
		);

		// Google map iframe
		$wp_customize->add_setting(
			'contact_map_iframe',
			array(
				'default'           => '',
				'sanitize_callback' => 'constructionn_pro_sanitize_code',
			)
		);

		$wp_customize->add_control(
			'contact_map_iframe',
			array(
				'label'   => esc_html__( 'Google Map Iframe', 'constructionn-pro' ),
				'section' => 'contact_map_section',
				'type'    => 'textarea',
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_contactmap' );
