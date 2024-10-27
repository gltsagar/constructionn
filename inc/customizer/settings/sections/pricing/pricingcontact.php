<?php

if ( ! function_exists( 'constructionn_pro_customize_register_pricingpg_contact' ) ) :
	/**
	 * Pricingpage Contact
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_pro_customize_register_pricingpg_contact( $wp_customize ) {
		$wp_customize->add_section(
			'pricingpg_contact_section',
			array(
				'title'    => __( 'Contact Settings', 'constructionn-pro' ),
				'priority' => 30,
				'panel'    => 'pricing_page_settings',
			)
		);

		// Add setting for Email Heading
		$wp_customize->add_setting(
			'pricingpg_email_title',
			array(
				'default'           => __( 'EMAIL', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'pricingpg_email_title',
			array(
				'selector'        => '.pricingpage-contact h5.title.email',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'pricingpg_email_title', 'EMAIL' ) );
				},
			)
		);

		// Add control for Email Heading
		$wp_customize->add_control(
			'pricingpg_email_title',
			array(
				'section' => 'pricingpg_contact_section',
				'label'   => __( 'Email Title', 'constructionn-pro' ),
				'type'    => 'text',
			)
		);

		// Add setting for Email Description
		$wp_customize->add_setting(
			'pricingpg_email_desc',
			array(
				'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in ero.', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_textarea_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'pricingpg_email_desc',
			array(
				'selector'        => '.pricingpage-contact p.desc.email',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'pricingpg_email_desc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in ero.' ) );
				},
			)
		);

		// Add control for Email Description
		$wp_customize->add_control(
			'pricingpg_email_desc',
			array(
				'section' => 'pricingpg_contact_section',
				'label'   => __( 'Email Description', 'constructionn-pro' ),
				'type'    => 'textarea',
			)
		);

		// add setting and control for email
		$wp_customize->add_setting(
			'pricingpg_email',
			array(
				'default'           => __( ' infogl-construction.com', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_email',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'pricingpg_email',
			array(
				'selector'        => '.pricingpage-contact a.link.email',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'pricingpg_email', __( ' infogl-construction.com', 'constructionn-pro' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'pricingpg_email',
			array(
				'label'   => __( 'Email', 'constructionn-pro' ),
				'section' => 'pricingpg_contact_section',
				'type'    => 'email',
			)
		);

		// Adding setting for contact title
		$wp_customize->add_setting(
			'pricingpg_contact_title',
			array(
				'default'           => __( 'PHONE', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'pricingpg_contact_title',
			array(
				'selector'        => '.pricingpage-contact h5.title.tel',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'pricingpg_contact_title', __( 'PHONE', 'constructionn-pro' ) ) );
				},
			)
		);

		// Adding control for contact title
		$wp_customize->add_control(
			'pricingpg_contact_title',
			array(
				'section' => 'pricingpg_contact_section',
				'label'   => __( 'Contact Title', 'constructionn-pro' ),
				'type'    => 'text',
			)
		);

		// Add setting for Contact Description
		$wp_customize->add_setting(
			'pricingpg_contact_desc',
			array(
				'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in ero.', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_textarea_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'pricingpg_contact_desc',
			array(
				'selector'        => '.pricingpage-contact p.desc.tel',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'pricingpg_contact_desc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in ero.' ) );
				},
			)
		);

		// Add control for Contact Description
		$wp_customize->add_control(
			'pricingpg_contact_desc',
			array(
				'section' => 'pricingpg_contact_section',
				'label'   => __( 'Contact Description', 'constructionn-pro' ),
				'type'    => 'textarea',
			)
		);

		// Add setting and control for contact number
		$wp_customize->add_setting(
			'pricingpg_contact_num',
			array(
				'default'           => __( '+1-800-111-2222', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'pricingpg_contact_num',
			array(
				'selector'        => '.pricingpage-contact a.link.tel',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'pricingpg_contact_num', __( '+1-800-111-2222', 'constructionn-pro' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'pricingpg_contact_num',
			array(
				'label'   => __( 'Contact Number', 'constructionn-pro' ),
				'section' => 'pricingpg_contact_section',
				'type'    => 'text',
			)
		);

		// Adding setting for location title
		$wp_customize->add_setting(
			'pricingpg_location_title',
			array(
				'default'           => __( 'LOCATION', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'pricingpg_location_title',
			array(
				'selector'        => '.pricingpage-contact h5.title.loc',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'pricingpg_location_title', __( 'LOCATION', 'constructionn-pro' ) ) );
				},
			)
		);

		// Adding control for Location Title
		$wp_customize->add_control(
			'pricingpg_location_title',
			array(
				'section' => 'pricingpg_contact_section',
				'label'   => __( 'Location Title', 'constructionn-pro' ),
				'type'    => 'text',
			)
		);

		// Add setting for Location Description
		$wp_customize->add_setting(
			'pricingpg_location_desc',
			array(
				'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in ero.', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_textarea_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'pricingpg_location_desc',
			array(
				'selector'        => '.pricingpage-contact p.desc.loc',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'pricingpg_location_desc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in ero.' ) );
				},
			)
		);

		// Add control for Location Description
		$wp_customize->add_control(
			'pricingpg_location_desc',
			array(
				'section' => 'pricingpg_contact_section',
				'label'   => __( 'Location Description', 'constructionn-pro' ),
				'type'    => 'textarea',
			)
		);

		// Add setting and control for location
		$wp_customize->add_setting(
			'pricingpg_location',
			array(
				'default'           => __( 'Hamburg,Germany', 'constructionn-pro' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'pricingpg_location',
			array(
				'selector'        => '.pricingpage-contact span.location.contpg',
				'render_callback' => function () {
						return esc_html( get_theme_mod( 'pricingpg_location', __( 'Hamburg,Germany', 'constructionn-pro' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'pricingpg_location',
			array(
				'label'   => __( 'Location', 'constructionn-pro' ),
				'section' => 'pricingpg_contact_section',
				'type'    => 'text',
			)
		);

		/** Shortcode*/
		$wp_customize->add_setting(
			'pricingpg_contact_form_shortcode',
			array(
				'default'           => '',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'pricingpg_contact_form_shortcode',
			array(
				'label'   => __( 'Enter Shortcode', 'constructionn-pro' ),
				'type'    => 'text',
				'section' => 'pricingpg_contact_section',
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_pro_customize_register_pricingpg_contact' );
