<?php
/**
 * Social Sharing Settings
 *
 * @package Constructionn
 */
if ( ! function_exists( 'constructionn_customize_register_social_sharing' ) ) :
	function constructionn_customize_register_social_sharing( $wp_customize ) {
		$wp_customize->add_section(
			'social_sharing_section',
			array(
				'title'    => __( 'Social Sharing Section', 'constructionn' ),
				'panel'    => 'general_settings_panel',
				'priority' => 60,
			)
		);

		$wp_customize->add_setting(
			'ed_social_sharing',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'ed_social_sharing',
				array(
					'section'     => 'social_sharing_section',
					'label'       => __( 'Enable Social Sharing Buttons', 'constructionn' ),
					'description' => __( 'Enable or disable social sharing buttons on archive and single posts.', 'constructionn' ),
					'type'        => 'checkbox',
				)
			)
		);

		/** Enable Social Sharing Buttons */
		$wp_customize->add_setting(
			'ed_og_tags',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'ed_og_tags',
				array(
					'section'         => 'social_sharing_section',
					'label'           => __( 'Enable Open Graph Meta Tags', 'constructionn' ),
					'description'     => __( 'Disable this option if you\'re using Jetpack, Yoast or other plugin to maintain Open Graph meta tags.', 'constructionn' ),
					'type'            => 'checkbox',
					'active_callback' => 'constructionn_social_sharing_active_callback',
				)
			)
		);

		/** Social Sharing Buttons */
		$wp_customize->add_setting(
			'social_share',
			array(
				'default'           => 'facebook,twitter,pinterest,linkedin',
				'sanitize_callback' => 'constructionn_sortable_sanitization',
			)
		);

		$wp_customize->add_control(
			new GL_Sortable_Control(
				$wp_customize,
				'social_share',
				array(
					'label'           => __( 'Social Sharing Buttons', 'constructionn' ),
					'section'         => 'social_sharing_section',
					'description'     => __( 'Sort or toggle social sharing buttons.', 'constructionn' ),
					'choices'         => array(
						'facebook'  => __( 'Facebook', 'constructionn' ),
						'twitter'   => __( 'Twitter', 'constructionn' ),
						'pinterest' => __( 'Pinterest', 'constructionn' ),
						'linkedin'  => __( 'Linkedin', 'constructionn' ),
						'email'     => __( 'Email', 'constructionn' ),
						'reddit'    => __( 'Reddit', 'constructionn' ),
						'tumblr'    => __( 'Tumblr', 'constructionn' ),
						'digg'      => __( 'Digg', 'constructionn' ),
						'weibo'     => __( 'Weibo', 'constructionn' ),
						'xing'      => __( 'Xing', 'constructionn' ),
						'vk'        => __( 'VK', 'constructionn' ),
						'pocket'    => __( 'GetPocket', 'constructionn' ),
						'whatsapp'  => __( 'Whatsapp', 'constructionn' ),
						'telegram'  => __( 'Telegram', 'constructionn' ),
					),
					'active_callback' => 'constructionn_social_sharing_active_callback',
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_social_sharing' );

function constructionn_social_sharing_active_callback( $control ) {

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
