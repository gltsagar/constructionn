<?php
/**
 * Functions which enhance the theme by hooking into WordPress core actions/hooks
 *
 * @package Constructionn_Pro
 */
if ( ! function_exists( 'constructionn_pro_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function constructionn_pro_setup() {
		/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on constructionn_pro, use a find and replace
		* to change 'constructionn-pro' to the name of your theme in all the template files.
		*/
		load_theme_textdomain( 'constructionn-pro', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support( 'title-tag' );

		/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary'     => esc_html__( 'Primary', 'constructionn-pro' ),
				'secondary'   => esc_html__( 'Secondary', 'constructionn-pro' ),
				'footer-menu' => esc_html__( 'Footer Navigation', 'constructionn-pro' ),
			)
		);

		/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'constructionn_pro_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'appearance-tools' );
		add_theme_support( 'border' );
		add_theme_support( 'custom-spacing' );
		add_theme_support( 'custom-line-height' );
		add_theme_support( 'link-color' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'editor-styles' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
		/**
		 * Registering new image sizes
		 */

		add_image_size( 'blog_card_image', 371, 216, true );

		add_image_size( 'about_image_size', 520, 770, true );
		add_image_size( 'custom_medium_img', '248', '320', true );
		add_image_size( 'banner_three_img', '720', '796', true );
		add_image_size( 'testimonial_img', '48', '48', true );
		add_image_size( 'casestudy_img', 546, 395, true );
		add_image_size( 'team_sidebar_image', 350, 328, true );

		add_image_size( 'about_img_one', 350, 328, true ); // needed for frontabout image one
		add_image_size( 'about_img_two', 350, 328, true ); // needed for frontabout image two
		add_image_size( 'service_img', 592, 680, true ); // needed for frontsservice image
		add_image_size( 'team_custom_img', 371, 420, true ); // needed for frontsservice image

		// Remove core block patterns
		remove_theme_support( 'core-block-patterns' );
		/**
		 * Set up the WordPress core custom header feature.
		 *
		 * @uses constructionn_pro_header_style()
		 */

		add_theme_support(
			'custom-header',
			apply_filters(
				'constructionn_pro_custom_header_args',
				array(
					'default-image'      => esc_url( get_template_directory_uri() . '/assets/images/static-banner.jpg' ),
					'video'              => true,
					'default-text-color' => '000000',
					'width'              => 1920,
					'height'             => 720,
					'flex-height'        => true,
					'wp-head-callback'   => 'constructionn_pro_header_style',
					'header-text'        => true, // show the checkbox to display/hide site ttile and tagline
				)
			)
		);

		/**
		 * Set the content width in pixels, based on the theme's design and stylesheet.
		 *
		 * Priority 0 to make it available to lower priority callbacks.
		 *
		 * @global int $content_width
		 */
		$GLOBALS['content_width'] = apply_filters( 'constructionn_pro_content_width', 800 );
	}
endif;
add_action( 'after_setup_theme', 'constructionn_pro_setup' );

if ( ! function_exists( 'constructionn_pro_scripts' ) ) :
	/**
	 * Enqueue scripts and styles.
	 */
	function constructionn_pro_scripts() {
		// Use minified libraries if SCRIPT_DEBUG is false
		$build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? 'unminify/' : '';
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		wp_enqueue_style( 'constructionn-pro-google-fonts', constructionn_pro_google_fonts_url(), array(), null );
		wp_style_add_data( 'constructionn-pro-style', 'rtl', 'replace' );
		wp_enqueue_style( 'constructionn-pro-swiper', get_template_directory_uri() . '/assets/css/' . $build . 'swiper' . $suffix . '.css', array(), CONSTRUCTIONN_PRO_VERSION, false );
		wp_enqueue_style( 'constructionn-pro-styles', get_template_directory_uri() . '/assets/css/' . $build . 'style' . $suffix . '.css', array(), CONSTRUCTIONN_PRO_VERSION, false );
		wp_enqueue_style( 'constructionn-pro-fancybox-style', get_template_directory_uri() . '/assets/css/' . $build . 'fancybox' . $suffix . '.css', array(), CONSTRUCTIONN_PRO_VERSION, false );
		wp_enqueue_style( 'constructionn-pro-fonts', get_template_directory_uri() . '/assets/css/' . $build . 'fonts' . $suffix . '.css', array(), CONSTRUCTIONN_PRO_VERSION, false );

		wp_enqueue_style( 'constructionn-pro-style', get_stylesheet_uri(), array(), CONSTRUCTIONN_PRO_VERSION );

		if ( constructionn_pro_woo_boolean() ) {
			wp_enqueue_style( 'constructionn-pro-woo', get_template_directory_uri() . '/assets/css/' . $build . 'woo' . $suffix . '.css', array(), CONSTRUCTIONN_PRO_VERSION );
		}
		wp_enqueue_script( 'constructionn-pro-swiper-bundle', get_template_directory_uri() . '/assets/js/' . $build . 'swiper-bundle' . $suffix . '.js', array( 'jquery' ), CONSTRUCTIONN_PRO_VERSION, true );
		// wp_enqueue_script( 'constructionn-pro-swiper-bundle', get_template_directory_uri() . '/assets/js/unminify/swiper-bundle.min.js', array( 'jquery' ), CONSTRUCTIONN_PRO_VERSION, true );
		wp_enqueue_script( 'constructionn-pro-swiper-custom', get_template_directory_uri() . '/assets/js/' . $build . 'swiper-custom' . $suffix . '.js', array( 'jquery' ), CONSTRUCTIONN_PRO_VERSION, true );
		// wp_enqueue_script( 'constructionn-pro-swiper-custom', get_template_directory_uri() . '/assets/js/unminify/swiper-custom.js', array( 'jquery' ), CONSTRUCTIONN_PRO_VERSION, true );

		wp_enqueue_script( 'constructionn-pro-fancybox', get_template_directory_uri() . '/assets/js/' . $build . 'fancybox.umd' . $suffix . '.js', array( 'jquery' ), CONSTRUCTIONN_PRO_VERSION, true );
		// wp_enqueue_script( 'constructionn-pro-fancybox', get_template_directory_uri() . '/assets/js/unminify/fancybox.umd.js', array( 'jquery' ), CONSTRUCTIONN_PRO_VERSION, true );
		wp_enqueue_script( 'constructionn-pro-custom', get_template_directory_uri() . '/assets/js/' . $build . 'custom' . $suffix . '.js', array( 'jquery' ), CONSTRUCTIONN_PRO_VERSION, true );

		wp_enqueue_script( 'constructionn-pro-navigation', get_template_directory_uri() . '/js/' . $build . 'navigation' . $suffix . '.js', array( 'jquery' ), CONSTRUCTIONN_PRO_VERSION, true );

		// // Enqueue the custom script first
		// wp_enqueue_script(
		// 'constructionn-pro-custom',
		// get_template_directory_uri() . '/assets/js/' . $build . 'index' . $suffix . '.js',
		// array( 'jquery' ),
		// CONSTRUCTIONN_PRO_VERSION,
		// true // Load in the footer
		// );
		wp_localize_script(
			'constructionn-pro-custom',
			'constructionn_pro_data',
			array(
				'rtl' => is_rtl(),
			)
		);

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'constructionn_pro_scripts' );

if ( ! function_exists( 'constructionn_pro_enqueue_backend_styles' ) ) :
	/**
	 * Enqueuing styles and scripts for Backend
	 *
	 * @return void
	 */
	function constructionn_pro_enqueue_backend_styles() {
		// Use minified libraries if SCRIPT_DEBUG is false
		$build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? 'unminify/' : '';
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		wp_enqueue_style( 'constructionn-pro-editor-styles', get_template_directory_uri() . '/assets/css/' . $build . 'editor-style' . $suffix . '.css', array(), CONSTRUCTIONN_PRO_VERSION, false );

		wp_enqueue_script(
			'constructionn-pro-admin-scripts',
			get_template_directory_uri() . '/assets/js/' . $build . 'admin' . $suffix . '.js',
			array( 'jquery' ),
			CONSTRUCTIONN_PRO_VERSION,
			true
		);
		wp_localize_script(
			'constructionn-pro-admin-scripts',
			'constructionn_pro_admin_data',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce'    => wp_create_nonce( 'dismiss_notice_nonce' ),
			)
		);
	}
endif;
add_action( 'admin_enqueue_scripts', 'constructionn_pro_enqueue_backend_styles' );

if ( ! function_exists( 'constructionn_pro_body_classes' ) ) :
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	function constructionn_pro_body_classes( $classes ) {
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		if ( is_404() ) {
			$key = array_search( 'error404', $classes );
			// remove error404 class from body as it is send to the div wrapper
			if ( false !== $key ) {
				unset( $classes[ $key ] );
			}
		}

		// Adds a class of gl-full-wrap when there is no sidebar present.
		if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
			$classes[] = 'layout-two';
		}
		if ( is_singular() || is_archive() || is_search() || is_home() ) {
			$classes[] = constructionn_pro_sidebar_layout();
		}
		if ( get_post_type() === 'project' ) {
			$classes[] = 'single-projects';
		}
		if ( get_post_type() === 'service' ) {
			$classes[] = 'single-services';
		}

		return $classes;
	}
endif;
add_filter( 'body_class', 'constructionn_pro_body_classes' );

if ( ! function_exists( 'constructionn_pro_widgets_init' ) ) :
	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function constructionn_pro_widgets_init() {
		$sidebars = array(
			'primary-sidebar' => array(
				'name'        => esc_html__( 'Primary Sidebar', 'constructionn-pro' ),
				'id'          => 'primary-sidebar',
				'description' => esc_html__( 'Primary Sidebar', 'constructionn-pro' ),
			),
			'footer-one'      => array(
				'name'        => esc_html__( 'Footer One', 'constructionn-pro' ),
				'id'          => 'footer-one',
				'description' => esc_html__( 'Add footer one widgets here.', 'constructionn-pro' ),
			),
			'footer-two'      => array(
				'name'        => esc_html__( 'Footer Two', 'constructionn-pro' ),
				'id'          => 'footer-two',
				'description' => esc_html__( 'Add footer two widgets here.', 'constructionn-pro' ),
			),
			'footer-three'    => array(
				'name'        => esc_html__( 'Footer Three', 'constructionn-pro' ),
				'id'          => 'footer-three',
				'description' => esc_html__( 'Add footer three widgets here.', 'constructionn-pro' ),
			),
			'footer-four'     => array(
				'name'        => esc_html__( 'Footer Four', 'constructionn-pro' ),
				'id'          => 'footer-four',
				'description' => esc_html__( 'Add footer four widgets here.', 'constructionn-pro' ),
			),
		);
		foreach ( $sidebars as $sidebar ) {
			register_sidebar(
				array(
					'name'          => esc_html( $sidebar['name'] ),
					'id'            => esc_attr( $sidebar['id'] ),
					'description'   => esc_html( $sidebar['description'] ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h5 class="widget-title" itemprop="name">',
					'after_title'   => '</h5>',
				)
			);
		}
	}
endif;
add_action( 'widgets_init', 'constructionn_pro_widgets_init' );

if ( ! function_exists( 'constructionn_pro_archive_title_prefix' ) ) {
	/**
	 * Function to modify the archive title
	 */
	function constructionn_pro_archive_title_prefix( $title ) {
		$archive_prefix = get_theme_mod( 'mp_archive_prefix', true );
		if ( is_post_type_archive( 'product' ) ) {
			$title = get_the_title( get_option( 'woocommerce_shop_page_id' ) );
		} elseif ( $archive_prefix ) {
			if ( is_category() ) {
				$title = single_cat_title( '', false );
			} elseif ( is_tag() ) {
				$title = single_tag_title( '', false );
			} elseif ( is_author() ) {
				$title = '<span class="vcard">' . get_the_author() . '</span>';
			} elseif ( is_year() ) {
				$title = get_the_date( __( 'Y', 'constructionn-pro' ) );
			} elseif ( is_month() ) {
				$title = get_the_date( __( 'F Y', 'constructionn-pro' ) );
			} elseif ( is_day() ) {
				$title = get_the_date( __( 'F j, Y', 'constructionn-pro' ) );
			} elseif ( is_post_type_archive() ) {
				$title = post_type_archive_title( '', false );
			} elseif ( is_tax() ) {
				$tax   = get_taxonomy( get_queried_object()->taxonomy );
				$title = single_term_title( '', false );
			}
		}
		return $title;
	}
}
add_filter( 'get_the_archive_title', 'constructionn_pro_archive_title_prefix' );


if ( ! function_exists( 'constructionn_pro_create_cpt' ) ) {
	function constructionn_pro_create_cpt() {
		$teamargs = array(
			'label'               => __( 'Teams', 'constructionn-pro' ),
			'description'         => __( 'Team news and reviews', 'constructionn-pro' ),
			'labels'              => array(
				'name'               => _x( 'Teams', 'Post Type General Name', 'constructionn-pro' ),
				'singular_name'      => _x( 'Team', 'Post Type Singular Name', 'constructionn-pro' ),
				'menu_name'          => __( 'Teams', 'constructionn-pro' ),
				'parent_item_colon'  => __( 'Parent Team', 'constructionn-pro' ),
				'all_items'          => __( 'All Teams', 'constructionn-pro' ),
				'view_item'          => __( 'View Team', 'constructionn-pro' ),
				'add_new_item'       => __( 'Add New Team', 'constructionn-pro' ),
				'add_new'            => __( 'Add New', 'constructionn-pro' ),
				'edit_item'          => __( 'Edit Team', 'constructionn-pro' ),
				'update_item'        => __( 'Update Team', 'constructionn-pro' ),
				'search_items'       => __( 'Search Team', 'constructionn-pro' ),
				'not_found'          => __( 'Not Found', 'constructionn-pro' ),
				'not_found_in_trash' => __( 'Not found in Trash', 'constructionn-pro' ),
			),
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields' ),
			'taxonomies'          => array( 'genres' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest'        => true,
			'menu_icon'           => 'dashicons-groups',
			'rewrite'             => array( 'slug' => get_theme_mod( 'cpt_slug_team', __( 'team', 'constructionn-pro' ) ) ),
		);

		$serviceargs = array(
			'label'               => __( 'Services', 'constructionn-pro' ),
			'description'         => __( 'Service', 'constructionn-pro' ),
			'labels'              => array(
				'name'               => _x( 'Services', 'Post Type General Name', 'constructionn-pro' ),
				'singular_name'      => _x( 'Service', 'Post Type Singular Name', 'constructionn-pro' ),
				'menu_name'          => __( 'Services', 'constructionn-pro' ),
				'parent_item_colon'  => __( 'Parent Service', 'constructionn-pro' ),
				'all_items'          => __( 'All Services', 'constructionn-pro' ),
				'view_item'          => __( 'View Service', 'constructionn-pro' ),
				'add_new_item'       => __( 'Add New Service', 'constructionn-pro' ),
				'add_new'            => __( 'Add New', 'constructionn-pro' ),
				'edit_item'          => __( 'Edit Service', 'constructionn-pro' ),
				'update_item'        => __( 'Update Service', 'constructionn-pro' ),
				'search_items'       => __( 'Search Service', 'constructionn-pro' ),
				'not_found'          => __( 'Not Found', 'constructionn-pro' ),
				'not_found_in_trash' => __( 'Not found in Trash', 'constructionn-pro' ),
			),
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields' ),
			'taxonomies'          => array( 'genres' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest'        => true,
			'menu_icon'           => 'dashicons-open-folder',
			'rewrite'             => array( 'slug' => get_theme_mod( 'cpt_slug_service', __( 'service', 'constructionn-pro' ) ) ),
		);

		$projectargs = array(
			'label'               => __( 'Projects', 'constructionn-pro' ),
			'description'         => __( 'Project', 'constructionn-pro' ),
			'labels'              => array(
				'name'               => _x( 'Projects', 'Post Type General Name', 'constructionn-pro' ),
				'singular_name'      => _x( 'Project', 'Post Type Singular Name', 'constructionn-pro' ),
				'menu_name'          => __( 'Projects', 'constructionn-pro' ),
				'parent_item_colon'  => __( 'Parent Project', 'constructionn-pro' ),
				'all_items'          => __( 'All Projects', 'constructionn-pro' ),
				'view_item'          => __( 'View Project', 'constructionn-pro' ),
				'add_new_item'       => __( 'Add New Project', 'constructionn-pro' ),
				'add_new'            => __( 'Add New', 'constructionn-pro' ),
				'edit_item'          => __( 'Edit Project', 'constructionn-pro' ),
				'update_item'        => __( 'Update Project', 'constructionn-pro' ),
				'search_items'       => __( 'Search Project', 'constructionn-pro' ),
				'not_found'          => __( 'Not Found', 'constructionn-pro' ),
				'not_found_in_trash' => __( 'Not found in Trash', 'constructionn-pro' ),
			),
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields' ),
			'taxonomies'          => array( 'genres' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest'        => true,
			'menu_icon'           => 'dashicons-open-folder',
			'rewrite'             => array( 'slug' => get_theme_mod( 'cpt_slug_project', __( 'project', 'constructionn-pro' ) ) ),
		);

		$casestudiesargs = array(
			'label'               => __( 'Case Studies', 'constructionn-pro' ),
			'description'         => __( 'Case Study', 'constructionn-pro' ),
			'labels'              => array(
				'name'               => _x( 'Case Studies', 'Post Type General Name', 'constructionn-pro' ),
				'singular_name'      => _x( 'Case Study', 'Post Type Singular Name', 'constructionn-pro' ),
				'menu_name'          => __( 'Case Study', 'constructionn-pro' ),
				'parent_item_colon'  => __( 'Parent Case Study', 'constructionn-pro' ),
				'all_items'          => __( 'All Case Studies', 'constructionn-pro' ),
				'view_item'          => __( 'View Case Study', 'constructionn-pro' ),
				'add_new_item'       => __( 'Add New Case Study', 'constructionn-pro' ),
				'add_new'            => __( 'Add New', 'constructionn-pro' ),
				'edit_item'          => __( 'Edit Case Study', 'constructionn-pro' ),
				'update_item'        => __( 'Update Case Study', 'constructionn-pro' ),
				'search_items'       => __( 'Search Case Study', 'constructionn-pro' ),
				'not_found'          => __( 'Not Found', 'constructionn-pro' ),
				'not_found_in_trash' => __( 'Not found in Trash', 'constructionn-pro' ),
			),
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields' ),
			'taxonomies'          => array( 'genres' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest'        => true,
			'menu_icon'           => 'dashicons-welcome-learn-more',
			'rewrite'             => array( 'slug' => get_theme_mod( 'cpt_slug_case_study', __( 'case-study', 'constructionn-pro' ) ) ),
		);

		$testimonialargs = array(
			'label'               => __( 'Testimonials', 'constructionn-pro' ),
			'description'         => __( 'Testimonial', 'constructionn-pro' ),
			'labels'              => array(
				'name'               => _x( 'Testimonials', 'Post Type General Name', 'constructionn-pro' ),
				'singular_name'      => _x( 'Testimonial', 'Post Type Singular Name', 'constructionn-pro' ),
				'menu_name'          => __( 'Testimonials', 'constructionn-pro' ),
				'parent_item_colon'  => __( 'Parent Testimonial', 'constructionn-pro' ),
				'all_items'          => __( 'All Testimonials', 'constructionn-pro' ),
				'view_item'          => __( 'View Testimonial', 'constructionn-pro' ),
				'add_new_item'       => __( 'Add New Testimonial', 'constructionn-pro' ),
				'add_new'            => __( 'Add New', 'constructionn-pro' ),
				'edit_item'          => __( 'Edit Testimonial', 'constructionn-pro' ),
				'update_item'        => __( 'Update Testimonial', 'constructionn-pro' ),
				'search_items'       => __( 'Search Testimonial', 'constructionn-pro' ),
				'not_found'          => __( 'Not Found', 'constructionn-pro' ),
				'not_found_in_trash' => __( 'Not found in Trash', 'constructionn-pro' ),
			),
			'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => false,
			'capability_type'     => 'post',
			'show_in_rest'        => true,
			'menu_icon'           => 'dashicons-testimonial',
			'rewrite'             => false,
		);

		$faqargs = array(
			'label'               => __( 'Faqs', 'constructionn-pro' ),
			'description'         => __( 'Faq', 'constructionn-pro' ),
			'labels'              => array(
				'name'               => _x( 'Faqs', 'Post Type General Name', 'constructionn-pro' ),
				'singular_name'      => _x( 'Faq', 'Post Type Singular Name', 'constructionn-pro' ),
				'menu_name'          => __( 'Faqs', 'constructionn-pro' ),
				'parent_item_colon'  => __( 'Parent Faq', 'constructionn-pro' ),
				'all_items'          => __( 'All Faqs', 'constructionn-pro' ),
				'view_item'          => __( 'View Faq', 'constructionn-pro' ),
				'add_new_item'       => __( 'Add New Faq', 'constructionn-pro' ),
				'add_new'            => __( 'Add New', 'constructionn-pro' ),
				'edit_item'          => __( 'Edit Faq', 'constructionn-pro' ),
				'update_item'        => __( 'Update Faq', 'constructionn-pro' ),
				'search_items'       => __( 'Search Faq', 'constructionn-pro' ),
				'not_found'          => __( 'Not Found', 'constructionn-pro' ),
				'not_found_in_trash' => __( 'Not found in Trash', 'constructionn-pro' ),
			),
			'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => false,
			'capability_type'     => 'post',
			'show_in_rest'        => true,
			'menu_icon'           => 'dashicons-faq',
			'rewrite'             => false,
		);

		// Registering your Custom Post Type
		register_post_type( 'team', $teamargs );
		register_post_type( 'service', $serviceargs );
		register_post_type( 'case-study', $casestudiesargs );
		register_post_type( 'testimonial', $testimonialargs );
		register_post_type( 'project', $projectargs );
		register_post_type( 'faq', $faqargs );

		// Register Casestudy Categories Taxonomy
		$casestudy_taxonomy_args = array(
			'hierarchical' => true,
			'labels'       => array(
				'name'              => _x( 'Categories', 'taxonomy general name', 'constructionn-pro' ),
				'singular_name'     => _x( 'Category', 'taxonomy singular name', 'constructionn-pro' ),
				'search_items'      => __( 'Search Categories', 'constructionn-pro' ),
				'all_items'         => __( 'All Case Study Categories', 'constructionn-pro' ),
				'parent_item'       => __( 'Parent Case Study Category', 'constructionn-pro' ),
				'parent_item_colon' => __( 'Parent Case Study Category:', 'constructionn-pro' ),
				'edit_item'         => __( 'Edit Case Study Category', 'constructionn-pro' ),
				'update_item'       => __( 'Update Case Study Category', 'constructionn-pro' ),
				'add_new_item'      => __( 'Add New Case Study Category', 'constructionn-pro' ),
				'new_item_name'     => __( 'New Case Study Category Name', 'constructionn-pro' ),
				'menu_name'         => __( 'Categories', 'constructionn-pro' ),
			),
		);
		register_taxonomy( 'casestudy_category', array( 'case-study' ), $casestudy_taxonomy_args );

		// Register Team Categories Taxonomy
		$team_taxonomy_args = array(
			'hierarchical' => true,
			'labels'       => array(
				'name'              => _x( 'Categories', 'taxonomy general name', 'constructionn-pro' ),
				'singular_name'     => _x( 'Category', 'taxonomy singular name', 'constructionn-pro' ),
				'search_items'      => __( 'Search Categories', 'constructionn-pro' ),
				'all_items'         => __( 'All Team Categories', 'constructionn-pro' ),
				'parent_item'       => __( 'Parent Team Category', 'constructionn-pro' ),
				'parent_item_colon' => __( 'Parent Team Category:', 'constructionn-pro' ),
				'edit_item'         => __( 'Edit Team Category', 'constructionn-pro' ),
				'update_item'       => __( 'Update Team Category', 'constructionn-pro' ),
				'add_new_item'      => __( 'Add New Team Category', 'constructionn-pro' ),
				'new_item_name'     => __( 'New Team Category Name', 'constructionn-pro' ),
				'menu_name'         => __( 'Categories', 'constructionn-pro' ),
			),
		);
		register_taxonomy( 'team_category', array( 'team' ), $team_taxonomy_args );

		flush_rewrite_rules();

		// Register Project Categories Taxonomy
		$project_taxonomy_args = array(
			'hierarchical' => true,
			'labels'       => array(
				'name'              => _x( 'Categories', 'taxonomy general name', 'constructionn-pro' ),
				'singular_name'     => _x( 'Category', 'taxonomy singular name', 'constructionn-pro' ),
				'search_items'      => __( 'Search Categories', 'constructionn-pro' ),
				'all_items'         => __( 'All Project Categories', 'constructionn-pro' ),
				'parent_item'       => __( 'Parent Project Category', 'constructionn-pro' ),
				'parent_item_colon' => __( 'Parent Project Category:', 'constructionn-pro' ),
				'edit_item'         => __( 'Edit Project Category', 'constructionn-pro' ),
				'update_item'       => __( 'Update Project Category', 'constructionn-pro' ),
				'add_new_item'      => __( 'Add New Project Category', 'constructionn-pro' ),
				'new_item_name'     => __( 'New Project Category Name', 'constructionn-pro' ),
				'menu_name'         => __( 'Categories', 'constructionn-pro' ),
			),
		);
		register_taxonomy( 'project_category', array( 'project' ), $project_taxonomy_args );

		flush_rewrite_rules();

		// Register Faq Categories Taxonomy
		$faq_taxonomy_args = array(
			'hierarchical' => true,
			'labels'       => array(
				'name'              => _x( 'Categories', 'taxonomy general name', 'constructionn-pro' ),
				'singular_name'     => _x( 'Category', 'taxonomy singular name', 'constructionn-pro' ),
				'search_items'      => __( 'Search Categories', 'constructionn-pro' ),
				'all_items'         => __( 'All Faq Categories', 'constructionn-pro' ),
				'parent_item'       => __( 'Parent Faq Category', 'constructionn-pro' ),
				'parent_item_colon' => __( 'Parent Faq Category:', 'constructionn-pro' ),
				'edit_item'         => __( 'Edit Faq Category', 'constructionn-pro' ),
				'update_item'       => __( 'Update Faq Category', 'constructionn-pro' ),
				'add_new_item'      => __( 'Add New Faq Category', 'constructionn-pro' ),
				'new_item_name'     => __( 'New Faq Category Name', 'constructionn-pro' ),
				'menu_name'         => __( 'Categories', 'constructionn-pro' ),
			),
		);
		register_taxonomy( 'faq_category', array( 'faq' ), $faq_taxonomy_args );

		flush_rewrite_rules();
	}
}
add_action( 'init', 'constructionn_pro_create_cpt' );

function constructionn_pro_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'constructionn_pro_pingback_header' );

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

if ( ! function_exists( 'constructionn_pro_primary_nagivation' ) ) :
	/**
	 * Primary Navigation.
	 */
	function constructionn_pro_primary_nagivation() {
		if ( current_user_can( 'manage_options' ) || has_nav_menu( 'primary' ) ) {
			echo '<nav class="main-navigation"><div class="menu-container">';
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => 'ul',
						'menu_class'     => 'menu',
						'fallback_cb'    => 'constructionn_pro_navigation_menu_fallback',
					)
				);
			echo '</div></nav>';
		}
	}
endif;

if ( ! function_exists( 'constructionn_pro_secondary_nagivation' ) ) :
	/**
	 * Secondary Navigation.
	 */
	function constructionn_pro_secondary_nagivation() {
		if ( current_user_can( 'manage_options' ) || has_nav_menu( 'secondary' ) ) { ?>
			<nav class="secondary-navigation">
				<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'secondary',
							'container'       => 'div',
							'container_class' => 'secondary-menu-container',
							'menu_class'      => 'menu',
							'fallback_cb'     => 'constructionn_pro_navigation_menu_fallback',
						)
					);
				?>
			</nav>
			<?php
		}
	}
endif;

if ( ! function_exists( 'constructionn_pro_footer_navigation' ) ) :
	/**
	 * Footer Navigation Menu
	 *
	 * @return void
	 */
	function constructionn_pro_footer_navigation() {
		if ( current_user_can( 'manage_options' ) || has_nav_menu( 'footer-menu' ) ) {
			?>
			<div class="footer-bottom-menu">
				<div class="menu-footer-container">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-menu',
								'container'      => 'ul',
								'menu_class'     => 'footer-bottom-links',
								'fallback_cb'    => 'constructionn_pro_navigation_menu_fallback',
							)
						);
					?>
				</div>
			</div>
			<?php
		}
	}
endif;

if ( ! function_exists( 'constructionn_pro_apply_theme_shortcode' ) ) :
	/**
	 * Footer Shortcode
	 */
	function constructionn_pro_apply_theme_shortcode( $string ) {
		if ( empty( $string ) ) {
			return $string;
		}
		$search  = array( '[the-year]', '[the-site-link]' );
		$replace = array(
			date_i18n( esc_html__( 'Y', 'constructionn-pro' ) ),
			'<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name', 'display' ) ) . '</a>',
		);
		$string  = str_replace( $search, $replace, $string );
		return $string;
	}
endif;

if ( ! function_exists( 'constructionn_pro_pagination' ) ) :
	/**
	 * Pagination function
	 *
	 * @return void
	 */
	function constructionn_pro_pagination() {
		if ( is_singular() ) {
			$post_type = get_post_type();
			$next_post = get_next_post( array( 'post_type' => $post_type ) );
			$prev_post = get_previous_post( array( 'post_type' => $post_type ) );
			if ( $next_post || $prev_post ) {
				?>
				<nav class="post-navigation">
					<div class="nav-links">
						<?php if ( $prev_post ) { ?>
							<div class="nav-previous">
								<a href="<?php the_permalink( $prev_post->ID ); ?>" rel="prev">
									<div class="pagination-details">
										<button class="meta-nav">
											<?php echo esc_html__( 'PREVIOUS POST', 'constructionn-pro' ); ?>
										</button>
									</div>
								</a>
							</div>
							<?php
						}
						if ( $next_post ) {
							?>
							<div class="nav-next">
								<a href="<?php the_permalink( $next_post->ID ); ?>" rel="next">
									<div class="pagination-details">
										<button class="meta-nav"><?php echo esc_html__( 'NEXT POST', 'constructionn-pro' ); ?></button>
									</div>
								</a>
							</div>
						<?php } ?>
					</div>	
				</nav>
				<?php
			}
		} else {
			$pagination = get_theme_mod( 'pagination_type', 'default' );

			switch ( $pagination ) {
				case 'default': // Default Pagination
					$next_post = get_next_posts_link();
					$prev_post = get_previous_posts_link();

					if ( $next_post || $prev_post ) {
						?>
						<nav class="post-navigation">
							<div class="nav-links">
								<?php if ( $prev_post ) { ?>
									<div class="nav-previous">
										<a href="<?php echo esc_url( get_previous_posts_page_link() ); ?>" rel="prev">
											<div class="pagination-details">
												<button class="meta-nav">
													<?php echo esc_html__( 'Prev', 'constructionn-pro' ); ?>
												</button>
											</div>
										</a>
									</div>
								<?php } if ( $next_post ) { ?>
									<div class="nav-next">
										<a href="<?php echo esc_url( get_next_posts_page_link() ); ?>" rel="next">
											<div class="pagination-details">
												<button class="meta-nav">
													<?php echo esc_html__( 'Next', 'constructionn-pro' ); ?>
												</button>
											</div>
										</a>
									</div>
								<?php } ?>
							</div>
						</nav>
						<?php
					}
					break;

				case 'numbered': // Numbered Pagination
					echo '<div class="numbered">';
					the_posts_pagination(
						array(
							'prev_text'          => __( 'Previous', 'constructionn-pro' ),
							'next_text'          => __( 'Next', 'constructionn-pro' ),
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'constructionn-pro' ) . ' </span>',
						)
					);
					echo '</div>';

					break;

				default:
					the_posts_navigation();
					break;
			}
		}
	}
endif;

if ( ! function_exists( 'constructionn_pro_comment' ) ) :
	/**
	 * Comment
	 */
	function constructionn_pro_comment() {
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	}
endif;

if ( ! function_exists( 'constructionn_pro_navigation_menu_fallback' ) ) :
	/**
	 * Navigation menu fallback container
	 *
	 * @return void
	 */
	function constructionn_pro_navigation_menu_fallback() {
		if ( current_user_can( 'manage_options' ) ) {
			?>
			<ul class="menu">
				<li>
					<a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php echo esc_html__( 'Click here to add a menu', 'constructionn-pro' ); ?></a>
				</li>
			</ul>
			<?php
		}
	}
endif;

if ( ! function_exists( 'constructionn_pro_post_states' ) ) :
	/**
	 * Display Post State for pages in WP Admin
	 */
	function constructionn_pro_post_states( $post_states, $post ) {
		if ( 'page' == get_post_type( $post->ID ) ) {
			if ( get_page_template_slug( $post->ID ) == 'templates/about-us.php' ) {
				$post_states[] = esc_html__( 'About Us', 'constructionn-pro' );
			}
			if ( get_page_template_slug( $post->ID ) == 'templates/case-study.php' ) {
				$post_states[] = esc_html__( 'Case Study', 'constructionn-pro' );
			}
			if ( get_page_template_slug( $post->ID ) == 'templates/contact.php' ) {
				$post_states[] = esc_html__( 'Contact', 'constructionn-pro' );
			}
			if ( get_page_template_slug( $post->ID ) == 'templates/faqs.php' ) {
				$post_states[] = esc_html__( 'Faqs', 'constructionn-pro' );
			}
			if ( get_page_template_slug( $post->ID ) == 'templates/history.php' ) {
				$post_states[] = esc_html__( 'History', 'constructionn-pro' );
			}
			if ( get_page_template_slug( $post->ID ) == 'templates/pricing.php' ) {
				$post_states[] = esc_html__( 'Pricing', 'constructionn-pro' );
			}
			if ( get_page_template_slug( $post->ID ) == 'templates/service.php' ) {
				$post_states[] = esc_html__( 'Services', 'constructionn-pro' );
			}
			if ( get_page_template_slug( $post->ID ) == 'templates/teams.php' ) {
				$post_states[] = esc_html__( 'Teams', 'constructionn-pro' );
			}
			if ( get_page_template_slug( $post->ID ) == 'templates/testimonial.php' ) {
				$post_states[] = esc_html__( 'Testimonial', 'constructionn-pro' );
			}
		}
		return $post_states;
	}
endif;
add_filter( 'display_post_states', 'constructionn_pro_post_states', 10, 2 );

if ( ! function_exists( 'constructionn_pro_move_comment_field_to_bottom' ) ) :
	/**
	 * Move comment filed from the current position to before the cookies field
	 *
	 * @param array $fields
	 * @return array
	 */
	function constructionn_pro_move_comment_field_to_bottom( $fields ) {
		if ( isset( $fields['comment'] ) || isset( $fields['cookies'] ) ) {
			$comment_field = ( isset( $fields['comment'] ) && ! empty( $fields['comment'] ) ) ? $fields['comment'] : '';
			$cookies       = ( isset( $fields['cookies'] ) && ! empty( $fields['cookies'] ) ) ? $fields['cookies'] : '';

			unset( $fields['comment'] );
			unset( $fields['cookies'] );

			// Append the comment field before the cookies field
			if ( $comment_field ) {
				$fields['comment'] = $comment_field;
			}
			if ( $cookies ) {
				$fields['cookies'] = $cookies;
			}
		}
		return $fields;
	}
	add_filter( 'comment_form_fields', 'constructionn_pro_move_comment_field_to_bottom' );
endif;

if ( ! function_exists( 'constructionn_pro_admin_notice' ) ) :
	/**
	 * Show the Admin Notice in the dashboard
	 *
	 * @return void
	 */
	function constructionn_pro_admin_notice() {
		$currentScreen = get_current_screen();

		if ( $currentScreen->id === 'themes' ) {

			// check whether user has already dismissed the notice
			$dismissed = get_option( 'lfp_dismissed_custom_admin_notice' );

			if ( true === (bool) $dismissed ) {
				return;
			}
			?>
		<div id="gl_admin_notice" class="notice notice-info is-dismissible gl-custom-admin-notice">
			<div class="col-left">
				<h2><?php esc_html_e( 'Build Your Dream Site with GLThemes', 'constructionn-pro' ); ?></h2>
				<p><?php echo esc_html_e( 'Revolutionize your website with GLThemes, elegant and incredibly fast WordPress themes to help you augment your business to the next level.', 'constructionn-pro' ); ?></p>
				<ul>
					<li><?php esc_html_e( 'Theme Installation Service', 'constructionn-pro' ); ?></li>
					<li><?php esc_html_e( 'WordPress Maintainance Service', 'constructionn-pro' ); ?></li>
					<li><?php esc_html_e( 'SEO Services', 'constructionn-pro' ); ?></li>
					<li><?php esc_html_e( 'WordPress Web Hosting', 'constructionn-pro' ); ?></li>
					<li><?php esc_html_e( 'Theme Customization Service', 'constructionn-pro' ); ?></li>
					<li><?php esc_html_e( 'Hire A WordPress Developer', 'constructionn-pro' ); ?></li>
				</ul>
				<a target="_blank" rel="nofollow noreferrer" class="button button-primary" href="<?php echo esc_url( 'https://glthemes.com' ); ?>"><?php esc_html_e( 'Learn More', 'constructionn-pro' ); ?> 
				</a>
			</div>
			<div class="col-right">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/admin-notice.png' ); ?>" alt="Image 1">
			</div>
		</div>
			<?php
		}
	}
	add_action( 'admin_notices', 'constructionn_pro_admin_notice' );
endif;

if ( ! function_exists( 'constructionn_pro_dismiss_admin_notice' ) ) :
	/**
	 * Function to permanently dismiss the admin notice once clicked
	 *
	 * @return void
	 */
	function constructionn_pro_dismiss_admin_notice() {
		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'dismiss_notice_nonce' ) ) {
			wp_send_json_error();
		}
		update_option( 'lfp_dismissed_custom_admin_notice', true );

		wp_send_json_success();
	}
	add_action( 'wp_ajax_lfp_dismiss_admin_notice', 'constructionn_pro_dismiss_admin_notice' );
endif;
