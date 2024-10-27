<?php
if ( class_exists( 'WP_Customize_Control' ) ) {
	/**
	 * Notice Control for WordPress Customizer.
	 */
	class GL_Notice_Control extends WP_Customize_Control {

		/**
		 * Control type.
		 *
		 * @var string
		 */
		public $type = 'gl-notice';

		/**
		 * Label for the notice control.
		 *
		 * @var string
		 */
		public $label = '';

		/**
		 * Description for the notice control.
		 *
		 * @var string
		 */
		public $description = '';

		/**
		 * Enqueue control related scripts/styles.
		 */
		public function enqueue() {
			wp_enqueue_style( 'radio-image-control-styles', get_template_directory_uri() . '/inc/customizer/customizer-controls/notice/notice.css' );
		}

		/**
		 * Render the control's content.
		 */
		public function render_content() {
			$allowed_html = array(
				'a'      => array(
					'href'   => array(),
					'title'  => array(),
					'class'  => array(),
					'target' => array(),
				),
				'br'     => array(),
				'em'     => array(),
				'strong' => array(),
				'i'      => array(
					'class' => array(),
				),
				'span'   => array(
					'class' => array(),
				),
				'code'   => array(),
			);
			?>
		<div class="gl-notice">
			<?php if ( ! empty( $this->label ) ) { ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php } ?>
			<?php if ( ! empty( $this->description ) ) { ?>
				<span class="customize-control-description"><?php echo wp_kses( $this->description, $allowed_html ); ?></span>
			<?php } ?>
		</div>
			<?php
		}
	}

}

