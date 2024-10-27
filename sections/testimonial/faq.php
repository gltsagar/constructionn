<?php
/**
 * Testimonialpage FAQ Section
 *
 * @package constructionn-pro
 */

$testmonpg_faq_headings  = get_theme_mod( 'testimonpg_faq_headings', __( 'We provide solution to every queries!', 'constructionn-pro' ) );
$testmonpg__faq_repeater = get_theme_mod( 'testimonpg_faq_repeater', array() );

constructionn_pro_faq_section(
	'testimonialpg-faq',
	$testmonpg_faq_headings,
	$testmonpg__faq_repeater
);
