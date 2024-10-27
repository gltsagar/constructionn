<?php
/**
 * Faq Page, Partner Section
 *
 * @package constructionn-pro
 */
$faqpg_partner_repeater = get_theme_mod( 'faqpg_partner_slider_custom', array() );

constructionn_pro_partners_section(
	'faqpage-partner',
	$faqpg_partner_repeater
);
