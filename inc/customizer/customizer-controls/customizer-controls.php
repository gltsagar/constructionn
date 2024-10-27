<?php
function constructionn_pro_customizer_controls_registration( $wp_customize ) {
	require_once get_template_directory() . '/inc/customizer/customizer-controls/note/note-control.php';
	require_once get_template_directory() . '/inc/customizer/customizer-controls/toggle/toggle-control.php';
	require_once get_template_directory() . '/inc/customizer/customizer-controls/radio/radio-control.php';
	require_once get_template_directory() . '/inc/customizer/customizer-controls/notice/notice-control.php';
	require_once get_template_directory() . '/inc/customizer/customizer-controls/repeater/settings.php';
	require_once get_template_directory() . '/inc/customizer/customizer-controls/repeater/repeater.php';
	require_once get_template_directory() . '/inc/customizer/customizer-controls/slider/slider-control.php';
	require_once get_template_directory() . '/inc/customizer/customizer-controls/sortable/sortable-control.php';

	require_once get_template_directory() . '/inc/customizer/customizer-controls/tabs/class-customizer-tabs-control.php';
	require_once get_template_directory() . '/inc/customizer/customizer-controls/typography/class-typography-control.php';

	$wp_customize->register_control_type( 'GL_Typography_Control' );
	$wp_customize->register_control_type( 'GL_Slider_Control' );
	$wp_customize->register_control_type( 'GL_Toggle_Control' );
}
add_action( 'customize_register', 'constructionn_pro_customizer_controls_registration' );
