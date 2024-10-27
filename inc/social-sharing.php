<?php
/**
 * Constructionn Pro Social Sharing
 *
 * @see http://wordpress.org/plugins/opengraph
 *
 * @package Constructionn_Pro
 */
if ( get_theme_mod( 'ed_og_tags', true ) ) {
	// disable jetpack's opengraph functionality.
	add_filter( 'jetpack_enable_opengraph', '__return_false' );
	add_filter( 'jetpack_enable_open_graph', '__return_false' );
}

if ( ! function_exists( 'constructionn_pro_opengraph_add_prefix' ) ) :
	/**
	 * Add Open Graph XML prefix to <html> element.
	 *
	 * @uses apply_filters calls 'opengraph_prefixes' filter on RDFa prefix array
	 */
	function constructionn_pro_opengraph_add_prefix( $output ) {
		$prefixes = array(
			'og' => 'http://ogp.me/ns#',
		);
		$prefixes = apply_filters( 'constructionn_pro_opengraph_prefixes', $prefixes );

		$prefix_str = '';
		foreach ( $prefixes as $k => $v ) {
			$prefix_str .= $k . ': ' . $v . ' ';
		}
		$prefix_str = trim( $prefix_str );

		if ( preg_match( '/(prefix\s*=\s*[\"|\'])/i', $output ) ) {
			$output = preg_replace( '/(prefix\s*=\s*[\"|\'])/i', '${1}' . $prefix_str, $output );
		} else {
			$output .= ' prefix="' . $prefix_str . '"';
		}

		return $output;
	}
endif;
add_filter( 'language_attributes', 'constructionn_pro_opengraph_add_prefix' );

/**
 * Register filters for default Open Graph metadata.
 */
function constructionn_pro_opengraph_default_metadata() {
	if ( get_theme_mod( 'ed_og_tags', true ) ) {
		// additional prefixes
		add_filter( 'constructionn_pro_opengraph_prefixes', 'constructionn_pro_opengraph_additional_prefixes' );

		// core metadata attributes
		add_filter( 'constructionn_pro_opengraph_title', 'constructionn_pro_opengraph_default_title', 5 );
		add_filter( 'constructionn_pro_opengraph_type', 'constructionn_pro_opengraph_default_type', 5 );
		add_filter( 'constructionn_pro_opengraph_image', 'constructionn_pro_opengraph_default_image', 5 );
		add_filter( 'constructionn_pro_opengraph_url', 'constructionn_pro_opengraph_default_url', 5 );

		add_filter( 'constructionn_pro_opengraph_description', 'constructionn_pro_opengraph_default_description', 5 );
		add_filter( 'constructionn_pro_opengraph_locale', 'constructionn_pro_opengraph_default_locale', 5 );
		add_filter( 'constructionn_pro_opengraph_site_name', 'constructionn_pro_opengraph_default_sitename', 5 );

		// additional profile metadata
		add_filter( 'constructionn_pro_opengraph_metadata', 'constructionn_pro_opengraph_profile_metadata' );

		// additional article metadata
		add_filter( 'constructionn_pro_opengraph_metadata', 'constructionn_pro_opengraph_article_metadata' );

		// twitter card metadata
		add_filter( 'constructionn_pro_twitter_card', 'constructionn_pro_twitter_default_card', 5 );
		add_filter( 'constructionn_pro_twitter_creator', 'constructionn_pro_twitter_default_creator', 5 );
	}
}
add_action( 'wp', 'constructionn_pro_opengraph_default_metadata' );

if ( ! function_exists( 'constructionn_pro_opengraph_additional_prefixes' ) ) :
	/**
	 * Add additional prefix namespaces that are supported by the opengraph plugin.
	 */
	function constructionn_pro_opengraph_additional_prefixes( $prefixes ) {
		if ( is_author() ) {
			$prefixes['profile'] = 'http://ogp.me/ns/profile#';
		}
		if ( is_singular() ) {
			$prefixes['article'] = 'http://ogp.me/ns/article#';
		}

		return $prefixes;
	}
endif;

if ( ! function_exists( 'constructionn_pro_opengraph_default_title' ) ) :
	/**
	 * Default title property, using the page title.
	 */
	function constructionn_pro_opengraph_default_title( $title ) {
		if ( $title ) {
			return $title;
		}

		if ( is_singular() ) {
			$title = get_the_title( get_queried_object_id() );
		} elseif ( is_author() ) {
			$author = get_queried_object();
			$title  = $author->display_name;
		} elseif ( is_category() && single_cat_title( '', false ) ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() && single_tag_title( '', false ) ) {
			$title = single_tag_title( '', false );
		} elseif ( is_archive() && get_post_format() ) {
			$title = get_post_format_string( get_post_format() );
		} elseif ( is_archive() && function_exists( 'get_the_archive_title' ) && get_the_archive_title() ) { // new in version 4.1 to get all other archive titles
			$title = get_the_archive_title();
		}

		return $title;
	}
endif;

if ( ! function_exists( 'constructionn_pro_opengraph_default_type' ) ) :
	/**
	 * Default type property.
	 */
	function constructionn_pro_opengraph_default_type( $type ) {
		if ( empty( $type ) ) {
			if ( is_singular( array( 'post', 'page' ) ) ) {
				$type = 'article';
			} elseif ( is_author() ) {
				$type = 'profile';
			} else {
				$type = 'website';
			}
		}

		return $type;
	}
endif;

if ( ! function_exists( 'constructionn_pro_opengraph_default_image' ) ) :
	/**
	 * Default image property, using the post-thumbnail and any attached images.
	 */
	function constructionn_pro_opengraph_default_image( $image ) {
		if ( $image ) {
			return $image;
		}

		// As of July 2014, Facebook seems to only let you select from the first 3 images
		$max_images = apply_filters( 'constructionn_pro_opengraph_max_images', 3 );

		if ( is_singular() ) {
			$id        = get_queried_object_id();
			$image_ids = array();

			// list post thumbnail first if this post has one
			if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( $id ) ) {
				$image_ids[] = get_post_thumbnail_id( $id );
			}

			// then list any image attachments
			$attachments = get_children(
				array(
					'post_parent'    => $id,
					'post_status'    => 'inherit',
					'post_type'      => 'attachment',
					'post_mime_type' => 'image',
					'order'          => 'ASC',
					'orderby'        => 'menu_order ID',
				)
			);

			foreach ( $attachments as $attachment ) {
				if ( ! in_array( $attachment->ID, $image_ids ) ) {
					$image_ids[] = $attachment->ID;
					if ( sizeof( $image_ids ) >= $max_images ) {
						break;
					}
				}
			}

			// get URLs for each image
			$image = array();
			foreach ( $image_ids as $id ) {
				$thumbnail = wp_get_attachment_image_src( $id, 'full' );
				if ( $thumbnail ) {
					$image[] = $thumbnail[0];
				}
			}
		} elseif ( is_attachment() && wp_attachment_is_image() ) {
			$id    = get_queried_object_id();
			$image = array( wp_get_attachment_url( $id ) );
		}

		if ( empty( $image ) ) {
			$image = array();

			// add site icon
			if ( function_exists( 'get_site_icon_url' ) && has_site_icon() ) {
				$image[] = get_site_icon_url( 512 );
			}

			// add header images
			if ( function_exists( 'get_uploaded_header_images' ) ) {
				if ( is_random_header_image() ) {
					foreach ( get_uploaded_header_images() as $header_image ) {
						$image[] = $header_image['url'];

						if ( sizeof( $image ) >= $max_images ) {
							break;
						}
					}
				} elseif ( get_header_image() ) {
					$image[] = get_header_image();
				}
			}
		}

		return $image;
	}
endif;

if ( ! function_exists( 'constructionn_pro_opengraph_default_url' ) ) :
	/**
	 * Default url property, using the permalink for the page.
	 */
	function constructionn_pro_opengraph_default_url( $url ) {
		if ( empty( $url ) ) {
			if ( is_singular() ) {
				$url = get_permalink();
			} elseif ( is_author() ) {
				$url = get_author_posts_url( get_queried_object_id() );
			}
		}

		return $url;
	}
endif;

if ( ! function_exists( 'constructionn_pro_opengraph_default_description' ) ) :
	/**
	 * Default description property, using the excerpt or content for posts, or the
	 * bloginfo description.
	 */
	function constructionn_pro_opengraph_default_description( $description ) {
		if ( $description ) {
			return $description;
		}

		if ( is_singular() ) {
			$post = get_queried_object();
			if ( ! empty( $post->post_excerpt ) ) {
				$description = $post->post_excerpt;
			} else {
				$description = $post->post_content;
			}
		} elseif ( is_author() ) {
			$id          = get_queried_object_id();
			$description = get_user_meta( $id, 'description', true );
		} elseif ( is_category() && category_description() ) {
			$description = category_description();
		} elseif ( is_tag() && tag_description() ) {
			$description = tag_description();
		} elseif ( is_archive() && function_exists( 'get_the_archive_description' ) && get_the_archive_description() ) { // new in version 4.1 to get all other archive descriptions
			$description = get_the_archive_description();
		} else {
			$description = get_bloginfo( 'description' );
		}

		// strip description to first 55 words.
		$description = strip_tags( strip_shortcodes( $description ) );
		$description = constructionn_pro_opengraph_trim_text( $description );

		return $description;
	}
endif;

if ( ! function_exists( 'constructionn_pro_opengraph_default_locale' ) ) :
	/**
	 * Default locale property, using the WordPress locale.
	 */
	function constructionn_pro_opengraph_default_locale( $locale ) {
		if ( empty( $locale ) ) {
			$locale = get_locale();
		}

		return $locale;
	}
endif;

if ( ! function_exists( 'constructionn_pro_opengraph_default_sitename' ) ) :
	/**
	 * Default site_name property, using the bloginfo name.
	 */
	function constructionn_pro_opengraph_default_sitename( $name ) {
		if ( empty( $name ) ) {
			$name = get_bloginfo( 'name' );
		}

		return $name;
	}
endif;

if ( ! function_exists( 'constructionn_pro_opengraph_profile_metadata' ) ) :
	/**
	 * Include profile metadata for author pages.
	 *
	 * @link http://ogp.me/#type_profile
	 */
	function constructionn_pro_opengraph_profile_metadata( $metadata ) {
		if ( is_author() ) {
			$id                             = get_queried_object_id();
			$metadata['profile:first_name'] = get_the_author_meta( 'first_name', $id );
			$metadata['profile:last_name']  = get_the_author_meta( 'last_name', $id );
			$metadata['profile:username']   = get_the_author_meta( 'nicename', $id );
		}

		return $metadata;
	}
endif;

if ( ! function_exists( 'constructionn_pro_opengraph_article_metadata' ) ) :
	/**
	 * Include article metadata for posts and pages.
	 *
	 * @link http://ogp.me/#type_article
	 */
	function constructionn_pro_opengraph_article_metadata( $metadata ) {
		if ( ! is_singular() ) {
			return $metadata;
		}

		$post   = get_queried_object();
		$author = $post->post_author;

		// check if page/post has tags
		$tags = wp_get_object_terms( $post->ID, 'post_tag' );
		if ( $tags && is_array( $tags ) ) {
			foreach ( $tags as $tag ) {
				$metadata['article:tag'][] = $tag->name;
			}
		}

		// check if page/post has categories
		$categories = wp_get_object_terms( $post->ID, 'category' );
		if ( $categories && is_array( $categories ) ) {
			$metadata['article:section'][] = current( $categories )->name;
		}

		$metadata['article:published_time'] = get_the_time( 'c', $post->ID );
		$metadata['article:modified_time']  = get_the_modified_time( 'c', $post->ID );
		$metadata['article:author'][]       = get_author_posts_url( $author );

		return $metadata;
	}
endif;

if ( ! function_exists( 'constructionn_pro_twitter_default_card' ) ) :
	/**
	 * Default twitter-card type.
	 */
	function constructionn_pro_twitter_default_card( $card ) {
		if ( $card ) {
			return $card;
		}

		$card   = 'summary';
		$images = apply_filters( 'constructionn_pro_opengraph_image', null );

		if ( is_singular() && count( $images ) >= 1 ) {
			$card = 'summary_large_image';
		}

		return $card;
	}
endif;

if ( ! function_exists( 'constructionn_pro_twitter_default_creator' ) ) :
	/**
	 * Default twitter-card creator.
	 */
	function constructionn_pro_twitter_default_creator( $creator ) {
		if ( $creator || ! is_singular() ) {
			return $creator;
		}

		$post    = get_queried_object();
		$author  = $post->post_author;
		$socials = get_user_meta( $author, '_constructionn_pro_user_social_icons', true );
		$twitter = ( isset( $socials['twitter'] ) && ! empty( $socials['twitter'] ) ) ? $socials['twitter'] : false;

		if ( ! $twitter ) {
			return $creator;
		}

		// check if twitter-account matches "http://twitter.com/username"
		if ( preg_match( '/^http:\/\/twitter\.com\/(#!\/)?(\w+)/i', $twitter, $matches ) ) {
			$creator = '@' . $matches[2];
		} elseif ( preg_match( '/^@?(\w+)$/i', $twitter, $matches ) ) { // check if twitter-account matches "(@)username"
			$creator = '@' . $matches[1];
		}

		return $creator;
	}
endif;

if ( ! function_exists( 'constructionn_pro_opengraph_metadata' ) ) :
	/**
	 * Get the Open Graph metadata for the current page.
	 *
	 * @uses apply_filters() Calls 'constructionn_pro_opengraph_{$name}' for each property name
	 * @uses apply_filters() Calls 'constructionn_pro_twitter_{$name}' for each property name
	 * @uses apply_filters() Calls 'constructionn_pro_opengraph_metadata' before returning metadata array
	 */
	function constructionn_pro_opengraph_metadata() {
		$metadata = array();

		// defualt properties defined at http://ogp.me/
		$properties = array(
			// required
			'title',
			'type',
			'image',
			'url',

			// optional
			'audio',
			'description',
			'determiner',
			'locale',
			'site_name',
			'video',
		);

		foreach ( $properties as $property ) {
			$filter                     = 'constructionn_pro_opengraph_' . $property;
			$metadata[ "og:$property" ] = apply_filters( $filter, '' );
		}

		$twitter_properties = array( 'card', 'creator' );

		foreach ( $twitter_properties as $property ) {
			$filter                          = 'constructionn_pro_twitter_' . $property;
			$metadata[ "twitter:$property" ] = apply_filters( $filter, '' );
		}

		return apply_filters( 'constructionn_pro_opengraph_metadata', $metadata );
	}
endif;

if ( ! function_exists( 'constructionn_pro_opengraph_site_icon_image_sizes' ) ) :
	/**
	 * Add 512x512 icon size
	 *
	 * @param  array $sizes sizes available for the site icon
	 * @return array        updated list of icons
	 */
	function constructionn_pro_opengraph_site_icon_image_sizes( $sizes ) {
		$sizes[] = 512;

		return array_unique( $sizes );
	}
endif;
add_filter( 'site_icon_image_sizes', 'constructionn_pro_opengraph_site_icon_image_sizes' );

if ( ! function_exists( 'constructionn_pro_opengraph_trim_text' ) ) :
	/**
	 * Helper function to trim text using the same default values for length and
	 * 'more' text as wp_trim_excerpt.
	 */
	function constructionn_pro_opengraph_trim_text( $text ) {
		$excerpt_length = apply_filters( 'excerpt_length', 55 );
		$excerpt_more   = apply_filters( 'excerpt_more', ' [...]' );

		return wp_trim_words( $text, $excerpt_length, $excerpt_more );
	}
endif;

if ( ! function_exists( 'constructionn_pro_opengraph_meta_tags' ) ) :
	/**
	 * Output Open Graph <meta> tags in the page header.
	 */
	function constructionn_pro_opengraph_meta_tags() {
		if ( get_theme_mod( 'ed_og_tags', true ) ) {
			$metadata = constructionn_pro_opengraph_metadata();
			foreach ( $metadata as $key => $value ) {
				if ( empty( $key ) || empty( $value ) ) {
					continue;
				}
				$value = (array) $value;

				foreach ( $value as $v ) {
					// use "name" attribute for Twitter Cards
					if ( stripos( $key, 'twitter:' ) === 0 ) {
						printf(
							'<meta name="%1$s" content="%2$s" />' . PHP_EOL,
							esc_attr( $key ),
							esc_attr( $v )
						);
					} else { // use "property" attribute for Open Graph
						printf(
							'<meta property="%1$s" content="%2$s" />' . PHP_EOL,
							esc_attr( $key ),
							esc_attr( $v )
						);
					}
				}
			}
		}
	}
endif;
add_action( 'wp_head', 'constructionn_pro_opengraph_meta_tags' );

if ( ! function_exists( 'constructionn_pro_get_social_share' ) ) :
	/**
	 * Get list of social sharing icons
	 * http://www.sharelinkgenerator.com/
	 */
	function constructionn_pro_get_social_share( $share ) {
		global $post;
		switch ( $share ) {
			case 'facebook':
				echo '<li><a href="' . esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink( $post->ID ) ) . '" rel="nofollow noopener" target="_blank"><i class="' . esc_attr__( 'facebook', 'constructionn-pro' ) . '" aria-hidden="true">' . wp_kses( constructionn_pro_handle_all_svgs( 'facebook' ), constructionn_pro_get_kses_extended_ruleset() ) . '</i></a></li>';
				break;

			case 'twitter':
				echo '<li><a href="' . esc_url( 'https://twitter.com/intent/tweet?text=' . get_the_title( $post->ID ) ) . '&nbsp;' . get_the_permalink( $post->ID ) . '" rel="nofollow noopener" target="_blank"><i class="' . esc_attr__( 'twitter', 'constructionn-pro' ) . '" aria-hidden="true">' . wp_kses( constructionn_pro_handle_all_svgs( 'twitter' ), constructionn_pro_get_kses_extended_ruleset() ) . '</i></a></li>';
				break;

			case 'linkedin':
				echo '<li><a href="' . esc_url( 'https://www.linkedin.com/shareArticle?mini=true&url=' . get_the_permalink( $post->ID ) . '&title=' . get_the_title( $post->ID ) ) . '" rel="nofollow noopener" target="_blank"><i class="' . esc_attr__( 'linkedin', 'constructionn-pro' ) . '" aria-hidden="true">' . wp_kses( constructionn_pro_handle_all_svgs( 'linkedin' ), constructionn_pro_get_kses_extended_ruleset() ) . '</i></a></li>';
				break;

			case 'pinterest':
				echo '<li><a href="' . esc_url( 'https://pinterest.com/pin/create/button/?url=' . get_the_permalink( $post->ID ) . '&description=' . get_the_title( $post->ID ) ) . '" rel="nofollow noopener" target="_blank" data-pin-do="none" data-pin-custom="true"><i class="' . esc_attr__( 'pinterest', 'constructionn-pro' ) . '" aria-hidden="true">' . wp_kses( constructionn_pro_handle_all_svgs( 'pinterest' ), constructionn_pro_get_kses_extended_ruleset() ) . '</i></a></li>';
				break;

			case 'email':
				echo '<li><a href="' . esc_url( 'mailto:?Subject=' . get_the_title( $post->ID ) . '&Body=' . get_the_permalink( $post->ID ) ) . '" rel="nofollow noopener" target="_blank"><i class="' . esc_attr__( 'email', 'constructionn-pro' ) . '" aria-hidden="true">' . wp_kses( constructionn_pro_handle_all_svgs( 'email' ), constructionn_pro_get_kses_extended_ruleset() ) . '</i></a></li>';
				break;

			case 'reddit':
				echo '<li><a href="' . esc_url( 'http://www.reddit.com/submit?url=' . get_the_permalink( $post->ID ) . '&title=' . get_the_title( $post->ID ) ) . '" rel="nofollow noopener" target="_blank"><i class="' . esc_attr__( 'reddit', 'constructionn-pro' ) . '" aria-hidden="true">' . wp_kses( constructionn_pro_handle_all_svgs( 'reddit' ), constructionn_pro_get_kses_extended_ruleset() ) . '</i></a></li>';
				break;

			case 'tumblr':
				echo '<li><a href="' . esc_url( 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=' . get_the_permalink( $post->ID ) . '&title=' . get_the_title( $post->ID ) ) . '" rel="nofollow noopener" target="_blank"><i class="' . esc_attr__( 'tumblr', 'constructionn-pro' ) . '" aria-hidden="true">' . wp_kses( constructionn_pro_handle_all_svgs( 'tumblr' ), constructionn_pro_get_kses_extended_ruleset() ) . '</i></a></li>';
				break;

			case 'digg':
				echo '<li><a href="' . esc_url( 'http://digg.com/submit?url=' . get_the_permalink( $post->ID ) ) . '" rel="nofollow noopener" target="_blank"><i class="' . esc_attr__( 'digg', 'constructionn-pro' ) . '" aria-hidden="true">' . wp_kses( constructionn_pro_handle_all_svgs( 'digg' ), constructionn_pro_get_kses_extended_ruleset() ) . '</i></a></li>';
				break;

			case 'weibo':
				echo '<li><a href="' . esc_url( 'https://service.weibo.com/share/share.php?url=' . get_the_permalink( $post->ID ) ) . '" rel="nofollow noopener" target="_blank"><i class="' . esc_attr__( 'weibo', 'constructionn-pro' ) . '" aria-hidden="true">' . wp_kses( constructionn_pro_handle_all_svgs( 'weibo' ), constructionn_pro_get_kses_extended_ruleset() ) . '</i></a></li>';
				break;

			case 'xing':
				echo '<li><a href="' . esc_url( 'https://www.xing.com/app/user?op=share&url=' . get_the_permalink( $post->ID ) ) . '" rel="nofollow noopener" target="_blank"><i class="' . esc_attr__( 'xing', 'constructionn-pro' ) . '" aria-hidden="true">' . wp_kses( constructionn_pro_handle_all_svgs( 'xing' ), constructionn_pro_get_kses_extended_ruleset() ) . '</i></a></li>';
				break;

			case 'vk':
				echo '<li><a href="' . esc_url( 'http://vk.com/share.php?url=' . get_the_permalink( $post->ID ) . '&title=' . get_the_title( $post->ID ) ) . '" rel="nofollow noopener" target="_blank"><i class="' . esc_attr__( 'vk', 'constructionn-pro' ) . '" aria-hidden="true">' . wp_kses( constructionn_pro_handle_all_svgs( 'vk' ), constructionn_pro_get_kses_extended_ruleset() ) . '</i></a></li>';
				break;

			case 'pocket':
				echo '<li><a href="' . esc_url( 'https://getpocket.com/edit?url=' . get_the_permalink( $post->ID ) . '&title=' . get_the_title( $post->ID ) ) . '" rel="nofollow noopener" target="_blank"><i class="' . esc_attr__( 'pocket', 'constructionn-pro' ) . '" aria-hidden="true">' . wp_kses( constructionn_pro_handle_all_svgs( 'pocket' ), constructionn_pro_get_kses_extended_ruleset() ) . '</i></a></li>';
				break;

			case 'whatsapp':
				echo '<li><a href="' . esc_url( 'https://wa.me/?text=' . get_the_permalink( $post->ID ) . '&title=' . get_the_title( $post->ID ) ) . '" rel="nofollow noopener" target="_blank" data-action="share/whatsapp/share" ><i class="' . esc_attr__( 'whatsapp', 'constructionn-pro' ) . '" aria-hidden="true">' . wp_kses( constructionn_pro_handle_all_svgs( 'whatsapp' ), constructionn_pro_get_kses_extended_ruleset() ) . '</i></a></li>';
				break;

			case 'telegram':
				echo '<li> <a href="' . esc_url( 'https://telegram.me/share/url?url=' . get_the_permalink( $post->ID ) . '&title=' . get_the_title( $post->ID ) ) . '" rel="nofollow noopener" target="_blank"><i class="' . esc_attr__( 'telegram', 'constructionn-pro' ) . '" aria-hidden="true">' . wp_kses( constructionn_pro_handle_all_svgs( 'telegram' ), constructionn_pro_get_kses_extended_ruleset() ) . '</i></a></li>';
				break;
		}
	}
endif;

if ( ! function_exists( 'constructionn_pro_social_share' ) ) :
	/**
	 * Prints Social Sharing
	 */
	function constructionn_pro_social_share( $floating = false ) {
		$ed_sharing        = get_theme_mod( 'ed_social_sharing', true );
		$sort_social_share = get_theme_mod( 'social_share', 'facebook,twitter,pinterest,linkedin' );
		$social_share      = constructionn_pro_string_to_array( $sort_social_share );
		$class             = $floating ? ' sticky-share' : '';

		if ( $ed_sharing && $social_share ) { ?>     
			<div class="social-wrap<?php echo esc_attr( $class ); ?>">
				<span><?php esc_html_e( 'Share: ', 'constructionn-pro' ); ?></span>
				<ul class="social-networks">
					<?php
					foreach ( $social_share as $share ) {
						constructionn_pro_get_social_share( $share );
					}
					?>
				</ul>
			</div>
			<?php
		}
	}
endif;
