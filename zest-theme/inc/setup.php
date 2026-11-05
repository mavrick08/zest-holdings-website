<?php
/**
 * Theme supports, menus, widget areas.
 *
 * @package zest
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register theme supports and menu locations.
 */
function zest_setup() {
	load_theme_textdomain( 'zest', ZEST_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 168,
			'width'       => 128,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	add_image_size( 'zest-card', 720, 460, true );
	add_image_size( 'zest-wide', 1400, 700, true );

	register_nav_menus(
		array(
			'primary' => __( 'Primary menu', 'zest' ),
			'footer'  => __( 'Footer quick links', 'zest' ),
		)
	);
}
add_action( 'after_setup_theme', 'zest_setup' );

/**
 * Footer widget areas.
 */
function zest_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer – About column', 'zest' ),
			'id'            => 'footer-about',
			'description'   => __( 'Replaces the default company blurb in the first footer column.', 'zest' ),
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="footer-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Footer – Bottom bar', 'zest' ),
			'id'            => 'footer-bottom',
			'description'   => __( 'Optional content shown above the copyright line.', 'zest' ),
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="footer-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'zest_widgets_init' );

/**
 * Add lazy-loading/decoding to content images that lack it.
 *
 * @param array $attr Image attributes.
 * @return array
 */
function zest_image_attrs( $attr ) {
	if ( empty( $attr['decoding'] ) ) {
		$attr['decoding'] = 'async';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'zest_image_attrs' );

/**
 * Body classes for inner pages.
 *
 * @param array $classes Classes.
 * @return array
 */
function zest_body_class( $classes ) {
	if ( ! is_front_page() ) {
		$classes[] = 'is-inner';
	}
	return $classes;
}
add_filter( 'body_class', 'zest_body_class' );

/**
 * Remove emoji scripts – not needed and saves requests.
 */
function zest_cleanup_head() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
}
add_action( 'init', 'zest_cleanup_head' );
