<?php
/**
 * Casestudy Page, Contact Section
 *
 * @package constructionn-pro
 */
$cspg_contact_headings       = get_theme_mod( 'cspg_contact_headings', __( 'Let’s get started to make your next appointment.', 'constructionn-pro' ) );
$cspg_contact_desc           = get_theme_mod( 'cspg_contact_descs', __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'constructionn-pro' ) );
$cspg_contact_form_shortcode = get_theme_mod( 'cspg_contact_form_shortcode' );

constructionn_pro_contact_section(
	'casestudypg-contact',
	$cspg_contact_headings,
	$cspg_contact_desc,
	$cspg_contact_form_shortcode,
);
