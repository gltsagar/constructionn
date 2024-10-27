<?php
/**
 * The template for displaying all service posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Constructionn_Pro
 */
get_header();

	/**
	 * Before service hook
	 *
	 * @hooked constructionn_pro_content_wrapper_start - 10
	*/
	do_action( 'constructionn_pro_before_posts_content' );

while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content', get_post_format() );

		endwhile; // End of the loop.

	/**
	 * After Posts hook
	 *
	 * @hooked constructionn_pro_single_entry_footer_sections - 5
	 * @hooked constructionn_pro_content_wrapper_end - 10
	*/
	do_action( 'constructionn_pro_after_posts_content' );

get_footer();
