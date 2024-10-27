<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Constructionn
 */
	/**
	 * Doctype Hook
	 *
	 * @hooked constructionn_doctype
	 */
	do_action( 'constructionn_doctype' );
?>
<head itemscope itemtype="http://schema.org/WebSite">
	<?php
	/**
	 * Before wp_head
	 *
	 * @hooked constructionn_head
	 */
	do_action( 'constructionn_before_wp_head' );

	wp_head();
	?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<?php wp_body_open(); ?>
	<?php
	/**
	 * Before Header
	 *
	 * @hooked constructionn_page_start - 20
	 */
	do_action( 'constructionn_before_header' );

	/**
	 * Header
	 *
	 * @hooked constructionn_header_inclusion - 10
	*/
	do_action( 'constructionn_header' );

	/**
	 * Before Content
	 *
	 * @hooked constructionn_background_header   -10
	*/
	do_action( 'constructionn_after_header' );
