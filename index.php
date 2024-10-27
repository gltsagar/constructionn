<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Constructionn_Pro
 */

get_header();

	/**
	 * Before Posts hook
	 *
	 * @hooked constructionn_pro_content_wrapper_start
	*/
	do_action( 'constructionn_pro_before_posts_content' );
if ( have_posts() ) {
	while ( have_posts() ) :
		the_post();

		/*
		* Include the Post-Format-specific template for the content.
		* If you want to override this in a child theme, then include a file
		* called content-___.php (where ___ is the Post Format name) and that will be used instead.
		*/
		get_template_part( 'template-parts/content', get_post_format() );
	endwhile; // End of the loop.
} else {
	get_template_part( 'template-parts/content', 'none' );
}

	/**
	 * After Posts hook
	 *
	 * @hooked constructionn_pro_content_wrapper_end - 10
	*/
	do_action( 'constructionn_pro_after_posts_content' );

get_footer();
