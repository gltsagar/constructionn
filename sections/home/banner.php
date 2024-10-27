<?php
/**
 * Front Banner Section
 *
 * @package constructionn-pro
 */
$banner_array = array( 'one', 'two', 'three', 'four', 'five' );
$banner       = get_theme_mod( 'banner_layouts', 'three' );
if ( in_array( $banner, $banner_array ) ) {
	get_template_part( 'banners/' . $banner );
}
