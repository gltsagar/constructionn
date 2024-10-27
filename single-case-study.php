<?php

/**
 * The template for displaying all single post for Case Study post type
 *
 * @package Constructionn_Pro
 */
get_header();

/**
 * Before case study hook
 *
 * @hooked constructionn_pro_cpt_wrapper_start  - 10
 * @hooked constructionn_pro_case_study_single_top  - 20
 */
do_action( 'constructionn_pro_before_cpt_content' );

while ( have_posts() ) :
	the_post(); ?>
	<div class="content-wrap <?php post_class(); ?>" id="post-<?php the_ID(); ?>">
		<div class="container">
			<div class="entry-content" itemprop="text">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	<?php
endwhile; // End of the loop.

/**
 * End case study hook
 * hooked constructionn_pro_latest_case_study - 10
 * hooked constructionn_pro_cpt_wrapper_end   - 20
 */
do_action( 'constructionn_pro_end_cpt_content' );

get_footer();
