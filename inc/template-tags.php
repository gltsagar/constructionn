<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Constructionn
 */

if ( ! function_exists( 'constructionn_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see constructionn_custom_header_setup().
	 */
	function constructionn_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
			<?php
			// Has the text been hidden?
			if ( ! display_header_text() ) :
				?>
				.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}

				<?php
				// If the user has set a custom color for the text use that.
			else :
				?>
				.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}

			<?php endif; ?>
		</style>
		<?php
	}
endif;

if ( ! function_exists( 'constructionn_header_title' ) ) :
	/**
	 * Page Title
	 *
	 * @return void
	 */
	function constructionn_header_title() {
		?>
		<header class="entry-header">
			<?php
			if ( is_home() && ! is_front_page() ) {
				echo '<h1 class="entry-title">';
				single_post_title();
				echo '</h1>';
			}

			if ( is_archive() ) {
				the_archive_title( '<h1 class="entry-title">', '</h1>' );
			}

			if ( is_search() ) {
				echo '<h1 class="entry-title">';
				printf( esc_html__( 'Search Results for: %s', 'constructionn' ), '<span>' . get_search_query() . '</span>' );
				echo '</h1>';
			}

			if ( is_singular() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			}
			if ( is_404() ) {
				echo '<h1 class="entry-title">';
				esc_html_e( 'Error Page', 'constructionn' );
				echo '</h1>';
			}
			?>
		</header>
		<?php
	}
endif;

if ( ! function_exists( 'constructionn_notification_bar' ) ) {
	/**
	 * Notification Bar
	 *
	 * @return void
	 */
	function constructionn_notification_bar() {
		$notificaiton_toggle    = get_theme_mod( 'notification_bar_toggle', true );
		$notification_heading   = get_theme_mod( 'notification_heading', __( 'Ready for the perfect home. Summertime discounts sales are here.', 'constructionn' ) );
		$notification_link_text = get_theme_mod( 'notification_link_text', __( 'Register Now', 'constructionn' ) );
		$notification_link      = get_theme_mod( 'notification_link', '#' );

		if ( $notificaiton_toggle && ( $notification_heading || ( $notification_link_text && $notification_link ) ) ) {
			?>
			<div class="notification-wrap">
				<div class="container">
					<?php if ( $notification_heading || ( $notification_link_text && $notification_link ) ) { ?>
						<div class="notification-bar">
							<p>
								<?php if ( $notification_heading ) { ?>
									<span><?php echo esc_html( $notification_heading ); ?></span>
								<?php } if ( $notification_link_text && $notification_link ) { ?>
									<a href="<?php echo esc_url( $notification_link ); ?>" class="btn"><?php echo esc_html( $notification_link_text ); ?></a>
									<?php
								}
								?>
							</p>
						</div>
						<?php
					}
					?>
					<a href="#" id="notify-close">
						<span class="icon-close-filled"></span>
					</a>
				</div>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'constructionn_header_message' ) ) {
	/**
	 * Header Message Bar
	 *
	 * @return void
	 */
	function constructionn_header_message() {
		$message_heading = get_theme_mod( 'message_heading', __( 'Summertime discounts sales.', 'constructionn' ) );
		$msg_btn_txt     = get_theme_mod( 'msg_btn_txt', __( 'Learn More!', 'constructionn' ) );
		$msg_btn_link    = get_theme_mod( 'msg_btn_link', '#' );

		if ( $message_heading || ( $msg_btn_txt && $msg_btn_link ) ) {
			?>
			<div class="top-left">
				<?php if ( $message_heading || ( $msg_btn_txt && $msg_btn_link ) ) { ?>
					<div class="text-holder">
						<?php if ( $message_heading ) { ?>
							<p><?php echo esc_html( $message_heading ); ?></p>
						<?php } if ( $msg_btn_txt && $msg_btn_link ) { ?>
							<a href="<?php esc_url( $msg_btn_link ); ?>"><?php echo esc_html( $msg_btn_txt ); ?></a>
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
	}
}


if ( ! function_exists( 'constructionn_header_five_ham_wrapper' ) ) {
	function constructionn_header_five_ham_wrapper( $sec_name, $menu_label ) {
		$menu_label = get_theme_mod( 'menu_label', __( 'Menu', 'constructionn' ) );
		if ( $menu_label ) {
			?>
			<div class="ham-wrapper <?php echo esc_html( $sec_name ); ?>">
				<?php if ( $menu_label ) { ?>
					<span class="label"><?php echo esc_html( $menu_label ); ?></span>
					<?php
				}
				?>
				<a href="#" class="ham-bars" id="sideMenuOpener">
					<span class="bar"></span>
					<span class="bar"></span>
					<span class="bar"></span>
				</a>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'constructionn_mobile_ham_wrapper' ) ) {
	function constructionn_mobile_ham_wrapper() {
		?>
		<div class="ham-wrapper">
			<a href="#" class="ham-bars" id="sideMenuOpener">
				<span class="bar"></span>
				<span class="bar"></span>
				<span class="bar"></span>
			</a>
		</div>
		<?php
	}
}


if ( ! function_exists( 'constructionn_site_branding' ) ) :
	/**
	 * Site Branding
	 */
	function constructionn_site_branding( $is_desktop = false ) {
		?>
		<div class="site-branding" itemscope itemtype="http://schema.org/Organization">
			<?php
			if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
				the_custom_logo();
			}
			if ( is_front_page() ) {
				if ( $is_desktop ) {
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html( bloginfo( 'name' ) ); ?></a></h1>
				<?php } else { ?>
					<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html( bloginfo( 'name' ) ); ?></a></h2>
					<?php
				}
			} else {
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html( bloginfo( 'name' ) ); ?></a></p>
				<?php
			}
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) :
				?>
				<p class="site-description">
					<?php
					echo wp_kses_post( $description ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
					?>
				</p>
			<?php endif; ?>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'constructionn_header_topbar_office_location' ) ) :
	/**
	 * Header One Office location
	 */
	function constructionn_header_topbar_office_location() {
		$topbar_office   = get_theme_mod( 'topbar_office', __( 'Offices', 'constructionn' ) );
		$office_link     = get_theme_mod( 'office_link', '#' );
		$office_repeater = get_theme_mod(
			'office_repeater',
			array(
				array(
					'text' => esc_html__( 'Office One', 'constructionn' ),
					'url'  => '#',
				),

				array(
					'text' => esc_html__( 'Office Two', 'constructionn' ),
					'url'  => '#',
				),

				array(
					'text' => esc_html__( 'Office Three', 'constructionn' ),
					'url'  => '#',
				),
			)
		);
		if ( ( $topbar_office && $office_link ) || ! empty( $office_repeater ) ) {
			?>
		<ul>
			<li>
				<?php if ( $topbar_office && $office_link ) { ?>
					<a href="<?php echo esc_url( $office_link ); ?>"><?php echo esc_html( $topbar_office ); ?></a>
					<?php
				}
				if ( ! empty( $office_repeater ) ) {
					?>
					<ul>
						<?php
						foreach ( $office_repeater as $repeater ) {
							$office     = ( isset( $repeater['text'] ) && ! empty( $repeater['text'] ) ) ? $repeater['text'] : '';
							$office_url = ( isset( $repeater['url'] ) && ! empty( $repeater['url'] ) ) ? $repeater['url'] : '';
							if ( $office_url && $office ) {
								?>
								<li>
									<a href="<?php echo esc_url( $office_url ); ?>"><?php echo esc_html( $office ); ?></a>
								</li>
								<?php
							}
						}
						?>
					</ul>
				<?php } ?>
			</li>
		</ul>
			<?php
		} }
endif;

if ( ! function_exists( 'constructionn_front_header_one_request_quote' ) ) :
	/**
	 * Constructionn Front Header One Request a Quote
	 *
	 * @return void
	 */
	function constructionn_front_header_one_request_quote() {
		$header_quotes_txt  = get_theme_mod( 'quotes_txt', __( 'REQUEST A QUOTE', 'constructionn' ) );
		$header_quotes_link = get_theme_mod( 'quotes_link', '#' );

		if ( $header_quotes_txt && $header_quotes_link ) {
			?>
			<li class="quote-wrap">
				<?php if ( $header_quotes_txt && $header_quotes_link ) { ?>
					<a href="<?php echo esc_url( $header_quotes_link ); ?>" class="req-quote">
					<?php echo esc_html( $header_quotes_txt ); ?>
					</a>
					<?php
				}
				?>
			</li>
			<?php
		}
	}
endif;

if ( ! function_exists( 'constructionn_front_header_two_myaccount' ) ) :
	/**
	 * Constructionn Front Header Two My Account
	 *
	 * @return void
	 */
	function constructionn_front_header_two_myaccount() {
		$header_account_txt  = get_theme_mod( 'account_txt', __( 'MY ACCOUNT', 'constructionn' ) );
		$header_account_link = get_theme_mod( 'account_link', '#' );

		if ( $header_account_txt && $header_account_link ) {
			?>
			<li>
				<a href="<?php esc_url( $header_account_link ); ?>">
				<?php echo esc_html( $header_account_txt ); ?>
				</a>
			</li>
			<?php
		}
	}
endif;

if ( ! function_exists( 'constructionn_sidebar_layout' ) ) {
	/**
	 * Sidebar Layout
	 *
	 * @return void
	 */
	function constructionn_sidebar_layout() {
		$sidebar_layout = get_post_meta( get_the_ID(), 'constructionn_sidebar_layout', true );

		$default_layout = 'layout-two';

		if ( is_page() ) {
			$default_layout = get_theme_mod( 'single_page_layouts', 'layout-two' );
		}
		if ( is_single() ) {
			$default_layout = get_theme_mod( 'single_post_layouts', 'layout-two' );
		}

		if ( is_archive() || is_search() || is_home() ) {
			if ( is_author() ) {
				$default_layout = 'layout-two';
			} else {
				$default_layout = get_theme_mod( 'archive_page_layouts', 'layout-two' );
			}
		}

		if ( is_singular() ) {
			if ( isset( $sidebar_layout ) && ! empty( $sidebar_layout ) ) {
				if ( $sidebar_layout == 'default' ) {
					if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
						$layout = 'layout-two';
					} else {
						$layout = $default_layout;
					}
				} elseif ( $sidebar_layout == 'left-sidebar' ) {
					if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
						$layout = 'layout-two';
					} else {
						$layout = 'gl-left-wrap';
					}
				} elseif ( $sidebar_layout == 'right-sidebar' ) {
					if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
						$layout = 'layout-two';
					} else {
						$layout = 'gl-right-wrap';
					}
				} elseif ( $sidebar_layout == 'full-width' ) {
					if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
						$layout = 'layout-two';
					} else {
						$layout = 'layout-two';
					}
				} else {
					$layout = $default_layout;
				}
				return esc_attr( $layout );
			} elseif ( ! is_active_sidebar( 'primary-sidebar' ) ) {
					return esc_attr( 'layout-two' );
			} else {
				return $default_layout;
			}
		} else {
			if ( is_archive() || is_search() || is_home() ) {
				if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
					$layout = 'layout-two';
				} else {
					$layout = $default_layout;
				}
				return $layout;
			}
			return false;
		}
	}
}

if ( ! function_exists( 'constructionn_get_posts' ) ) :
	/**
	 * Fuction to list Custom Post Type
	 */
	function constructionn_get_posts( $post_type = 'post' ) {
		$args = array(
			'posts_per_page'   => -1,
			'post_type'        => $post_type,
			'post_status'      => 'publish',
			'suppress_filters' => true,
		);
		if ( $post_type === 'faq' ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'faq_category', // FAQ category taxonomy
					'field'    => 'term_id',
					'terms'    => get_terms(
						array(
							'taxonomy'   => 'faq_category',
							'hide_empty' => true, // Exclude empty categories
							'fields'     => 'ids', // Only return term IDs
						)
					),
					'operator' => 'IN',
				),
			);
		}
		$posts_array = get_posts( $args );

		// Initate an empty array
		$post_options     = array();
		$post_options[''] = __( '-- Choose --', 'constructionn' );
		if ( ! empty( $posts_array ) ) {
			foreach ( $posts_array as $posts ) {
				$post_options[ $posts->ID ] = $posts->post_title;
			}
		}
		return $post_options;
		wp_reset_postdata();
	}
endif;

if ( ! function_exists( 'constructionn_related_posts' ) ) :
	/**
	 * Related Posts
	 */
	function constructionn_related_posts( $post_type ) {
		global $post;

		$toggle_related_post = get_theme_mod( 'toggle_related_post', true );
		$title               = get_theme_mod( 'related_post_heading', __( 'Related Posts', 'constructionn' ) );
		$readmore            = get_theme_mod( 'post_readmore_button', __( 'Read More', 'constructionn' ) );
		$toggle_excerpt      = get_theme_mod( 'toggle_related_post_excerpt', true );
		$excerpt_length      = get_theme_mod( 'post_excerpt_length', '15' );

		$ed_posted_date = get_theme_mod( 'ed_single_posted_date', true );

		$args = array(
			'post_type'           => $post_type,
			'posts_status'        => 'publish',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => 2,
			'post__not_in'        => array( $post->ID ),
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() && $toggle_related_post ) {
			?>
			<div class="related-post">
				<div class="section-header">
					<?php if ( $title ) { ?>
						<h2 class="section-heading">
							<?php echo esc_html( $title ); ?>
						</h2>
					<?php } ?>
				</div>
				<div class="grid-layout-wrap">
					<div class="row">
						<?php
						while ( $query->have_posts() ) {
							$query->the_post();
							?>
							<article class="post">
								<div class="blog__card">
									<figure class="blog__img">
										<a href="<?php echo esc_url( get_permalink() ); ?>">
											<?php
											if ( has_post_thumbnail() ) {
												the_post_thumbnail( 'blog_card_image' );
											} else {
												constructionn_get_fallback_svg( 'blog_card_image' );
											}
											?>
										</a>
									</figure>
									<div class="blog__info">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
											<?php the_title(); ?>
										</a>
										<div class="blog__bottom">
											<div class="blog-category">
												<?php constructionn_category(); ?>
											</div>
											<?php
											if ( $ed_posted_date ) {
												constructionn_posted_on();
											}
											?>
										</div>
									</div>
								</div>
							</article>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php
			wp_reset_postdata();
		}
	}
endif;

if ( ! function_exists( 'constructionn_get_front_services_details' ) ) :
	/**
	 * Function to get Frontpage Service Section
	 *
	 * @param [type] $postid
	 * @return void
	 */
	function constructionn_get_front_services_details( $service_btn_txt, $postid = '' ) {
		$service_btn_txt = get_theme_mod( $service_btn_txt, __( 'View More', 'constructionn' ) );
		$args            = array(
			'post_type'   => 'service',
			'post_status' => 'publish',
		);
		if ( $postid ) {
			$args['p'] = $postid;

		} else {
			$args['post_per_pages'] = -1;
		}

		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				?>
				<div class="project">
					<div class="project-text">
						<h5 class="project-title"><?php the_title(); ?></h5>
							<?php
							if ( has_excerpt() ) {
								the_excerpt();
							} else {
								echo wpautop( wp_trim_words( get_the_content(), 15, '..' ) );
							}
							?>
					</div>
					<?php if ( $service_btn_txt ) { ?>
						<a href="<?php the_permalink(); ?>" class="btn btn__text has-icon">
							<?php echo esc_html( $service_btn_txt ); ?>
						</a>
						<?php
					}
					echo '</div>';
			}
			wp_reset_postdata();
		}
	}
endif;

if ( ! function_exists( 'constructionn_get_front_testimonial' ) ) :
	/**
	 * Our Testimonial custom post type
	 *
	 * @return void
	 */
	function constructionn_get_front_testimonial( $post_id = '' ) {
		$args = array(
			'post_type'   => 'testimonial',
			'post_status' => 'publish',
			'p'           => $post_id,
		);

		if ( $post_id ) {
			$args['p'] = $post_id;

		} else {
			$args['post_per_pages'] = -1;
		}

		$testimonial = new WP_Query( $args );

		if ( $testimonial->have_posts() ) {
			while ( $testimonial->have_posts() ) {
				$testimonial->the_post();
				$designation = get_post_meta( get_the_ID(), '_constructionn_designation', true );
				?>
				<div class="swiper-slide">
					<div class="client-review">
						<div class="message-wrapper">
							<?php
								$content = get_the_content();
							if ( ! empty( trim( $content ) ) ) {
								echo wpautop( $content );
							}
							?>
						</div>
						<div class="review-author">
							<span class="author-details">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'testimonial_img' );
								} else {
									constructionn_get_fallback_svg( 'testimonial_img' );
								}
								?>
								<span class="details-wrapper">
									<span class="author-name">
										<span class="byline">
											<span>
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</span>
										</span>
									</span>
									<?php if ( $designation ) { ?>
										<span class="author-signature">
											<span class="byline">
												<span>
													<a href="<?php the_permalink(); ?>"><?php echo esc_html( $designation ); ?></a>
												</span>
											</span>
										</span>
										<?php
									}
									?>
								</span>
							</span>
						</div>
					</div>
				</div>
				<?php
			}
		}
		?>
		<?php
	}
endif;

if ( ! function_exists( 'constructionn_get_front_history' ) ) :
	/**
	 * Get the History based on the choice choosen by the user
	 *
	 * @return void
	 */
	function constructionn_get_front_history( $post_id ) {

		if ( ! $post_id ) {
			return;
		}
		$args    = array(
			'post_type'   => 'history',
			'post_status' => 'publish',
			'p'           => $post_id,
		);
		$history = new WP_Query( $args );

		if ( $history->have_posts() ) {
			while ( $history->have_posts() ) {
				$history->the_post();
				$custom_month = get_post_meta( get_the_ID(), '_custom_month_meta_key', true );
				$custom_year  = get_post_meta( get_the_ID(), '_custom_year_meta_key', true );

				if ( ! empty( $custom_month ) || ! empty( $custom_year ) ) {
					?>
					<time class="history__date">
						<?php echo esc_html( $custom_month ); ?><br>
						<span><?php echo esc_html( $custom_year ); ?></span>
					</time>
				<?php } ?>
				<div class="history__content">
					<div class="history__title">
						<a href="<?php the_permalink(); ?>">
							<h3><?php the_title(); ?></h3>
						</a>
					</div>
					<?php
					if ( has_excerpt() ) {
						echo '<div class="history__text">';
						the_excerpt();
						echo '</div>';
					} else {
						echo '<div class="history__text">';
						echo wpautop( wp_trim_words( get_the_content(), 15 ) );
						echo '</div>';
					}
					?>
				</div>
				<?php
			}
		}
	}
endif;

if ( ! function_exists( 'constructionn_get_front_casestudy' ) ) :
	/**
	 * Case Study custom post type
	 *
	 * @return void
	 */
	function constructionn_get_front_casestudy( $post_id, $counter ) {
		if ( ! $post_id ) {
			return;
		}

		$casestd_cpt_btn_txt = get_theme_mod( 'casestudies_cpt_btn_text', __( 'Read More', 'constructionn' ) );
		$args                = array(
			'post_type'   => 'case-study',
			'post_status' => 'publish',
			'p'           => $post_id,
		);

		$case_study = new WP_Query( $args );

		if ( $case_study->have_posts() ) {
			while ( $case_study->have_posts() ) {
				$case_study->the_post();
				$categories = get_the_terms( get_the_ID(), 'casestudy_category' ); // Use the custom taxonomy
				?>
				<div class="case__studies-card <?php echo ! ( $counter == 1 ) ? 'is-vertical' : ''; ?>">
					<div class="case__studies-img">
						<?php
						if ( has_post_thumbnail() && ( $counter == 1 ) ) {
							the_post_thumbnail( 'casestudy_img' );
						}
						?>
					</div>
					<div class="case__studies-content">
						<span class="case__studies-tags">
							<?php
							if ( ! empty( $categories ) ) {
								foreach ( $categories as $category ) {
									$category_url = get_term_link( $category );
									echo '<a href="' . esc_url( $category_url ) . '">' . esc_html( $category->name ) . '</a> ';
								}
							}
							?>
						</span>
						<h3 class="case__studies-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php if ( $counter == 1 ) { ?>
							<div class="case__studies-description">
								<?php
								if ( has_excerpt() ) {
									the_excerpt();
								} else {
									echo wpautop( wp_trim_words( get_the_content(), 15 ) );
								}
								?>
							</div>
						<?php } ?>
						<a href="<?php the_permalink(); ?>" class="btn btn-readmore"><?php echo esc_html( $casestd_cpt_btn_txt ); ?></a>
					</div>
				</div>
				<?php
			}
			wp_reset_postdata();
		}
	}
endif;

if ( ! function_exists( 'constructionn_get_front_project' ) ) :
	/**
	 * Project custom post type
	 *
	 * @return void
	 */
	function constructionn_get_front_project( $post_id = '' ) {

		$args = array(
			'post_type'   => 'project',
			'post_status' => 'publish',
			'p'           => $post_id,
		);

		if ( $post_id ) {
			$args['p'] = $post_id;

		} else {
			$args['post_per_pages'] = -1;
		}

		$project = new WP_Query( $args );

		if ( $project->have_posts() ) {
			while ( $project->have_posts() ) {
				$project->the_post();
				$categories = get_the_terms( get_the_ID(), 'project_category' ); // Use the custom taxonomy
				?>
				<div class="swiper-slide">
					<article class="post">
						<div class="blog__card">
							<figure class="blog__img">
								<a href="<?php the_permalink(); ?>">
									<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'custom_medium_img' );
									} else {
										constructionn_get_fallback_svg( 'custom_medium_img' );
									}
									?>
								</a>
							</figure>
							<div class="blog__info">
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
								<div class="blog__bottom">
									<div class="blog-category">
										<span class="category-list">
											<?php
											if ( ! empty( $categories ) ) {
												foreach ( $categories as $category ) {
													$category_url = get_term_link( $category );
													echo '<a href="' . esc_url( $category_url ) . '">' . esc_html( $category->name ) . '</a> ';
												}
											}
											?>
										</span> 
									</div>
								</div>
							</div>
						</div>
					</article>
				</div>
				<?php
			}
			wp_reset_postdata();
		}
	}
endif;

// faq start
if ( ! function_exists( 'constructionn_get_front_faq' ) ) :
	/**
	 * Faq custom post type
	 *
	 * @return void
	 */
	function constructionn_get_front_faq( $post_id = '' ) {

		if ( $post_id ) {
			$args['p'] = $post_id;

		} else {
			$args['post_per_pages'] = -1;
		}

		// Get FAQ categories from the registered 'faq_category' taxonomy
		$faq_categories = get_terms(
			array(
				'taxonomy'   => 'faq_category',
				'hide_empty' => false,
			)
		);

		if ( ! empty( $faq_categories ) && ! is_wp_error( $faq_categories ) ) :
			?>
<div class="faq-wrapper">
	<div class="tab-wrapper">
		<div class="tab-btn-wrap">
			<div class="btn-wrapper">
						<?php
						// Create dynamic tab buttons for each category
						$first = true;
						foreach ( $faq_categories as $category ) :
							?>
					<button data-id="<?php echo esc_attr( $category->slug ); ?>" 
							class="tab-btn <?php echo $first ? 'active' : ''; ?>">
								<?php echo esc_html( $category->name ); ?>
					</button>
							<?php
							$first = false;
						endforeach;
						?>
			</div>
		</div>
		<div class="tab-content-wrap">
					<?php
					// Create dynamic tab content for each category
					$first = true;
					foreach ( $faq_categories as $category ) :
						?>
				<div data-id="<?php echo esc_attr( $category->slug ); ?>" 
					class="tab-content <?php echo $first ? 'active' : ''; ?>">
					<div class="content-wrapper">
						<h4 class="title"><?php echo esc_html( $category->name ); ?></h4>
						<div class="accordion">
									<?php
									// Fetch FAQs related to this category
									$faq_posts = new WP_Query(
										array(
											'post_type'   => 'faq',
											'tax_query'   => array(
												array(
													'taxonomy' => 'faq_category',
													'field'    => 'slug',
													'terms'    => $category->slug,
												),
											),
											'post_status' => 'publish',
											'p'           => $post_id,
										)
									);

									if ( $faq_posts->have_posts() ) :
										while ( $faq_posts->have_posts() ) :
											$faq_posts->the_post();
											?>
								<div class="accordion-item">
									<button class="accordion-button">
										<p><?php the_title(); ?></p>
									</button>
									<div class="accordion-content">
												<?php the_content(); ?>
									</div>
								</div>
											<?php
										endwhile;
										wp_reset_postdata();
									else :
										?>
								<p><?php _e( 'No FAQs available in this category.', 'constructionn' ); ?></p>
										<?php
									endif;
									?>
						</div>
					</div>
				</div>
						<?php
						$first = false;
					endforeach;
					?>
		</div>
	</div>
</div>
			<?php
endif;
	}
endif;

// faq end

if ( ! function_exists( 'constructionn_handle_all_svgs' ) ) :
	/**
	 * Lists all the svg
	 *
	 * @param [type] $svg
	 * @return void
	 */
	function constructionn_handle_all_svgs( $svg ) {
		switch ( $svg ) {

			case 'contact-cta':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
					<path d="M5.07708 8.11771C6.12708 10.1813 7.81875 11.8656 9.88229 12.9229L11.4865 11.3188C11.6833 11.1219 11.975 11.0562 12.2302 11.1438C13.0469 11.4135 13.9292 11.5594 14.8333 11.5594C15.2344 11.5594 15.5625 11.8875 15.5625 12.2885V14.8333C15.5625 15.2344 15.2344 15.5625 14.8333 15.5625C7.98646 15.5625 2.4375 10.0135 2.4375 3.16667C2.4375 2.76562 2.76562 2.4375 3.16667 2.4375H5.71875C6.11979 2.4375 6.44792 2.76562 6.44792 3.16667C6.44792 4.07812 6.59375 4.95313 6.86354 5.76979C6.94375 6.025 6.88542 6.30938 6.68125 6.51354L5.07708 8.11771Z" fill="#0A204E"/>
				</svg>';
			break;

			case 'banner-two-contact':
				return '<svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M5.86128 8.56921C6.96897 10.7461 8.75358 12.5231 10.9305 13.6384L12.6228 11.9461C12.8305 11.7384 13.1382 11.6692 13.4074 11.7615C14.269 12.0461 15.1997 12.2 16.1536 12.2C16.5767 12.2 16.9228 12.5461 16.9228 12.9692V15.6538C16.9228 16.0769 16.5767 16.4231 16.1536 16.4231C8.93051 16.4231 3.07666 10.5692 3.07666 3.34614C3.07666 2.92306 3.42281 2.5769 3.84589 2.5769H6.5382C6.96128 2.5769 7.30743 2.92306 7.30743 3.34614C7.30743 4.30767 7.46128 5.23075 7.74589 6.09229C7.83051 6.36152 7.76897 6.66152 7.55358 6.8769L5.86128 8.56921Z" fill="white"/>
				</svg>';
				break;
			case 'banner-video':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 80 80" fill="none">											
					<path fill-rule="evenodd" clip-rule="evenodd" d="M40 73.9999C58.7777 73.9999 74 58.7776 74 39.9999C74 21.2222 58.7777 5.99991 40 5.99991C21.2223 5.99991 6 21.2222 6 39.9999C6 58.7776 21.2223 73.9999 40 73.9999ZM48.8091 39.7165C48.8091 38.9772 48.4169 38.291 47.7723 37.9014L34.7919 30.1115C34.4639 29.9147 34.0884 29.8072 33.7041 29.8001C33.3198 29.7931 32.9405 29.8866 32.6053 30.0712C32.27 30.2559 31.991 30.525 31.7967 30.8508C31.6025 31.1766 31.5001 31.5473 31.5 31.9248V47.5081C31.4998 47.8859 31.6021 48.2569 31.7964 48.5829C31.9906 48.9089 32.2698 49.1782 32.6053 49.3631C33.2877 49.7394 34.1239 49.7217 34.7919 49.2834L47.7723 41.4917C48.4169 41.142 48.8091 40.4558 48.8091 39.7165Z" fill="#141414" />
				</svg>';
				break;

			case 'alert':
				return '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="exclamation"><g id="Group"><path id="Vector" d="M10 18.75C7.67936 18.75 5.45376 17.8281 3.81282 16.1872C2.17187 14.5462 1.25 12.3206 1.25 10C1.25 7.67936 2.17187 5.45376 3.81282 3.81282C5.45376 2.17187 7.67936 1.25 10 1.25C12.3206 1.25 14.5462 2.17187 16.1872 3.81282C17.8281 5.45376 18.75 7.67936 18.75 10C18.75 12.3206 17.8281 14.5462 16.1872 16.1872C14.5462 17.8281 12.3206 18.75 10 18.75ZM10 20C12.6522 20 15.1957 18.9464 17.0711 17.0711C18.9464 15.1957 20 12.6522 20 10C20 7.34784 18.9464 4.8043 17.0711 2.92893C15.1957 1.05357 12.6522 0 10 0C7.34784 0 4.8043 1.05357 2.92893 2.92893C1.05357 4.8043 0 7.34784 0 10C0 12.6522 1.05357 15.1957 2.92893 17.0711C4.8043 18.9464 7.34784 20 10 20Z"fill="currentColor" /><path id="Vector_2"d="M8.75244 13.75C8.75244 13.5858 8.78477 13.4233 8.84759 13.2716C8.91041 13.12 9.00248 12.9822 9.11856 12.8661C9.23463 12.75 9.37243 12.658 9.52409 12.5952C9.67574 12.5323 9.83829 12.5 10.0024 12.5C10.1666 12.5 10.3291 12.5323 10.4808 12.5952C10.6325 12.658 10.7703 12.75 10.8863 12.8661C11.0024 12.9822 11.0945 13.12 11.1573 13.2716C11.2201 13.4233 11.2524 13.5858 11.2524 13.75C11.2524 14.0815 11.1207 14.3995 10.8863 14.6339C10.6519 14.8683 10.334 15 10.0024 15C9.67092 15 9.35298 14.8683 9.11856 14.6339C8.88414 14.3995 8.75244 14.0815 8.75244 13.75ZM8.87494 6.24375C8.8583 6.08605 8.87499 5.92662 8.92394 5.77579C8.97289 5.62496 9.05301 5.4861 9.15909 5.36824C9.26517 5.25037 9.39485 5.15612 9.53971 5.0916C9.68456 5.02709 9.84137 4.99375 9.99994 4.99375C10.1585 4.99375 10.3153 5.02709 10.4602 5.0916C10.605 5.15612 10.7347 5.25037 10.8408 5.36824C10.9469 5.4861 11.027 5.62496 11.0759 5.77579C11.1249 5.92662 11.1416 6.08605 11.1249 6.24375L10.6874 10.6275C10.6727 10.7997 10.5939 10.9601 10.4666 11.077C10.3393 11.194 10.1728 11.2588 9.99994 11.2588C9.8271 11.2588 9.66055 11.194 9.53325 11.077C9.40594 10.9601 9.32714 10.7997 9.31244 10.6275L8.87494 6.24375Z" fill="currentColor" /></g></g></svg>';
				break;

			case 'facebook':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none"><path
				d    = "M5.55448 12.8333H8.01062V7.91491H10.2236L10.4668 5.47105H8.01062V4.23684C8.01062 4.07399 8.07531 3.91781 8.19047 3.80265C8.30562 3.6875 8.4618 3.62281 8.62466 3.62281H10.4668V1.16667H8.62466C7.81039 1.16667 7.02948 1.49013 6.45371 2.0659C5.87794 2.64167 5.55448 3.42258 5.55448 4.23684V5.47105H4.32641L4.08325 7.91491H5.55448V12.8333Z"
				fill = "currentColor" />
			</svg>';
				break;

			case 'instagram':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
			<path
				d    = "M7.00008 1.16667C8.585 1.16667 8.78275 1.1725 9.40458 1.20167C10.0258 1.23083 10.4487 1.32825 10.8209 1.47292C11.2059 1.62108 11.5302 1.82175 11.8546 2.1455C12.1512 2.43711 12.3807 2.78984 12.5272 3.17917C12.6712 3.55075 12.7692 3.97425 12.7984 4.5955C12.8258 5.21733 12.8334 5.41508 12.8334 7C12.8334 8.58492 12.8276 8.78267 12.7984 9.4045C12.7692 10.0257 12.6712 10.4487 12.5272 10.8208C12.3811 11.2104 12.1516 11.5632 11.8546 11.8545C11.5629 12.151 11.2102 12.3805 10.8209 12.5271C10.4493 12.6712 10.0258 12.7692 9.40458 12.7983C8.78275 12.8257 8.585 12.8333 7.00008 12.8333C5.41516 12.8333 5.21741 12.8275 4.59558 12.7983C3.97433 12.7692 3.55141 12.6712 3.17925 12.5271C2.78977 12.3809 2.43697 12.1514 2.14558 11.8545C1.8489 11.5629 1.61937 11.2102 1.473 10.8208C1.32833 10.4492 1.23091 10.0257 1.20175 9.4045C1.17433 8.78267 1.16675 8.58492 1.16675 7C1.16675 5.41508 1.17258 5.21733 1.20175 4.5955C1.23091 3.97367 1.32833 3.55133 1.473 3.17917C1.61897 2.7896 1.84855 2.43677 2.14558 2.1455C2.43706 1.84872 2.78983 1.61918 3.17925 1.47292C3.55141 1.32825 3.97375 1.23083 4.59558 1.20167C5.21741 1.17425 5.41516 1.16667 7.00008 1.16667ZM7.00008 4.08333C6.22653 4.08333 5.48467 4.39062 4.93769 4.9376C4.39071 5.48459 4.08341 6.22645 4.08341 7C4.08341 7.77355 4.39071 8.51541 4.93769 9.06239C5.48467 9.60938 6.22653 9.91667 7.00008 9.91667C7.77363 9.91667 8.51549 9.60938 9.06248 9.06239C9.60946 8.51541 9.91675 7.77355 9.91675 7C9.91675 6.22645 9.60946 5.48459 9.06248 4.9376C8.51549 4.39062 7.77363 4.08333 7.00008 4.08333ZM10.7917 3.9375C10.7917 3.74411 10.7149 3.55865 10.5782 3.4219C10.4414 3.28516 10.256 3.20833 10.0626 3.20833C9.86919 3.20833 9.68373 3.28516 9.54698 3.4219C9.41024 3.55865 9.33341 3.74411 9.33341 3.9375C9.33341 4.13089 9.41024 4.31635 9.54698 4.4531C9.68373 4.58984 9.86919 4.66667 10.0626 4.66667C10.256 4.66667 10.4414 4.58984 10.5782 4.4531C10.7149 4.31635 10.7917 4.13089 10.7917 3.9375ZM7.00008 5.25C7.46421 5.25 7.90933 5.43437 8.23752 5.76256C8.56571 6.09075 8.75008 6.53587 8.75008 7C8.75008 7.46413 8.56571 7.90925 8.23752 8.23744C7.90933 8.56563 7.46421 8.75 7.00008 8.75C6.53595 8.75 6.09083 8.56563 5.76264 8.23744C5.43446 7.90925 5.25008 7.46413 5.25008 7C5.25008 6.53587 5.43446 6.09075 5.76264 5.76256C6.09083 5.43437 6.53595 5.25 7.00008 5.25Z"
				fill = "currentColor" />
			</svg>';
				break;

			case 'WordPress':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M7.00008 1.16667C3.78591 1.16667 1.16675 3.78583 1.16675 7C1.16675 10.2142 3.78591 12.8333 7.00008 12.8333C10.2142 12.8333 12.8334 10.2142 12.8334 7C12.8334 3.78583 10.2142 1.16667 7.00008 1.16667ZM1.75591 7C1.75591 6.24167 1.91925 5.51833 2.21091 4.865L4.71341 11.7192C2.96341 10.8675 1.75591 9.07667 1.75591 7ZM7.00008 12.2442C6.48675 12.2442 5.99091 12.1683 5.51841 12.0283L7.09341 7.455L8.70341 11.8708C8.71508 11.8942 8.72675 11.9233 8.73841 11.9408C8.19591 12.1392 7.61258 12.2442 7.00008 12.2442ZM7.72341 4.53833C8.03841 4.52083 8.32425 4.48583 8.32425 4.48583C8.60425 4.45083 8.57508 4.03667 8.28925 4.05417C8.28925 4.05417 7.43758 4.11833 6.88925 4.11833C6.37591 4.11833 5.50675 4.05417 5.50675 4.05417C5.22675 4.0425 5.19175 4.47417 5.47758 4.49167C5.47758 4.49167 5.74591 4.52667 6.02591 4.54417L6.84258 6.78417L5.69341 10.2258L3.78591 4.53833C4.10091 4.52667 4.38675 4.49167 4.38675 4.49167C4.66675 4.45667 4.63758 4.0425 4.35175 4.06C4.35175 4.06 3.50008 4.12417 2.95175 4.12417C2.85258 4.12417 2.73591 4.12417 2.61341 4.11833C3.55841 2.695 5.16841 1.75583 7.00008 1.75583C8.36508 1.75583 9.60758 2.275 10.5409 3.1325C10.5176 3.1325 10.4942 3.12667 10.4709 3.12667C9.95758 3.12667 9.59008 3.57583 9.59008 4.06C9.59008 4.49167 9.84091 4.85917 10.1034 5.29083C10.3017 5.64083 10.5351 6.09 10.5351 6.7375C10.5351 7.18667 10.3601 7.70583 10.1384 8.435L9.61341 10.185L7.72341 4.53833ZM11.6026 4.48583C12.2578 5.68495 12.419 7.09249 12.0518 8.40869C11.6846 9.72488 10.8181 10.8457 9.63675 11.5325L11.2409 6.90083C11.5384 6.15417 11.6376 5.55333 11.6376 5.0225C11.6376 4.83 11.6259 4.64917 11.6026 4.48583Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'twitter':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M13.1018 3.5C12.6526 3.70417 12.1684 3.83834 11.6668 3.9025C12.1801 3.59334 12.5768 3.10334 12.7634 2.51417C12.2793 2.80584 11.7426 3.01 11.1768 3.12667C10.7159 2.625 10.0684 2.33334 9.33344 2.33334C7.9626 2.33334 6.8426 3.45334 6.8426 4.83584C6.8426 5.03417 6.86594 5.22667 6.90677 5.4075C4.8301 5.3025 2.98094 4.305 1.7501 2.79417C1.53427 3.16167 1.41177 3.59334 1.41177 4.04834C1.41177 4.9175 1.84927 5.6875 2.52594 6.125C2.11177 6.125 1.72677 6.00834 1.38844 5.83334V5.85084C1.38844 7.06417 2.25177 8.07917 3.3951 8.30667C3.02803 8.40712 2.64266 8.4211 2.26927 8.3475C2.42771 8.84478 2.738 9.27991 3.15653 9.59171C3.57506 9.90352 4.08078 10.0763 4.6026 10.0858C3.71805 10.7861 2.6216 11.1646 1.49344 11.1592C1.2951 11.1592 1.09677 11.1475 0.898438 11.1242C2.00677 11.8358 3.3251 12.25 4.73677 12.25C9.33344 12.25 11.8593 8.435 11.8593 5.1275C11.8593 5.01667 11.8593 4.91167 11.8534 4.80084C12.3434 4.45084 12.7634 4.0075 13.1018 3.5Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'digg':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M3.23641 2.6285V4.67017H1.16675V8.7535H4.40075V2.6285H3.23641ZM2.33108 7.73267V5.691H3.23641V7.73267H2.33108ZM4.65975 4.67017H5.82408V8.7535H4.65975V4.67017ZM4.65975 2.6285H5.82408V3.77708H4.65975V2.62792V2.6285ZM9.446 4.67017H6.3415V8.7535H8.28166V9.64658H6.3415V10.7952H9.446V4.67017ZM7.50583 7.73267V5.691H8.28166V7.73267H7.50583ZM12.8095 4.67017H9.705V8.7535H11.7747V9.64658H9.705V10.7952H12.8095V4.67017ZM11.7747 7.73267H10.8693V5.691H11.7747V7.73267Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'telegram':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule = "evenodd" clip-rule = "evenodd" d = "M11.5365 2.58417C11.6806 2.52349 11.8384 2.50257 11.9934 2.52357C12.1484 2.54457 12.2949 2.60672 12.4177 2.70357C12.5405 2.80041 12.6351 2.9284 12.6917 3.07421C12.7482 3.22003 12.7647 3.37834 12.7393 3.53267L11.4163 11.5576C11.288 12.3317 10.4386 12.7756 9.72871 12.39C9.13488 12.0674 8.25288 11.5704 7.45955 11.0518C7.06288 10.7922 5.8478 9.961 5.99713 9.3695C6.12546 8.86375 8.16713 6.96325 9.3338 5.83333C9.79171 5.38942 9.58288 5.13333 9.04213 5.54167C7.6993 6.5555 5.5433 8.09725 4.83046 8.53125C4.20163 8.91392 3.8738 8.97925 3.4818 8.91392C2.76663 8.79492 2.10338 8.61058 1.56205 8.386C0.830546 8.08267 0.866129 7.077 1.56146 6.78417L11.5365 2.58417Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'getpocket':
				return '<svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M11.1453 1.75H1.11016C0.505859 1.75 0 2.25586 0 2.86016V6.55703C0 9.9668 2.72617 12.6875 6.13047 12.6875C9.52109 12.6875 12.25 9.9668 12.25 6.55703V2.86016C12.25 2.24766 11.766 1.75 11.1453 1.75ZM6.71563 9.0918C6.37656 9.41445 5.85703 9.39531 5.55625 9.0918C2.44727 6.11406 2.41445 6.21797 2.41445 5.72305C2.41445 5.26094 2.7918 4.88359 3.25391 4.88359C3.71875 4.88359 3.69414 4.9875 6.13047 7.32539C8.60781 4.94922 8.55313 4.88359 9.01523 4.88359C9.47734 4.88359 9.85469 5.26094 9.85469 5.72305C9.85469 6.20977 9.77539 6.15234 6.71563 9.0918Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'unsplash':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M4.95882 6.41667V9.33333H9.04215V6.41667H12.2505V12.25H1.75049V6.41667H4.95882ZM9.04215 1.75V4.66667H4.95882V1.75H9.04215Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'dribbble':
				return '<svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
					<mask id = "mask0_1986_9502" style                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                = "mask-type:luminance" maskUnits = "userSpaceOnUse" x       = "0" y                    = "0" width               = "13" height = "13">
					<path d  = "M12.1666 6.5C12.1675 7.21346 12.027 7.92003 11.7533 8.57888C11.4795 9.23773 11.0779 9.83579 10.5717 10.3385C10.0695 10.8397 9.47358 11.2371 8.81783 11.5079C8.16208 11.7787 7.45939 11.9176 6.74992 11.9167C3.7583 11.9167 1.33326 9.49162 1.33326 6.5C1.33136 5.1111 1.86487 3.77492 2.82284 2.76927C3.32831 2.23589 3.9373 1.81126 4.61254 1.52137C5.28779 1.23148 6.01508 1.08243 6.74992 1.08333C7.45939 1.08241 8.16208 1.22132 8.81783 1.4921C9.47358 1.76289 10.0695 2.16025 10.5717 2.66148C11.0779 3.16421 11.4795 3.76227 11.7533 4.42112C12.027 5.07997 12.1675 5.78654 12.1666 6.5Z" fill = "white" stroke                  = "white" stroke-width     = "1.16667" stroke-linecap = "round" stroke-linejoin = "round"/>
					<path d  = "M12.1666 6.5C11.3763 6.5 9.19608 6.20208 7.24473 7.05873C5.12491 7.98958 3.5901 9.43367 2.92114 10.3315" stroke                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       = "black" stroke-width            = "1.16667" stroke-linecap = "round" stroke-linejoin  = "round"/>
					<path d  = "M4.71875 1.47712C5.56646 2.25956 7.41625 4.25154 8.10417 6.22916C8.79208 8.20679 9.04667 10.6383 9.20375 11.3303" stroke                                                                                                                                                                                                                                                                                                                                                                                                                                                                              = "black" stroke-width            = "1.16667" stroke-linecap = "round" stroke-linejoin  = "round"/>
					<path d  = "M1.375 5.82292C2.39821 5.88467 5.10681 5.94019 6.84015 5.2C8.57348 4.45981 10.065 3.09833 10.5766 2.66636" stroke                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     = "black" stroke-width            = "1.16667" stroke-linecap = "round" stroke-linejoin  = "round"/>
					<path d  = "M1.73951 8.56185C2.2168 9.7172 3.07761 10.6728 4.17701 11.2677M1.33326 6.5C1.33136 5.1111 1.86487 3.77492 2.82284 2.76927C3.32831 2.23589 3.9373 1.81126 4.61254 1.52137C5.28779 1.23148 6.01508 1.08243 6.74992 1.08333M8.91659 1.534C9.53345 1.80389 10.0947 2.18623 10.5717 2.66148C11.0779 3.16421 11.4795 3.76227 11.7533 4.42112C12.027 5.07997 12.1675 5.78654 12.1666 6.5C12.1666 7.16679 12.0461 7.80569 11.8253 8.39583M6.74992 11.9167C7.45939 11.9176 8.16208 11.7787 8.81783 11.5079C9.47358 11.2371 10.0695 10.8397 10.5717 10.3385" stroke                                             = "white" stroke-width            = "1.16667" stroke-linecap = "round" stroke-linejoin  = "round"/>
					</mask>
					<g    mask = "url(#mask0_1986_9502)">
					<path d    = "M0.25 0H13.25V13H0.25V0Z" fill = "currentColor"/>
					</g>
					</svg>';
				break;

			case 'behance':
				return '<svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M4.59167 3.12083C4.96442 3.12083 5.30917 3.15 5.62417 3.23633C5.93975 3.29408 6.19817 3.40958 6.42742 3.55367C6.65725 3.69775 6.82934 3.90017 6.94367 4.15975C7.05859 4.41933 7.11634 4.73725 7.11634 5.08317C7.11634 5.48742 7.03 5.83333 6.82934 6.09292C6.65725 6.35308 6.37025 6.5835 6.02609 6.75675C6.51375 6.90142 6.8865 7.161 7.11634 7.50692C7.34559 7.85342 7.48908 8.28625 7.48908 8.77683C7.48908 9.18108 7.40275 9.527 7.25925 9.81575C7.11633 10.1045 6.8865 10.3641 6.62809 10.5373C6.34738 10.723 6.03708 10.8596 5.7105 10.941C5.36634 11.0279 5.02217 11.0857 4.678 11.0857H0.833252V3.12083H4.59167ZM4.36184 6.3525C4.67742 6.3525 4.93584 6.26617 5.1365 6.12208C5.33717 5.978 5.4235 5.71783 5.4235 5.4005C5.4235 5.22725 5.39433 5.054 5.33717 4.93908C5.28 4.82358 5.19367 4.73667 5.07934 4.65033C4.96238 4.58479 4.83667 4.53627 4.706 4.50625C4.5625 4.47708 4.41959 4.47708 4.24692 4.47708H2.58325V6.35308L4.36184 6.3525ZM4.44817 9.758C4.62025 9.758 4.79234 9.72883 4.93584 9.70025C5.07934 9.67108 5.22283 9.61392 5.33717 9.527C5.45406 9.44255 5.55185 9.33443 5.62417 9.20967C5.68134 9.06558 5.73909 8.89233 5.73909 8.6905C5.73909 8.28625 5.62417 7.9975 5.39492 7.79567C5.16508 7.62242 4.8495 7.53608 4.47675 7.53608H2.58325V9.75858L4.44817 9.758ZM9.98517 9.72883C10.2144 9.95983 10.5586 10.0753 11.0177 10.0753C11.3333 10.0753 11.6203 9.989 11.8495 9.84492C12.0793 9.67167 12.2228 9.49842 12.28 9.32517H13.6858C13.456 10.0176 13.1118 10.5082 12.6533 10.8255C12.1937 11.1143 11.6488 11.2875 10.9891 11.2875C10.567 11.2888 10.1484 11.2104 9.75534 11.0565C9.40164 10.9239 9.08623 10.7058 8.83717 10.4218C8.57076 10.1562 8.37383 9.82902 8.26375 9.46925C8.12025 9.09417 8.0625 8.6905 8.0625 8.2285C8.0625 7.79567 8.12025 7.392 8.26375 7.01633C8.4019 6.65467 8.60625 6.32194 8.86633 6.03517C9.12417 5.77558 9.43975 5.54517 9.78392 5.4005C10.167 5.24654 10.5762 5.1681 10.9891 5.1695C11.4768 5.1695 11.9073 5.25642 12.28 5.45825C12.6533 5.66008 12.9398 5.89108 13.169 6.23758C13.3988 6.55492 13.5715 6.93 13.6858 7.33425C13.743 7.73792 13.7716 8.14217 13.743 8.60358H9.58325C9.58325 9.06558 9.75533 9.49842 9.98517 9.72942M11.7923 6.69958C11.5917 6.49775 11.2761 6.38225 10.9028 6.38225C10.6839 6.37897 10.4674 6.42839 10.2716 6.52633C10.0995 6.61325 9.98517 6.72875 9.87025 6.84425C9.76465 6.95582 9.69478 7.09638 9.66959 7.24792C9.64042 7.39258 9.61183 7.5075 9.61183 7.623H12.1937C12.1365 7.19017 11.993 6.902 11.7923 6.69958ZM9.26767 3.66917H12.4807V4.4485H9.26825L9.26767 3.66917Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'mastodon':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M12.2151 8.16666C12.0518 8.98916 10.7918 9.89333 9.31595 10.0683C8.55178 10.1558 7.79928 10.2433 7.00012 10.2083C5.68762 10.1442 4.66678 9.89333 4.66678 9.89333V10.255C4.85345 11.55 5.96178 11.6258 7.01762 11.6667C8.07928 11.6958 9.02428 11.3983 9.02428 11.3983L9.07095 12.3608C9.07095 12.3608 8.32428 12.7575 7.00012 12.8333C6.27095 12.8742 5.36095 12.8158 4.30512 12.5417C2.01845 11.9292 1.62178 9.485 1.56345 7L1.55762 4.99916C1.55762 2.4675 3.20845 1.72666 3.20845 1.72666C4.05428 1.34166 5.48928 1.16666 6.98262 1.16666H7.01762C8.51095 1.16666 9.94595 1.34166 10.7918 1.72666C10.7918 1.72666 12.4426 2.4675 12.4426 4.99916C12.4426 4.99916 12.466 6.87166 12.2151 8.16666ZM10.5001 5.1975C10.5001 4.5675 10.3251 4.08333 10.0043 3.70416C9.67762 3.33666 9.24595 3.14416 8.70345 3.14416C8.08512 3.14416 7.61262 3.38333 7.29178 3.86166L7.00012 4.375L6.70845 3.86166C6.38178 3.38333 5.91512 3.14416 5.29095 3.14416C4.75428 3.14416 4.32262 3.33666 3.99012 3.70416C3.66928 4.08333 3.50012 4.5675 3.50012 5.1975V8.26583H4.72512V5.285C4.72512 4.66666 4.98762 4.34 5.51845 4.34C6.10178 4.34 6.39345 4.71916 6.39345 5.46583V7.09333H7.60095V5.46583C7.60095 4.71916 7.89262 4.34 8.48178 4.34C9.00678 4.34 9.26928 4.66666 9.26928 5.285V8.26583H10.5001V5.1975Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'medium':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M4.66675 3.5C5.59501 3.5 6.48524 3.86875 7.14162 4.52513C7.798 5.1815 8.16675 6.07174 8.16675 7C8.16675 7.92826 7.798 8.8185 7.14162 9.47487C6.48524 10.1313 5.59501 10.5 4.66675 10.5C3.73849 10.5 2.84825 10.1313 2.19187 9.47487C1.5355 8.8185 1.16675 7.92826 1.16675 7C1.16675 6.07174 1.5355 5.1815 2.19187 4.52513C2.84825 3.86875 3.73849 3.5 4.66675 3.5ZM9.91675 4.08333C10.7917 4.08333 11.3751 5.38942 11.3751 7C11.3751 8.61058 10.7917 9.91667 9.91675 9.91667C9.04175 9.91667 8.45841 8.61058 8.45841 7C8.45841 5.38942 9.04175 4.08333 9.91675 4.08333ZM12.2501 4.375C12.4717 4.375 12.6654 4.85742 12.7634 5.68517L12.7908 5.94358L12.8019 6.08067L12.8194 6.36883L12.8252 6.51992L12.8322 6.8355L12.8334 7L12.8322 7.1645L12.8252 7.48008L12.8194 7.63175L12.8019 7.91933L12.7902 8.05642L12.764 8.31483C12.6654 9.14317 12.4723 9.625 12.2501 9.625C12.0284 9.625 11.8347 9.14258 11.7367 8.31483L11.7093 8.05642C11.7053 8.01075 11.7016 7.96505 11.6982 7.91933L11.6807 7.63117C11.6785 7.58082 11.6765 7.53046 11.6749 7.48008L11.6679 7.1645V6.8355L11.6749 6.51992L11.6807 6.36825L11.6982 6.08067L11.7099 5.94358L11.7362 5.68517C11.8347 4.85683 12.0278 4.375 12.2501 4.375Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'slack':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M3.50008 8.75C3.50008 9.05942 3.37717 9.35616 3.15837 9.57496C2.93958 9.79375 2.64283 9.91667 2.33341 9.91667C2.024 9.91667 1.72725 9.79375 1.50846 9.57496C1.28966 9.35616 1.16675 9.05942 1.16675 8.75C1.16675 8.44058 1.28966 8.14383 1.50846 7.92504C1.72725 7.70625 2.024 7.58333 2.33341 7.58333H3.50008V8.75ZM4.08341 8.75C4.08341 8.44058 4.20633 8.14383 4.42512 7.92504C4.64392 7.70625 4.94066 7.58333 5.25008 7.58333C5.5595 7.58333 5.85625 7.70625 6.07504 7.92504C6.29383 8.14383 6.41675 8.44058 6.41675 8.75V11.6667C6.41675 11.9761 6.29383 12.2728 6.07504 12.4916C5.85625 12.7104 5.5595 12.8333 5.25008 12.8333C4.94066 12.8333 4.64392 12.7104 4.42512 12.4916C4.20633 12.2728 4.08341 11.9761 4.08341 11.6667V8.75ZM5.25008 4.08333C4.94066 4.08333 4.64392 3.96042 4.42512 3.74162C4.20633 3.52283 4.08341 3.22609 4.08341 2.91667C4.08341 2.60725 4.20633 2.3105 4.42512 2.09171C4.64392 1.87292 4.94066 1.75 5.25008 1.75C5.5595 1.75 5.85625 1.87292 6.07504 2.09171C6.29383 2.3105 6.41675 2.60725 6.41675 2.91667V4.08333H5.25008ZM5.25008 4.66667C5.5595 4.66667 5.85625 4.78958 6.07504 5.00838C6.29383 5.22717 6.41675 5.52391 6.41675 5.83333C6.41675 6.14275 6.29383 6.4395 6.07504 6.65829C5.85625 6.87708 5.5595 7 5.25008 7H2.33341C2.024 7 1.72725 6.87708 1.50846 6.65829C1.28966 6.4395 1.16675 6.14275 1.16675 5.83333C1.16675 5.52391 1.28966 5.22717 1.50846 5.00838C1.72725 4.78958 2.024 4.66667 2.33341 4.66667H5.25008ZM9.91675 5.83333C9.91675 5.52391 10.0397 5.22717 10.2585 5.00838C10.4772 4.78958 10.774 4.66667 11.0834 4.66667C11.3928 4.66667 11.6896 4.78958 11.9084 5.00838C12.1272 5.22717 12.2501 5.52391 12.2501 5.83333C12.2501 6.14275 12.1272 6.4395 11.9084 6.65829C11.6896 6.87708 11.3928 7 11.0834 7H9.91675V5.83333ZM9.33341 5.83333C9.33341 6.14275 9.2105 6.4395 8.99171 6.65829C8.77291 6.87708 8.47617 7 8.16675 7C7.85733 7 7.56058 6.87708 7.34179 6.65829C7.123 6.4395 7.00008 6.14275 7.00008 5.83333V2.91667C7.00008 2.60725 7.123 2.3105 7.34179 2.09171C7.56058 1.87292 7.85733 1.75 8.16675 1.75C8.47617 1.75 8.77291 1.87292 8.99171 2.09171C9.2105 2.3105 9.33341 2.60725 9.33341 2.91667V5.83333ZM8.16675 10.5C8.47617 10.5 8.77291 10.6229 8.99171 10.8417C9.2105 11.0605 9.33341 11.3572 9.33341 11.6667C9.33341 11.9761 9.2105 12.2728 8.99171 12.4916C8.77291 12.7104 8.47617 12.8333 8.16675 12.8333C7.85733 12.8333 7.56058 12.7104 7.34179 12.4916C7.123 12.2728 7.00008 11.9761 7.00008 11.6667V10.5H8.16675ZM8.16675 9.91667C7.85733 9.91667 7.56058 9.79375 7.34179 9.57496C7.123 9.35616 7.00008 9.05942 7.00008 8.75C7.00008 8.44058 7.123 8.14383 7.34179 7.92504C7.56058 7.70625 7.85733 7.58333 8.16675 7.58333H11.0834C11.3928 7.58333 11.6896 7.70625 11.9084 7.92504C12.1272 8.14383 12.2501 8.44058 12.2501 8.75C12.2501 9.05942 12.1272 9.35616 11.9084 9.57496C11.6896 9.79375 11.3928 9.91667 11.0834 9.91667H8.16675Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'codepen':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<mask id = "mask0_1986_9416" style = "mask-type:luminance" maskUnits = "userSpaceOnUse" x = "0" y = "0" width = "14" height = "14">
					<path d  = "M0 0H14V14H0V0Z" fill  = "white"/>
					</mask>
					<g    mask      = "url(#mask0_1986_9416)">
					<path fill-rule = "evenodd" clip-rule = "evenodd" d = "M6.63367 0.110939C6.85533 -0.0366441 7.14408 -0.0366441 7.36633 0.110939L13.7037 4.31677C13.8886 4.43927 14 4.64636 14 4.86861V9.13161C14 9.35327 13.8892 9.56094 13.7037 9.68402L7.36633 13.8899C7.14467 14.0369 6.85592 14.0369 6.63367 13.8899L0.296333 9.68344C0.205266 9.62302 0.130554 9.54103 0.0788514 9.44474C0.0271488 9.34846 6.08032e-05 9.24089 0 9.13161L0 4.86861C0 4.64694 0.110833 4.43927 0.296333 4.31619L6.63367 0.110939ZM1.32533 6.10352V7.88736L2.66 6.98902L1.32533 6.10352ZM3.85525 7.78236L1.855 9.12811L6.33733 12.1031V9.42969L3.85525 7.78236ZM7.66267 9.42969V12.1025L12.145 9.12752L10.1442 7.78236L7.66267 9.42969ZM11.34 6.98961L12.6747 7.88794V6.10294L11.34 6.98961ZM12.1392 4.86861L10.15 6.18869L7.66267 4.51569V1.89769L12.1392 4.86861ZM6.33733 1.89769V4.51511L3.85058 6.18811L1.86083 4.86861L6.33733 1.89769ZM7 5.66719L5.04583 6.98202L7 8.27877L8.95417 6.98202L7 5.66719Z" fill = "currentColor"/>
					</g>
					</svg>';
				break;

			case 'reddit':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<mask id = "mask0_1986_9415" style                                                                                                                                                                                                   = "mask-type:luminance" maskUnits = "userSpaceOnUse" x        = "0" y                    = "1" width               = "14" height = "12">
					<path d  = "M6.99992 11.6667C9.57725 11.6667 11.6666 10.2851 11.6666 8.58084C11.6666 6.87658 9.57725 5.495 6.99992 5.495C4.42259 5.495 2.33325 6.87658 2.33325 8.58084C2.33325 10.2851 4.42259 11.6667 6.99992 11.6667Z" fill        = "white" stroke                  = "white" stroke-width      = "1.16667" stroke-linecap = "round" stroke-linejoin = "round"/>
					<path d  = "M2.29837 8.28917C3.02002 8.28917 3.60503 7.70415 3.60503 6.9825C3.60503 6.26085 3.02002 5.67583 2.29837 5.67583C1.57671 5.67583 0.991699 6.26085 0.991699 6.9825C0.991699 7.70415 1.57671 8.28917 2.29837 8.28917Z" fill = "white"/>
					<path d  = "M11.7017 8.28917C12.4233 8.28917 13.0084 7.70415 13.0084 6.9825C13.0084 6.26085 12.4233 5.67583 11.7017 5.67583C10.98 5.67583 10.395 6.26085 10.395 6.9825C10.395 7.70415 10.98 8.28917 11.7017 8.28917Z" fill           = "white"/>
					<path d  = "M10.7627 3.40667C11.2813 3.40667 11.7018 2.98619 11.7018 2.4675C11.7018 1.94881 11.2813 1.52834 10.7627 1.52834C10.244 1.52834 9.82349 1.94881 9.82349 2.4675C9.82349 2.98619 10.244 3.40667 10.7627 3.40667Z" fill      = "white"/>
					<path d  = "M7 5.10417L7.68833 1.81417L10.6225 2.43834" stroke                                                                                                                                                                       = "white" stroke-width            = "0.466667" stroke-linecap = "round" stroke-linejoin  = "round"/>
					<path d  = "M4.92916 8.86667C5.44784 8.86667 5.86832 8.44619 5.86832 7.9275C5.86832 7.40881 5.44784 6.98833 4.92916 6.98833C4.41047 6.98833 3.98999 7.40881 3.98999 7.9275C3.98999 8.44619 4.41047 8.86667 4.92916 8.86667Z" fill    = "black"/>
					<path d  = "M9.07076 8.86667C9.58945 8.86667 10.0099 8.44619 10.0099 7.9275C10.0099 7.40881 9.58945 6.98833 9.07076 6.98833C8.55207 6.98833 8.13159 7.40881 8.13159 7.9275C8.13159 8.44619 8.55207 8.86667 9.07076 8.86667Z" fill    = "black"/>
					<path d  = "M4.94092 10.22C4.94092 10.22 5.48925 10.8383 7.00008 10.8383C8.50508 10.8383 9.05925 10.22 9.05925 10.22" stroke                                                                                                         = "black" stroke-width            = "0.466667" stroke-linecap = "round"/>
					</mask>
					<g    mask = "url(#mask0_1986_9415)">
					<path d    = "M14 0H0V14H14V0Z" fill = "currentColor"/>
					</g>
					</svg>';
				break;

			case 'twitch':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule = "evenodd" clip-rule = "evenodd" d = "M2.275 1.45834C2.13576 1.45834 2.00223 1.51365 1.90377 1.6121C1.80531 1.71056 1.75 1.8441 1.75 1.98334V10.2632C1.75 10.4024 1.80531 10.5359 1.90377 10.6344C2.00223 10.7329 2.13576 10.7882 2.275 10.7882H4.676V12.5557C4.67622 12.6363 4.70029 12.715 4.74518 12.7819C4.79006 12.8489 4.85375 12.901 4.92822 12.9318C5.0027 12.9627 5.08462 12.9707 5.16368 12.9551C5.24274 12.9394 5.3154 12.9007 5.3725 12.8438L7.42875 10.7882H10.1372C10.2764 10.788 10.4098 10.7327 10.5082 10.6342L12.096 9.04634C12.1945 8.94797 12.2499 8.81453 12.25 8.67534V1.98334C12.25 1.8441 12.1947 1.71056 12.0962 1.6121C11.9978 1.51365 11.8642 1.45834 11.725 1.45834H2.275ZM6.54442 4.49167C6.54442 4.37564 6.49832 4.26436 6.41628 4.18231C6.33423 4.10026 6.22295 4.05417 6.10692 4.05417C5.99088 4.05417 5.8796 4.10026 5.79756 4.18231C5.71551 4.26436 5.66942 4.37564 5.66942 4.49167V6.98367C5.66942 7.0997 5.71551 7.21098 5.79756 7.29303C5.8796 7.37508 5.99088 7.42117 6.10692 7.42117C6.22295 7.42117 6.33423 7.37508 6.41628 7.29303C6.49832 7.21098 6.54442 7.0997 6.54442 6.98367V4.49167ZM9.47042 4.49167C9.47042 4.37564 9.42432 4.26436 9.34228 4.18231C9.26023 4.10026 9.14895 4.05417 9.03292 4.05417C8.91688 4.05417 8.8056 4.10026 8.72356 4.18231C8.64151 4.26436 8.59542 4.37564 8.59542 4.49167V6.98367C8.59542 7.0997 8.64151 7.21098 8.72356 7.29303C8.8056 7.37508 8.91688 7.42117 9.03292 7.42117C9.14895 7.42117 9.26023 7.37508 9.34228 7.29303C9.42432 7.21098 9.47042 7.0997 9.47042 6.98367V4.49167Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'tiktok':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M9.68342 3.395C9.28467 2.93978 9.06492 2.35517 9.06509 1.75H7.26259V8.98333C7.24869 9.37476 7.08343 9.74553 6.80162 10.0175C6.51981 10.2896 6.14344 10.4416 5.75176 10.4417C4.92342 10.4417 4.23509 9.765 4.23509 8.925C4.23509 7.92167 5.20342 7.16917 6.20092 7.47833V5.635C4.18842 5.36667 2.42676 6.93 2.42676 8.925C2.42676 10.8675 4.03676 12.25 5.74592 12.25C7.57759 12.25 9.06509 10.7625 9.06509 8.925V5.25583C9.79601 5.78075 10.6736 6.06238 11.5734 6.06083V4.25833C11.5734 4.25833 10.4768 4.31083 9.68342 3.395Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'snapchat':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M6.92542 12.6962C6.23126 12.6962 5.76809 12.3684 5.35451 12.0797C5.06051 11.8714 4.78517 11.6737 4.46026 11.6188C4.30556 11.5922 4.14881 11.5793 3.99184 11.5803C3.71651 11.5803 3.49776 11.6217 3.34201 11.6532C3.24284 11.6707 3.16001 11.6871 3.09467 11.6871C3.02701 11.6871 2.94126 11.6684 2.90801 11.5541C2.87884 11.4607 2.86076 11.3721 2.84267 11.2863C2.79601 11.0705 2.75692 10.9381 2.67584 10.9247C1.80726 10.7923 1.28751 10.5922 1.18601 10.3553C1.17784 10.3297 1.16792 10.3028 1.16792 10.2824C1.16209 10.2101 1.21459 10.15 1.28751 10.1366C1.97642 10.0228 2.59534 9.65592 3.11801 9.05275C3.52401 8.58433 3.72176 8.13167 3.73984 8.08267C3.73984 8.07683 3.74509 8.07683 3.74509 8.07683C3.84426 7.87208 3.86467 7.69767 3.80459 7.55475C3.69259 7.28642 3.32334 7.17208 3.07134 7.09392C3.00659 7.07642 2.95176 7.05542 2.90509 7.03967C2.68926 6.95392 2.32992 6.77133 2.37717 6.51933C2.41101 6.33733 2.65251 6.20725 2.85026 6.20725C2.90509 6.20725 2.95176 6.21542 2.99026 6.23642C3.21192 6.33733 3.41201 6.38925 3.58351 6.38925C3.79701 6.38925 3.89851 6.30875 3.92417 6.28308C3.91874 6.1677 3.91194 6.05239 3.90376 5.93717C3.85126 5.14092 3.79176 4.15275 4.04376 3.58633C4.80092 1.89058 6.40801 1.75467 6.88401 1.75467L7.09167 1.75H7.12084C7.59626 1.75 9.20334 1.88242 9.96051 3.58108C10.2154 4.1475 10.153 5.13858 10.1005 5.93192L10.0953 5.971C10.0906 6.07717 10.0824 6.17867 10.0778 6.28308C10.1034 6.3035 10.1968 6.38167 10.3893 6.384C10.5561 6.37933 10.7381 6.3245 10.9458 6.23058C11.0032 6.20574 11.0651 6.19265 11.1278 6.19208C11.2007 6.19208 11.2736 6.20958 11.336 6.23058H11.3413C11.5157 6.29592 11.63 6.41783 11.63 6.54558C11.6353 6.66517 11.5413 6.84717 11.0968 7.02683C11.0502 7.04433 10.9953 7.06592 10.9306 7.08108C10.6833 7.15692 10.314 7.2765 10.1968 7.54192C10.132 7.68192 10.1577 7.86158 10.2568 8.06458C10.2568 8.06925 10.2621 8.06925 10.2621 8.06925C10.2907 8.14217 11.042 9.84842 12.7144 10.1267C12.7486 10.1324 12.7796 10.1504 12.8015 10.1772C12.8235 10.204 12.8351 10.2378 12.834 10.2725C12.8344 10.2987 12.8282 10.3246 12.8159 10.3477C12.7144 10.5869 12.1993 10.7817 11.3255 10.9171C11.245 10.9299 11.2059 11.0629 11.1593 11.2787C11.1407 11.3687 11.1191 11.458 11.0945 11.5465C11.0683 11.6323 11.0134 11.6789 10.9195 11.6789H10.9073C10.8241 11.6773 10.7413 11.6677 10.6599 11.6503C10.4461 11.6048 10.2281 11.5821 10.0095 11.5827C9.85276 11.583 9.6963 11.5961 9.54167 11.6217C9.21909 11.6742 8.94084 11.8743 8.64684 12.0826C8.22801 12.3684 7.76251 12.6962 7.07359 12.6962H6.92542Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'spotify':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M7.00008 1.16666C10.2218 1.16666 12.8334 3.77825 12.8334 7C12.8334 10.2217 10.2218 12.8333 7.00008 12.8333C3.77833 12.8333 1.16675 10.2217 1.16675 7C1.16675 3.77825 3.77833 1.16666 7.00008 1.16666ZM7.00008 2.33333C5.7624 2.33333 4.57542 2.825 3.70025 3.70017C2.82508 4.57534 2.33341 5.76232 2.33341 7C2.33341 8.23767 2.82508 9.42466 3.70025 10.2998C4.57542 11.175 5.7624 11.6667 7.00008 11.6667C8.23776 11.6667 9.42474 11.175 10.2999 10.2998C11.1751 9.42466 11.6667 8.23767 11.6667 7C11.6667 5.76232 11.1751 4.57534 10.2999 3.70017C9.42474 2.825 8.23776 2.33333 7.00008 2.33333ZM4.50808 8.23141C5.33525 8.04125 6.22016 8.04358 6.9855 8.162C7.72983 8.2775 8.452 8.51783 8.89708 8.88183C9.0125 8.97557 9.08776 9.10985 9.1075 9.25722C9.12723 9.40459 9.08994 9.55394 9.00325 9.67474C8.91656 9.79554 8.78701 9.87868 8.64108 9.90716C8.49514 9.93565 8.34384 9.90733 8.21808 9.828L8.15858 9.78541C7.95091 9.61508 7.47141 9.41791 6.80641 9.31525C6.16183 9.21491 5.42858 9.21725 4.76941 9.36833C4.69436 9.38663 4.61642 9.38983 4.54012 9.37777C4.46382 9.3657 4.39067 9.33859 4.32493 9.29802C4.25918 9.25746 4.20215 9.20423 4.15715 9.14145C4.11214 9.07866 4.08005 9.00756 4.06275 8.93227C4.04544 8.85698 4.04326 8.77901 4.05634 8.70287C4.06941 8.62673 4.09748 8.55395 4.13891 8.48875C4.18034 8.42355 4.23431 8.36722 4.29768 8.32305C4.36105 8.27887 4.43257 8.24773 4.50808 8.23141ZM4.20475 6.63833C6.10583 6.10808 8.31725 6.40791 9.6665 7.23625C9.79839 7.31724 9.8927 7.4473 9.92869 7.59783C9.96469 7.74836 9.9394 7.90702 9.85841 8.03891C9.77742 8.1708 9.64736 8.26512 9.49683 8.30111C9.3463 8.3371 9.18764 8.31182 9.05575 8.23083C8.01566 7.59208 6.14491 7.30858 4.51741 7.76183C4.4429 7.78487 4.36451 7.79273 4.2869 7.78494C4.20929 7.77716 4.13403 7.75389 4.06557 7.71651C3.99711 7.67913 3.93685 7.62841 3.88833 7.56733C3.83982 7.50625 3.80405 7.43606 3.78314 7.36092C3.76223 7.28578 3.7566 7.2072 3.76658 7.12984C3.77657 7.05249 3.80197 6.97792 3.84128 6.91055C3.88058 6.84318 3.933 6.78438 3.99544 6.73762C4.05787 6.69086 4.12904 6.6571 4.20475 6.63833ZM3.92591 4.9665C6.11925 4.354 8.29858 4.67191 10.1477 5.4705C10.2885 5.53265 10.3991 5.64792 10.4553 5.7912C10.5114 5.93448 10.5087 6.09416 10.4477 6.23545C10.3867 6.37674 10.2723 6.48818 10.1295 6.54551C9.98663 6.60283 9.82693 6.60139 9.68516 6.5415C8.03433 5.82808 6.13033 5.56266 4.23975 6.09C4.16554 6.11205 4.08769 6.1191 4.01073 6.11076C3.93377 6.10242 3.85924 6.07884 3.79149 6.0414C3.72373 6.00397 3.6641 5.95342 3.61608 5.8927C3.56806 5.83199 3.5326 5.76232 3.51177 5.68776C3.49095 5.61321 3.48517 5.53525 3.49478 5.45844C3.50438 5.38163 3.52918 5.30749 3.56773 5.24036C3.60627 5.17323 3.65779 5.11444 3.71929 5.06742C3.78079 5.0204 3.85103 4.9861 3.92591 4.9665Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'soundcloud':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M6.74325 5.17416V9.91666H11.8533C12.9324 9.84083 13.4166 9.17583 13.4166 8.35916C13.4166 7.49583 12.7633 6.80166 11.8883 6.80166C11.6666 6.80166 11.4799 6.84833 11.2874 6.93C11.1474 5.565 9.98659 4.4975 8.55742 4.4975C7.87492 4.4975 7.22742 4.75416 6.74325 5.17416ZM6.22992 5.76916C6.05492 5.66416 5.86825 5.5825 5.66409 5.54166V9.91666H6.47492V5.44833C6.38742 5.54166 6.30575 5.65833 6.22992 5.76916ZM4.85909 5.45416V9.91666H5.39575V5.47166C5.28492 5.45416 5.17409 5.44833 5.05742 5.44833C4.98742 5.44833 4.92325 5.44833 4.85909 5.45416ZM3.79159 5.83333V9.91666H4.32242V5.565C4.12992 5.62916 3.94909 5.7225 3.79159 5.83333ZM2.81742 7.29166C2.78242 7.29166 2.74742 7.25666 2.70659 7.23916V9.91666H3.24325V6.335C3.02742 6.615 2.88159 6.9475 2.81742 7.29166ZM1.62742 7.12833V9.86416C1.74992 9.89916 1.88992 9.91666 2.04159 9.91666H2.16992V7.08166C2.12325 7.07583 2.07659 7.07 2.04159 7.07C1.88992 7.07 1.74992 7.09333 1.62742 7.12833ZM0.583252 8.49333C0.583252 8.93083 0.781585 9.31583 1.09075 9.57833V7.41416C0.781585 7.67083 0.583252 8.06166 0.583252 8.49333Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'apple_podcast':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M6.99991 7.875C6.69706 7.875 6.40101 7.78519 6.1492 7.61694C5.89738 7.44868 5.70112 7.20953 5.58522 6.92973C5.46933 6.64993 5.439 6.34205 5.49809 6.04502C5.55717 5.74798 5.70301 5.47514 5.91716 5.26099C6.1313 5.04684 6.40415 4.90101 6.70118 4.84192C6.99821 4.78284 7.3061 4.81316 7.5859 4.92906C7.8657 5.04496 8.10484 5.24122 8.2731 5.49303C8.44136 5.74485 8.53116 6.0409 8.53116 6.34375C8.53116 6.74986 8.36984 7.13934 8.08267 7.42651C7.79551 7.71367 7.40603 7.875 6.99991 7.875ZM7.86124 7.875H6.13858C5.96973 7.87456 5.80303 7.91288 5.65133 7.98703C5.49963 8.06117 5.36697 8.16916 5.26358 8.30266C5.16153 8.4326 5.09079 8.58431 5.05683 8.74601C5.02288 8.90771 5.02663 9.07506 5.0678 9.23508L5.7339 11.8601C5.79515 12.0974 5.93371 12.3076 6.12771 12.4574C6.32172 12.6073 6.5601 12.6882 6.80523 12.6875H7.1946C7.44019 12.6888 7.67921 12.6082 7.87377 12.4583C8.06832 12.3084 8.2073 12.0979 8.26866 11.8601L8.93476 9.23508C8.97592 9.07506 8.97968 8.90771 8.94573 8.74601C8.91177 8.58431 8.84103 8.4326 8.73898 8.30266C8.63531 8.16879 8.50221 8.06058 8.35 7.98642C8.19779 7.91226 8.03055 7.87414 7.86124 7.875ZM9.96616 7.76563C9.93726 7.87796 9.95415 7.99717 10.0131 8.09705C10.0721 8.19694 10.1683 8.26932 10.2806 8.29828C10.3164 8.30736 10.3531 8.31196 10.39 8.31195C10.4869 8.31188 10.5811 8.27962 10.6577 8.22023C10.7343 8.16084 10.789 8.07769 10.8133 7.98383C10.9629 7.40213 10.9775 6.79392 10.8559 6.20573C10.7343 5.61753 10.4797 5.06496 10.1117 4.59028C9.74366 4.11561 9.27192 3.73142 8.73257 3.46712C8.19321 3.20282 7.60054 3.06541 6.99991 3.06541C6.39928 3.06541 5.80661 3.20282 5.26726 3.46712C4.7279 3.73142 4.25616 4.11561 3.88814 4.59028C3.52011 5.06496 3.26556 5.61753 3.14396 6.20573C3.02235 6.79392 3.03692 7.40213 3.18655 7.98383C3.2002 8.04022 3.22492 8.09333 3.25929 8.14007C3.29365 8.18682 3.33697 8.22626 3.38672 8.2561C3.43647 8.28595 3.49166 8.3056 3.54908 8.31392C3.6065 8.32223 3.665 8.31904 3.72117 8.30454C3.77734 8.29003 3.83007 8.2645 3.87628 8.22942C3.9225 8.19435 3.96127 8.15043 3.99035 8.10023C4.01943 8.05003 4.03824 7.99454 4.04567 7.937C4.05311 7.87947 4.04903 7.82102 4.03366 7.76508C3.91749 7.3127 3.90632 6.83975 4.00102 6.3824C4.09572 5.92504 4.29377 5.49541 4.58002 5.12636C4.86627 4.7573 5.23314 4.45861 5.65257 4.25313C6.07199 4.04765 6.53286 3.94083 6.99991 3.94083C7.46697 3.94083 7.92783 4.04765 8.34726 4.25313C8.76668 4.45861 9.13355 4.7573 9.41981 5.12636C9.70606 5.49541 9.90411 5.92504 9.9988 6.3824C10.0935 6.83975 10.0823 7.3127 9.96616 7.76508V7.76563ZM6.99991 1.3125C5.77811 1.31236 4.58874 1.70568 3.60791 2.43422C2.62708 3.16276 1.90693 4.18779 1.55409 5.35754C1.20125 6.52728 1.23448 7.77956 1.64886 8.92895C2.06324 10.0783 2.83674 11.0637 3.85483 11.7392C3.95144 11.8035 4.0696 11.8267 4.18333 11.8038C4.29706 11.781 4.39705 11.7138 4.46132 11.6173C4.4931 11.5694 4.51514 11.5157 4.52618 11.4594C4.53723 11.403 4.53706 11.345 4.52568 11.2887C4.5143 11.2323 4.49195 11.1788 4.45989 11.1311C4.42782 11.0835 4.38669 11.0426 4.33882 11.0108C3.47743 10.4392 2.82299 9.60546 2.47238 8.63296C2.12177 7.66046 2.09363 6.60091 2.39213 5.61117C2.69063 4.62143 3.2999 3.75412 4.12973 3.13764C4.95957 2.52115 5.96587 2.18827 6.99964 2.18827C8.03341 2.18827 9.03971 2.52115 9.86954 3.13764C10.6994 3.75412 11.3087 4.62143 11.6072 5.61117C11.9057 6.60091 11.8775 7.66046 11.5269 8.63296C11.1763 9.60546 10.5218 10.4392 9.66046 11.0108C9.56607 11.076 9.50106 11.1756 9.47943 11.2883C9.4578 11.4009 9.48128 11.5176 9.54481 11.6131C9.60834 11.7086 9.70684 11.7753 9.8191 11.7989C9.93135 11.8225 10.0484 11.8011 10.145 11.7392C11.1631 11.0637 11.9366 10.0783 12.351 8.92895C12.7653 7.77956 12.7986 6.52728 12.4457 5.35754C12.0929 4.18779 11.3727 3.16276 10.3919 2.43422C9.41108 1.70568 8.22172 1.31236 6.99991 1.3125Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'patreon':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M8.64508 1.40583C10.9551 1.40583 12.8334 3.29583 12.8334 5.61167C12.8334 7.92167 10.9551 9.8 8.64508 9.8C6.32925 9.8 4.43925 7.92167 4.43925 5.61167C4.43925 3.29583 6.32925 1.40583 8.64508 1.40583ZM1.16675 12.6H3.20841V1.40583H1.16675V12.6Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'skype':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M7.76426 11.9C6.99292 12.0205 6.20402 11.9571 5.4618 11.7151C4.71957 11.4731 4.04498 11.0592 3.49295 10.5071C2.94091 9.95511 2.52703 9.28052 2.28499 8.5383C2.04296 7.79607 1.9796 7.00717 2.10009 6.23583C1.79602 5.65746 1.68491 4.997 1.783 4.35098C1.88109 3.70495 2.18324 3.10723 2.64528 2.64519C3.10732 2.18314 3.70504 1.881 4.35107 1.78291C4.99709 1.68482 5.65756 1.79593 6.23592 2.1C7.00727 1.97951 7.79616 2.04287 8.53839 2.2849C9.28061 2.52694 9.9552 2.94082 10.5072 3.49286C11.0593 4.04489 11.4732 4.71948 11.7152 5.46171C11.9572 6.20393 12.0206 6.99283 11.9001 7.76417C12.2042 8.34254 12.3153 9.003 12.2172 9.64902C12.1191 10.2951 11.8169 10.8928 11.3549 11.3548C10.8929 11.8169 10.2951 12.119 9.64912 12.2171C9.00309 12.3152 8.34263 12.2041 7.76426 11.9ZM7.03101 10.0077H7.00767C8.68301 10.0077 9.51776 9.19917 9.51776 8.11592C9.51776 7.41708 9.19634 6.6745 7.92759 6.39042L6.77084 6.13375C6.33043 6.03342 5.82467 5.90042 5.82467 5.48333C5.82467 5.06625 6.18634 4.77575 6.83034 4.77575C8.13117 4.77575 8.01276 5.66708 8.65676 5.66708C8.99276 5.66708 9.29434 5.46758 9.29434 5.12458C9.29434 4.32542 8.01276 3.72458 6.92834 3.72458C5.74942 3.72458 4.49409 4.22567 4.49409 5.55858C4.49409 6.19908 4.72393 6.88275 5.98742 7.1995L7.55601 7.59092C8.03201 7.70875 8.14984 7.97533 8.14984 8.21625C8.14984 8.617 7.75084 9.00842 7.03101 9.00842C5.62109 9.00842 5.81884 7.92517 5.06284 7.92517C4.72451 7.92517 4.47776 8.15733 4.47776 8.49158C4.47776 9.14142 5.26643 10.0077 7.03101 10.0077Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'gitlab':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M12.6367 5.82575L12.6203 5.78375L11.0342 1.64558C11.0022 1.56394 10.945 1.49459 10.871 1.44752C10.797 1.40045 10.7099 1.37809 10.6224 1.38367C10.5348 1.38756 10.4507 1.41914 10.3821 1.47385C10.3136 1.52856 10.2641 1.60359 10.2409 1.68817L9.16991 4.97H4.83108L3.75833 1.68875C3.73537 1.60414 3.6862 1.52899 3.61787 1.47407C3.54953 1.41915 3.46556 1.3873 3.37799 1.38308C3.29045 1.37832 3.20362 1.40107 3.12966 1.44814C3.0557 1.49522 2.99832 1.56426 2.96558 1.64558L1.37774 5.78958L1.36141 5.83042C1.13345 6.42724 1.10541 7.08195 1.28151 7.69608C1.45761 8.31021 1.82832 8.85057 2.33791 9.23591L2.34374 9.24L2.35774 9.25108L4.77683 11.0617L5.97266 11.9677L6.70008 12.5183C6.78539 12.5829 6.88944 12.6178 6.99641 12.6178C7.10338 12.6178 7.20743 12.5829 7.29274 12.5183L8.02016 11.9677L9.21599 11.0617L11.6497 9.24L11.6555 9.23533C12.1669 8.85049 12.5392 8.3097 12.7162 7.69461C12.8932 7.07953 12.8653 6.42356 12.6367 5.82575Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'github':
				return '<svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M4.3473 1.3475C4.78537 1.49589 5.20211 1.70103 5.58689 1.95767C6.13031 1.81878 6.68908 1.74901 7.24997 1.75C7.82922 1.75 8.38805 1.82233 8.91189 1.95708C9.29652 1.70069 9.71306 1.49576 10.1509 1.3475C10.5575 1.20925 11.1367 0.985249 11.4809 1.36617C11.7142 1.62517 11.7726 2.05917 11.814 2.3905C11.8606 2.76033 11.8717 3.24217 11.7492 3.7205C12.2176 4.32542 12.5 5.047 12.5 5.83333C12.5 7.0245 11.8548 8.05875 10.8999 8.77508C10.4403 9.11548 9.93062 9.38233 9.38905 9.56608C9.51389 9.85192 9.5833 10.1681 9.5833 10.5V12.25C9.5833 12.4047 9.52185 12.5531 9.41245 12.6625C9.30305 12.7719 9.15468 12.8333 8.99997 12.8333H5.49997C5.34526 12.8333 5.19689 12.7719 5.08749 12.6625C4.9781 12.5531 4.91664 12.4047 4.91664 12.25V11.6719C4.35955 11.7402 3.8923 11.6795 3.49505 11.5109C3.07972 11.3347 2.79039 11.0617 2.5728 10.8004C2.3663 10.5531 2.14114 9.99542 1.81564 9.88692C1.74294 9.86271 1.67572 9.82442 1.61782 9.77424C1.55992 9.72405 1.51247 9.66295 1.47819 9.59443C1.40894 9.45605 1.3975 9.29582 1.44639 9.149C1.49528 9.00218 1.60049 8.88079 1.73887 8.81155C1.87726 8.7423 2.03748 8.73086 2.1843 8.77975C2.5728 8.90925 2.82597 9.18925 2.99922 9.41442C3.27922 9.77608 3.50672 10.2486 3.95005 10.437C4.13264 10.5146 4.40039 10.5653 4.81922 10.5082L4.91664 10.4883C4.91775 10.1709 4.98386 9.85702 5.11089 9.56608C4.56931 9.38234 4.05961 9.11548 3.60005 8.77508C2.64514 8.05875 1.99997 7.02508 1.99997 5.83333C1.99997 5.04817 2.28172 4.32717 2.74897 3.72283C2.62647 3.2445 2.63697 2.7615 2.68364 2.39108L2.68655 2.36892C2.72914 2.02942 2.77872 1.62983 3.01672 1.36617C3.36089 0.985249 3.94072 1.20983 4.34672 1.34808L4.3473 1.3475Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'youtube':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M5.83341 8.75L8.86091 7L5.83341 5.25V8.75ZM12.5767 4.1825C12.6526 4.45667 12.7051 4.82417 12.7401 5.29083C12.7809 5.7575 12.7984 6.16 12.7984 6.51L12.8334 7C12.8334 8.2775 12.7401 9.21667 12.5767 9.8175C12.4309 10.3425 12.0926 10.6808 11.5676 10.8267C11.2934 10.9025 10.7917 10.955 10.0217 10.99C9.26341 11.0308 8.56925 11.0483 7.92758 11.0483L7.00008 11.0833C4.55591 11.0833 3.03341 10.99 2.43258 10.8267C1.90758 10.6808 1.56925 10.3425 1.42341 9.8175C1.34758 9.54333 1.29508 9.17583 1.26008 8.70917C1.21925 8.2425 1.20175 7.84 1.20175 7.49L1.16675 7C1.16675 5.7225 1.26008 4.78333 1.42341 4.1825C1.56925 3.6575 1.90758 3.31917 2.43258 3.17333C2.70675 3.0975 3.20841 3.045 3.97841 3.01C4.73675 2.96917 5.43091 2.95167 6.07258 2.95167L7.00008 2.91667C9.44425 2.91667 10.9667 3.01 11.5676 3.17333C12.0926 3.31917 12.4309 3.6575 12.5767 4.1825Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'vimeo':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M0.68492 4.84225C0.521004 4.60133 0.53792 4.60133 0.876254 4.30442C1.59492 3.67325 2.27275 2.98258 3.05559 2.43075C3.76434 1.93375 4.70409 1.61292 5.34634 2.40333C5.93784 3.13192 5.95184 4.23617 6.10175 5.11583C6.25167 6.02817 6.39517 6.9615 6.71484 7.83417C6.8035 8.07975 6.97325 8.54408 7.2795 8.58317C7.675 8.63742 8.0775 7.94383 8.26125 7.68483C8.73784 6.9965 9.38417 6.06958 9.3025 5.18467C9.222 4.24433 8.207 4.42108 7.57234 4.64567C7.67442 3.59042 8.65617 2.40392 9.60234 2.00317C10.6057 1.58667 12.0967 1.59367 12.6007 2.72475C13.1385 3.95092 12.6549 5.37483 12.0687 6.48608C11.4293 7.69242 10.6051 8.80892 9.72484 9.85192C8.94842 10.7783 8.02967 11.7944 6.87234 12.2372C5.54992 12.7412 4.7665 11.7588 4.31617 10.6213C3.82442 9.38292 3.58 7.99283 3.22534 6.70367C3.076 6.15825 2.89867 5.53817 2.54459 5.08783C2.08259 4.508 1.55759 5.05342 1.10142 5.36667C0.94392 5.21092 0.815004 5.01258 0.68492 4.84225Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'dtube':
				return '<s<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M13.184 3.20819C12.6713 2.22144 11.8849 1.40346 10.9191 0.85225C9.9148 0.28992 8.77947 0.00370963 7.62864 0.0227498H0.104512L4.13564 2.35594H7.62864C8.76132 2.35594 9.61795 2.71819 10.2081 3.45406C10.7913 4.18337 11.0831 5.24956 11.0831 6.66706V7.40775C11.0761 8.77275 10.7734 9.82319 10.1784 10.5591C9.58382 11.2928 8.7202 11.6598 7.60107 11.6598H4.00089L-0.000488281 13.9702H7.65795C8.87682 13.9702 9.97539 13.6854 10.9436 13.1316C11.9122 12.5755 12.6638 11.7893 13.1993 10.7844C13.737 9.78163 13.9991 8.62663 13.9991 7.3255V6.685C13.9991 5.38825 13.7256 4.23544 13.1831 3.20775L13.184 3.20819ZM0.0751992 2.31044V11.7009L8.20789 7L0.0751992 2.31044Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'linkedin':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
			<path
				d    = "M3.61491 2.97482C3.61475 3.2995 3.48562 3.61082 3.25592 3.84028C3.02622 4.06975 2.71478 4.19858 2.3901 4.19841C2.06542 4.19825 1.7541 4.06912 1.52463 3.83942C1.29516 3.60972 1.16634 3.29828 1.1665 2.9736C1.16667 2.64892 1.2958 2.3376 1.5255 2.10813C1.7552 1.87866 2.06664 1.74984 2.39132 1.75C2.716 1.75017 3.02732 1.8793 3.25678 2.109C3.48625 2.3387 3.61508 2.65014 3.61491 2.97482ZM3.65164 5.10494H1.20323V12.7685H3.65164V5.10494ZM7.52012 5.10494H5.08396V12.7685H7.49564V8.74694C7.49564 6.50665 10.4154 6.29854 10.4154 8.74694V12.7685H12.8332V7.91448C12.8332 4.13781 8.51173 4.2786 7.49564 6.13327L7.52012 5.10494Z"
				fill = "currentColor" />
		</svg>';
				break;

			case 'pinterest':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
			<path
				d    = "M5.27317 12.565C5.83317 12.7342 6.399 12.8333 6.99984 12.8333C8.54693 12.8333 10.0307 12.2188 11.1246 11.1248C12.2186 10.0308 12.8332 8.5471 12.8332 7C12.8332 6.23396 12.6823 5.47541 12.3891 4.76768C12.096 4.05995 11.6663 3.41689 11.1246 2.87521C10.583 2.33354 9.93989 1.90386 9.23216 1.6107C8.52442 1.31755 7.76588 1.16667 6.99984 1.16667C6.23379 1.16667 5.47525 1.31755 4.76752 1.6107C4.05978 1.90386 3.41672 2.33354 2.87505 2.87521C1.78109 3.96917 1.1665 5.4529 1.1665 7C1.1665 9.47917 2.724 11.6083 4.92317 12.4483C4.87067 11.9933 4.81817 11.2408 4.92317 10.7217L5.594 7.84C5.594 7.84 5.42484 7.50167 5.42484 6.965C5.42484 6.16 5.9265 5.55917 6.49817 5.55917C6.99984 5.55917 7.23317 5.92667 7.23317 6.39917C7.23317 6.90083 6.90067 7.61833 6.7315 8.30667C6.63234 8.87833 7.03484 9.38 7.61817 9.38C8.6565 9.38 9.4615 8.27167 9.4615 6.70833C9.4615 5.30833 8.45817 4.35167 7.01734 4.35167C5.37234 4.35167 4.404 5.57667 4.404 6.86583C4.404 7.3675 4.56734 7.875 4.83567 8.2075C4.88817 8.2425 4.88817 8.28917 4.87067 8.37667L4.7015 9.0125C4.7015 9.11167 4.63734 9.14667 4.53817 9.07667C3.7915 8.75 3.35984 7.68833 3.35984 6.83083C3.35984 4.9875 4.6665 3.31333 7.1865 3.31333C9.19317 3.31333 10.7565 4.75417 10.7565 6.6675C10.7565 8.67417 9.514 10.2842 7.73484 10.2842C7.169 10.2842 6.61484 9.98083 6.4165 9.625L6.02567 11.0075C5.8915 11.5092 5.524 12.18 5.27317 12.5825V12.565Z"
				fill = "currentColor" />
		</svg>';
				break;

			case 'location':
				return '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="location"><path id="Vector" d="M10.1273 10.1592C10.5944 10.1592 10.9944 9.99278 11.3273 9.65987C11.6596 9.32753 11.8258 8.92781 11.8258 8.46072C11.8258 7.99363 11.6596 7.59363 11.3273 7.26072C10.9944 6.92838 10.5944 6.76221 10.1273 6.76221C9.66022 6.76221 9.2605 6.92838 8.92816 7.26072C8.59525 7.59363 8.42879 7.99363 8.42879 8.46072C8.42879 8.92781 8.59525 9.32753 8.92816 9.65987C9.2605 9.99278 9.66022 10.1592 10.1273 10.1592ZM10.1273 16.4013C11.8541 14.816 13.1351 13.3757 13.9702 12.0803C14.8053 10.7854 15.2228 9.63553 15.2228 8.63057C15.2228 7.08776 14.7308 5.82435 13.7468 4.84034C12.7634 3.8569 11.5569 3.36518 10.1273 3.36518C8.69772 3.36518 7.49093 3.8569 6.50693 4.84034C5.52349 5.82435 5.03177 7.08776 5.03177 8.63057C5.03177 9.63553 5.44932 10.7854 6.28442 12.0803C7.11952 13.3757 8.40049 14.816 10.1273 16.4013ZM10.1273 18.3333C10.0141 18.3333 9.90084 18.3121 9.7876 18.2696C9.67437 18.2272 9.57529 18.1706 9.49036 18.0998C7.42384 16.2739 5.88102 14.5791 4.86191 13.0153C3.84281 11.451 3.33325 9.98939 3.33325 8.63057C3.33325 6.50743 4.01634 4.81599 5.38251 3.55626C6.74811 2.29653 8.32971 1.66667 10.1273 1.66667C11.9249 1.66667 13.5065 2.29653 14.8721 3.55626C16.2383 4.81599 16.9214 6.50743 16.9214 8.63057C16.9214 9.98939 16.4118 11.451 15.3927 13.0153C14.3736 14.5791 12.8308 16.2739 10.7643 18.0998C10.6793 18.1706 10.5802 18.2272 10.467 18.2696C10.3538 18.3121 10.2405 18.3333 10.1273 18.3333Z" fill="currentColor" /></g></svg>';
				break;

			case 'phone':
				return '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="phone"><path id="Vector"d="M16.6667 12.9167C15.6667 12.9167 14.5833 12.75 13.6667 12.4167H13.4167C13.1667 12.4167 13 12.5 12.8333 12.6667L11 14.5C8.66667 13.25 6.66667 11.3333 5.5 9L7.33333 7.16667C7.58333 6.91667 7.66667 6.58333 7.5 6.33333C7.25 5.41667 7.08333 4.33333 7.08333 3.33333C7.08333 2.91667 6.66667 2.5 6.25 2.5H3.33333C2.91667 2.5 2.5 2.91667 2.5 3.33333C2.5 11.1667 8.83333 17.5 16.6667 17.5C17.0833 17.5 17.5 17.0833 17.5 16.6667V13.75C17.5 13.3333 17.0833 12.9167 16.6667 12.9167ZM4.16667 4.16667H5.41667C5.5 4.91667 5.66667 5.66667 5.83333 6.33333L4.83333 7.33333C4.5 6.33333 4.25 5.25 4.16667 4.16667ZM15.8333 15.8333C14.75 15.75 13.6667 15.5 12.6667 15.1667L13.6667 14.1667C14.3333 14.3333 15.0833 14.5 15.8333 14.5V15.8333Z" fill="currentColor" /></g></svg>';
				break;

			case 'email':
				return '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M18.3334 5C18.3334 4.08333 17.5834 3.33333 16.6667 3.33333H3.33341C2.41675 3.33333 1.66675 4.08333 1.66675 5V15C1.66675 15.9167 2.41675 16.6667 3.33341 16.6667H16.6667C17.5834 16.6667 18.3334 15.9167 18.3334 15V5ZM16.6667 5L10.0001 9.15833L3.33341 5H16.6667ZM16.6667 15H3.33341V6.66667L10.0001 10.8333L16.6667 6.66667V15Z" fill="currentColor" /> </svg>';
				break;

			case 'scroll-top-arrow':
				return ' <svg width="28" height="29" viewBox="0 0 28 29" fill="none" xmlns="http://www.w3.org/2000/svg"> 
				<g    filter = "url(#filter0_d_5_6)">
				<path d      = "M5.8746 12.4395L4.9207 11.4856C4.51679 11.0817 4.51679 10.4285 4.9207 10.0289L13.2695 1.67579C13.6734 1.27189 14.3266 1.27189 14.7262 1.67579L23.075 10.0246C23.4789 10.4285 23.4789 11.0817 23.075 11.4813L22.1211 12.4352C21.7129 12.8434 21.0469 12.8348 20.6473 12.418L15.7187 7.24454V19.5938C15.7187 20.1652 15.259 20.625 14.6875 20.625H13.3125C12.741 20.625 12.2812 20.1652 12.2812 19.5938V7.24454L7.34843 12.4223C6.94882 12.8434 6.28281 12.852 5.8746 12.4395Z" fill = "white" />
				</g>
				<defs>
					<filter         id            = "filter0_d_5_6" x    = "-1" y                      = "0" width                                          = "30" height = "30" filterUnits = "userSpaceOnUse" color-interpolation-filters = "sRGB">
					<feFlood        flood-opacity = "0" result           = "BackgroundImageFix" />
					<feColorMatrix  in            = "SourceAlpha" type   = "matrix" values             = "0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result = "hardAlpha" />
					<feOffset       dy            = "4" />
					<feGaussianBlur stdDeviation  = "2" />
					<feComposite    in2           = "hardAlpha" operator = "out" />
					<feColorMatrix  type          = "matrix" values      = "0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
					<feBlend        mode          = "normal" in2         = "BackgroundImageFix" result = "effect1_dropShadow_5_6" />
					<feBlend        mode          = "normal" in          = "SourceGraphic" in2         = "effect1_dropShadow_5_6" result                    = "shape" />
					</filter>
				</defs>
			</svg>';
				break;

			case 'cross-icon':
				return ' <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d = "M4.85333 3.02667L9.99999 8.17333L15.12 3.05333C15.2331 2.93296 15.3693 2.83666 15.5205 2.77022C15.6718 2.70377 15.8348 2.66855 16 2.66667C16.3536 2.66667 16.6928 2.80714 16.9428 3.05719C17.1929 3.30724 17.3333 3.64638 17.3333 4C17.3364 4.16347 17.3061 4.32585 17.2442 4.47718C17.1823 4.6285 17.0901 4.76558 16.9733 4.88L11.7867 10L16.9733 15.1867C17.1931 15.4017 17.3219 15.6928 17.3333 16C17.3333 16.3536 17.1929 16.6928 16.9428 16.9428C16.6928 17.1929 16.3536 17.3333 16 17.3333C15.8301 17.3404 15.6605 17.312 15.5021 17.25C15.3438 17.1881 15.2 17.0938 15.08 16.9733L9.99999 11.8267L4.86666 16.96C4.754 17.0764 4.61941 17.1693 4.47066 17.2333C4.32191 17.2974 4.16195 17.3314 3.99999 17.3333C3.64637 17.3333 3.30723 17.1929 3.05718 16.9428C2.80714 16.6928 2.66666 16.3536 2.66666 16C2.66355 15.8365 2.69388 15.6742 2.75579 15.5228C2.81769 15.3715 2.90987 15.2344 3.02666 15.12L8.21333 10L3.02666 4.81333C2.80691 4.59835 2.67805 4.30722 2.66666 4C2.66666 3.64638 2.80714 3.30724 3.05718 3.05719C3.30723 2.80714 3.64637 2.66667 3.99999 2.66667C4.31999 2.67067 4.62666 2.8 4.85333 3.02667Z" fill = "currentColor" />
				</svg>';
				break;

			case 'mblemail':
				return '<svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d = "M18.3334 5C18.3334 4.08333 17.5834 3.33333 16.6667 3.33333H3.33341C2.41675 3.33333 1.66675 4.08333 1.66675 5V15C1.66675 15.9167 2.41675 16.6667 3.33341 16.6667H16.6667C17.5834 16.6667 18.3334 15.9167 18.3334 15V5ZM16.6667 5L10.0001 9.15833L3.33341 5H16.6667ZM16.6667 15H3.33341V6.66667L10.0001 10.8333L16.6667 6.66667V15Z" fill = "currentColor" />
			</svg>';
				break;

			case 'mblphone':
				return ' <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
							xmlns = "http://www.w3.org/2000/svg">
					<g    id    = "phone">
					<path id    = "Vector"
							d     = "M16.6667 12.9167C15.6667 12.9167 14.5833 12.75 13.6667 12.4167H13.4167C13.1667 12.4167 13 12.5 12.8333 12.6667L11 14.5C8.66667 13.25 6.66667 11.3333 5.5 9L7.33333 7.16667C7.58333 6.91667 7.66667 6.58333 7.5 6.33333C7.25 5.41667 7.08333 4.33333 7.08333 3.33333C7.08333 2.91667 6.66667 2.5 6.25 2.5H3.33333C2.91667 2.5 2.5 2.91667 2.5 3.33333C2.5 11.1667 8.83333 17.5 16.6667 17.5C17.0833 17.5 17.5 17.0833 17.5 16.6667V13.75C17.5 13.3333 17.0833 12.9167 16.6667 12.9167ZM4.16667 4.16667H5.41667C5.5 4.91667 5.66667 5.66667 5.83333 6.33333L4.83333 7.33333C4.5 6.33333 4.25 5.25 4.16667 4.16667ZM15.8333 15.8333C14.75 15.75 13.6667 15.5 12.6667 15.1667L13.6667 14.1667C14.3333 14.3333 15.0833 14.5 15.8333 14.5V15.8333Z"
							fill  = "currentColor" />
			</g>
			</svg>';
				break;

			case 'mbllocation':
				return ' <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g    id = "location">
				<path id = "Vector" d = "M10.1273 10.1592C10.5944 10.1592 10.9944 9.99278 11.3273 9.65987C11.6596 9.32753 11.8258 8.92781 11.8258 8.46072C11.8258 7.99363 11.6596 7.59363 11.3273 7.26072C10.9944 6.92838 10.5944 6.76221 10.1273 6.76221C9.66022 6.76221 9.2605 6.92838 8.92816 7.26072C8.59525 7.59363 8.42879 7.99363 8.42879 8.46072C8.42879 8.92781 8.59525 9.32753 8.92816 9.65987C9.2605 9.99278 9.66022 10.1592 10.1273 10.1592ZM10.1273 16.4013C11.8541 14.816 13.1351 13.3757 13.9702 12.0803C14.8053 10.7854 15.2228 9.63553 15.2228 8.63057C15.2228 7.08776 14.7308 5.82435 13.7468 4.84034C12.7634 3.8569 11.5569 3.36518 10.1273 3.36518C8.69772 3.36518 7.49093 3.8569 6.50693 4.84034C5.52349 5.82435 5.03177 7.08776 5.03177 8.63057C5.03177 9.63553 5.44932 10.7854 6.28442 12.0803C7.11952 13.3757 8.40049 14.816 10.1273 16.4013ZM10.1273 18.3333C10.0141 18.3333 9.90084 18.3121 9.7876 18.2696C9.67437 18.2272 9.57529 18.1706 9.49036 18.0998C7.42384 16.2739 5.88102 14.5791 4.86191 13.0153C3.84281 11.451 3.33325 9.98939 3.33325 8.63057C3.33325 6.50743 4.01634 4.81599 5.38251 3.55626C6.74811 2.29653 8.32971 1.66667 10.1273 1.66667C11.9249 1.66667 13.5065 2.29653 14.8721 3.55626C16.2383 4.81599 16.9214 6.50743 16.9214 8.63057C16.9214 9.98939 16.4118 11.451 15.3927 13.0153C14.3736 14.5791 12.8308 16.2739 10.7643 18.0998C10.6793 18.1706 10.5802 18.2272 10.467 18.2696C10.3538 18.3121 10.2405 18.3333 10.1273 18.3333Z" fill = "currentColor" />
				</g>
				</svg>';
				break;

			case 'quotes-message':
				return '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g    id = "minus">
				<path id = "Vector" d = "M11 6.92857H1V5.5H11V6.92857Z" fill = "currentColor" />
				</g>
				</svg>';
				break;

			case 'about-goal':
				return ' <svg width="61" height="60" viewBox="0 0 61 60" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g    id = "target">
				<path id = "Vector" d   = "M50.93 16.875H46.2775L34.8624 28.285C35.2556 29.2869 35.2918 30.3937 34.9648 31.4192C34.6379 32.4447 33.9679 33.3264 33.0673 33.9159C32.1668 34.5055 31.0907 34.767 30.0201 34.6565C28.9494 34.5459 27.9495 34.0701 27.1884 33.309C26.4273 32.5479 25.9515 31.548 25.8409 30.4773C25.7304 29.4067 25.9919 28.3306 26.5815 27.4301C27.171 26.5296 28.0527 25.8595 29.0782 25.5326C30.1037 25.2056 31.2105 25.2418 32.2124 25.635L43.6249 14.2225V9.56996C43.6252 8.9474 43.8724 8.35038 44.3124 7.90996L48.6374 3.58496C48.7173 3.50417 48.8178 3.44678 48.928 3.41902C49.0381 3.39125 49.1538 3.39417 49.2624 3.42746C49.4849 3.49246 49.6499 3.67746 49.6949 3.90496L50.8449 9.65746L56.5949 10.8075C56.8199 10.8525 57.0049 11.0175 57.0699 11.24C57.1028 11.348 57.1057 11.463 57.0784 11.5726C57.0511 11.6822 56.9946 11.7824 56.9149 11.8625L52.5874 16.1875C52.3699 16.4054 52.1115 16.5782 51.8271 16.6962C51.5427 16.8142 51.2379 16.8749 50.93 16.875Z" fill                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              = "currentColor" />
				<path id = "Vector_2" d = "M7.0625 30C7.0625 36.216 9.5318 42.1774 13.9272 46.5728C18.3226 50.9682 24.284 53.4375 30.5 53.4375C33.5779 53.4375 36.6256 52.8313 39.4691 51.6534C42.3127 50.4756 44.8964 48.7492 47.0728 46.5728C49.2492 44.3965 50.9756 41.8127 52.1534 38.9692C53.3313 36.1256 53.9375 33.0779 53.9375 30C53.9375 27.755 53.6225 25.585 53.035 23.5325C52.9182 23.0612 52.9888 22.563 53.2319 22.1428C53.475 21.7225 53.8716 21.4129 54.3384 21.2791C54.8051 21.1453 55.3055 21.1978 55.7343 21.4255C56.1632 21.6532 56.4869 22.0384 56.6375 22.5C57.3225 24.885 57.6875 27.4 57.6875 30C57.6875 45.015 45.515 57.1875 30.5 57.1875C15.485 57.1875 3.3125 45.015 3.3125 30C3.3125 14.985 15.485 2.81251 30.5 2.81251C33.0375 2.81001 35.56 3.16251 38 3.86001C38.2379 3.92675 38.4603 4.03985 38.6543 4.19281C38.8484 4.34578 39.0103 4.53559 39.1307 4.75133C39.2512 4.96707 39.3278 5.2045 39.3562 5.44995C39.3846 5.69541 39.3641 5.94405 39.2961 6.18159C39.2281 6.41913 39.1138 6.64088 38.9597 6.83409C38.8057 7.0273 38.615 7.18816 38.3986 7.30743C38.1822 7.4267 37.9444 7.50202 37.6988 7.52907C37.4532 7.55611 37.2047 7.53434 36.9675 7.46501C34.8642 6.86433 32.6874 6.56056 30.5 6.56251C24.284 6.56251 18.3226 9.03181 13.9272 13.4272C9.5318 17.8226 7.0625 23.784 7.0625 30Z" fill                                                                                                                                                                                                                                                                                                                                           = "currentColor" />
				<path id = "Vector_3" d = "M18.3126 30C18.3196 31.6558 18.6639 33.2928 19.3247 34.8111C19.9855 36.3293 20.9487 37.697 22.1557 38.8306C23.3627 39.9641 24.788 40.8398 26.3447 41.4041C27.9014 41.9684 29.5568 42.2096 31.2098 42.1128C32.8628 42.016 34.4787 41.5833 35.9589 40.8411C37.4391 40.099 38.7525 39.0629 39.8189 37.7963C40.8853 36.5296 41.6824 35.0588 42.1614 33.4738C42.6404 31.8888 42.7914 30.2228 42.6051 28.5775C42.5526 28.2442 42.5912 27.903 42.7168 27.59C42.8425 27.2769 43.0505 27.0037 43.3187 26.7992C43.587 26.5947 43.9056 26.4666 44.2408 26.4284C44.576 26.3903 44.9152 26.4435 45.2226 26.5825C45.8501 26.8625 46.2726 27.46 46.3276 28.145C46.7158 31.4331 46.0699 34.7604 44.4798 37.6646C42.8897 40.5687 40.4343 42.9053 37.455 44.3496C34.4757 45.7939 31.1204 46.2741 27.8556 45.7236C24.5907 45.173 21.5785 43.6189 19.2376 41.2775C16.8973 38.9385 15.3429 35.9293 14.7899 32.6672C14.2369 29.405 14.7127 26.0516 16.1514 23.0721C17.5901 20.0925 19.9203 17.6345 22.8188 16.0389C25.7173 14.4434 29.0406 13.7893 32.3276 14.1675C32.5761 14.1905 32.8175 14.2629 33.0376 14.3805C33.2577 14.4981 33.4522 14.6584 33.6095 14.8521C33.7669 15.0457 33.884 15.2689 33.9541 15.5084C34.0241 15.7479 34.0456 15.999 34.0173 16.247C33.989 16.4949 33.9115 16.7347 33.7893 16.9524C33.6671 17.17 33.5028 17.361 33.3058 17.5142C33.1089 17.6675 32.8833 17.7799 32.6423 17.8448C32.4014 17.9098 32.1499 17.926 31.9026 17.8925C30.1952 17.6951 28.4653 17.861 26.8265 18.3793C25.1877 18.8976 23.6771 19.7567 22.3937 20.9C21.1103 22.0434 20.0833 23.4452 19.3799 25.0135C18.6766 26.5818 18.3128 28.2812 18.3126 30Z" fill = "currentColor" />
				</g>
			</svg>';
				break;

			case 'about-service':
				return ' <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g    id = "stethescope">
				<g    id = "Group">
				<path id = "Vector" d           = "M13.2852 10.5494C13.7734 10.5494 14.2529 10.4212 14.6757 10.1777C15.0984 9.93414 15.4495 9.58388 15.6936 9.16208C15.9377 8.74027 16.0662 8.26179 16.0662 7.77473C16.0662 7.28767 15.9377 6.80918 15.6936 6.38737C15.4496 5.96556 15.0985 5.61529 14.6758 5.37175C14.253 5.12822 13.7735 5 13.2853 5C12.7972 5 12.3176 5.1282 11.8949 5.37173C11.4721 5.61526 11.121 5.96553 10.877 6.38734H10.5043C9.39803 6.38734 8.33704 6.82584 7.55476 7.60637C6.77249 8.38691 6.33301 9.44553 6.33301 10.5494V23.0355H9.11389V10.5494C9.11389 10.1814 9.26039 9.82855 9.52114 9.56837C9.7819 9.3082 10.1356 9.16203 10.5043 9.16203H10.877C11.121 9.58382 11.4721 9.93409 11.8948 10.1776C12.3176 10.4211 12.7971 10.5494 13.2852 10.5494Z" fill = "currentColor" />
				<path id = "Vector_2" fill-rule = "evenodd" clip-rule                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    = "evenodd" d = "M10.7269 23.0355H6.33313C5.5656 23.0355 4.93573 23.6584 5.00525 24.4214C5.28607 27.4934 6.49336 30.4084 8.46795 32.7821C10.4425 35.1557 13.0917 36.8765 16.0662 37.7177V41.0709C16.0662 42.8828 17.2272 44.4255 18.8471 44.9971C18.8619 47.6647 19.9381 50.2172 21.839 52.0931C23.7399 53.969 26.3099 55.0146 28.9834 54.9998C31.657 54.9851 34.2152 53.9113 36.0953 52.0146C37.9753 50.1179 39.0233 47.5537 39.0085 44.8861V39.3367C39.0085 37.9569 39.5579 36.6337 40.5357 35.658C41.5136 34.6823 42.8398 34.1342 44.2227 34.1342C45.6056 34.1342 46.9318 34.6823 47.9096 35.658C48.8875 36.6337 49.4368 37.9569 49.4368 39.3367V42.6941C48.5087 43.0214 47.7265 43.6655 47.2283 44.5126C46.7302 45.3598 46.5482 46.3553 46.7146 47.3234C46.881 48.2914 47.3851 49.1696 48.1376 49.8027C48.8902 50.4358 49.8429 50.783 50.8273 50.783C51.8116 50.783 52.7643 50.4358 53.5169 49.8027C54.2695 49.1696 54.7735 48.2914 54.9399 47.3234C55.1063 46.3553 54.9244 45.3598 54.4262 44.5126C53.9281 43.6655 53.1458 43.0214 52.2177 42.6941V39.3367C52.2177 37.2211 51.3754 35.192 49.876 33.696C48.3767 32.2 46.3431 31.3595 44.2227 31.3595C42.1023 31.3595 40.0687 32.2 38.5693 33.696C37.07 35.192 36.2276 37.2211 36.2276 39.3367V44.8861C36.2424 46.8178 35.4874 48.6763 34.1289 50.0526C32.7703 51.429 30.9195 52.2104 28.9834 52.2252C27.0474 52.2399 25.1848 51.4866 23.8054 50.1311C22.426 48.7756 21.6427 46.9288 21.628 44.9971C22.4415 44.7099 23.1458 44.1781 23.6438 43.475C24.1418 42.7718 24.4091 41.9319 24.4089 41.0709V37.7177C27.3834 36.8765 30.0326 35.1557 32.0071 32.7821C33.9817 30.4084 35.189 27.4934 35.4698 24.4214C35.5394 23.6584 34.9095 23.0355 34.142 23.0355V10.5494C34.142 9.44553 33.7025 8.38691 32.9202 7.60637C32.1379 6.82584 31.0769 6.38734 29.9706 6.38734H29.598C29.2919 5.85841 28.8194 5.44502 28.2539 5.2113C27.6883 4.97758 27.0613 4.93659 26.47 5.09467C25.8787 5.25275 25.3562 5.60109 24.9836 6.08564C24.6109 6.5702 24.4089 7.16391 24.4089 7.77469C24.4089 8.38547 24.6109 8.97917 24.9836 9.46373C25.3562 9.94829 25.8787 10.2966 26.47 10.4547C27.0613 10.6128 27.6883 10.5718 28.2539 10.3381C28.8194 10.1043 29.2919 9.69097 29.598 9.16203H29.9706C30.3394 9.16203 30.6931 9.3082 30.9538 9.56837C31.2146 9.82855 31.3611 10.1814 31.3611 10.5494V23.0355H29.7482C28.9806 23.0355 28.3702 23.6598 28.2395 24.4159C27.9141 26.2981 26.9328 28.005 25.4686 29.2355C24.0045 30.4659 22.1518 31.1406 20.2375 31.1406C18.3233 31.1406 16.4706 30.4659 15.0065 29.2355C13.5423 28.005 12.561 26.2981 12.2356 24.4159C12.1049 23.6612 11.4944 23.0355 10.7269 23.0355ZM30.7771 25.8101H32.4387C31.8086 28.5687 30.2582 31.032 28.0415 32.7964C25.8248 34.5608 23.0732 35.5218 20.2375 35.5218C17.4019 35.5218 14.6503 34.5608 12.4336 32.7964C10.2169 31.032 8.66651 28.5687 8.03642 25.8101H9.698C10.3126 28.1315 11.6796 30.1847 13.5861 31.6497C15.4925 33.1146 17.8312 33.909 20.2375 33.909C22.6439 33.909 24.9826 33.1146 26.889 31.6497C28.7955 30.1847 30.1625 28.1315 30.7771 25.8101ZM50.8273 45.2329C51.196 45.2329 51.5497 45.3791 51.8105 45.6393C52.0712 45.8995 52.2177 46.2523 52.2177 46.6203C52.2177 46.9882 52.0712 47.3411 51.8105 47.6013C51.5497 47.8615 51.196 48.0076 50.8273 48.0076C50.4585 48.0076 50.1048 47.8615 49.8441 47.6013C49.5833 47.3411 49.4368 46.9882 49.4368 46.6203C49.4368 46.2523 49.5833 45.8995 49.8441 45.6393C50.1048 45.3791 50.4585 45.2329 50.8273 45.2329ZM21.628 38.2962V41.0709C21.628 41.4389 21.4815 41.7917 21.2207 42.0519C20.96 42.3121 20.6063 42.4583 20.2375 42.4583C19.8688 42.4583 19.5151 42.3121 19.2544 42.0519C18.9936 41.7917 18.8471 41.4389 18.8471 41.0709V38.2962H21.628Z" fill = "currentColor" />
					</g>
				</g>
			</svg>';
				break;

			case 'about-units':
				return '<svg width="61" height="60" viewBox="0 0 61 60" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g    id = "Consultation">
				<g    id = "Group">
				<path id = "Vector" d   = "M39.3406 22.7482C41.8935 22.7482 43.9702 20.6714 43.9702 18.1185C43.9702 15.5656 41.8935 13.4889 39.3406 13.4889C36.7877 13.4889 34.7109 15.5656 34.7109 18.1185C34.7109 20.671 36.7877 22.7482 39.3406 22.7482ZM39.3406 15.3407C40.8721 15.3407 42.1184 16.587 42.1184 18.1185C42.1184 19.6501 40.8721 20.8963 39.3406 20.8963C37.809 20.8963 36.5628 19.6501 36.5628 18.1185C36.5628 16.587 37.809 15.3407 39.3406 15.3407Z" fill                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             = "currentColor" />
				<path id = "Vector_2" d = "M53.1854 32.611H48.0651V32.2129C48.0651 27.5213 45.6522 23.501 43.6759 23.501H34.7779C32.8021 23.501 30.3888 27.5213 30.3888 32.2129V32.6118H27.6603C27.4234 30.7008 27.0344 29.095 26.3954 28.5072C25.3289 27.5238 23.265 26.9869 19.899 26.8145C19.8833 26.8136 19.8692 26.8219 19.8527 26.8219C19.8349 26.8219 19.8213 26.8136 19.8035 26.8145C16.4379 26.9877 14.374 27.5246 13.3071 28.5072C12.668 29.095 12.2795 30.7008 12.0422 32.6118H7.81482C6.53873 32.6118 5.5 33.6498 5.5 34.9266C5.5 36.2035 6.53877 37.2415 7.81482 37.2415H11.7277C11.6897 38.6341 11.6918 39.9155 11.7046 40.8324C11.7046 42.3407 13.1084 43.5668 14.8527 43.6176V54.0739C14.8527 54.586 15.2678 54.9998 15.7787 54.9998H18.5564C19.0674 54.9998 19.4824 54.586 19.4824 54.0739V43.7312H20.2231V54.0739C20.2231 54.586 20.6381 54.9998 21.149 54.9998H23.9268C24.4377 54.9998 24.8527 54.586 24.8527 54.0739V43.6163C26.5971 43.5654 28.0009 42.3395 28.0009 40.8431C28.0137 39.9217 28.0158 38.6358 27.9777 37.2393L53.1852 37.2398C54.4613 37.2398 55.5 36.2018 55.5 34.9249C55.5 33.6481 54.4612 32.611 53.1852 32.611L53.1854 32.611ZM32.2404 32.2129C32.2404 28.248 34.1902 25.4971 34.7776 25.3528L43.6434 25.3499C44.263 25.4971 46.2128 28.248 46.2128 32.2129V32.6118H44.4812V29.2876C44.4812 28.7754 44.0662 28.3616 43.5553 28.3616C43.0444 28.3616 42.6294 28.7754 42.6294 29.2876V32.6118H35.8239V29.2876C35.8239 28.7754 35.4089 28.3616 34.8979 28.3616C34.387 28.3616 33.972 28.7754 33.972 29.2876V32.6118H32.2405L32.2404 32.2129ZM7.81496 35.3888C7.5595 35.3888 7.352 35.1805 7.352 34.9259C7.352 34.6712 7.5595 34.4629 7.81496 34.4629H11.8643C11.842 34.7713 11.8217 35.0788 11.8039 35.3888H7.81496ZM23.0002 53.1476H22.0742V42.8049C22.0742 42.2928 21.6592 41.879 21.1483 41.879H18.5557C18.0448 41.879 17.6298 42.2928 17.6298 42.8049V53.1476H16.7039V33.5454H23.0002V53.1476ZM26.1483 40.8312C26.1483 41.2561 25.6196 41.7236 24.852 41.7662V32.6197C24.852 32.1076 24.437 31.6938 23.9261 31.6938H15.7779C15.267 31.6938 14.852 32.1076 14.852 32.6197V41.7662C14.0844 41.7236 13.5557 41.2561 13.5557 40.8187C13.5355 39.3492 13.5603 37.7983 13.6243 36.3383C13.6243 36.3301 13.6289 36.3226 13.6289 36.3143C13.6289 36.3098 13.626 36.3053 13.626 36.2995C13.7678 33.1179 14.0972 30.3764 14.5622 29.868C14.9603 29.5014 16.1789 28.8599 19.8511 28.666C23.5234 28.8595 24.742 29.501 25.1343 29.8623C25.6027 30.3745 25.9333 33.1171 26.0759 36.3013C26.0759 36.3058 26.0731 36.3095 26.0731 36.3133C26.0731 36.3207 26.0768 36.3261 26.0776 36.3335C26.1437 37.7996 26.1685 39.3559 26.1483 40.8313L26.1483 40.8312ZM53.1854 35.3884H27.8996C27.8819 35.0784 27.8624 34.7708 27.8393 34.4625H53.1853C53.4408 34.4625 53.6483 34.6708 53.6483 34.9254C53.6483 35.1801 53.4408 35.3884 53.1854 35.3884Z" fill = "currentColor" />
				<path id = "Vector_3" d = "M12.9073 14.1285H24.555C26.043 18.0451 28.6856 20.1925 32.0483 20.1925C32.0549 20.1917 32.0603 20.1917 32.0669 20.1925C32.5778 20.1925 32.9928 19.7787 32.9928 19.2666C32.9928 18.9797 32.8622 18.723 32.6568 18.5527C32.3624 18.1914 31.265 16.7472 30.2762 14.1284H32.0483C32.5592 14.1284 32.9742 13.7147 32.9742 13.2025L32.9746 5.92568C32.9746 5.41353 32.5596 4.99976 32.0487 4.99976H12.9069C12.396 4.99976 11.981 5.41353 11.981 5.92568V13.2025C11.981 13.7147 12.396 14.1284 12.9069 14.1284L12.9073 14.1285ZM13.8332 6.85162H31.1232V12.2766H28.9758C28.6802 12.2766 28.4025 12.4171 28.2284 12.6552C28.0544 12.8942 28.0036 13.2005 28.0933 13.4832C28.7092 15.4239 29.4219 16.9017 30.0237 17.9479C27.9068 17.0637 26.7292 14.8422 26.0868 12.9106C25.9608 12.532 25.6073 12.2765 25.208 12.2765H13.8334L13.8332 6.85162Z" fill                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   = "currentColor" />
				<path id = "Vector_4" d = "M29.1482 9.6293C29.1482 10.1406 28.7336 10.5552 28.2223 10.5552C27.7106 10.5552 27.2964 10.1406 27.2964 9.6293C27.2964 9.11797 27.7106 8.70337 28.2223 8.70337C28.7336 8.70337 29.1482 9.11797 29.1482 9.6293Z" fill                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            = "currentColor" />
				<path id = "Vector_5" d = "M24.3883 8.70337C23.8791 8.70337 23.4624 9.12004 23.4624 9.6293C23.4624 10.1386 23.8791 10.5552 24.3883 10.5552C24.9067 10.5552 25.3143 10.1386 25.3143 9.6293C25.3143 9.12004 24.9067 8.70337 24.3883 8.70337Z" fill                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           = "currentColor" />
				<path id = "Vector_6" d = "M21.4903 9.6293C21.4903 10.1406 21.0757 10.5552 20.5644 10.5552C20.053 10.5552 19.6384 10.1406 19.6384 9.6293C19.6384 9.11797 20.053 8.70337 20.5644 8.70337C21.0757 8.70337 21.4903 9.11797 21.4903 9.6293Z" fill                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              = "currentColor" />
				<path id = "Vector_7" d = "M16.7409 8.70337C16.2225 8.70337 15.8149 9.12004 15.8149 9.6293C15.8149 10.1386 16.2225 10.5552 16.7409 10.5552C17.2501 10.5552 17.6577 10.1386 17.6577 9.6293C17.6573 9.12004 17.2501 8.70337 16.7409 8.70337Z" fill                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           = "currentColor" />
				<path id = "Vector_8" d = "M15.0615 21.8552C15.0615 24.4081 17.1382 26.4849 19.6912 26.4849C22.2441 26.4849 24.3208 24.4081 24.3208 21.8552C24.3208 19.3023 22.2441 17.2256 19.6912 17.2256C17.1387 17.2256 15.0615 19.3023 15.0615 21.8552ZM22.4689 21.8552C22.4689 23.3868 21.2227 24.633 19.6912 24.633C18.1596 24.633 16.9134 23.3868 16.9134 21.8552C16.9134 20.3237 18.1596 19.0774 19.6912 19.0774C21.2227 19.0774 22.4689 20.3237 22.4689 21.8552Z" fill                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           = "currentColor" />
					</g>
				</g>
			</svg>';
				break;

			case 'readmore-button-arrow':
				return '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g    id = "chevron">
				<path id = "Vector" d = "M6.69728 3.88034L10.4428 7.45582C10.5243 7.53355 10.5818 7.61776 10.6155 7.70844C10.6496 7.79912 10.6667 7.89628 10.6667 7.99992C10.6667 8.10356 10.6496 8.20072 10.6155 8.2914C10.5818 8.38208 10.5243 8.46629 10.4428 8.54401L6.69728 12.1195C6.548 12.262 6.35801 12.3333 6.12731 12.3333C5.8966 12.3333 5.70661 12.262 5.55733 12.1195C5.40805 11.977 5.33341 11.7956 5.33341 11.5754C5.33341 11.3552 5.40805 11.1738 5.55733 11.0313L8.73291 7.99992L5.55733 4.96853C5.40805 4.82603 5.33341 4.64466 5.33341 4.42443C5.33341 4.2042 5.40805 4.02284 5.55733 3.88034C5.70661 3.73784 5.8966 3.66659 6.12731 3.66659C6.35801 3.66659 6.548 3.73784 6.69728 3.88034Z" fill = "currentColor" />
				</g>
			</svg>';
				break;

			case 'date-after-dot':
				return '<svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle id = "Ellipse 20" cx = "2" cy = "2" r = "2" fill = "currentColor" />
			</svg>';
				break;

			case 'video-play-button':
				return '<svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g      id = "Frame 72">
				<circle id = "Ellipse 2" cx = "40" cy                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  = "40" r = "39" stroke = "white" stroke-width = "2" />
				<circle id = "Ellipse 1" cx = "40" cy                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  = "40" r = "34" fill   = "white" />
				<path   id = "Vector" d     = "M47.7723 37.9016C48.4169 38.2912 48.8091 38.9774 48.8091 39.7167C48.8091 40.456 48.4169 41.1422 47.7723 41.492L34.7919 49.2836C34.1239 49.7219 33.2877 49.7396 32.6053 49.3633C32.2698 49.1785 31.9906 48.9092 31.7964 48.5831C31.6021 48.2571 31.4998 47.8861 31.5 47.5084V31.9251C31.5001 31.5475 31.6025 31.1768 31.7967 30.8511C31.991 30.5253 32.27 30.2562 32.6053 30.0714C32.9405 29.8869 33.3198 29.7933 33.7041 29.8004C34.0884 29.8075 34.4639 29.9149 34.7919 30.1117L47.7723 37.9016Z" fill = "currentColor" />
				</g>
			</svg>';
				break;

			case 'portal':
				return '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="ooui:user-avatar-outline"><path id="Vector" d="M10 8.33333C11.4167 8.33333 12.55 7.20833 12.55 5.83333C12.55 4.45833 11.4167 3.33333 10 3.33333C8.58333 3.33333 7.45 4.45833 7.45 5.83333C7.45 7.20833 8.58333 8.33333 10 8.33333ZM10 10C7.66667 10 5.78333 8.13333 5.78333 5.83333C5.78333 3.53333 7.66667 1.66666 10 1.66666C12.3333 1.66666 14.2167 3.53333 14.2167 5.83333C14.2167 8.13333 12.3333 10 10 10ZM4.16667 16.6667H15.8333V15.5583C15.8333 14.1 13.9083 12.5917 10 12.5917C6.09167 12.5917 4.16667 14.1 4.16667 15.5583V16.6667ZM10 10.925C15.55 10.925 17.5 13.7 17.5 15.5583V18.3333H2.5V15.5583C2.5 13.7 4.45 10.925 10 10.925Z" fill="currentColor" /></g></svg>';
				break;

			case 'service-readmore-icon':
				return ' <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<g    id = "chevron">
					<path id = "Vector" d = "M6.69728 3.88034L10.4428 7.45582C10.5243 7.53355 10.5818 7.61776 10.6155 7.70844C10.6496 7.79912 10.6667 7.89628 10.6667 7.99992C10.6667 8.10356 10.6496 8.20072 10.6155 8.2914C10.5818 8.38208 10.5243 8.46629 10.4428 8.54401L6.69728 12.1195C6.548 12.262 6.35801 12.3333 6.12731 12.3333C5.8966 12.3333 5.70661 12.262 5.55733 12.1195C5.40805 11.977 5.33341 11.7956 5.33341 11.5754C5.33341 11.3552 5.40805 11.1738 5.55733 11.0313L8.73291 7.99992L5.55733 4.96853C5.40805 4.82603 5.33341 4.64466 5.33341 4.42443C5.33341 4.2042 5.40805 4.02284 5.55733 3.88034C5.70661 3.73784 5.8966 3.66659 6.12731 3.66659C6.35801 3.66659 6.548 3.73784 6.69728 3.88034Z" fill = "currentColor" />
					</g>
				</svg>';
				break;

			case 'contact-phone-icon':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
					<path d = "M26.6667 20.6667C25.0667 20.6667 23.3333 20.4 21.8667 19.8667H21.4667C21.0667 19.8667 20.8 20 20.5333 20.2667L17.6 23.2C13.8667 21.2 10.6667 18.1333 8.8 14.4L11.7333 11.4667C12.1333 11.0667 12.2667 10.5333 12 10.1333C11.6 8.66667 11.3333 6.93333 11.3333 5.33333C11.3333 4.66667 10.6667 4 10 4H5.33333C4.66667 4 4 4.66667 4 5.33333C4 17.8667 14.1333 28 26.6667 28C27.3333 28 28 27.3333 28 26.6667V22C28 21.3333 27.3333 20.6667 26.6667 20.6667ZM6.66667 6.66667H8.66667C8.8 7.86667 9.06667 9.06667 9.33333 10.1333L7.73333 11.7333C7.2 10.1333 6.8 8.4 6.66667 6.66667ZM25.3333 25.3333C23.6 25.2 21.8667 24.8 20.2667 24.2667L21.8667 22.6667C22.9333 22.9333 24.1333 23.2 25.3333 23.2V25.3333Z" fill = "currentColor"/>
				</svg>';
				break;

			case 'contact-ph':
				return '<svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.86128 8.56921C6.96897 10.7461 8.75358 12.5231 10.9305 13.6384L12.6228 11.9461C12.8305 11.7384 13.1382 11.6692 13.4074 11.7615C14.269 12.0461 15.1997 12.2 16.1536 12.2C16.5767 12.2 16.9228 12.5461 16.9228 12.9692V15.6538C16.9228 16.0769 16.5767 16.4231 16.1536 16.4231C8.93051 16.4231 3.07666 10.5692 3.07666 3.34614C3.07666 2.92306 3.42281 2.5769 3.84589 2.5769H6.5382C6.96128 2.5769 7.30743 2.92306 7.30743 3.34614C7.30743 4.30767 7.46128 5.23075 7.74589 6.09229C7.83051 6.36152 7.76897 6.66152 7.55358 6.8769L5.86128 8.56921Z" fill="white"/>
                    </svg>';
				break;

			case 'contact-location-icon':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
								<path d = "M16.2039 16.2548C16.9512 16.2548 17.5912 15.9885 18.1239 15.4558C18.6556 14.9241 18.9215 14.2845 18.9215 13.5372C18.9215 12.7898 18.6556 12.1498 18.1239 11.6172C17.5912 11.0854 16.9512 10.8196 16.2039 10.8196C15.4565 10.8196 14.817 11.0854 14.2852 11.6172C13.7526 12.1498 13.4862 12.7898 13.4862 13.5372C13.4862 14.2845 13.7526 14.9241 14.2852 15.4558C14.817 15.9885 15.4565 16.2548 16.2039 16.2548ZM16.2039 26.2421C18.9668 23.7056 21.0163 21.4011 22.3525 19.3284C23.6886 17.2567 24.3567 15.4169 24.3567 13.8089C24.3567 11.3404 23.5695 9.31897 21.9951 7.74456C20.4216 6.17106 18.4912 5.38431 16.2039 5.38431C13.9165 5.38431 11.9857 6.17106 10.4113 7.74456C8.83775 9.31897 8.051 11.3404 8.051 13.8089C8.051 15.4169 8.71908 17.2567 10.0552 19.3284C11.3914 21.4011 13.4409 23.7056 16.2039 26.2421ZM16.2039 29.3334C16.0227 29.3334 15.8415 29.2994 15.6603 29.2314C15.4792 29.1635 15.3206 29.0729 15.1848 28.9597C11.8783 26.0382 9.40981 23.3265 7.77923 20.8245C6.14866 18.3216 5.33337 15.983 5.33337 13.8089C5.33337 10.4119 6.42631 7.70561 8.61219 5.69004C10.7972 3.67447 13.3277 2.66669 16.2039 2.66669C19.08 2.66669 21.6106 3.67447 23.7955 5.69004C25.9814 7.70561 27.0744 10.4119 27.0744 13.8089C27.0744 15.983 26.2591 18.3216 24.6285 20.8245C22.9979 23.3265 20.5294 26.0382 17.223 28.9597C17.0871 29.0729 16.9286 29.1635 16.7474 29.2314C16.5662 29.2994 16.385 29.3334 16.2039 29.3334Z" fill = "currentColor"/>
							</svg>';
				break;

			case 'contact-email-icon':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
								<path d = "M29.3334 7.99998C29.3334 6.53331 28.1334 5.33331 26.6667 5.33331H5.33341C3.86675 5.33331 2.66675 6.53331 2.66675 7.99998V24C2.66675 25.4666 3.86675 26.6666 5.33341 26.6666H26.6667C28.1334 26.6666 29.3334 25.4666 29.3334 24V7.99998ZM26.6667 7.99998L16.0001 14.6533L5.33341 7.99998H26.6667ZM26.6667 24H5.33341V10.6666L16.0001 17.3333L26.6667 10.6666V24Z" fill = "currentColor"/>
							</svg>';
				break;

			case 'vk':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d = "M12.544 10.7223H11.2128C10.7094 10.7223 10.5577 10.3145 9.65533 9.4115C8.86667 8.65142 8.53358 8.55692 8.33408 8.55692C8.05817 8.55692 7.98292 8.63275 7.98292 9.0125V10.2095C7.98292 10.5333 7.87792 10.7228 7.03208 10.7228C6.2115 10.6677 5.41576 10.4184 4.7104 9.99551C4.00504 9.57259 3.41024 8.98816 2.975 8.29033C1.94156 7.0041 1.2225 5.49446 0.875 3.8815C0.875 3.682 0.950833 3.50117 1.33117 3.50117H2.66117C3.003 3.50117 3.12608 3.65342 3.26025 4.00517C3.906 5.90567 5.00792 7.55883 5.45533 7.55883C5.62683 7.55883 5.7015 7.483 5.7015 7.05542V5.09775C5.64492 4.20467 5.17067 4.12942 5.17067 3.80625C5.17667 3.72099 5.21567 3.64143 5.27938 3.58446C5.3431 3.5275 5.42652 3.49762 5.51192 3.50117H7.60258C7.88842 3.50117 7.98292 3.6435 7.98292 3.98533V6.62783C7.98292 6.91308 8.10542 7.00758 8.19175 7.00758C8.36325 7.00758 8.49508 6.91308 8.8095 6.59925C9.48346 5.77733 10.0341 4.8616 10.444 3.88092C10.486 3.76317 10.5653 3.66239 10.6699 3.59393C10.7744 3.52547 10.8986 3.4931 11.0232 3.50175H12.3538C12.7528 3.50175 12.8374 3.70125 12.7528 3.98592C12.2689 5.06999 11.6701 6.09904 10.9667 7.05542C10.8232 7.27417 10.766 7.38792 10.9667 7.64458C11.0985 7.84408 11.5652 8.23375 11.8784 8.60417C12.3346 9.05917 12.7132 9.58533 12.9996 10.1617C13.1139 10.5327 12.9237 10.7223 12.544 10.7223Z" fill = "currentColor"/>
						</svg>';
				break;

			case 'ok':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d = "M6.99182 7.19892C5.3439 7.19892 3.97423 5.83042 3.97423 4.21108C3.97423 2.53575 5.3439 1.16667 6.9924 1.16667C8.6969 1.16667 10.01 2.53517 10.01 4.21108C10.007 5.0062 9.68853 5.76761 9.12444 6.32798C8.56035 6.88835 7.79685 7.20182 7.00173 7.1995L6.99182 7.19892ZM6.99182 2.92658C6.29415 2.92658 5.76332 3.51283 5.76332 4.21167C5.76332 4.90933 6.29415 5.44017 6.9924 5.44017C7.71865 5.44017 8.22148 4.90933 8.22148 4.21167C8.22207 3.51225 7.71865 2.92658 6.99182 2.92658ZM8.19348 9.68508L9.89857 11.333C10.234 11.6952 10.234 12.2261 9.89857 12.5615C9.53573 12.9237 8.97632 12.9237 8.6969 12.5615L6.9924 10.8856L5.3439 12.5615C5.17648 12.7289 4.95248 12.8123 4.70048 12.8123C4.50507 12.8123 4.28165 12.7283 4.08565 12.5615C3.75023 12.2261 3.75023 11.6952 4.08565 11.3324L5.81815 9.6845C5.19249 9.49922 4.5923 9.23685 4.0314 8.90342C3.61198 8.68 3.52857 8.12175 3.75198 7.70233C4.0314 7.2835 4.53423 7.17208 4.98165 7.4515C5.5875 7.82122 6.28352 8.01683 6.99328 8.01683C7.70303 8.01683 8.39905 7.82122 9.0049 7.4515C9.45232 7.17208 9.98257 7.2835 10.234 7.70233C10.486 8.12175 10.3734 8.67942 9.98198 8.90342C9.45173 9.23883 8.8369 9.49025 8.19407 9.68567L8.19348 9.68508Z" fill = "currentColor"/>
						</svg>';
				break;

			case 'rss':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d = "M3.60492 9.12333C3.94219 9.12333 4.26564 9.25731 4.50412 9.4958C4.74261 9.73428 4.87658 10.0577 4.87658 10.395C4.87658 11.0833 4.30492 11.6667 3.60492 11.6667C2.91659 11.6667 2.33325 11.0833 2.33325 10.395C2.33325 10.0577 2.46723 9.73428 2.70571 9.4958C2.9442 9.25731 3.26765 9.12333 3.60492 9.12333ZM2.33325 2.59C4.74053 2.59 7.04922 3.54629 8.75142 5.24849C10.4536 6.9507 11.4099 9.25938 11.4099 11.6667H9.75908C9.75908 9.69721 8.97672 7.80842 7.58411 6.41581C6.1915 5.0232 4.30271 4.24083 2.33325 4.24083V2.59ZM2.33325 5.89167C3.86488 5.89167 5.33377 6.5001 6.41679 7.58312C7.49982 8.66615 8.10825 10.135 8.10825 11.6667H6.45742C6.45742 10.5729 6.02291 9.52387 5.24948 8.75044C4.47605 7.97701 3.42705 7.5425 2.33325 7.5425V5.89167Z" fill = "currentColor"/>
						</svg>';
				break;

			case 'facebook_group':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule = "evenodd" clip-rule = "evenodd" d = "M3.34512 9.07171C3.21096 9.05246 3.06833 9.04167 2.91667 9.04167C1.79958 9.04167 1.17571 9.63113 0.936541 9.92483C0.89775 9.97529 0.877043 10.0371 0.877043 10.101C0.877043 10.1028 0.877041 10.1045 0.876749 10.106C0.874999 10.2139 0.875 10.3568 0.875 10.5C0.875 10.661 1.00567 10.7917 1.16667 10.7917H3.2585C3.22554 10.6989 3.20833 10.6003 3.20833 10.5C3.20833 10.1681 3.20833 9.77258 3.2095 9.53896C3.2095 9.37271 3.25704 9.21083 3.34512 9.07171ZM9.91667 10.7917H4.08333C4.00604 10.7917 3.93167 10.761 3.87712 10.7062C3.82229 10.6517 3.79167 10.5773 3.79167 10.5C3.79167 10.169 3.79167 9.77521 3.79283 9.54071C3.79283 9.54013 3.79283 9.53954 3.79283 9.53896C3.79283 9.47188 3.81617 9.40713 3.85846 9.35521C4.22042 8.94192 5.31417 7.875 7 7.875C8.90808 7.875 9.86621 8.93988 10.1593 9.3415C10.1917 9.39079 10.2083 9.4465 10.2083 9.50338V10.5C10.2083 10.5773 10.1777 10.6517 10.1229 10.7062C10.0683 10.761 9.99396 10.7917 9.91667 10.7917ZM10.7415 10.7917H12.8333C12.9943 10.7917 13.125 10.661 13.125 10.5V10.1007C13.125 10.0363 13.1037 9.97384 13.0646 9.92279C12.8243 9.63113 12.2001 9.04167 11.0833 9.04167C10.9395 9.04167 10.8039 9.05129 10.6762 9.06879C10.7517 9.20092 10.7917 9.35083 10.7917 9.50396V10.5C10.7917 10.6003 10.7745 10.6989 10.7415 10.7917ZM2.91667 5.54167C2.11167 5.54167 1.45833 6.195 1.45833 7C1.45833 7.805 2.11167 8.45833 2.91667 8.45833C3.72167 8.45833 4.375 7.805 4.375 7C4.375 6.195 3.72167 5.54167 2.91667 5.54167ZM11.0833 5.54167C10.2783 5.54167 9.625 6.195 9.625 7C9.625 7.805 10.2783 8.45833 11.0833 8.45833C11.8883 8.45833 12.5417 7.805 12.5417 7C12.5417 6.195 11.8883 5.54167 11.0833 5.54167ZM7 3.20833C5.87329 3.20833 4.95833 4.12329 4.95833 5.25C4.95833 6.37671 5.87329 7.29167 7 7.29167C8.12671 7.29167 9.04167 6.37671 9.04167 5.25C9.04167 4.12329 8.12671 3.20833 7 3.20833Z" fill = "currentColor"/>
						</svg>';
				break;

			case 'discord':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d = "M11.2407 3.10917C10.4649 2.7475 9.62491 2.485 8.74991 2.33333C8.74223 2.33309 8.7346 2.33453 8.72755 2.33755C8.72049 2.34058 8.71419 2.34511 8.70907 2.35083C8.60407 2.54333 8.48157 2.79417 8.39991 2.98667C7.47182 2.84667 6.52799 2.84667 5.59991 2.98667C5.51824 2.78833 5.39574 2.54333 5.28491 2.35083C5.27907 2.33917 5.26157 2.33333 5.24407 2.33333C4.36907 2.485 3.53491 2.7475 2.75324 3.10917C2.74741 3.10917 2.74157 3.115 2.73574 3.12083C1.14907 5.495 0.711572 7.805 0.927406 10.0917C0.927406 10.1033 0.933239 10.115 0.944906 10.1208C1.99491 10.8908 3.00407 11.3575 4.00157 11.6667C4.01907 11.6725 4.03657 11.6667 4.04241 11.655C4.27574 11.3342 4.48574 10.9958 4.66657 10.64C4.67824 10.6167 4.66657 10.5933 4.64324 10.5875C4.31074 10.4592 3.99574 10.3075 3.68657 10.1325C3.66324 10.1208 3.66324 10.0858 3.68074 10.0683C3.74491 10.0217 3.80907 9.96917 3.87324 9.9225C3.88491 9.91083 3.90241 9.91083 3.91407 9.91667C5.92074 10.8325 8.08491 10.8325 10.0682 9.91667C10.0799 9.91083 10.0974 9.91083 10.1091 9.9225C10.1732 9.975 10.2374 10.0217 10.3016 10.0742C10.3249 10.0917 10.3249 10.1267 10.2957 10.1383C9.9924 10.3192 9.67157 10.465 9.33907 10.5933C9.31574 10.5992 9.30991 10.6283 9.31574 10.6458C9.50241 11.0017 9.71241 11.34 9.93991 11.6608C9.95741 11.6667 9.9749 11.6725 9.9924 11.6667C10.9957 11.3575 12.0049 10.8908 13.0549 10.1208C13.0666 10.115 13.0724 10.1033 13.0724 10.0917C13.3291 7.44917 12.6466 5.15667 11.2641 3.12083C11.2582 3.115 11.2524 3.10917 11.2407 3.10917ZM4.96991 8.6975C4.36907 8.6975 3.86741 8.14333 3.86741 7.46083C3.86741 6.77833 4.35741 6.22417 4.96991 6.22417C5.58824 6.22417 6.07824 6.78417 6.07241 7.46083C6.07241 8.14333 5.58241 8.6975 4.96991 8.6975ZM9.03574 8.6975C8.43491 8.6975 7.93324 8.14333 7.93324 7.46083C7.93324 6.77833 8.42324 6.22417 9.03574 6.22417C9.65407 6.22417 10.1441 6.78417 10.1382 7.46083C10.1382 8.14333 9.65407 8.6975 9.03574 8.6975Z" fill = "currentColor"/>
						</svg>';
				break;

			case 'tripadvisor':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d = "M7.0035 2.50542C5.446 2.50542 3.88967 2.96275 2.54392 3.878H0L1.14508 5.12342C0.623353 5.59876 0.25761 6.22081 0.0959002 6.90783C-0.0658095 7.59486 -0.0159218 8.31473 0.23901 8.97288C0.493941 9.63104 0.941993 10.1967 1.5243 10.5955C2.10661 10.9944 2.79595 11.2077 3.50175 11.2076C4.38364 11.2084 5.23306 10.8748 5.87883 10.2743L7 11.4946L8.12117 10.2754C8.76656 10.8754 9.61532 11.2085 10.4965 11.2076C11.4246 11.2076 12.3146 10.839 12.971 10.1829C13.6273 9.52675 13.9962 8.63681 13.9965 7.70875C13.997 7.22203 13.8958 6.74059 13.6992 6.29534C13.5026 5.8501 13.215 5.45091 12.8549 5.12342L14 3.878H11.4625C10.1478 2.983 8.59396 2.50471 7.0035 2.50542ZM7 3.64875C7.89308 3.64875 8.78675 3.8255 9.62733 4.1755C8.13342 4.74717 7 6.08417 7 7.64167C7 6.08358 5.86717 4.74717 4.37267 4.1755C5.20516 3.82853 6.09809 3.64912 7 3.64875ZM3.50117 5.34158C3.8121 5.34158 4.12 5.40283 4.40727 5.52182C4.69453 5.64081 4.95555 5.81522 5.17542 6.03508C5.39528 6.25495 5.56969 6.51597 5.68868 6.80324C5.80767 7.0905 5.86892 7.3984 5.86892 7.70933C5.86892 8.02027 5.80767 8.32816 5.68868 8.61543C5.56969 8.9027 5.39528 9.16372 5.17542 9.38359C4.95555 9.60345 4.69453 9.77786 4.40727 9.89685C4.12 10.0158 3.8121 10.0771 3.50117 10.0771C2.8732 10.0771 2.27095 9.82763 1.82691 9.38359C1.38288 8.93955 1.13342 8.3373 1.13342 7.70933C1.13342 7.08137 1.38288 6.47912 1.82691 6.03508C2.27095 5.59104 2.8732 5.34158 3.50117 5.34158ZM10.4965 5.34275C10.8073 5.34264 11.1151 5.40374 11.4023 5.52258C11.6895 5.64142 11.9505 5.81567 12.1704 6.03537C12.3903 6.25508 12.5647 6.51594 12.6837 6.80305C12.8028 7.09017 12.8641 7.39793 12.8642 7.70875C12.8644 8.01957 12.8033 8.32737 12.6844 8.61458C12.5656 8.90179 12.3913 9.16277 12.1716 9.38264C11.9519 9.60251 11.6911 9.77695 11.4039 9.896C11.1168 10.0151 10.8091 10.0764 10.4982 10.0765C9.87052 10.0767 9.2684 9.82759 8.82436 9.38388C8.38032 8.94017 8.13073 8.33824 8.1305 7.7105C8.13027 7.08277 8.37941 6.48065 8.82312 6.03661C9.26683 5.59257 9.86877 5.34298 10.4965 5.34275ZM3.50117 6.46858C3.17194 6.46858 2.85621 6.59937 2.62341 6.83216C2.39062 7.06496 2.25983 7.3807 2.25983 7.70992C2.25983 8.03914 2.39062 8.35488 2.62341 8.58767C2.85621 8.82047 3.17194 8.95125 3.50117 8.95125C3.83039 8.95125 4.14613 8.82047 4.37892 8.58767C4.61172 8.35488 4.7425 8.03914 4.7425 7.70992C4.7425 7.3807 4.61172 7.06496 4.37892 6.83216C4.14613 6.59937 3.83039 6.46858 3.50117 6.46858ZM10.4965 6.46858C10.1673 6.46858 9.85154 6.59937 9.61874 6.83216C9.38595 7.06496 9.25517 7.3807 9.25517 7.70992C9.25517 8.03914 9.38595 8.35488 9.61874 8.58767C9.85154 8.82047 10.1673 8.95125 10.4965 8.95125C10.8257 8.95125 11.1415 8.82047 11.3743 8.58767C11.6071 8.35488 11.7378 8.03914 11.7378 7.70992C11.7378 7.3807 11.6071 7.06496 11.3743 6.83216C11.1415 6.59937 10.8257 6.46858 10.4965 6.46858Z" fill = "currentColor"/>
						</svg>';
				break;

			case 'foursquare':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<mask id = "mask0_1986_9435" style                                                          = "mask-type:luminance" maskUnits = "userSpaceOnUse" x       = "3" y                    = "0" width               = "9" height = "14">
						<path d  = "M11.0833 1.16667H4.08325V12.8333L6.99992 7.58333H9.33325L11.0833 1.16667Z" fill = "white" stroke                  = "white" stroke-width     = "1.16667" stroke-linecap = "round" stroke-linejoin = "round"/>
						<path d  = "M10.2082 4.375H7.2915" stroke                                                   = "black" stroke-width            = "1.16667" stroke-linecap = "round" stroke-linejoin  = "round"/>
						<path d  = "M10.6853 2.625L9.73071 6.125" stroke                                            = "white" stroke-width            = "1.16667" stroke-linecap = "round" stroke-linejoin  = "round"/>
						</mask>
						<g    mask = "url(#mask0_1986_9435)">
						<path d    = "M0 0H14V14H0V0Z" fill = "currentColor"/>
						</g>
						</svg>';
				break;

			case 'yelp':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d = "M3.66456 8.83313L4.30856 8.68438L4.37244 8.66688C4.48319 8.63719 4.58511 8.58116 4.66954 8.50358C4.75397 8.42599 4.81839 8.32915 4.85732 8.2213C4.89624 8.11345 4.90853 7.99779 4.89312 7.88417C4.87771 7.77055 4.83506 7.66234 4.76881 7.56876C4.69722 7.47678 4.60798 7.40002 4.50631 7.34301C4.38622 7.27552 4.261 7.21759 4.13181 7.16976L3.42481 6.91163C3.02836 6.76405 2.63051 6.62025 2.23131 6.48026C1.97144 6.38751 1.75006 6.30701 1.56019 6.24751C1.52431 6.23613 1.48406 6.22563 1.45169 6.21426C1.2809 6.1545 1.10222 6.1203 0.921438 6.11276C0.827291 6.10879 0.733452 6.12598 0.646833 6.16308C0.560213 6.20019 0.48302 6.25624 0.420938 6.32713C0.388702 6.36432 0.35805 6.40286 0.329063 6.44263C0.274222 6.5276 0.228748 6.61825 0.193438 6.71301C0.0621876 7.10063 -0.00343737 7.50751 0.000937634 7.91701C0.00268763 8.28713 0.0123126 8.76226 0.216188 9.08426C0.265281 9.16671 0.330805 9.23819 0.408688 9.29426C0.553938 9.39401 0.700063 9.40713 0.852313 9.41763C1.07981 9.43426 1.30119 9.37826 1.52081 9.32751L3.66194 8.83226L3.66456 8.83313ZM10.8562 5.41101C10.68 5.04187 10.4434 4.70474 10.1562 4.41351C10.0829 4.34374 10.0022 4.28213 9.91556 4.22976C9.87272 4.20665 9.82893 4.18534 9.78431 4.16588C9.69747 4.12952 9.60358 4.11307 9.50955 4.11777C9.41551 4.12246 9.32373 4.14817 9.24094 4.19301C9.11669 4.25426 8.98369 4.35226 8.80694 4.51676C8.78244 4.54126 8.75181 4.56926 8.72469 4.59463C8.57856 4.73113 8.41581 4.90088 8.22244 5.09776C7.92494 5.39876 7.63035 5.70268 7.33869 6.00951L6.81544 6.55201C6.72028 6.65147 6.6331 6.75825 6.55469 6.87138C6.4881 6.96732 6.44139 7.07561 6.41731 7.18988C6.40267 7.27727 6.40474 7.36665 6.42344 7.45326C6.42344 7.45734 6.42431 7.46113 6.42606 7.46463C6.46679 7.64433 6.57589 7.80111 6.73025 7.90173C6.88461 8.00235 7.07209 8.0389 7.25294 8.00363L7.31769 7.99138L10.1046 7.34738C10.3242 7.29663 10.5473 7.24938 10.7451 7.13563C10.8772 7.05863 11.0032 6.98251 11.0898 6.82938C11.1355 6.74466 11.1632 6.65142 11.1712 6.55551C11.2149 6.17576 11.0154 5.74438 10.8562 5.41101ZM5.86781 6.58263C6.06906 6.32888 6.06906 5.95088 6.08656 5.64201C6.14781 4.60863 6.21169 3.57526 6.26244 2.54188C6.28169 2.14988 6.32369 1.76313 6.30094 1.36938C6.28169 1.04388 6.27906 0.670259 6.07344 0.403384C5.71206 -0.0673664 4.93856 -0.0288664 4.41006 0.0437586C4.2479 0.0659253 4.0866 0.0962586 3.92619 0.134759C3.76633 0.172628 3.60786 0.216113 3.45106 0.265134C2.94356 0.431384 2.23219 0.735009 2.11231 1.31863C2.04406 1.64851 2.20506 1.98626 2.33019 2.28726C2.48156 2.65213 2.68894 2.98026 2.87706 3.32413C3.37581 4.23063 3.88331 5.13188 4.38906 6.03401C4.53956 6.30351 4.70406 6.64388 4.99719 6.78388C5.01644 6.79263 5.03627 6.79993 5.05669 6.80576C5.18794 6.85563 5.33056 6.86526 5.46706 6.83376L5.49156 6.82763C5.61783 6.79381 5.7321 6.72531 5.82144 6.62988L5.86781 6.58263ZM5.62631 9.34851C5.53732 9.22479 5.40753 9.13643 5.25981 9.09898C5.11208 9.06153 4.95588 9.07738 4.81869 9.14376C4.77423 9.16634 4.73178 9.19269 4.69181 9.22251C4.57846 9.31282 4.47676 9.41687 4.38906 9.53226C4.36631 9.56113 4.34531 9.59963 4.31906 9.62326L3.87106 10.2401C3.61731 10.5849 3.36619 10.9328 3.11769 11.284C2.95581 11.5115 2.81494 11.7031 2.70469 11.8729L2.64169 11.9691C2.50869 12.1748 2.43344 12.3244 2.39494 12.4583C2.3654 12.5467 2.35642 12.6406 2.36869 12.733C2.38006 12.8293 2.41244 12.9229 2.46319 13.006C2.49002 13.0468 2.51919 13.0871 2.55069 13.1268C2.61785 13.2039 2.69325 13.2734 2.77556 13.3341C3.34679 13.7202 4.00939 13.9495 4.69706 13.9991C4.79941 14.0024 4.90182 13.9945 5.00244 13.9755C5.05055 13.9635 5.09814 13.9495 5.14506 13.9335C5.23609 13.8991 5.31894 13.846 5.38831 13.7778C5.45497 13.7125 5.50585 13.6329 5.53706 13.545C5.58869 13.4164 5.62281 13.2519 5.64469 13.0086L5.65519 12.8949C5.67269 12.6928 5.68144 12.4556 5.69456 12.1765C5.71615 11.7478 5.73365 11.3193 5.74706 10.8911L5.77594 10.1299C5.7872 9.94679 5.77097 9.76305 5.72781 9.58476C5.70552 9.50139 5.6719 9.42178 5.62631 9.34851ZM10.6864 10.5403C10.5577 10.4098 10.4109 10.2985 10.2507 10.2095L10.1527 10.1509C9.97856 10.0459 9.76944 9.93563 9.52356 9.80263C9.14789 9.59672 8.77019 9.39401 8.39044 9.19451L7.71931 8.83838C7.68431 8.82788 7.64931 8.80338 7.61606 8.78676C7.48668 8.72165 7.34972 8.67286 7.20831 8.64151C7.15927 8.63202 7.1095 8.62675 7.05956 8.62576C6.90733 8.62669 6.76029 8.68123 6.64428 8.77981C6.52827 8.87838 6.45069 9.01468 6.42519 9.16476C6.41549 9.25018 6.41844 9.33657 6.43394 9.42113C6.46719 9.59963 6.54769 9.77638 6.62994 9.93126L6.98869 10.6033C7.1876 10.9824 7.3906 11.3598 7.59769 11.7355C7.73069 11.9805 7.84269 12.1905 7.94594 12.3646C7.96694 12.3979 7.98677 12.4305 8.00544 12.4626C8.13231 12.6718 8.23381 12.8039 8.33706 12.8975C8.40538 12.9638 8.48767 13.0141 8.5779 13.0445C8.66813 13.0749 8.76402 13.0848 8.85856 13.0734C8.9079 13.067 8.95694 13.0586 9.00556 13.048C9.10419 13.0209 9.19955 12.983 9.28994 12.9351C9.56322 12.7827 9.81484 12.5944 10.0381 12.3751C10.3058 12.1126 10.5429 11.8239 10.7276 11.4949C10.7538 11.4482 10.776 11.4001 10.7941 11.3505C10.8109 11.3042 10.8258 11.2572 10.8387 11.2096C10.8498 11.1612 10.8582 11.1122 10.8641 11.0626C10.8729 10.966 10.8616 10.8685 10.8308 10.7765C10.8013 10.6878 10.752 10.607 10.6864 10.5403Z" fill = "currentColor"/>
						</svg>';
				break;

			case 'hacker_news':
				return '<svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d = "M2.4375 2.1875V11.8125H12.0625V2.1875H2.4375ZM3.3125 3.0625H11.1875V10.9375H3.3125V3.0625ZM5.28125 4.8125L6.8125 7.4375V9.625H7.6875V7.4375L9.21875 4.8125H8.34375L7.25 6.68544L6.15625 4.8125H5.28125Z" fill = "currentColor"/>
						</svg>';
				break;

			case 'xing':
				return '<svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d = "M12.1861 1.88417C12.2759 1.88417 12.3658 1.92967 12.4101 1.97458C12.4322 2.01597 12.4437 2.06214 12.4437 2.10904C12.4437 2.15594 12.4322 2.20212 12.4101 2.2435L8.86577 8.526L11.1093 12.6537C11.1314 12.6951 11.143 12.7414 11.143 12.7884C11.143 12.8354 11.1314 12.8817 11.1093 12.9232C11.0478 12.9794 10.968 13.0113 10.8847 13.013H9.26886C9.04486 13.013 8.91069 12.8333 8.82086 12.6986L6.53244 8.52542C6.66661 8.34633 10.1223 2.19917 10.1223 2.19917C10.2115 2.0195 10.3463 1.88533 10.5709 1.88533L12.1861 1.88417ZM5.45502 4.08333C5.67961 4.08333 5.81436 4.263 5.90419 4.39717L7.02594 6.32683C6.93611 6.41667 5.27594 9.37767 5.27594 9.37767C5.18611 9.513 5.05136 9.69267 4.82677 9.69267H3.25702C3.17394 9.69085 3.09434 9.65892 3.03302 9.60283C3.01086 9.56138 2.99927 9.51509 2.99927 9.46808C2.99927 9.42107 3.01086 9.37479 3.03302 9.33333L4.69319 6.32683L3.61636 4.44267C3.5942 4.40121 3.5826 4.35493 3.5826 4.30792C3.5826 4.26091 3.5942 4.21462 3.61636 4.17317C3.67753 4.11721 3.75689 4.08529 3.83977 4.08333H5.45502Z" fill = "currentColor"/>
						</svg>';
				break;

			case 'flipboard':
				return '<svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d = "M0.25 0H4.74167V14H0.25V0ZM5.20833 4.95833H9.75833V9.50833H5.20833V4.95833ZM5.20833 0H14.25V4.49167H5.20833V0Z" fill = "currentColor"/>
						</svg>';
				break;

			case 'weibo':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d = "M2.49557 5.012C4.11315 3.39617 5.9979 2.65942 6.70665 3.36933C7.0199 3.68258 7.04965 4.22333 6.84898 4.86967C6.74515 5.19458 7.15465 5.0155 7.15465 5.0155C8.4619 4.46833 9.6029 4.43567 10.0188 5.03125C10.2405 5.34742 10.2189 5.79308 10.0142 6.30875C9.91907 6.54617 10.0422 6.58292 10.2242 6.63717C10.9603 6.86583 11.7805 7.4165 11.7805 8.3895C11.7805 10.0013 9.45882 12.0289 5.96815 12.0289C3.30523 12.0289 0.583984 10.738 0.583984 8.61525C0.583984 7.50575 1.28632 6.22242 2.49557 5.012ZM9.57315 8.3615C9.4349 6.96675 7.60032 6.00542 5.4764 6.21658C3.35307 6.426 1.74132 7.72742 1.87898 9.12158C2.01723 10.5181 3.85182 11.4777 5.97573 11.2682C8.09965 11.0571 9.70965 9.75625 9.57315 8.3615ZM3.59457 8.42217C4.0344 7.53083 5.17657 7.028 6.18807 7.2905C7.2334 7.56058 7.76715 8.547 7.34073 9.50658C6.90673 10.4883 5.65898 11.0116 4.60198 10.6698C3.57998 10.3396 3.14773 9.331 3.59457 8.42217ZM5.17832 8.75933C4.8499 8.62108 4.42523 8.764 4.22165 9.08192C4.01515 9.401 4.1114 9.7825 4.43807 9.93125C4.7694 10.0812 5.21098 9.93883 5.41573 9.61042C5.61757 9.27908 5.5114 8.9005 5.17832 8.75933ZM5.98682 8.42217C5.86082 8.37317 5.70332 8.43267 5.62923 8.5575C5.55748 8.68233 5.59773 8.82467 5.72432 8.87658C5.85207 8.93025 6.01657 8.86958 6.09065 8.74183C6.1624 8.6135 6.11632 8.47 5.98682 8.42217ZM9.30832 1.70567C9.89181 1.5814 10.4977 1.61279 11.0653 1.79667C11.6328 1.98056 12.142 2.31048 12.5417 2.75333C12.9418 3.19678 13.2182 3.73768 13.3431 4.32171C13.468 4.90575 13.4371 5.51237 13.2534 6.08067C13.2337 6.14209 13.202 6.19901 13.1602 6.24814C13.1184 6.29727 13.0673 6.33764 13.0098 6.36692C12.9523 6.3962 12.8896 6.41382 12.8253 6.41875C12.761 6.42369 12.6963 6.41584 12.6351 6.39567C12.5111 6.35532 12.4082 6.26744 12.3489 6.1513C12.2896 6.03516 12.2788 5.90025 12.3189 5.77617C12.4497 5.37253 12.4719 4.94157 12.3833 4.52663C12.2947 4.11169 12.0983 3.7274 11.814 3.41242C11.5298 3.09745 11.1675 2.86289 10.7638 2.73234C10.3601 2.60179 9.92912 2.57986 9.51423 2.66875C9.38979 2.68815 9.26265 2.65918 9.1589 2.58778C9.05515 2.51639 8.98266 2.40799 8.95631 2.28484C8.92996 2.16168 8.95176 2.03311 9.01721 1.92552C9.08267 1.81792 9.18683 1.73888 9.30832 1.70567ZM9.67348 3.41308C9.95751 3.35244 10.2525 3.36763 10.5288 3.45714C10.8051 3.54665 11.0529 3.70732 11.2475 3.92299C11.442 4.13867 11.5763 4.40175 11.6369 4.68578C11.6975 4.96982 11.6822 5.26481 11.5927 5.54108C11.5764 5.59505 11.5495 5.64522 11.5136 5.68864C11.4777 5.73207 11.4334 5.76788 11.3835 5.79397C11.3335 5.82006 11.2789 5.8359 11.2227 5.84056C11.1665 5.84522 11.11 5.83861 11.0564 5.82112C11.0029 5.80362 10.9533 5.7756 10.9107 5.73869C10.8681 5.70178 10.8334 5.65672 10.8084 5.60618C10.7835 5.55564 10.7689 5.50062 10.7655 5.44436C10.7622 5.3881 10.7701 5.33174 10.7888 5.27858C10.8333 5.1436 10.8412 4.99926 10.8118 4.86023C10.7824 4.7212 10.7167 4.59242 10.6214 4.487C10.5258 4.38183 10.4042 4.30355 10.2689 4.25995C10.1336 4.21635 9.98928 4.20896 9.85023 4.2385C9.74078 4.26194 9.62649 4.24094 9.53252 4.18011C9.43855 4.11929 9.37259 4.02362 9.34915 3.91417C9.32571 3.80471 9.34672 3.69043 9.40754 3.59645C9.46836 3.50248 9.56403 3.43652 9.67348 3.41308Z" fill = "currentColor"/>
						</svg>';
				break;

			case 'tumblr':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d = "M3.65747 4.45083C4.40839 4.28907 5.08121 3.87489 5.56384 3.27731C6.04647 2.67972 6.30978 1.93481 6.30989 1.16667H8.07739V4.172H10.199V6.293H8.07739V9.4745C8.07739 9.77492 8.19289 10.1786 8.60822 10.4469C8.88472 10.626 9.47389 10.7141 10.3757 10.7123V12.8333H7.90064C7.19743 12.8332 6.52307 12.5537 6.02589 12.0564C5.5287 11.5591 5.24939 10.8847 5.24939 10.1815V6.293H3.65747V4.45083Z" fill = "currentColor"/>
						</svg>';
				break;

			case 'qq':
				return '<svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<g    clip-path = "url(#clip0_1986_9424)">
						<path d         = "M7.25004 1.16667C6.31277 1.16657 5.41105 1.52545 4.73017 2.16955C4.04928 2.81366 3.64094 3.69408 3.58904 4.62992L3.50387 6.16408C3.37679 6.43492 3.25716 6.70919 3.14512 6.98658C2.42179 8.77917 2.13712 10.3542 2.51046 10.5053C2.70587 10.584 3.04304 10.2568 3.42396 9.66992C3.57736 10.4717 3.97897 11.2049 4.57196 11.7658C3.97287 11.97 3.45779 12.2488 3.45779 12.5417C3.45779 12.8386 4.90446 12.8351 5.93054 12.8333H5.93112C6.25137 12.8322 6.52029 12.8287 6.73612 12.8001C7.07688 12.8449 7.42204 12.8449 7.76279 12.8001C7.97862 12.8293 8.24871 12.8322 8.56896 12.8328C9.59562 12.8351 11.0417 12.8386 11.0417 12.5417C11.0417 12.2488 10.5266 11.9706 9.92812 11.7658C10.5202 11.2059 10.9215 10.4742 11.0755 9.674C11.4547 10.2585 11.7913 10.584 11.9855 10.5053C12.3589 10.3542 12.0754 8.77858 11.3509 6.98658C11.2402 6.71219 11.1221 6.44084 10.9968 6.17283L10.911 4.62992C10.8591 3.69408 10.4508 2.81366 9.76992 2.16955C9.08903 1.52545 8.18731 1.16657 7.25004 1.16667Z" fill = "currentColor"/>
						</g>
						<defs>
						<clipPath id    = "clip0_1986_9424">
						<rect     width = "14" height = "14" fill = "white" transform = "translate(0.25)"/>
						</clipPath>
						</defs>
						</svg>';
				break;

			case 'strava':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d = "M5.88962 0L1.75 7.98438H4.1895L5.88875 4.80988L7.5775 7.98438H9.99775L5.88962 0ZM9.99775 7.98438L8.79637 10.3959L7.5775 7.98438H5.72862L8.79637 14L11.8449 7.98438H9.99775Z" fill = "currentColor"/>
						</svg>';
				break;

			case 'flickr':
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d = "M0 7C5.74062e-05 7.4263 0.0841019 7.84841 0.247332 8.24222C0.410563 8.63603 0.649781 8.99383 0.951322 9.29516C1.25286 9.5965 1.61082 9.83548 2.00474 9.99844C2.39866 10.1614 2.82083 10.2452 3.24712 10.2449C3.67774 10.252 4.10546 10.1733 4.50535 10.0134C4.90523 9.8535 5.2693 9.61561 5.57632 9.31359C5.88334 9.01157 6.12718 8.65146 6.29362 8.25425C6.46007 7.85704 6.54579 7.43067 6.54579 7C6.54579 6.56933 6.46007 6.14296 6.29362 5.74575C6.12718 5.34854 5.88334 4.98843 5.57632 4.68641C5.2693 4.38439 4.90523 4.1465 4.50535 3.9866C4.10546 3.8267 3.67774 3.74799 3.24712 3.75506C1.456 3.75506 0 5.20669 0 7ZM7.50575 7C7.50581 7.4263 7.58985 7.84841 7.75308 8.24222C7.91631 8.63603 8.15553 8.99383 8.45707 9.29516C8.75861 9.5965 9.11657 9.83548 9.51049 9.99844C9.90441 10.1614 10.3266 10.2452 10.7529 10.2449C12.5392 10.2449 14 8.79331 14 7C14 5.20669 12.5462 3.75506 10.7551 3.75506C8.95956 3.75506 7.50575 5.20669 7.50575 7Z" fill = "currentColor"/>
						</svg>';
				break;

			case 'calendar':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
						<path d = "M8 9.33337C7.81111 9.33337 7.65289 9.26937 7.52533 9.14137C7.39733 9.01382 7.33333 8.8556 7.33333 8.66671C7.33333 8.47782 7.39733 8.31937 7.52533 8.19137C7.65289 8.06382 7.81111 8.00004 8 8.00004C8.18889 8.00004 8.34733 8.06382 8.47533 8.19137C8.60289 8.31937 8.66667 8.47782 8.66667 8.66671C8.66667 8.8556 8.60289 9.01382 8.47533 9.14137C8.34733 9.26937 8.18889 9.33337 8 9.33337ZM5.33333 9.33337C5.14444 9.33337 4.986 9.26937 4.858 9.14137C4.73044 9.01382 4.66667 8.8556 4.66667 8.66671C4.66667 8.47782 4.73044 8.31937 4.858 8.19137C4.986 8.06382 5.14444 8.00004 5.33333 8.00004C5.52222 8.00004 5.68067 8.06382 5.80867 8.19137C5.93622 8.31937 6 8.47782 6 8.66671C6 8.8556 5.93622 9.01382 5.80867 9.14137C5.68067 9.26937 5.52222 9.33337 5.33333 9.33337ZM10.6667 9.33337C10.4778 9.33337 10.3196 9.26937 10.192 9.14137C10.064 9.01382 10 8.8556 10 8.66671C10 8.47782 10.064 8.31937 10.192 8.19137C10.3196 8.06382 10.4778 8.00004 10.6667 8.00004C10.8556 8.00004 11.0138 8.06382 11.1413 8.19137C11.2693 8.31937 11.3333 8.47782 11.3333 8.66671C11.3333 8.8556 11.2693 9.01382 11.1413 9.14137C11.0138 9.26937 10.8556 9.33337 10.6667 9.33337ZM8 12C7.81111 12 7.65289 11.936 7.52533 11.808C7.39733 11.6805 7.33333 11.5223 7.33333 11.3334C7.33333 11.1445 7.39733 10.9863 7.52533 10.8587C7.65289 10.7307 7.81111 10.6667 8 10.6667C8.18889 10.6667 8.34733 10.7307 8.47533 10.8587C8.60289 10.9863 8.66667 11.1445 8.66667 11.3334C8.66667 11.5223 8.60289 11.6805 8.47533 11.808C8.34733 11.936 8.18889 12 8 12ZM5.33333 12C5.14444 12 4.986 11.936 4.858 11.808C4.73044 11.6805 4.66667 11.5223 4.66667 11.3334C4.66667 11.1445 4.73044 10.9863 4.858 10.8587C4.986 10.7307 5.14444 10.6667 5.33333 10.6667C5.52222 10.6667 5.68067 10.7307 5.80867 10.8587C5.93622 10.9863 6 11.1445 6 11.3334C6 11.5223 5.93622 11.6805 5.80867 11.808C5.68067 11.936 5.52222 12 5.33333 12ZM10.6667 12C10.4778 12 10.3196 11.936 10.192 11.808C10.064 11.6805 10 11.5223 10 11.3334C10 11.1445 10.064 10.9863 10.192 10.8587C10.3196 10.7307 10.4778 10.6667 10.6667 10.6667C10.8556 10.6667 11.0138 10.7307 11.1413 10.8587C11.2693 10.9863 11.3333 11.1445 11.3333 11.3334C11.3333 11.5223 11.2693 11.6805 11.1413 11.808C11.0138 11.936 10.8556 12 10.6667 12ZM3.33333 14.6667C2.96667 14.6667 2.65267 14.5363 2.39133 14.2754C2.13044 14.014 2 13.7 2 13.3334V4.00004C2 3.63337 2.13044 3.3196 2.39133 3.05871C2.65267 2.79737 2.96667 2.66671 3.33333 2.66671H4V2.00004C4 1.81115 4.06378 1.65271 4.19133 1.52471C4.31933 1.39715 4.47778 1.33337 4.66667 1.33337C4.85556 1.33337 5.014 1.39715 5.142 1.52471C5.26956 1.65271 5.33333 1.81115 5.33333 2.00004V2.66671H10.6667V2.00004C10.6667 1.81115 10.7307 1.65271 10.8587 1.52471C10.9862 1.39715 11.1444 1.33337 11.3333 1.33337C11.5222 1.33337 11.6804 1.39715 11.808 1.52471C11.936 1.65271 12 1.81115 12 2.00004V2.66671H12.6667C13.0333 2.66671 13.3473 2.79737 13.6087 3.05871C13.8696 3.3196 14 3.63337 14 4.00004V13.3334C14 13.7 13.8696 14.014 13.6087 14.2754C13.3473 14.5363 13.0333 14.6667 12.6667 14.6667H3.33333ZM3.33333 13.3334H12.6667V6.66671H3.33333V13.3334ZM3.33333 5.33337H12.6667V4.00004H3.33333V5.33337Z" fill = "currentColor"></path>
						</svg>';
				break;

			case 'email-header-two':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
						<path d = "M33 9C33 7.35 31.65 6 30 6H6C4.35 6 3 7.35 3 9V27C3 28.65 4.35 30 6 30H30C31.65 30 33 28.65 33 27V9ZM30 9L18 16.485L6 9H30ZM30 27H6V12L18 19.5L30 12V27Z" fill = "currentColor"></path>
						</svg>';
				break;

			case 'location-header-two':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
						<path d = "M18.2293 18.2866C19.0701 18.2866 19.7901 17.987 20.3893 17.3878C20.9875 16.7896 21.2866 16.0701 21.2866 15.2293C21.2866 14.3885 20.9875 13.6685 20.3893 13.0693C19.7901 12.4711 19.0701 12.172 18.2293 12.172C17.3885 12.172 16.669 12.4711 16.0708 13.0693C15.4716 13.6685 15.172 14.3885 15.172 15.2293C15.172 16.0701 15.4716 16.7896 16.0708 17.3878C16.669 17.987 17.3885 18.2866 18.2293 18.2866ZM18.2293 29.5223C21.3376 26.6688 23.6433 24.0762 25.1465 21.7445C26.6497 19.4138 27.4013 17.3439 27.4013 15.535C27.4013 12.758 26.5157 10.4838 24.7445 8.71261C22.9743 6.94242 20.8025 6.05732 18.2293 6.05732C15.6561 6.05732 13.4838 6.94242 11.7126 8.71261C9.94242 10.4838 9.05732 12.758 9.05732 15.535C9.05732 17.3439 9.80892 19.4138 11.3121 21.7445C12.8153 24.0762 15.121 26.6688 18.2293 29.5223ZM18.2293 33C18.0255 33 17.8217 32.9618 17.6178 32.8853C17.414 32.8089 17.2357 32.707 17.0828 32.5796C13.3631 29.293 10.586 26.2423 8.75159 23.4275C6.9172 20.6117 6 17.9809 6 15.535C6 11.7134 7.22955 8.66879 9.68866 6.40127C12.1468 4.13376 14.9936 3 18.2293 3C21.465 3 24.3118 4.13376 26.7699 6.40127C29.229 8.66879 30.4586 11.7134 30.4586 15.535C30.4586 17.9809 29.5414 20.6117 27.707 23.4275C25.8726 26.2423 23.0955 29.293 19.3758 32.5796C19.2229 32.707 19.0446 32.8089 18.8408 32.8853C18.6369 32.9618 18.4331 33 18.2293 33Z" fill = "currentColor"></path>
						</svg>';
				break;

			case 'timing-header-two':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
						<path d = "M18 30C24.6 30 30 24.6 30 18C30 11.4 24.6 6 18 6C11.4 6 6 11.4 6 18C6 24.6 11.4 30 18 30ZM18 3C26.25 3 33 9.75 33 18C33 26.25 26.25 33 18 33C9.75 33 3 26.25 3 18C3 9.75 9.75 3 18 3ZM25.5 20.85L24.45 22.8L16.5 18.45V10.5H18.75V17.1L25.5 20.85Z" fill = "currentColor"></path>
						</svg>';
				break;

			case 'topbar-location-headertwo':
				return '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<g    id = "location">
						<path id = "Vector" d = "M10.1273 10.1592C10.5944 10.1592 10.9944 9.99278 11.3273 9.65987C11.6596 9.32753 11.8258 8.92781 11.8258 8.46072C11.8258 7.99363 11.6596 7.59363 11.3273 7.26072C10.9944 6.92838 10.5944 6.76221 10.1273 6.76221C9.66022 6.76221 9.2605 6.92838 8.92816 7.26072C8.59525 7.59363 8.42879 7.99363 8.42879 8.46072C8.42879 8.92781 8.59525 9.32753 8.92816 9.65987C9.2605 9.99278 9.66022 10.1592 10.1273 10.1592ZM10.1273 16.4013C11.8541 14.816 13.1351 13.3757 13.9702 12.0803C14.8053 10.7854 15.2228 9.63553 15.2228 8.63057C15.2228 7.08776 14.7308 5.82435 13.7468 4.84034C12.7634 3.8569 11.5569 3.36518 10.1273 3.36518C8.69772 3.36518 7.49093 3.8569 6.50693 4.84034C5.52349 5.82435 5.03177 7.08776 5.03177 8.63057C5.03177 9.63553 5.44932 10.7854 6.28442 12.0803C7.11952 13.3757 8.40049 14.816 10.1273 16.4013ZM10.1273 18.3333C10.0141 18.3333 9.90084 18.3121 9.7876 18.2696C9.67437 18.2272 9.57529 18.1706 9.49036 18.0998C7.42384 16.2739 5.88102 14.5791 4.86191 13.0153C3.84281 11.451 3.33325 9.98939 3.33325 8.63057C3.33325 6.50743 4.01634 4.81599 5.38251 3.55626C6.74811 2.29653 8.32971 1.66667 10.1273 1.66667C11.9249 1.66667 13.5065 2.29653 14.8721 3.55626C16.2383 4.81599 16.9214 6.50743 16.9214 8.63057C16.9214 9.98939 16.4118 11.451 15.3927 13.0153C14.3736 14.5791 12.8308 16.2739 10.7643 18.0998C10.6793 18.1706 10.5802 18.2272 10.467 18.2696C10.3538 18.3121 10.2405 18.3333 10.1273 18.3333Z" fill = "currentColor"></path>
						</g>
						</svg>';
				break;

			case 'topbar-location-dropdown':
				return '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<g    id = "chevron">
						<path id = "Vector" d = "M12.1197 6.6972L8.54418 10.4427C8.46645 10.5242 8.38224 10.5817 8.29156 10.6154C8.20088 10.6496 8.10372 10.6667 8.00008 10.6667C7.89644 10.6667 7.79928 10.6496 7.7086 10.6154C7.61792 10.5817 7.53371 10.5242 7.45599 10.4427L3.8805 6.6972C3.738 6.54792 3.66675 6.35793 3.66675 6.12722C3.66675 5.89652 3.738 5.70653 3.8805 5.55725C4.023 5.40797 4.20437 5.33333 4.4246 5.33333C4.64482 5.33333 4.82619 5.40797 4.96869 5.55725L8.00008 8.73282L11.0315 5.55725C11.174 5.40797 11.3553 5.33333 11.5756 5.33333C11.7958 5.33333 11.9772 5.40797 12.1197 5.55725C12.2622 5.70653 12.3334 5.89652 12.3334 6.12722C12.3334 6.35793 12.2622 6.54792 12.1197 6.6972Z" fill = "currentColor"></path>
						</g>
						</svg>';
				break;

			case 'topbar-headerthree':
				return '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d = "M10.0003 16.6666C13.667 16.6666 16.667 13.6666 16.667 9.99996C16.667 6.33329 13.667 3.33329 10.0003 3.33329C6.33366 3.33329 3.33366 6.33329 3.33366 9.99996C3.33366 13.6666 6.33366 16.6666 10.0003 16.6666ZM10.0003 1.66663C14.5837 1.66663 18.3337 5.41663 18.3337 9.99996C18.3337 14.5833 14.5837 18.3333 10.0003 18.3333C5.41699 18.3333 1.66699 14.5833 1.66699 9.99996C1.66699 5.41663 5.41699 1.66663 10.0003 1.66663ZM14.167 11.5833L13.5837 12.6666L9.16699 10.25V5.83329H10.417V9.49996L14.167 11.5833Z" fill = "currentColor"/>
						</svg>';
				break;

			case 'header-search-icon':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M8.67635 0.666664C13.0929 0.666664 16.6854 4.17989 16.6854 8.49903C16.6854 10.5368 15.8857 12.3953 14.5771 13.7902L17.152 16.303C17.393 16.5387 17.3938 16.9199 17.1528 17.1556C17.0328 17.2746 16.874 17.3333 16.7161 17.3333C16.559 17.3333 16.4011 17.2746 16.2802 17.1572L13.6743 14.6158C12.3034 15.6894 10.5652 16.3322 8.67635 16.3322C4.25979 16.3322 0.666504 12.8182 0.666504 8.49903C0.666504 4.17989 4.25979 0.666664 8.67635 0.666664ZM8.67635 1.87313C4.93996 1.87313 1.90018 4.84505 1.90018 8.49903C1.90018 12.153 4.93996 15.1257 8.67635 15.1257C12.4119 15.1257 15.4517 12.153 15.4517 8.49903C15.4517 4.84505 12.4119 1.87313 8.67635 1.87313Z" fill="#686868"/>
						</svg>';
				break;

			case 'notification-icon':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="24" viewBox="0 0 12 24" fill="none">
									<path d="M9.76517 8.01517C9.63203 8.1483 9.4237 8.1604 9.27689 8.05147L9.23483 8.01517L6 4.7805L2.76516 8.01517C2.63203 8.1483 2.4237 8.1604 2.27689 8.05147L2.23484 8.01517C2.1017 7.88203 2.0896 7.6737 2.19853 7.52689L2.23484 7.48483L5.73484 3.98484C5.86797 3.8517 6.0763 3.8396 6.22311 3.94853L6.26517 3.98484L9.76517 7.48483C9.91161 7.63128 9.91161 7.86872 9.76517 8.01517Z" fill="white" stroke="white" stroke-width="0.4"/>
									<path d="M2.23483 15.9848C2.36797 15.8517 2.5763 15.8396 2.72311 15.9485L2.76517 15.9848L6 19.2195L9.23484 15.9848C9.36797 15.8517 9.5763 15.8396 9.72311 15.9485L9.76516 15.9848C9.8983 16.118 9.9104 16.3263 9.80147 16.4731L9.76516 16.5152L6.26516 20.0152C6.13203 20.1483 5.9237 20.1604 5.77689 20.0515L5.73483 20.0152L2.23483 16.5152C2.08839 16.3687 2.08839 16.1313 2.23483 15.9848Z" fill="white" stroke="white" stroke-width="0.4"/>
						</svg>';
				break;

			case 'header-search-icon-close':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path d="M19.125 4.91771C15.225 1.02743 8.825 1.02743 4.925 4.91771C1.025 8.80798 1.025 15.192 4.925 19.0823C8.825 22.9726 15.125 22.9726 19.025 19.0823C22.925 15.192 23.025 8.80798 19.125 4.91771ZM14.825 16.1895L12.025 13.3965L9.225 16.1895L7.825 14.793L10.625 12L7.825 9.20698L9.225 7.81047L12.025 10.6035L14.825 7.81047L16.225 9.20698L13.425 12L16.225 14.793L14.825 16.1895Z" fill="#141414"/>
						</svg>';
				break;

			case 'bannertwo-ph':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
						<path fill-rule = "evenodd" clip-rule = "evenodd" d = "M20 40C31.0457 40 40 31.0457 40 20C40 8.9543 31.0457 0 20 0C8.9543 0 0 8.9543 0 20C0 31.0457 8.9543 40 20 40ZM12.435 27.5652C12.6089 27.7391 12.8263 27.8261 13.0872 27.8261C14.9567 27.8261 16.7793 27.4092 18.555 26.5756C20.3301 25.7426 21.9022 24.6411 23.2715 23.2713C24.6414 21.902 25.7428 20.3295 26.5759 18.5539C27.4095 16.7788 27.8263 14.9565 27.8263 13.0869C27.8263 12.8261 27.7393 12.6087 27.5654 12.4348C27.3915 12.2608 27.1741 12.1739 26.9133 12.1739H23.3915C23.1886 12.1739 23.0075 12.2391 22.848 12.3695C22.6886 12.5 22.5944 12.6666 22.5654 12.8695L22.0002 15.913C21.9712 16.1159 21.9747 16.3005 22.0106 16.4669C22.0472 16.6339 22.1306 16.7826 22.2611 16.913L24.348 19.0434C23.7393 20.0869 22.9785 21.0652 22.0654 21.9782C21.1524 22.8913 20.1451 23.6811 19.0437 24.3478L17.0002 22.3043C16.8698 22.1739 16.6996 22.0759 16.4898 22.0104C16.2793 21.9455 16.0727 21.9275 15.8698 21.9565L12.8698 22.5652C12.6669 22.6087 12.5002 22.7063 12.3698 22.8582C12.2393 23.0107 12.1741 23.1884 12.1741 23.3913V26.913C12.1741 27.1739 12.2611 27.3913 12.435 27.5652Z" fill = "currentColor"/>
					</svg>';
				break;

			case 'bannertwo-video-icon':
				return '<svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
						<circle cx = "20" cy                                                                                                                                                                                                                                                                                                                                                                                                                                                                               = "21" r      = "16" fill     = "white"/>
						<circle cx = "20" cy                                                                                                                                                                                                                                                                                                                                                                                                                                                                               = "20.9465" r = "19.5" stroke = "white"/>
						<path   d  = "M24.4609 19.9491C24.7961 20.1516 25 20.5084 25 20.8928C25 21.2773 24.7961 21.6341 24.4609 21.8159L17.7116 25.8672C17.3643 26.0951 16.9295 26.1043 16.5747 25.9087C16.4003 25.8126 16.2551 25.6725 16.1541 25.503C16.0531 25.3335 15.9999 25.1406 16 24.9442V16.8415C16 16.6452 16.0533 16.4525 16.1543 16.2831C16.2553 16.1137 16.4004 15.9738 16.5747 15.8777C16.749 15.7817 16.9462 15.7331 17.1461 15.7368C17.3459 15.7404 17.5411 15.7963 17.7116 15.8986L24.4609 19.9491Z" fill = "currentColor"/>
						</svg>';
				break;

			case 'comment':
				return '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<mask id="path-1-inside-1_2572_8281" fill="white">
						<path d="M7.99991 1.3335C7.12443 1.3335 6.25752 1.50593 5.44869 1.84097C4.63985 2.176 3.90492 2.66706 3.28587 3.28612C2.03562 4.53636 1.33324 6.23205 1.33324 8.00016C1.32742 9.53959 1.86044 11.0325 2.83991 12.2202L1.50658 13.5535C1.41407 13.6472 1.35141 13.7663 1.32649 13.8956C1.30158 14.0249 1.31552 14.1588 1.36658 14.2802C1.42195 14.4001 1.51171 14.5009 1.62448 14.5698C1.73724 14.6386 1.86791 14.6724 1.99991 14.6668H7.99991C9.76802 14.6668 11.4637 13.9645 12.714 12.7142C13.9642 11.464 14.6666 9.76827 14.6666 8.00016C14.6666 6.23205 13.9642 4.53636 12.714 3.28612C11.4637 2.03588 9.76802 1.3335 7.99991 1.3335ZM7.99991 13.3335H3.60658L4.22658 12.7135C4.35074 12.5886 4.42044 12.4196 4.42044 12.2435C4.42044 12.0674 4.35074 11.8984 4.22658 11.7735C3.35363 10.9015 2.81003 9.75386 2.68837 8.52603C2.56672 7.2982 2.87454 6.06617 3.5594 5.03984C4.24425 4.01352 5.26377 3.2564 6.44425 2.89748C7.62474 2.53855 8.89315 2.60003 10.0334 3.07144C11.1736 3.54284 12.1151 4.39501 12.6975 5.48276C13.2799 6.5705 13.4672 7.82653 13.2273 9.03683C12.9875 10.2471 12.3354 11.3369 11.3823 12.1203C10.4291 12.9038 9.23375 13.3325 7.99991 13.3335Z"/>
						</mask>
						<path d="M7.99991 1.3335C7.12443 1.3335 6.25752 1.50593 5.44869 1.84097C4.63985 2.176 3.90492 2.66706 3.28587 3.28612C2.03562 4.53636 1.33324 6.23205 1.33324 8.00016C1.32742 9.53959 1.86044 11.0325 2.83991 12.2202L1.50658 13.5535C1.41407 13.6472 1.35141 13.7663 1.32649 13.8956C1.30158 14.0249 1.31552 14.1588 1.36658 14.2802C1.42195 14.4001 1.51171 14.5009 1.62448 14.5698C1.73724 14.6386 1.86791 14.6724 1.99991 14.6668H7.99991C9.76802 14.6668 11.4637 13.9645 12.714 12.7142C13.9642 11.464 14.6666 9.76827 14.6666 8.00016C14.6666 6.23205 13.9642 4.53636 12.714 3.28612C11.4637 2.03588 9.76802 1.3335 7.99991 1.3335ZM7.99991 13.3335H3.60658L4.22658 12.7135C4.35074 12.5886 4.42044 12.4196 4.42044 12.2435C4.42044 12.0674 4.35074 11.8984 4.22658 11.7735C3.35363 10.9015 2.81003 9.75386 2.68837 8.52603C2.56672 7.2982 2.87454 6.06617 3.5594 5.03984C4.24425 4.01352 5.26377 3.2564 6.44425 2.89748C7.62474 2.53855 8.89315 2.60003 10.0334 3.07144C11.1736 3.54284 12.1151 4.39501 12.6975 5.48276C13.2799 6.5705 13.4672 7.82653 13.2273 9.03683C12.9875 10.2471 12.3354 11.3369 11.3823 12.1203C10.4291 12.9038 9.23375 13.3325 7.99991 13.3335Z" fill="currentColor"/>
						<path d="M7.99991 1.3335V2.8335V1.3335ZM1.33324 8.00016L2.83324 8.00584V8.00016H1.33324ZM2.83991 12.2202L3.90057 13.2808L4.86423 12.3172L3.99713 11.2658L2.83991 12.2202ZM1.50658 13.5535L0.445894 12.4928L0.438856 12.4999L1.50658 13.5535ZM1.36658 14.2802L-0.0161439 14.8616L-0.00613952 14.8854L0.00467741 14.9088L1.36658 14.2802ZM1.99991 14.6668V13.1668H1.96835L1.93681 13.1682L1.99991 14.6668ZM7.99991 13.3335V14.8335L8.00109 14.8335L7.99991 13.3335ZM3.60658 13.3335L2.54592 12.2728L-0.014743 14.8335H3.60658V13.3335ZM4.22658 12.7135L5.28724 13.7742L5.29039 13.771L4.22658 12.7135ZM4.42044 12.2435H5.92044H4.42044ZM4.22658 11.7735L5.29039 10.716L5.28665 10.7122L4.22658 11.7735ZM7.99991 -0.166504C6.92745 -0.166504 5.86549 0.0447332 4.87466 0.455147L6.02271 3.22679C6.64956 2.96714 7.32141 2.8335 7.99991 2.8335V-0.166504ZM4.87466 0.455147C3.88384 0.86556 2.98355 1.46711 2.22521 2.22546L4.34653 4.34678C4.82629 3.86701 5.39586 3.48643 6.02271 3.22679L4.87466 0.455147ZM2.22521 2.22546C0.693658 3.757 -0.166756 5.83423 -0.166756 8.00016H2.83324C2.83324 6.62988 3.37759 5.31572 4.34653 4.34678L2.22521 2.22546ZM-0.166745 7.99448C-0.173899 9.88413 0.480388 11.7167 1.68269 13.1745L3.99713 11.2658C3.24049 10.3483 2.82873 9.19504 2.83323 8.00584L-0.166745 7.99448ZM1.77925 11.1595L0.445917 12.4928L2.56724 14.6142L3.90057 13.2808L1.77925 11.1595ZM0.438856 12.4999C0.138216 12.8046 -0.0654435 13.1915 -0.146421 13.6118L2.79941 14.1794C2.76826 14.3411 2.68993 14.4899 2.5743 14.607L0.438856 12.4999ZM-0.146421 13.6118C-0.227398 14.0322 -0.182066 14.467 -0.0161439 14.8616L2.7493 13.6987C2.81312 13.8505 2.83055 14.0177 2.79941 14.1794L-0.146421 13.6118ZM0.00467741 14.9088C0.184636 15.2987 0.47637 15.6263 0.842845 15.85L2.40611 13.2895C2.54706 13.3756 2.65926 13.5015 2.72848 13.6515L0.00467741 14.9088ZM0.842845 15.85C1.20932 16.0738 1.63401 16.1836 2.06301 16.1655L1.93681 13.1682C2.10181 13.1612 2.26515 13.2034 2.40611 13.2895L0.842845 15.85ZM1.99991 16.1668H7.99991V13.1668H1.99991V16.1668ZM7.99991 16.1668C10.1658 16.1668 12.2431 15.3064 13.7746 13.7749L11.6533 11.6535C10.6844 12.6225 9.3702 13.1668 7.99991 13.1668V16.1668ZM13.7746 13.7749C15.3062 12.2433 16.1666 10.1661 16.1666 8.00016H13.1666C13.1666 9.37045 12.6222 10.6846 11.6533 11.6535L13.7746 13.7749ZM16.1666 8.00016C16.1666 5.83423 15.3062 3.757 13.7746 2.22546L11.6533 4.34678C12.6222 5.31572 13.1666 6.62988 13.1666 8.00016H16.1666ZM13.7746 2.22546C12.2431 0.69391 10.1658 -0.166504 7.99991 -0.166504V2.8335C9.3702 2.8335 10.6844 3.37784 11.6533 4.34678L13.7746 2.22546ZM7.99991 11.8335H3.60658V14.8335H7.99991V11.8335ZM4.66724 14.3942L5.28724 13.7742L3.16592 11.6528L2.54592 12.2728L4.66724 14.3942ZM5.29039 13.771C5.69393 13.365 5.92044 12.8159 5.92044 12.2435H2.92044C2.92044 12.0233 3.00756 11.8121 3.16277 11.656L5.29039 13.771ZM5.92044 12.2435C5.92044 11.6711 5.69393 11.1219 5.29039 10.716L3.16277 12.831C3.00756 12.6749 2.92044 12.4636 2.92044 12.2435H5.92044ZM5.28665 10.7122C4.65922 10.0855 4.2685 9.26063 4.18106 8.37813L1.19568 8.67392C1.35155 10.2471 2.04805 11.7175 3.16651 12.8347L5.28665 10.7122ZM4.18106 8.37813C4.09362 7.49562 4.31487 6.6101 4.80711 5.87243L2.31168 4.20725C1.43421 5.52223 1.03981 7.10077 1.19568 8.67392L4.18106 8.37813ZM4.80711 5.87243C5.29935 5.13476 6.03213 4.59058 6.8806 4.33261L6.00791 1.46235C4.49541 1.92222 3.18915 2.89228 2.31168 4.20725L4.80711 5.87243ZM6.8806 4.33261C7.72907 4.07463 8.64075 4.11882 9.46029 4.45764L10.6065 1.68523C9.14555 1.08125 7.5204 1.00248 6.00791 1.46235L6.8806 4.33261ZM9.46029 4.45764C10.2798 4.79647 10.9566 5.40896 11.3751 6.19078L14.0199 4.77474C13.2737 3.38106 12.0674 2.28922 10.6065 1.68523L9.46029 4.45764ZM11.3751 6.19078C11.7937 6.97259 11.9283 7.87536 11.7559 8.74527L14.6987 9.3284C15.006 7.77769 14.7661 6.16841 14.0199 4.77474L11.3751 6.19078ZM11.7559 8.74527C11.5836 9.61518 11.1149 10.3984 10.4298 10.9615L12.3347 13.2791C13.556 12.2753 14.3914 10.8791 14.6987 9.3284L11.7559 8.74527ZM10.4298 10.9615C9.7447 11.5246 8.88555 11.8328 7.99873 11.8335L8.00109 14.8335C9.58195 14.8323 11.1135 14.2829 12.3347 13.2791L10.4298 10.9615Z" fill="currentColor" mask="url(#path-1-inside-1_2572_8281)"/>
						</svg>';
				break;

			default:
				// code...
				break;
		}
	}
endif;

if ( ! function_exists( 'constructionn_get_svg_icons' ) ) :
	/**
	 * Fuction to list SVG Icons
	 */
	function constructionn_get_svg_icons() {
		$social_media = array( 'facebook', 'twitter', 'digg', 'instagram', 'pinterest', 'telegram', 'getpocket', 'dribbble', 'behance', 'unsplash', 'five-hundred-px', 'linkedin', 'WordPress', 'parler', 'mastodon', 'medium', 'slack', 'codepen', 'reddit', 'twitch', 'tiktok', 'snapchat', 'spotify', 'soundcloud', 'apple_podcast', 'patreon', 'alignable', 'skype', 'github', 'gitlab', 'youtube', 'vimeo', 'dtube', 'vk', 'ok', 'rss', 'facebook_group', 'discord', 'tripadvisor', 'foursquare', 'yelp', 'hacker_news', 'xing', 'flipboard', 'weibo', 'tumblr', 'qq', 'strava', 'flickr' );
		// Initate an empty array
		$svg_options     = array();
		$svg_options[''] = __( '-- Choose --', 'constructionn' );
		foreach ( $social_media as $svg ) {
			$svg_options[ $svg ] = esc_html( $svg );
		}
		return $svg_options;
	}
endif;

if ( ! function_exists( 'constructionn_tags' ) ) {
	/**
	 * Prints tags
	 */
	function constructionn_tags() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() && has_tag() ) {
			?>
			<ul class="wp-block-tags-list wp-block-tags" itemprop="about">
				<?php
					$tags_list = get_the_tag_list( '', ' ' );
				if ( $tags_list ) {
					echo '<li>' . wp_kses_post( $tags_list ) . '</li>';
				}
				?>
			</ul>
			<?php
		}
	}
}

if ( ! function_exists( 'constructionn_author_social' ) ) :
	/**
	 * Author Social Links
	 */
	function constructionn_author_social() {
		$id      = get_the_author_meta( 'ID' );
		$socials = get_user_meta( $id, '_constructionn_user_social_icons', true );

		if ( $socials ) {
			?>
			<div class="social">
				<ul class="social-networks has-fills">
					<?php
					foreach ( $socials as $key => $link ) {
						if ( $link ) {
							?>
							<li>
								<a href="<?php echo esc_url( $link ); ?>" target="_blank" rel="nofollow noopener">
									<span class="<?php echo esc_attr( $key ); ?>">
										<?php echo wp_kses( constructionn_handle_all_svgs( $key ), constructionn_get_kses_extended_ruleset() ); ?>
									</span>
								</a>
							</li>
							<?php
						}
					}
					?>
				</ul>
			</div>
			<?php
		}
	}
endif;

if ( ! function_exists( 'constructionn_social_media_repeater' ) ) :
	/**
	 * Social Media Links

	 * Function for the loop of Frontpage Social Media Section
	 *
	 * @param [type] $postid
	 * @return void
	 */
	function constructionn_social_media_repeater( $socialmedia, $sec_name = '' ) {
		$socialmedia_toggle    = get_theme_mod( 'socialmedia_toggle', true );
		$social_media_heading  = get_theme_mod( 'socialmedia_heading', __( 'Follow Us On:', 'constructionn' ) );
		$social_media_repeater = get_theme_mod(
			$socialmedia,
			array(
				array(
					'md_pro_icon'     => 'facebook',
					'md_pro_link'     => 'https://www.facebook.com/',
					'md_pro_checkbox' => '1',
				),
				array(
					'md_pro_icon'     => 'linkedin',
					'md_pro_link'     => 'https://linkedin.com/',
					'md_pro_checkbox' => '1',
				),
				array(
					'md_pro_icon'     => 'instagram',
					'md_pro_link'     => 'https://www.instagram.com/',
					'md_pro_checkbox' => '1',
				),
				array(
					'md_pro_icon'     => 'pinterest',
					'md_pro_link'     => 'https://www.pinterest.com/',
					'md_pro_checkbox' => '1',
				),
			)
		);
		if ( $socialmedia_toggle && $social_media_repeater ) {
			?>
			<div class="social-wrap <?php echo esc_attr( $sec_name ); ?>">
				<?php if ( $social_media_heading && ! ( $sec_name === 'footer-section' ) ) { ?>
					<span class="label"><?php echo esc_html( $social_media_heading ); ?></span>
					<?php
				}
				?>
				<ul class="social-networks is-circled has-fills">
					<?php
					foreach ( $social_media_repeater as $socialrepeater ) {
						$md_pro_icon     = ( ! empty( $socialrepeater['md_pro_icon'] ) && isset( $socialrepeater['md_pro_icon'] ) ) ? $socialrepeater['md_pro_icon'] : '';
						$md_pro_link     = ( ! empty( $socialrepeater['md_pro_link'] ) && isset( $socialrepeater['md_pro_link'] ) ) ? $socialrepeater['md_pro_link'] : '';
						$md_pro_checkbox = ( ! empty( $socialrepeater['md_pro_checkbox'] ) && isset( $socialrepeater['md_pro_checkbox'] ) ) ? '_blank' : '_self';

						if ( $md_pro_icon && $md_pro_link ) {
							?>
					<li>
						<a href="<?php echo esc_url( $md_pro_link ); ?>" target="<?php echo esc_attr( $md_pro_checkbox ); ?>" rel="nofollow noopener">
							<?php echo wp_kses( constructionn_handle_all_svgs( $md_pro_icon ), constructionn_get_kses_extended_ruleset() ); ?>
						</a>
					</li>
							<?php
						}
					}
					?>
				</ul>
			</div>
			<?php
		}
	}
endif;

if ( ! function_exists( 'constructionn_get_team' ) ) :
	/**
	 * Show the team list
	 *
	 * @return void
	 */
	function constructionn_get_team( $post_id = '' ) {
		$args = array(
			'post_type'   => 'team',
			'post_status' => 'publish',
		);
		if ( $post_id ) {
			$args['p'] = $post_id;
		} else {
			$args['post_per_pages'] = -1;
		}

		$team = new WP_Query( $args );
		if ( $team->have_posts() ) {
			while ( $team->have_posts() ) {
				$team->the_post();
				$designation = get_post_meta( get_the_ID(), '_constructionn_designation', true );
				$social_link = get_post_meta( get_the_ID(), '_team_social_icons', true );
				?>
				<div class="swiper-slide">
					<div class="team-card">
						<div class="team-image">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'team_custom_img' );
							} else {
								constructionn_get_fallback_svg( 'team_custom_img' );
							}
							?>
							<div class="social-wrap team-social-links">
								<button class="social-links-opener" id="team-social-btn"><?php esc_html_e( '+', 'constructionn' ); ?></button>
								<?php constructionn_team_social_media_icon( $social_link ); ?>
							</div>
						</div>
						<div class="team-content">
							<h5 class="name">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h5>
							<?php if ( $designation ) { ?>
								<span class="title"><?php echo esc_html( $designation ); ?></span>
								<?php
							}
							?>
						</div>
					</div>
				</div>	
				<?php
			}
		}
	}
endif;

if ( ! function_exists( 'constructionn_footer_copyright' ) ) {
	/**
	 * Footer Copyright Section
	 *
	 * @return void
	 */
	function constructionn_footer_copyright() {
		$footer_copyright_setting = get_theme_mod( 'footer_copyright_setting' );
		?>
		<div class="site-info footer">
				<!-- <div class="site-info">
					<span class="copyright">© Copyright 2023 GL- Konstructio   Powered by WordPress</span>
				</div> -->
			<?php
			if ( $footer_copyright_setting ) {
				echo wp_kses_post( constructionn_apply_theme_shortcode( $footer_copyright_setting ) );
			} else {
				echo '<span class="copyright">';
					esc_html_e( '&copy; Copyright ', 'constructionn' );
					echo date_i18n( esc_html__( 'Y ', 'constructionn' ) );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
					constructionn_toggle_wp_link();
				echo '</span>';
			}
			?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'constructionn_toggle_wp_link' ) ) :
	/**
	 * Show/Hide WordPress link in footer
	 */
	function constructionn_toggle_wp_link() {
		$toggle_wp_link = get_theme_mod( 'toggle_wp_link', true );

		if ( $toggle_wp_link ) {
			printf( esc_html__( ' ⚪&nbsp; %1$sPowered by %2$s%3$s', 'constructionn' ), '<span class="wp-link">', '<a href="' . esc_url( __( 'https://wordpress.org/', 'constructionn' ) ) . '" target="_blank">WordPress</a>', '</span>' );
		}
	}
endif;

if ( ! function_exists( 'constructionn_string_to_array' ) ) {
	/**
	 * Function to convert the sortable string list into array
	 *
	 * @return array
	 */
	function constructionn_string_to_array( $string_list ) {
		if ( strpos( $string_list, ',' ) !== false ) {
			$string_list = explode( ',', $string_list );
		}
		if ( ! is_array( $string_list ) ) {
			$string_list = array( $string_list );
		}
		return $string_list;
	}
}

if ( ! function_exists( 'constructionn_get_kses_extended_ruleset' ) ) :
	/**
	 * Passes wpkses for svgs
	 *
	 * @return void
	 */
	function constructionn_get_kses_extended_ruleset() {
		$kses_defaults = wp_kses_allowed_html( 'post' );

		$svg_args = array(
			'svg'    => array(
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true, // <= Must be lower case!
			),
			'g'      => array( 'fill' => true ),
			'title'  => array( 'title' => true ),
			'path'   => array(
				'd'    => true,
				'fill' => true,
			),
			'circle' => array(
				'cx'           => true,
				'cy'           => true,
				'r'            => true,
				'fill'         => true,
				'stroke'       => true,
				'stroke-width' => true,
			),
		);
		return array_merge( $kses_defaults, $svg_args );
	}
endif;

/**
 * Checks if elementor is active or not
 */
function is_elementor_activated() {
	return class_exists( 'Elementor\\Plugin' ) ? true : false;
}

/**
 * Checks if elementor has override that particular page/post or not
 */
function is_elementor_activated_post() {
	if ( is_elementor_activated() ) {
		global $post;
		$post_id = $post->ID;
		return \Elementor\Plugin::$instance->db->is_built_with_elementor( $post_id ) ? true : false;
	} else {
		return false;
	}
}

function constructionn_woo_boolean() {
	return class_exists( 'woocommerce' ) ? true : false;
}

if ( ! function_exists( 'constructionn_comment_list' ) ) :
	function constructionn_comment_list( $comment, $args, $depth ) {
		if ( 'div' == $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo esc_html( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">
		
		<?php if ( 'div' != $args['style'] ) : ?>
			<div id="div-comment-<?php comment_ID(); ?>" class="comment-body" itemscope itemtype="http://schema.org/UserComments">
		<?php endif; ?>
		<article class="comment-body">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 42 ); ?>
			</div>
			<div class="comment-body_wrap">
				<footer class="comment-meta">
					<div class="comment-metadata">
						<b class="fn">
							<a href="<?php echo esc_url( get_comment_author_url() ); ?>" class="url" rel="ugc"><?php comment_author(); ?></a>
						</b>
						<span class="says"><?php _e( 'says:', 'constructionn' ); ?></span>
						<a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>">
							<time itemprop="commentTime" datetime="<?php echo esc_attr( get_comment_time( 'c' ) ); ?>">
								<?php echo esc_html( get_comment_date( 'j F Y' ) ); ?>
							</time>
						</a>
						<?php edit_comment_link( __( 'Edit', 'constructionn' ), '<span class="edit-link">', '</span>' ); ?>
					</div>
				</footer>
				<div class="comment-content">
					<?php comment_text(); ?>
				</div>
				<div class="reply">
					<?php
						comment_reply_link(
							array_merge(
								$args,
								array(
									'add_below' => $add_below,
									'depth'     => $depth,
									'max_depth' => $args['max_depth'],
								)
							)
						);
					?>
				</div>
			</div>
		</article>
		<?php if ( 'div' != $args['style'] ) : ?>
		</div><!-- .comment-body -->
			<?php
		endif;
	}
endif;

if ( ! function_exists( 'constructionn_front_features_repeater' ) ) :
	/**
	 * Front Features Repeater
	 *
	 * @return void
	 */
	function constructionn_front_features_repeater( $sec_name, $repeater_key ) {
		if ( $repeater_key ) {
			?>
			<section class="feature-section bg-primary" id="<?php echo esc_attr( $sec_name ); ?>">
				<div class="feature-wrapper">
					<?php
					foreach ( $repeater_key as $repeater ) {
						$heading    = ( ! empty( $repeater['heading'] ) && isset( $repeater['heading'] ) ) ? $repeater['heading'] : '';
						$subheading = ( ! empty( $repeater['subheading'] ) && isset( $repeater['subheading'] ) ) ? $repeater['subheading'] : '';
						$image      = ( ! empty( $repeater['image'] ) && isset( $repeater['image'] ) ) ? $repeater['image'] : '';
						$url        = ( ! empty( $repeater['url'] ) && isset( $repeater['url'] ) ) ? $repeater['url'] : '';

						if ( $heading || $subheading || $image || $url ) {
							?>
							<div class="feature__card text-center">
								<a href="<?php echo esc_url( $url ); ?>">
									<?php if ( $image ) { ?>
										<div class="feature-image">
											<?php echo wp_get_attachment_image( $image, 'thumbnail', true ); ?>
										</div>
										<?php
									}
									?>
									<?php if ( $heading || $subheading ) { ?>
										<h2 class="feature__title"><span class="feature__stitle"><?php echo esc_html( $subheading ); ?></span><br><?php echo esc_html( $heading ); ?></h2>
									<?php } ?>
								</a>
							</div>
							<?php
						}
					}
					?>
				</div>
			</section>
			<?php
		}
	}
endif;

if ( ! function_exists( 'constructionn_team_single_sidebar' ) ) :
	/**
	 * Team Single Sidebar
	 *
	 * @return void
	 */
	function constructionn_team_single_sidebar() {
		global $post;

		if ( ! isset( $post->ID ) ) {
			return;
		}
		$email       = get_post_meta( $post->ID, '_constructionn_team_email', true );
		$contact     = get_post_meta( $post->ID, '_constructionn_team_contact', true );
		$social_link = get_post_meta( $post->ID, '_team_social_icons', true );
		?>
		<aside id="secondary" class="sidebar-main">
			<div class="team-single">
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="team-image">
						<?php the_post_thumbnail( 'medium' ); ?>
					</div>
				<?php } ?>
				<div class="team-content">
					<div class="team__content-header">
						<?php
						$category_list = get_the_term_list( get_the_ID(), 'team_category', '<span class="team__content-stitle">', '', '</span>' );
						if ( isset( $category_list ) && ! empty( $category_list ) ) {
							echo wp_kses_post( $category_list );
						}
						?>
						<?php the_title( '<h5 class="team__content-title">', '</h5>' ); ?>
					</div>
					<?php if ( $email || $contact ) { ?>
						<div class="contact-info">
							<?php if ( $email ) { ?>
								<div class="info">
									<span class="icon-mail icon"></span>
									<a href="<?php echo esc_url( 'mailto:' . sanitize_email( $email ) ); ?>">
										<?php echo esc_html( $email ); ?>
									</a>
								</div>
								<?php
							}
							if ( $contact ) {
								?>
								<div class="info">
									<span class="icon-phone icon"></span>
									<a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^\d+]/', '', $contact ) ); ?>">
										<?php echo esc_html( $contact ); ?>
									</a>
								</div>
							<?php } ?>
						</div>
						<?php
					}
					if ( $social_link ) {
						constructionn_team_social_media_icon( $social_link );
					}
					?>
				</div>
			</div>
		</aside>
		<?php
	}
endif;

if ( ! function_exists( 'constructionn_get_social_icons' ) ) :
	/**
	 * Function to display social icons in the footer area.
	 *
	 * @since 1.0.0
	 */
	function constructionn_get_social_icons() {
		return apply_filters(
			'constructionn_user_social_icons',
			array(
				'facebook'  => '',
				'twitter'   => '',
				'instagram' => '',
				'snapchat'  => '',
				'pinterest' => '',
				'linkedin'  => '',
				'youtube'   => '',
			)
		);
	}
endif;

if ( ! function_exists( 'constructionn_team_social_media_icon' ) ) :
	/**
	 * It will show the social media icons for the team
	 *
	 * @param [type] $social_link
	 * @return void
	 */
	function constructionn_team_social_media_icon( $social_link ) {
		?>
		<div class="<?php echo ( get_post_type() === 'case-study' ) ? 'social-wrap' : 'social'; ?>">
			<ul class="social-networks has-fills <?php echo ( get_post_type() === 'case-study' ) ? 'is-circled' : ''; ?>">
				<?php
				foreach ( $social_link as $key => $link ) {
					if ( $link ) {
						?>
						<li>
							<a href="<?php echo esc_url( $link ); ?>" target="_blank" rel="nofollow noopener">
								<?php echo wp_kses( constructionn_handle_all_svgs( $key ), constructionn_get_kses_extended_ruleset() ); ?>
							</a>
						</li>
						<?php
					}
				}
				?>
			</ul>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'constructionn_get_image_sizes' ) ) :
	/**
	 * Get information about available image sizes
	 */
	function constructionn_get_image_sizes( $size = '' ) {

		global $_wp_additional_image_sizes;

		$sizes                        = array();
		$get_intermediate_image_sizes = get_intermediate_image_sizes();

		// Create the full array with sizes and crop info
		foreach ( $get_intermediate_image_sizes as $_size ) {
			if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large', 'full' ) ) ) {
				$sizes[ $_size ]['width']  = get_option( $_size . '_size_w' );
				$sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
				$sizes[ $_size ]['crop']   = (bool) get_option( $_size . '_crop' );
			} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
				$sizes[ $_size ] = array(
					'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
					'height' => $_wp_additional_image_sizes[ $_size ]['height'],
					'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
				);
			}
		}

		// Get only 1 size if found
		if ( $size ) {
			if ( isset( $sizes[ $size ] ) ) {
				return $sizes[ $size ];
			} else {
				return false;
			}
		}

		return $sizes;
	}
endif;

if ( ! function_exists( 'constructionn_get_fallback_svg' ) ) :
	/**
	 * Get Fallback SVG
	 */
	function constructionn_get_fallback_svg( $post_thumbnail ) {
		if ( ! $post_thumbnail ) {
			return;
		}
		$fallback_svg = get_theme_mod( 'fallback_bg_color', '#0A204E' );
		$image_size   = constructionn_get_image_sizes( $post_thumbnail );

		if ( $image_size ) {
			?>
			<div class="svg-holder">
				<svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $image_size['width'] ); ?> <?php echo esc_attr( $image_size['height'] ); ?>" preserveAspectRatio="none" style="width: 100%;">
					<rect width="<?php echo esc_attr( $image_size['width'] ); ?>" height="<?php echo esc_attr( $image_size['height'] ); ?>" style="fill:<?php echo esc_attr( $fallback_svg ); ?>;"></rect>
				</svg>
			</div>
			<?php
		}
	}
endif;

if ( ! function_exists( 'constructionn_add_dynamic_classes' ) ) :
	/**
	 * Dynamically add class based on conditions
	 *
	 * @return array Updated classes with dynamic classes.
	 */
	function constructionn_add_dynamic_classes( $classes ) {
		if ( is_singular( 'post' ) ) {
			$classes[] .= 'single-post';
		} elseif ( is_page() ) {
			$classes[] .= 'single-page';
		} elseif ( is_404() ) {
			$classes[] .= 'site error404';
		} elseif ( is_author() ) {
			$classes[] .= 'author-page';
		} else {
			$classes[] .= 'page';
		}
		return $classes;
	}
endif;
add_filter( 'constructionn_add_dynamic_class', 'constructionn_add_dynamic_classes' );

if ( ! function_exists( 'constructionn_display_dynamic_class' ) ) :
	/**
	 * Show dynamic classes for the <div> wrapper element after body opens
	 *
	 * @return string
	 */
	function constructionn_display_dynamic_class() {
		$classes = apply_filters( 'constructionn_add_dynamic_class', array() );
		echo esc_attr( implode( ' ', $classes ) );
	}
endif;

if ( ! function_exists( 'constructionn_show_serach_query_post_count' ) ) :
	/**
	 * Show the query post count
	 *
	 * @return string
	 */
	function constructionn_show_serach_query_post_count() {
		global $wp_query;
		$results_count = $wp_query->found_posts;
		if ( $results_count > 0 ) {
			echo '<p class="result-count">' . esc_html( sprintf( _n( '%d result for ', '%d results for ', $results_count, 'constructionn' ), $results_count ) ) . '<span>"' . esc_html( get_search_query() ) . '"</span></p>';
		} else {
			echo '<p class="result-count">' . __( '0 result for ', 'constructionn' ) . '<span>"' . esc_html( get_search_query() ) . '"</span></p>';
		}
	}
endif;

if ( ! function_exists( 'constructionn_get_case_study_post' ) ) :
	/**
	 * Get the case studies function
	 *
	 * @param [int] $case_study_ids
	 * @return void
	 */
	function constructionn_get_case_study_post( $cs_btn_txt, $case_study_ids = '' ) {
		$args = array(
			'post_type'   => 'case-study',
			'post_status' => 'publish',
		);
		// for the selected post
		if ( ! empty( $case_study_ids ) ) {
			$args['post__in'] = $case_study_ids;
			$args['orderby']  = 'post__in';
		} else {
			$args['posts_per_page'] = '-1';
		}
		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			$posts      = $query->posts; // Get all posts at once
			$first_post = $posts[0];
			$two_posts  = array_slice( $posts, 1, 2 );
			$post_list  = array_slice( $posts, 3 );
			?>
			<div class="case_studies-wrapper">
				<?php if ( $first_post ) { ?>
					<div class="case_studies-top">
						<article class="post">
							<div class="blog__card">
								<figure class="blog__img">
									<?php
										$thumbnail_html = get_the_post_thumbnail( $first_post->ID, 'medium' );
									if ( $thumbnail_html ) {
										?>
											<a href="<?php echo esc_url( get_permalink( $first_post->ID ) ); ?>">
												<?php echo wp_kses_post( $thumbnail_html ); ?>
											</a>
										<?php
									} else {
										constructionn_get_fallback_svg( 'blog_card_image' );
									}
									?>
								</figure>
								<div class="blog__info">
									<a href="<?php echo esc_url( get_permalink( $first_post->ID ) ); ?>">
										<?php echo esc_html( get_the_title( $first_post->ID ) ); ?>
									</a>
									<?php
										$has_excerpt = get_the_excerpt( $first_post->ID );
										$content     = get_the_content( $first_post->ID );

									if ( $has_excerpt ) {
										echo wpautop( esc_html( $has_excerpt ) );
									} else {
										echo wpautop( wp_kses_post( wp_trim_words( $content, 15, '...' ) ) );
									}
									if ( $cs_btn_txt ) {
										?>
										<a href="<?php echo esc_url( get_permalink( $first_post->ID ) ); ?>" class="btn btn__text has-icon has-primary-color">
											<?php echo esc_html( $cs_btn_txt ); ?>
										</a>
									<?php } ?>
								</div>
							</div>
						</article>
					</div>
				<?php } if ( $two_posts || $post_list ) { ?>
					<div class="case_studies-bottom">
						<?php if ( $two_posts ) { ?>
							<div class="projects-wrapper">
								<?php foreach ( $two_posts as $case_study ) { ?>
									<article class="post">
										<div class="blog__card">
											<div class="blog__info">
												<a href="<?php echo esc_url( get_permalink( $case_study->ID ) ); ?>">
													<?php echo esc_html( get_the_title( $case_study->ID ) ); ?>
												</a>
												<?php
													$has_excerpt = get_the_excerpt( $case_study->ID );
													$content     = get_the_content( $case_study->ID );

												if ( $has_excerpt ) {
													echo wpautop( esc_html( $has_excerpt ) );
												} else {
													echo wpautop( wp_kses_post( wp_trim_words( $content, 15, '...' ) ) );
												}
												if ( $cs_btn_txt ) {
													?>
													<a href="<?php echo esc_url( get_permalink( $case_study->ID ) ); ?>" class="btn btn__text has-icon has-primary-color">
														<?php echo esc_html( $cs_btn_txt ); ?>
													</a>
												<?php } ?>
											</div>
										</div>
									</article>
								<?php } ?>
							</div>
						<?php } if ( $post_list ) { ?>
							<div class="projects-listing">
								<ul>
									<?php foreach ( $post_list as $case_study ) : ?>
										<li>
											<a href="<?php echo esc_url( get_permalink( $case_study->ID ) ); ?>">
												<?php echo esc_html( get_the_title( $case_study->ID ) ); ?>
											</a>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
			<?php
		}
	}
endif;

if ( ! function_exists( 'constructionn_get_pricing_card' ) ) :
	/**
	 * Get the pricing card
	 *
	 * @param string $heading
	 * @param string $price
	 * @param string $rate
	 * @param array  $repeater
	 * @param string $offer
	 * @return void
	 */
	function constructionn_get_pricing_card( $heading, $price, $rate, $repeater, $button_text, $button_link, $offer = '' ) {
		if ( $heading || $price || $rate || $repeater || ( $button_text && $button_link ) || $offer ) {
			?>
			<div class="pricing__card <?php echo $offer ? esc_attr( 'has-offer' ) : ''; ?>">
				<?php if ( $offer ) { ?>
					<span class="pricing__offer-tag"><?php echo esc_html( $offer ); ?></span>
				<?php } ?>
				<?php if ( $heading || $price || $rate ) { ?>
					<div class="pricing__card-top">
						<?php if ( $heading ) { ?>
							<h4 class="title"><?php echo esc_html( $heading ); ?></h4>
						<?php } if ( $price ) { ?>
							<span class="price">
								<?php echo esc_html( $price ); ?>
							</span>
						<?php } if ( $rate ) { ?>
							<div class="duration">
								<span class="plan"><?php echo esc_html( $rate ); ?></span>
							</div>
						<?php } ?>
					</div>
				<?php } if ( $repeater ) { ?>
					<div class="pricing__card-bottom">
						<ul>
							<?php
							foreach ( $repeater as $item ) {
								$is_exclude = ( isset( $item['is_exclude'] ) && ! empty( $item['is_exclude'] ) ) ? true : false;
								$title      = ( isset( $item['title'] ) && ! empty( $item['title'] ) ) ? $item['title'] : '';

								if ( $title ) {
									?>
									<li<?php echo ! $is_exclude ? ' class="is-included"' : ''; ?>>
										<?php echo esc_html( $title ); ?>
									</li>
									<?php
								}
							}
							?>
						</ul>
						<?php if ( $button_text && $button_link ) { ?>
							<a href="<?php echo esc_url( $button_link ); ?>" class="btn btn__primary has-icon"><?php echo esc_html( $button_text ); ?></a>
							<?php
						}
						?>
					</div>
				<?php } ?>
			</div>
			<?php
		}
	}
endif;

if ( ! function_exists( 'constructionn_team_single_top' ) ) :
	/**
	 * Team Single top
	 *
	 * @return void
	 */
	function constructionn_team_single_top() {
		$designation = get_post_meta( get_the_ID(), '_constructionn_designation', true );
		$description = get_post_meta( get_the_ID(), '_constructionn_team_description', true );
		$social_link = get_post_meta( get_the_ID(), '_team_social_icons', true );

		if ( get_post_type() === 'team' ) {
			?>
			<div class="team-single-top">
				<div class="container">
					<div class="wrapper">
						<div class="team-image">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) );
							} else {
								constructionn_get_fallback_svg( 'blog_card_image' );
							}
							?>
						</div>
						<div class="team-content">
							<div class="section-header">
								<?php
								if ( $designation ) {
									echo '<span class="section-header__info">' . esc_html( $designation ) . '</span>';
								}
								?>
								<h2 class="section-header__title">
									<?php the_title(); ?>
								</h2>
								<?php
								if ( $description ) {
									echo wpautop( esc_html( $description ) );
								}
								?>
								<?php constructionn_team_social_media_icon( $social_link ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}
endif;
add_action( 'constructionn_before_cpt_content', 'constructionn_team_single_top', 20 );

if ( ! function_exists( 'constructionn_project_single_top' ) ) :
	/**
	 * Team Single top
	 *
	 * @return void
	 */
	function constructionn_project_single_top() {
		$project_location = get_post_meta( get_the_ID(), '_constructionn_location', true );
		$project_client   = get_post_meta( get_the_ID(), '_constructionn_client', true );
		$project_date     = get_post_meta( get_the_ID(), '_constructionn_date', true );
		$service_id       = get_post_meta( get_the_ID(), '_constructionn_service_type', true );

		if ( ( get_post_type() === 'project' ) ) {
			?>
			<div class="container">
				<div class="project-single-wrap">
					<div class="project-image">
						<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) );
							$caption = wp_get_attachment_caption( get_post_thumbnail_id() );
							echo '<figcaption>' . esc_html( $caption ) . '</figcaption>';
						} else {
							constructionn_get_fallback_svg( 'blog_card_image' );
						}
						?>
					</div>
					<?php if ( $project_location || $project_client || $project_date || $service_id ) { ?>
						<div class="project-single-info">
							<ul>
								<?php if ( $project_location ) { ?>
									<li>
										<span><?php esc_html_e( 'Location:', 'constructionn' ); ?></span>
										<p><?php echo esc_html( $project_location ); ?></p>
									</li>
								<?php } if ( $project_client ) { ?>
									<li>
										<span><?php esc_html_e( 'Client:', 'constructionn' ); ?></span>
										<p><?php echo esc_html( $project_client ); ?></p>
									</li>
								<?php } if ( $project_date ) { ?>
									<li>
										<span><?php esc_html_e( 'Date:', 'constructionn' ); ?></span>
										<p><?php echo esc_html( date( 'F j, Y', strtotime( $project_date ) ) ); ?></p>
									</li>
								<?php } if ( $service_id ) { ?>
									<li>
										<span><?php esc_html_e( 'Service type:', 'constructionn' ); ?></span>
										<p><?php echo esc_html( get_the_title( $service_id ) ); ?></p>
									</li>
								<?php } ?>
							</ul>
						</div>
					<?php } ?>
				</div>
			</div>
			<?php
		}
	}
endif;
add_action( 'constructionn_before_cpt_content', 'constructionn_project_single_top', 20 );

if ( ! function_exists( 'constructionn_case_study_single_top' ) ) :
	/**
	 * Team Single top
	 *
	 * @return void
	 */
	function constructionn_case_study_single_top() {
		$project_location = get_post_meta( get_the_ID(), '_constructionn_location', true );
		$project_client   = get_post_meta( get_the_ID(), '_constructionn_client', true );
		$project_date     = get_post_meta( get_the_ID(), '_constructionn_date', true );
		$service_id       = get_post_meta( get_the_ID(), '_constructionn_service_type', true );

		$social_link = get_post_meta( get_the_ID(), '_team_social_icons', true );

		if ( ( get_post_type() === 'case-study' ) ) {
			?>
			<div class="case-studies-single-section">
				<div class="container">
					<div class="case-studies-single-wrap">
						<div class="case-studies-single-content">
							<div class="case-studies-image">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) );
									$caption = wp_get_attachment_caption( get_post_thumbnail_id() );
									echo '<figcaption>' . esc_html( $caption ) . '</figcaption>';
								} else {
									constructionn_get_fallback_svg( 'blog_card_image' );
								}
								?>
							</div>
							<?php if ( $project_location || $project_client || $project_date || $service_id ) { ?>
								<div class="info">
									<ul>
										<?php if ( $project_location ) { ?>
											<li>
												<span><?php esc_html_e( 'Location:', 'constructionn' ); ?></span>
												<p><?php echo esc_html( $project_location ); ?></p>
											</li>
										<?php } if ( $project_client ) { ?>
											<li>
												<span><?php esc_html_e( 'Client:', 'constructionn' ); ?></span>
												<p><?php echo esc_html( $project_client ); ?></p>
											</li>
										<?php } if ( $project_date ) { ?>
											<li>
												<span><?php esc_html_e( 'Date:', 'constructionn' ); ?></span>
												<p><?php echo esc_html( date( 'F j, Y', strtotime( $project_date ) ) ); ?></p>
											</li>
										<?php } if ( $service_id ) { ?>
											<li>
												<span><?php esc_html_e( 'Service type:', 'constructionn' ); ?></span>
												<p><?php echo esc_html( get_the_title( $service_id ) ); ?></p>
											</li>
										<?php } ?>
									</ul>
									<?php
									if ( $social_link ) {
										constructionn_team_social_media_icon( $social_link );
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
	}
endif;
add_action( 'constructionn_before_cpt_content', 'constructionn_case_study_single_top', 20 );
