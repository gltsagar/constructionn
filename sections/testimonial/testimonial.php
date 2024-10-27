<?php
/**
 *  Testimonial Template, Testimonial Section
 *
 *  @package constructionn-pro
 */
$tpg_testimon_headings     = get_theme_mod( 'testimonialpg_testimon_headings', __( 'What clients say about us', 'constructionn-pro' ) );
$tpg_testimon_btn_next_txt = get_theme_mod( 'testimonialpg_btn_next_txt', __( 'Next', 'constructionn-pro' ) );
$tpg_testimon_btn_prev_txt = get_theme_mod( 'testimonialpg_btn_prev_txt', __( 'Prev', 'constructionn-pro' ) );

$args         = array(
	'post_type'      => 'testimonial',
	'posts_per_page' => -1,
	'post_status'    => 'publish',
);
$testimonials = new WP_Query( $args );

if ( $testimonials->have_posts() || $tpg_testimon_headings || $tpg_testimon_btn_next_txt || $tpg_testimon_btn_prev_txt ) { ?>
	<div class="testimonial-section testimonpg">
		<div class="container">
			<?php if ( $tpg_testimon_headings ) { ?>
				<div class="section-meta-wrap is-centered">
					<h2 class="section-heading"><?php echo esc_html( $tpg_testimon_headings ); ?></h2>
				</div>
				<?php
			}
			?>
			<div class="swiper testimonial-swiper">
				<div class="swiper-wrapper">
					<?php constructionn_pro_get_front_testimonial( $post_id = '' ); ?>
				</div>
				<?php if ( $tpg_testimon_btn_next_txt ) { ?>
					<div class="swiper-button-next"><?php echo esc_html( $tpg_testimon_btn_next_txt ); ?></div>
				<?php } if ( $tpg_testimon_btn_prev_txt ) { ?>
					<div class="swiper-button-prev"><?php echo esc_html( $tpg_testimon_btn_prev_txt ); ?></div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<?php
}
