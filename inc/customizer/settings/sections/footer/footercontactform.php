<?php

if ( ! function_exists( 'constructionn_pro_customize_register_footer_contactform' ) ) :
	/**
	 * Footer Panel's Contactform Section
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_footer_contactform( $wp_customize ) {

		/** Contactform Section */
		$wp_customize->add_section(
			'footer_contactform_section',
			array(
				'title'    => __( 'Contact Form Section', 'constructionn-pro' ),
				'priority' => 10,
				'panel'    => 'footer_settings',
			)
		);

		// Add the toggle control to the section
		$wp_customize->add_setting(
			'toggle_footer_contactform',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_pro_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'toggle_footer_contactform',
				array(
					'label'       => __( 'Show/Hide Form Section', 'constructionn-pro' ),
					'description' => __( 'Enable to show contact form section', 'constructionn-pro' ),
					'section'     => 'footer_contactform_section',
					'type'        => 'checkbox',
				)
			)
		);

		// Add setting for Footer contactform shortcode
		$wp_customize->add_setting(
			'footer_contactform_shortcode',
			array(
				'default'           => '',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		// Add Control for Footer contactform shortcode
		$wp_customize->add_control(
			'footer_contactform_shortcode',
			array(
				'label'           => __( 'Enter Shortcode', 'constructionn-pro' ),
				'section'         => 'footer_contactform_section',
				'type'            => 'textarea',
				'active_callback' => 'constructionn_pro_footer_newsletter_active_callback',
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_footer_contactform' );

function constructionn_pro_footer_newsletter_active_callback( $control ) {

	$toggle_footer_contact_form = $control->manager->get_setting( 'toggle_footer_contactform' )->value();

	$id = $control->id;

	if ( $id == 'footer_contactform_shortcode' && $toggle_footer_contact_form ) {
		return true;
	}

	return false;
}
