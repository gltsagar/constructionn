<?php
/**
 * Social Sharing Settings
 *
 * @package Constructionn_Pro
 */
if ( ! function_exists( 'constructionn_pro_customize_register_social_sharing' ) ) :
	function constructionn_pro_customize_register_social_sharing( $wp_customize ) {
		$wp_customize->add_section(
			'social_sharing_section',
			array(
				'title'    => __( 'Social Sharing Section', 'constructionn-pro' ),
				'panel'    => 'general_settings_panel',
				'priority' => 60,
			)
		);

		$wp_customize->add_setting(
			'ed_social_sharing',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_pro_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'ed_social_sharing',
				array(
					'section'     => 'social_sharing_section',
					'label'       => __( 'Enable Social Sharing Buttons', 'constructionn-pro' ),
					'description' => __( 'Enable or disable social sharing buttons on archive and single posts.', 'constructionn-pro' ),
					'type'        => 'checkbox',
				)
			)
		);

		/** Enable Social Sharing Buttons */
		$wp_customize->add_setting(
			'ed_og_tags',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_pro_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'ed_og_tags',
				array(
					'section'         => 'social_sharing_section',
					'label'           => __( 'Enable Open Graph Meta Tags', 'constructionn-pro' ),
					'description'     => __( 'Disable this option if you\'re using Jetpack, Yoast or other plugin to maintain Open Graph meta tags.', 'constructionn-pro' ),
					'type'            => 'checkbox',
					'active_callback' => 'constructionn_pro_social_sharing_active_callback',
				)
			)
		);

		/** Social Sharing Buttons */
		$wp_customize->add_setting(
			'social_share',
			array(
				'default'           => 'facebook,twitter,pinterest,linkedin',
				'sanitize_callback' => 'constructionn_pro_sortable_sanitization',
			)
		);

		$wp_customize->add_control(
			new GL_Sortable_Control(
				$wp_customize,
				'social_share',
				array(
					'label'           => __( 'Social Sharing Buttons', 'constructionn-pro' ),
					'section'         => 'social_sharing_section',
					'description'     => __( 'Sort or toggle social sharing buttons.', 'constructionn-pro' ),
					'choices'         => array(
						'facebook'  => __( 'Facebook', 'constructionn-pro' ),
						'twitter'   => __( 'Twitter', 'constructionn-pro' ),
						'pinterest' => __( 'Pinterest', 'constructionn-pro' ),
						'linkedin'  => __( 'Linkedin', 'constructionn-pro' ),
						'email'     => __( 'Email', 'constructionn-pro' ),
						'reddit'    => __( 'Reddit', 'constructionn-pro' ),
						'tumblr'    => __( 'Tumblr', 'constructionn-pro' ),
						'digg'      => __( 'Digg', 'constructionn-pro' ),
						'weibo'     => __( 'Weibo', 'constructionn-pro' ),
						'xing'      => __( 'Xing', 'constructionn-pro' ),
						'vk'        => __( 'VK', 'constructionn-pro' ),
						'pocket'    => __( 'GetPocket', 'constructionn-pro' ),
						'whatsapp'  => __( 'Whatsapp', 'constructionn-pro' ),
						'telegram'  => __( 'Telegram', 'constructionn-pro' ),
					),
					'active_callback' => 'constructionn_pro_social_sharing_active_callback',
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_social_sharing' );

function constructionn_pro_social_sharing_active_callback( $control ) {

	$toggle_social_sharing = $control->manager->get_setting( 'ed_social_sharing' )->value();

	$id = $control->id;

	if ( $id == 'ed_og_tags' && $toggle_social_sharing ) {
		return true;
	}
	if ( $id == 'social_share' && $toggle_social_sharing ) {
		return true;
	}

	return false;
}
