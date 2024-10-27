<?php
/**
 * Constructionn Pro Common Function Defination
 *
 * @package Constructionn
 */
if ( ! function_exists( 'constructionn_counter_section' ) ) {
	/**
	 * Constructionn Pro counter Section
	 *
	 * @return void
	 */
	function constructionn_counter_section( $section_name, $counter_headings, $front_counter_repeaters, $front_count_feature_repeaters ) {
		if ( $counter_headings || $front_counter_repeaters || $front_count_feature_repeaters ) { ?>
			<div id="<?php echo esc_attr( $section_name ); ?>" class="counter-section <?php echo esc_attr( $section_name ); ?>">
				<div class="container">
					<div class="counter-wrapper">
						<div class="counter-top">
							<div class="counter-left">
								<?php if ( $counter_headings ) { ?>
									<div class="section-meta-wrap">
										<h2 class="section-heading"><?php echo esc_html( $counter_headings ); ?></h2>
									</div>
									<?php
								}
								?>
															</div>
							<div class="counter-right">
								<?php
								foreach ( $front_counter_repeaters as $numrepeater ) {
									$counter_title  = ( ! empty( $numrepeater['title'] ) && isset( $numrepeater['title'] ) ) ? $numrepeater['title'] : '';
									$counter_count  = ( ! empty( $numrepeater['counter'] ) && isset( $numrepeater['counter'] ) ) ? $numrepeater['counter'] : '';
									$counter_prefix = ( ! empty( $numrepeater['prefix'] ) && isset( $numrepeater['prefix'] ) ) ? $numrepeater['prefix'] : '';

									if ( $counter_title || ( $counter_count && $counter_prefix ) ) {
										?>
																			<?php if ( $counter_title || ( $counter_count && $counter_prefix ) ) { ?>
											<div class="counter-card">
																				<?php if ( $counter_count && $counter_prefix ) { ?>
													<span class="counter-number" data-count="<?php echo esc_attr( $counter_count ); ?>" data-prefix="<?php echo esc_attr( $counter_prefix ); ?>">
																					<?php echo esc_html( $counter_count . $counter_prefix ); ?>
													</span>
												<?php } if ( $counter_title ) { ?>
													<span class="counter-label"><?php echo esc_html( $counter_title ); ?></span>
												<?php } ?>
											</div>
										<?php } ?>                                   
										<?php
									}
								}
								?>
							</div>
						</div>
						<div class="counter-bottom">
							<?php
							foreach ( $front_count_feature_repeaters as $countrepeater ) {
								$text        = ( ! empty( $countrepeater['text'] ) && isset( $countrepeater['text'] ) ) ? $countrepeater['text'] : '';
								$description = ( ! empty( $countrepeater['description'] ) && isset( $countrepeater['description'] ) ) ? $countrepeater['description'] : '';

								if ( $text || $description ) {
									?>
																	<div class="about-mvc">
										<?php if ( $text ) { ?>
											<h4 class="title"><?php echo esc_html( $text ); ?></h4>
										<?php } if ( $description ) { ?>
											<p class="desc"><?php echo esc_html( $description ); ?></p>
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
			<?php
		}
	}
}

if ( ! function_exists( 'constructionn_workingstep_section' ) ) {
	/**
	 * Constructionn Pro Wrokingstep Section
	 *
	 * @return void
	 */
	function constructionn_workingstep_section( $section_name, $workstep_headings, $front_workstep_repeaters ) {
		if ( $workstep_headings || $front_workstep_repeaters ) {
			?>
			<div id="<?php echo esc_attr( $section_name ); ?>" class="process-section bg-black  <?php echo esc_attr( $section_name ); ?>">
				<div class="container">
					<?php if ( $workstep_headings ) { ?>
						<div class="section-meta-wrap">
							<h2 class="section-heading"><?php echo esc_html( $workstep_headings ); ?></h2>
						</div>
						<?php
					}
					?>
					<div class="process-wrapper">
					<?php
					foreach ( $front_workstep_repeaters as $repeater ) {
						$text        = ( ! empty( $repeater['text'] ) && isset( $repeater['text'] ) ) ? $repeater['text'] : '';
						$description = ( ! empty( $repeater['description'] ) && isset( $repeater['description'] ) ) ? $repeater['description'] : '';
						$image       = ( ! empty( $repeater['image'] ) && isset( $repeater['image'] ) ) ? $repeater['image'] : '';

						if ( $text || $description || $image ) {
							?>
							<div class="process__card">
								<?php if ( $image ) { ?>
									<div class="feature-image">
										<?php echo wp_get_attachment_image( $image, 'thumbnail', true ); ?>
									</div>
								<?php } if ( $text ) { ?>
									<h5 class="title"><?php echo esc_html( $text ); ?></h5>
								<?php } if ( $description ) { ?>
									<p class="desc">
									<?php echo wp_kses_post( $description ); ?>
									</p>
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
			<?php
		}
	}
}

if ( ! function_exists( 'constructionn_partners_section' ) ) {
	/**
	 * Partner function
	 *
	 * @param [type] $partner_repeater
	 * @return void
	 */
	function constructionn_partners_section( $section_name, $partner_repeater ) {
		if ( $partner_repeater ) {
			?>
			<div id="<?php echo esc_html( $section_name ); ?>" class="partners-section <?php echo esc_html( $section_name ); ?>">
				<div class="container">
					<div class="swiper partners-swiper">
						<div class="swiper-wrapper">
							<?php
							foreach ( $partner_repeater as $partner ) {
								$partner_thumb = ( isset( $partner['thumbnail'] ) && ! empty( $partner['thumbnail'] ) ) ? $partner['thumbnail'] : false;
								if ( $partner_thumb ) {
									?>
									<div class="swiper-slide">
										<?php echo wp_get_attachment_image( $partner_thumb, 'full' ); ?>
									</div>
									<?php
								}
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

if ( ! function_exists( 'constructionn_get_faqs_details' ) ) :
	/**
	 * Function to get the FAQs section
	 *
	 * @param [type] $postid
	 * @return void
	 */
	function constructionn_get_faqs_details( $faq_repeater ) {
		if ( $faq_repeater ) {
			?>
			<div class="faq-wrapper">
				<div class="accordion-wrapper ">
					<ul class="accordion">
						<?php
						foreach ( $faq_repeater as $repeater ) {
							$question = ( ! empty( $repeater['question'] ) && isset( $repeater['question'] ) ) ? $repeater['question'] : '';
							$answer   = ( ! empty( $repeater['answer'] ) && isset( $repeater['answer'] ) ) ? $repeater['answer'] : '';

							if ( $question || $answer ) {
								?>
								<li class="accordion-item">
									<button class="accordion-button">
										<p><?php echo esc_html( $question ); ?></p>
									</button>
									<div class="accordion-content">
										<p><?php echo wp_kses_post( $answer ); ?> </p>
									</div>
								</li>
								<?php
							}
						}
						?>
					</ul>
				</div>
			</div>
			<?php
		}
	}
endif;
