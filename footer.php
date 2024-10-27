<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Constructionn
 */


	/**
	 * Footer
	 *
	 * @hooked constructionn_footer_back_to_top  - 10
	 * @hooked constructionn_footer_start        - 20
	 * @hooked constructionn_footer_top          - 30
	 * @hooked constructionn_footer_main         - 40
	 * @hooked constructionn_footer_bottom       - 50
	 * @hooked constructionn_footer_end          - 60
	 */
	do_action( 'constructionn_footer' );

	/**
	 * After Footer
	 *
	 * @hooked constructionn_page_end        - 10
	*/
	do_action( 'constructionn_after_footer' );

	wp_footer(); ?>

	</body>
</html>
