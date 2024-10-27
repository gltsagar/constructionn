<?php
/**
 * Service Template, Project Section
 *
 * @package constructionn-pro
 */
$proj_headings       = get_theme_mod( 'servpg_project_headings', __( 'Our latest projects', 'constructionn-pro' ) );
$proj_descs          = get_theme_mod( 'servpg_project_descs', __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'constructionn-pro' ) );
$proj_btn_txt        = get_theme_mod( 'servpg_project_btn_txt', __( 'View All Projects', 'constructionn-pro' ) );
$proj_btn_link       = get_theme_mod( 'servpg_project_btn_link', '#' );
$proj_btn_next_txt   = get_theme_mod( 'servpg_btn_next_txt', __( 'Next', 'constructionn-pro' ) );
$proj_btn_prev_txt   = get_theme_mod( 'servpg_btn_prev_txt', __( 'Prev', 'constructionn-pro' ) );
$front_proj_repeater = get_theme_mod( 'servpg_project_repeater', array() );

constructionn_pro_project_section(
	'servicepg-project',
	$proj_headings,
	$proj_descs,
	$proj_btn_txt,
	$proj_btn_link,
	$proj_btn_next_txt,
	$proj_btn_prev_txt,
	$front_proj_repeater
);
