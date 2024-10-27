<?php
/**
 * Front FAQ Section
 *
 * @package constructionn-pro
 */

$faq_headings       = get_theme_mod( 'faq_heading_settings', __( 'We provide solution to every queries!', 'constructionn-pro' ) );
$front_faq_repeater = get_theme_mod( 'front_faq_repeater', array() );

constructionn_pro_faq_section(
	'front-faq',
	$faq_headings,
	$front_faq_repeater
);
