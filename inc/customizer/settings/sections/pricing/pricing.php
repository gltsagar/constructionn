<?php

if ( ! function_exists( 'constructionn_customize_register_pricingpg_pricing' ) ) :
	/**
	 * Pricingpage Pricing
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function constructionn_customize_register_pricingpg_pricing( $wp_customize ) {
		$wp_customize->add_section(
			'pricingpg_pricing_section',
			array(
				'title'    => esc_html__( 'Pricing Settings', 'constructionn' ),
				'priority' => 120,
				'panel'    => 'pricing_page_settings',
			)
		);

		$wp_customize->add_setting(
			'pricingpg_tabs_settings',
			array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new GL_Customizer_Tabs_Control(
				$wp_customize,
				'pricingpg_tabs_settings',
				array(
					'section' => 'pricingpg_pricing_section',
					'tabs'    => array(
						'general'  => array(
							'nicename' => __( 'General', 'constructionn' ),
							'controls' => array(
								'pricingpg_heading',
							),
						),
						'starter'  => array(
							'nicename' => __( 'Starter', 'constructionn' ),
							'controls' => array(
								'starter_heading',
								'starter_price',
								'starter_rate',
								'starter_repeater',
								'starter_btn_text',
								'starter_btn_link',
							),
						),
						'standard' => array(
							'nicename' => __( 'Standard', 'constructionn' ),
							'controls' => array(
								'standard_off',
								'standard_heading',
								'standard_price',
								'standard_rate',
								'standard_repeater',
								'standard_btn_text',
								'standard_btn_link',
							),
						),
						'premium'  => array(
							'nicename' => __( 'Premium', 'constructionn' ),
							'controls' => array(
								'premium_heading',
								'premium_price',
								'premium_rate',
								'premium_repeater',
								'premium_btn_text',
								'premium_btn_link',
							),
						),
					),
				)
			)
		);

		// Add setting for Pricing Section Heading
		$wp_customize->add_setting(
			'pricingpg_heading',
			array(
				'default'           => esc_html__( 'Reliable pricing strategies', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'pricingpg_heading',
			array(
				'selector'        => '.pricing-section h2.section-heading',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'pricingpg_heading', __( 'Reliable pricing strategies', 'constructionn' ) ) );
				},
			)
		);

		// Add setting for Pricing Section Heading
		$wp_customize->add_control(
			'pricingpg_heading',
			array(
				'label'   => esc_html__( 'Heading', 'constructionn' ),
				'section' => 'pricingpg_pricing_section',
				'type'    => 'text',
			)
		);

		// Start tab settings and controls for starter package

		// heading
		$wp_customize->add_setting(
			'starter_heading',
			array(
				'default'           => esc_html__( 'Starter Package', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'starter_heading',
			array(
				'selector'        => '.front-pricing h2.center-heading',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'starter_heading', __( 'Starter Package', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'starter_heading',
			array(
				'label'   => esc_html__( 'Heading', 'constructionn' ),
				'section' => 'pricingpg_pricing_section',
				'type'    => 'text',
			)
		);

		// price
		$wp_customize->add_setting(
			'starter_price',
			array(
				'default'           => esc_html__( '$ 99', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'starter_price',
			array(
				'selector'        => '.front-pricing h2.center-heading',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'starter_price', __( '$ 99', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'starter_price',
			array(
				'label'   => esc_html__( 'Price', 'constructionn' ),
				'section' => 'pricingpg_pricing_section',
				'type'    => 'text',
			)
		);
		// rate i.e. per month or per year
		$wp_customize->add_setting(
			'starter_rate',
			array(
				'default'           => esc_html__( 'per months', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'starter_rate',
			array(
				'selector'        => '.front-pricing h2.center-heading',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'starter_rate', __( 'per months', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'starter_rate',
			array(
				'label'   => esc_html__( 'Rate', 'constructionn' ),
				'section' => 'pricingpg_pricing_section',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			'starter_btn_text',
			array(
				'default'           => esc_html__( 'Choose Plan', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'starter_btn_text',
			array(
				'selector'        => '.front-pricing h2.center-heading',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'starter_btn_text', __( 'Choose Plan', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'starter_btn_text',
			array(
				'label'   => esc_html__( 'Button Text', 'constructionn' ),
				'section' => 'pricingpg_pricing_section',
				'type'    => 'text',
			)
		);

		// Add setting for starter Button link
		$wp_customize->add_setting(
			'starter_btn_link',
			array(
				'default'           => '#',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		// Add control for starter Button link
		$wp_customize->add_control(
			'starter_btn_link',
			array(
				'label'   => esc_html__( 'Button Link', 'constructionn' ),
				'section' => 'pricingpg_pricing_section',
				'type'    => 'url',
			)
		);

		$wp_customize->add_setting(
			new Constructionn_Repeater_Setting(
				$wp_customize,
				'starter_repeater',
				array(
					'default'           => array(),
					'sanitize_callback' => array( 'Constructionn_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Control_Repeater(
				$wp_customize,
				'starter_repeater',
				array(
					'section'   => 'pricingpg_pricing_section',
					'label'     => __( 'Add Features', 'constructionn' ),
					'fields'    => array(
						'is_exclude' => array(
							'type'  => 'checkbox',
							'label' => __( 'Exclude', 'constructionn' ),
						),
						'title'      => array(
							'type'  => 'text',
							'label' => __( 'Feature', 'constructionn' ),
						),
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __( 'Feature', 'constructionn' ),
						'field' => 'value',
					),
				)
			)
		);

		// Start tab settings and controls for standard package
		// heading
		$wp_customize->add_setting(
			'standard_off',
			array(
				'default'           => esc_html__( '10% OFF', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'standard_off',
			array(
				'selector'        => '.front-pricing h2.center-heading',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'standard_off', __( '10% OFF', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'standard_off',
			array(
				'label'   => esc_html__( 'Heading', 'constructionn' ),
				'section' => 'pricingpg_pricing_section',
				'type'    => 'text',
			)
		);
		$wp_customize->add_setting(
			'standard_heading',
			array(
				'default'           => esc_html__( 'Standard Package', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'standard_heading',
			array(
				'selector'        => '.front-pricing h2.center-heading',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'standard_heading', __( 'Standard Package', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'standard_heading',
			array(
				'label'   => esc_html__( 'Heading', 'constructionn' ),
				'section' => 'pricingpg_pricing_section',
				'type'    => 'text',
			)
		);

		// price
		$wp_customize->add_setting(
			'standard_price',
			array(
				'default'           => esc_html__( '$ 299', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'standard_price',
			array(
				'selector'        => '.front-pricing h2.center-heading',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'standard_price', __( '$ 299', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'standard_price',
			array(
				'label'   => esc_html__( 'Price', 'constructionn' ),
				'section' => 'pricingpg_pricing_section',
				'type'    => 'text',
			)
		);
		// rate i.e. per month or per year
		$wp_customize->add_setting(
			'standard_rate',
			array(
				'default'           => esc_html__( 'per month', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'standard_rate',
			array(
				'selector'        => '.front-pricing h2.center-heading',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'standard_rate', __( 'per month', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'standard_rate',
			array(
				'label'   => esc_html__( 'Rate', 'constructionn' ),
				'section' => 'pricingpg_pricing_section',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			'standard_btn_text',
			array(
				'default'           => esc_html__( 'Choose Plan', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'standard_btn_text',
			array(
				'selector'        => '.front-pricing h2.center-heading',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'standard_btn_text', __( 'Choose Plan', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'standard_btn_text',
			array(
				'label'   => esc_html__( 'Button Text', 'constructionn' ),
				'section' => 'pricingpg_pricing_section',
				'type'    => 'text',
			)
		);

		// Add setting for standard Button link
		$wp_customize->add_setting(
			'standard_btn_link',
			array(
				'default'           => '#',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		// Add control for standard Button link
		$wp_customize->add_control(
			'standard_btn_link',
			array(
				'label'   => esc_html__( 'Button Link', 'constructionn' ),
				'section' => 'pricingpg_pricing_section',
				'type'    => 'url',
			)
		);

		$wp_customize->add_setting(
			new Constructionn_Repeater_Setting(
				$wp_customize,
				'standard_repeater',
				array(
					'default'           => array(),
					'sanitize_callback' => array( 'Constructionn_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Control_Repeater(
				$wp_customize,
				'standard_repeater',
				array(
					'section'   => 'pricingpg_pricing_section',
					'label'     => __( 'Add Features', 'constructionn' ),
					'fields'    => array(
						'is_exclude' => array(
							'type'  => 'checkbox',
							'label' => __( 'Exclude', 'constructionn' ),
						),
						'title'      => array(
							'type'  => 'text',
							'label' => __( 'Feature', 'constructionn' ),
						),
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __( 'Feature', 'constructionn' ),
						'field' => 'value',
					),
				)
			)
		);

		// Start tab settings and controls for premium package
		// heading
		$wp_customize->add_setting(
			'premium_heading',
			array(
				'default'           => esc_html__( 'Premium Package', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'premium_heading',
			array(
				'selector'        => '.front-pricing h2.center-heading',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'premium_heading', __( 'Premium Package', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'premium_heading',
			array(
				'label'   => esc_html__( 'Heading', 'constructionn' ),
				'section' => 'pricingpg_pricing_section',
				'type'    => 'text',
			)
		);

		// price
		$wp_customize->add_setting(
			'premium_price',
			array(
				'default'           => esc_html__( '$ 399', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'premium_price',
			array(
				'selector'        => '.front-pricing h2.center-heading',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'premium_price', __( '$ 399', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'premium_price',
			array(
				'label'   => esc_html__( 'Price', 'constructionn' ),
				'section' => 'pricingpg_pricing_section',
				'type'    => 'text',
			)
		);
		// rate i.e. per month or per year
		$wp_customize->add_setting(
			'premium_rate',
			array(
				'default'           => esc_html__( 'per month', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'premium_rate',
			array(
				'selector'        => '.front-pricing h2.center-heading',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'premium_rate', __( 'per month', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'premium_rate',
			array(
				'label'   => esc_html__( 'Rate', 'constructionn' ),
				'section' => 'pricingpg_pricing_section',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			'premium_btn_text',
			array(
				'default'           => esc_html__( 'Choose Plan', 'constructionn' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'premium_btn_text',
			array(
				'selector'        => '.front-pricing h2.center-heading',
				'render_callback' => function () {
					return esc_html( get_theme_mod( 'premium_btn_text', __( 'Choose Plan', 'constructionn' ) ) );
				},
			)
		);

		$wp_customize->add_control(
			'premium_btn_text',
			array(
				'label'   => esc_html__( 'Button Text', 'constructionn' ),
				'section' => 'pricingpg_pricing_section',
				'type'    => 'text',
			)
		);

		// Add setting for premium Button link
		$wp_customize->add_setting(
			'premium_btn_link',
			array(
				'default'           => '#',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		// Add control for premium Button link
		$wp_customize->add_control(
			'premium_btn_link',
			array(
				'label'   => esc_html__( 'Button Link', 'constructionn' ),
				'section' => 'pricingpg_pricing_section',
				'type'    => 'url',
			)
		);

		$wp_customize->add_setting(
			new Constructionn_Repeater_Setting(
				$wp_customize,
				'premium_repeater',
				array(
					'default'           => array(),
					'sanitize_callback' => array( 'Constructionn_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Constructionn_Control_Repeater(
				$wp_customize,
				'premium_repeater',
				array(
					'section'   => 'pricingpg_pricing_section',
					'label'     => __( 'Add Features', 'constructionn' ),
					'fields'    => array(
						'is_exclude' => array(
							'type'  => 'checkbox',
							'label' => __( 'Exclude', 'constructionn' ),
						),
						'title'      => array(
							'type'  => 'text',
							'label' => __( 'Feature', 'constructionn' ),
						),
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __( 'Feature', 'constructionn' ),
						'field' => 'value',
					),
				)
			)
		);
	}
endif;
add_action( 'customize_register', 'constructionn_customize_register_pricingpg_pricing' );
