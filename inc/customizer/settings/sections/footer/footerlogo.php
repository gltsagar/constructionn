<?php

if ( ! function_exists( 'constructionn_customize_register_footerlogos' ) ) :
	/**
	 * Foooter Logos Section
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_footerlogos( $wp_customize ) {
		$wp_customize->add_section(
			'footer_logos',
			array(
				'title'    => __( 'Logo Settings', 'constructionn' ),
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
					'description' => esc_html__( 'Upload Your Logo', 'constructionn' ),
					'section'     => 'footer_logos',
				)
			)
		);

		/** Repeater for Front partner section */
		$wp_customize->add_setting(
			new Constructionn_Repeater_Setting(
				$wp_customize,
				'footer_logos_slider_custom',
				array(
					'default'           => array(),
					'sanitize_callback' => array( 'Constructionn_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Control_Repeater(
				$wp_customize,
				'footer_logos_slider_custom',
				array(
					'section'   => 'footer_logos',
					'label'     => __( 'Add Logos', 'constructionn' ),
					'fields'    => array(
						'thumbnail' => array(
							'type'  => 'image',
							'label' => __( 'Add Image', 'constructionn' ),
						),
						'url'       => array(
							'type'  => 'url',
							'label' => __( 'Add Url', 'constructionn' ),
						),
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __( 'Logo', 'constructionn' ),
						'field' => 'title',
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_footerlogos' );
