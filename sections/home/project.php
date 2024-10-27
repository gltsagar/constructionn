<?php
/**
 * Front Project Section
 *
 * @package constructionn
 */
$proj_headings       = get_theme_mod( 'project_headings', __( 'Our latest projects', 'constructionn' ) );
$proj_descs          = get_theme_mod( 'project_descs', __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'constructionn' ) );
$proj_btn_txt        = get_theme_mod( 'project_btn_txt', __( 'View All Projects', 'constructionn' ) );
$proj_btn_link       = get_theme_mod( 'project_btn_link', '#' );
$proj_btn_next_txt   = get_theme_mod( 'project_btn_next_txt', __( 'Next', 'constructionn' ) );
$proj_btn_prev_txt   = get_theme_mod( 'project_btn_prev_txt', __( 'Prev', 'constructionn' ) );
$front_proj_repeater = get_theme_mod( 'front_project_repeater', array() );

constructionn_project_section(
	'front-project',
	$proj_headings,
	$proj_descs,
	$proj_btn_txt,
	$proj_btn_link,
	$proj_btn_next_txt,
	$proj_btn_prev_txt,
	$front_proj_repeater
);
