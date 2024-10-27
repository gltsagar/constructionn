<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
?>
	<section class="error-404 not-found">
		<header class="page-header">
			<h2 class="page-title">
				<?php esc_html_e( 'The page you requested could not be found.', 'constructionn-pro' ); ?>
			</h2>
			<div class="subtitle">
				<?php esc_html_e( "The page you're trying to access either doesn't exist or has moved.", 'constructionn-pro' ); ?>
			</div>
		</header>
		<figure>
			<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/error.png' ); ?>" alt="<?php echo esc_attr( '404-error', 'constructionn-pro' ); ?> ">
		</figure>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn__primary"><?php esc_html_e( 'Take Me Home', 'constructionn-pro' ); ?></a>
	</section>
<?php
/**
 * After Posts hook
 *
 * @hooked constructionn_pro_content_wrapper_end - 10
 */
do_action( 'constructionn_pro_after_posts_content' );

get_footer();

