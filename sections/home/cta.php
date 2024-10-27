<?php
/**
 * Front CTA Section
 *
 * @package constructionn
 */
$bg_img        = get_theme_mod( 'cta_bg_img', esc_url( get_template_directory_uri() . '/assets/images/banner-1.jpg' ) );
$f_cta_heading = get_theme_mod( 'front_cta_heading', __( 'Have any projects ?', 'constructionn' ) );
$f_cta_descs   = get_theme_mod( 'front_cta_descs', __( 'Do not hesitate to contact us and get the best outcomes from our professionals.', 'constructionn' ) );
$contact_num   = get_theme_mod( 'contact_number', __( '+1-202-555-0133', 'constructionn' ) );

constructionn_cta_section(
	'front-cta',
	$bg_img,
	$f_cta_heading,
	$f_cta_descs,
	$contact_num
);
