<?php
/**
 * About Template Counter Section
 *
 * @package constructionn-pro
 */
$counter_headings              = get_theme_mod( 'abtpg_counter_headings', __( 'Our goal is to make the design simple and useful.', 'constructionn-pro' ) );
$front_counter_repeaters       = get_theme_mod(
	'abtpg_counter_repeaters',
	array(
		array(
			'title'   => __( 'Destinations', 'constructionn-pro' ),
			'counter' => __( '150', 'constructionn-pro' ),
			'prefix'  => __( '+', 'constructionn-pro' ),
		),
		array(
			'title'   => __( 'Happy clients', 'constructionn-pro' ),
			'counter' => __( '100', 'constructionn-pro' ),
			'prefix'  => __( '+', 'constructionn-pro' ),
		),
		array(
			'title'   => __( 'Years of experience', 'constructionn-pro' ),
			'counter' => __( '12', 'constructionn-pro' ),
			'prefix'  => __( '+', 'constructionn-pro' ),
		),
	)
);
$front_count_feature_repeaters = get_theme_mod(
	'abtpg_count_feature_repeaters',
	array(
		array(
			'text'        => esc_html__( 'Our Mission', 'constructionn-pro' ),
			'description' => esc_html__( 'Reimagine how world develops by integrating the complete building lifecycle into a seamless platform.', 'constructionn-pro' ),
		),

		array(
			'text'        => esc_html__( 'Our Core Values', 'constructionn-pro' ),
			'description' => esc_html__( 'Reimagine how world develops by integrating the complete building lifecycle into a seamless platform.', 'constructionn-pro' ),
		),

		array(
			'text'        => esc_html__( 'Our Vision', 'constructionn-pro' ),
			'description' => esc_html__( 'Reimagine how world develops by integrating the complete building lifecycle into a seamless platform.', 'constructionn-pro' ),
		),
	)
);

constructionn_pro_counter_section(
	'aboutpg-counter',         // section id
	$counter_headings,   // heading text
	$front_counter_repeaters,  // count repeater key
	$front_count_feature_repeaters // feature repeater key
);
