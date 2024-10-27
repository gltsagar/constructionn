<?php
/**
 * About Us Case Studies Section
 *
 * @package constructionn-pro
 */
$casestd_heading        = get_theme_mod( 'abtpg_casestudies_heading', __( 'Case studies define our success.', 'constructionn-pro' ) );
$front_casestd_repeater = get_theme_mod( 'abtpg_casestudies_repeater', array() );
$cs_btn_txt             = get_theme_mod( 'aboutpg_cs_btn_text', esc_html__( 'Explore More', 'constructionn-pro' ) );

constructionn_pro_case_study(
	'about-us-case-studies',    // class for the section
	$casestd_heading,           // heading of the case study section
	$cs_btn_txt,                    // case study readmore button
	$front_casestd_repeater,    // repeater of the case study section
);
