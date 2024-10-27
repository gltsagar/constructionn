<?php

if ( ! function_exists( 'constructionn_pro_customize_register_frontbanner' ) ) :

	/**
	 * Frontbanner
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_frontbanner( $wp_customize ) {

		$wp_customize->add_section(
			'banner_section',
			array(
				'title'    => __( 'Banner Section', 'constructionn-pro' ),
				'priority' => 10,
				'panel'    => 'frontpage_settings_panel',
			)
		);

		// banner layout image
		$wp_customize->add_setting(
			'banner_layouts',
			array(
				'default'           => 'six',
				'sanitize_callback' => 'constructionn_pro_radio_sanitization_header',
			)
		);

		$wp_customize->add_control(
			new GL_Radio_Image_Control(
				$wp_customize,
				'banner_layouts',
				array(
					'label'           => __( 'Banner Layout Settings', 'constructionn-pro' ),
					'description'     => __( 'Choose the layout of the banner for your site.', 'constructionn-pro' ),
					'row'             => '2',
					'section'         => 'banner_section',
					'priority'        => 5,
					'choices'         => array(
						'one'   => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/banner-one.jpg',
							'name'  => __( 'Banner One', 'constructionn-pro' ),
						),
						'two'   => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/banner-two.jpg',
							'name'  => __( 'Banner Two', 'constructionn-pro' ),
						),
						'three' => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/banner-three.jpg',
							'name'  => __( 'Banner Three', 'constructionn-pro' ),
						),
						'four'  => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/banner-four.jpg',
							'name'  => __( 'Banner Four', 'constructionn-pro' ),
						),
						'five'  => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/banner-five.jpg',
							'name'  => __( 'Banner Five', 'constructionn-pro' ),
						),
					),
					'active_callback' => 'constructionn_pro_frontbanner_active_callback',
				)
			)
		);

		$wp_customize->get_control( 'header_image' )->section          = 'banner_section';
		$wp_customize->get_control( 'header_video' )->section          = 'banner_section';
		$wp_customize->get_control( 'external_header_video' )->section = 'banner_section';

		$wp_customize->get_control( 'header_image' )->active_callback          = 'constructionn_pro_frontbanner_active_callback';
		$wp_customize->get_control( 'header_video' )->active_callback          = 'constructionn_pro_frontbanner_active_callback';
		$wp_customize->get_control( 'external_header_video' )->active_callback = 'constructionn_pro_frontbanner_active_callback';

		$wp_customize->get_control( 'header_image' )->priority          = 10;  // Set priority after banner_layouts
		$wp_customize->get_control( 'header_video' )->priority          = 10;
		$wp_customize->get_control( 'external_header_video' )->priority = 10;

		// Banner 1
		/** Slider Banner */
		$wp_customize->add_setting(
			new Constructionn_Pro_Repeater_Setting(
				$wp_customize,
				'front_banner_repeater',
				array(
					'default'           => array(),
					'sanitize_callback' => array( 'Constructionn_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Pro_Control_Repeater(
				$wp_customize,
				'front_banner_repeater',
				array(
					'section'         => 'banner_section',
					'label'           => __( 'Add Banner', 'constructionn-pro' ),
					'fields'          => array(
						'banner-icon'    => array(
							'type'  => 'image',
							'label' => __( 'Add Image', 'constructionn-pro' ),
						),
						'banner-heading' => array(
							'type'  => 'textarea',
							'label' => __( 'Heading', 'constructionn-pro' ),
						),
						'banner-desc'    => array(
							'type'  => 'textarea',
							'label' => __( 'Description', 'constructionn-pro' ),
						),
						'btn-text'       => array(
							'type'  => 'text',
							'label' => __( 'Button Text', 'constructionn-pro' ),
						),
						'btn-link'       => array(
							'type'  => 'url',
							'label' => __( 'Button Link', 'constructionn-pro' ),
						),
					),
					'row_label'       => array(
						'type'  => 'field',
						'value' => __( 'Banner', 'constructionn-pro' ),
						'field' => 'title',
					),
					'active_callback' => 'constructionn_pro_frontbanner_active_callback',
				)
			)
		);

		// Banner 2
		/** Slider Banner */
		$wp_customize->add_setting(
			new Constructionn_Pro_Repeater_Setting(
				$wp_customize,
				'front_banner_two_repeater',
				array(
					'default'           => array(),
					'sanitize_callback' => array( 'Constructionn_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Pro_Control_Repeater(
				$wp_customize,
				'front_banner_two_repeater',
				array(
					'section'         => 'banner_section',
					'label'           => __( 'Add Banner Two', 'constructionn-pro' ),
					'fields'          => array(
						'banner-icon'       => array(
							'type'  => 'image',
							'label' => __( 'Add Image', 'constructionn-pro' ),
						),
						'banner-heading'    => array(
							'type'  => 'text',
							'label' => __( 'Banner Heading', 'constructionn-pro' ),
						),
						'banner-subheading' => array(
							'type'  => 'text',
							'label' => __( 'Banner Subheading', 'constructionn-pro' ),
						),
						'btn-text-one'      => array(
							'type'  => 'text',
							'label' => __( 'Button Text One', 'constructionn-pro' ),
						),
						'btn-link-one'      => array(
							'type'  => 'url',
							'label' => __( 'Button Link One', 'constructionn-pro' ),
						),
						'btn-text-two'      => array(
							'type'  => 'text',
							'label' => __( 'Button Text Two', 'constructionn-pro' ),
						),
						'btn-link-two'      => array(
							'type'  => 'text',
							'label' => __( 'Button Link Two', 'constructionn-pro' ),
						),

					),
					'row_label'       => array(
						'type'  => 'field',
						'value' => __( 'Banner', 'constructionn-pro' ),
						'field' => 'title',
					),
					'active_callback' => 'constructionn_pro_frontbanner_active_callback',
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
					'description'     => esc_html__( 'Upload Image', 'constructionn-pro' ),
					'section'         => 'banner_section',
					'active_callback' => 'constructionn_pro_frontbanner_active_callback',
				)
			)
		);

		// Add setting for banner three Section SubHeading
		$wp_customize->add_setting(
			'ban_three_subheading',
			array(
				'default'           => esc_html__( 'Architecture', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Add setting for banner three Section SubHeading
		$wp_customize->add_control(
			'ban_three_subheading',
			array(
				'label'           => esc_html__( 'Sub Heading', 'constructionn-pro' ),
				'section'         => 'banner_section',
				'type'            => 'text',
				'active_callback' => 'constructionn_pro_frontbanner_active_callback',
			)
		);

		// Add setting for banner three Section Heading
		$wp_customize->add_setting(
			'ban_three_heading',
			array(
				'default'           => esc_html__( 'The Passion For Architecture Never Stops', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Add setting for banner three Section Heading
		$wp_customize->add_control(
			'ban_three_heading',
			array(
				'label'           => esc_html__( 'Heading', 'constructionn-pro' ),
				'section'         => 'banner_section',
				'type'            => 'text',
				'active_callback' => 'constructionn_pro_frontbanner_active_callback',
			)
		);

		// Add setting for banner three Section SubHeading
		$wp_customize->add_setting(
			'ban_three_descs',
			array(
				'default'           => esc_html__( 'Use of the  agile frameworks to give a high-level overviews and iterative corporate for a better strategy a solid synopsis.', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_textarea_field',
			)
		);

		// Add setting for banner three Section SubHeading
		$wp_customize->add_control(
			'ban_three_descs',
			array(
				'label'           => esc_html__( 'Description', 'constructionn-pro' ),
				'section'         => 'banner_section',
				'type'            => 'textarea',
				'active_callback' => 'constructionn_pro_frontbanner_active_callback',
			)
		);

		// Add setting for banner three button text one
		$wp_customize->add_setting(
			'b_three_btn_txt_one',
			array(
				'default'           => esc_html__( 'Learn More', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Add setting for banner three button text
		$wp_customize->add_control(
			'b_three_btn_txt_one',
			array(
				'label'           => esc_html__( 'Button Text One', 'constructionn-pro' ),
				'section'         => 'banner_section',
				'type'            => 'text',
				'active_callback' => 'constructionn_pro_frontbanner_active_callback',
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
				'label'           => esc_html__( 'Button Link One', 'constructionn-pro' ),
				'section'         => 'banner_section',
				'type'            => 'url',
				'active_callback' => 'constructionn_pro_frontbanner_active_callback',
			)
		);

		// Add setting for banner three button text one
		$wp_customize->add_setting(
			'b_three_btn_txt_two',
			array(
				'default'           => esc_html__( 'Learn More', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Add setting for banner three button text
		$wp_customize->add_control(
			'b_three_btn_txt_two',
			array(
				'label'           => esc_html__( 'Button Text Two', 'constructionn-pro' ),
				'section'         => 'banner_section',
				'type'            => 'text',
				'active_callback' => 'constructionn_pro_frontbanner_active_callback',
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
				'label'           => esc_html__( 'Button Link Two', 'constructionn-pro' ),
				'section'         => 'banner_section',
				'type'            => 'url',
				'active_callback' => 'constructionn_pro_frontbanner_active_callback',
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
				'label'           => esc_html__( 'Video Link', 'constructionn-pro' ),
				'section'         => 'banner_section',
				'type'            => 'url',
				'active_callback' => 'constructionn_pro_frontbanner_active_callback',

			)
		);

		/** Slider Banner */
			/** Dynamic bannerthree Section */
			$wp_customize->add_setting(
				new Constructionn_Pro_Repeater_Setting(
					$wp_customize,
					'front_bannerthree_repeater',
					array(
						'default'           => '',
						'sanitize_callback' => array( 'Constructionn_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
					)
				)
			);

		$wp_customize->add_control(
			new Constructionn_Pro_Control_Repeater(
				$wp_customize,
				'front_bannerthree_repeater',
				array(
					'section'         => 'banner_section',
					'label'           => __( 'Add Banner Counter', 'constructionn-pro' ),
					'fields'          => array(
						'count'  => array(
							'type'  => 'text',
							'label' => __( 'Counter', 'constructionn-pro' ),
						),
						'prefix' => array(
							'type'  => 'text',
							'label' => __( 'Prefix', 'constructionn-pro' ),
						),
						'text'   => array(
							'type'  => 'text',
							'label' => __( 'Count Text', 'constructionn-pro' ),
						),
					),
					'row_label'       => array(
						'type'  => 'field',
						'value' => __( 'Banner counter', 'constructionn-pro' ),
						'field' => 'title',
					),
					'choices'         => array(
						'limit' => 3,
					),
					'active_callback' => 'constructionn_pro_frontbanner_active_callback',
				)
			)
		);

		// Banner 4

		/** Slider Banner */
		$wp_customize->add_setting(
			new Constructionn_Pro_Repeater_Setting(
				$wp_customize,
				'front_banner_four_repeater',
				array(
					'default'           => '',
					'sanitize_callback' => array( 'Constructionn_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Pro_Control_Repeater(
				$wp_customize,
				'front_banner_four_repeater',
				array(
					'section'         => 'banner_section',
					'label'           => __( 'Add Banner Four', 'constructionn-pro' ),
					'fields'          => array(
						'banner-icon'        => array(
							'type'  => 'image',
							'label' => __( 'Add Image', 'constructionn-pro' ),
						),
						'banner-heading'     => array(
							'type'  => 'text',
							'label' => __( 'Banner Heading', 'constructionn-pro' ),
						),
						'banner-heading-url' => array(
							'type'  => 'url',
							'label' => __( 'Banner Heading Url', 'constructionn-pro' ),
						),
						'banner-subheading'  => array(
							'type'  => 'text',
							'label' => __( 'Banner Sub Heading', 'constructionn-pro' ),
						),
					),
					'row_label'       => array(
						'type'  => 'field',
						'value' => __( 'Banner', 'constructionn-pro' ),
						'field' => 'title',
					),
					'active_callback' => 'constructionn_pro_frontbanner_active_callback',
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_frontbanner' );

function constructionn_pro_frontbanner_active_callback( $control ) {

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
