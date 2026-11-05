<?php
/**
 * WP-CLI seed entry point.
 *
 * Usage (from the WordPress root, with zest-theme active):
 *   wp theme activate zest-theme
 *   wp eval-file wp-content/themes/zest-theme/seed/seed.php
 *
 * @package zest
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( "Run with: wp eval-file wp-content/themes/zest-theme/seed/seed.php\n" );
}
if ( ! function_exists( 'zest_run_seed' ) ) {
	exit( "Activate the Zest Holdings theme first: wp theme activate zest-theme\n" );
}

foreach ( zest_run_seed() as $line ) {
	if ( class_exists( 'WP_CLI' ) ) {
		WP_CLI::log( $line );
	} else {
		echo esc_html( $line ) . "\n";
	}
}
