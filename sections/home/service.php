<?php
/**
 * Front Service Section
 *
 * @package constructionn-pro
 */
$service_headings    = get_theme_mod( 'service_headings', __( 'Have any projects ?', 'constructionn-pro' ) );
$service_btn_txt     = get_theme_mod( 'service_btn_txt', __( 'View More', 'constructionn-pro' ) );
$front_serv_repeater = get_theme_mod( 'front_services_repeater', array() );
$service_image       = get_theme_mod( 'service_image', esc_url( get_template_directory_uri() . '/assets/images/Image-placeholder-3.jpg' ) );

constructionn_pro_service_section(
	'front-service',
	$service_headings,
	$service_btn_txt,
	$service_image,
	$front_serv_repeater
);
