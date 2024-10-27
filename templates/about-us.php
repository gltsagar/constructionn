<?php
/**
 * Template Name: About Us
 *
 * @package Constructionn_Pro
 */
get_header();

$sort_about_sections = get_theme_mod( 'sort_about_sections', 'about,counter,history,service,case-study' );
$about_sections      = constructionn_pro_string_to_array( $sort_about_sections );

foreach ( $about_sections as $section ) {
	get_template_part( 'sections/about/' . $section );
}

get_footer();
