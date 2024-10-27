<?php
/**
 * Pricingpage FAQ Section
 *
 * @package constructionn-pro
 */
$pricingpg_faq_headings = get_theme_mod( 'pricingpg_faq_headings', __( 'We provide solution to every queries!', 'constructionn-pro' ) );
$pricingpg_faq_repeater = get_theme_mod( 'pricingpg_faq_repeater', array() );

constructionn_pro_faq_section(
	'pricingpg-faq',
	$pricingpg_faq_headings,
	$pricingpg_faq_repeater
);
