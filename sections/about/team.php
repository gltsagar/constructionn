<?php
/**
 * About Page, Team Section
 *
 * @package constructionn-pro
 */
$front_team_headings    = get_theme_mod( 'abtpg_team_headings', __( 'Our working steps', 'constructionn-pro' ) );
$frontteam_btn_next_txt = get_theme_mod( 'abtpg_team_btn_next_txt', __( 'Next', 'constructionn-pro' ) );
$frontteam_btn_prev_txt = get_theme_mod( 'abtpg_team_btn_prev_txt', __( 'Prev', 'constructionn-pro' ) );
$front_team_repeater    = get_theme_mod( 'abtpg_team_repeater', array() );

constructionn_pro_team_section(
	'aboutpg-team',
	$front_team_headings,
	$frontteam_btn_next_txt,
	$frontteam_btn_prev_txt,
	$front_team_repeater
);
