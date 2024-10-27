<?php
/**
 * Front Page, Team Section
 *
 * @package constructionn
 */
$front_team_headings    = get_theme_mod( 'front_team_headings', __( 'Our working steps', 'constructionn' ) );
$frontteam_btn_next_txt = get_theme_mod( 'frontteam_btn_next_txt', __( 'Next', 'constructionn' ) );
$frontteam_btn_prev_txt = get_theme_mod( 'frontteam_btn_prev_txt', __( 'Prev', 'constructionn' ) );
$front_team_repeater    = get_theme_mod( 'front_team_repeater', array() );

constructionn_team_section(
	'front-team',
	$front_team_headings,
	$frontteam_btn_next_txt,
	$frontteam_btn_prev_txt,
	$front_team_repeater
);
