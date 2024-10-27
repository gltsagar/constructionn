<?php
/**
 * Team Template, CTA Section
 *
 * @package constructionn-pro
 */
$bg_img        = get_theme_mod( 'teampg_cta_bg_img', esc_url( get_template_directory_uri() . '/assets/images/banner-1.jpg' ) );
$f_cta_heading = get_theme_mod( 'teampg_cta_heading', __( 'Have any projects ?', 'constructionn-pro' ) );
$f_cta_descs   = get_theme_mod( 'teampg_cta_descs', __( 'Do not hesitate to contact us and get the best outcomes from our professionals.', 'constructionn-pro' ) );
$contact_num   = get_theme_mod( 'teampg_contact_number', __( '+1-202-555-0133', 'constructionn-pro' ) );

constructionn_pro_cta_section(
	'teampg-cta',
	$bg_img,
	$f_cta_heading,
	$f_cta_descs,
	$contact_num
);
