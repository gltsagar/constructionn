<?php
/**
 * Case Study Template, Case Study Section
 *
 * @package constructionn-pro
 */
$cs_heading      = get_theme_mod( 'cspg_casestudies_heading', __( 'Case studies define our success.', 'constructionn-pro' ) );
$cs_readmore_btn = get_theme_mod( 'cspg_btn_text', __( 'Read More', 'constructionn-pro' ) );

$categories = get_terms(
	array(
		'taxonomy'   => 'casestudy_category',
		'hide_empty' => true,
	)
);

// Check if we have categories to show
if ( $cs_heading || ! empty( $categories ) ) { ?>
	<div class="case_studies-section has-tabs">
		<div class="container">
			<div class="case_studies-top">
				<?php if ( $cs_heading ) { ?>
					<div class="section-meta-wrap">
						<h2 class="section-heading"><?php echo esc_html( $cs_heading ); ?></h2>
					</div>
				<?php } ?>
				<div class="tab-btn-wrap">
					<div class="btn-wrapper">
						<?php foreach ( $categories as $index => $category ) : ?>
							<button data-id="<?php echo esc_attr( $category->slug ); ?>" <?php echo ( $index === 0 ) ? 'data-default="' . esc_attr( $category->slug ) . '"' : ''; ?> class="tab-btn <?php echo $index === 0 ? 'active' : ''; ?>">
								<?php echo esc_html( $category->name ); ?>
							</button>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			
			<div class="tab-content-wrap">
				<?php foreach ( $categories as $index => $category ) : ?>
					<div data-id="<?php echo esc_attr( $category->slug ); ?>" class="tab-content <?php echo $index === 0 ? 'active' : ''; ?>">
						<div class="content-wrapper">
							<div class="case_studies-wrapper">
								<?php
								// Query posts for this category
								$args            = array(
									'post_type'      => 'case-study',
									'posts_per_page' => 3,
									'tax_query'      => array(
										array(
											'taxonomy' => 'casestudy_category',
											'field'    => 'slug',
											'terms'    => $category->slug,
										),
									),
								);
								$case_studies    = new WP_Query( $args );
								$displayed_posts = array(); // To store the displayed post IDs

								if ( $case_studies->have_posts() ) :
									?>
									<div class="case_studies-top">
										<?php
										$case_studies->the_post();
										$displayed_posts[] = get_the_ID(); // Store the first post ID
										?>
										<article class="post">
											<div class="blog__card">
												<figure class="blog__img">
													<a href="<?php the_permalink(); ?>">
														<?php
														if ( has_post_thumbnail() ) {
															the_post_thumbnail( 'medium' );
														} else {
															constructionn_pro_get_fallback_svg( 'medium' );
														}
														?>
													</a>
												</figure>
												<div class="blog__info">
													<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
													<p>
														<?php
														if ( has_excerpt() ) {
															the_excerpt();
														} else {
															echo wp_kses_post( wp_trim_words( get_the_content(), 15, '...' ) );
														}
														?>
													</p>
													<?php if ( $cs_readmore_btn ) { ?>
															<a href="<?php the_permalink(); ?>" class="btn btn__text has-icon has-primary-color">
																<?php echo esc_html( $cs_readmore_btn ); ?>
															</a>
													<?php } ?>
												</div>
											</div>
										</article>
									</div>

									<div class="case_studies-bottom">
										<div class="projects-wrapper">
											<?php
											while ( $case_studies->have_posts() ) :
												$case_studies->the_post();
												$displayed_posts[] = get_the_ID(); // Add each displayed post ID to the array
												?>
												<article class="post">
													<div class="blog__card">
														<figure class="blog__img">
															<a href="<?php the_permalink(); ?>">
																<?php the_post_thumbnail( 'medium' ); ?>
															</a>
														</figure>
														<div class="blog__info">
															<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
															<p>
																<?php
																if ( has_excerpt() ) {
																	the_excerpt();
																} else {
																	echo wp_kses_post( wp_trim_words( get_the_content(), 15, '...' ) );
																}
																?>
															</p>
															<?php if ( $cs_readmore_btn ) { ?>
																	<a href="<?php the_permalink(); ?>" class="btn btn__text has-icon has-primary-color">
																		<?php echo esc_html( $cs_readmore_btn ); ?>
																	</a>
															<?php } ?>
														</div>
													</div>
												</article>
											<?php endwhile; ?>
										</div>

										<div class="projects-listing">
											<ul>
												<?php
												// Query more posts for the listing section, excluding the first three
												$args_list       = array(
													'post_type' => 'case-study',
													'posts_per_page' => -1, // Get all remaining posts
													'post__not_in' => $displayed_posts, // Exclude the already displayed posts
													'tax_query' => array(
														array(
															'taxonomy' => 'casestudy_category',
															'field' => 'slug',
															'terms' => $category->slug,
														),
													),
												);
												$case_study_list = new WP_Query( $args_list );

												if ( $case_study_list->have_posts() ) :
													while ( $case_study_list->have_posts() ) :
														$case_study_list->the_post();
														?>
														<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
														<?php
													endwhile;
													wp_reset_postdata();
												endif;
												?>
											</ul>
										</div>
									</div>
									<?php
								endif;
								wp_reset_postdata();
								?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php
}
