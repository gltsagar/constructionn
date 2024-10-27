<?php
/**
 * Service Template, Service Section
 *
 * @package constructionn-pro
 */
$servpg_headings = get_theme_mod( 'servpg_service_headings', __( 'Have any projects ?', 'constructionn-pro' ) );
$servpg_btn_txt  = get_theme_mod( 'servpg_btn_txt', __( 'View More', 'constructionn-pro' ) );
$servpg_image    = get_theme_mod( 'servpg_service_image', esc_url( get_template_directory_uri() . '/assets/images/Image-placeholder-3.jpg' ) );
$servpg_image_id = attachment_url_to_postid( $servpg_image );

$args    = array(
	'post_type'   => 'service',
	'post_status' => 'publish',
);
$service = new WP_Query( $args );

if ( $service->have_posts() || $servpg_headings || $servpg_btn_txt || $servpg_image || $servpg_image_id ) { ?>
<div class="services-section">
	<div class="container">
		<div class="services-section-wrapper">
			<?php if ( $servpg_headings ) { ?>
				<div class="section-meta-wrap is-centered">
					<h2 class="section-heading"><?php echo esc_html( $servpg_headings ); ?></h2>							
				</div>
				<?php
			}
			?>
			<div class="services-content">
				<div class="content-left">
					<?php constructionn_pro_get_front_services_details( $servpg_btn_txt, '' ); ?>
				</div>
				<?php if ( $servpg_image_id || $servpg_image ) { ?>
					<div class="content-right">
						<?php
						if ( $servpg_image_id ) {
							echo wp_get_attachment_image( $servpg_image_id, 'service_img' );
						} else {
							echo '<img src="' . esc_url( $servpg_image ) . '">';
						}
						?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
	<?php
}
