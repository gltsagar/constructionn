<?php
/**
 * Header Two
 *
 * @package Constructionn_Pro
 */
$toggle_header = get_theme_mod( 'topbar_toggle', true ); ?>
<div class="site-header style-two">
	<div class="desktop-header">
		<?php if ( $toggle_header ) { ?>
			<div class="container">
				<div class="header-wrapper">
					<div class="header-left">
						<div class="primary-menu-wrapper">
							<?php constructionn_pro_primary_nagivation(); ?>
						</div>
					</div>
					<div class="logo-wrapper">
						<?php constructionn_pro_site_branding( true ); ?>
					</div>
					<div class="header-right">
						<ul class="header-link-list">
							<?php constructionn_pro_front_header_two_myaccount(); ?>
							<li class="search-wrap">
								<a href="#" id="headerSearchBtn">
									<span class="search-icon">
										<?php echo wp_kses( constructionn_pro_handle_all_svgs( 'header-search-icon' ), constructionn_pro_get_kses_extended_ruleset() ); ?>
									</span>
									<span class="close-icon">
										<?php echo wp_kses( constructionn_pro_handle_all_svgs( 'header-search-icon-close' ), constructionn_pro_get_kses_extended_ruleset() ); ?>
									</span>
								</a>
								<div class="search-wrapper" id="headerSearch">
									<?php get_search_form(); ?>
								</div>
							</li>
								<?php constructionn_pro_front_header_one_request_quote(); ?>
						</ul>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
	<?php constructionn_pro_mobile_header(); ?>
</div>
<!-- header end -->
<!-- notification start -->
<?php constructionn_pro_notification_bar(); ?>
<!-- notification end -->

