<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Constructionn_Pro
 */
	/**
	 * Doctype Hook
	 *
	 * @hooked constructionn_pro_doctype
	 */
	do_action( 'constructionn_pro_doctype' );
?>
<head itemscope itemtype="http://schema.org/WebSite">
	<?php
	/**
	 * Before wp_head
	 *
	 * @hooked constructionn_pro_head
	 */
	do_action( 'constructionn_pro_before_wp_head' );

	wp_head();
	?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<?php wp_body_open(); ?>
	<?php
	/**
	 * Before Header
	 *
	 * @hooked constructionn_pro_page_start - 20
	 */
	do_action( 'constructionn_pro_before_header' );

	/**
	 * Header
	 *
	 * @hooked constructionn_pro_header_inclusion - 10
	*/
	do_action( 'constructionn_pro_header' );

	/**
	 * Before Content
	 *
	 * @hooked constructionn_pro_background_header   -10
	*/
	do_action( 'constructionn_pro_after_header' );
