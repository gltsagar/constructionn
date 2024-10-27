<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Constructionn_Pro
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="https://schema.org/Blog">
	<?php
	if ( ! is_single() ) {
		echo '<div class="blog__card">';}
			/**
			 * @hooked constructionn_pro_post_thumbnail  - 10
			 * @hooked constructionn_pro_post_metas      - 20
			 */
			do_action( 'constructionn_pro_before_post_entry_content' );

			/**
			 * Entry Content
			 *
			 * @hooked constructionn_pro_entry_content - 40
			 * @hooked constructionn_pro_entry_footer  - 50
			*/
			do_action( 'constructionn_pro_post_entry_content' );
	if ( ! is_single() ) {
		'</div>';
	}
	?>
</article>
