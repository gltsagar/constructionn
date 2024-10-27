<?php
/**
 * The template for displaying the FrontPage
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Constructionn_Pro
 */
$sort_front_sections = get_theme_mod( 'sort_front_sections', 'banner,counter,about,cta,service,project,testimonial,case-studies,process,team,contact,faq,blog,partner,workingstep' );

$home_sections = constructionn_pro_string_to_array( $sort_front_sections );

if ( 'posts' == get_option( 'show_on_front' ) ) { // Show Static Blog Page
	include get_home_template();
} elseif ( is_elementor_activated_post() ) {
	get_header();
	get_template_part( 'template-parts/content-elementor' );
	get_footer();
} elseif ( $home_sections ) {
	get_header();
	// If any one section are enabled then show custom home page.
	foreach ( $home_sections as $section ) {
		get_template_part( 'sections/home/' . $section );
	}
	get_footer();
} else {
	// If all section are disabled then show respective page template.
	include get_page_template();
}
