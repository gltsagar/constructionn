<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Constructionn_Pro
 */

if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
	return;
}

if ( constructionn_pro_sidebar_layout() === 'layout-two' ) {
	return;
}
?>
<aside id="secondary" class="widget-area sidebar-main" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">
	<?php dynamic_sidebar( 'primary-sidebar' ); ?>
</aside><!-- #secondary -->
