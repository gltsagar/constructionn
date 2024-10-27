<?php
/**
 * Template Name: Contact Us
 *
 * @package Constructionn_Pro
 */
get_header();

$sort_contact_sections = get_theme_mod( 'sort_contact_sections', 'contact_map,contact_form,contact_partner' );
$about_sections        = constructionn_pro_string_to_array( $sort_contact_sections );

echo '<div class="inner-page contact-page">';
foreach ( $about_sections as $section ) {
	get_template_part( 'sections/contact/' . $section );
}
echo '</div>';

get_footer();
