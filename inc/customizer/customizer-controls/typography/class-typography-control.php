<?php
/**
 * The typography Customizer control.
 *
 * @package Constructionn_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'GL_Typography_Control' ) ) {
	/**
	 * Create the typography elements control.
	 *
	 * @since 2.0
	 */
	class GL_Typography_Control extends WP_Customize_Control {
		public $type = 'constructionn-pro-typography';

		public function enqueue() {
			wp_enqueue_script( 'constructionn-pro-typography-selectWoo', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/customizer-controls/typography/assets/selectWoo.min.js', array( 'customize-controls', 'jquery' ), CONSTRUCTIONN_PRO_VERSION, true );
			wp_enqueue_style( 'constructionn-pro-typography-selectWoo', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/customizer-controls/typography/assets/selectWoo.min.css', array(), CONSTRUCTIONN_PRO_VERSION );

			wp_enqueue_script( 'constructionn-pro-typography-customizer', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/customizer-controls/typography/assets/typography-customizer.js', array( 'customize-controls', 'constructionn-pro-typography-selectWoo' ), CONSTRUCTIONN_PRO_VERSION, true );
			wp_enqueue_style( 'constructionn-pro-typography-customizer', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/customizer-controls/typography/assets/typography-customizer.css', array(), CONSTRUCTIONN_PRO_VERSION );
		}

		public function to_json() {
			parent::to_json();

			$this->json['default_fonts_title'] = __( 'System fonts', 'constructionn-pro' );
			$this->json['google_fonts_title']  = __( 'Google fonts', 'constructionn-pro' );
			$this->json['default_fonts']       = constructionn_pro_typography_default_fonts();
			$this->json['family_title']        = esc_html__( 'Font family', 'constructionn-pro' );
			$this->json['weight_title']        = esc_html__( 'Font weight', 'constructionn-pro' );
			$this->json['transform_title']     = esc_html__( 'Text transform', 'constructionn-pro' );
			$this->json['category_title']      = '';
			$this->json['variant_title']       = esc_html__( 'Variants', 'constructionn-pro' );

			foreach ( $this->settings as $setting_key => $setting_id ) {
				$this->json[ $setting_key ] = array(
					'link'    => $this->get_link( $setting_key ),
					'value'   => $this->value( $setting_key ),
					'default' => isset( $setting_id->default ) ? $setting_id->default : '',
					'id'      => isset( $setting_id->id ) ? $setting_id->id : '',
				);

				if ( 'weight' === $setting_key ) {
					$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();
				}

				if ( 'transform' === $setting_key ) {
					$this->json[ $setting_key ]['choices'] = $this->get_font_transform_choices();
				}
			}
		}

		public function content_template() {
			?>
			<# if ( '' !== data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>
			<# if ( 'undefined' !== typeof ( data.family ) ) { #>
				<div class="constructionn-pro-font-family">
					<label>
						<select {{{ data.family.link }}} data-category="{{{ data.category.id }}}" data-variants="{{{ data.variant.id }}}" style="width:100%;">
							<optgroup label="{{ data.default_fonts_title }}">
								<# for ( var key in data.default_fonts ) { #>
									<# var name = data.default_fonts[ key ].split(',')[0]; #>
									<option value="{{ data.default_fonts[ key ] }}"  <# if ( data.default_fonts[ key ] === data.family.value ) { #>selected="selected"<# } #>>{{ name }}</option>
								<# } #>
							</optgroup>
							<optgroup label="{{ data.google_fonts_title }}">
								<# for ( var key in ConstructionProTypography.googleFonts ) { #>
									<option value="{{ ConstructionProTypography.googleFonts[ key ].name }}"  <# if ( ConstructionProTypography.googleFonts[ key ].name === data.family.value ) { #>selected="selected"<# } #>>{{ ConstructionProTypography.googleFonts[ key ].name }}</option>
								<# } #>
							</optgroup>
						</select>
						<# if ( '' !== data.family_title ) { #>
							<p class="description">{{ data.family_title }}</p>
						<# } #>
					</label>
				</div>
			<# } #>

			<# if ( 'undefined' !== typeof ( data.variant ) ) { #>
				<#
				var id = data.family.value.split(' ').join('_').toLowerCase();
				var font_data = ConstructionProTypography.googleFonts[id];
				var variants = '';
				if ( typeof font_data !== 'undefined' ) {
					variants = font_data.variants;
				}

				if ( null === data.variant.value ) {
					data.variant.value = data.variant.default;
				}
				#>
				<div id={{{ data.variant.id }}}" class="constructionn-pro-font-variant" data-saved-value="{{ data.variant.value }}">
					<label>
						<select name="{{{ data.variant.id }}}" multiple class="typography-multi-select" style="width:100%;" {{{ data.variant.link }}}>
							<# _.each( variants, function( label, choice ) { #>
								<option value="{{ label }}">{{ label }}</option>
							<# } ) #>
						</select>

						<# if ( '' !== data.variant_title ) { #>
							<p class="description">{{ data.variant_title }}</p>
						<# } #>
					</label>
				</div>
			<# } #>

			<# if ( 'undefined' !== typeof ( data.category ) ) { #>
				<div class="constructionn-pro-font-category">
					<label>
							<input name="{{{ data.category.id }}}" type="hidden" {{{ data.category.link }}} value="{{{ data.category.value }}}" class="gp-hidden-input" />
						<# if ( '' !== data.category_title ) { #>
							<p class="description">{{ data.category_title }}</p>
						<# } #>
					</label>
				</div>
			<# } #>

			<div class="constructionn-pro-weight-transform-wrapper">
				<# if ( 'undefined' !== typeof ( data.weight ) ) { #>
					<div class="constructionn-pro-font-weight">
						<label>
							<select {{{ data.weight.link }}}>

								<# _.each( data.weight.choices, function( label, choice ) { #>

									<option value="{{ choice }}" <# if ( choice === data.weight.value ) { #> selected="selected" <# } #>>{{ label }}</option>

								<# } ) #>

							</select>
							<# if ( '' !== data.weight_title ) { #>
								<p class="description">{{ data.weight_title }}</p>
							<# } #>
						</label>
					</div>
				<# } #>

				<# if ( 'undefined' !== typeof ( data.transform ) ) { #>
					<div class="constructionn-pro-font-transform">
						<label>
							<select {{{ data.transform.link }}}>

								<# _.each( data.transform.choices, function( label, choice ) { #>

									<option value="{{ choice }}" <# if ( choice === data.transform.value ) { #> selected="selected" <# } #>>{{ label }}</option>

								<# } ) #>

							</select>
							<# if ( '' !== data.transform_title ) { #>
								<p class="description">{{ data.transform_title }}</p>
							<# } #>
						</label>
					</div>
				<# } #>
			</div>
			<?php
		}

		public function get_font_weight_choices() {
			return array(
				'normal' => esc_html( 'normal' ),
				'bold'   => esc_html( 'bold' ),
				'100'    => esc_html( '100' ),
				'200'    => esc_html( '200' ),
				'300'    => esc_html( '300' ),
				'400'    => esc_html( '400' ),
				'500'    => esc_html( '500' ),
				'600'    => esc_html( '600' ),
				'700'    => esc_html( '700' ),
				'800'    => esc_html( '800' ),
				'900'    => esc_html( '900' ),
			);
		}

		public function get_font_transform_choices() {
			return array(
				'none'       => esc_html( 'none' ),
				'capitalize' => esc_html( 'capitalize' ),
				'uppercase'  => esc_html( 'uppercase' ),
				'lowercase'  => esc_html( 'lowercase' ),
			);
		}
	}
}
