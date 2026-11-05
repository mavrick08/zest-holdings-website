<?php
/**
 * SEO basics: meta description, Open Graph, Organization + LocalBusiness JSON-LD.
 * Skipped automatically when Yoast SEO or Rank Math is active.
 *
 * @package zest
 */

defined( 'ABSPATH' ) || exit;

/**
 * Whether a dedicated SEO plugin handles meta tags.
 *
 * @return bool
 */
function zest_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' );
}

/**
 * Meta description for the current view.
 *
 * @return string
 */
function zest_meta_description() {
	$default = __( 'Zest Holdings – PSARA-licensed security, housekeeping & facility management and cafeteria services in Mumbai since 2006. 15,000+ trained staff serving 100+ clients across Maharashtra, Karnataka, Goa and Rajasthan.', 'zest' );

	if ( is_front_page() ) {
		return zest_field( 'zest_meta_description', $default, (int) get_option( 'page_on_front' ) );
	}
	if ( is_tax( 'vertical' ) ) {
		$term = get_queried_object();
		return wp_strip_all_tags( $term->description ? $term->description : $default );
	}
	if ( is_singular() ) {
		$custom = zest_field( 'zest_meta_description' );
		if ( $custom ) {
			return $custom;
		}
		$post = get_queried_object();
		if ( has_excerpt( $post ) ) {
			return wp_strip_all_tags( get_the_excerpt( $post ) );
		}
		$tagline = zest_field( 'zest_tagline' );
		if ( $tagline ) {
			return $tagline;
		}
		$text = wp_strip_all_tags( strip_shortcodes( $post->post_content ) );
		return $text ? wp_trim_words( $text, 28, '…' ) : $default;
	}
	return $default;
}

/**
 * Output meta description + Open Graph tags.
 */
function zest_meta_tags() {
	if ( zest_seo_plugin_active() ) {
		return;
	}
	$desc  = trim( preg_replace( '/\s+/', ' ', zest_meta_description() ) );
	$title = wp_get_document_title();
	$url   = is_singular() ? get_permalink() : ( is_tax() ? get_term_link( get_queried_object() ) : home_url( add_query_arg( array() ) ) );

	printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );
	printf( '<meta property="og:type" content="website">' . "\n" );
	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
	printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $desc ) );
	if ( ! is_wp_error( $url ) ) {
		printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $url ) );
	}
	printf( '<meta property="og:image" content="%s">' . "\n", esc_url( ZEST_URI . '/assets/img/zest-logo.png' ) );
	echo '<meta name="twitter:card" content="summary">' . "\n";
}
add_action( 'wp_head', 'zest_meta_tags', 2 );

/**
 * Organization + LocalBusiness structured data (all pages; Yoast/Rank Math also add their own graph).
 */
function zest_schema() {
	$address = array_map( 'trim', explode( "\n", zest_opt( 'address' ) ) );
	$same_as = array_filter( array( zest_opt( 'linkedin' ) ) );

	$org = array(
		'@context'     => 'https://schema.org',
		'@type'        => array( 'Organization', 'LocalBusiness' ),
		'@id'          => home_url( '/#organization' ),
		'name'         => 'Zest Holdings Pvt. Ltd.',
		'alternateName' => 'Zest Facility',
		'url'          => home_url( '/' ),
		'logo'         => ZEST_URI . '/assets/img/zest-logo.png',
		'image'        => ZEST_URI . '/assets/img/zest-logo.png',
		'description'  => __( 'Security services, housekeeping & facility management and cafeteria services since 2006.', 'zest' ),
		'foundingDate' => '2006',
		'telephone'    => zest_opt( 'phone' ),
		'email'        => zest_opt( 'email' ),
		'numberOfEmployees' => array(
			'@type'    => 'QuantitativeValue',
			'minValue' => 15000,
		),
		'address'      => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => trim( implode( ', ', array_slice( $address, 0, 2 ) ), ', ' ),
			'addressLocality' => 'Mumbai',
			'addressRegion'   => 'Maharashtra',
			'postalCode'      => '400001',
			'addressCountry'  => 'IN',
		),
		'areaServed'   => array( 'Maharashtra', 'Karnataka', 'Goa', 'Rajasthan' ),
		'memberOf'     => array(
			'@type' => 'Organization',
			'name'  => 'ASIS International',
		),
	);
	if ( $same_as ) {
		$org['sameAs'] = array_values( $same_as );
	}

	echo '<script type="application/ld+json">' . wp_json_encode( $org, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";

	if ( is_singular( 'service' ) ) {
		$service = array(
			'@context'    => 'https://schema.org',
			'@type'       => 'Service',
			'name'        => get_the_title(),
			'description' => zest_meta_description(),
			'provider'    => array( '@id' => home_url( '/#organization' ) ),
			'areaServed'  => 'IN',
			'url'         => get_permalink(),
		);
		$vertical = zest_service_vertical();
		if ( $vertical ) {
			$service['serviceType'] = $vertical->name;
		}
		echo '<script type="application/ld+json">' . wp_json_encode( $service, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
	}
}
add_action( 'wp_head', 'zest_schema', 20 );

/**
 * Tidy document titles: "Page – Zest Holdings".
 *
 * @param string $sep Separator.
 * @return string
 */
function zest_title_separator( $sep ) {
	return '–';
}
add_filter( 'document_title_separator', 'zest_title_separator' );
