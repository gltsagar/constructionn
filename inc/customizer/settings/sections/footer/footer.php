<?php

if ( ! function_exists( 'constructionn_customize_register_footer' ) ) {
	/**
	 * Footer Copyright settings cutomizers section
	 */
	function constructionn_customize_register_footer( $wp_customize ) {

		$wp_customize->add_section(
			'footer_section',
			array(
				'title'    => esc_html__( 'Copyright Section', 'constructionn' ),
				'priority' => 20,
				'panel'    => 'footer_settings',
			)
		);

		// Add the toggle control to the section
		$wp_customize->add_setting(
			'toggle_footer_copyright',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'toggle_footer_copyright',
				array(
					'label'       => esc_html__( 'Enable Copyright Section', 'constructionn' ),
					'description' => esc_html__( 'Enable to show copyright section', 'constructionn' ),
					'section'     => 'footer_section',
					'type'        => 'checkbox',
				)
			)
		);

		// Add settings for Copyright settings
		$wp_customize->add_setting(
			'footer_copyright_setting',
			array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_textarea_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'footer_copyright_setting',
			array(
				'selector'        => '.site-info.footer',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'footer_copyright_setting' ) );
				},
			)
		);

		// Add Control for Copyright control
		$wp_customize->add_control(
			'footer_copyright_setting',
			array(
				'label'           => esc_html__( 'Footer Copyright Text', 'constructionn' ),
				'description'     => esc_html__( 'Write your copyright text here.', 'constructionn' ),
				'section'         => 'footer_section',
				'type'            => 'textarea',
				'active_callback' => 'constructionn_footer_copyright_active_callback',
			)
		);

		// Add the toggle control for author link in the footer
		$wp_customize->add_setting(
			'toggle_author_link',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'toggle_author_link',
				array(
					'label'           => esc_html__( 'Show Author Link', 'constructionn' ),
					'section'         => 'footer_section',
					'type'            => 'checkbox',
					'active_callback' => 'constructionn_footer_copyright_active_callback',
				)
			)
		);

		$wp_customize->add_setting(
			'toggle_wp_link',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'toggle_wp_link',
				array(
					'label'           => esc_html__( 'Show WordPrerss Link', 'constructionn' ),
					'section'         => 'footer_section',
					'type'            => 'checkbox',
					'active_callback' => 'constructionn_footer_copyright_active_callback',
				)
			)
		);
	}
}
add_action( 'customize_register', 'constructionn_customize_register_footer' );

function constructionn_footer_copyright_active_callback( $control ) {

	$toggle_footer_copyright = $control->manager->get_setting( 'toggle_footer_copyright' )->value();

	$id = $control->id;

	if ( $id == 'footer_copyright_setting' && $toggle_footer_copyright ) {
		return true;
	}
	if ( $id == 'toggle_wp_link' && $toggle_footer_copyright ) {
		return true;
	}
	if ( $id == 'toggle_author_link' && $toggle_footer_copyright ) {
		return true;
	}

	return false;
}
