<?php
/**
 * Customizer: company contact details used across the site.
 *
 * @package zest
 */

defined( 'ABSPATH' ) || exit;

/**
 * Default company details (from the company profile decks).
 *
 * @return array
 */
function zest_contact_defaults() {
	return array(
		'phone'      => '+91 97025 70253',
		'email'      => 'departmenthead@zestholdings.in',
		'form_email' => 'departmenthead@zestholdings.in',
		'address'    => "2nd Floor, Mahendra Chambers,\n136/14 D.N. Road, near New Empire Cinema,\nMumbai 400001, Maharashtra",
		'licence'    => 'SL. MUMBAI/99/2008',
		'topbar'     => 'PSARA Licensed Security Agency · Since 2006',
		'map_query'  => 'Mahendra Chambers, D.N. Road, Fort, Mumbai 400001',
		'linkedin'   => '',
	);
}

/**
 * Get a company detail.
 *
 * @param string $key Setting key.
 * @return string
 */
function zest_opt( $key ) {
	$defaults = zest_contact_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	$value    = get_theme_mod( 'zest_' . $key, $default );
	return '' === $value ? $default : $value;
}

/**
 * Phone number stripped for tel: links.
 *
 * @return string
 */
function zest_phone_href() {
	return 'tel:' . preg_replace( '/[^0-9+]/', '', zest_opt( 'phone' ) );
}

/**
 * Register Customizer settings.
 *
 * @param WP_Customize_Manager $wp_customize Manager.
 */
function zest_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'zest_company',
		array(
			'title'    => __( 'Zest – Company details', 'zest' ),
			'priority' => 30,
		)
	);

	$fields = array(
		'phone'      => array( __( 'Phone', 'zest' ), 'text', 'sanitize_text_field' ),
		'email'      => array( __( 'Public email', 'zest' ), 'email', 'sanitize_email' ),
		'form_email' => array( __( 'Send form enquiries to', 'zest' ), 'email', 'sanitize_email' ),
		'address'    => array( __( 'Head office address', 'zest' ), 'textarea', 'sanitize_textarea_field' ),
		'licence'    => array( __( 'PSARA licence no.', 'zest' ), 'text', 'sanitize_text_field' ),
		'topbar'     => array( __( 'Top bar text', 'zest' ), 'text', 'sanitize_text_field' ),
		'map_query'  => array( __( 'Google Maps search text', 'zest' ), 'text', 'sanitize_text_field' ),
		'linkedin'   => array( __( 'LinkedIn URL (optional)', 'zest' ), 'url', 'esc_url_raw' ),
	);
	$defaults = zest_contact_defaults();

	foreach ( $fields as $key => $field ) {
		$wp_customize->add_setting(
			'zest_' . $key,
			array(
				'default'           => $defaults[ $key ],
				'sanitize_callback' => $field[2],
			)
		);
		$wp_customize->add_control(
			'zest_' . $key,
			array(
				'label'   => $field[0],
				'section' => 'zest_company',
				'type'    => $field[1],
			)
		);
	}
}
add_action( 'customize_register', 'zest_customize_register' );
