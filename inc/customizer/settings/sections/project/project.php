<?php

if ( ! function_exists( 'constructionn_customize_register_projectpg_project' ) ) :
	/**
	 * Projectpage Project
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_projectpg_project( $wp_customize ) {

		$wp_customize->add_section(
			'projectpg_project_section',
			array(
				'title'    => __( 'Project Settings', 'constructionn' ),
				'priority' => 10,
				'panel'    => 'project_page_settings',
			)
		);

		// Add setting for Project Section Heading
		$wp_customize->add_setting(
			'projpg_project_headings',
			array(
				'default'           => __( 'Our latest projects', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'projpg_project_headings',
			array(
				'selector'        => '.projects-section.bg-gray.projpg h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'projpg_project_headings', __( 'Our latest projects', 'constructionn' ) ) );
				},
			)
		);

		// Add setting for Project Section Heading
		$wp_customize->add_control(
			'projpg_project_headings',
			array(
				'label'   => __( 'Heading', 'constructionn' ),
				'section' => 'projectpg_project_section',
				'type'    => 'text',
			)
		);

		// Add setting for description
		$wp_customize->add_setting(
			'projpg_project_descs',
			array(
				'default'           => __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'constructionn' ),
				'sanitize_callback' => 'sanitize_textarea_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'projpg_project_descs',
			array(
				'selector'        => '.projects-section.bg-gray.projpg p',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'projpg_project_descs', __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'constructionn' ) ) );
				},
			)
		);

		// Add Control for description
		$wp_customize->add_control(
			'projpg_project_descs',
			array(
				'label'   => __( 'Description', 'constructionn' ),
				'section' => 'projectpg_project_section',
				'type'    => 'textarea',
			)
		);

		// Add setting for Project Button Text
		$wp_customize->add_setting(
			'projpg_project_btn_txt',
			array(
				'default'           => esc_html__( 'View All Projects', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'projpg_project_btn_txt',
			array(
				'selector'        => '.projects-section.bg-gray.projpg a.btn.has-icon.btn__primary-outline',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'projpg_project_btn_txt', __( 'View All Projects', 'constructionn' ) ) );
				},
			)
		);

		// Add control for Project Button Text
		$wp_customize->add_control(
			'projpg_project_btn_txt',
			array(
				'label'   => esc_html__( 'Button Text', 'constructionn' ),
				'section' => 'projectpg_project_section',
				'type'    => 'text',
			)
		);

		// Add setting for Project Button link
		$wp_customize->add_setting(
			'projpg_project_btn_link',
			array(
				'default'           => '#',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		// Add control for Project Button link
		$wp_customize->add_control(
			'projpg_project_btn_link',
			array(
				'label'   => esc_html__( 'Button Link', 'constructionn' ),
				'section' => 'projectpg_project_section',
				'type'    => 'url',
			)
		);

		// Add setting for Project Button Next Text
		$wp_customize->add_setting(
			'projpg_proj_btn_next_txt',
			array(
				'default'           => esc_html__( 'Next', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		// Add control for Project Button Next Text
		$wp_customize->add_control(
			'projpg_proj_btn_next_txt',
			array(
				'label'   => esc_html__( 'Button Next Text', 'constructionn' ),
				'section' => 'projectpg_project_section',
				'type'    => 'text',
			)
		);

		// Add setting for Project Button Previous Text
		$wp_customize->add_setting(
			'projpg_proj_btn_prev_txt',
			array(
				'default'           => esc_html__( 'Prev', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		// Add control for Project Button Previous Text
		$wp_customize->add_control(
			'projpg_proj_btn_prev_txt',
			array(
				'label'   => esc_html__( 'Button Previous Text', 'constructionn' ),
				'section' => 'projectpg_project_section',
				'type'    => 'text',
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_projectpg_project' );
