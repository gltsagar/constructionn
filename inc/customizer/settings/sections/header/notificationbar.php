<?php

if ( ! function_exists( 'constructionn_pro_customize_register_notificationbar' ) ) :
	/**
	 * Notifications Bar
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_notificationbar( $wp_customize ) {

		// Create notification bar section
		$wp_customize->add_section(
			'notification_bar',
			array(
				'title'    => __( 'Notification Bar', 'constructionn-pro' ),
				'panel'    => 'general_settings_panel',
				'priority' => 10,
			)
		);

		// Add the toggle control to the section
		$wp_customize->add_setting(
			'notification_bar_toggle',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_pro_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'notification_bar_toggle',
				array(
					'label'       => __( 'Show/Hide Notification Bar', 'constructionn-pro' ),
					'description' => __( 'Enable to show Notificaiton Bar', 'constructionn-pro' ),
					'section'     => 'notification_bar',
					'type'        => 'checkbox',
				)
			)
		);

		$wp_customize->add_setting(
			'notification_heading',
			array(
				'default'           => __( 'Ready for the perfect home. Summertime discounts sales are here.', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'notification_heading',
			array(
				'selector'        => '.notification-bar .notify-text',
				'render_callback' => 'constructionn_pro_notification_heading_pr',
			)
		);

		$wp_customize->add_control(
			'notification_heading',
			array(
				'label'           => __( 'Heading', 'constructionn-pro' ),
				'section'         => 'notification_bar',
				'type'            => 'text',
				'active_callback' => 'constructionn_pro_notificationbar_active_callback',
			)
		);

		// adding setting for notification link text
		$wp_customize->add_setting(
			'notification_link_text',
			array(
				'default'           => __( 'Register Now', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'notification_link_text',
			array(
				'selector'        => '.notification-bar .notify-link',
				'render_callback' => 'constructionn_pro_notification_heading_pr',
			)
		);

		// add control for notification link text
		$wp_customize->add_control(
			'notification_link_text',
			array(
				'label'           => __( 'Button text', 'constructionn-pro' ),
				'section'         => 'notification_bar',
				'type'            => 'text',
				'active_callback' => 'constructionn_pro_notificationbar_active_callback',
			)
		);

		// adding setting for notification link
		$wp_customize->add_setting(
			'notification_link',
			array(
				'default'           => '#',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		// add control for notification link
		$wp_customize->add_control(
			'notification_link',
			array(
				'label'           => __( 'Button Link', 'constructionn-pro' ),
				'section'         => 'notification_bar',
				'type'            => 'url',
				'active_callback' => 'constructionn_pro_notificationbar_active_callback',
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_notificationbar' );

function constructionn_pro_notification_heading_pr() {
	return esc_html( get_theme_mod( 'notification_heading', __( 'Ready for the perfect home. Summertime discounts sales are here.', 'constructionn-pro' ) ) );
}

function constructionn_pro_notificationbar_active_callback( $control ) {
	$notification_bar_toggle = $control->manager->get_setting( 'notification_bar_toggle' )->value();

	$id = $control->id;

	if ( $notification_bar_toggle && $id == 'notification_heading' ) {
		return true;
	}
	if ( $notification_bar_toggle && $id == 'notification_link_text' ) {
		return true;
	}
	if ( $notification_bar_toggle && $id == 'notification_link' ) {
		return true;
	}

	return false;
}
