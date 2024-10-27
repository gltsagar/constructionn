<?php
/**
 * Template Name: Teams Page
 *
 * @package Constructionn_Pro
 */
get_header();

$sort_team_sections = get_theme_mod( 'sort_team_sections', 'team,feature,service' );
$team_sections      = constructionn_pro_string_to_array( $sort_team_sections );

echo '<div class="inner-page  team-archive team team-page ">';
foreach ( $team_sections as $section ) {
	get_template_part( 'sections/team/' . $section );
}
echo '</div>';

get_footer();
