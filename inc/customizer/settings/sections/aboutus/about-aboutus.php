<?php

if ( ! function_exists( 'constructionn_pro_customize_register_abtpg_aboutus' ) ) :
	/**
	 * Aboutpage aboutus
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_abtpg_aboutus( $wp_customize ) {
		$wp_customize->add_section(
			'abtpg_abt_section',
			array(
				'title'    => esc_html__( 'About Settings', 'constructionn-pro' ),
				'priority' => 10,
				'panel'    => 'about_page_settings',
			)
		);

		// Add setting for about us Image One
		$wp_customize->add_setting(
			'abtpg_abt_img_one',
			array(
				'default'           => esc_url( get_template_directory_uri() . '/assets/images/law-sm-1.jpg' ),
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		// Add Control for about us Image One
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'abtpg_abt_img_one',
				array(
					'description' => esc_html__( 'Upload Image One', 'constructionn-pro' ),
					'section'     => 'abtpg_abt_section',
				)
			)
		);

		// Add setting for about us Image Two
		$wp_customize->add_setting(
			'abtpg_abt_img_two',
			array(
				'default'           => esc_url( get_template_directory_uri() . '/assets/images/law-sm-1.jpg' ),
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		// Add Control for about us Image Two
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'abtpg_abt_img_two',
				array(
					'description' => esc_html__( 'Upload Image Two', 'constructionn-pro' ),
					'section'     => 'abtpg_abt_section',
				)
			)
		);

		// Add setting for Section subheading
		$wp_customize->add_setting(
			'abtpg_subheading',
			array(
				'default'           => esc_html__( 'Who we are', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'abtpg_subheading',
			array(
				'selector'        => '.aboutpg-about .about-right h4.title',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'abtpg_subheading', __( 'Who we are', 'constructionn-pro' ) ) );
				},
			)
		);

		// Add Control for Section subheading
		$wp_customize->add_control(
			'abtpg_subheading',
			array(
				'label'   => esc_html__( 'Sub Heading', 'constructionn-pro' ),
				'section' => 'abtpg_abt_section',
				'type'    => 'text',
			)
		);

		// Add setting for Section Heading
		$wp_customize->add_setting(
			'abtpg_headings',
			array(
				'default'           => __( 'Start your journey with professionals', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'abtpg_headings',
			array(
				'selector'        => '.aboutpg-about h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'abtpg_headings', __( 'Start your journey with professionals', 'constructionn-pro' ) ) );
				},
			)
		);

		// Add Control for Section Heading
		$wp_customize->add_control(
			'abtpg_headings',
			array(
				'label'   => esc_html__( 'Heading', 'constructionn-pro' ),
				'section' => 'abtpg_abt_section',
				'type'    => 'text',
			)
		);

		// Add setting for Section Description
		$wp_customize->add_setting(
			'abtpg_descriptions',
			array(
				'default'           => esc_html__( 'We are a long-established, independent building services and home improvements company. We have a wealth of experience working as main building contractors on all kinds of projects, big and small, from home maintenance.', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_textarea_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'abtpg_descriptions',
			array(
				'selector'        => '.aboutpg-about .right-top p',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'abtpg_descriptions', __( 'We are a long-established, independent building services and home improvements company. We have a wealth of experience working as main building contractors on all kinds of projects, big and small, from home maintenance.', 'constructionn-pro' ) ) );
				},
			)
		);

		// Add Control for Section Description
		$wp_customize->add_control(
			'abtpg_descriptions',
			array(
				'label'   => esc_html__( 'Description', 'constructionn-pro' ),
				'section' => 'abtpg_abt_section',
				'type'    => 'textarea',
			)
		);

		// Add setting for Section Heading
		$wp_customize->add_setting(
			'abtpg_notice_headings',
			array(
				'default'           => __( 'Get close to more than 150 expert professionals', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'abtpg_notice_headings',
			array(
				'selector'        => '.aboutpg-about .about-left h5.title',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'abtpg_notice_headings', __( 'Get close to more than 150 expert professionals', 'constructionn-pro' ) ) );
				},
			)
		);

		// Add Control for Section Heading
		$wp_customize->add_control(
			'abtpg_notice_headings',
			array(
				'label'   => esc_html__( 'Notice Heading', 'constructionn-pro' ),
				'section' => 'abtpg_abt_section',
				'type'    => 'text',
			)
		);

		// Add setting for Section Description
		$wp_customize->add_setting(
			'abtpg_notice_descs',
			array(
				'default'           => esc_html__( 'Receive the greatest results from us.', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_textarea_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'abtpg_notice_descs',
			array(
				'selector'        => '.aboutpg-about .about-left p',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'abtpg_notice_descs', __( 'Receive the greatest results from us.', 'constructionn-pro' ) ) );
				},
			)
		);

		// Add Control for Section Description
		$wp_customize->add_control(
			'abtpg_notice_descs',
			array(
				'label'   => esc_html__( 'Notice Description', 'constructionn-pro' ),
				'section' => 'abtpg_abt_section',
				'type'    => 'textarea',
			)
		);

		// Add setting for about Button Text
		$wp_customize->add_setting(
			'abtpg_btn_txt',
			array(
				'default'           => esc_html__( 'Know More', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'abtpg_btn_txt',
			array(
				'selector'        => '.aboutpg-about .about-right a.btn.has-icon.btn__primary',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'abtpg_btn_txt', __( 'Know More', 'constructionn-pro' ) ) );
				},
			)
		);

		// Add control for about Button Text
		$wp_customize->add_control(
			'abtpg_btn_txt',
			array(
				'label'   => esc_html__( 'Button Text', 'constructionn-pro' ),
				'section' => 'abtpg_abt_section',
				'type'    => 'text',
			)
		);

		// Add setting for about Button link
		$wp_customize->add_setting(
			'abtpg_btn_link',
			array(
				'default'           => '#',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		// Add control for about Button link
		$wp_customize->add_control(
			'abtpg_btn_link',
			array(
				'label'   => esc_html__( 'Button Link', 'constructionn-pro' ),
				'section' => 'abtpg_abt_section',
				'type'    => 'url',
			)
		);

		/** Dynamic Services whyus Section */
		$wp_customize->add_setting(
			new Constructionn_Pro_Repeater_Setting(
				$wp_customize,
				'abtpg_abt_repeaters',
				array(
					'default'           => array(
						array(
							'text'        => esc_html__( 'Best in business', 'constructionn-pro' ),
							'description' => esc_html__( 'We have been providing you the top services and also been convenient supplier.', 'constructionn-pro' ),
						),

						array(
							'text'        => esc_html__( '24/7 Support', 'constructionn-pro' ),
							'description' => esc_html__( 'We have been providing you the top services and also been convenient supplier.', 'constructionn-pro' ),
						),
					),
					'sanitize_callback' => array( 'Constructionn_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Pro_Control_Repeater(
				$wp_customize,
				'abtpg_abt_repeaters',
				array(
					'section'   => 'abtpg_abt_section',
					'label'     => __( 'Add Features', 'constructionn-pro' ),
					'fields'    => array(
						'text'        => array(
							'type'  => 'text',
							'label' => __( 'Add Title', 'constructionn-pro' ),
						),
						'description' => array(
							'type'  => 'textarea',
							'label' => __( 'Add Description', 'constructionn-pro' ),
						),
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __( 'Features', 'constructionn-pro' ),
						'field' => 'title',
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_abtpg_aboutus' );
