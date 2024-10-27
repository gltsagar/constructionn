<?php
/**
 * Template Name: Case Study
 *
 * @package Constructionn_Pro
 */
get_header();

$sort_casestudy_sections = get_theme_mod( 'sort_casestudy_sections', 'case-study,team,contact' );
$casestudy_sections      = constructionn_pro_string_to_array( $sort_casestudy_sections );

echo '<div class="inner-page case__studies-page">';
foreach ( $casestudy_sections as $section ) {
	get_template_part( 'sections/case-study/' . $section );
}
echo '</div>';

get_footer();
