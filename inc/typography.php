<?php
/**
 * Constructionn Pro Typography Related Functions
 *
 * @package Constructionn_Pro
 */
/**
 * Google Fonts
 */
if ( ! function_exists( 'constructionn_pro_get_all_google_fonts' ) ) :

	function constructionn_pro_get_all_google_fonts() {

		$google_fonts = get_template_directory() . '/inc/google-fonts-lists.php';
		$gflists      = include $google_fonts;

		$fonts = array();

		foreach ( $gflists as $googlefont ) {
			$data         = array(
				'name'     => $googlefont['family'],
				'category' => $googlefont['category'],
				'variants' => $googlefont['variants'],
			);
			$id           = strtolower( str_replace( ' ', '_', $googlefont['family'] ) );
			$fonts[ $id ] = $data;

		}

		if ( apply_filters( 'constructionn_pro_alphabetical_orders', true ) ) {
			asort( $fonts );
		}

		return apply_filters( 'constructionn_pro_google_fonts_array', $fonts );
	}
endif;

if ( ! function_exists( 'constructionn_pro_typography_default_fonts' ) ) :
	/**
	 * Set the default system fonts.
	 */
	function constructionn_pro_typography_default_fonts() {
		$fonts = array(
			'System Stack',
			'Arial, Helvetica, sans-serif',
			'Century Gothic',
			'Comic Sans MS',
			'Courier New',
			'Georgia, Times New Roman, Times, serif',
			'Helvetica',
			'Impact',
			'Lucida Console',
			'Lucida Sans Unicode',
			'Palatino Linotype',
			'Segoe UI, Helvetica Neue, Helvetica, sans-serif',
			'Tahoma, Geneva, sans-serif',
			'Trebuchet MS, Helvetica, sans-serif',
			'Verdana, Geneva, sans-serif',
		);

		return apply_filters( 'constructionn_pro_typography_default_fonts', $fonts );
	}
endif;

if ( ! function_exists( 'constructionn_pro_get_font_family' ) ) :
	/**
	 * Get font family
	 */
	function constructionn_pro_get_font_family( $font ) {
		$output    = '';
		$no_quotes = array(
			'inherit',
			'Arial, Helvetica, sans-serif',
			'Georgia, Times New Roman, Times, serif',
			'Helvetica',
			'Impact',
			'Segoe UI, Helvetica Neue, Helvetica, sans-serif',
			'Tahoma, Geneva, sans-serif',
			'Trebuchet MS, Helvetica, sans-serif',
			'Verdana, Geneva, sans-serif',
		);

		if ( $font['family'] === 'System Stack' ) {
			$output = apply_filters( 'constructionn_pro_typography_system_stack', '-apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"' );
		} else {
			if ( in_array( $font['family'], $no_quotes ) || ( $font['family'] === 'System Stack' ) ) {
				$wrapper_start = null;
				$wrapper_end   = null;
			} else {
				$wrapper_start = '"';
				$wrapper_end   = ( $font['category'] ) ? '", ' . $font['category'] : '"';
			}
			$output = $wrapper_start . $font['family'] . $wrapper_end;
		}

		return $output;
	}
endif;

if ( ! function_exists( 'constructionn_pro_google_fonts_url' ) ) :
	/**
	 * Google Fonts url
	 */
	function constructionn_pro_google_fonts_url() {
		$defaults  = constructionn_pro_get_typography_defaults();
		$fonts_url = '';
		$settings  = array();

		$settings['primary_font'] = wp_parse_args( get_theme_mod( 'primary_font' ), $defaults['primary_font'] );

		$settings['heading_one']   = wp_parse_args( get_theme_mod( 'heading_one' ), $defaults['heading_one'] );
		$settings['heading_two']   = wp_parse_args( get_theme_mod( 'heading_two' ), $defaults['heading_two'] );
		$settings['heading_three'] = wp_parse_args( get_theme_mod( 'heading_three' ), $defaults['heading_three'] );
		$settings['heading_four']  = wp_parse_args( get_theme_mod( 'heading_four' ), $defaults['heading_four'] );
		$settings['heading_five']  = wp_parse_args( get_theme_mod( 'heading_five' ), $defaults['heading_five'] );

		$not_google = str_replace( ' ', '+', constructionn_pro_typography_default_fonts() );

		$font_settings = array(
			'primary_font',
			'heading_one',
			'heading_two',
			'heading_three',
			'heading_four',
			'heading_five',
		);

		$google_fonts = array();

		foreach ( $font_settings as $key ) {

			$value = str_replace( ' ', '+', $settings[ $key ]['family'] );

			$variants = $settings[ $key ]['variants'];

			$value = ! empty( $variants ) ? $value . ':' . $variants : $value;

			// Make sure we don't add the same font twice.
			if ( ! in_array( $value, $google_fonts ) ) {
				$google_fonts[] = $value;
			}
		}

		// Ignore any non-Google fonts.
		$google_fonts = array_diff( $google_fonts, $not_google );

		$google_fonts = implode( '|', $google_fonts );

		$google_fonts = apply_filters( 'constructionn_pro_typography_google_fonts', $google_fonts );

		$subset = apply_filters( 'constructionn_pro_fonts_subset', '' );

		$font_args           = array();
		$font_args['family'] = $google_fonts;

		if ( '' !== $subset ) {
			$font_args['subset'] = rawurlencode( $subset );
		}

		$display = apply_filters( 'constructionn_pro_google_font_display', 'swap' );

		if ( $display ) {
			$font_args['display'] = $display;
		}

		if ( $google_fonts ) {
			$fonts_url = add_query_arg( $font_args, '//fonts.googleapis.com/css' );
		}

		if ( get_theme_mod( 'toggle_localgoogle_fonts', false ) ) {
			$fonts_url = constructionn_pro_get_webfont_url( add_query_arg( $font_args, 'https://fonts.googleapis.com/css' ) );
		}

		return esc_url( $fonts_url );
	}
endif;

if ( ! function_exists( 'constructionn_pro_get_all_google_fonts_ajax' ) ) :
	/**
	 * Return an array of all of our Google Fonts.
	 */
	function constructionn_pro_get_all_google_fonts_ajax() {
		// Bail if the nonce doesn't check out
		if ( ! isset( $_POST['constructionn_pro_customize_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['constructionn_pro_customize_nonce'] ), 'constructionn_pro_customize_nonce' ) ) {
			wp_die();
		}

		// Do another nonce check
		check_ajax_referer( 'constructionn_pro_customize_nonce', 'constructionn_pro_customize_nonce' );

		// Bail if user can't edit theme options
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			wp_die();
		}

		// Get all of our fonts
		$fonts = constructionn_pro_get_all_google_fonts();

		// Send all of our fonts in JSON format
		echo wp_json_encode( $fonts );

		// Exit
		die();
	}
endif;
add_action( 'wp_ajax_constructionn_pro_gf_lists', 'constructionn_pro_get_all_google_fonts_ajax' );

if ( ! function_exists( 'constructionn_pro_get_typography_defaults' ) ) :
	/**
	 * Typography Defaults
	 */
	function constructionn_pro_get_typography_defaults() {
		$defaults = array(
			'primary_font'  => array(
				'family'    => 'Manrope',
				'variants'  => '400,500,700',
				'category'  => '',
				'weight'    => '400',
				'transform' => 'none',
				'font_size' => 16,
			),

			'heading_one'   => array(
				'family'    => 'Manrope',
				'variants'  => '400,600,500,700,300',
				'category'  => '',
				'weight'    => '700',
				'transform' => 'none',
				'font_size' => '56',
			),
			'heading_two'   => array(
				'family'    => 'Manrope',
				'variants'  => '400,600,500,700,300',
				'category'  => '',
				'weight'    => '700',
				'transform' => 'none',
				'font_size' => '40',
			),
			'heading_three' => array(
				'family'    => 'Manrope',
				'variants'  => '400,600,500,700,300',
				'category'  => '',
				'weight'    => '700',
				'transform' => 'none',
				'font_size' => '32',
			),
			'heading_four'  => array(
				'family'    => 'Manrope',
				'variants'  => '400,600,500,700,300',
				'category'  => '',
				'weight'    => '500',
				'transform' => 'none',
				'font_size' => '24',
			),
			'heading_five'  => array(
				'family'    => 'Manrope',
				'variants'  => '400,600,500,700,300',
				'category'  => '',
				'weight'    => '500',
				'transform' => 'none',
				'font_size' => '18',
			),
		);

		return apply_filters( 'constructionn_pro_typography_options_defaults', $defaults );
	}
endif;
