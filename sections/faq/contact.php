<?php
/**
 * Faq Page, Contact Section
 *
 * @package constructionn-pro
 */
$fpg_contact_headings       = get_theme_mod( 'faqpg_contact_headings', __( 'Let’s get started to make your next appointment.', 'constructionn-pro' ) );
$fpg_contact_descs          = get_theme_mod( 'faqpg_contact_desc', __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'constructionn-pro' ) );
$fpg_contact_form_shortcode = get_theme_mod( 'faq_pg_contactform_shortcode' );

constructionn_pro_contact_section(
	'faqpg-contact',
	$fpg_contact_headings,
	$fpg_contact_descs,
	$fpg_contact_form_shortcode,
);
