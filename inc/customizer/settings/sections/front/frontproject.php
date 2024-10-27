<?php

if ( ! function_exists( 'constructionn_pro_customize_register_frontproject' ) ) :
	/**
	 * FrontProject
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_frontproject( $wp_customize ) {

		$wp_customize->add_section(
			'project_section',
			array(
				'title'    => __( 'Project Settings', 'constructionn-pro' ),
				'priority' => 30,
				'panel'    => 'frontpage_settings_panel',
			)
		);

		// Add setting for Project Section Heading
		$wp_customize->add_setting(
			'project_headings',
			array(
				'default'           => __( 'Our latest projects', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'project_headings',
			array(
				'selector'        => '.front-project h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'project_headings', __( 'Our latest projects', 'constructionn-pro' ) ) );
				},
			)
		);

		// Add setting for Project Section Heading
		$wp_customize->add_control(
			'project_headings',
			array(
				'label'   => __( 'Heading', 'constructionn-pro' ),
				'section' => 'project_section',
				'type'    => 'text',
			)
		);

		// Add setting for description
		$wp_customize->add_setting(
			'project_descs',
			array(
				'default'           => __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_textarea_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'project_descs',
			array(
				'selector'        => '.front-project p',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'project_descs', __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'constructionn-pro' ) ) );
				},
			)
		);

		// Add Control for description
		$wp_customize->add_control(
			'project_descs',
			array(
				'label'   => __( 'Description', 'constructionn-pro' ),
				'section' => 'project_section',
				'type'    => 'textarea',
			)
		);

		// Add setting for Project Button Text
		$wp_customize->add_setting(
			'project_btn_txt',
			array(
				'default'           => esc_html__( 'View All Projects', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'project_btn_txt',
			array(
				'selector'        => '.front-project a.btn.has-icon.btn__primary-outline',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'project_btn_txt', __( 'View All Projects', 'constructionn-pro' ) ) );
				},
			)
		);

		// Add control for Project Button Text
		$wp_customize->add_control(
			'project_btn_txt',
			array(
				'label'   => esc_html__( 'Button Text', 'constructionn-pro' ),
				'section' => 'project_section',
				'type'    => 'text',
			)
		);

		// Add setting for Project Button link
		$wp_customize->add_setting(
			'project_btn_link',
			array(
				'default'           => '#',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		// Add control for Project Button link
		$wp_customize->add_control(
			'project_btn_link',
			array(
				'label'   => esc_html__( 'Button Link', 'constructionn-pro' ),
				'section' => 'project_section',
				'type'    => 'url',
			)
		);

		// Add setting for Project Button Next Text
		$wp_customize->add_setting(
			'project_btn_next_txt',
			array(
				'default'           => esc_html__( 'Next', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		// Add control for Project Button Next Text
		$wp_customize->add_control(
			'project_btn_next_txt',
			array(
				'label'   => esc_html__( 'Button Next Text', 'constructionn-pro' ),
				'section' => 'project_section',
				'type'    => 'text',
			)
		);

		// Add setting for Project Button Previous Text
		$wp_customize->add_setting(
			'project_btn_prev_txt',
			array(
				'default'           => esc_html__( 'Prev', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		// Add control for Project Button Previous Text
		$wp_customize->add_control(
			'project_btn_prev_txt',
			array(
				'label'   => esc_html__( 'Button Previous Text', 'constructionn-pro' ),
				'section' => 'project_section',
				'type'    => 'text',
			)
		);

		/** Dynamic Project Section */
		$wp_customize->add_setting(
			new Constructionn_Pro_Repeater_Setting(
				$wp_customize,
				'front_project_repeater',
				array(
					'default'           => '',
					'sanitize_callback' => array( 'Constructionn_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Pro_Control_Repeater(
				$wp_customize,
				'front_project_repeater',
				array(
					'section'   => 'project_section',
					'label'     => __( 'Add Project', 'constructionn-pro' ),
					'fields'    => array(
						'project' => array(
							'type'    => 'select',
							'label'   => __( 'Select Project', 'constructionn-pro' ),
							'choices' => constructionn_pro_get_posts( 'project' ),
						),
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __( 'Projects', 'constructionn-pro' ),
						'field' => 'title',
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_frontproject' );
