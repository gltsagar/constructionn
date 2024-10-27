<?php
/**
 * Template Name: Pricing Page
 *
 * @package Constructionn_Pro
 */
get_header();

$sort_pricing_sections = get_theme_mod( 'sort_pricing_sections', 'pricing,faq,contact_form' );
$pricing_sections      = constructionn_pro_string_to_array( $sort_pricing_sections );

foreach ( $pricing_sections as $section ) {
	get_template_part( 'sections/pricing/' . $section );
}
get_footer();
