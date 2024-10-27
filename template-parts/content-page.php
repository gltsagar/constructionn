<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Constructionn
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content-wrap">
		<?php
			/**
			 * @hooked constructionn_post_thumbnail - 10
			 * @hooked constructionn_post_metas     - 20
			 */
			do_action( 'constructionn_before_post_entry_content' );

			/**
			 * Entry Content
			 *
			 * @hooked constructionn_entry_content - 40
			 * @hooked constructionn_entry_footer  - 50
			*/
			do_action( 'constructionn_post_entry_content' );
		?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
