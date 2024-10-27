<?php

if ( ! function_exists( 'constructionn_pro_customize_register_socialmedia' ) ) :
	/**
	 * Headers Socialmedia
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_socialmedia( $wp_customize ) {
		// Create a new section top bar settings----------
		$wp_customize->add_section(
			'social_media_section',
			array(
				'title'    => __( 'Social Media Settings', 'constructionn-pro' ),
				'priority' => 20,
				'panel'    => 'general_settings_panel',
			)
		);

		// Add the toggle control to the section
		$wp_customize->add_setting(
			'socialmedia_toggle',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_pro_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'socialmedia_toggle',
				array(
					'label'       => __( 'Show/Hide Social Media', 'constructionn-pro' ),
					'description' => __( 'Enable to show the social media.', 'constructionn-pro' ),
					'section'     => 'social_media_section',
					'type'        => 'checkbox',
				)
			)
		);

		$wp_customize->add_setting(
			'socialmedia_heading',
			array(
				'default'           => __( 'Follow Us On:', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'socialmedia_heading',
			array(
				'selector'        => '.front-contact span.label',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'socialmedia_heading', __( 'Follow Us On:', 'constructionn-pro' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'socialmedia_heading',
			array(
				'label'           => __( 'Heading', 'constructionn-pro' ),
				'section'         => 'social_media_section',
				'type'            => 'text',
				'active_callback' => 'constructionn_pro_social_media_active_callback',
			)
		);

		/** Repeater Custom For social media Section */
		$wp_customize->add_setting(
			new Constructionn_Pro_Repeater_Setting(
				$wp_customize,
				'socials_media_repeater',
				array(
					'default'           =>
					array(
						array(
							'md_pro_icon'     => __( 'facebook', 'constructionn-pro' ),
							'md_pro_link'     => esc_url( 'https://www.facebook.com/' ),
							'md_pro_checkbox' => '1',
						),
						array(
							'md_pro_icon'     => __( 'linkedin', 'constructionn-pro' ),
							'md_pro_link'     => esc_url( 'https://linkedin.com/' ),
							'md_pro_checkbox' => '1',
						),
						array(
							'md_pro_icon'     => __( 'instagram', 'constructionn-pro' ),
							'md_pro_link'     => esc_url( 'https://www.instagram.com/' ),
							'md_pro_checkbox' => '1',
						),
						array(
							'md_pro_icon'     => __( 'pinterest', 'constructionn-pro' ),
							'md_pro_link'     => esc_url( 'https://www.pinterest.com/' ),
							'md_pro_checkbox' => '1',
						),
					),
					'sanitize_callback' => array( 'Constructionn_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Pro_Control_Repeater(
				$wp_customize,
				'socials_media_repeater',
				array(
					'section'         => 'social_media_section',
					'label'           => __( 'Social Links', 'constructionn-pro' ),
					'fields'          => array(
						'md_pro_icon'     => array(
							'type'    => 'select',
							'label'   => __( 'Social Media', 'constructionn-pro' ),
							'choices' => constructionn_pro_get_svg_icons(),
						),

						'md_pro_link'     => array(
							'type'        => 'url',
							'label'       => __( 'Link', 'constructionn-pro' ),
							'description' => __( 'Example: https://facebook.com', 'constructionn-pro' ),
						),
						'md_pro_checkbox' => array(
							'type'  => 'checkbox',
							'label' => __( 'Open link in new tab', 'constructionn-pro' ),
						),
					),
					'row_label'       => array(
						'type'  => 'field',
						'value' => __( 'links', 'constructionn-pro' ),
						'field' => 'link',
					),
					'active_callback' => 'constructionn_pro_social_media_active_callback',
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_socialmedia' );

function constructionn_pro_social_media_active_callback( $control ) {

	$toggle_social_media = $control->manager->get_setting( 'socialmedia_toggle' )->value();

	$id = $control->id;

	if ( $id == 'socials_media_repeater' && $toggle_social_media ) {
		return true;
	}
	if ( $id == 'socialmedia_heading' && $toggle_social_media ) {
		return true;
	}

	return false;
}
