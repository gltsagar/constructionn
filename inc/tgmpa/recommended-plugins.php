<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'constructionn_pro_register_required_plugins' );
function constructionn_pro_register_required_plugins() {
	$plugins = array(
		array(
			'name'               => __( 'GL BLocks', 'constructionn-pro' ),
			'slug'               => 'gl-blocks',
			'source'             => get_template_directory() . '/inc/plugins/gl-blocks.zip',
			'required'           => true,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),
		array(
			'name'     => __( 'Regenerate Thumbnails', 'constructionn-pro' ),
			'slug'     => 'regenerate-thumbnails',
			'required' => false,
		),
		array(
			'name'     => __( 'One Click Demo Import', 'constructionn-pro' ),
			'slug'     => 'one-click-demo-import',
			'required' => false,
		),
		array(
			'name'     => __( 'Contact Form 7', 'constructionn-pro' ),
			'slug'     => 'contact-form-7',
			'required' => false,
		),
		array(
			'name'     => __( 'MailPoet – Newsletters, Email Marketing, and Automation', 'constructionn-pro' ),
			'slug'     => 'mailpoet',
			'required' => false,
		),
	);

	$config = array(
		'id'           => 'constructionn-pro',      // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
