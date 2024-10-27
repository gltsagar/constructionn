<?php
/**
 * Project Page, Team Section
 *
 * @package constructionn-pro
 */
$prjpg_team_headings     = get_theme_mod( 'projpg_team_headings', __( 'Our working steps', 'constructionn-pro' ) );
$prjpg_team_btn_next_txt = get_theme_mod( 'projpgteam_btn_next_txt', __( 'Next', 'constructionn-pro' ) );
$prjpg_team_btn_prev_txt = get_theme_mod( 'projpgteam_btn_prev_txt', __( 'Prev', 'constructionn-pro' ) );
$prjpg_team_repeater     = get_theme_mod( 'projpg_team_repeater', array() );

constructionn_pro_team_section(
	'projectpg-team',
	$prjpg_team_headings,
	$prjpg_team_btn_next_txt,
	$prjpg_team_btn_prev_txt,
	$prjpg_team_repeater
);
