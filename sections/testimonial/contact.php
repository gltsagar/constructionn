<?php
/**
 * Testimonial Page, Contact Section
 *
 * @package constructionn-pro
 */
$testimon_cont_headings       = get_theme_mod( 'testimonpg_contact_headings', __( 'Let’s get started to make your next appointment.', 'constructionn-pro' ) );
$testimon_cont_desc           = get_theme_mod( 'testimonpg_contact_descs', __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'constructionn-pro' ) );
$testimon_cont_form_shortcode = get_theme_mod( 'testimonpg_contform_shortcode' );

constructionn_pro_contact_section(
	'testimonialpage-contact',
	$testimon_cont_headings,
	$testimon_cont_desc,
	$testimon_cont_form_shortcode,
);
