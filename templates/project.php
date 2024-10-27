<?php
/**
 * Template Name: Project Page
 *
 * @package Constructionn_Pro
 */
get_header();

$sort_project_sections = get_theme_mod( 'sort_project_sections', 'project,service,workingstep,team' );
$project_sections      = constructionn_pro_string_to_array( $sort_project_sections );

foreach ( $project_sections as $section ) {
	get_template_part( 'sections/project/' . $section );
}

get_footer();
