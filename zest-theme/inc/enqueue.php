<?php
/**
 * Styles, scripts, fonts and favicons.
 *
 * @package zest
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue front-end assets.
 */
function zest_enqueue_assets() {
	wp_enqueue_style(
		'zest-fonts',
		'https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Montserrat:wght@600;700;800&family=Open+Sans:wght@400;600&display=swap',
		array(),
		null // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion -- Google Fonts URL is versioned by its query.
	);
	wp_enqueue_style( 'zest-main', ZEST_URI . '/assets/css/main.css', array(), ZEST_VERSION );
	wp_enqueue_script( 'zest-main', ZEST_URI . '/assets/js/main.js', array(), ZEST_VERSION, array( 'strategy' => 'defer', 'in_footer' => true ) );

	// Block library CSS is only needed where editor content is rendered.
	if ( is_front_page() ) {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'global-styles' );
		wp_dequeue_style( 'classic-theme-styles' );
	}
}
add_action( 'wp_enqueue_scripts', 'zest_enqueue_assets', 20 );

/**
 * Preconnect to Google Fonts.
 *
 * @param array  $urls          URLs.
 * @param string $relation_type Relation.
 * @return array
 */
function zest_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = 'https://fonts.googleapis.com';
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'zest_resource_hints', 10, 2 );

/**
 * Favicon fallback when no Site Icon is set in the Customizer.
 */
function zest_favicon() {
	if ( has_site_icon() ) {
		return;
	}
	printf( '<link rel="icon" type="image/png" sizes="32x32" href="%s">' . "\n", esc_url( ZEST_URI . '/assets/img/favicon-32.png' ) );
	printf( '<link rel="apple-touch-icon" href="%s">' . "\n", esc_url( ZEST_URI . '/assets/img/favicon-180.png' ) );
	echo '<meta name="theme-color" content="#0D1B6E">' . "\n";
}
add_action( 'wp_head', 'zest_favicon', 5 );
