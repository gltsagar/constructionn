<?php
if ( ! function_exists( 'constructionn_customize_register_frontblog' ) ) :
	/**
	 * Frontblog
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_frontblog( $wp_customize ) {

		$wp_customize->add_section(
			'blog_section',
			array(
				'title'    => __( 'Blog Settings', 'constructionn' ),
				'priority' => 140,
				'panel'    => 'frontpage_settings_panel',
			)
		);

		// Add setting for Section Heading
		$wp_customize->add_setting(
			'front_blog_heading',
			array(
				'default'           => __( 'We provide solution to every queries!', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'front_blog_heading',
			array(
				'selector'        => '.blog-section h2.section-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'front_blog_heading', __( 'We provide solution to every queries!', 'constructionn' ) ) );
				},
			)
		);

		// Add Control for Section Heading
		$wp_customize->add_control(
			'front_blog_heading',
			array(
				'label'   => __( 'Heading', 'constructionn' ),
				'section' => 'blog_section',
				'type'    => 'text',
			)
		);

		// Add setting for Blog Button Next Text
		$wp_customize->add_setting(
			'front_blog_btn_next_txt',
			array(
				'default'           => esc_html__( 'Next', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		// Add control for Blog Button Next Text
		$wp_customize->add_control(
			'front_blog_btn_next_txt',
			array(
				'label'   => esc_html__( 'Button Next Text', 'constructionn' ),
				'section' => 'blog_section',
				'type'    => 'text',
			)
		);

		// Add setting for Blog Button Previous Text
		$wp_customize->add_setting(
			'front_blog_btn_prev_txt',
			array(
				'default'           => esc_html__( 'Prev', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		// Add control for Blog Button Previous Text
		$wp_customize->add_control(
			'front_blog_btn_prev_txt',
			array(
				'label'   => esc_html__( 'Button Previous Text', 'constructionn' ),
				'section' => 'blog_section',
				'type'    => 'text',
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_frontblog' );
