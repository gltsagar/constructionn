<?php
/**
 * Front Testimonial Section
 *
 * @package constructionn-pro
 */
$testimonials_headings      = get_theme_mod( 'testimonials_headings', __( 'What clients say about us', 'constructionn-pro' ) );
$testimonial_btn_next_txt   = get_theme_mod( 'testimonial_btn_next_txt', __( 'Next', 'constructionn-pro' ) );
$testimonial_btn_prev_txt   = get_theme_mod( 'testimonial_btn_prev_txt', __( 'Prev', 'constructionn-pro' ) );
$front_testimonial_repeater = get_theme_mod( 'front_testimonial_repeater', array() );

if ( $testimonials_headings || $testimonial_btn_next_txt || $testimonial_btn_prev_txt || $front_testimonial_repeater ) { ?>
	<div class="testimonial-section sec-testimon" id="front-testimonial">
		<div class="container">
			<?php if ( $testimonials_headings ) { ?>
				<div class="section-meta-wrap is-centered">
					<h2 class="section-heading"><?php echo esc_html( $testimonials_headings ); ?></h2>
				</div>
			<?php } if ( $front_testimonial_repeater ) { ?>
				<div class="swiper testimonial-swiper">
					<div class="swiper-wrapper">
						<?php
						foreach ( $front_testimonial_repeater as $repeater ) {
							$testimonial_id = ( ! empty( $repeater['testimonial'] ) && isset( $repeater['testimonial'] ) ) ? $repeater['testimonial'] : '';
							constructionn_pro_get_front_testimonial( $testimonial_id );
						}
						?>
					</div>
					<?php if ( $testimonial_btn_next_txt ) { ?>
						<div class="swiper-button-next"><?php echo esc_html( $testimonial_btn_next_txt ); ?></div>
					<?php } if ( $testimonial_btn_prev_txt ) { ?>
						<div class="swiper-button-prev"><?php echo esc_html( $testimonial_btn_prev_txt ); ?></div>
						<?php
					}
					?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}


