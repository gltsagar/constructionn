<?php

if ( ! function_exists( 'constructionn_customize_register_postpage' ) ) :
	/**
	 * Posts(Blog) & Pages Settings
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_postpage( $wp_customize ) {

		/** Posts(Blog) & Pages Settings */
		$wp_customize->add_section(
			'post_page_settings',
			array(
				'title'    => __( 'Post & Pages Settings', 'constructionn' ),
				'priority' => 40,
				'panel'    => 'general_settings_panel',
			)
		);

		$wp_customize->add_setting(
			'post_single_metaboxes',
			array(
				'default'           => 'category,comment',
				'transport'         => 'refresh',
				'sanitize_callback' => 'constructionn_sortable_sanitization',
			)
		);
		$wp_customize->add_control(
			new GL_Sortable_Control(
				$wp_customize,
				'post_single_metaboxes',
				array(
					'label'       => __( 'Sort Comment and Categories', 'constructionn' ),
					'description' => __( 'This is used for sorting comment and categories. Drag and drop to arrange the order, and click to hide.', 'constructionn' ),
					'section'     => 'post_page_settings',
					'input_attrs' => array(
						'sortable'  => true,
						'fullwidth' => true,
					),
					'choices'     => array(
						'comment'  => __( 'Comment', 'constructionn' ),
						'category' => __( 'Category', 'constructionn' ),
					),
				)
			)
		);

		/** Single Page Posted Date */
		$wp_customize->add_setting(
			'ed_single_posted_date',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'ed_single_posted_date',
				array(
					'label'       => __( 'Show/Hide Posted Date', 'constructionn' ),
					'description' => __( 'Enable to show posted date or disable to hide posted date', 'constructionn' ),
					'section'     => 'post_page_settings',
					'type'        => 'checkbox',
				)
			)
		);

		$wp_customize->add_setting(
			'ed_single_posted_author',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'ed_single_posted_author',
				array(
					'label'       => __( 'Show/Hide Author Name', 'constructionn' ),
					'description' => __( 'Enable to show author name or disable to hide author name', 'constructionn' ),
					'section'     => 'post_page_settings',
					'type'        => 'checkbox',
				)
			)
		);
		$wp_customize->add_setting(
			'post_footer_meta',
			array(
				'default'           => 'tag,social-share',
				'transport'         => 'refresh',
				'sanitize_callback' => 'constructionn_sortable_sanitization',
			)
		);
		$wp_customize->add_control(
			new GL_Sortable_Control(
				$wp_customize,
				'post_footer_meta',
				array(
					'label'       => __( 'Sort Tag and Social Sharing option', 'constructionn' ),
					'description' => __( 'This is used for sorting tag and social sharing option. Drag and drop to arrange the order, and click to hide.', 'constructionn' ),
					'section'     => 'post_page_settings',
					'input_attrs' => array(
						'sortable'  => true,
						'fullwidth' => true,
					),
					'choices'     => array(
						'tag'          => __( 'Tag', 'constructionn' ),
						'social-share' => __( 'Social Share', 'constructionn' ),
					),
				)
			)
		);
		// Add the toggle control to the section
		$wp_customize->add_setting(
			'mp_author',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'mp_author',
				array(
					'label'       => __( 'Show/Hide Author Section', 'constructionn' ),
					'description' => __( 'Enable to show author section in the post.', 'constructionn' ),
					'section'     => 'post_page_settings',
					'type'        => 'checkbox',
				)
			)
		);

		/** Line break for post and page settings */
		$wp_customize->add_setting(
			'single_note',
			array(
				'default'           => '',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			new Note_Control(
				$wp_customize,
				'single_note',
				array(
					'section' => 'post_page_settings',
				)
			)
		);

		/** Show/hide Related post in single */
		$wp_customize->add_setting(
			'toggle_related_post',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'toggle_related_post',
				array(
					'label'       => __( 'Show/Hide Related Post', 'constructionn' ),
					'description' => __( 'Enable to show related post in single page.', 'constructionn' ),
					'section'     => 'post_page_settings',
					'type'        => 'checkbox',
				)
			)
		);

		// add settings and control for Related Post subheading settings
		$wp_customize->add_setting(
			'related_post_heading',
			array(
				'default'           => __( 'Related Posts', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'related_post_heading',
			array(
				'selector'        => '.post-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'related_post_heading', __( 'Related Posts', 'constructionn' ) ) );
				},
			)
		);
		$wp_customize->add_control(
			'related_post_heading',
			array(
				'label'           => __( 'Heading', 'constructionn' ),
				'section'         => 'post_page_settings',
				'type'            => 'text',
				'active_callback' => 'constructionn_ed_related_post_active_callback',
			)
		);

		// add settings and control for Readmore button
		$wp_customize->add_setting(
			'post_readmore_button',
			array(
				'default'           => __( 'Read More', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'post_readmore_button',
			array(
				'selector'        => '.post-button',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'post_readmore_button', __( 'Read More', 'constructionn' ) ) );
				},
			)
		);
		$wp_customize->add_control(
			'post_readmore_button',
			array(
				'label'           => __( 'Button Label', 'constructionn' ),
				'section'         => 'post_page_settings',
				'type'            => 'text',
				'active_callback' => 'constructionn_ed_related_post_active_callback',
			)
		);

		/** Show/hide Expert of the related Post */
		$wp_customize->add_setting(
			'toggle_related_post_excerpt',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'toggle_related_post_excerpt',
				array(
					'label'           => __( 'Show/Hide Excerpt', 'constructionn' ),
					'description'     => __( 'Enable to show excerpts in related post.', 'constructionn' ),
					'section'         => 'post_page_settings',
					'type'            => 'checkbox',
					'active_callback' => 'constructionn_ed_related_post_active_callback',
				)
			)
		);
		$wp_customize->add_setting(
			'post_excerpt_length',
			array(
				'default'           => '15',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			'post_excerpt_length',
			array(
				'label'           => __( 'Excerpt Length', 'constructionn' ),
				'section'         => 'post_page_settings',
				'type'            => 'number',
				'active_callback' => 'constructionn_ed_related_post_active_callback',
			)
		);

		// histroy single

		/** Line break for post and page settings */
		$wp_customize->add_setting(
			'single_history_note',
			array(
				'default'           => '',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			new Note_Control(
				$wp_customize,
				'single_history_note',
				array(
					'section' => 'post_page_settings',
				)
			)
		);

		/** Show/hide Related post in history single */
		$wp_customize->add_setting(
			'toggle_rel_history_post',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'toggle_rel_history_post',
				array(
					'label'       => __( 'Show/Hide History Related Post', 'constructionn' ),
					'description' => __( 'Enable to show related post in history single page.', 'constructionn' ),
					'section'     => 'post_page_settings',
					'type'        => 'checkbox',
				)
			)
		);

		// add settings and control for Related Post subheading settings
		$wp_customize->add_setting(
			'related_post_headings',
			array(
				'default'           => __( 'Related Posts', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'related_post_headings',
			array(
				'selector'        => '.post-heading',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'related_post_headings', __( 'Related Posts', 'constructionn' ) ) );
				},
			)
		);
		$wp_customize->add_control(
			'related_post_headings',
			array(
				'label'           => __( 'Heading', 'constructionn' ),
				'section'         => 'post_page_settings',
				'type'            => 'text',
				'active_callback' => 'constructionn_ed_related_post_active_callback',
			)
		);

		/** Show/hide Expert of the related Post */
		$wp_customize->add_setting(
			'toggle_rel_post_excerpt',
			array(
				'default'           => true,
				'sanitize_callback' => 'constructionn_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new GL_Toggle_Control(
				$wp_customize,
				'toggle_rel_post_excerpt',
				array(
					'label'           => __( 'Show/Hide Excerpt', 'constructionn' ),
					'description'     => __( 'Enable to show excerpts in related post.', 'constructionn' ),
					'section'         => 'post_page_settings',
					'type'            => 'checkbox',
					'active_callback' => 'constructionn_ed_related_post_active_callback',
				)
			)
		);
		$wp_customize->add_setting(
			'posts_excerpt_length',
			array(
				'default'           => '15',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			'posts_excerpt_length',
			array(
				'label'           => __( 'Excerpt Length', 'constructionn' ),
				'section'         => 'post_page_settings',
				'type'            => 'number',
				'active_callback' => 'constructionn_ed_related_post_active_callback',
			)
		);
		/** Posts(Blog) & Pages Settings Ends */
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_postpage' );

function constructionn_ed_related_post_active_callback( $control ) {

	$toggle_related_post = $control->manager->get_setting( 'toggle_related_post' )->value();

	$id = $control->id;

	if ( $id == 'related_post_heading' && $toggle_related_post ) {
		return true;
	}
	if ( $id == 'post_readmore_button' && $toggle_related_post ) {
		return true;
	}
	if ( $id == 'toggle_related_post_excerpt' && $toggle_related_post ) {
		return true;
	}
	if ( $id == 'post_excerpt_length' && $toggle_related_post ) {
		return true;
	}

	if ( $id == 'related_post_headings' && $toggle_related_post ) {
		return true;
	}
	if ( $id == 'toggle_rel_post_excerpt' && $toggle_related_post ) {
		return true;
	}
	if ( $id == 'posts_excerpt_length' && $toggle_related_post ) {
		return true;
	}
	return false;
}
