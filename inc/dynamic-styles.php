<?php

if ( ! function_exists( 'constructionn_pro_dynamic_values' ) ) :
	/**
	 * Dynamic CSS
	 *
	 * @return void
	 */
	function constructionn_pro_dynamic_values() {
		$defaults = constructionn_pro_get_typography_defaults();

		$fallback_bg_color = get_theme_mod( 'fallback_bg_color', '#003262' );
		$primary_color     = get_theme_mod( 'primary_color', '#0A204E' );
		$secondary_color   = get_theme_mod( 'secondary_color', '#FCA311' );
		$white_color       = get_theme_mod( 'white_color', '#FFFFFF' );
		$text_primary      = get_theme_mod( 'text_primary', '#141414' );
		$text_secondary    = get_theme_mod( 'text_secondary', '#686868' );
		$text_tertiary     = get_theme_mod( 'text_tertiary', '#EEEEEE' );
		$bg_tertiary_color = get_theme_mod( 'bg_tertiary_color', '#FAFBFB' );

		$logo_width = get_theme_mod( 'lfp_logo_width', 150 );

		$primary_font  = wp_parse_args( get_theme_mod( 'primary_font', $defaults['primary_font'] ) );
		$heading_one   = wp_parse_args( get_theme_mod( 'heading_one' ), $defaults['heading_one'] );
		$heading_two   = wp_parse_args( get_theme_mod( 'heading_two' ), $defaults['heading_two'] );
		$heading_three = wp_parse_args( get_theme_mod( 'heading_three' ), $defaults['heading_three'] );
		$heading_four  = wp_parse_args( get_theme_mod( 'heading_four' ), $defaults['heading_four'] );
		$heading_five  = wp_parse_args( get_theme_mod( 'heading_five' ), $defaults['heading_five'] );

		echo '<style id="constructionn-pro-dynamic">';
		echo '.gl-custom-admin-notice .col-left ul { 
			list-style-image: url(' . esc_url( get_template_directory_uri() ) . '/assets/icomoon/tick-mark.svg); 
		}';
		echo 'html body {
				text-transform:' . wp_kses_post( $primary_font['transform'] ) . ';
			}';
		echo ':root {	
			--con-logo-width	   : ' . absint( $logo_width ) . 'px;
			--con-fallback-bg-color: ' . constructionn_pro_sanitize_hex_color( $fallback_bg_color ) . ';
			--cnt-primary-color    : ' . constructionn_pro_sanitize_hex_color( $primary_color ) . ';
			--cnt-secondary-color  : ' . constructionn_pro_sanitize_hex_color( $secondary_color ) . ';
			--cnt-white-color      : ' . constructionn_pro_sanitize_hex_color( $white_color ) . ';
			--cnt-text-primary     : ' . constructionn_pro_sanitize_hex_color( $text_primary ) . ';
			--cnt-text-secondary   : ' . constructionn_pro_sanitize_hex_color( $text_secondary ) . ';
			--cnt-text-tertiary    : ' . constructionn_pro_sanitize_hex_color( $text_tertiary ) . ';
			--cnt-bg-gray          : ' . constructionn_pro_sanitize_hex_color( $bg_tertiary_color ) . ';
			
			--cnt-primary-font     : ' . wp_kses_post( constructionn_pro_get_font_family( $primary_font ) ) . ';
			--cnt-fs-body          : ' . wp_kses_post( $primary_font['font_size'] ) . 'px;

			--con-h1-font         : ' . wp_kses_post( constructionn_pro_get_font_family( $heading_one ) ) . ';
			--cnt-fs-h1           : ' . wp_kses_post( $heading_one['font_size'] ) . 'px;
			--con-h1-fontWeight   : ' . wp_kses_post( $heading_one['weight'] ) . ';
			--con-h1-textTransform: ' . wp_kses_post( $heading_one['transform'] ) . ';
			
			--con-h2-font         : ' . wp_kses_post( constructionn_pro_get_font_family( $heading_two ) ) . ';
			--cnt-fs-h2           : ' . wp_kses_post( $heading_two['font_size'] ) . 'px;
			--con-h2-fontWeight   : ' . wp_kses_post( $heading_two['weight'] ) . ';
			--con-h2-textTransform: ' . wp_kses_post( $heading_two['transform'] ) . ';
			
			--con-h3-font         : ' . wp_kses_post( constructionn_pro_get_font_family( $heading_three ) ) . ';
			--cnt-fs-h3           : ' . wp_kses_post( $heading_three['font_size'] ) . 'px;
			--con-h3-fontWeight   : ' . wp_kses_post( $heading_three['weight'] ) . ';
			--con-h3-textTransform: ' . wp_kses_post( $heading_three['transform'] ) . ';
			
			--con-h4-font         : ' . wp_kses_post( constructionn_pro_get_font_family( $heading_four ) ) . ';
			--cnt-fs-h4           : ' . wp_kses_post( $heading_four['font_size'] ) . 'px;
			--con-h4-fontWeight   : ' . wp_kses_post( $heading_four['weight'] ) . ';
			--con-h4-textTransform: ' . wp_kses_post( $heading_four['transform'] ) . ';
			
			--con-h5-font         : ' . wp_kses_post( constructionn_pro_get_font_family( $heading_five ) ) . ';
			--cnt-fs-h5           : ' . wp_kses_post( $heading_five['font_size'] ) . 'px;
			--con-h5-fontWeight   : ' . wp_kses_post( $heading_five['weight'] ) . ';
			--con-h5-textTransform: ' . wp_kses_post( $heading_five['transform'] ) . ';
		}';
		echo '</style>';
	}
endif;
add_action( 'wp_head', 'constructionn_pro_dynamic_values', 999 );
add_action( 'admin_print_styles', 'constructionn_pro_dynamic_values', 999 );

/**
 * Breadcrumb internal CSS
 */
add_action(
	'wp_head',
	function () {
		$style = '
    .breadcrumbs .trail-browse,
    .breadcrumbs .trail-items,
    .breadcrumbs .trail-items li {
        display:     inline-block;
        margin:      0;
        padding:     0;
        border:      none;
        background:  transparent;
        text-indent: 0;
    }

    .breadcrumbs .trail-browse {
        font-size:   inherit;
        font-style:  inherit;
        font-weight: inherit;
        color:       inherit;
    }

    .breadcrumbs .trail-items {
        list-style: none;
    }

        .trail-items li::after {
            content: "\002F";
            padding: 0 0.5em;
        }

        .trail-items li:last-of-type::after {
            display: none;
        }';

		$style = apply_filters( 'breadcrumb_trail_inline_style', trim( str_replace( array( "\r", "\n", "\t", '  ' ), '', $style ) ) );

		if ( $style ) {
			echo "\n" . '<style type="text/css" id="constructionn-pro-breadcrumbs-css">' . $style . '</style>' . "\n";
		}
	}
);
