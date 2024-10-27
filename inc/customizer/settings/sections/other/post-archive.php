<?php

if ( ! function_exists( 'constructionn_pro_customize_register_post_archive' ) ) :
	/**
	 * Servive single post and archive
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_post_archive( $wp_customize ) {
		$wp_customize->add_section(
			'post_archive',
			array(
				'title'    => __( 'Blog, Search and Archive Settings', 'constructionn-pro' ),
				'panel'    => 'general_settings_panel',
				'priority' => 30,
			)
		);

		$wp_customize->add_setting(
			'mp_archive_prefix',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_pro_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'mp_archive_prefix',
				array(
					'label'       => __( 'Show/Hide Prefix', 'constructionn-pro' ),
					'description' => __( 'Enable to hide prefix in archive page.', 'constructionn-pro' ),
					'section'     => 'post_archive',
					'type'        => 'checkbox',
				)
			)
		);

		/** Archive Excerpt */
		$wp_customize->add_setting(
			'mp_excerpt',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_pro_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'mp_excerpt',
				array(
					'label'       => __( 'Show/Hide Blog Excerpt', 'constructionn-pro' ),
					'description' => __( 'Enable to show excerpt or disable to hide excerpt', 'constructionn-pro' ),
					'section'     => 'post_archive',
					'type'        => 'checkbox',
				)
			)
		);

		// add settings and control for Readmore button
		$wp_customize->add_setting(
			'mp_excerpt_length',
			array(
				'default'           => '15',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			'mp_excerpt_length',
			array(
				'label'           => __( 'Excerpt Length', 'constructionn-pro' ),
				'section'         => 'post_archive',
				'type'            => 'number',
				'active_callback' => 'constructionn_pro_excerpt_show_hide_active_callback',
			)
		);

		$wp_customize->add_setting(
			'archive_metaboxes',
			array(
				'default'           => 'comment,category',
				'transport'         => 'refresh',
				'sanitize_callback' => 'constructionn_pro_sortable_sanitization',
			)
		);
		$wp_customize->add_control(
			new GL_Sortable_Control(
				$wp_customize,
				'archive_metaboxes',
				array(
					'label'       => __( 'Sort Comment and Categories', 'constructionn-pro' ),
					'description' => __( 'This is used for sorting comment and categories. Drag and drop to arrange the order, and click to hide.', 'constructionn-pro' ),
					'section'     => 'post_archive',
					'input_attrs' => array(
						'sortable'  => true,
						'fullwidth' => true,
					),
					'choices'     => array(
						'comment'  => __( 'Comment', 'constructionn-pro' ),
						'category' => __( 'Category', 'constructionn-pro' ),
					),
				)
			)
		);

		// add settings and control for Readmore button
		$wp_customize->add_setting(
			'archive_readmore_button',
			array(
				'default'           => __( 'Read More', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'archive_readmore_button',
			array(
				'selector'        => '.archive-button',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'archive_readmore_button', __( 'Read More', 'constructionn-pro' ) ) );
				},
			)
		);
		$wp_customize->add_control(
			'archive_readmore_button',
			array(
				'label'   => __( 'Readmore Button', 'constructionn-pro' ),
				'section' => 'post_archive',
				'type'    => 'text',
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_post_archive' );

function constructionn_pro_excerpt_show_hide_active_callback( $control ) {

	$toggle_excerpt = $control->manager->get_setting( 'mp_excerpt' )->value();

	$id = $control->id;

	if ( $id == 'mp_excerpt_length' && $toggle_excerpt ) {
		return true;
	}

	return false;
}
