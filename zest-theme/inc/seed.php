<?php
/**
 * One-click / WP-CLI content setup.
 *
 * Creates verticals, services, pages, demo jobs and menus, sets the static
 * front page and pretty permalinks. Safe to run again: existing items (matched
 * by slug) are left untouched, so edits made in wp-admin are never overwritten.
 *
 *   WP-CLI:  wp eval-file wp-content/themes/zest-theme/seed/seed.php
 *   Admin:   Appearance → Zest Setup → "Create site content"
 *
 * @package zest
 */

defined( 'ABSPATH' ) || exit;

require_once ZEST_DIR . '/inc/seed-data.php';

/**
 * Run the seed.
 *
 * @return string[] Log lines.
 */
function zest_run_seed() {
	$log = array();

	// Permalinks first so generated links are pretty.
	if ( '/%postname%/' !== get_option( 'permalink_structure' ) ) {
		update_option( 'permalink_structure', '/%postname%/' );
		$log[] = 'Permalinks set to /%postname%/';
	}
	zest_register_types();

	// Verticals.
	$term_ids = array();
	foreach ( zest_seed_verticals() as $slug => $v ) {
		$existing = get_term_by( 'slug', $slug, 'vertical' );
		if ( $existing ) {
			$term_ids[ $slug ] = (int) $existing->term_id;
			$log[]             = "Vertical exists: {$v['name']}";
			continue;
		}
		$result = wp_insert_term( $v['name'], 'vertical', array( 'slug' => $slug, 'description' => $v['description'] ) );
		if ( is_wp_error( $result ) ) {
			$log[] = 'ERROR vertical ' . $slug . ': ' . $result->get_error_message();
			continue;
		}
		$term_ids[ $slug ] = (int) $result['term_id'];
		update_term_meta( $result['term_id'], 'zest_order', $v['order'] );
		update_term_meta( $result['term_id'], 'zest_icon', $v['icon'] );
		update_term_meta( $result['term_id'], 'zest_badge', $v['badge'] );
		update_term_meta( $result['term_id'], 'zest_tagline', $v['tagline'] );
		update_term_meta( $result['term_id'], 'zest_short', $v['short'] );
		update_term_meta( $result['term_id'], 'zest_menu_label', $v['menu_label'] );
		update_term_meta( $result['term_id'], 'zest_highlights', $v['highlights'] );
		$log[] = "Vertical created: {$v['name']}";
	}

	// Pages.
	$page_ids = array();
	foreach ( zest_seed_pages() as $slug => $page ) {
		$existing = get_page_by_path( $slug );
		if ( $existing ) {
			$page_ids[ $slug ] = $existing->ID;
			$log[]             = "Page exists: {$page[0]}";
			continue;
		}
		$page_ids[ $slug ] = wp_insert_post(
			array(
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_title'   => $page[0],
				'post_name'    => $slug,
				'post_content' => $page[1],
			)
		);
		$log[] = "Page created: {$page[0]}";
	}

	// Services.
	$order       = 0;
	$service_ids = array();
	foreach ( zest_seed_services() as $slug => $s ) {
		++$order;
		$existing = get_page_by_path( $slug, OBJECT, 'service' );
		if ( $existing ) {
			$service_ids[ $slug ] = $existing->ID;
			$log[]                = "Service exists: {$s['title']}";
			continue;
		}
		$content = str_replace( 'href="/smart-solutions/"', 'href="' . esc_url( home_url( '/smart-solutions/' ) ) . '"', $s['content'] );
		$id      = wp_insert_post(
			array(
				'post_type'    => 'service',
				'post_status'  => 'publish',
				'post_title'   => $s['title'],
				'post_name'    => $slug,
				'post_excerpt' => $s['excerpt'],
				'post_content' => $content,
				'menu_order'   => $order,
			)
		);
		if ( ! $id || is_wp_error( $id ) ) {
			$log[] = 'ERROR service ' . $slug;
			continue;
		}
		if ( isset( $term_ids[ $s['vertical'] ] ) ) {
			wp_set_object_terms( $id, $term_ids[ $s['vertical'] ], 'vertical' );
		}
		update_post_meta( $id, 'zest_tagline', $s['tagline'] );
		update_post_meta( $id, 'zest_icon', $s['icon'] );
		update_post_meta( $id, 'zest_features', $s['features'] );
		update_post_meta( $id, 'zest_industries', $s['industries'] );
		$service_ids[ $slug ] = $id;
		$log[]                = "Service created: {$s['title']}";
	}

	// Jobs.
	$order = 0;
	foreach ( zest_seed_jobs() as $slug => $job ) {
		++$order;
		if ( get_page_by_path( $slug, OBJECT, 'job' ) ) {
			$log[] = "Job exists: {$job['title']}";
			continue;
		}
		$id = wp_insert_post(
			array(
				'post_type'    => 'job',
				'post_status'  => 'publish',
				'post_title'   => $job['title'],
				'post_name'    => $slug,
				'post_excerpt' => $job['excerpt'],
				'post_content' => $job['content'],
				'menu_order'   => $order,
			)
		);
		foreach ( $job['meta'] as $key => $value ) {
			update_post_meta( $id, $key, $value );
		}
		update_post_meta( $id, '_zest_sample', 1 );
		$log[] = "Job created: {$job['title']}";
	}

	// Reading settings.
	if ( ! empty( $page_ids['home'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $page_ids['home'] );
		$log[] = 'Front page set to Home';
	}
	if ( ! empty( $page_ids['privacy-policy'] ) ) {
		update_option( 'wp_page_for_privacy_policy', $page_ids['privacy-policy'] );
	}
	if ( in_array( get_option( 'blogname' ), array( '', 'My WordPress Website', 'My WordPress Site', 'WordPress' ), true ) ) {
		update_option( 'blogname', 'Zest Holdings' );
	}
	update_option( 'blogdescription', 'Security, Housekeeping & Facility Management and Cafeteria Services since 2006' );

	// WordPress moves default widgets (Archives, Categories…) into the first sidebar on theme switch – clear ours.
	$sidebars = get_option( 'sidebars_widgets', array() );
	foreach ( array( 'footer-about', 'footer-bottom' ) as $sidebar ) {
		if ( ! empty( $sidebars[ $sidebar ] ) ) {
			$sidebars['wp_inactive_widgets'] = array_merge( isset( $sidebars['wp_inactive_widgets'] ) ? (array) $sidebars['wp_inactive_widgets'] : array(), $sidebars[ $sidebar ] );
			$sidebars[ $sidebar ]            = array();
			$log[]                           = "Default widgets moved out of {$sidebar}";
		}
	}
	update_option( 'sidebars_widgets', $sidebars );

	$log = array_merge( $log, zest_seed_menus( $page_ids, $term_ids ) );

	flush_rewrite_rules();
	$log[] = 'Rewrite rules flushed. Done.';
	update_option( 'zest_seeded', time() );

	return $log;
}

/**
 * Build primary + footer menus (only if they do not already exist).
 *
 * @param array $page_ids Page IDs by slug.
 * @param array $term_ids Vertical term IDs by slug.
 * @return string[]
 */
function zest_seed_menus( $page_ids, $term_ids ) {
	$log       = array();
	$locations = get_theme_mod( 'nav_menu_locations', array() );

	if ( ! wp_get_nav_menu_object( 'Primary' ) ) {
		$menu_id = wp_create_nav_menu( 'Primary' );
		$pos     = 0;

		$add_page = static function ( $slug, $label = '', $parent = 0 ) use ( $menu_id, $page_ids, &$pos ) {
			if ( empty( $page_ids[ $slug ] ) ) {
				return 0;
			}
			return wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title'     => $label,
					'menu-item-object'    => 'page',
					'menu-item-object-id' => $page_ids[ $slug ],
					'menu-item-type'      => 'post_type',
					'menu-item-status'    => 'publish',
					'menu-item-parent-id' => $parent,
					'menu-item-position'  => ++$pos,
				)
			);
		};

		$add_page( 'home', 'Home' );
		$about = $add_page( 'about', 'About' );
		$add_page( 'about', 'About Us', $about );
		$add_page( 'industries', 'Industries We Serve', $about );

		foreach ( zest_seed_verticals() as $slug => $v ) {
			if ( empty( $term_ids[ $slug ] ) ) {
				continue;
			}
			$parent = wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title'     => $v['menu_label'],
					'menu-item-object'    => 'vertical',
					'menu-item-object-id' => $term_ids[ $slug ],
					'menu-item-type'      => 'taxonomy',
					'menu-item-status'    => 'publish',
					'menu-item-position'  => ++$pos,
				)
			);
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title'     => 'Overview – ' . $v['menu_label'],
					'menu-item-object'    => 'vertical',
					'menu-item-object-id' => $term_ids[ $slug ],
					'menu-item-type'      => 'taxonomy',
					'menu-item-status'    => 'publish',
					'menu-item-parent-id' => $parent,
					'menu-item-classes'   => 'menu-item--overview',
					'menu-item-position'  => ++$pos,
				)
			);
			foreach ( zest_services_in( $term_ids[ $slug ] ) as $service ) {
				wp_update_nav_menu_item(
					$menu_id,
					0,
					array(
						'menu-item-object'    => 'service',
						'menu-item-object-id' => $service->ID,
						'menu-item-type'      => 'post_type',
						'menu-item-status'    => 'publish',
						'menu-item-parent-id' => $parent,
						'menu-item-position'  => ++$pos,
					)
				);
			}
			if ( 'security-services' === $slug ) {
				$add_page( 'smart-solutions', 'Smart Security Solutions', $parent );
			}
		}

		$add_page( 'careers', 'Careers' );
		$add_page( 'contact', 'Contact' );

		$locations['primary'] = $menu_id;
		$log[]                = 'Primary menu created';
	}

	if ( ! wp_get_nav_menu_object( 'Footer' ) ) {
		$menu_id = wp_create_nav_menu( 'Footer' );
		$pos     = 0;
		foreach ( array( 'about' => 'About', 'industries' => 'Industries', 'smart-solutions' => 'Smart Solutions', 'careers' => 'Careers', 'request-a-quote' => 'Request a Quote', 'contact' => 'Contact' ) as $slug => $label ) {
			if ( empty( $page_ids[ $slug ] ) ) {
				continue;
			}
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title'     => $label,
					'menu-item-object'    => 'page',
					'menu-item-object-id' => $page_ids[ $slug ],
					'menu-item-type'      => 'post_type',
					'menu-item-status'    => 'publish',
					'menu-item-position'  => ++$pos,
				)
			);
		}
		$locations['footer'] = $menu_id;
		$log[]               = 'Footer menu created';
	}

	set_theme_mod( 'nav_menu_locations', $locations );
	return $log;
}

/**
 * Admin page: Appearance → Zest Setup.
 */
function zest_setup_menu() {
	add_theme_page( __( 'Zest Setup', 'zest' ), __( 'Zest Setup', 'zest' ), 'manage_options', 'zest-setup', 'zest_setup_page' );
}
add_action( 'admin_menu', 'zest_setup_menu' );

/**
 * Render admin setup page / run seed.
 */
function zest_setup_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	echo '<div class="wrap"><h1>' . esc_html__( 'Zest Setup', 'zest' ) . '</h1>';

	if ( isset( $_POST['zest_seed'] ) && check_admin_referer( 'zest_seed' ) ) {
		$log = zest_run_seed();
		echo '<div class="notice notice-success"><p>' . esc_html__( 'Site content created.', 'zest' ) . '</p></div>';
		echo '<pre style="background:#fff;padding:12px;max-height:400px;overflow:auto">' . esc_html( implode( "\n", $log ) ) . '</pre>';
	}

	echo '<p>' . esc_html__( 'Creates all pages, the three service verticals with their service pages, sample job openings and the main/footer menus, and sets the Home page as the front page. Existing items with the same slug are never overwritten, so it is safe to run again.', 'zest' ) . '</p>';
	echo '<form method="post">';
	wp_nonce_field( 'zest_seed' );
	submit_button( __( 'Create site content', 'zest' ), 'primary', 'zest_seed' );
	echo '</form></div>';
}

/**
 * Nudge admins to run setup after activating the theme.
 */
function zest_setup_notice() {
	if ( get_option( 'zest_seeded' ) || ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$screen = get_current_screen();
	if ( $screen && 'appearance_page_zest-setup' === $screen->id ) {
		return;
	}
	printf(
		'<div class="notice notice-info"><p><strong>Zest Holdings theme:</strong> %s <a class="button button-primary" href="%s">%s</a></p></div>',
		esc_html__( 'Create all pages, services and menus in one click.', 'zest' ),
		esc_url( admin_url( 'themes.php?page=zest-setup' ) ),
		esc_html__( 'Run Zest Setup', 'zest' )
	);
}
add_action( 'admin_notices', 'zest_setup_notice' );
