<?php

if ( ! function_exists( 'constructionn_customize_register_frontbanner' ) ) :

	/**
	 * Frontbanner
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_frontbanner( $wp_customize ) {

		$wp_customize->add_section(
			'banner_section',
			array(
				'title'    => __( 'Banner Section', 'constructionn' ),
				'priority' => 10,
				'panel'    => 'frontpage_settings_panel',
			)
		);

		// banner layout image
		$wp_customize->add_setting(
			'banner_layouts',
			array(
				'default'           => 'six',
				'sanitize_callback' => 'constructionn_radio_sanitization_header',
			)
		);

		$wp_customize->add_control(
			new GL_Radio_Image_Control(
				$wp_customize,
				'banner_layouts',
				array(
					'label'           => __( 'Banner Layout Settings', 'constructionn' ),
					'description'     => __( 'Choose the layout of the banner for your site.', 'constructionn' ),
					'row'             => '2',
					'section'         => 'banner_section',
					'priority'        => 5,
					'choices'         => array(
						'one'   => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/banner-one.jpg',
							'name'  => __( 'Banner One', 'constructionn' ),
						),
						'two'   => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/banner-two.jpg',
							'name'  => __( 'Banner Two', 'constructionn' ),
						),
						'three' => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/banner-three.jpg',
							'name'  => __( 'Banner Three', 'constructionn' ),
						),
						'four'  => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/banner-four.jpg',
							'name'  => __( 'Banner Four', 'constructionn' ),
						),
						'five'  => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/banner-five.jpg',
							'name'  => __( 'Banner Five', 'constructionn' ),
						),
					),
					'active_callback' => 'constructionn_frontbanner_active_callback',
				)
			)
		);

		$wp_customize->get_control( 'header_image' )->section          = 'banner_section';
		$wp_customize->get_control( 'header_video' )->section          = 'banner_section';
		$wp_customize->get_control( 'external_header_video' )->section = 'banner_section';

		$wp_customize->get_control( 'header_image' )->active_callback          = 'constructionn_frontbanner_active_callback';
		$wp_customize->get_control( 'header_video' )->active_callback          = 'constructionn_frontbanner_active_callback';
		$wp_customize->get_control( 'external_header_video' )->active_callback = 'constructionn_frontbanner_active_callback';

		$wp_customize->get_control( 'header_image' )->priority          = 10;  // Set priority after banner_layouts
		$wp_customize->get_control( 'header_video' )->priority          = 10;
		$wp_customize->get_control( 'external_header_video' )->priority = 10;

		// Banner 1
		/** Slider Banner */
		$wp_customize->add_setting(
			new Constructionn_Repeater_Setting(
				$wp_customize,
				'front_banner_repeater',
				array(
					'default'           => array(),
					'sanitize_callback' => array( 'Constructionn_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Control_Repeater(
				$wp_customize,
				'front_banner_repeater',
				array(
					'section'         => 'banner_section',
					'label'           => __( 'Add Banner', 'constructionn' ),
					'fields'          => array(
						'banner-icon'    => array(
							'type'  => 'image',
							'label' => __( 'Add Image', 'constructionn' ),
						),
						'banner-heading' => array(
							'type'  => 'textarea',
							'label' => __( 'Heading', 'constructionn' ),
						),
						'banner-desc'    => array(
							'type'  => 'textarea',
							'label' => __( 'Description', 'constructionn' ),
						),
						'btn-text'       => array(
							'type'  => 'text',
							'label' => __( 'Button Text', 'constructionn' ),
						),
						'btn-link'       => array(
							'type'  => 'url',
							'label' => __( 'Button Link', 'constructionn' ),
						),
					),
					'row_label'       => array(
						'type'  => 'field',
						'value' => __( 'Banner', 'constructionn' ),
						'field' => 'title',
					),
					'active_callback' => 'constructionn_frontbanner_active_callback',
				)
			)
		);

		// Banner 2
		/** Slider Banner */
		$wp_customize->add_setting(
			new Constructionn_Repeater_Setting(
				$wp_customize,
				'front_banner_two_repeater',
				array(
					'default'           => array(),
					'sanitize_callback' => array( 'Constructionn_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Control_Repeater(
				$wp_customize,
				'front_banner_two_repeater',
				array(
					'section'         => 'banner_section',
					'label'           => __( 'Add Banner Two', 'constructionn' ),
					'fields'          => array(
						'banner-icon'       => array(
							'type'  => 'image',
							'label' => __( 'Add Image', 'constructionn' ),
						),
						'banner-heading'    => array(
							'type'  => 'text',
							'label' => __( 'Banner Heading', 'constructionn' ),
						),
						'banner-subheading' => array(
							'type'  => 'text',
							'label' => __( 'Banner Subheading', 'constructionn' ),
						),
						'btn-text-one'      => array(
							'type'  => 'text',
							'label' => __( 'Button Text One', 'constructionn' ),
						),
						'btn-link-one'      => array(
							'type'  => 'url',
							'label' => __( 'Button Link One', 'constructionn' ),
						),
						'btn-text-two'      => array(
							'type'  => 'text',
							'label' => __( 'Button Text Two', 'constructionn' ),
						),
						'btn-link-two'      => array(
							'type'  => 'text',
							'label' => __( 'Button Link Two', 'constructionn' ),
						),

					),
					'row_label'       => array(
						'type'  => 'field',
						'value' => __( 'Banner', 'constructionn' ),
						'field' => 'title',
					),
					'active_callback' => 'constructionn_frontbanner_active_callback',
				)
			)
		);

		// Banner 3

		$wp_customize->add_setting(
			'banner_three_img',
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		// Add Control for Banner three Image
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'banner_three_img',
				array(
					'description'     => esc_html__( 'Upload Image', 'constructionn' ),
					'section'         => 'banner_section',
					'active_callback' => 'constructionn_frontbanner_active_callback',
				)
			)
		);

		// Add setting for banner three Section SubHeading
		$wp_customize->add_setting(
			'ban_three_subheading',
			array(
				'default'           => esc_html__( 'Architecture', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Add setting for banner three Section SubHeading
		$wp_customize->add_control(
			'ban_three_subheading',
			array(
				'label'           => esc_html__( 'Sub Heading', 'constructionn' ),
				'section'         => 'banner_section',
				'type'            => 'text',
				'active_callback' => 'constructionn_frontbanner_active_callback',
			)
		);

		// Add setting for banner three Section Heading
		$wp_customize->add_setting(
			'ban_three_heading',
			array(
				'default'           => esc_html__( 'The Passion For Architecture Never Stops', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Add setting for banner three Section Heading
		$wp_customize->add_control(
			'ban_three_heading',
			array(
				'label'           => esc_html__( 'Heading', 'constructionn' ),
				'section'         => 'banner_section',
				'type'            => 'text',
				'active_callback' => 'constructionn_frontbanner_active_callback',
			)
		);

		// Add setting for banner three Section SubHeading
		$wp_customize->add_setting(
			'ban_three_descs',
			array(
				'default'           => esc_html__( 'Use of the  agile frameworks to give a high-level overviews and iterative corporate for a better strategy a solid synopsis.', 'constructionn' ),
				'sanitize_callback' => 'sanitize_textarea_field',
			)
		);

		// Add setting for banner three Section SubHeading
		$wp_customize->add_control(
			'ban_three_descs',
			array(
				'label'           => esc_html__( 'Description', 'constructionn' ),
				'section'         => 'banner_section',
				'type'            => 'textarea',
				'active_callback' => 'constructionn_frontbanner_active_callback',
			)
		);

		// Add setting for banner three button text one
		$wp_customize->add_setting(
			'b_three_btn_txt_one',
			array(
				'default'           => esc_html__( 'Learn More', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Add setting for banner three button text
		$wp_customize->add_control(
			'b_three_btn_txt_one',
			array(
				'label'           => esc_html__( 'Button Text One', 'constructionn' ),
				'section'         => 'banner_section',
				'type'            => 'text',
				'active_callback' => 'constructionn_frontbanner_active_callback',
			)
		);

		// Add setting for banner three  button link One
		$wp_customize->add_setting(
			'b_three_btn_link_one',
			array(
				'default'           => '#',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		// Add setting for banner three button link
		$wp_customize->add_control(
			'b_three_btn_link_one',
			array(
				'label'           => esc_html__( 'Button Link One', 'constructionn' ),
				'section'         => 'banner_section',
				'type'            => 'url',
				'active_callback' => 'constructionn_frontbanner_active_callback',
			)
		);

		// Add setting for banner three button text one
		$wp_customize->add_setting(
			'b_three_btn_txt_two',
			array(
				'default'           => esc_html__( 'Learn More', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Add setting for banner three button text
		$wp_customize->add_control(
			'b_three_btn_txt_two',
			array(
				'label'           => esc_html__( 'Button Text Two', 'constructionn' ),
				'section'         => 'banner_section',
				'type'            => 'text',
				'active_callback' => 'constructionn_frontbanner_active_callback',
			)
		);

		// Add setting for banner three  button link Two
		$wp_customize->add_setting(
			'b_three_btn_link_two',
			array(
				'default'           => '#',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		// Add setting for banner three button link
		$wp_customize->add_control(
			'b_three_btn_link_two',
			array(
				'label'           => esc_html__( 'Button Link Two', 'constructionn' ),
				'section'         => 'banner_section',
				'type'            => 'url',
				'active_callback' => 'constructionn_frontbanner_active_callback',
			)
		);

		// Add setting for banner three video button link
		$wp_customize->add_setting(
			'ban_video_btn_link',
			array(
				'default'           => '#',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		// Add setting for banner three video button link
		$wp_customize->add_control(
			'ban_video_btn_link',
			array(
				'label'           => esc_html__( 'Video Link', 'constructionn' ),
				'section'         => 'banner_section',
				'type'            => 'url',
				'active_callback' => 'constructionn_frontbanner_active_callback',

			)
		);

		/** Slider Banner */
			/** Dynamic bannerthree Section */
			$wp_customize->add_setting(
				new Constructionn_Repeater_Setting(
					$wp_customize,
					'front_bannerthree_repeater',
					array(
						'default'           => '',
						'sanitize_callback' => array( 'Constructionn_Repeater_Setting', 'sanitize_repeater_setting' ),
					)
				)
			);

		$wp_customize->add_control(
			new Constructionn_Control_Repeater(
				$wp_customize,
				'front_bannerthree_repeater',
				array(
					'section'         => 'banner_section',
					'label'           => __( 'Add Banner Counter', 'constructionn' ),
					'fields'          => array(
						'count'  => array(
							'type'  => 'text',
							'label' => __( 'Counter', 'constructionn' ),
						),
						'prefix' => array(
							'type'  => 'text',
							'label' => __( 'Prefix', 'constructionn' ),
						),
						'text'   => array(
							'type'  => 'text',
							'label' => __( 'Count Text', 'constructionn' ),
						),
					),
					'row_label'       => array(
						'type'  => 'field',
						'value' => __( 'Banner counter', 'constructionn' ),
						'field' => 'title',
					),
					'choices'         => array(
						'limit' => 3,
					),
					'active_callback' => 'constructionn_frontbanner_active_callback',
				)
			)
		);

		// Banner 4

		/** Slider Banner */
		$wp_customize->add_setting(
			new Constructionn_Repeater_Setting(
				$wp_customize,
				'front_banner_four_repeater',
				array(
					'default'           => '',
					'sanitize_callback' => array( 'Constructionn_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Control_Repeater(
				$wp_customize,
				'front_banner_four_repeater',
				array(
					'section'         => 'banner_section',
					'label'           => __( 'Add Banner Four', 'constructionn' ),
					'fields'          => array(
						'banner-icon'        => array(
							'type'  => 'image',
							'label' => __( 'Add Image', 'constructionn' ),
						),
						'banner-heading'     => array(
							'type'  => 'text',
							'label' => __( 'Banner Heading', 'constructionn' ),
						),
						'banner-heading-url' => array(
							'type'  => 'url',
							'label' => __( 'Banner Heading Url', 'constructionn' ),
						),
						'banner-subheading'  => array(
							'type'  => 'text',
							'label' => __( 'Banner Sub Heading', 'constructionn' ),
						),
					),
					'row_label'       => array(
						'type'  => 'field',
						'value' => __( 'Banner', 'constructionn' ),
						'field' => 'title',
					),
					'active_callback' => 'constructionn_frontbanner_active_callback',
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_frontbanner' );

function constructionn_frontbanner_active_callback( $control ) {

	$hero_banner_layouts = $control->manager->get_setting( 'banner_layouts' )->value();

	$id = $control->id;

	// Banner Selection
	if ( $id == 'banner_layouts' ) {
		return true;
	}

	switch ( $hero_banner_layouts ) {
		case 'one':
			return in_array( $id, array( 'front_banner_repeater' ) );
		case 'two':
			return $id == 'front_banner_two_repeater';
		case 'three':
			return in_array( $id, array( 'banner_three_img', 'ban_three_subheading', 'ban_three_heading', 'ban_three_descs', 'b_three_btn_txt_one', 'b_three_btn_link_one', 'b_three_btn_txt_two', 'b_three_btn_link_two', 'ban_video_btn_link', 'front_bannerthree_repeater' ) );
		case 'four':
			return in_array( $id, array( 'front_banner_four_repeater' ) );
		case 'five':
			return in_array( $id, array( 'header_image', 'header_video', 'external_header_video', 'ban_three_subheading', 'ban_three_heading', 'ban_three_descs', 'b_three_btn_txt_one', 'b_three_btn_link_one', 'b_three_btn_txt_two', 'b_three_btn_link_two' ) );
		default:
			return false;
	}
}
