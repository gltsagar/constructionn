<?php
/**
 * The template for displaying archive pages
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

if ( have_posts() ) :
	/* Start the Loop */
	while ( have_posts() ) :
		the_post();
		/*
		* Include the Post-Format-specific template for the content.
		* If you want to override this in a child theme, then include a file
		* called content-___.php (where ___ is the Post Format name) and that will be used instead.
		*/
		get_template_part( 'template-parts/content', get_post_format() );
	endwhile;

		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		/**
		 * After Posts hook
		 *
		 * @hooked constructionn_content_wrapper_end - 10
		*/
		do_action( 'constructionn_after_posts_content' );

		get_footer();
