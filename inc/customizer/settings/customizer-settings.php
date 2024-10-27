<?php
/**
 * Customizer Settings
 */
/**
 * Customizer Panel.
 */
require get_template_directory() . '/inc/customizer/settings/customizer-panel.php';

$constructionn_all_sections = apply_filters(
	'constructionn_customizer_sections',
	array(
		'front'        => array( 'frontbanner', 'about', 'frontservices', 'frontteam', 'fronttestimonial', 'frontblog', 'frontfaq', 'frontpartner', 'frontsort', 'frontcasestudies', 'frontcontact', 'frontcounter', 'frontcta', 'frontproject', 'frontworkingstep' ),
		'header'       => array( 'notificationbar', 'header', 'socialmedia' ),
		'contact'      => array( 'contact', 'contactmap', 'contactpartner', 'sort' ),
		'team'         => array( 'teamservice', 'teampage', 'teamcta', 'teamcounter', 'sort' ),
		'services'     => array( 'services', 'serviceteam', 'serviceproject', 'sort' ),
		'faq'          => array( 'faq', 'faqcontact', 'faqpartner', 'sort' ),
		'testimonials' => array( 'testimonials', 'testimonialcontactus', 'testimonialfaq', 'sort' ),
		'pricing'      => array( 'pricing', 'pricingfaq', 'pricingcontact', 'sort' ),
		'aboutus'      => array( 'about-aboutus', 'sort', 'aboutcasestudies', 'aboutcta', 'aboutcounter', 'aboutteam', 'aboutproject', 'aboutworkingstep' ),
		'footer'       => array( 'footer', 'footercontactform', 'footerlogo' ),
		'casestudies'  => array( 'case-studies', 'casestudiesteam', 'casestudiescontact', 'sort' ),
		'project'      => array( 'project', 'projectservice', 'projectworkingstep', 'projectteam', 'sort', 'singleCTA', 'singleproject' ),
		'other'        => array( 'typography', 'color', 'post-page', 'post-archive', 'layout', 'breadcrumb', 'pagination', 'cpt-slug', 'social-sharing', 'scrolltotop' ),
	)
);

/*
* Breaking everything into folder
*/
foreach ( $constructionn_all_sections as $foldername => $sectionslist ) {
	foreach ( $sectionslist as $ind ) {
		require get_template_directory() . '/inc/customizer/settings/sections/' . $foldername . '/' . $ind . '.php';
	}
}
