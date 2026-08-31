<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function jce_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 120,
			'width'       => 360,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	add_theme_support( 'automatic-feed-links' );

	// Hero needs a genuinely large source; WP's default "large" (1024px) is too small.
	add_image_size( 'jce-hero', 1920, 1080, true );
	add_image_size( 'jce-card', 720, 450, true );

	register_nav_menus(
		array(
			'primary'  => __( 'Primary Menu', 'jce' ),
			'services' => __( 'Footer — Services', 'jce' ),
			'footer'   => __( 'Footer — Company', 'jce' ),
			'legal'    => __( 'Footer — Legal/Bottom', 'jce' ),
		)
	);
}
add_action( 'after_setup_theme', 'jce_theme_setup' );

/**
 * Fonts + styles + scripts.
 *
 * Playfair Display echoes the high-contrast serif of the JCE logo lettering;
 * Libre Franklin (a Franklin Gothic descendant) carries body copy. Only the
 * weights actually used are requested, and display=swap keeps text painting
 * immediately rather than blocking on the font (no invisible-text delay).
 */
function jce_enqueue_assets() {
	wp_enqueue_style(
		'jce-fonts',
		'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Libre+Franklin:wght@400;500;600;700&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'jce-style', get_stylesheet_uri(), array( 'jce-fonts' ), JCE_THEME_VERSION );
	wp_enqueue_script( 'jce-main', JCE_THEME_URI . '/assets/js/main.js', array(), JCE_THEME_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'jce_enqueue_assets' );

/**
 * Preconnect to the font CDN so the font request starts before CSS parses.
 */
function jce_resource_hints( $hints, $relation ) {
	if ( 'preconnect' === $relation ) {
		$hints[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' => 'anonymous' );
	}
	return $hints;
}
add_filter( 'wp_resource_hints', 'jce_resource_hints', 10, 2 );

/**
 * Defer the main script — it only handles the nav toggle, nothing above the fold
 * depends on it.
 */
function jce_defer_scripts( $tag, $handle ) {
	if ( 'jce-main' === $handle ) {
		return str_replace( ' src', ' defer src', $tag );
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'jce_defer_scripts', 10, 2 );

function jce_register_widget_areas() {
	register_sidebar(
		array(
			'name'          => __( 'Footer Extra', 'jce' ),
			'id'            => 'footer-1',
			'description'   => __( 'Optional extra column in the footer.', 'jce' ),
			'before_widget' => '<div class="footer-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'jce_register_widget_areas' );

/**
 * Fallback primary menu so the header is usable before a menu is assigned
 * in Appearance > Menus.
 */
function jce_primary_menu_fallback() {
	$items = array(
		home_url( '/' )              => __( 'Home', 'jce' ),
		home_url( '/services/' )     => __( 'Services', 'jce' ),
		home_url( '/about/' )        => __( 'About Us', 'jce' ),
		home_url( '/service-area/' ) => __( 'Service Area', 'jce' ),
		home_url( '/contact/' )      => __( 'Contact', 'jce' ),
	);

	echo '<ul>';
	foreach ( $items as $url => $label ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

/**
 * Excerpt tuning — service/location cards read better with a short, clean summary.
 */
function jce_excerpt_length() {
	return 22;
}
add_filter( 'excerpt_length', 'jce_excerpt_length' );

function jce_excerpt_more() {
	return '…';
}
add_filter( 'excerpt_more', 'jce_excerpt_more' );

/**
 * Performance: strip WordPress output this site has no use for.
 * Each of these is an extra request or inline payload on every page load.
 */
function jce_trim_head() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
}
add_action( 'init', 'jce_trim_head' );

/**
 * Drop the classic-theme block stylesheet on the front end — this theme ships
 * its own button/layout styles and doesn't use core block markup.
 */
function jce_dequeue_unused_styles() {
	if ( ! is_admin() ) {
		wp_dequeue_style( 'classic-theme-styles' );
	}
}
add_action( 'wp_enqueue_scripts', 'jce_dequeue_unused_styles', 20 );
