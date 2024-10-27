<?php
/**
 * Contact Page, Partner Section
 *
 * @package constructionn-pro
 */
$contpg_partner_repeater = get_theme_mod( 'contactpg_partner_slider_custom', array() );

constructionn_pro_partners_section(
	'contactpage-partner',
	$contpg_partner_repeater
);
