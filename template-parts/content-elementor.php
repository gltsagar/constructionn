<?php
/**
 * The Elementor main template file
 *
 * @package Constructionn
 */
?>
<div class="elementor-wrapper">
	<?php
		/* Start the Loop */
	while ( have_posts() ) :
		the_post();
		the_content();
		endwhile;
	?>
</div><!-- .elementor-wrapper -->
<?php
