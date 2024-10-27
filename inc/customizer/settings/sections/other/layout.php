<?php

if ( ! function_exists( 'constructionn_pro_customize_register_layout_settings' ) ) :
	/**
	 * Layout Settings
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_layout_settings( $wp_customize ) {
		$wp_customize->add_section(
			'layout_settings',
			array(
				'title'    => __( 'Layout Settings', 'constructionn-pro' ),
				'priority' => 60,
				'panel'    => 'general_settings_panel',
			)
		);

		$wp_customize->add_setting(
			'single_page_layouts',
			array(
				'default'           => 'layout-two',
				'sanitize_callback' => 'constructionn_pro_radio_sanitization_header',
			)
		);

		$wp_customize->add_control(
			new GL_Radio_Image_Control(
				$wp_customize,
				'single_page_layouts',
				array(
					'label'   => __( 'Page Layouts', 'constructionn-pro' ),
					'row'     => '2',
					'section' => 'layout_settings',
					'choices' => array(
						'layout-two'    => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/full-width.jpg',
							'name'  => __( 'Full Width', 'constructionn-pro' ),
						),
						'gl-right-wrap' => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/right.jpg',
							'name'  => __( 'Right Sidebar', 'constructionn-pro' ),
						),
						'gl-left-wrap'  => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/left.jpg',
							'name'  => __( 'Left Sidebar', 'constructionn-pro' ),
						),
					),
				)
			)
		);

		$wp_customize->add_setting(
			'single_post_layouts',
			array(
				'default'           => 'layout-two',
				'sanitize_callback' => 'constructionn_pro_radio_sanitization_header',
			)
		);

		$wp_customize->add_control(
			new GL_Radio_Image_Control(
				$wp_customize,
				'single_post_layouts',
				array(
					'label'   => __( 'Post Layouts', 'constructionn-pro' ),
					'row'     => '2',
					'section' => 'layout_settings',
					'choices' => array(
						'layout-two'    => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/full-width.jpg',
							'name'  => __( 'Full Width', 'constructionn-pro' ),
						),
						'gl-right-wrap' => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/right.jpg',
							'name'  => __( 'Right Sidebar', 'constructionn-pro' ),
						),
						'gl-left-wrap'  => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/left.jpg',
							'name'  => __( 'Left Sidebar', 'constructionn-pro' ),
						),
					),
				)
			)
		);

		$wp_customize->add_setting(
			'archive_page_layouts',
			array(
				'default'           => 'layout-two',
				'sanitize_callback' => 'constructionn_pro_radio_sanitization_header',
			)
		);

		$wp_customize->add_control(
			new GL_Radio_Image_Control(
				$wp_customize,
				'archive_page_layouts',
				array(
					'label'   => __( 'Archive & Search Layouts', 'constructionn-pro' ),
					'row'     => '2',
					'section' => 'layout_settings',
					'choices' => array(
						'layout-two'    => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/full-width.jpg',
							'name'  => __( 'Full Width', 'constructionn-pro' ),
						),
						'gl-right-wrap' => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/right.jpg',
							'name'  => __( 'Right Sidebar', 'constructionn-pro' ),
						),
						'gl-left-wrap'  => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/left.jpg',
							'name'  => __( 'Left Sidebar', 'constructionn-pro' ),
						),
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_layout_settings' );
