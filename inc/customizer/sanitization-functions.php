<?php
/**
 * Sanitization Functions
 *
 * @package constructionn
 */
if ( ! function_exists( 'constructionn_sanitize_empty_absint' ) ) :
	/**
	 * Sanitizes Empty Absint
	 */
	function constructionn_sanitize_empty_absint( $input ) {
		if ( '' == $input ) {
			return '';
		}
		return absint( $input );
	}
endif;

if ( ! function_exists( 'constructionn_sanitize_variants' ) ) :
	/**
	 * Sanitize our Google Font variants
	 */
	function constructionn_sanitize_variants( $input ) {
		if ( is_array( $input ) ) {
			$input = implode( ',', $input );
		}
		return sanitize_text_field( $input );
	}
endif;

if ( ! function_exists( 'constructionn_sanitize_checkbox' ) ) :
	/**
	 * Sanitize Checkbox
	 */
	function constructionn_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
endif;

if ( ! function_exists( 'constructionn_sanitize_hex_color' ) ) {
	/**
	 * Function for sanitizing Hex color
	 */
	function constructionn_sanitize_hex_color( $color ) {
		if ( '' === $color ) {
			return '';
		}

		// 3 or 6 hex digits, or the empty string.
		if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
			return $color;
		}
	}
}

if ( ! function_exists( 'constructionn_radio_sanitization_header' ) ) {
	/**
	 * Function for Sanitization Header
	 */
	function constructionn_radio_sanitization_header( $input, $setting ) {
		// get the list of possible radio box or select options
		$choices = $setting->manager->get_control( $setting->id )->choices;
		if ( array_key_exists( $input, $choices ) ) {
			return $input;
		} else {
			return $setting->default;
		}
	}
}

if ( ! function_exists( 'constructionn_sortable_sanitization' ) ) {
	/**
	 * Function for Sanitizing Sortable
	 */
	function constructionn_sortable_sanitization( $input ) {
		if ( strpos( $input, ',' ) !== false ) {
			$input = explode( ',', $input );
		}
		if ( is_array( $input ) ) {
			foreach ( $input as $key => $value ) {
				$input[ $key ] = sanitize_text_field( $value );
			}
			$input = implode( ',', $input );
		} else {
			$input = sanitize_text_field( $input );
		}
		return $input;
	}
}

if ( ! function_exists( 'constructionn_sanitize_code' ) ) :
	/**
	 * Function for Sanitizing Code
	 */
	function constructionn_sanitize_code( $value ) {
		return htmlspecialchars_decode( stripslashes( $value ) );
	}
endif;
