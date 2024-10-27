<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Constructionn
 */

get_header();

	/**
	 * Before Posts hook
	 *
	 * @hooked constructionn_content_wrapper_start
	*/
	do_action( 'constructionn_before_posts_content' );

while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content', 'page' );

	// If comments are open or we have at least one comment, load up the comment template.
	constructionn_comment();

		endwhile; // End of the loop.

	/**
	 * After Posts hook
	 *
	 * @hooked constructionn_content_wrapper_end - 10
	*/
	do_action( 'constructionn_after_posts_content' );
get_footer();
