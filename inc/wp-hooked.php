<?php
/**
 * Functions which enhance the theme by hooking into WordPress core actions/hooks
 *
 * @package Constructionn
 */
if ( ! function_exists( 'constructionn_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function constructionn_setup() {
		/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on constructionn, use a find and replace
		* to change 'constructionn' to the name of your theme in all the template files.
		*/
		load_theme_textdomain( 'constructionn', get_template_directory() . '/languages' );

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
				'primary'     => esc_html__( 'Primary', 'constructionn' ),
				'secondary'   => esc_html__( 'Secondary', 'constructionn' ),
				'footer-menu' => esc_html__( 'Footer Navigation', 'constructionn' ),
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
				'constructionn_custom_background_args',
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
		 * @uses constructionn_header_style()
		 */

		add_theme_support(
			'custom-header',
			apply_filters(
				'constructionn_custom_header_args',
				array(
					'default-image'      => esc_url( get_template_directory_uri() . '/assets/images/static-banner.jpg' ),
					'video'              => true,
					'default-text-color' => '000000',
					'width'              => 1920,
					'height'             => 720,
					'flex-height'        => true,
					'wp-head-callback'   => 'constructionn_header_style',
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
		$GLOBALS['content_width'] = apply_filters( 'constructionn_content_width', 800 );
	}
endif;
add_action( 'after_setup_theme', 'constructionn_setup' );

if ( ! function_exists( 'constructionn_scripts' ) ) :
	/**
	 * Enqueue scripts and styles.
	 */
	function constructionn_scripts() {
		// Use minified libraries if SCRIPT_DEBUG is false
		$build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? 'unminify/' : '';
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		// wp_enqueue_style( 'constructionn-google-fonts', constructionn_google_fonts_url(), array(), null );
		wp_style_add_data( 'constructionn-style', 'rtl', 'replace' );
		wp_enqueue_style( 'constructionn-styles', get_template_directory_uri() . '/assets/css/' . $build . 'style' . $suffix . '.css', array(), CONSTRUCTIONN_PRO_VERSION, false );
		wp_enqueue_style( 'constructionn-fonts', get_template_directory_uri() . '/assets/css/' . $build . 'fonts' . $suffix . '.css', array(), CONSTRUCTIONN_PRO_VERSION, false );

		wp_enqueue_style( 'constructionn-style', get_stylesheet_uri(), array(), CONSTRUCTIONN_PRO_VERSION );

		if ( constructionn_woo_boolean() ) {
			wp_enqueue_style( 'constructionn-woo', get_template_directory_uri() . '/assets/css/' . $build . 'woo' . $suffix . '.css', array(), CONSTRUCTIONN_PRO_VERSION );
		}

		wp_enqueue_script( 'constructionn-custom', get_template_directory_uri() . '/assets/js/' . $build . 'custom' . $suffix . '.js', array( 'jquery' ), CONSTRUCTIONN_PRO_VERSION, true );

		wp_enqueue_script( 'constructionn-navigation', get_template_directory_uri() . '/js/' . $build . 'navigation' . $suffix . '.js', array( 'jquery' ), CONSTRUCTIONN_PRO_VERSION, true );

		wp_localize_script(
			'constructionn-custom',
			'constructionn_data',
			array(
				'rtl' => is_rtl(),
			)
		);

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'constructionn_scripts' );

if ( ! function_exists( 'constructionn_enqueue_backend_styles' ) ) :
	/**
	 * Enqueuing styles and scripts for Backend
	 *
	 * @return void
	 */
	function constructionn_enqueue_backend_styles() {
		// Use minified libraries if SCRIPT_DEBUG is false
		$build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? 'unminify/' : '';
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		wp_enqueue_style( 'constructionn-editor-styles', get_template_directory_uri() . '/assets/css/' . $build . 'editor-style' . $suffix . '.css', array(), CONSTRUCTIONN_PRO_VERSION, false );

		wp_enqueue_script(
			'constructionn-admin-scripts',
			get_template_directory_uri() . '/assets/js/' . $build . 'admin' . $suffix . '.js',
			array( 'jquery' ),
			CONSTRUCTIONN_PRO_VERSION,
			true
		);
		wp_localize_script(
			'constructionn-admin-scripts',
			'constructionn_admin_data',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce'    => wp_create_nonce( 'dismiss_notice_nonce' ),
			)
		);
	}
endif;
add_action( 'admin_enqueue_scripts', 'constructionn_enqueue_backend_styles' );

if ( ! function_exists( 'constructionn_body_classes' ) ) :
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	function constructionn_body_classes( $classes ) {
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
			$classes[] = constructionn_sidebar_layout();
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
add_filter( 'body_class', 'constructionn_body_classes' );

if ( ! function_exists( 'constructionn_widgets_init' ) ) :
	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function constructionn_widgets_init() {
		$sidebars = array(
			'primary-sidebar' => array(
				'name'        => esc_html__( 'Primary Sidebar', 'constructionn' ),
				'id'          => 'primary-sidebar',
				'description' => esc_html__( 'Primary Sidebar', 'constructionn' ),
			),
			'footer-one'      => array(
				'name'        => esc_html__( 'Footer One', 'constructionn' ),
				'id'          => 'footer-one',
				'description' => esc_html__( 'Add footer one widgets here.', 'constructionn' ),
			),
			'footer-two'      => array(
				'name'        => esc_html__( 'Footer Two', 'constructionn' ),
				'id'          => 'footer-two',
				'description' => esc_html__( 'Add footer two widgets here.', 'constructionn' ),
			),
			'footer-three'    => array(
				'name'        => esc_html__( 'Footer Three', 'constructionn' ),
				'id'          => 'footer-three',
				'description' => esc_html__( 'Add footer three widgets here.', 'constructionn' ),
			),
			'footer-four'     => array(
				'name'        => esc_html__( 'Footer Four', 'constructionn' ),
				'id'          => 'footer-four',
				'description' => esc_html__( 'Add footer four widgets here.', 'constructionn' ),
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
add_action( 'widgets_init', 'constructionn_widgets_init' );

function constructionn_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'constructionn_pingback_header' );

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

if ( ! function_exists( 'constructionn_primary_nagivation' ) ) :
	/**
	 * Primary Navigation.
	 */
	function constructionn_primary_nagivation() {
		if ( current_user_can( 'manage_options' ) || has_nav_menu( 'primary' ) ) {
			echo '<nav class="main-navigation"><div class="menu-container">';
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => 'ul',
						'menu_class'     => 'menu',
						'fallback_cb'    => 'constructionn_navigation_menu_fallback',
					)
				);
			echo '</div></nav>';
		}
	}
endif;

if ( ! function_exists( 'constructionn_secondary_nagivation' ) ) :
	/**
	 * Secondary Navigation.
	 */
	function constructionn_secondary_nagivation() {
		if ( current_user_can( 'manage_options' ) || has_nav_menu( 'secondary' ) ) { ?>
			<nav class="secondary-navigation">
				<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'secondary',
							'container'       => 'div',
							'container_class' => 'secondary-menu-container',
							'menu_class'      => 'menu',
							'fallback_cb'     => 'constructionn_navigation_menu_fallback',
						)
					);
				?>
			</nav>
			<?php
		}
	}
endif;

if ( ! function_exists( 'constructionn_footer_navigation' ) ) :
	/**
	 * Footer Navigation Menu
	 *
	 * @return void
	 */
	function constructionn_footer_navigation() {
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
								'fallback_cb'    => 'constructionn_navigation_menu_fallback',
							)
						);
					?>
				</div>
			</div>
			<?php
		}
	}
endif;

if ( ! function_exists( 'constructionn_apply_theme_shortcode' ) ) :
	/**
	 * Footer Shortcode
	 */
	function constructionn_apply_theme_shortcode( $string ) {
		if ( empty( $string ) ) {
			return $string;
		}
		$search  = array( '[the-year]', '[the-site-link]' );
		$replace = array(
			date_i18n( esc_html__( 'Y', 'constructionn' ) ),
			'<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name', 'display' ) ) . '</a>',
		);
		$string  = str_replace( $search, $replace, $string );
		return $string;
	}
endif;

if ( ! function_exists( 'constructionn_pagination' ) ) :
	/**
	 * Pagination function
	 *
	 * @return void
	 */
	function constructionn_pagination() {
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
											<?php echo esc_html__( 'PREVIOUS POST', 'constructionn' ); ?>
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
										<button class="meta-nav"><?php echo esc_html__( 'NEXT POST', 'constructionn' ); ?></button>
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
													<?php echo esc_html__( 'Prev', 'constructionn' ); ?>
												</button>
											</div>
										</a>
									</div>
								<?php } if ( $next_post ) { ?>
									<div class="nav-next">
										<a href="<?php echo esc_url( get_next_posts_page_link() ); ?>" rel="next">
											<div class="pagination-details">
												<button class="meta-nav">
													<?php echo esc_html__( 'Next', 'constructionn' ); ?>
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
							'prev_text'          => __( 'Previous', 'constructionn' ),
							'next_text'          => __( 'Next', 'constructionn' ),
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'constructionn' ) . ' </span>',
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

if ( ! function_exists( 'constructionn_comment' ) ) :
	/**
	 * Comment
	 */
	function constructionn_comment() {
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	}
endif;

if ( ! function_exists( 'constructionn_navigation_menu_fallback' ) ) :
	/**
	 * Navigation menu fallback container
	 *
	 * @return void
	 */
	function constructionn_navigation_menu_fallback() {
		if ( current_user_can( 'manage_options' ) ) {
			?>
			<ul class="menu">
				<li>
					<a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php echo esc_html__( 'Click here to add a menu', 'constructionn' ); ?></a>
				</li>
			</ul>
			<?php
		}
	}
endif;


if ( ! function_exists( 'constructionn_move_comment_field_to_bottom' ) ) :
	/**
	 * Move comment filed from the current position to before the cookies field
	 *
	 * @param array $fields
	 * @return array
	 */
	function constructionn_move_comment_field_to_bottom( $fields ) {
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
	add_filter( 'comment_form_fields', 'constructionn_move_comment_field_to_bottom' );
endif;

if ( ! function_exists( 'constructionn_admin_notice' ) ) :
	/**
	 * Show the Admin Notice in the dashboard
	 *
	 * @return void
	 */
	function constructionn_admin_notice() {
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
				<h2><?php esc_html_e( 'Build Your Dream Site with GLThemes', 'constructionn' ); ?></h2>
				<p><?php echo esc_html_e( 'Revolutionize your website with GLThemes, elegant and incredibly fast WordPress themes to help you augment your business to the next level.', 'constructionn' ); ?></p>
				<ul>
					<li><?php esc_html_e( 'Theme Installation Service', 'constructionn' ); ?></li>
					<li><?php esc_html_e( 'WordPress Maintainance Service', 'constructionn' ); ?></li>
					<li><?php esc_html_e( 'SEO Services', 'constructionn' ); ?></li>
					<li><?php esc_html_e( 'WordPress Web Hosting', 'constructionn' ); ?></li>
					<li><?php esc_html_e( 'Theme Customization Service', 'constructionn' ); ?></li>
					<li><?php esc_html_e( 'Hire A WordPress Developer', 'constructionn' ); ?></li>
				</ul>
				<a target="_blank" rel="nofollow noreferrer" class="button button-primary" href="<?php echo esc_url( 'https://glthemes.com' ); ?>"><?php esc_html_e( 'Learn More', 'constructionn' ); ?> 
				</a>
			</div>
			<div class="col-right">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/admin-notice.png' ); ?>" alt="Image 1">
			</div>
		</div>
			<?php
		}
	}
	add_action( 'admin_notices', 'constructionn_admin_notice' );
endif;

if ( ! function_exists( 'constructionn_dismiss_admin_notice' ) ) :
	/**
	 * Function to permanently dismiss the admin notice once clicked
	 *
	 * @return void
	 */
	function constructionn_dismiss_admin_notice() {
		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'dismiss_notice_nonce' ) ) {
			wp_send_json_error();
		}
		update_option( 'lfp_dismissed_custom_admin_notice', true );

		wp_send_json_success();
	}
	add_action( 'wp_ajax_lfp_dismiss_admin_notice', 'constructionn_dismiss_admin_notice' );
endif;
