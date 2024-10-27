<?php
/**
 * Functions which hooking all the sections of the templates
 *
 * @package Constructionn
 */

/**
 * Dynamic Code to enqueue all the php files
 */

$dir          = 'inc/pagehooks/';
$allpagehooks = glob( trailingslashit( get_template_directory() ) . $dir . '*.php' );
if ( ! empty( $allpagehooks ) ) {
	foreach ( $allpagehooks as $file ) {
		require_once $file;
	}
}

if ( ! function_exists( 'constructionn_get_about_section' ) ) {
	/**
	 * About Us Section
	 */
	function constructionn_get_about_section(
		$sec_name,
		$about_subheading,
		$about_headings,
		$about_descriptions,
		$notice_headings,
		$notice_descriptions,
		$about_btn_txt,
		$about_btn_link,
		$front_about_repeaters,
		$about_image_one,
		$about_image_two
	) {
		$image_id_one = attachment_url_to_postid( $about_image_one );
		$image_id_two = attachment_url_to_postid( $about_image_two );

		if ( ( $about_image_one || $image_id_one ) || ( $about_image_two || $image_id_two ) || $about_subheading || $about_headings || $about_descriptions || $notice_headings || $notice_descriptions || ( $about_btn_txt && $about_btn_link ) || $front_about_repeaters ) { ?>
			<div id="<?php echo esc_attr( $sec_name ); ?>" class="about-section <?php echo esc_attr( $sec_name ); ?>">
				<div class="container">
					<div class="about-section-wrapper">
						<?php if ( $about_headings ) { ?>
							<div class="about-top">
								<?php if ( $about_headings ) { ?>
									<div class="section-meta-wrap is-centered">
										<h2 class="section-heading"><?php echo esc_html( $about_headings ); ?></h2>
									</div>
									<?php
								}
								?>
							</div>
							<?php
						}
						?>
						<div class="about-bottom">
							<?php if ( ( $about_image_one || $image_id_one ) || ( $about_image_two || $image_id_two ) || $notice_headings || $notice_descriptions ) { ?>
								<div class="about-left">
									<?php if ( ( $about_image_one || $image_id_one ) || ( $about_image_two || $image_id_two ) ) { ?>
										<div class="img-wrapper">
											<?php
											if ( $image_id_one ) {
												echo wp_get_attachment_image( $image_id_one, 'about_img_one' );
											} else {
												echo '<img src="' . esc_url( $about_image_one ) . '">';
											} if ( $image_id_two ) {
												echo wp_get_attachment_image( $image_id_two, 'about_img_two' );
											} else {
												echo '<img src="' . esc_url( $about_image_two ) . '">';
											}
											?>
										</div>
									<?php } if ( $notice_headings || $notice_descriptions ) { ?>
										<div class="text-wrapper">
											<?php if ( $notice_headings ) { ?>
												<h5 class="title"><?php echo esc_html( $notice_headings ); ?></h5>
											<?php } if ( $notice_descriptions ) { ?>
												<p><?php echo esc_html( $notice_descriptions ); ?></p>
												<?php
											}
											?>
										</div>
										<?php
									}
									?>
								</div>
							<?php } if ( $about_subheading || $about_descriptions || $front_about_repeaters || ( $about_btn_txt && $about_btn_link ) ) { ?>
								<div class="about-right">
									<?php if ( $about_subheading || $about_descriptions ) { ?>
										<div class="right-top">
											<?php if ( $about_subheading ) { ?>
												<h4 class="title"><?php echo esc_html( $about_subheading ); ?></h4>
											<?php } if ( $about_descriptions ) { ?>
												<?php echo wpautop( wp_kses_post( $about_descriptions ) ); ?>
												<?php
											}
											?>
										</div>
										<?php
									}
									?>
									<div class="features-wrap">
										<?php
										foreach ( $front_about_repeaters as $abtrepeater ) {
											$text        = ( ! empty( $abtrepeater['text'] ) && isset( $abtrepeater['text'] ) ) ? $abtrepeater['text'] : '';
											$description = ( ! empty( $abtrepeater['description'] ) && isset( $abtrepeater['description'] ) ) ? $abtrepeater['description'] : '';

											if ( $text || $description ) {
												?>
												<div class="feature">
													<?php if ( $text ) { ?>
														<h5 class="title"><?php echo esc_html( $text ); ?></h5>
													<?php } if ( $description ) { ?>
														<?php echo wpautop( wp_kses_post( $description ) ); ?>
														<?php
													}
													?>
												</div>
												<?php
											}
										}
										?>
									</div>
									<?php if ( $about_btn_txt && $about_btn_link ) { ?>
										<a href="<?php echo esc_url( $about_btn_link ); ?>" class="btn has-icon btn__primary"><?php echo esc_html( $about_btn_txt ); ?></a>
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
}
