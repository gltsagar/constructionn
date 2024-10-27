<?php
/**
 * Front Contact Section
 *
 * @package constructionn
 */
$contact_headings       = get_theme_mod( 'contact_headings', __( 'Let’s get started to make your next appointment.', 'constructionn' ) );
$contact_descriptions   = get_theme_mod( 'contact_descriptions', __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'constructionn' ) );
$contact_form_shortcode = get_theme_mod( 'fcontact_form_shortcode' );

constructionn_contact_section(
	'front-contact',
	$contact_headings,
	$contact_descriptions,
	$contact_form_shortcode,
);
