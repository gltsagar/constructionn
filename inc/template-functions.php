<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Constructionn
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */

if ( ! function_exists( 'constructionn_doctype' ) ) :
	/**
	 * Doctype Declaration
	 */
	function constructionn_doctype() {
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<?php
	}
endif;
add_action( 'constructionn_doctype', 'constructionn_doctype' );

if ( ! function_exists( 'constructionn_head' ) ) :
	/**
	 * Before wp_head
	 */
	function constructionn_head() {

		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php
	}
endif;
add_action( 'constructionn_before_wp_head', 'constructionn_head' );

if ( ! function_exists( 'constructionn_page_start' ) ) :
	/**
	 * Page Start
	 */
	function constructionn_page_start() {
		?>
		<div id="page" class="<?php constructionn_display_dynamic_class(); ?>">
			<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'constructionn' ); ?></a>
		<?php
	}
endif;
add_action( 'constructionn_before_header', 'constructionn_page_start', 20 );

if ( ! function_exists( 'constructionn_header_inclusion' ) ) :
	/**
	 * Header Function
	 */
	function constructionn_header_inclusion() {
		$header_array = array( 'one', 'two', 'three', 'four', 'five' );
		$header       = get_theme_mod( 'header_layouts', 'one' );

		if ( in_array( $header, $header_array ) ) {
			get_template_part( 'headers/' . $header );
		}
	}
endif;
add_action( 'constructionn_header', 'constructionn_header_inclusion', 10 );

if ( ! function_exists( 'constructionn_background_header' ) ) :
	/**
	 * Breadcrumbs section
	 *
	 * @return void
	 */
	function constructionn_background_header() {
		$breadcrumb_toggle = get_theme_mod( 'breadcrumb_toggle', true );

		if ( ! is_front_page() && $breadcrumb_toggle ) {
			$breadcrumb_image    = get_theme_mod( 'breadcrumb_image' );
			$breadcrumb_bg_color = get_theme_mod( 'breadcrumb_bg_color', '#0F5299' );
			$background_style    = $breadcrumb_bg_color;

			if ( $breadcrumb_image ) {
				$background_style = 'background-image: url(' . esc_url( wp_get_attachment_image_url( $breadcrumb_image, 'full' ) ) . '); background-repeat: no-repeat; background-position: center;';
				$class            = 'background-image-wrapper';
			} else {
				$background_style = 'background: ' . $breadcrumb_bg_color . ';';
				$class            = '';
			}
			?>
			<!-- breadcrumb start -->
			<div class="breadcrumb-wrapper <?php echo $class ? esc_attr( $class ) : ''; ?>" style="<?php echo esc_attr( $background_style ); ?>">
				<div class="container">
					<header class="entry-header">
						<?php constructionn_header_title(); ?>	
					</header>
					<?php constructionn_breadcrumbs(); ?>
				</div>
			</div>
			<!-- breadcrumb end -->
			<?php
		}
	}
endif;
add_action( 'constructionn_after_header', 'constructionn_background_header', 10 );

if ( ! function_exists( 'constructionn_post_thumbnail' ) ) :
	/**
	 * Displays the post thumbnail.
	 */
	function constructionn_post_thumbnail() {
		if ( ! is_singular() ) {
			?>
			<figure class="blog__img">
				<a href="<?php the_permalink(); ?>">  
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'blog_card_image' );
					} else {
						constructionn_get_fallback_svg( 'blog_card_image' );
					}
					?>
				</a>
			</figure>
			<?php
		} else {
			$author_id = get_the_author_meta( 'ID' );

			if ( ! empty( $author_id ) ) {
				$author_data = get_userdata( $author_id );
			}
			echo '<div class="post-image">';
			if ( ! empty( $author_data ) && ! is_page() && ! ( get_post_type() === 'service' ) ) {
				?>
					<header class="entry-header">
						<div class="entry-meta">
							<span class="author-details">
								<?php echo get_avatar( $author_id, 48 ); ?>
								<span class="details-wrapper">
									<span class="author-name">
										<span class="byline">
											<span>
												<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
													<?php echo esc_html( constructionn_get_author_name() ); ?>
												</a>
											</span>
										</span>
									</span>
									<?php if ( ! empty( $author_data->roles ) ) { ?>
										<span class="author-signature">
											<span class="byline">
												<span>
													<a href="#"><?php echo ucfirst( $author_data->roles[0] ); ?></a>
												</span>
											</span>
										</span>
									<?php } ?>
								</span>
							</span>
						</div>
						<div class="header-right">
							<div class="category-wrap">
								<?php constructionn_category(); ?>
							</div>
							<?php constructionn_posted_on(); ?>
						</div>
					</header>
				<?php } if ( has_post_thumbnail() ) { ?>
						<div class="post-thumbnail">
							<?php
								$thumbnail_id = get_post_thumbnail_id();
								// Get all the images metas
								$alt     = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
								$caption = wp_get_attachment_caption( $thumbnail_id );
								$title   = get_the_title( $thumbnail_id );

								the_post_thumbnail(
									'full',
									array(
										'alt'     => esc_attr( $alt ? $alt : $title ),
										'caption' => esc_attr( $caption ? $caption : $title ),
										'title'   => esc_attr( $title ),
									)
								);
							if ( $caption ) {
								echo '<figcaption>' . esc_html( $caption ) . '</figcaption>';
							}
							?>
						</div>
				<?php
				}
				echo '</div>';
		}
	}
endif;
add_action( 'constructionn_before_post_entry_content', 'constructionn_post_thumbnail', 10 );

if ( ! function_exists( 'constructionn_post_metas' ) ) :
	/**
	 * Post Meta
	 */
	function constructionn_post_metas() {
		if ( ! is_singular() ) {
			?>
			<div class="blog__info">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>	
				</a>
				<div class="blog__bottom">
					<div class="blog-category">
						<?php constructionn_category(); ?>
					</div>
					<?php constructionn_posted_on(); ?>
				</div>
			</div>
			<?php
		}
	}
endif;
add_action( 'constructionn_before_post_entry_content', 'constructionn_post_metas', 10 );

if ( ! function_exists( 'constructionn_entry_content' ) ) :
	/**
	 * Entry Content
	 */
	function constructionn_entry_content() {
		if ( is_singular() ) {
			?>
			<div class="entry-content" itemprop="text">
				<?php the_content(); ?>
			</div>
			<?php
		}
	}
endif;
add_action( 'constructionn_post_entry_content', 'constructionn_entry_content', 40 );

if ( ! function_exists( 'constructionn_post_edit' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function constructionn_post_edit() {
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'constructionn' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;
add_action( 'constructionn_post_entry_content', 'constructionn_post_edit', 50 );

if ( ! function_exists( 'constructionn_entry_content_wrapper_end' ) ) :
	/**
	 * Post Content wrapper Starts
	 */
	function constructionn_entry_content_wrapper_end() {
		if ( ! is_singular( array( 'page', 'service' ) ) ) {
			echo '</div>';
		}
	}
endif;
add_action( 'constructionn_entry_content_wrapper_end', 'constructionn_entry_content_wrapper_end', 60 );

if ( ! function_exists( 'constructionn_content_wrapper_start' ) ) {
	/**
	 * Content Wrapper
	 *
	 * @return void
	 */
	function constructionn_content_wrapper_start() {

		?>
		<div class="content-area" id="primary">
			<div class="container">
				<?php
				if ( ! is_404() ) {
					echo '<div class="page-grid">';}
				?>
					<div class="site-main" id="main">						
						<?php
						if ( is_author() ) {
							constructionn_author_box();
							echo '<h5>' . __( 'Author’s top blogs collection', 'constructionn' ) . '</h5>';
						}
						if ( is_search() ) {
							constructionn_show_serach_query_post_count();
							echo '<span class="screen-reader">' . __( 'Please conduct another search if you are not satisfied with the outcomes below.', 'constructionn' ) . '</span>';
							echo '<div class="search-wrapper">';
								get_search_form();
							echo '</div>';
						}
						if ( ! is_singular() && ! is_404() ) {
							echo '<div class="grid-layout">'; // don't render this html if it is 404 page
						}
	}
}
add_action( 'constructionn_before_posts_content', 'constructionn_content_wrapper_start' );

if ( ! function_exists( 'constructionn_single_entry_footer_sections' ) ) :
	/**
	 * Entry Footer
	 */
	function constructionn_single_entry_footer_sections() {
		$post_type = get_post_type( get_the_ID() );

		if ( is_singular( 'post' ) ) {
			constructionn_post_footer_meta();
			constructionn_author_box();
			constructionn_pagination();
			constructionn_comment();
			constructionn_related_posts( $post_type );
		}
	}
endif;
add_action( 'constructionn_after_posts_content', 'constructionn_single_entry_footer_sections', 5 );

if ( ! function_exists( 'constructionn_content_wrapper_end' ) ) :
	/**
	 * Content Wrapper
	 */
	function constructionn_content_wrapper_end() {
					global $wp_query;
					$results_count = $wp_query->found_posts;
		if ( ! is_singular() && ! is_404() ) {
			echo '</div>'; // End grid-layout
		}
		if ( is_archive() || is_home() || ( is_search() && $results_count > 0 ) ) {
			constructionn_pagination();
		} // in the search page, show navigation only when search query is available
		?>
				</div> <!-- End main -->
				<?php
				if ( ! is_404() ) {
					get_sidebar();
					echo '</div>'; // End Page-grid
				}
				?>
			</div> <!-- End container -->
		</div> <!-- End content area -->
		<?php
	}
endif;
add_action( 'constructionn_after_posts_content', 'constructionn_content_wrapper_end', 10 );

if ( ! function_exists( 'constructionn_cpt_wrapper_start' ) ) :
	/**
	 * Content Wrapper
	 *
	 * @return void
	 */
	function constructionn_cpt_wrapper_start() {

		// @todo need to make a function for handling the class.

		if ( get_post_type() == 'team' ) {
			?>
			<div class="team-single">
				<div class="team-single-section">
			<?php
		} if ( get_post_type() == 'project' ) {
			?>
			<div class="project-single">
				<div class="project-single-section">
			<?php
		} if ( get_post_type() == 'case-study' ) {
			?>
			<div class="case-studies-single">
				<div class="case-studies-section">
			<?php
		}
	}
endif;
add_action( 'constructionn_before_cpt_content', 'constructionn_cpt_wrapper_start', 10 );

if ( ! function_exists( 'constructionn_project_cta' ) ) :
	/**
	 * Single Project CTA
	 */
	function constructionn_project_cta() {
		if ( get_post_type() === 'project' ) {
			$bg_img        = get_theme_mod( 'project_single_cta_bg_img', esc_url( get_template_directory_uri() . '/assets/images/banner-1.jpg' ) );
			$f_cta_heading = get_theme_mod( 'project_single_cta_heading', __( 'Have any projects ?', 'constructionn' ) );
			$f_cta_descs   = get_theme_mod( 'project_single_cta_descs', __( 'Do not hesitate to contact us and get the best outcomes from our professionals.', 'constructionn' ) );
			$contact_num   = get_theme_mod( 'project_single_contact_number', __( '+1-202-555-0133', 'constructionn' ) );

			constructionn_cta_section(
				'project-single-cta',
				$bg_img,
				$f_cta_heading,
				$f_cta_descs,
				$contact_num
			);
		}
	}
endif;
add_action( 'constructionn_end_cpt_content', 'constructionn_project_cta', 5 );

if ( ! function_exists( 'constructionn_latest_projects' ) ) :
	/**
	 * Latets Projects List
	 */
	function constructionn_latest_projects() {

		if ( get_post_type() == 'project' ) {
			// @todo need to add the toggle control to show/hide the latest projects
			$toggle_related_post = get_theme_mod( 'toggle_related_post', true );

			$single_proj_headings     = get_theme_mod( 'project_single_latestproj_headings', __( 'Our latest projects', 'constructionn' ) );
			$single_proj_descs        = get_theme_mod( 'project_single_latestproj_descs', __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'constructionn' ) );
			$single_proj_btn_txt      = get_theme_mod( 'project_single_project_btn_txt', __( 'View All Projects', 'constructionn' ) );
			$single_proj_btn_link     = get_theme_mod( 'project_single_project_btn_link', '#' );
			$single_proj_btn_next_txt = get_theme_mod( 'project_single_project_btn_next_txt', __( 'Next', 'constructionn' ) );
			$single_proj_btn_prev_txt = get_theme_mod( 'project_single_project_btn_prev_txt', __( 'Prev', 'constructionn' ) );

			$args = array(
				'post_type'           => 'project',
				'posts_status'        => 'publish',
				'ignore_sticky_posts' => true,
				'posts_per_page'      => 6,
			);

			if ( get_post_type() === 'project' ) {
				$args['post__not_in'] = array( get_the_ID() );
			}

			$query = new WP_Query( $args );

			if ( $query->have_posts() ) {
				if ( $single_proj_headings || $single_proj_descs || $single_proj_btn_txt || $single_proj_btn_link || $single_proj_btn_next_txt || $single_proj_btn_prev_txt ) {
					?>
					<div class="projects-section <?php ( get_post_type() === 'project' ) ? 'bg-gray' : ''; ?>">
						<div class="container">
							<div class="projects-wrapper">
								<?php if ( $single_proj_headings || $single_proj_descs || ( $single_proj_btn_txt && $single_proj_btn_link ) ) { ?>
									<div class="projects-text__box">
										<?php if ( $single_proj_headings || $single_proj_descs ) { ?>
											<div class="section-meta-wrap">
												<?php if ( $single_proj_headings ) { ?>
													<h2 class="section-heading"><?php echo esc_html( $single_proj_headings ); ?></h2>
												<?php } if ( $single_proj_descs ) { ?>
													<p class="section-desc"><?php echo esc_html( $single_proj_descs ); ?></p>
													<?php
												}
												?>
											</div>
										<?php } if ( $single_proj_btn_txt && $single_proj_btn_link ) { ?>
											<a href="<?php echo esc_url( $single_proj_btn_link ); ?>" class="btn has-icon btn__primary-outline"><?php echo esc_html( $single_proj_btn_txt ); ?></a>
										<?php } ?>
									</div>
								<?php } ?>
								<div class="swiper projects-swiper">
									<div class="swiper-wrapper">
										<?php
										while ( $query->have_posts() ) {
											$query->the_post();
											$categories = get_the_terms( get_the_ID(), 'project_category' );
											?>
											<div class="swiper-slide">
												<article class="post">
													<div class="blog__card">
														<figure class="blog__img">
															<a href="<?php the_permalink(); ?>">
																<?php
																if ( has_post_thumbnail() ) {
																	the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) );
																} else {
																	constructionn_get_fallback_svg( 'blog_card_image' );
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
										<?php } ?>
									</div>
									<?php if ( $single_proj_btn_next_txt ) { ?>
										<div class="swiper-button-next"><?php echo esc_html( $single_proj_btn_next_txt ); ?></div>
									<?php } if ( $single_proj_btn_prev_txt ) { ?>
										<div class="swiper-button-prev"><?php echo esc_html( $single_proj_btn_prev_txt ); ?></div>
										<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
				wp_reset_postdata();
			}
		}
	}
endif;
add_action( 'constructionn_end_cpt_content', 'constructionn_latest_projects', 10 );

if ( ! function_exists( 'constructionn_latest_case_study' ) ) :
	/**
	 * Latets Projects List
	 */
	function constructionn_latest_case_study() {

		// @todo need to add the toggle control to show/hide the latest projects
		$toggle_related_post  = get_theme_mod( 'toggle_related_post', true );
		$single_proj_headings = get_theme_mod( 'related_post_heading', __( 'Related Posts', 'constructionn' ) );
		$post_readmore_button = get_theme_mod( 'post_readmore_button', __( 'Read More', 'constructionn' ) );

		$args = array(
			'post_type'           => 'case-study',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => 3, // Limit the number of related posts
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() || $single_proj_headings || $post_readmore_button ) {
			?>
			<div class="related-post">
				<div class="container">
					<div class="section-meta-wrap">
						<?php if ( $single_proj_headings ) { ?>
							<h2 class="section-heading"><?php echo esc_html( $single_proj_headings ); ?></h2>
						<?php } ?>
					</div>
					<?php if ( $query->have_posts() ) { ?>
						<div class="grid-layout-wrap">
							<div class="row">
								<?php
								while ( $query->have_posts() ) {
									$query->the_post();
									?>
									<article class="post">
										<div class="blog__card">
											<div class="blog__info">
												<a href="<?php the_permalink(); ?>">
													<h5><?php the_title(); ?></h5>
												</a>
												<div class="blog__content">
													<p><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
												</div>
												<?php if ( $post_readmore_button ) { ?>
													<a href="<?php the_permalink(); ?>" class="btn btn__text has-icon has-primary-color"><?php echo esc_html( $post_readmore_button ); ?></a>
												<?php } ?>
											</div>
										</div>
									</article>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<?php
			wp_reset_postdata();
		}
	}
endif;
add_action( 'constructionn_end_cpt_content', 'constructionn_latest_case_study', 10 );

if ( ! function_exists( 'constructionn_cpt_wrapper_end' ) ) {
	/**
	 * Content Wrapper
	 *
	 * @return void
	 */
	function constructionn_cpt_wrapper_end() {
		?>
			</div>
		</div>
		<?php
	}
}
add_action( 'constructionn_end_cpt_content', 'constructionn_cpt_wrapper_end', 20 );

if ( ! function_exists( 'constructionn_team_wrapper_start' ) ) {
	/**
	 * Content Wrapper
	 *
	 * @return void
	 */
	function constructionn_team_wrapper_start() {

		?>
		<main class="content-area site-main" id="main">
		<?php
	}
}
add_action( 'constructionn_before_team_content', 'constructionn_team_wrapper_start', 10 );

if ( ! function_exists( 'constructionn_team_wrapper_end' ) ) {
	/**
	 * Content Wrapper
	 *
	 * @return void
	 */
	function constructionn_team_wrapper_end() {

		?>
			</main>
		<?php
	}
}
add_action( 'constructionn_end_team_content', 'constructionn_team_wrapper_end', 10 );


if ( ! function_exists( 'constructionn_footer_back_to_top' ) ) {
	/**
	 * Footer Start
	 */
	function constructionn_footer_back_to_top() {
		$toggle_scroll = get_theme_mod( 'scroll_button_display_setting', true );
		$scroll_text   = get_theme_mod( 'scroll_text', __( 'Back to top', 'constructionn' ) );

		if ( $toggle_scroll && $scroll_text ) {
			?>
			<span class="scroll-back" id="scroll__top">
				<a href="#">
					<?php echo esc_html( $scroll_text ); ?>
				</a>
			</span>
			<span id="sideMenuOverlay"></span>
			<?php
		}
	}
}
add_action( 'constructionn_footer', 'constructionn_footer_back_to_top', 10 );

if ( ! function_exists( 'constructionn_footer_start' ) ) {
	/**
	 * Footer Start
	 */
	function constructionn_footer_start() {
		$footer_img               = get_theme_mod( 'footer_image' );
		$footer_fallback_bg_color = get_theme_mod( 'footer_fallback_bg_color', '#0F5299' );
		$background_style         = $footer_fallback_bg_color;

		if ( $footer_img ) {
			$background_style = 'background-image: url(' . esc_url( wp_get_attachment_image_url( $footer_img, 'full' ) ) . '); background-repeat: no-repeat; background-position: center;';
		} else {
			$background_style = 'background: ' . $footer_fallback_bg_color . ';';
		}
		?>
		<footer class="site-footer" style="<?php echo esc_attr( $background_style ); ?>">
			<div class="container">
		<?php
	}
}
add_action( 'constructionn_footer', 'constructionn_footer_start', 20 );

if ( ! function_exists( 'constructionn_footer_top' ) ) {
	/**
	 * Footer Middle Widgets Four
	 *
	 * @return void
	 */
	function constructionn_footer_top() {
		$logo_url = get_theme_mod( 'footer_custom_logo', '' );
		?>
			<div class="footer-top">
				<?php
				if ( $logo_url ) {
					$logo_id = attachment_url_to_postid( $logo_url );
					?>
					<section class="widget widget_block">
						<div class="wp-block-group">
							<div class="wp-block-group__inner-container">
								<figure class="wp-block-image">
									<?php echo wp_get_attachment_image( $logo_id, 'thumbnail', false ); ?>
								</figure>
							</div>
						</div>
					</section>
				<?php } constructionn_social_media_repeater( 'socials_media_repeater', 'footer-section' ); ?>
			</div>
		<?php
	}
}
add_action( 'constructionn_footer', 'constructionn_footer_top', 30 );

if ( ! function_exists( 'constructionn_footer_main' ) ) {
	/**
	 * Footer Middle Widgets Section
	 *
	 * @return void
	 */
	function constructionn_footer_main() {
		$footers_one  = 'footer-one';
		$footer_two   = 'footer-two';
		$footer_three = 'footer-three';
		$footer_four  = 'footer-four';

		if ( is_active_sidebar( $footers_one ) || is_active_sidebar( $footer_two ) || is_active_sidebar( $footer_three ) || is_active_sidebar( $footer_four ) ) {
			?>
			<div class="footer-main">
				<div class="footer-grid">
					<?php
						$footer_widgets = array( $footers_one, $footer_two, $footer_three, $footer_four );
					foreach ( $footer_widgets as $widget ) {
						if ( is_active_sidebar( $widget ) ) {
							?>
								<div class="column">
									<?php dynamic_sidebar( $widget ); ?>
								</div>
							<?php
						}
					}
					?>
				</div>
			</div>
			<?php
		}
	}
}
add_action( 'constructionn_footer', 'constructionn_footer_main', 40 );

if ( ! function_exists( 'constructionn_footer_bottom' ) ) {
	/**
	 * Footer Bottom has footer left and right
	 * -Left: Calling functions footer_copyright, toggle_author_link and toggle_wp_link
	 * -Right: Calling functions footer_navigation and privacy_policy_link
	 *
	 * @return void
	 */
	function constructionn_footer_bottom() {
		$toggle_footer_copyright = get_theme_mod( 'toggle_footer_copyright', true );
		$logo_repeater           = get_theme_mod( 'footer_logos_slider_custom', array() );
		?>
		<div class="footer-bottom">
			<div class="container">
				<div class="footer-bottom-menu-wrapper">
					<?php
					constructionn_footer_navigation();
					if ( $logo_repeater ) {
						?>
						<div class="footer-logo">
							<?php
							foreach ( $logo_repeater as $logo ) {
								$logo_thumb = ( isset( $logo['thumbnail'] ) && ! empty( $logo['thumbnail'] ) ) ? $logo['thumbnail'] : false;
								$logo_url   = ( isset( $logo['url'] ) && ! empty( $logo['url'] ) ) ? $logo['url'] : false;
								if ( $logo_thumb && $logo_url ) {
									?>
								<a href="<?php echo esc_url( $logo_url ); ?>">
										<?php echo wp_get_attachment_image( $logo_thumb, 'full' ); ?>
								</a>
									<?php
								}
							}
							?>
						</div>
						<?php
					}
					?>
				</div>
				<?php
				if ( $toggle_footer_copyright ) {
					constructionn_footer_copyright();
				}
				?>
			</div>
		</div>
		<?php
	}
}
add_action( 'constructionn_footer', 'constructionn_footer_bottom', 50 );

if ( ! function_exists( 'constructionn_footer_end' ) ) {
	/**
	 * Footer end
	 */
	function constructionn_footer_end() {
		?>
			</div>
		</footer>
		<?php
	}
}
add_action( 'constructionn_footer', 'constructionn_footer_end', 60 );

if ( ! function_exists( 'constructionn_page_end' ) ) {
	/**
	 * Page End
	 *
	 * @return void
	 */
	function constructionn_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
}
add_action( 'constructionn_after_footer', 'constructionn_page_end', 10 );

if ( ! function_exists( 'constructionn_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function constructionn_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_date( 'F j' ) )
		);

		$posted_on = $time_string;

		echo '<span class="blog__date"><a href="#" rel="bookmark">' . $posted_on . '</a></span>'; // WPCS: XSS OK.
	}
endif;

if ( ! function_exists( 'constructionn_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function constructionn_posted_by() {
		$ed_posted_author = get_theme_mod( 'ed_single_posted_author', true );

		if ( $ed_posted_author ) {
			echo '<span class="author-details">';
				$byline = sprintf(
					/* translators: %s: post author. */
					esc_html_x( 'AUTHOR %s', 'post author', 'constructionn' ),
					'<span><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><strong>' . esc_html( get_the_author() ) . '</strong></a></span>'
				);
				echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '</span>';
		}
	}
endif;

if ( ! function_exists( 'constructionn_category' ) ) :
	/**
	 * Show categories
	 */
	function constructionn_category() {
		$categories = get_the_category( get_the_ID() );
		if ( ! empty( $categories ) ) {
			?>
			<span class="category-list">
				<?php
				foreach ( $categories as $category ) {
					$categories_url = get_category_link( $category->term_id );
					?>
					<a href=<?php echo esc_url( $categories_url ); ?>>
						<?php echo esc_html( $category->name ); ?>
					</a>
				<?php } ?>
			</span>
			<?php
		}
	}
endif;

if ( ! function_exists( 'constructionn_post_footer_meta' ) ) :
	/**
	 * Author Section
	 */
	function constructionn_post_footer_meta() {

		?>
			<footer class="entry-footer">
				<section class="widget widget_block">
					<div class="wp-block-group">
						<div class="wp-block-group__inner-container">
							<?php constructionn_tags(); ?>
						</div>
					</div>
				</section>
			</footer>
		<?php
	}
endif;

if ( ! function_exists( 'constructionn_header_contact_info' ) ) {
	/**
	 * Header Information i.e email, email title, phone, location, location title
	 */
	function constructionn_header_contact_info( $sec_name ) {
		$email          = get_theme_mod( 'email', __( 'info@gl-konstruction.com', 'constructionn' ) );
		$email_title    = get_theme_mod( 'header_email_title', __( 'Mail Us:', 'constructionn' ) );
		$phone          = get_theme_mod( 'phone_number', __( '+1-800-111-2222', 'constructionn' ) );
		$location       = get_theme_mod( 'header_location', __( 'Hamburg,Germany', 'constructionn' ) );
		$location_title = get_theme_mod( 'header_location_title', __( 'Location:', 'constructionn' ) );

		if ( ( $email && $email_title ) || $phone || ( $location && $location_title ) ) {
			?>
					<ul class="contact-links <?php echo esc_attr( $sec_name ); ?>">
				<?php if ( $sec_name == 'header-three' || $sec_name == 'header-five' ) { ?>
					<!-- Display email and phone in header three and header five -->
					<li class="phone">
						<a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^\d+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
					</li>
					<li class="mail">
						<a href="<?php echo esc_url( 'mailto:' . sanitize_email( $email ) ); ?>"><?php echo esc_html( $email ); ?></a>
					</li>
				<?php } elseif ( $sec_name == 'header-four' ) { ?>
					<!-- Display email title, email, location title, and location in header four -->
					<li class="mail">
						<strong><?php echo esc_html( $email_title ); ?></strong>
						<a href="<?php echo esc_url( 'mailto:' . sanitize_email( $email ) ); ?>"><?php echo esc_html( $email ); ?></a>
					</li>
					<li class="location">
						<strong><?php echo esc_html( $location_title ); ?></strong>
						<a href="#"><?php echo esc_html( $location ); ?></a>
					</li>
				<?php } ?>
			</ul>
			<?php
		}
	}
}

if ( ! function_exists( 'constructionn_history_section' ) ) {
	/**
	 * History Section
	 */
	function constructionn_history_section( $sec_name, $headings, $history_descs, $btns_text, $btns_link, $front_history_repeater ) {
		if ( $headings || $history_descs || ( $btns_text && $btns_link ) || $front_history_repeater ) {
			?>
			<section class="history-section <?php echo esc_attr( $sec_name ); ?>" id="<?php echo esc_attr( $sec_name ); ?>">
				<div class="container">
					<?php if ( $headings || $history_descs || ( $btns_text && $btns_link ) ) { ?>
						<?php
						if ( ! ( $sec_name == 'history-list' ) ) {
							echo '<div class="history-top__wrapper">'; // start history-top__wrapper
						}
						if ( $headings || $history_descs ) {
							?>
									<div class="section-header<?php echo ( $sec_name == 'history-list' ) ? ' text-center' : ''; ?>">
										<?php if ( $headings ) { ?>
											<h2 class="section-header__title"><?php echo wp_kses_post( $headings ); ?></h2>
										<?php } if ( $history_descs ) { ?>
											<div class="history-description">
												<p><?php echo wp_kses_post( $history_descs ); ?></p>
											</div>
										<?php } ?>
									</div>
								<?php } if ( ( $btns_text && $btns_link && ( $sec_name != 'history-list' ) ) ) { ?>
										<a href="<?php echo esc_url( $btns_link ); ?>" class="btn btn-primary"><?php echo esc_html( $btns_text ); ?></a>
								<?php
								}
								if ( ! ( $sec_name == 'history-list' ) ) {
									echo '</div">'; // End history-top__wrapper
								}
					} if ( $front_history_repeater ) {
						?>
							<div class="history-wrapper">
								<?php
								foreach ( $front_history_repeater as $repeater ) {
									$history_id = ( ! empty( $repeater['history'] ) && isset( $repeater['history'] ) ) ? $repeater['history'] : '';
									if ( $history_id ) {
										?>
										<div class="history">
											<?php constructionn_get_front_history( $history_id ); ?>
										</div>
										<?php
									}
								}
								?>
							</div>
					<?php } ?>  
				</div>
			</section>
			<?php
		}
	}
}



if ( ! function_exists( 'constructionn_service_section' ) ) {
	/**
	 * Services Section
	 */
	function constructionn_service_section( $sec_name, $service_headings, $service_btn_txt, $service_image, $front_serv_repeater ) {
		$service_image_id = attachment_url_to_postid( $service_image );
		if ( $service_headings || $service_image || $front_serv_repeater ) {
			?>
			<div id="<?php echo esc_attr( $sec_name ); ?>" class="services-section <?php echo esc_attr( $sec_name ); ?>">
				<div class="container">
					<div class="services-section-wrapper">
						<?php if ( $service_headings ) { ?>
							<div class="section-meta-wrap is-centered">
								<h2 class="section-heading"><?php echo esc_html( $service_headings ); ?></h2>							
							</div>
							<?php
						}
						?>
						<?php if ( $front_serv_repeater ) { ?>
							<div class="services-content">
								<div class="content-left">
									<?php
									foreach ( $front_serv_repeater as $repeater ) {
										$service_ids = ( ! empty( $repeater['service'] ) && isset( $repeater['service'] ) ) ? $repeater['service'] : '';
										if ( $service_ids ) {
											constructionn_get_front_services_details( $service_btn_txt, $service_ids );
										}
									}
									?>
								</div>								
								<?php if ( $service_image_id || $service_image ) { ?>
									<div class="content-right">
										<?php
										if ( $service_image_id ) {
											echo wp_get_attachment_image( $service_image_id, 'service_img' );
										} else {
											echo '<img src="' . esc_url( $service_image ) . '">';
										}
										?>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'constructionn_project_section' ) ) {
	/**
	 * Project Section
	 */
	function constructionn_project_section( $sec_name, $proj_headings, $proj_descs, $proj_btn_txt, $proj_btn_link, $proj_btn_next_txt, $proj_btn_prev_txt, $front_proj_repeater ) {
		if ( $proj_headings || $proj_descs || ( $proj_btn_txt && $proj_btn_link ) || $proj_btn_next_txt || $proj_btn_prev_txt || $front_proj_repeater ) {
			?>
			<div id="<?php echo esc_attr( $sec_name ); ?>" class="projects-section bg-gray <?php echo esc_attr( $sec_name ); ?>">
				<div class="container">
					<div class="projects-wrapper">
						<?php if ( $proj_headings || $proj_descs || ( $proj_btn_txt && $proj_btn_link ) ) { ?>
							<div class="projects-text__box">
								<?php if ( $proj_headings || $proj_descs ) { ?>
									<div class="section-meta-wrap">
										<?php if ( $proj_headings ) { ?>
											<h2 class="section-heading"><?php echo esc_html( $proj_headings ); ?></h2>
										<?php } if ( $proj_descs ) { ?>
											<?php echo wpautop( wp_kses_post( $proj_descs ) ); ?>
											<?php
										}
										?>
									</div>
								<?php } if ( $proj_btn_txt && $proj_btn_link ) { ?>
									<a href="<?php echo esc_url( $proj_btn_link ); ?>" class="btn has-icon btn__primary-outline"><?php echo esc_html( $proj_btn_txt ); ?></a>
									<?php
								}
								?>
							</div>
						<?php } if ( $front_proj_repeater ) { ?>
							<div class="swiper projects-swiper">
								<div class="swiper-wrapper">
									<?php
									foreach ( $front_proj_repeater as $repeater ) {
										$project_id = ( ! empty( $repeater['project'] ) && isset( $repeater['project'] ) ) ? $repeater['project'] : '';
										constructionn_get_front_project( $project_id );
									}
									?>
																	</div>
								<?php if ( $proj_btn_next_txt ) { ?>
									<div class="swiper-button-next"><?php echo esc_html( $proj_btn_next_txt ); ?></div>
								<?php } if ( $proj_btn_prev_txt ) { ?>
									<div class="swiper-button-prev"><?php echo esc_html( $proj_btn_prev_txt ); ?></div>
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
			<?php
		}
	}
}

if ( ! function_exists( 'constructionn_faq_section' ) ) :
	/**
	 * FAQ Section or Archive
	 *
	 * @param string $sec_name
	 * @param string $faq_headings
	 * @param array  $front_faq_repeater
	 * @param bool   $show_all_faqs  Indicates if all FAQs should be fetched
	 */
	function constructionn_faq_section( $sec_name, $faq_headings, $front_faq_repeater, $show_all_faqs = false ) {
		if ( $faq_headings ) {
			?>
			<div id="<?php echo esc_html( $sec_name ); ?>" class="faqs-section bg-gray <?php echo esc_html( $sec_name ); ?>">
				<div class="container">
					<?php if ( $faq_headings ) { ?>
						<div class="section-meta-wrap is-centered">
							<h2 class="section-heading"><?php echo esc_html( $faq_headings ); ?></h2>
						</div>
					<?php } ?>
					<div class="faq-wapper">
						<div class="tab-wrapper">
							<div class="tab-btn-wrap">
								<div class="btn-wrapper">
									<?php
									// Prepare an array to hold FAQs grouped by category
									$faqs_by_category = array();

									// Fetch FAQs either from repeater or all the faq post
									if ( $show_all_faqs ) {
										// get all the faq
										$faq_posts = get_posts(
											array(
												'post_type'   => 'faq',
												'numberposts' => -1, // Get all FAQs
											)
										);
										foreach ( $faq_posts as $faq_post ) {
											$faq_category = get_the_terms( $faq_post->ID, 'faq_category' );

											if ( $faq_category && ! is_wp_error( $faq_category ) ) {
												foreach ( $faq_category as $category ) {
													$faqs_by_category[ $category->slug ]['name'] = $category->name; // store the category name
													$faqs_by_category[ $category->slug ]['id'][] = $faq_post->ID; // Store FAQ post ID
												}
											}
										}
									} else {
										// Loop through the repeater data
										foreach ( $front_faq_repeater as $repeater ) {
											$faq_id       = $repeater['faq'];
											$faq_category = get_the_terms( $faq_id, 'faq_category' );

											if ( $faq_category && ! is_wp_error( $faq_category ) ) {
												foreach ( $faq_category as $category ) {
													// using the category slug as the key to store the category name and id
													$faqs_by_category[ $category->slug ]['name'] = $category->name; // store the category name
													$faqs_by_category[ $category->slug ]['id'][] = $faq_id; // Store FAQ post ID
												}
											}
										}
									}
									$first_button = true;
									// Display the category buttons based on the faq category selected
									foreach ( $faqs_by_category as $slug => $category ) :
										?>
										<button data-id="<?php echo esc_attr( $slug ); ?>" class="tab-btn" <?php echo $first_button ? 'data-default="' . esc_attr( $slug ) . '"' : ''; ?> >
											<?php echo esc_html( $category['name'] ); ?>
										</button>
										<?php
										$first_button = false; // Set to false after the first button
									endforeach;
									?>
								</div>
							</div>
							<div class="tab-content-wrap">
								<?php
								// Variable to track the first tab
								$first_tab = true;
								// Loop through each category and display its FAQs
								foreach ( $faqs_by_category as $slug => $category ) :
									?>
									<div data-id="<?php echo esc_attr( $slug ); ?>" class="tab-content" <?php echo $first_tab ? 'data-default="' . esc_attr( $slug ) . '"' : ''; ?>>
										<div class="content-wrapper">
											<h4 class="title"><?php echo esc_html( $category['name'] ); ?></h4>
											<div class="accordion">
												<?php
												foreach ( $category['id'] as $faq_id ) {
													$faq_post = get_post( $faq_id ); // Get the FAQ post object
													if ( $faq_post ) {
														?>
														<div class="accordion-item">
															<button class="accordion-button">
																<p><?php echo esc_html( $faq_post->post_title ); // FAQ question ?></p>
															</button>
															<div class="accordion-content">
																<?php echo wp_strip_all_tags( $faq_post->post_content ); // FAQ answer ?>
															</div>
														</div>
														<?php
													}
												}
												?>
											</div>
										</div>
									</div>
									<?php
									$first_tab = false; // Set to false after the first tab
								endforeach;
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}
endif;

if ( ! function_exists( 'constructionn_team_section' ) ) :
	/**
	 * Team Section
	 *
	 * @return void
	 */
	function constructionn_team_section( $sec_name, $front_team_headings, $frontteam_btn_next_txt, $frontteam_btn_prev_txt, $front_team_repeater ) {
		if ( $front_team_headings || $frontteam_btn_next_txt || $frontteam_btn_prev_txt || $front_team_repeater ) {
			?>
			<div id="<?php echo esc_attr( $sec_name ); ?>" class="teams-section <?php echo esc_attr( $sec_name ); ?>">
					<div class="container">
						<?php if ( $front_team_headings ) { ?>
							<div class="section-meta-wrap is-centered">
								<h2 class="section-heading"><?php echo esc_html( $front_team_headings ); ?></h2>
							</div>
						<?php } if ( $front_team_repeater ) { ?>
							<div class="swiper teams-swiper">
								<div class="swiper-wrapper">
									<?php
									foreach ( $front_team_repeater as $repeater ) {
										$team_id = ( ! empty( $repeater['team'] ) && isset( $repeater['team'] ) ) ? $repeater['team'] : '';
										constructionn_get_team( $team_id );
									}
									?>
																	</div>
								<?php if ( $frontteam_btn_next_txt ) { ?>
									<div class="swiper-button-next"><?php echo esc_html( $frontteam_btn_next_txt ); ?></div>
								<?php } if ( $frontteam_btn_prev_txt ) { ?>
									<div class="swiper-button-prev"><?php echo esc_html( $frontteam_btn_prev_txt ); ?></div>
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
endif;

if ( ! function_exists( 'constructionn_cta_section' ) ) :
	/**
	 * Cta Section
	 *
	 * @return void
	 */
	function constructionn_cta_section( $sec_name, $bg_img, $f_cta_heading, $f_cta_descs, $contact_num ) {
		$fallback_bg_color = get_theme_mod( 'fallback_bg_color', '#003262' );
		$background_style  = $fallback_bg_color;
		// background image
		if ( $bg_img ) {
			$background_style = 'background-image: url(' . esc_url( $bg_img ) . '); background-repeat: no-repeat; background-position: center;';
		} else {
			$background_style = 'background-color: ' . esc_attr( $fallback_bg_color ) . ';';
		}

		if ( $bg_img || $f_cta_heading || $f_cta_descs || $contact_num ) {
			?>
			<div id="<?php echo esc_attr( $sec_name ); ?>" class="cta-section <?php echo esc_attr( $sec_name ); ?>" style="<?php echo esc_attr( $background_style ); ?>">
				<div class="container">
					<?php if ( $f_cta_heading || $f_cta_descs || $contact_num ) { ?>
						<div class="content-wrapper">
							<?php if ( $f_cta_heading || $f_cta_descs ) { ?>
								<div class="section-meta-wrap">
									<?php if ( $f_cta_heading ) { ?>
										<h2 class="section-heading teampg"><?php echo esc_html( $f_cta_heading ); ?></h2>
									<?php } if ( $f_cta_descs ) { ?>
										<p class="section-desc"><?php echo esc_html( $f_cta_descs ); ?></p>
										<?php
									}
									?>
								</div>
							<?php } if ( $contact_num ) { ?>
								<a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^\d+]/', '', $contact_num ) ); ?>">
									<span class="icon">
										<?php echo wp_kses( constructionn_handle_all_svgs( 'contact-cta' ), constructionn_get_kses_extended_ruleset() ); ?>
									</span>
									<span><?php echo esc_html( $contact_num ); ?></span>
								</a>
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
endif;

if ( ! function_exists( 'constructionn_related_history' ) ) :
	/**
	 * Related Posts for history
	 */
	function constructionn_related_history( $post_id ) {
		$toggle_related_posts = get_theme_mod( 'toggle_rel_history_post', true );
		$titles               = get_theme_mod( 'related_post_headings', __( 'Related Posts', 'constructionn' ) );
		$toggle_excerpts      = get_theme_mod( 'toggle_rel_post_excerpt', true );
		$excerpt_lengths      = get_theme_mod( 'posts_excerpt_length', '15' );

		$args  = array(
			'post_type'    => 'history',
			'posts_status' => 'publish',
			'post__not_in' => array( $post_id ),
		);
		$query = new WP_Query( $args );

		if ( $query->have_posts() && $toggle_related_posts ) {
			?>
			<section class="history-section">
				<div class="container">
					<div class="history-top__wrapper">
						<?php if ( $titles ) { ?>
							<div class="section-header">
								<h3 class="section-header__title"><?php echo esc_html( $titles ); ?></h3>
							</div>
							<?php
						}
						?>
					</div>
					<div class="history-wrapper">
						<?php
						while ( $query->have_posts() ) {
							$query->the_post();
							$custom_month = get_post_meta( get_the_ID(), '_custom_month_meta_key', true );
							$custom_year  = get_post_meta( get_the_ID(), '_custom_year_meta_key', true );
							?>
							<div class="history">
								<?php if ( ! empty( $custom_month ) || ! empty( $custom_year ) ) { ?>
									<time class="history__date">
										<?php
										if ( $custom_month ) {
											echo esc_html( $custom_month );}
										?>
										<br>
										<span>
											<?php
											if ( $custom_month ) {
												echo esc_html( $custom_year );}
											?>
										</span>
									</time>
								<?php } ?>
								<div class="history__content">
									<div class="history__title">
										<h3>
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h3>
									</div>
									<?php
									if ( $toggle_excerpts ) {
										echo '<div class="history__text">';
										if ( has_excerpt() ) {
											the_excerpt();
										} else {
											echo wpautop( wp_trim_words( get_the_content(), $excerpt_lengths ) );
										}
											echo '</div>';
									}
									?>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</section>
			<?php
		}
		wp_reset_postdata();
	}
endif;

if ( ! function_exists( 'constructionn_case_study' ) ) :
	/**
	 * Case study section function
	 *
	 * @param [string] $casestd_heading
	 * @param [array]  $casestd_repeater_posts
	 * @param [string] $cs_btn_txt
	 * @return void
	 */
	function constructionn_case_study( $sec_name, $casestd_heading, $cs_btn_txt, $casestd_repeater_posts ) {
		if ( $casestd_heading || $casestd_repeater_posts ) {
			?>
			<div id="<?php echo esc_attr( $sec_name ); ?>" class="case_studies-section <?php echo esc_attr( $sec_name ); ?>">
				<div class="container">
					<?php if ( $casestd_heading ) { ?>
						<div class="section-meta-wrap">
							<h2 class="section-heading"><?php echo esc_html( $casestd_heading ); ?></h2>
						</div>
						<?php
					}
						// Collect all the case study IDs from the repeater
						$case_study_ids = array_map(
							function ( $repeater ) {
								return ( isset( $repeater['casestudy'] ) && ! empty( $repeater['casestudy'] ) ) ? $repeater['casestudy'] : null;
							},
							$casestd_repeater_posts
						);

						// Remove nulls from the array
						$case_study_ids = array_filter( $case_study_ids );

			if ( $case_study_ids ) {
				// Get the case study posts and display them
				constructionn_get_case_study_post( $cs_btn_txt, $case_study_ids );
			}
			?>
				</div>
			</div>
			<?php
		}
	}
endif;
