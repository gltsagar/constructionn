<?php

if ( ! function_exists( 'constructionn_pro_customize_register_footerlogos' ) ) :
	/**
	 * Foooter Logos Section
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_footerlogos( $wp_customize ) {
		$wp_customize->add_section(
			'footer_logos',
			array(
				'title'    => __( 'Logo Settings', 'constructionn-pro' ),
				'priority' => 30,
				'panel'    => 'footer_settings',
			)
		);

		$wp_customize->add_setting(
			'footer_custom_logo',
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		// Add Control for Banner three Image
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'footer_custom_logo',
				array(
					'description' => esc_html__( 'Upload Your Logo', 'constructionn-pro' ),
					'section'     => 'footer_logos',
				)
			)
		);

		/** Repeater for Front partner section */
		$wp_customize->add_setting(
			new Constructionn_Pro_Repeater_Setting(
				$wp_customize,
				'footer_logos_slider_custom',
				array(
					'default'           => array(),
					'sanitize_callback' => array( 'Constructionn_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Pro_Control_Repeater(
				$wp_customize,
				'footer_logos_slider_custom',
				array(
					'section'   => 'footer_logos',
					'label'     => __( 'Add Logos', 'constructionn-pro' ),
					'fields'    => array(
						'thumbnail' => array(
							'type'  => 'image',
							'label' => __( 'Add Image', 'constructionn-pro' ),
						),
						'url'       => array(
							'type'  => 'url',
							'label' => __( 'Add Url', 'constructionn-pro' ),
						),
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __( 'Logo', 'constructionn-pro' ),
						'field' => 'title',
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_footerlogos' );
