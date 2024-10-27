<?php
/**
 * Front Counter Section
 *
 * @package constructionn
 */
$counter_headings              = get_theme_mod( 'counter_headings', __( 'Our goal is to make the design simple and useful.', 'constructionn' ) );
$front_counter_repeaters       = get_theme_mod(
	'front_counter_repeaters',
	array(
		array(
			'title'   => __( 'Destinations', 'constructionn' ),
			'counter' => __( '150', 'constructionn' ),
			'prefix'  => __( '+', 'constructionn' ),
		),
		array(
			'title'   => __( 'Happy clients', 'constructionn' ),
			'counter' => __( '100', 'constructionn' ),
			'prefix'  => __( '+', 'constructionn' ),
		),
		array(
			'title'   => __( 'Years of experience', 'constructionn' ),
			'counter' => __( '12', 'constructionn' ),
			'prefix'  => __( '+', 'constructionn' ),
		),
	)
);
$front_count_feature_repeaters = get_theme_mod(
	'front_count_feature_repeaters',
	array(
		array(
			'text'        => esc_html__( 'Our Mission', 'constructionn' ),
			'description' => esc_html__( 'Reimagine how world develops by integrating the complete building lifecycle into a seamless platform.', 'constructionn' ),
		),

		array(
			'text'        => esc_html__( 'Our Core Values', 'constructionn' ),
			'description' => esc_html__( 'Reimagine how world develops by integrating the complete building lifecycle into a seamless platform.', 'constructionn' ),
		),

		array(
			'text'        => esc_html__( 'Our Vision', 'constructionn' ),
			'description' => esc_html__( 'Reimagine how world develops by integrating the complete building lifecycle into a seamless platform.', 'constructionn' ),
		),
	)
);

constructionn_counter_section(
	'front-counter',         // section id
	$counter_headings,   // heading text
	$front_counter_repeaters,  // count repeater key
	$front_count_feature_repeaters // feature repeater key
);
