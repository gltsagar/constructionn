<?php
/**
 * Banner Two
 */
$banner_two_repeater = get_theme_mod( 'front_banner_two_repeater' );

if ( $banner_two_repeater ) { ?>
	<div class="banner-section style-two">
		<div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper banner-swiper-two__view">
			<div class="swiper-wrapper">
				<?php
				foreach ( $banner_two_repeater as $repeater ) {
					$img          = ( ! empty( $repeater['banner-icon'] ) && isset( $repeater['banner-icon'] ) ) ? $repeater['banner-icon'] : false;
					$heading      = ( ! empty( $repeater['banner-heading'] ) && isset( $repeater['banner-heading'] ) ) ? $repeater['banner-heading'] : false;
					$subheading   = ( ! empty( $repeater['banner-subheading'] ) && isset( $repeater['banner-subheading'] ) ) ? $repeater['banner-subheading'] : false;
					$btn_text_one = ( ! empty( $repeater['btn-text-one'] ) && isset( $repeater['btn-text-one'] ) ) ? $repeater['btn-text-one'] : false;
					$btn_link_one = ( ! empty( $repeater['btn-link-one'] ) && isset( $repeater['btn-link-one'] ) ) ? $repeater['btn-link-one'] : false;
					$btn_text_two = ( ! empty( $repeater['btn-text-two'] ) && isset( $repeater['btn-text-two'] ) ) ? $repeater['btn-text-two'] : false;
					$btn_link_two = ( ! empty( $repeater['btn-link-two'] ) && isset( $repeater['btn-link-two'] ) ) ? $repeater['btn-link-two'] : false;

					if ( $img || $heading || $subheading || ( $btn_text_one && $btn_link_one ) || ( $btn_text_two && $btn_link_two ) ) {
						$background_style = $img
						? 'background-image : url(' . esc_url( wp_get_attachment_image_url( $img, 'full' ) ) . ');  background-repeat: no-repeat; background-position: center; background-size: cover;'
						: 'background-color: var(--law-fallback-bg-color);';
						?>
				<div class="swiper-slide">
					<div class="banner-item" style="<?php echo esc_attr( $background_style ); ?>">
						<div class="container">
							<div class="banner-content-wrap"> 
								<?php if ( $heading || ( $btn_text_one && $btn_link_one ) || ( $btn_text_two && $btn_link_two ) ) { ?>
									<div class="banner__text">
										<?php if ( $heading ) { ?>
											<p class="banner__title"><?php echo esc_html( $heading ); ?></p>
										<?php } if ( ( $btn_text_one && $btn_link_one ) || ( $btn_text_two && $btn_link_two ) ) { ?>
											<div class="btn__wrap">
												<?php if ( $btn_text_one && $btn_link_one ) { ?>
													<a href="<?php echo esc_url( $btn_link_one ); ?>" class="btn has-icon btn__white"><?php echo esc_html( $btn_text_one ); ?></a>
												<?php } if ( $btn_text_two && $btn_link_two ) { ?>
													<a href="<?php echo esc_url( $btn_link_two ); ?>" class="btn has-icon btn__white-outline"><?php echo esc_html( $btn_text_two ); ?></a>
													<?php
												}
												?>
											</div>
											<?php
										}
										?>
									</div>
									<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
						<?php
					}
				}
				?>
			</div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
			<div class="swiper-pagination"></div>
		</div>
		<div thumbsSlider="" class="swiper banner-swiper-two__thumb">
			<div class="swiper-wrapper">
				<?php
				foreach ( $banner_two_repeater as $repeater ) {
					$heading    = ( ! empty( $repeater['banner-heading'] ) && isset( $repeater['banner-heading'] ) ) ? $repeater['banner-heading'] : false;
					$subheading = ( ! empty( $repeater['banner-subheading'] ) && isset( $repeater['banner-subheading'] ) ) ? $repeater['banner-subheading'] : false;
					if ( $heading || $subheading ) {
						?>
						<div class="swiper-slide">
							<div class="banner-item banner-slider">
								<?php if ( $subheading ) { ?>
									<span class="banner-tag"><?php echo esc_html( $subheading ); ?></span>
								<?php } if ( $heading ) { ?>
									<p class="banner-title"><?php echo esc_html( $heading ); ?></p>
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
		</div>
	</div>
		<!-- banner section end -->
		<span id="sideMenuOverlay"></span>
<?php } ?>
