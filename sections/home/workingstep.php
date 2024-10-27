<?php
/**
 * Front Workingstep Section
 *
 * @package constructionn
 */
$workstep_headings        = get_theme_mod( 'workstep_headings', __( 'Our working steps', 'constructionn' ) );
$front_workstep_repeaters = get_theme_mod(
	'front_workstep_repeaters',
	array(
		array(
			'text'        => esc_html__( '> Project planning and design', 'constructionn' ),
			'description' => esc_html__( 'In this initial phase, requirements and goals are defined, and the design concept.  The project requirements and goals are defined', 'constructionn' ),
			'image'       => false,
		),

		array(
			'text'        => esc_html__( 'Detailed proposal', 'constructionn' ),
			'description' => esc_html__( 'In this initial phase, requirements and goals are defined, and the design concept.  The project requirements and goals are defined', 'constructionn' ),
			'image'       => false,
		),

		array(
			'text'        => esc_html__( 'Planning implementation', 'constructionn' ),
			'description' => esc_html__( 'In this initial phase, requirements and goals are defined, and the design concept.  The project requirements and goals are defined', 'constructionn' ),
			'image'       => false,
		),

		array(
			'text'        => esc_html__( 'Project installation process', 'constructionn' ),
			'description' => esc_html__( 'In this initial phase, requirements and goals are defined, and the design concept.  The project requirements and goals are defined', 'constructionn' ),
			'image'       => false,
		),

		array(
			'text'        => esc_html__( 'Final inspection', 'constructionn' ),
			'description' => esc_html__( 'In this initial phase, requirements and goals are defined, and the design concept.  The project requirements and goals are defined', 'constructionn' ),
			'image'       => false,
		),
	)
);

constructionn_workingstep_section(
	'front-workingstep',
	$workstep_headings,
	$front_workstep_repeaters
);
