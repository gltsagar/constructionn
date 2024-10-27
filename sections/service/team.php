<?php
/**
 * Service Page, Team Section
 *
 * @package constructionn-pro
 */
$tpg_team_headings     = get_theme_mod( 'servpg_team_headings', __( 'Our working steps', 'constructionn-pro' ) );
$tpg_team_btn_next_txt = get_theme_mod( 'servpg_team_btn_next_txt', __( 'Next', 'constructionn-pro' ) );
$tpg_team_btn_prev_txt = get_theme_mod( 'servpg_team_btn_prev_txt', __( 'Prev', 'constructionn-pro' ) );
$tpg_team_repeater     = get_theme_mod( 'servpg_team_repeater', array() );
constructionn_pro_team_section(
	'servicepg-team',
	$tpg_team_headings,
	$tpg_team_btn_next_txt,
	$tpg_team_btn_prev_txt,
	$tpg_team_repeater
);
