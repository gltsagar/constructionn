<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Constructionn_Pro
 */


	/**
	 * Footer
	 *
	 * @hooked constructionn_pro_footer_back_to_top  - 10
	 * @hooked constructionn_pro_footer_start        - 20
	 * @hooked constructionn_pro_footer_top          - 30
	 * @hooked constructionn_pro_footer_main         - 40
	 * @hooked constructionn_pro_footer_bottom       - 50
	 * @hooked constructionn_pro_footer_end          - 60
	 */
	do_action( 'constructionn_pro_footer' );

	/**
	 * After Footer
	 *
	 * @hooked constructionn_pro_page_end        - 10
	*/
	do_action( 'constructionn_pro_after_footer' );

	wp_footer(); ?>

	</body>
</html>
