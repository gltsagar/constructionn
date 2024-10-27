<?php

if ( ! function_exists( 'constructionn_customize_register_abtpg_project' ) ) :
	/**
	 * Aboutpage Project
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_abtpg_project( $wp_customize ) {

		$wp_customize->add_section(
			'abtpg_project_section',
			array(
				'title'    => __( 'Project Settings', 'constructionn' ),
				'priority' => 50,
				'panel'    => 'about_page_settings',
			)
		);

		// Add setting for Project Section Heading
		$wp_customize->add_setting(
			'abtpg_project_headings',
			array(
				'default'           => __( 'Our latest projects', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'abtpg_project_headings',
			array(
				'selector'        => '.aboutpg-project h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'abtpg_project_headings', __( 'Our latest projects', 'constructionn' ) ) );
				},
			)
		);

		// Add setting for Project Section Heading
		$wp_customize->add_control(
			'abtpg_project_headings',
			array(
				'label'   => __( 'Heading', 'constructionn' ),
				'section' => 'abtpg_project_section',
				'type'    => 'text',
			)
		);

		// Add setting for description
		$wp_customize->add_setting(
			'abtpg_project_descs',
			array(
				'default'           => __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'constructionn' ),
				'sanitize_callback' => 'sanitize_textarea_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'abtpg_project_descs',
			array(
				'selector'        => '.aboutpg-project p',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'abtpg_project_descs', __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'constructionn' ) ) );
				},
			)
		);

		// Add Control for description
		$wp_customize->add_control(
			'abtpg_project_descs',
			array(
				'label'   => __( 'Description', 'constructionn' ),
				'section' => 'abtpg_project_section',
				'type'    => 'textarea',
			)
		);

		// Add setting for Project Button Text
		$wp_customize->add_setting(
			'abtpg_proj_btn_txt',
			array(
				'default'           => esc_html__( 'View All Projects', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'abtpg_proj_btn_txt',
			array(
				'selector'        => '.aboutpg-project a.btn.has-icon.btn__primary-outline',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'abtpg_proj_btn_txt', __( 'View All Projects', 'constructionn' ) ) );
				},
			)
		);

		// Add control for Project Button Text
		$wp_customize->add_control(
			'abtpg_proj_btn_txt',
			array(
				'label'   => esc_html__( 'Button Text', 'constructionn' ),
				'section' => 'abtpg_project_section',
				'type'    => 'text',
			)
		);

		// Add setting for Project Button link
		$wp_customize->add_setting(
			'abtpg_proj_btn_link',
			array(
				'default'           => '#',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		// Add control for Project Button link
		$wp_customize->add_control(
			'abtpg_proj_btn_link',
			array(
				'label'   => esc_html__( 'Button Link', 'constructionn' ),
				'section' => 'abtpg_project_section',
				'type'    => 'url',
			)
		);

		// Add setting for Project Button Next Text
		$wp_customize->add_setting(
			'abtpg_proj_btn_next_txt',
			array(
				'default'           => esc_html__( 'Next', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		// Add control for Project Button Next Text
		$wp_customize->add_control(
			'abtpg_proj_btn_next_txt',
			array(
				'label'   => esc_html__( 'Button Next Text', 'constructionn' ),
				'section' => 'abtpg_project_section',
				'type'    => 'text',
			)
		);

		// Add setting for Project Button Previous Text
		$wp_customize->add_setting(
			'abtpg_proj_btn_prev_txt',
			array(
				'default'           => esc_html__( 'Prev', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		// Add control for Project Button Previous Text
		$wp_customize->add_control(
			'abtpg_proj_btn_prev_txt',
			array(
				'label'   => esc_html__( 'Button Previous Text', 'constructionn' ),
				'section' => 'abtpg_project_section',
				'type'    => 'text',
			)
		);

		/** Dynamic Project Section */
		$wp_customize->add_setting(
			new Constructionn_Repeater_Setting(
				$wp_customize,
				'abtpg_project_repeater',
				array(
					'default'           => '',
					'sanitize_callback' => array( 'Constructionn_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Control_Repeater(
				$wp_customize,
				'abtpg_project_repeater',
				array(
					'section'   => 'abtpg_project_section',
					'label'     => __( 'Add Project', 'constructionn' ),
					'fields'    => array(
						'project' => array(
							'type'    => 'select',
							'label'   => __( 'Select Project', 'constructionn' ),
							'choices' => constructionn_get_posts( 'project' ),
						),
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __( 'Projects', 'constructionn' ),
						'field' => 'title',
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_abtpg_project' );
