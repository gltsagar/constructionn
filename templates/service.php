<?php
/**
 * Template Name: Service Page
 *
 * @package Constructionn_Pro
 */
get_header();

$sort_service_sections = get_theme_mod( 'sort_service_sections', 'service-post,team,project' );
$service_sections      = constructionn_pro_string_to_array( $sort_service_sections );

echo '<div class="inner-page history-page">';
foreach ( $service_sections as $section ) {
	get_template_part( 'sections/service/' . $section );
}
echo '</div>';

get_footer();
