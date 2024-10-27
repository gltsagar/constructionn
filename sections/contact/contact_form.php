<?php
/**
 *  Contact Template, Contact Form Section
 *
 *  @package constructionn
 */
$contpg_email_title     = get_theme_mod( 'contpg_email_title', __( 'EMAIL', 'constructionn' ) );
$contpg_email_desc      = get_theme_mod( 'contpg_email_desc', __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in ero.', 'constructionn' ) );
$contpg_email           = get_theme_mod( 'contpg_email', __( 'infoglconstruction.com', 'constructionn' ) );
$contpg_contact_title   = get_theme_mod( 'contpg_contact_title', __( 'PHONE', 'constructionn' ) );
$contpg_contact_desc    = get_theme_mod( 'contpg_contact_desc', __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in ero.', 'constructionn' ) );
$contpg_contact_num     = get_theme_mod( 'contpg_contact_num', __( '+1-800-111-2222', 'constructionn' ) );
$contpg_location_title  = get_theme_mod( 'contpg_location_title', __( 'LOCATION', 'constructionn' ) );
$contpg_location_desc   = get_theme_mod( 'contpg_location_desc', __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in ero.', 'constructionn' ) );
$contpg_location        = get_theme_mod( 'contpg_location', __( 'Hamburg,Germany', 'constructionn' ) );
$contact_form_shortcode = get_theme_mod( 'contpg_cont_form_shortcode' );

constructionn_contpage_contact_section(
	'contactpage-contact',
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
