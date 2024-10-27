<?php

/**
 * This file contains all the functions used in the Comtact Template
 *
 * @package constructionn-pro
 */

/* FrontContact Contact Form sections */
if ( ! function_exists( 'constructionn_pro_contact_section' ) ) :
	/**
	 * Contact Section
	 *
	 * @return void
	 */
	function constructionn_pro_contact_section(
		$sec_name,
		$contact_headings,
		$contact_descriptions,
		$contact_form_shortcode
	) {
		if ( $contact_headings || $contact_descriptions || $contact_form_shortcode ) { ?>
		<div id="<?php echo esc_attr( $sec_name ); ?>" class="contact-section <?php echo esc_attr( $sec_name ); ?>">
			<div class="container">
				<div class="contact-wrapper">
					<div class="contact-typo">
						<?php if ( $contact_headings || $contact_descriptions ) { ?>
							<div class="section-meta-wrap">
								<?php if ( $contact_headings ) { ?>
									<h2 class="section-heading"><?php echo esc_html( $contact_headings ); ?></h2>
								<?php } if ( $contact_descriptions ) { ?>
									<p class="section-desc"><?php echo esc_html( $contact_descriptions ); ?></p>
									<?php
								}
								?>
							</div>
							<?php
						}
						constructionn_pro_social_media_repeater( 'socials_media_repeater', 'contact-section-social-media' );
						?>
					</div>
					<?php if ( $contact_form_shortcode ) { ?>
					<div class="contact-form-wrapper">
						<?php echo do_shortcode( $contact_form_shortcode ); ?>
					</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
			<?php
		}
	}
endif;

/* Contact Template Contact Form sections */
if ( ! function_exists( 'constructionn_pro_contpage_contact_section' ) ) :
	/**
	 * Contact Template, Contact Section
	 *
	 * @return void
	 */
	function constructionn_pro_contpage_contact_section(
		$sec_name,
		$contpg_email_title,
		$contpg_email_desc,
		$contpg_email,
		$contpg_contact_title,
		$contpg_contact_desc,
		$contpg_contact_num,
		$contpg_location_title,
		$contpg_location_desc,
		$contpg_location,
		$contact_form_shortcode
	) {
		if ( $contpg_email_title || $contpg_email_desc || $contpg_email || $contpg_contact_title || $contpg_contact_desc || $contpg_contact_num || $contpg_location_title || $contpg_location_desc || $contpg_location || $contact_form_shortcode ) {
			?>
			<div class="contact-section layout-2 <?php echo esc_attr( $sec_name ); ?>">
				<div class="container">
					<div class="contact-wrapper">
						<?php if ( $contpg_email_title || $contpg_email_desc || $contpg_email || $contpg_contact_title || $contpg_contact_desc || $contpg_contact_num || $contpg_location_title || $contpg_location_desc || $contpg_location ) { ?>
							<div class="contact-typo">
								<?php if ( $contpg_email_title || $contpg_email_desc || $contpg_email ) { ?>
									<div class="quick-contact-card">
										<?php if ( $contpg_email_title ) { ?>
											<h5 class="title email"><?php echo esc_html( $contpg_email_title ); ?></h5>
										<?php } if ( $contpg_email_desc ) { ?>
											<p class="desc email"><?php echo esc_html( $contpg_email_desc ); ?></p>
										<?php } if ( $contpg_email ) { ?>
											<a href="<?php echo esc_url( 'mailto:' . sanitize_email( $contpg_email ) ); ?>" class="link email"><?php echo esc_html( $contpg_email ); ?></a>
											<?php
										}
										?>
									</div>
								<?php } if ( $contpg_contact_title || $contpg_contact_desc || $contpg_contact_num ) { ?>
									<div class="quick-contact-card">
										<?php if ( $contpg_contact_title ) { ?>
											<h5 class="title tel"><?php echo esc_html( $contpg_contact_title ); ?></h5>
										<?php } if ( $contpg_contact_desc ) { ?>
											<p class="desc tel"><?php echo esc_html( $contpg_contact_desc ); ?></p>
										<?php } if ( $contpg_contact_num ) { ?>
											<a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^\d+]/', '', $contpg_contact_num ) ); ?>" class="link tel"><?php echo esc_html( $contpg_contact_num ); ?></a>	
											<?php
										}
										?>
																			</div>
								<?php } if ( $contpg_location_title || $contpg_location_desc || $contpg_location ) { ?>
									<div class="quick-contact-card">
										<?php if ( $contpg_location_title ) { ?>
											<h5 class="title loc"><?php echo esc_html( $contpg_location_title ); ?></h5>
										<?php } if ( $contpg_location_desc ) { ?>
											<p class="desc loc"><?php echo esc_html( $contpg_location_desc ); ?></p>
										<?php } if ( $contpg_location ) { ?>
											<span class="location contpg"><?php echo esc_html( $contpg_location ); ?></span>
											<?php
										}
										?>
									</div>
									<?php
								}
								?>
							</div>
						<?php } if ( $contact_form_shortcode ) { ?>
							<div class="contact-form-wrapper">
								<?php echo do_shortcode( $contact_form_shortcode ); ?>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<?php
		}
	}
endif;
