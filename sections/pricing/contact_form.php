<?php
/**
 *  Pricing Template, Contact Form Section
 *
 *  @package constructionn-pro
 */
$contpg_email_title     = get_theme_mod( 'pricingpg_email_title', __( 'EMAIL', 'constructionn-pro' ) );
$contpg_email_desc      = get_theme_mod( 'pricingpg_email_desc', __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in ero.', 'constructionn-pro' ) );
$contpg_email           = get_theme_mod( 'pricingpg_email', __( 'infoglconstruction.com', 'constructionn-pro' ) );
$contpg_contact_title   = get_theme_mod( 'pricingpg_contact_title', __( 'PHONE', 'constructionn-pro' ) );
$contpg_contact_desc    = get_theme_mod( 'pricingpg_contact_desc', __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in ero.', 'constructionn-pro' ) );
$contpg_contact_num     = get_theme_mod( 'pricingpg_contact_num', __( '+1-800-111-2222', 'constructionn-pro' ) );
$contpg_location_title  = get_theme_mod( 'pricingpg_location_title', __( 'LOCATION', 'constructionn-pro' ) );
$contpg_location_desc   = get_theme_mod( 'pricingpg_location_desc', __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in ero.', 'constructionn-pro' ) );
$contpg_location        = get_theme_mod( 'pricingpg_location', __( 'Hamburg,Germany', 'constructionn-pro' ) );
$contact_form_shortcode = get_theme_mod( 'pricingpg_contact_form_shortcode' );

constructionn_pro_contpage_contact_section(
	'pricingpage-contact',
	$contpg_email_title,
	$contpg_email_desc,
	$contpg_email,
	$contpg_contact_title,
	$contpg_contact_desc,
	$contpg_contact_num,
	$contpg_location_title,
	$contpg_location_desc,
	$contpg_location,
	$contact_form_shortcode
);
