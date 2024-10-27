<?php
/**
 * Project Template Project Section
 *
 * @package constructionn-pro
 */
$projpg_proj_headings  = get_theme_mod( 'projpg_project_headings', __( 'Our latest projects', 'constructionn-pro' ) );
$projpg_proj_descs     = get_theme_mod( 'projpg_project_descs', __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'constructionn-pro' ) );
$projpg_proj_btn_txt   = get_theme_mod( 'projpg_project_btn_txt', __( 'View All Projects', 'constructionn-pro' ) );
$projpg_proj_btn_link  = get_theme_mod( 'projpg_project_btn_link', '#' );
$projpg_p_btn_next_txt = get_theme_mod( 'projpg_proj_btn_next_txt', __( 'Next', 'constructionn-pro' ) );
$projpg_p_btn_prev_txt = get_theme_mod( 'projpg_proj_btn_prev_txt', __( 'Prev', 'constructionn-pro' ) );

$args    = array(
	'post_type'   => 'project',
	'post_status' => 'publish',
);
$project = new WP_Query( $args );

if ( $project->have_posts() || $projpg_proj_headings || $projpg_proj_descs || ( $projpg_proj_btn_txt && $projpg_proj_btn_link ) || $projpg_p_btn_next_txt || $projpg_p_btn_prev_txt ) { ?>
<div class="projects-section bg-gray projpg">
	<div class="container">
		<div class="projects-wrapper">
			<?php if ( $projpg_proj_headings || $projpg_proj_descs || ( $projpg_proj_btn_txt && $projpg_proj_btn_link ) ) { ?>
				<div class="projects-text__box">
					<?php if ( $projpg_proj_headings || $projpg_proj_descs ) { ?>
						<div class="section-meta-wrap">
							<?php if ( $projpg_proj_headings ) { ?>
								<h2 class="section-heading"><?php echo esc_html( $projpg_proj_headings ); ?></h2>
							<?php } if ( $projpg_proj_descs ) { ?>
								<?php echo wpautop( wp_kses_post( $projpg_proj_descs ) ); ?>
								<?php
							}
							?>
						</div>
					<?php } if ( $projpg_proj_btn_txt && $projpg_proj_btn_link ) { ?>
						<a href="<?php echo esc_url( $projpg_proj_btn_link ); ?>" class="btn has-icon btn__primary-outline"><?php echo esc_html( $projpg_proj_btn_txt ); ?></a>
						<?php
					}
					?>
				</div>
					<?php
			}
			?>
			<div class="swiper projects-swiper">
				<div class="swiper-wrapper">
					<?php constructionn_pro_get_front_project( $post_id = '' ); ?>
				</div>
				<?php if ( $projpg_p_btn_next_txt ) { ?>
					<div class="swiper-button-next"><?php echo esc_html( $projpg_p_btn_next_txt ); ?></div>
					<?php } if ( $projpg_p_btn_prev_txt ) { ?>
						<div class="swiper-button-prev"><?php echo esc_html( $projpg_p_btn_prev_txt ); ?></div>
					<?php
					}
					?>
			</div>
		</div>
	</div>
</div>
	<?php
}
