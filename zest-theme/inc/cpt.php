<?php
/**
 * Custom post types and taxonomy.
 *
 * URLs:
 *   /services/                               all verticals (archive-service.php)
 *   /services/security-services/             vertical landing (taxonomy-vertical.php)
 *   /services/security-services/dog-squad/   service detail (single-service.php)
 *   /careers/<job>/                          job detail
 *
 * @package zest
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register post types and taxonomy.
 */
function zest_register_types() {
	register_taxonomy(
		'vertical',
		array( 'service' ),
		array(
			'labels'            => array(
				'name'          => __( 'Verticals', 'zest' ),
				'singular_name' => __( 'Vertical', 'zest' ),
				'add_new_item'  => __( 'Add vertical', 'zest' ),
				'edit_item'     => __( 'Edit vertical', 'zest' ),
			),
			'public'            => true,
			'hierarchical'      => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'       => 'services',
				'with_front' => false,
			),
		)
	);

	register_post_type(
		'service',
		array(
			'labels'        => array(
				'name'          => __( 'Services', 'zest' ),
				'singular_name' => __( 'Service', 'zest' ),
				'add_new_item'  => __( 'Add service', 'zest' ),
				'edit_item'     => __( 'Edit service', 'zest' ),
				'all_items'     => __( 'All services', 'zest' ),
			),
			'public'        => true,
			'menu_icon'     => 'dashicons-shield',
			'menu_position' => 20,
			'show_in_rest'  => true,
			'has_archive'   => 'services',
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
			'rewrite'       => array(
				'slug'       => 'services/%vertical%',
				'with_front' => false,
			),
		)
	);

	register_post_type(
		'job',
		array(
			'labels'        => array(
				'name'          => __( 'Jobs', 'zest' ),
				'singular_name' => __( 'Job', 'zest' ),
				'add_new_item'  => __( 'Add job opening', 'zest' ),
				'edit_item'     => __( 'Edit job opening', 'zest' ),
				'all_items'     => __( 'All openings', 'zest' ),
			),
			'public'        => true,
			'menu_icon'     => 'dashicons-id',
			'menu_position' => 21,
			'show_in_rest'  => true,
			'has_archive'   => false,
			'supports'      => array( 'title', 'editor', 'excerpt' ),
			'rewrite'       => array(
				'slug'       => 'careers',
				'with_front' => false,
			),
		)
	);

	// Stored copy of every form submission, so nothing is lost if email delivery fails.
	register_post_type(
		'enquiry',
		array(
			'labels'          => array(
				'name'          => __( 'Enquiries', 'zest' ),
				'singular_name' => __( 'Enquiry', 'zest' ),
			),
			'public'          => false,
			'show_ui'         => true,
			'menu_icon'       => 'dashicons-email-alt',
			'menu_position'   => 22,
			'supports'        => array( 'title', 'editor' ),
			'capability_type' => 'post',
			'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
			'map_meta_cap'    => true,
		)
	);
}
add_action( 'init', 'zest_register_types' );

/**
 * Replace %vertical% in service permalinks with the primary vertical slug.
 *
 * @param string  $link Permalink.
 * @param WP_Post $post Post.
 * @return string
 */
function zest_service_permalink( $link, $post ) {
	if ( 'service' !== $post->post_type || false === strpos( $link, '%vertical%' ) ) {
		return $link;
	}
	$terms = get_the_terms( $post, 'vertical' );
	$slug  = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->slug : 'general';
	return str_replace( '%vertical%', $slug, $link );
}
add_filter( 'post_type_link', 'zest_service_permalink', 10, 2 );

/**
 * Services keep a manual order (menu_order) everywhere they are listed.
 *
 * @param WP_Query $query Query.
 */
function zest_service_order( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( $query->is_tax( 'vertical' ) || $query->is_post_type_archive( 'service' ) ) {
		$query->set( 'orderby', array( 'menu_order' => 'ASC', 'title' => 'ASC' ) );
		$query->set( 'posts_per_page', 50 );
	}
}
add_action( 'pre_get_posts', 'zest_service_order' );

/**
 * Flush rewrite rules once after the theme is switched on.
 */
function zest_flush_on_switch() {
	zest_register_types();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'zest_flush_on_switch' );
