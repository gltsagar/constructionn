<?php

/**
 * Team Template, Team Section
 *
 * @package constructionn-pro
 */
$tpg_team_headings     = get_theme_mod( 'teampg_team_headings', __( 'Our working steps', 'constructionn-pro' ) );
$tpg_team_btn_next_txt = get_theme_mod( 'tpg_team_btn_next_txt', __( 'Next', 'constructionn-pro' ) );
$tpg_team_btn_prev_txt = get_theme_mod( 'tpg_team_btn_prev_txt', __( 'Prev', 'constructionn-pro' ) );

$args = array(
	'post_type'   => 'team',
	'post_status' => 'publish',
);
$team = new WP_Query( $args );

if ( $team->have_posts() || $tpg_team_headings || $tpg_team_btn_next_txt || $tpg_team_btn_prev_txt ) { ?>
	<div class="teams-section">
		<div class="container">
			<?php if ( $tpg_team_headings ) { ?>
				<div class="section-meta-wrap is-centered">
					<h2 class="section-heading"><?php echo esc_html( $tpg_team_headings ); ?></h2>
				</div>
			<?php } ?>
			<div class="swiper teams-swiper">
				<div class="swiper-wrapper">
					<?php constructionn_pro_get_team( $post_id = '' ); ?>				
				</div>
				<?php if ( $tpg_team_btn_next_txt ) { ?>
					<div class="swiper-button-next"><?php echo esc_html( $tpg_team_btn_next_txt ); ?></div>
				<?php } if ( $tpg_team_btn_prev_txt ) { ?>
					<div class="swiper-button-prev"><?php echo esc_html( $tpg_team_btn_prev_txt ); ?></div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php
}
