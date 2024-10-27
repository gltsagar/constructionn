<?php

if ( ! function_exists( 'constructionn_pro_customize_register_contactpg_partner' ) ) :
	/**
	 * Contactpage Partner Section
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_contactpg_partner( $wp_customize ) {
		$wp_customize->add_section(
			'contactpg_partner',
			array(
				'title'    => __( 'Partner Settings', 'constructionn-pro' ),
				'priority' => 30,
				'panel'    => 'contact_page_settings',
			)
		);

		/** Repeater for Front partner section */
		$wp_customize->add_setting(
			new Constructionn_Pro_Repeater_Setting(
				$wp_customize,
				'contactpg_partner_slider_custom',
				array(
					'default'           => array(),
					'sanitize_callback' => array( 'Constructionn_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Pro_Control_Repeater(
				$wp_customize,
				'contactpg_partner_slider_custom',
				array(
					'section'   => 'contactpg_partner',
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
add_action( 'customize_register', 'constructionn_pro_customize_register_contactpg_partner' );
