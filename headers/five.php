<?php
/**
 * Header Five
 *
 * @package Constructionn
 */
$toggle_header = get_theme_mod( 'topbar_toggle', true ); ?>
<div class="site-header style-five">
	<div class="desktop-header">
		<?php if ( $toggle_header ) { ?>
			<div class="container">
				<div class="header-wrapper">
					<div class="header-left">
						<?php constructionn_header_contact_info( 'header-five' ); ?>
					</div>
						<?php constructionn_site_branding( true ); ?>
					<div class="header-right">
						<ul class="header-link-list">
							<?php constructionn_front_header_one_request_quote(); ?>
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
						<?php constructionn_header_five_ham_wrapper( 'header-five', 'menu_label' ); ?>
						<div class="sidebar" id="mobileSideMenu">
							<div class="sidebar-content">
								<div class="sidebar-header">
									<?php constructionn_site_branding(); ?>
									<button class="close-sidebar-btn" id="mobileSideMenuClose"><?php esc_html_e( 'x', 'constructionn' ); ?></button>
								</div>
								<div class="sidebar-body">
									<div class="search-wrapper">
										<?php get_search_form(); ?>
									</div>
									<div class="navigation-wrapper">
										<div class="primary-menu-wrapper">
											<?php constructionn_primary_nagivation(); ?>
										</div>
										<div class="secondary-menu-wrapper">
											<?php constructionn_secondary_nagivation(); ?>
										</div>
									</div>
								</div>
								<div class="sidebar-footer">
									<div class="sidebar-footer-btm">
										<?php constructionn_social_media_repeater( 'socials_media_repeater', 'header-five-social-media' ); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

