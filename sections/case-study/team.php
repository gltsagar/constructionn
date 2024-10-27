<?php
/**
 * Case Study Page, Team Section
 *
 * @package constructionn-pro
 */
$cspg_team_headings     = get_theme_mod( 'cspg_team_headings', __( 'Our working steps', 'constructionn-pro' ) );
$cspg_team_btn_next_txt = get_theme_mod( 'cspg_team_btn_next_txt', __( 'Next', 'constructionn-pro' ) );
$cspg_team_btn_prev_txt = get_theme_mod( 'cspg_team_btn_prev_txt', __( 'Prev', 'constructionn-pro' ) );
$cspg_team_repeater     = get_theme_mod( 'cspg_team_repeater', array() );

constructionn_pro_team_section(
	'casestudypg-team',
	$cspg_team_headings,
	$cspg_team_btn_next_txt,
	$cspg_team_btn_prev_txt,
	$cspg_team_repeater
);
