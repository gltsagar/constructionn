<?php

/**
 * constructionn_pro Theme Customizer
 *
 * @package Constructionn_Pro
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

/**
 * Customizer Whole Control.
 */
require get_template_directory() . '/inc/customizer/customizer-controls/customizer-controls.php';

/**
 * Customizer Settings Enqueue.
 */
require get_template_directory() . '/inc/customizer/settings/customizer-settings.php';

/**
 * Sanitization functions
 */
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

function constructionn_pro_customize_register( $wp_customize ) {

	$wp_customize->remove_section( 'background_image' );

	$wp_customize->get_section( 'colors' )->panel = 'appearance_settings';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->get_section( 'title_tagline' )->panel = 'appearance_settings';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'constructionn_pro_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'constructionn_pro_customize_partial_blogdescription',
			)
		);
	}

	// Logo width
	$wp_customize->add_setting(
		'lfp_logo_width',
		array(
			'default'           => 150,
			'sanitize_callback' => 'constructionn_pro_sanitize_empty_absint',
		)
	);

	$wp_customize->add_control(
		new GL_Slider_Control(
			$wp_customize,
			'lfp_logo_width',
			array(
				'label'       => __( 'Logo Width', 'constructionn-pro' ),
				'description' => __( 'Set the width(px) of your Site Logo.', 'constructionn-pro' ),
				'section'     => 'title_tagline',
				'choices'     => array(
					'min'  => 10,
					'step' => 1,
					'max'  => 400,
				),
			)
		)
	);
}
add_action( 'customize_register', 'constructionn_pro_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function constructionn_pro_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function constructionn_pro_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function constructionn_pro_customize_preview_js() {
	wp_enqueue_script( 'constructionn_pro-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), CONSTRUCTIONN_PRO_VERSION, true );
}
add_action( 'customize_preview_init', 'constructionn_pro_customize_preview_js' );

function constructionn_pro_control_inline_scripts() {

	wp_enqueue_script( 'constructionn-pro-customize', get_template_directory_uri() . '/js/unminify/customize.js', array( 'jquery', 'customize-controls' ), CONSTRUCTIONN_PRO_VERSION, true );

	wp_localize_script(
		'constructionn-pro-typography-customizer',
		'constructionn_pro_customize',
		array(
			'nonce' => wp_create_nonce( 'constructionn_pro_customize_nonce' ),
		)
	);

	wp_localize_script(
		'constructionn-pro-typography-customizer',
		'ConstructionProTypography',
		array(
			'googleFonts' => apply_filters( 'constructionn_pro_typography_customize_list', constructionn_pro_get_all_google_fonts() ),
		)
	);

	wp_localize_script( 'constructionn-pro-typography-customizer', 'typography_defaults', constructionn_pro_typography_default_fonts() );
}
add_action( 'customize_controls_enqueue_scripts', 'constructionn_pro_control_inline_scripts', 100 );
