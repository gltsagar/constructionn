<?php
/**
 * Faq Page, Contact Section
 *
 * @package constructionn-pro
 */
$faq_headings = get_theme_mod( 'faqpg_faq_headings', __( 'We provide solution to every queries!', 'constructionn-pro' ) );

// For FAQ Archive
constructionn_pro_faq_section(
	'faqpg-faq',     // name
	$faq_headings,  // heading
	array(),        // Passing an empty array since we're fetching all FAQs
	true            // Indicate that we want to show all FAQs
);
