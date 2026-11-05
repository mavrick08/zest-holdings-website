<?php
/**
 * Editable fields.
 *
 * Uses ACF (free) when it is active; otherwise registers equivalent native
 * meta boxes. Both store values under the same meta keys, so content survives
 * switching ACF on or off. Templates read values through zest_field().
 *
 * @package zest
 */

defined( 'ABSPATH' ) || exit;

/**
 * Field definitions per screen: key => [label, type].
 *
 * @return array
 */
function zest_field_groups() {
	return array(
		'service' => array(
			'title'  => __( 'Service details', 'zest' ),
			'fields' => array(
				'zest_tagline'          => array( __( 'Hero tagline', 'zest' ), 'textarea' ),
				'zest_features'         => array( __( 'Key features (one per line)', 'zest' ), 'textarea' ),
				'zest_industries'       => array( __( 'Industries served (one per line)', 'zest' ), 'textarea' ),
				'zest_icon'             => array( __( 'Icon name (shield, guard, bank, van, camera, dog, user, search, chart, event, broom, building, factory, hospital, spark, bug, tools, utensils, cup, coffee, leaf)', 'zest' ), 'text' ),
				'zest_meta_description' => array( __( 'SEO meta description', 'zest' ), 'textarea' ),
			),
		),
		'job'     => array(
			'title'  => __( 'Job details', 'zest' ),
			'fields' => array(
				'zest_location'   => array( __( 'Location', 'zest' ), 'text' ),
				'zest_job_type'   => array( __( 'Job type (e.g. Full-time)', 'zest' ), 'text' ),
				'zest_experience' => array( __( 'Experience', 'zest' ), 'text' ),
				'zest_vacancies'  => array( __( 'Number of openings', 'zest' ), 'text' ),
			),
		),
		'page'    => array(
			'title'  => __( 'Page hero & SEO', 'zest' ),
			'fields' => array(
				'zest_eyebrow'          => array( __( 'Hero eyebrow (small gold text)', 'zest' ), 'text' ),
				'zest_hero_title'       => array( __( 'Hero title (defaults to page title)', 'zest' ), 'text' ),
				'zest_tagline'          => array( __( 'Hero intro text', 'zest' ), 'textarea' ),
				'zest_meta_description' => array( __( 'SEO meta description', 'zest' ), 'textarea' ),
			),
		),
	);
}

/**
 * Home page fields (shown only on the page set as front page).
 *
 * @return array
 */
function zest_home_fields() {
	return array(
		'zest_home_eyebrow' => array( __( 'Hero eyebrow', 'zest' ), 'text' ),
		'zest_home_title'   => array( __( 'Hero title', 'zest' ), 'text' ),
		'zest_home_text'    => array( __( 'Hero text', 'zest' ), 'textarea' ),
		'zest_home_badges'  => array( __( 'Hero badges (one per line)', 'zest' ), 'textarea' ),
		'zest_home_stats'   => array( __( 'Stats – one per line as "Value | Label"', 'zest' ), 'textarea' ),
	);
}

/**
 * Read a field with graceful fallback.
 *
 * @param string   $key     Meta key.
 * @param mixed    $default Default when empty.
 * @param int|null $post_id Post ID.
 * @return mixed
 */
function zest_field( $key, $default = '', $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$value   = function_exists( 'get_field' ) ? get_field( $key, $post_id ) : get_post_meta( $post_id, $key, true );
	return ( '' === $value || null === $value || false === $value ) ? $default : $value;
}

/**
 * Field value split into lines.
 *
 * @param string   $key     Meta key.
 * @param int|null $post_id Post ID.
 * @return string[]
 */
function zest_field_lines( $key, $post_id = null ) {
	$value = (string) zest_field( $key, '', $post_id );
	return array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $value ) ) ) );
}

/**
 * Register ACF local field groups.
 */
function zest_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	$groups = zest_field_groups();
	$groups['home'] = array(
		'title'  => __( 'Home page content', 'zest' ),
		'fields' => zest_home_fields(),
	);

	foreach ( $groups as $screen => $group ) {
		$fields = array();
		foreach ( $group['fields'] as $key => $field ) {
			$fields[] = array(
				'key'   => 'field_' . $key . '_' . $screen,
				'name'  => $key,
				'label' => $field[0],
				'type'  => $field[1],
				'rows'  => 4,
			);
		}
		$location = 'home' === $screen
			? array( array( array( 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ) ) )
			: array( array( array( 'param' => 'post_type', 'operator' => '==', 'value' => $screen ) ) );
		if ( 'page' === $screen ) {
			$location = array( array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'page' ), array( 'param' => 'page_type', 'operator' => '!=', 'value' => 'front_page' ) ) );
		}
		acf_add_local_field_group(
			array(
				'key'      => 'group_zest_' . $screen,
				'title'    => $group['title'],
				'fields'   => $fields,
				'location' => $location,
				'position' => 'normal',
			)
		);
	}
}
add_action( 'acf/init', 'zest_register_acf_fields' );

/**
 * Native meta boxes when ACF is not installed.
 */
function zest_add_meta_boxes() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	foreach ( zest_field_groups() as $screen => $group ) {
		add_meta_box( 'zest_fields_' . $screen, $group['title'], 'zest_render_meta_box', $screen, 'normal', 'high', array( 'fields' => $group['fields'] ) );
	}
	$front = (int) get_option( 'page_on_front' );
	if ( $front && isset( $_GET['post'] ) && (int) $_GET['post'] === $front ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only screen check.
		add_meta_box( 'zest_fields_home', __( 'Home page content', 'zest' ), 'zest_render_meta_box', 'page', 'normal', 'high', array( 'fields' => zest_home_fields() ) );
	}
}
add_action( 'add_meta_boxes', 'zest_add_meta_boxes' );

/**
 * Render a native meta box.
 *
 * @param WP_Post $post Post.
 * @param array   $box  Box args.
 */
function zest_render_meta_box( $post, $box ) {
	wp_nonce_field( 'zest_save_fields', 'zest_fields_nonce' );
	echo '<p class="description">' . esc_html__( 'Leave a field empty to use the theme default.', 'zest' ) . '</p>';
	foreach ( $box['args']['fields'] as $key => $field ) {
		$value = get_post_meta( $post->ID, $key, true );
		echo '<p><label for="' . esc_attr( $key ) . '"><strong>' . esc_html( $field[0] ) . '</strong></label><br>';
		if ( 'textarea' === $field[1] ) {
			echo '<textarea class="widefat" rows="4" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '">' . esc_textarea( $value ) . '</textarea>';
		} else {
			echo '<input class="widefat" type="text" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '">';
		}
		echo '</p>';
	}
}

/**
 * Save native meta box values.
 *
 * @param int $post_id Post ID.
 */
function zest_save_meta_boxes( $post_id ) {
	if ( ! isset( $_POST['zest_fields_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['zest_fields_nonce'] ), 'zest_save_fields' ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$keys = zest_home_fields();
	foreach ( zest_field_groups() as $group ) {
		$keys = array_merge( $keys, $group['fields'] );
	}
	foreach ( $keys as $key => $field ) {
		if ( isset( $_POST[ $key ] ) ) {
			$raw = wp_unslash( $_POST[ $key ] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- sanitised below.
			update_post_meta( $post_id, $key, 'textarea' === $field[1] ? sanitize_textarea_field( $raw ) : sanitize_text_field( $raw ) );
		}
	}
}
add_action( 'save_post', 'zest_save_meta_boxes' );

/**
 * Vertical term fields (tagline + intro + icon) on the term edit screen.
 *
 * @param WP_Term $term Term.
 */
function zest_vertical_edit_fields( $term ) {
	wp_nonce_field( 'zest_save_term', 'zest_term_nonce' );
	$fields = array(
		'zest_tagline'  => __( 'Hero tagline', 'zest' ),
		'zest_short'    => __( 'Short card description (home page)', 'zest' ),
		'zest_badge'    => __( 'Badge (e.g. Core business)', 'zest' ),
		'zest_icon'     => __( 'Icon name', 'zest' ),
		'zest_menu_label' => __( 'Short menu label', 'zest' ),
	);
	foreach ( $fields as $key => $label ) {
		if ( 'zest_short' === $key ) {
			printf(
				'<tr class="form-field"><th scope="row"><label for="%1$s">%2$s</label></th><td><textarea id="%1$s" name="%1$s" rows="3">%3$s</textarea></td></tr>',
				esc_attr( $key ),
				esc_html( $label ),
				esc_textarea( get_term_meta( $term->term_id, $key, true ) )
			);
			continue;
		}
		printf(
			'<tr class="form-field"><th scope="row"><label for="%1$s">%2$s</label></th><td><input type="text" id="%1$s" name="%1$s" value="%3$s"></td></tr>',
			esc_attr( $key ),
			esc_html( $label ),
			esc_attr( get_term_meta( $term->term_id, $key, true ) )
		);
	}
	printf(
		'<tr class="form-field"><th scope="row"><label for="zest_highlights">%1$s</label></th><td><textarea id="zest_highlights" name="zest_highlights" rows="6">%2$s</textarea><p class="description">%3$s</p></td></tr>',
		esc_html__( 'Why choose us – highlights', 'zest' ),
		esc_textarea( get_term_meta( $term->term_id, 'zest_highlights', true ) ),
		esc_html__( 'One per line, as "Title | Description".', 'zest' )
	);
}
add_action( 'vertical_edit_form_fields', 'zest_vertical_edit_fields' );

/**
 * Save vertical term fields.
 *
 * @param int $term_id Term ID.
 */
function zest_vertical_save_fields( $term_id ) {
	if ( ! isset( $_POST['zest_term_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['zest_term_nonce'] ), 'zest_save_term' ) || ! current_user_can( 'manage_categories' ) ) {
		return;
	}
	foreach ( array( 'zest_tagline', 'zest_short', 'zest_badge', 'zest_icon', 'zest_menu_label', 'zest_highlights' ) as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_term_meta( $term_id, $key, sanitize_textarea_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
}
add_action( 'edited_vertical', 'zest_vertical_save_fields' );
