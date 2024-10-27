<?php
/**
 * Project Template Service Section
 *
 * @package constructionn-pro
 */
$service_headings    = get_theme_mod( 'projpg_service_headings', __( 'Have any projects ?', 'constructionn-pro' ) );
$service_btn_txt     = get_theme_mod( 'projpg_btn_txt', __( 'View More', 'constructionn-pro' ) );
$front_serv_repeater = get_theme_mod( 'projpg_services_repeater', array() );
$service_image       = get_theme_mod( 'projpg_service_image', esc_url( get_template_directory_uri() . '/assets/images/Image-placeholder-3.jpg' ) );

constructionn_pro_service_section(
	'projetpg-service',
	$service_headings,
	$service_btn_txt,
	$service_image,
	$front_serv_repeater
);