<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Constructionn
 */

?>

<article class="post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	echo '<div class="blog__card">';
		/**
		* @hooked constructionn_post_thumbnail  - 10
		* @hooked constructionn_post_metas      - 20
		*/
		do_action( 'constructionn_before_post_entry_content' );

		/**
		 * Entry Content
		 *
		 * @hooked constructionn_entry_content - 40
		 * @hooked constructionn_post_edit     - 50
		*/
		do_action( 'constructionn_post_entry_content' );
	echo '</div>';
	?>
	</article>
