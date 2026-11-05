<?php
/**
 * Template helpers: icons, logo, heroes, breadcrumbs, placeholders.
 *
 * @package zest
 */

defined( 'ABSPATH' ) || exit;

/**
 * Inline SVG icon (24px line icons, stroke = currentColor).
 *
 * @param string $name  Icon name.
 * @param int    $size  Pixel size.
 * @param string $class Extra class.
 * @return string
 */
function zest_icon( $name, $size = 24, $class = '' ) {
	$paths = array(
		'shield'   => '<path d="M12 2l8 3v6c0 5-3.5 9.5-8 11-4.5-1.5-8-6-8-11V5l8-3z"/>',
		'guard'    => '<path d="M12 2l8 3v6c0 5-3.5 9.5-8 11-4.5-1.5-8-6-8-11V5l8-3z"/><path d="M8.5 12l2.5 2.5 4.5-5"/>',
		'bank'     => '<path d="M3 10l9-6 9 6"/><path d="M5 10v8M9.5 10v8M14.5 10v8M19 10v8"/><path d="M3 20h18"/>',
		'van'      => '<path d="M2 7h11v9H2z"/><path d="M13 10h4l4 3v3h-8"/><circle cx="6" cy="17.5" r="1.8"/><circle cx="17" cy="17.5" r="1.8"/>',
		'camera'   => '<path d="M3 7l12-3 2 6-12 3z"/><path d="M15 10l4 1-1 3"/><path d="M8 12l-1 6H4"/>',
		'dog'      => '<path d="M5 9l2-5 3 3h4l3-3 2 5v4a7 7 0 0 1-14 0z"/><circle cx="9.5" cy="11" r=".6" fill="currentColor"/><circle cx="14.5" cy="11" r=".6" fill="currentColor"/><path d="M11 15h2l-1 1.2z"/>',
		'user'     => '<circle cx="12" cy="7.5" r="3.8"/><path d="M4.5 21a7.5 7.5 0 0 1 15 0"/><path d="M15.5 4.5l2-1.5"/>',
		'search'   => '<circle cx="10.5" cy="10.5" r="6.5"/><path d="M20 20l-4.8-4.8"/>',
		'chart'    => '<path d="M4 20V10M10 20V4M16 20v-7M21 20H3"/>',
		'event'    => '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/><path d="M9 15l2 2 4-4"/>',
		'broom'    => '<path d="M15 3l-5 9"/><path d="M6.5 11.5l7 4-2.5 5.5-7-1z"/><path d="M8 17.5l-1.5 3"/>',
		'building' => '<path d="M4 21V4h11v17"/><path d="M15 9h5v12"/><path d="M8 8h3M8 12h3M8 16h3M3 21h18"/>',
		'factory'  => '<path d="M3 21V10l6 4V10l6 4V6h6v15z"/><path d="M7 18h2M12 18h2M17 18h2"/>',
		'hospital' => '<rect x="4" y="3" width="16" height="18" rx="2"/><path d="M12 7v6M9 10h6M9 21v-4h6v4"/>',
		'spark'    => '<path d="M12 3v4M12 17v4M3 12h4M17 12h4M6 6l2.5 2.5M15.5 15.5L18 18M6 18l2.5-2.5M15.5 8.5L18 6"/>',
		'bug'      => '<ellipse cx="12" cy="13" rx="5" ry="6.5"/><path d="M12 6.5V20M7 10l-3-2M17 10l3-2M7 15H3.5M17 15h3.5M9 4.5l1.5 2M15 4.5l-1.5 2"/>',
		'tools'    => '<path d="M14.5 6.5a4 4 0 0 0-5.3 5L3 17.8 6.2 21l6.3-6.2a4 4 0 0 0 5-5.3l-2.6 2.6-2.6-.7-.7-2.6z"/>',
		'utensils' => '<path d="M6 3v8a2 2 0 0 0 4 0V3M8 11v10"/><path d="M17 21V3c-2 1.5-3 4-3 8h3"/>',
		'cup'      => '<path d="M4 9h13v5a5 5 0 0 1-5 5H9a5 5 0 0 1-5-5z"/><path d="M17 11h1.5a2.5 2.5 0 0 1 0 5H17M8 3v3M12 3v3"/>',
		'coffee'   => '<rect x="6" y="3" width="12" height="18" rx="2"/><path d="M9 7h6M9 11h6"/><circle cx="12" cy="16" r="1.6"/>',
		'pot'      => '<path d="M4 10h16v5a5 5 0 0 1-5 5H9a5 5 0 0 1-5-5z"/><path d="M2 10h20M9 6c0-1 1-1 1-2M14 6c0-1 1-1 1-2"/>',
		'leaf'     => '<path d="M5 19c0-9 6-14 15-14 0 9-5 15-14 15z"/><path d="M5 19l8-8"/>',
		'check'    => '<path d="M5 12l5 5 9-10"/>',
		'phone'    => '<path d="M5 3h4l2 5-2.5 1.5a11 11 0 0 0 6 6L16 13l5 2v4a2 2 0 0 1-2 2A17 17 0 0 1 3 5a2 2 0 0 1 2-2z"/>',
		'mail'     => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/>',
		'pin'      => '<path d="M12 21s-7-6.2-7-11.5a7 7 0 0 1 14 0C19 14.8 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/>',
		'clock'    => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		'briefcase' => '<rect x="3" y="7" width="18" height="13" rx="2"/><path d="M9 7V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2M3 13h18"/>',
		'arrow'    => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'chevron'  => '<path d="M6 9l6 6 6-6"/>',
		'award'    => '<circle cx="12" cy="9" r="6"/><path d="M8.5 14l-1.5 7 5-3 5 3-1.5-7"/>',
		'people'   => '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20a6.5 6.5 0 0 1 13 0"/><circle cx="17" cy="9" r="2.6"/><path d="M16 14a5 5 0 0 1 5.5 5"/>',
		'scan'     => '<path d="M4 8V4h4M16 4h4v4M20 16v4h-4M8 20H4v-4"/><circle cx="12" cy="11" r="3"/><path d="M7.5 17a5 5 0 0 1 9 0"/>',
		'car'      => '<path d="M3 16v-4l2-5h14l2 5v4z"/><path d="M3 12h18"/><circle cx="7" cy="16.5" r="1.8"/><circle cx="17" cy="16.5" r="1.8"/>',
		'location' => '<circle cx="12" cy="12" r="3"/><circle cx="12" cy="12" r="8"/><path d="M12 2v2M12 20v2M2 12h2M20 12h2"/>',
		'display'  => '<rect x="2" y="4" width="20" height="13" rx="2"/><path d="M8 21h8M12 17v4M6 9h8M6 12h5"/>',
		'graduate' => '<path d="M2 9l10-5 10 5-10 5z"/><path d="M6 11v5c3 2.5 9 2.5 12 0v-5M22 9v6"/>',
	);
	$path = isset( $paths[ $name ] ) ? $paths[ $name ] : $paths['shield'];
	return sprintf(
		'<svg class="icon %1$s" width="%2$d" height="%2$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%3$s</svg>',
		esc_attr( $class ),
		(int) $size,
		$path // Static markup defined above.
	);
}

/**
 * Echo an icon. Icon markup is static and trusted.
 *
 * @param string $name Icon name.
 * @param int    $size Size.
 * @param string $class Class.
 */
function zest_the_icon( $name, $size = 24, $class = '' ) {
	echo zest_icon( $name, $size, $class ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- static SVG.
}

/**
 * Logo image (custom logo if set, else bundled WebP with PNG fallback).
 *
 * @param string $variant 'full' (horse + ZEST FACILITY) or 'emblem'.
 * @param int    $height  Display height.
 * @param string $alt     Alt text.
 */
function zest_logo_img( $variant = 'full', $height = 84, $alt = '' ) {
	if ( 'full' === $variant && has_custom_logo() ) {
		$id = get_theme_mod( 'custom_logo' );
		echo wp_get_attachment_image( $id, 'full', false, array( 'style' => 'height:' . (int) $height . 'px;width:auto', 'alt' => $alt ? $alt : get_bloginfo( 'name' ) ) );
		return;
	}
	$file = 'emblem' === $variant ? 'zest-emblem' : 'zest-logo';
	$dims = 'emblem' === $variant ? array( 233, 224 ) : array( 444, 582 );
	$alt  = $alt ? $alt : __( 'Zest Facility logo', 'zest' );
	printf(
		'<picture><source srcset="%1$s" type="image/webp"><img src="%2$s" alt="%3$s" width="%4$d" height="%5$d" style="height:%6$dpx;width:auto" decoding="async"></picture>',
		esc_url( ZEST_URI . '/assets/img/' . $file . '.webp' ),
		esc_url( ZEST_URI . '/assets/img/' . $file . '.png' ),
		esc_attr( $alt ),
		(int) $dims[0],
		(int) $dims[1],
		(int) $height
	);
}

/**
 * All vertical terms in display order.
 *
 * @return WP_Term[]
 */
function zest_verticals() {
	$terms = get_terms(
		array(
			'taxonomy'   => 'vertical',
			'hide_empty' => false,
			'meta_key'   => 'zest_order', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- tiny table.
			'orderby'    => 'meta_value_num',
			'order'      => 'ASC',
		)
	);
	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		$terms = get_terms( array( 'taxonomy' => 'vertical', 'hide_empty' => false ) );
	}
	return is_wp_error( $terms ) ? array() : $terms;
}

/**
 * Services in a vertical.
 *
 * @param int|WP_Term $term    Term.
 * @param int         $limit   Max posts.
 * @param int         $exclude Post ID to exclude.
 * @return WP_Post[]
 */
function zest_services_in( $term, $limit = -1, $exclude = 0 ) {
	$term_id = is_object( $term ) ? $term->term_id : (int) $term;
	return get_posts(
		array(
			'post_type'      => 'service',
			'posts_per_page' => $limit,
			'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
			'post__not_in'   => $exclude ? array( $exclude ) : array(),
			'tax_query'      => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
				array(
					'taxonomy' => 'vertical',
					'terms'    => $term_id,
				),
			),
		)
	);
}

/**
 * Primary vertical of a service.
 *
 * @param int|null $post_id Post ID.
 * @return WP_Term|null
 */
function zest_service_vertical( $post_id = null ) {
	$terms = get_the_terms( $post_id ? $post_id : get_the_ID(), 'vertical' );
	return ( $terms && ! is_wp_error( $terms ) ) ? $terms[0] : null;
}

/**
 * Breadcrumb trail.
 */
function zest_breadcrumbs() {
	$items = array( array( __( 'Home', 'zest' ), home_url( '/' ) ) );

	if ( is_singular( 'service' ) ) {
		$items[] = array( __( 'Services', 'zest' ), get_post_type_archive_link( 'service' ) );
		$vertical = zest_service_vertical();
		if ( $vertical ) {
			$items[] = array( $vertical->name, get_term_link( $vertical ) );
		}
		$items[] = array( get_the_title(), '' );
	} elseif ( is_tax( 'vertical' ) ) {
		$items[] = array( __( 'Services', 'zest' ), get_post_type_archive_link( 'service' ) );
		$items[] = array( single_term_title( '', false ), '' );
	} elseif ( is_post_type_archive( 'service' ) ) {
		$items[] = array( __( 'Services', 'zest' ), '' );
	} elseif ( is_singular( 'job' ) ) {
		$careers = get_page_by_path( 'careers' );
		if ( $careers ) {
			$items[] = array( get_the_title( $careers ), get_permalink( $careers ) );
		}
		$items[] = array( get_the_title(), '' );
	} elseif ( is_page() ) {
		foreach ( array_reverse( get_post_ancestors( get_the_ID() ) ) as $ancestor ) {
			$items[] = array( get_the_title( $ancestor ), get_permalink( $ancestor ) );
		}
		$items[] = array( get_the_title(), '' );
	} elseif ( is_404() ) {
		$items[] = array( __( 'Page not found', 'zest' ), '' );
	} elseif ( is_search() ) {
		$items[] = array( __( 'Search', 'zest' ), '' );
	}

	echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'zest' ) . '"><ol>';
	$last = count( $items ) - 1;
	foreach ( $items as $i => $item ) {
		if ( $item[1] && $i !== $last ) {
			printf( '<li><a href="%s">%s</a></li>', esc_url( $item[1] ), esc_html( $item[0] ) );
		} else {
			printf( '<li aria-current="page">%s</li>', esc_html( $item[0] ) );
		}
	}
	echo '</ol></nav>';
}

/**
 * Inner page hero.
 *
 * @param array $args eyebrow, title, text, buttons (bool), icon.
 */
function zest_page_hero( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'eyebrow' => '',
			'title'   => get_the_title(),
			'text'    => '',
			'buttons' => false,
			'icon'    => '',
		)
	);
	get_template_part( 'template-parts/page-hero', null, $args );
}

/**
 * Hero args for a regular page, read from page fields with defaults.
 *
 * @param string $eyebrow Default eyebrow.
 * @param string $text    Default intro text.
 * @return array
 */
function zest_page_hero_args( $eyebrow = '', $text = '' ) {
	return array(
		'eyebrow' => zest_field( 'zest_eyebrow', $eyebrow ),
		'title'   => zest_field( 'zest_hero_title', get_the_title() ),
		'text'    => zest_field( 'zest_tagline', $text ),
	);
}

/**
 * Labelled image placeholder until real photography arrives.
 *
 * @param string $label  What photo should go here.
 * @param string $ratio  CSS aspect-ratio.
 * @param string $class  Extra class.
 */
function zest_placeholder( $label, $ratio = '4 / 3', $class = '' ) {
	printf(
		'<div class="placeholder %1$s" style="aspect-ratio:%2$s" role="img" aria-label="%3$s"><span>%4$s<small>%5$s</small></span></div>',
		esc_attr( $class ),
		esc_attr( $ratio ),
		esc_attr( $label ),
		zest_icon( 'camera', 28 ), // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- static SVG.
		esc_html( $label )
	);
}

/**
 * Featured image if present, otherwise a labelled placeholder.
 *
 * @param string   $label   Placeholder label.
 * @param string   $ratio   Aspect ratio.
 * @param int|null $post_id Post ID.
 */
function zest_media( $label, $ratio = '4 / 3', $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	if ( has_post_thumbnail( $post_id ) ) {
		echo '<div class="media" style="aspect-ratio:' . esc_attr( $ratio ) . '">';
		echo get_the_post_thumbnail( $post_id, 'zest-wide', array( 'loading' => 'lazy' ) );
		echo '</div>';
		return;
	}
	zest_placeholder( $label, $ratio );
}

/**
 * Section heading block.
 *
 * @param string $eyebrow Eyebrow.
 * @param string $title   Title.
 * @param string $text    Lead text.
 * @param string $align   'center' or 'left'.
 * @param string $tag     Heading tag.
 */
function zest_section_head( $eyebrow, $title, $text = '', $align = 'center', $tag = 'h2' ) {
	echo '<header class="section-head section-head--' . esc_attr( $align ) . '">';
	if ( $eyebrow ) {
		echo '<p class="eyebrow">' . esc_html( $eyebrow ) . '</p>';
	}
	printf( '<%1$s class="section-title">%2$s</%1$s>', tag_escape( $tag ), esc_html( $title ) );
	if ( $text ) {
		echo '<p class="section-lead">' . esc_html( $text ) . '</p>';
	}
	echo '</header>';
}

/**
 * Fallback primary menu, built from pages and verticals, used until a menu is assigned.
 */
function zest_fallback_menu() {
	echo '<ul id="primary-menu" class="menu">';
	printf( '<li class="menu-item"><a href="%s">%s</a></li>', esc_url( home_url( '/' ) ), esc_html__( 'Home', 'zest' ) );
	$about = get_page_by_path( 'about' );
	if ( $about ) {
		printf( '<li class="menu-item"><a href="%s">%s</a></li>', esc_url( get_permalink( $about ) ), esc_html__( 'About', 'zest' ) );
	}
	foreach ( zest_verticals() as $term ) {
		$label = get_term_meta( $term->term_id, 'zest_menu_label', true );
		echo '<li class="menu-item menu-item-has-children"><a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $label ? $label : $term->name ) . '</a><ul class="sub-menu">';
		foreach ( zest_services_in( $term ) as $service ) {
			printf( '<li class="menu-item"><a href="%s">%s</a></li>', esc_url( get_permalink( $service ) ), esc_html( get_the_title( $service ) ) );
		}
		echo '</ul></li>';
	}
	foreach ( array( 'careers', 'contact' ) as $slug ) {
		$page = get_page_by_path( $slug );
		if ( $page ) {
			printf( '<li class="menu-item"><a href="%s">%s</a></li>', esc_url( get_permalink( $page ) ), esc_html( get_the_title( $page ) ) );
		}
	}
	echo '</ul>';
}

/**
 * URL of a page by slug, with a home fallback.
 *
 * @param string $slug Page slug.
 * @return string
 */
function zest_page_url( $slug ) {
	$page = get_page_by_path( $slug );
	return $page ? get_permalink( $page ) : home_url( '/' . $slug . '/' );
}

/**
 * Bulleted check list.
 *
 * @param string[] $items Items.
 * @param string   $class Extra class.
 */
function zest_check_list( $items, $class = '' ) {
	if ( empty( $items ) ) {
		return;
	}
	echo '<ul class="check-list ' . esc_attr( $class ) . '">';
	foreach ( $items as $item ) {
		echo '<li>' . zest_icon( 'check', 20 ) . '<span>' . esc_html( $item ) . '</span></li>'; // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- static SVG.
	}
	echo '</ul>';
}
