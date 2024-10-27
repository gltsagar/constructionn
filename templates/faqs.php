<?php
/**
 * Template Name: FAQS Page
 *
 * @package Constructionn_Pro
 */
get_header();

$sort_faq_sections = get_theme_mod( 'sort_faq_sections', 'faq,contact,partner' );
$faq_sections      = constructionn_pro_string_to_array( $sort_faq_sections );

echo '<div class="inner-page pricing-page">';
foreach ( $faq_sections as $section ) {
	get_template_part( 'sections/faq/' . $section );
}
echo '</div>';

get_footer();
