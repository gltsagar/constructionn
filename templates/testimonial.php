<?php
/**
 * Template Name: Testimonial
 *
 * @package Constructionn_Pro
 */
get_header();

$sort_testimonial_sections = get_theme_mod( 'sort_testimonial_sections', 'testimonial,contact,faq' );
$testimonial_sections      = constructionn_pro_string_to_array( $sort_testimonial_sections );

echo '<div class="inner-page testimonial-page">';
foreach ( $testimonial_sections as $section ) {
	get_template_part( 'sections/testimonial/' . $section );
}
echo '</div>';

get_footer();
