<?php

if ( ! function_exists( 'constructionn_pro_customize_register_frontpartner' ) ) :
	/**
	 * Front Partner Section
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_frontpartner( $wp_customize ) {
		$wp_customize->add_section(
			'front_partner',
			array(
				'title'    => __( 'Partner Settings', 'constructionn-pro' ),
				'priority' => 150,
				'panel'    => 'frontpage_settings_panel',
			)
		);

		/** Repeater for Front partner section */
		$wp_customize->add_setting(
			new Constructionn_Pro_Repeater_Setting(
				$wp_customize,
				'front_partner_slider_custom',
				array(
					'default'           => array(),
					'sanitize_callback' => array( 'Constructionn_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Pro_Control_Repeater(
				$wp_customize,
				'front_partner_slider_custom',
				array(
					'section'   => 'front_partner',
					'label'     => __( 'Add Partners', 'constructionn-pro' ),
					'fields'    => array(
						'thumbnail' => array(
							'type'  => 'image',
							'label' => __( 'Add Image', 'constructionn-pro' ),
						),
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __( 'Partner', 'constructionn-pro' ),
						'field' => 'title',
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_frontpartner' );
