<?php
/**
 * Banner Four
 */
$banner_four_repeater = get_theme_mod( 'front_banner_four_repeater', array() );
if ( $banner_four_repeater ) { ?>
	<div class="banner-section style-four">
		<div class="swiper banner-swiper-four">
			<div class="swiper-wrapper">
				<?php
				$total_items = count( $banner_four_repeater );
				$chunks      = array_chunk( $banner_four_repeater, 3 ); // Split the items into chunks of 3

				foreach ( $chunks as $chunk ) {
					?>
					<div class="swiper-slide">
						<?php
						foreach ( $chunk as $repeater ) {
							$heading     = ( ! empty( $repeater['banner-heading'] ) && isset( $repeater['banner-heading'] ) ) ? $repeater['banner-heading'] : '';
							$heading_url = ( ! empty( $repeater['banner-heading-url'] ) && isset( $repeater['banner-heading-url'] ) ) ? $repeater['banner-heading-url'] : '';
							$subheading  = ( ! empty( $repeater['banner-subheading'] ) && isset( $repeater['banner-subheading'] ) ) ? $repeater['banner-subheading'] : '';
							$image       = ( ! empty( $repeater['banner-icon'] ) && isset( $repeater['banner-icon'] ) ) ? $repeater['banner-icon'] : '';

							if ( $heading || $heading_url || $subheading || $image ) {
								?>
								<div class="banner-item">
									<?php if ( $image ) { ?>
										<div class="banner-image">
											<?php echo wp_get_attachment_image( $image, 'thumbnail', true ); ?>
										</div>
									<?php } ?>
									<?php if ( $heading || $heading_url || $subheading ) { ?>
										<div class="banner-text">
											<?php if ( $heading || $heading_url ) { ?>
												<a href="<?php echo esc_url( $heading_url ); ?>" class="banner-title"><?php echo esc_html( $heading ); ?></a>
											<?php } ?>
											<?php if ( $subheading ) { ?>
												<span class="banner-tag"><?php echo esc_html( $subheading ); ?></span>
											<?php } ?>
										</div>
									<?php } ?>
								</div>
								<?php
							}
						}
						?>
					</div>
				<?php } ?>
			</div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
			<div class="swiper-pagination"></div>
		</div>
	</div>
	<!-- banner section end -->
	<span id="sideMenuOverlay"></span>
	<?php
}

