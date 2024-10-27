<?php
/**
 * Front Blog Section
 *
 * @package constructionn
 */
$front_blog_headings = get_theme_mod( 'front_blog_heading', __( 'We provide solution to every queries!', 'constructionn' ) );
$f_blog_btn_next_txt = get_theme_mod( 'front_blog_btn_next_txt', __( 'Next', 'constructionn' ) );
$f_blog_btn_prev_txt = get_theme_mod( 'front_blog_btn_prev_txt', __( 'Prev', 'constructionn' ) );
$ed_posted_date      = get_theme_mod( 'ed_single_posted_date', true );

$args = array(
	'posts_status'        => 'publish',
	'post_type'           => 'post',
	'ignore_sticky_posts' => true,
);

$posts = new WP_Query( $args );

if ( $front_blog_headings || $f_blog_btn_next_txt || $f_blog_btn_prev_txt ) { ?>
<div class="blog-section" id="front-blog">
	<div class="container">
		<?php if ( $front_blog_headings ) { ?>
			<div class="section-meta-wrap is-centered">
				<h2 class="section-heading"><?php echo esc_html( $front_blog_headings ); ?></h2>
			</div>
		<?php }  if ( $posts->have_posts() ) { ?>
			<div class="blog-wrapper">
				<div class="swiper blogs-swiper">
					<div class="swiper-wrapper">
						<?php
						while ( $posts->have_posts() ) {
							$posts->the_post();
							?>
						<div class="swiper-slide">
							<article class="post">
								<div class="blog__card">
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
									<div class="blog__info">
										<a href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
										</a>
										<div class="blog__bottom">
											<div class="blog-category">
												<?php constructionn_category(); ?>
											</div>
											<?php
											if ( $ed_posted_date ) {
												constructionn_posted_on();}
											?>
										</div>
									</div>
								</div>
							</article>
						</div>
						<?php } ?>
					</div>
					<?php if ( $f_blog_btn_next_txt ) { ?>
						<div class="swiper-button-next"><?php echo esc_html( $f_blog_btn_next_txt ); ?></div>
					<?php } if ( $f_blog_btn_prev_txt ) { ?>
						<div class="swiper-button-prev"><?php echo esc_html( $f_blog_btn_prev_txt ); ?></div>
						<?php
					}
					?>
				</div>
			</div>
		<?php } wp_reset_postdata(); ?>
	</div>
</div>
	<?php
}



