<?php
/**
 * Banner Three
 */
$img                      = get_theme_mod( 'banner_three_img' );
$banner_three_heading     = get_theme_mod( 'ban_three_heading', __( 'The Passion For Architecture Never Stops', 'constructionn' ) );
$banner_three_subheading  = get_theme_mod( 'ban_three_subheading', __( 'Architecture', 'constructionn' ) );
$banner_three_description = get_theme_mod( 'ban_three_descs', __( 'Use of the  agile frameworks to give a high-level overviews and iterative corporate for a better strategy a solid synopsis.', 'constructionn' ) );
$b_three_btn_text_one     = get_theme_mod( 'b_three_btn_txt_one', __( 'Learn More', 'constructionn' ) );
$b_three_btn_link_one     = get_theme_mod( 'b_three_btn_link_one', __( '#', 'constructionn' ) );
$b_three_btn_txt_two      = get_theme_mod( 'b_three_btn_txt_two', __( 'Learn More', 'constructionn' ) );
$b_three_btn_link_two     = get_theme_mod( 'b_three_btn_link_two', __( '#', 'constructionn' ) );
$ban_video_btn_link       = get_theme_mod( 'ban_video_btn_link', __( '#', 'constructionn' ) );
$bannerthree_repeater     = get_theme_mod( 'front_bannerthree_repeater', array() );

$fallback_bg_color        = get_theme_mod( 'fallback_bg_color', '#003262' );
		$background_style = $fallback_bg_color;
		// background image
if ( $img ) {
	$background_style = 'background-image: url(' . esc_url( $img ) . '); background-repeat: no-repeat; background-size: cover; background-position: center;';
} else {
	$background_style = 'background-color: ' . esc_attr( $fallback_bg_color ) . ';';
}

if ( $img || $banner_three_heading || $banner_three_subheading || $banner_three_description || ( $b_three_btn_text_one && $b_three_btn_link_one ) || ( $b_three_btn_txt_two && $b_three_btn_link_two ) || $ban_video_btn_link || $bannerthree_repeater ) { ?>
	<div class="banner-section style-three">
		<div class="container">
			<div class="banner-container">
				<div class="banner-wrapper">
					<?php if ( $banner_three_heading || $banner_three_subheading || $banner_three_description || ( $b_three_btn_text_one && $b_three_btn_link_one ) || ( $b_three_btn_txt_two && $b_three_btn_link_two ) ) { ?>
						<div class="banner-left">
							<?php if ( $banner_three_subheading ) { ?>
								<span class="banner__tag"><?php echo esc_html( $banner_three_subheading ); ?></span>
							<?php } if ( $banner_three_heading ) { ?>
								<p class="banner__title"><?php echo esc_html( $banner_three_heading ); ?></p>
							<?php } if ( $banner_three_description ) { ?>
								<?php echo wpautop( wp_kses_post( $banner_three_description ) ); ?>
							<?php } if ( ( $b_three_btn_text_one && $b_three_btn_link_one ) || ( $b_three_btn_txt_two && $b_three_btn_link_two ) ) { ?>
								<div class="btn-wrap">
									<?php if ( $b_three_btn_text_one && $b_three_btn_link_one ) { ?>
										<a href="<?php echo esc_url( $b_three_btn_link_one ); ?>" class="btn has-icon btn__primary"><?php echo esc_html( $b_three_btn_text_one ); ?></a>
									<?php } if ( $b_three_btn_txt_two && $b_three_btn_link_two ) { ?>
										<a href="<?php echo esc_url( $b_three_btn_link_two ); ?>" class="btn has-icon btn__primary-outline"><?php echo esc_html( $b_three_btn_txt_two ); ?></a>
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
					<div class="banner-right">
						<?php if ( $img || $ban_video_btn_link ) { ?>
							<div class="video-block" style="<?php echo esc_attr( $background_style ); ?>">
								<?php if ( $ban_video_btn_link ) { ?>
									<div class="video-block-wrap">
										<a href="<?php echo esc_url( $ban_video_btn_link ); ?>" data-fancybox data-caption class="video-control-btn">
											<?php echo constructionn_handle_all_svgs( 'banner-video' ); ?>                                        
										</a>
									</div>
									<?php
								}
								?>
							</div>
							<?php
						}
						?>
						<div class="banner-counter">
							<?php
							foreach ( $bannerthree_repeater as $repeater ) {
								$count  = ( ! empty( $repeater['count'] ) && isset( $repeater['count'] ) ) ? $repeater['count'] : false;
								$prefix = ( ! empty( $repeater['prefix'] ) && isset( $repeater['prefix'] ) ) ? $repeater['prefix'] : false;
								$text   = ( ! empty( $repeater['text'] ) && isset( $repeater['text'] ) ) ? $repeater['text'] : false;

								if ( ( $count && $prefix ) || $text ) {
									?>
							<div class="counter-card">
									<?php if ( $count && $prefix ) { ?>
									<span class="counter-number" data-count="<?php echo esc_attr( $count ); ?>" data-prefix="<?php echo esc_attr( $prefix ); ?>">
										<?php echo esc_html( $count . $prefix ); ?>
									</span>
								<?php } if ( $text ) { ?>
									<span class="counter-label"><?php echo esc_html( $text ); ?></span>
										<?php
								}
								?>
							</div>
									<?php
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<!-- banner section end -->
		<span id="sideMenuOverlay"></span>
	<?php
}
