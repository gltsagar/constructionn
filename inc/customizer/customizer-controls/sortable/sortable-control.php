<?php
/**
 * Constructionn Pro Customizer Sortable Control.
 *
 * @package Constructionn_Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'GL_Sortable_Control' ) ) {
	class GL_Sortable_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'gl_sortable_pill_checkbox';
		/**
		 * Define whether the pills can be sorted using drag 'n drop. Either false or true. Default = false
		 */
		private $sortable = true;

		/**
		 * Constructor
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
			// Check if these pills are sortable
			if ( isset( $this->input_attrs['sortable'] ) && $this->input_attrs['sortable'] ) {
				$this->sortable = true;
			}
		}

		public function enqueue() {
			wp_enqueue_style( 'constructionn-pro-sortable-pill', get_template_directory_uri() . '/inc/customizer/customizer-controls/sortable/sortable.css' );
			wp_enqueue_script( 'constructionn-pro-sortable-pill', get_template_directory_uri() . '/inc/customizer/customizer-controls/sortable/sortable.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ), false, true );
		}
		public function render_content() {
			$reordered_choices = array();
			$saved_choices     = explode( ',', esc_attr( $this->value() ) );

			if ( $this->sortable ) {
				foreach ( $saved_choices as $key => $value ) {
					if ( isset( $this->choices[ $value ] ) ) {
						$reordered_choices[ $value ] = $this->choices[ $value ];
					}
				}
				$reordered_choices = array_merge( $reordered_choices, array_diff_assoc( $this->choices, $reordered_choices ) );
			} else {
				$reordered_choices = $this->choices;
			}
			?>
			<div class="gl_sortable_pill_checkbox_control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-sortable-pill-checkbox" <?php $this->link(); ?> />
				<div class="sortable_pills<?php echo ( $this->sortable ? ' sortable' : '' ); ?>">
				<?php foreach ( $reordered_choices as $key => $value ) { ?>
					<label class="checkbox-label">
						<input type="checkbox" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php checked( in_array( esc_attr( $key ), $saved_choices, true ), true ); ?> class="sortable-pill-checkbox"/>
						<span class="sortable-pill-title"><?php echo esc_html( $value ); ?></span>
						<?php if ( $this->sortable ) { ?>
							<span class="dashicons dashicons-sort gl-d-sort"></span>
						<?php } ?>
					</label>
				<?php } ?>
				</div>
			</div>
			<?php
		}
	}
}

