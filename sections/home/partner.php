<?php
/**
 * Front Partner Section
 *
 * @package constructionn-pro
 */
$partner_repeater = get_theme_mod( 'front_partner_slider_custom', array() );

constructionn_pro_partners_section(
	'front-partner',
	$partner_repeater
);
