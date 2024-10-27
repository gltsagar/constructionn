<?php
/**
 * Banner One
 */
$banner_one_repeater = get_theme_mod( 'front_banner_repeater', array() );
if ( $banner_one_repeater ) { ?>
	<div class="banner-section style-one">
		<div class="swiper banner-swiper-one">
			<div class="swiper-wrapper">
				<?php
				foreach ( $banner_one_repeater as $repeater ) {
					$img         = ( ! empty( $repeater['banner-icon'] ) && isset( $repeater['banner-icon'] ) ) ? $repeater['banner-icon'] : false;
					$heading     = ( ! empty( $repeater['banner-heading'] ) && isset( $repeater['banner-heading'] ) ) ? $repeater['banner-heading'] : false;
					$description = ( ! empty( $repeater['banner-desc'] ) && isset( $repeater['banner-desc'] ) ) ? $repeater['banner-desc'] : false;
					$btn_text    = ( ! empty( $repeater['btn-text'] ) && isset( $repeater['btn-text'] ) ) ? $repeater['btn-text'] : false;
					$btn_link    = ( ! empty( $repeater['btn-link'] ) && isset( $repeater['btn-link'] ) ) ? $repeater['btn-link'] : false;

					if ( $img || $heading || $description || ( $btn_text && $btn_link ) ) {
						$background_style = $img
						? 'background-image : url(' . esc_url( wp_get_attachment_image_url( $img, 'full' ) ) . '); background-repeat: no-repeat; background-position: center;'
						: 'background-color: var(--law-fallback-bg-color);';
						?>
						<div class="swiper-slide">
							<div class="banner-item" style="<?php echo esc_attr( $background_style ); ?>">
								<div class="container">
									<?php if ( $heading ) { ?>
										<div class="banner__text">
											<p class="banner__title">
												<?php echo wp_kses_post( $heading ); ?>
											</p>
										</div>
										<?php
									}
									?>
								</div>
								<?php if ( $description || ( $btn_text && $btn_link ) ) { ?>
									<div class="banner-notification">
										<?php if ( $description ) { ?>
											<?php echo wpautop( wp_kses_post( $description ) ); ?>
										<?php } if ( $btn_text && $btn_link ) { ?>
											<a href="<?php echo esc_url( $btn_link ); ?>" class="btn btn__text has-primary-color has-icon"><?php echo esc_html( $btn_text ); ?></a>
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
				}
				?>
			</div>
			<div class="swiper-pagination"></div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div>
	</div>
	<?php
}

