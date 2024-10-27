<?php
/**
 * Front About Section
 *
 * @package constructionn-pro
 */
$about_subheading      = get_theme_mod( 'about_subheading', __( 'Who we are', 'constructionn-pro' ) );
$about_headings        = get_theme_mod( 'about_headings', __( 'Start your journey with professionals', 'constructionn-pro' ) );
$about_descriptions    = get_theme_mod( 'about_descriptions', __( 'We are a long-established, independent building services and home improvements company. We have a wealth of experience working as main building contractors on all kinds of projects, big and small, from home maintenance.', 'constructionn-pro' ) );
$notice_headings       = get_theme_mod( 'notice_headings', __( 'Get close to more than 150 expert professionals', 'constructionn-pro' ) );
$notice_descriptions   = get_theme_mod( 'notice_descriptions', __( 'Receive the greatest results from us.', 'constructionn-pro' ) );
$about_btn_txt         = get_theme_mod( 'about_btn_txt', __( 'Know More', 'constructionn-pro' ) );
$about_btn_link        = get_theme_mod( 'about_btn_link', '#' );
$front_about_repeaters = get_theme_mod(
	'front_about_repeaters',
	array(
		array(
			'text'        => esc_html__( 'Best in business', 'constructionn-pro' ),
			'description' => esc_html__( 'We have been providing you the top services and also been convenient supplier.', 'constructionn-pro' ),
		),

		array(
			'text'        => esc_html__( '24/7 Support', 'constructionn-pro' ),
			'description' => esc_html__( 'We have been providing you the top services and also been convenient supplier.', 'constructionn-pro' ),
		),
	),
);
$about_image_one = get_theme_mod( 'about_image_one', esc_url( get_template_directory_uri() . '/assets/images/Image-placeholder-1.jpg' ) );
$about_image_two = get_theme_mod( 'about_image_two', esc_url( get_template_directory_uri() . '/assets/images/Image-placeholder-2.jpg' ) );

// Pass all the keys in correct order.
constructionn_pro_get_about_section(
	'front-about',  // unique section name
	$about_subheading, // subheading text
	$about_headings, // headings text
	$about_descriptions, // descriptions text
	$notice_headings, // notices text
	$notice_descriptions, // notices description
	$about_btn_txt, // btn text
	$about_btn_link, // btn link
	$front_about_repeaters,  // frontabout repeater
	$about_image_one, // image one
	$about_image_two     // image two
);
