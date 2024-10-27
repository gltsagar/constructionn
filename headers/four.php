<?php
/**
 * Header Four
 *
 * @package Constructionn
 */
$toggle_header = get_theme_mod( 'topbar_toggle', true );
$request_txt   = get_theme_mod( 'request_txt', __( 'Request a Quote', 'constructionn' ) );
$request_link  = get_theme_mod( 'request_link', '#' );
?>
<div class="site-header style-four">
	<div class="desktop-header">
		<div class="container">
			<?php if ( $toggle_header ) { ?>
				<div class="header-top">
					<?php constructionn_site_branding( true ); ?>
					<div class="top-right">
						<?php
						constructionn_header_contact_info( 'header-four' );
						if ( $request_txt && $request_link ) {
							?>
							<a href="<?php echo esc_url( $request_link ); ?>" class="btn btn__primary-outline"><?php echo esc_html( $request_txt ); ?></a>
							<?php
						}
						?>
											</div>
				</div>
			<?php } ?>
			<div class="header-wrapper">
				<div class="primary-menu-wrapper">
					<?php constructionn_primary_nagivation(); ?>
				</div>
				<div class="header-right">
					<?php constructionn_secondary_nagivation(); ?>
					<ul class="header-link-list">
						<li class="search-wrap">
							<a href="#" id="headerSearchBtn">
								<span class="search-icon">
									<?php echo wp_kses( constructionn_handle_all_svgs( 'header-search-icon' ), constructionn_get_kses_extended_ruleset() ); ?>
								</span>
								<span class="close-icon">
									<?php echo wp_kses( constructionn_handle_all_svgs( 'header-search-icon-close' ), constructionn_get_kses_extended_ruleset() ); ?>
								</span>
							</a>
							<div class="search-wrapper" id="headerSearch">
								<?php get_search_form(); ?>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<?php constructionn_mobile_header(); ?>
</div>

