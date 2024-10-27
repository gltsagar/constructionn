<?php
/**
 * The template for displaying all single post for Case Study post type
 *
 * @package Constructionn_Pro
 */
get_header();

	/**
	 * Before team hook
	 *
	 * @hooked constructionn_pro_cpt_wrapper_start - 10
	 * @hooked constructionn_pro_team_single_top - 20
	*/
	do_action( 'constructionn_pro_before_cpt_content' );

while ( have_posts() ) :
	the_post(); ?>
	<div class="team-single-bottom bg-gray">
		<div class="container">
			<div class="wrapper <?php post_class(); ?>" id="post-<?php the_ID(); ?>">
				<div class="entry-content" itemprop="text">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
	<?php
endwhile; // End of the loop.

	/**
	 * End team hook
	 * hooked constructionn_pro_latest_projects - 10
	 * hooked constructionn_pro_cpt_wrapper_end - 20
	*/
	do_action( 'constructionn_pro_end_cpt_content' );

get_footer();
