<?php


/* ---------------------------------------------------------------------------------------------
   THEME SETUP
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'rams_setup' ) ) {

	function rams_setup() {

		// Automatic feed
		add_theme_support( 'automatic-feed-links' );

		// Post thumbnails
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'post-image', 800, 9999 );

		// Post formats
		add_theme_support( 'post-formats', array( 'gallery', 'quote' ) );

		add_theme_support( 'title-tag' );

		// Jetpack infinite scroll
		add_theme_support( 'infinite-scroll', array(
			'container' => 'posts',
			'footer'    => 'wrapper',
			'type'      => 'click',
			'render'    => 'rams_infinite_scroll_render',
		) );

		// Add nav menu
		register_nav_menu( 'primary', __( 'Primary Menu', 'rams' ) );
		register_nav_menu('footermenu', __('Footer Menu', 'rams'));

		// Make the theme translation ready
		load_theme_textdomain( 'rams', get_template_directory() . '/languages' );


	}
	add_action( 'after_setup_theme', 'rams_setup' );

}


/* ---------------------------------------------------------------------------------------------
   JETPACK INFINITE SCROLL
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'rams_infinite_scroll_render' ) ) {
	function rams_infinite_scroll_render() {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content', get_post_format() );
		}

		// Jetpack calls wp_head() after rendering. Keep the enqueue hooks running
		// while discarding their HTML from the response containing the posts.
		add_action( 'wp_head', 'rams_infinite_scroll_head_buffer_start', -99999 );
		add_action( 'wp_head', 'rams_infinite_scroll_head_buffer_end', PHP_INT_MAX );
	}
}

function rams_infinite_scroll_head_buffer_start() {
	ob_start();
}

function rams_infinite_scroll_head_buffer_end() {
	ob_end_clean();
	remove_action( 'wp_head', 'rams_infinite_scroll_head_buffer_start', -99999 );
	remove_action( 'wp_head', 'rams_infinite_scroll_head_buffer_end', PHP_INT_MAX );
}


/* ---------------------------------------------------------------------------------------------
   ENQUEUE SCRIPTS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_load_javascript_files' ) ) {

	function rams_load_javascript_files() {

		wp_enqueue_script( 'rams_global', get_template_directory_uri() . '/js/global.js', array( 'jquery' ), wp_get_theme( get_template() )->get( 'Version' ), true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'rams_load_javascript_files' );

}


/* ---------------------------------------------------------------------------------------------
   ENQUEUE STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_load_style' ) ) {

	function rams_load_style() {

		if ( ! is_admin() ) {

			$dependencies = array();

			/**
			 * Translators: If there are characters in your language that are not
			 * supported by the theme fonts, translate this to 'off'. Do not translate
			 * into your own language.
			 */
			$load_fonts = _x( 'on', 'Google Fonts: on or off', 'rams' );

			if ( 'off' !== $load_fonts ) {

				wp_register_style( 'rams_googleFonts', get_theme_file_uri( '/assets/fonts/site.css' ), array(), wp_get_theme( get_template() )->get( 'Version' ) );
				$dependencies[] = 'rams_googleFonts';

			}

			wp_enqueue_style( 'rams_style', get_stylesheet_uri(), $dependencies, wp_get_theme()->get( 'Version' ) );

		}
	}
	add_action( 'wp_enqueue_scripts', 'rams_load_style' );

}


/* ---------------------------------------------------------------------------------------------
   ADD EDITOR STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_add_editor_styles' ) ) {

	function rams_add_editor_styles() {

		add_editor_style( 'rams-editor-styles.css' );

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$load_fonts = _x( 'on', 'Google Fonts: on or off', 'rams' );

		if ( 'off' !== $load_fonts ) {
			add_editor_style( 'assets/fonts/site.css' );

		}

	}
	add_action( 'init', 'rams_add_editor_styles' );

}


/* ---------------------------------------------------------------------------------------------
   SET CONTENT WIDTH
   --------------------------------------------------------------------------------------------- */


if ( ! isset( $content_width ) ) $content_width = 672;


/* ---------------------------------------------------------------------------------------------
   CHECK FOR JAVASCRIPT SUPPORT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_html_js_class' ) ) {

	function rams_html_js_class () {
		echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";
	}
	add_action( 'wp_head', 'rams_html_js_class', 1 );

}


/* ---------------------------------------------------------------------------------------------
   ADD CLASSES TO PAGINATION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_pagination_class_next' ) ) {

	function rams_pagination_class_next() {
		return 'class="archive-nav-older"';
	}
	add_filter( 'next_posts_link_attributes', 'rams_pagination_class_next' );

}

if ( ! function_exists( 'rams_pagination_class_prev' ) ) {

	function rams_pagination_class_prev() {
		return 'class="archive-nav-newer"';
	}
	add_filter( 'previous_posts_link_attributes', 'rams_pagination_class_prev' );

}


/* ---------------------------------------------------------------------------------------------
   CUSTOM MORE LINK TEXT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_custom_more_link' ) ) {

	function rams_custom_more_link( $more_link, $more_link_text ) {
		return str_replace( $more_link_text, __( 'Read more', 'rams' ) . ' &rarr;', $more_link );
	}
	add_filter( 'the_content_more_link', 'rams_custom_more_link', 10, 2 );

}


/* ---------------------------------------------------------------------------------------------
   BODY & POST CLASSES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_body_post_class' ) ) {

	function rams_body_post_class( $classes ) {

		$classes[] = has_post_thumbnail() ? 'has-featured-image' : 'no-featured-image';

		return $classes;
	}
	add_filter( 'post_class', 'rams_body_post_class' );
	add_filter( 'body_class', 'rams_body_post_class' );

}


/* ---------------------------------------------------------------------------------------------
   STYLE ADMIN AREA
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_admin_css' ) ) {

	function rams_admin_css() {
	echo '<style type="text/css">

		#postimagediv #set-post-thumbnail img {
			max-width: 100%;
			height: auto;
		}

	</style>';
	}
	add_action( 'admin_head', 'rams_admin_css' );

}


/* ---------------------------------------------------------------------------------------------
   GALLERY OUTPUT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_flexslider' ) ) {

	function rams_flexslider( $size ) {

		$post_id = get_the_ID();

		if ( ! $post_id || post_password_required( $post_id ) ) {
			return;
		}

		if ( $images = get_posts( array(
			'post_parent'    => $post_id,
			'post_type'      => 'attachment',
			'numberposts'    => -1, // show all
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'post_status'    => 'inherit',
			'post_mime_type' => 'image',
		) ) ) { ?>

			<div class="rams-gallery">

				<ul class="slides">

					<?php foreach ( $images as $image ) : ?>

						<li>
							<?php echo wp_get_attachment_image( $image->ID, $size ); ?>
						</li>

					<?php endforeach; ?>

				</ul>

				<?php if ( count( $images ) > 1 ) : ?>
					<div class="rams-gallery-nav" hidden>
						<button type="button" class="rams-gallery-prev" aria-label="<?php esc_attr_e( 'Previous image', 'rams' ); ?>"></button>
						<button type="button" class="rams-gallery-next" aria-label="<?php esc_attr_e( 'Next image', 'rams' ); ?>"></button>
					</div>
				<?php endif; ?>

			</div><?php

		}
	}

}


/* ---------------------------------------------------------------------------------------------
   COMMENT FUNCTION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_comment' ) ) {

	function rams_comment( $comment, $args, $depth ) {
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>

			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

				<?php esc_html_e( 'Pingback:', 'rams' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'rams' ), '<span class="edit-link">', '</span>' ); ?>

			</li>
		<?php
				break;
			default :
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

			<div id="comment-<?php comment_ID(); ?>" class="comment">

				<div class="avatar-container">
					<?php echo get_avatar( $comment, 160 ); ?>
				</div>

				<div class="comment-inner">

					<div class="comment-header">

						<h4><?php echo get_comment_author_link(); ?></h4>

						<p class="comment-date"><a class="comment-date-link" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>" title="<?php echo esc_attr( get_comment_date() . ' at ' . get_comment_time() ); ?>"><?php echo esc_html( get_comment_date() ) . '<span> &mdash; ' . esc_html( get_comment_time() ) . '</span>'; ?></a></p>

					</div>

					<div class="comment-content post-content">

						<?php if ( '0' == $comment->comment_approved ) : ?>

							<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'rams' ); ?></p>

						<?php endif; ?>

						<?php comment_text(); ?>

					</div><!-- /comment-content -->

					<div class="comment-actions">

						<?php
							comment_reply_link( array_merge( $args,
							array(
								'reply_text' 	=>  	__( 'Reply', 'rams' ),
								'depth'			=> 		$depth,
								'max_depth' 	=> 		$args['max_depth'],
								'before'		=>		'<p class="comment-reply">',
								'after'			=>		'</p>'
								)
							) );
						?>

						<?php edit_comment_link( __( 'Edit', 'rams' ), '<p class="comment-edit">', '</p>' ); ?>

					</div><!-- .comment-actions -->

				</div><!-- .comment-inner -->

			</div><!-- /comment-## -->

		<?php
			break;
		endswitch;
	}

}


/* ---------------------------------------------------------------------------------------------
   CUSTOMIZER OPTIONS
   --------------------------------------------------------------------------------------------- */


class Rams_Customize {

	public static function rams_register ( $wp_customize ) {

		$wp_customize->add_section( 'rams_options', array(
			'title' 		=> __( 'Options for Rams', 'rams' ),
			'priority' 		=> 35,
			'capability' 	=> 'edit_theme_options',
			'description' 	=> __('Allows you to customize theme settings for Rams.', 'rams'),
		) );

		$wp_customize->add_setting( 'accent_color', array(
			'default' 			=> '#333',
			'type' 				=> 'theme_mod',
			'transport' 		=> 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'rams_accent_color', array(
			'label' 		=> __( 'Accent Color', 'rams' ),
			'section' 		=> 'colors',
			'settings' 		=> 'accent_color',
			'priority' 		=> 10,
		) ) );

		//4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	}

	public static function rams_header_output() {

		echo '<!-- Customizer CSS -->';
		echo '<style type="text/css">';

			self::rams_generate_css( 'body a', 'color', 'accent_color' );
			self::rams_generate_css( 'body a:hover', 'color', 'accent_color' );
			self::rams_generate_css( '.sidebar', 'background', 'accent_color' );

			self::rams_generate_css( '.rams-gallery-nav button:hover', 'background-color', 'accent_color' );
			self::rams_generate_css( 'a.post-quote:hover', 'background', 'accent_color' );
			self::rams_generate_css( '.post-title a:hover', 'color', 'accent_color' );

			self::rams_generate_css( '.post-content a', 'color', 'accent_color' );
			self::rams_generate_css( '.post-content a:hover', 'color', 'accent_color' );
			self::rams_generate_css( '.post-content a:hover', 'border-bottom-color', 'accent_color' );
			self::rams_generate_css( '.post-content a.more-link:hover', 'background', 'accent_color' );
			self::rams_generate_css( '.post-content input[type="submit"]:hover', 'background', 'accent_color' );
			self::rams_generate_css( '.post-content input[type="button"]:hover', 'background', 'accent_color' );
			self::rams_generate_css( '.post-content input[type="reset"]:hover', 'background', 'accent_color' );

			self::rams_generate_css( '.post-content .has-accent-color', 'color', 'accent_color' );
			self::rams_generate_css( '.post-content .has-accent-background-color', 'background-color', 'accent_color' );

			self::rams_generate_css( '#infinite-handle span:hover', 'background', 'accent_color' );
			self::rams_generate_css( '.page-links a:hover', 'background', 'accent_color' );
			self::rams_generate_css( '.post-meta-inner a:hover', 'color', 'accent_color' );
			self::rams_generate_css( '.add-comment-title a', 'color', 'accent_color' );
			self::rams_generate_css( '.add-comment-title a:hover', 'color', 'accent_color' );
			self::rams_generate_css( '.bypostauthor .avatar', 'border-color', 'accent_color' );
			self::rams_generate_css( '.comment-actions a:hover', 'color', 'accent_color' );
			self::rams_generate_css( '.comment-header h4 a:hover', 'color', 'accent_color' );
			self::rams_generate_css( '#cancel-comment-reply-link', 'color', 'accent_color' );
			self::rams_generate_css( '.comments-nav a:hover', 'color', 'accent_color' );
			self::rams_generate_css( '.comment-form input[type="submit"]:hover', 'background-color', 'accent_color' );
			self::rams_generate_css( '.logged-in-as a:hover', 'color', 'accent_color' );
			self::rams_generate_css( '.archive-nav a:hover', 'color', 'accent_color' );

		echo '</style>';
		echo '<!--/Customizer CSS-->';

	}

	public static function rams_live_preview() {
		wp_enqueue_script( 'rams-themecustomizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'jquery', 'customize-preview' ), wp_get_theme( get_template() )->get( 'Version' ), true );
	}

	public static function rams_generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
		$return = '';
		$mod = get_theme_mod( $mod_name );
		$mod = is_string( $mod ) ? sanitize_hex_color( $mod ) : null;
		if ( ! empty( $mod ) ) {
			$return = sprintf( '%s { %s: %s; }', $selector, $style, $prefix.$mod.$postfix );
			if ( $echo ) {
				echo $return;
			}
		}
		return $return;
	}
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'Rams_Customize', 'rams_register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'Rams_Customize', 'rams_header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'Rams_Customize', 'rams_live_preview' ) );


/* ---------------------------------------------------------------------------------------------
   SPECIFY GUTENBERG SUPPORT
------------------------------------------------------------------------------------------------ */


if ( ! function_exists( 'rams_add_gutenberg_features' ) ) :

	function rams_add_gutenberg_features() {

		/* Gutenberg Palette --------------------------------------- */

		$accent_color = get_theme_mod( 'accent_color' );
		$accent_color = is_string( $accent_color ) ? sanitize_hex_color( $accent_color ) : null;
		$accent_color = $accent_color ?: '#6AA897';

		add_theme_support( 'editor-color-palette', array(
			array(
				'name' 	=> _x( 'Accent', 'Name of the accent color in the Gutenberg palette', 'rams' ),
				'slug' 	=> 'accent',
				'color' => $accent_color,
			),
			array(
				'name' 	=> _x( 'Black', 'Name of the black color in the Gutenberg palette', 'rams' ),
				'slug' 	=> 'black',
				'color' => '#222',
			),
			array(
				'name' 	=> _x( 'Dark Gray', 'Name of the dark gray color in the Gutenberg palette', 'rams' ),
				'slug' 	=> 'dark-gray',
				'color' => '#444',
			),
			array(
				'name' 	=> _x( 'Medium Gray', 'Name of the medium gray color in the Gutenberg palette', 'rams' ),
				'slug' 	=> 'medium-gray',
				'color' => '#666',
			),
			array(
				'name' 	=> _x( 'Light Gray', 'Name of the light gray color in the Gutenberg palette', 'rams' ),
				'slug' 	=> 'light-gray',
				'color' => '#888',
			),
			array(
				'name' 	=> _x( 'White', 'Name of the white color in the Gutenberg palette', 'rams' ),
				'slug' 	=> 'white',
				'color' => '#fff',
			),
		) );

		/* Gutenberg Font Sizes --------------------------------------- */

		add_theme_support( 'editor-font-sizes', array(
			array(
				'name' 		=> _x( 'Small', 'Name of the small font size in Gutenberg', 'rams' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the Gutenberg editor.', 'rams' ),
				'size' 		=> 18,
				'slug' 		=> 'small',
			),
			array(
				'name' 		=> _x( 'Regular', 'Name of the regular font size in Gutenberg', 'rams' ),
				'shortName' => _x( 'M', 'Short name of the regular font size in the Gutenberg editor.', 'rams' ),
				'size' 		=> 22,
				'slug' 		=> 'regular',
			),
			array(
				'name' 		=> _x( 'Large', 'Name of the large font size in Gutenberg', 'rams' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the Gutenberg editor.', 'rams' ),
				'size' 		=> 27,
				'slug' 		=> 'large',
			),
			array(
				'name' 		=> _x( 'Larger', 'Name of the larger font size in Gutenberg', 'rams' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the Gutenberg editor.', 'rams' ),
				'size' 		=> 35,
				'slug' 		=> 'larger',
			),
		) );

	}
	add_action( 'after_setup_theme', 'rams_add_gutenberg_features' );

endif;


/* ---------------------------------------------------------------------------------------------
   GUTENBERG EDITOR STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_block_editor_styles' ) ) :

	function rams_block_editor_styles() {

		if ( ! is_admin() ) {
			return;
		}

		$dependencies = array();

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$load_fonts = _x( 'on', 'Google Fonts: on or off', 'rams' );

		if ( 'off' !== $load_fonts ) {

			wp_register_style( 'rams-block-editor-styles-font', get_theme_file_uri( '/assets/fonts/editor.css' ), array(), wp_get_theme( get_template() )->get( 'Version' ) );
			$dependencies[] = 'rams-block-editor-styles-font';

		}

		// Enqueue the editor styles
		wp_enqueue_style( 'rams-block-editor-styles', get_theme_file_uri( '/rams-gutenberg-editor-style.css' ), $dependencies, '1.0', 'all' );

	}
	add_action( 'enqueue_block_assets', 'rams_block_editor_styles', 1 );

endif;


////// CUSTOM Functions
add_filter( 'walker_nav_menu_start_el', 'nav_menu_post_count', 10, 2 );
function nav_menu_post_count( $output, $item ) {
	if ( 'taxonomy' !== $item->type ) {
		return $output;
	}

	$term = get_term( $item->object_id, $item->object );
	$link_end = strpos( $output, '</a>' );

	if ( ! $term instanceof WP_Term || $term->count <= 0 || false === $link_end ) {
		return $output;
	}

	$count = sprintf( '<span class="menu-item-count"> (%d)</span>', $term->count );
	return substr_replace( $output, $count, $link_end, 0 );
}

# удаляем лишнюю информацию из head страницы
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );

# выводим время генерации, запросы и потребление памяти
function usage(){
    printf( ('SQL запросов:%d. Время генерации:%s сек. Потребление памяти:'), get_num_queries(), timer_stop(0, 3) );
    if ( function_exists('memory_get_usage') ) echo round( memory_get_usage()/1024/1024, 2 ) . ' mb ';
}
//add_filter('admin_footer_text', 'usage');
//add_filter('wp_footer', 'usage');

/* Меняем картинку логотипа WP на странице входа */
function my_login_logo() {
	$logo_url = esc_url_raw( get_template_directory_uri() . '/images/favicon.png' );
	wp_add_inline_style( 'login', '#login h1 a { background: url("' . $logo_url . '") no-repeat 0 0 !important; }' );
}
add_action( 'login_enqueue_scripts', 'my_login_logo' );
add_filter( 'login_headerurl', function () {
	return home_url( '/' );
} );

/* Open Graph Tags */
function custom_jetpack_default_image() {
    return get_stylesheet_directory_uri() . '/images/og_image.jpg';
}
add_filter( 'jetpack_open_graph_image_default', 'custom_jetpack_default_image' );

/* Скроем поле сайт */
function remove_comment_fields($fields) {
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields', 'remove_comment_fields');
