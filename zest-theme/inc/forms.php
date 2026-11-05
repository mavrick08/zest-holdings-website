<?php
/**
 * Native forms: contact, quote request, job application (with CV upload).
 *
 * Every submission is saved as a private "Enquiry" in wp-admin and emailed via
 * wp_mail() to the address set in Customizer → Zest – Company details.
 * Install an SMTP plugin (e.g. WP Mail SMTP) on the live host for reliable delivery.
 *
 * @package zest
 */

defined( 'ABSPATH' ) || exit;

/**
 * Field definitions per form type.
 *
 * @return array
 */
function zest_form_fields() {
	$service_options = array();
	foreach ( zest_verticals() as $term ) {
		foreach ( zest_services_in( $term ) as $service ) {
			$service_options[ $term->name ][] = get_the_title( $service );
		}
	}

	$common = array(
		'name'  => array( 'label' => __( 'Full name', 'zest' ), 'type' => 'text', 'required' => true, 'auto' => 'name' ),
		'phone' => array( 'label' => __( 'Phone', 'zest' ), 'type' => 'tel', 'required' => true, 'auto' => 'tel' ),
		'email' => array( 'label' => __( 'Email', 'zest' ), 'type' => 'email', 'required' => true, 'auto' => 'email' ),
	);

	return array(
		'contact' => array(
			'subject' => __( 'Website enquiry', 'zest' ),
			'button'  => __( 'Send message', 'zest' ),
			'fields'  => $common + array(
				'company' => array( 'label' => __( 'Company', 'zest' ), 'type' => 'text', 'auto' => 'organization' ),
				'message' => array( 'label' => __( 'How can we help?', 'zest' ), 'type' => 'textarea', 'required' => true, 'wide' => true ),
			),
		),
		'quote'   => array(
			'subject' => __( 'Quote request', 'zest' ),
			'button'  => __( 'Request a quote', 'zest' ),
			'fields'  => $common + array(
				'company'   => array( 'label' => __( 'Company / society name', 'zest' ), 'type' => 'text', 'required' => true, 'auto' => 'organization' ),
				'service'   => array( 'label' => __( 'Service required', 'zest' ), 'type' => 'select', 'required' => true, 'options' => $service_options ),
				'site_type' => array( 'label' => __( 'Type of site', 'zest' ), 'type' => 'select', 'options' => array( '' => array( __( 'Corporate office', 'zest' ), __( 'IT park / commercial building', 'zest' ), __( 'Factory / plant / warehouse', 'zest' ), __( 'Bank / ATM / financial', 'zest' ), __( 'Hospital / healthcare', 'zest' ), __( 'Mall / retail', 'zest' ), __( 'Residential society', 'zest' ), __( 'Educational institution', 'zest' ), __( 'Event / exhibition', 'zest' ), __( 'Other', 'zest' ) ) ) ),
				'city'      => array( 'label' => __( 'Site location (city)', 'zest' ), 'type' => 'text', 'required' => true, 'auto' => 'address-level2' ),
				'headcount' => array( 'label' => __( 'Approx. staff required', 'zest' ), 'type' => 'text' ),
				'start'     => array( 'label' => __( 'Required from', 'zest' ), 'type' => 'date' ),
				'message'   => array( 'label' => __( 'Requirement details (shifts, area, special needs)', 'zest' ), 'type' => 'textarea', 'wide' => true ),
			),
		),
		'career'  => array(
			'subject' => __( 'Job application', 'zest' ),
			'button'  => __( 'Submit application', 'zest' ),
			'fields'  => $common + array(
				'position'   => array( 'label' => __( 'Position applied for', 'zest' ), 'type' => 'text', 'required' => true ),
				'city'       => array( 'label' => __( 'Current city', 'zest' ), 'type' => 'text', 'required' => true, 'auto' => 'address-level2' ),
				'experience' => array( 'label' => __( 'Experience (years)', 'zest' ), 'type' => 'text' ),
				'cv'         => array( 'label' => __( 'Upload CV (PDF, DOC, DOCX – max 5 MB)', 'zest' ), 'type' => 'file', 'required' => true, 'wide' => true ),
				'message'    => array( 'label' => __( 'Anything else we should know?', 'zest' ), 'type' => 'textarea', 'wide' => true ),
			),
		),
	);
}

/**
 * Render a form.
 *
 * @param string $type     contact|quote|career.
 * @param array  $prefill  Field => value defaults.
 */
function zest_form( $type, $prefill = array() ) {
	$forms = zest_form_fields();
	if ( ! isset( $forms[ $type ] ) ) {
		return;
	}
	$form   = $forms[ $type ];
	$status = isset( $_GET['zest_form'], $_GET['form'] ) && sanitize_key( $_GET['form'] ) === $type ? sanitize_key( $_GET['zest_form'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- display only.
	$id     = 'zest-form-' . $type;

	if ( 'sent' === $status ) {
		echo '<div class="form-notice form-notice--ok" role="status" id="' . esc_attr( $id ) . '">';
		zest_the_icon( 'check', 22 );
		echo '<p><strong>' . esc_html__( 'Thank you – we have received your details.', 'zest' ) . '</strong> ' . esc_html__( 'Our team will get back to you within one working day.', 'zest' ) . '</p></div>';
		return;
	}

	$errors = array(
		'invalid' => __( 'Please fill in all required fields with valid details.', 'zest' ),
		'file'    => __( 'Please attach your CV as a PDF, DOC or DOCX file under 5 MB.', 'zest' ),
		'expired' => __( 'Your session expired. Please submit the form again.', 'zest' ),
	);

	$enctype = 'career' === $type ? ' enctype="multipart/form-data"' : '';
	echo '<form class="zest-form" id="' . esc_attr( $id ) . '" method="post" action="' . esc_url( admin_url( 'admin-post.php' ) ) . '"' . $enctype . ' novalidate>'; // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- static attribute.

	if ( isset( $errors[ $status ] ) ) {
		echo '<div class="form-notice form-notice--error" role="alert"><p>' . esc_html( $errors[ $status ] ) . '</p></div>';
	}

	echo '<input type="hidden" name="action" value="zest_form">';
	echo '<input type="hidden" name="form_type" value="' . esc_attr( $type ) . '">';
	echo '<input type="hidden" name="return_to" value="' . esc_url( get_permalink() ) . '">';
	wp_nonce_field( 'zest_form_' . $type, 'zest_nonce' );
	// Honeypot: real visitors never see or fill this.
	echo '<p class="hp" aria-hidden="true"><label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label></p>';

	echo '<div class="form-grid">';
	foreach ( $form['fields'] as $name => $field ) {
		$fid      = $id . '-' . $name;
		$required = ! empty( $field['required'] );
		$value    = isset( $prefill[ $name ] ) ? $prefill[ $name ] : '';
		$classes  = 'field' . ( ! empty( $field['wide'] ) || 'textarea' === $field['type'] ? ' field--wide' : '' );
		$req_attr = $required ? ' required aria-required="true"' : '';
		$auto     = ! empty( $field['auto'] ) ? ' autocomplete="' . esc_attr( $field['auto'] ) . '"' : '';

		echo '<div class="' . esc_attr( $classes ) . '">';
		printf(
			'<label for="%1$s">%2$s%3$s</label>',
			esc_attr( $fid ),
			esc_html( $field['label'] ),
			$required ? ' <span class="req" aria-hidden="true">*</span>' : '' // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- static.
		);

		switch ( $field['type'] ) {
			case 'textarea':
				printf( '<textarea id="%1$s" name="%2$s" rows="5"%3$s>%4$s</textarea>', esc_attr( $fid ), esc_attr( $name ), $req_attr, esc_textarea( $value ) ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped
				break;
			case 'select':
				printf( '<select id="%1$s" name="%2$s"%3$s>', esc_attr( $fid ), esc_attr( $name ), $req_attr ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped
				echo '<option value="">' . esc_html__( 'Select…', 'zest' ) . '</option>';
				foreach ( $field['options'] as $group => $options ) {
					if ( $group ) {
						echo '<optgroup label="' . esc_attr( $group ) . '">';
					}
					foreach ( $options as $option ) {
						printf( '<option value="%1$s"%2$s>%1$s</option>', esc_attr( $option ), selected( $value, $option, false ) );
					}
					if ( $group ) {
						echo '</optgroup>';
					}
				}
				if ( 'service' === $name ) {
					echo '<option value="Multiple / integrated services">' . esc_html__( 'Multiple / integrated services', 'zest' ) . '</option>';
				}
				echo '</select>';
				break;
			case 'file':
				printf( '<input type="file" id="%1$s" name="%2$s" accept=".pdf,.doc,.docx"%3$s>', esc_attr( $fid ), esc_attr( $name ), $req_attr ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped
				break;
			default:
				printf( '<input type="%1$s" id="%2$s" name="%3$s" value="%4$s"%5$s%6$s>', esc_attr( $field['type'] ), esc_attr( $fid ), esc_attr( $name ), esc_attr( $value ), $req_attr, $auto ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped
		}
		echo '</div>';
	}
	echo '</div>';

	echo '<p class="form-consent">' . sprintf(
		/* translators: %s: privacy policy link */
		esc_html__( 'By submitting, you agree to our %s. We never share your details.', 'zest' ),
		'<a href="' . esc_url( zest_page_url( 'privacy-policy' ) ) . '">' . esc_html__( 'privacy policy', 'zest' ) . '</a>'
	) . '</p>'; // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- built from escaped parts.
	echo '<button type="submit" class="btn btn--primary">' . esc_html( $form['button'] ) . '</button>';
	echo '</form>';
}

/**
 * Redirect back to the form with a status.
 *
 * @param string $return Return URL.
 * @param string $type   Form type.
 * @param string $status Status.
 */
function zest_form_redirect( $return, $type, $status ) {
	$url = add_query_arg( array( 'zest_form' => $status, 'form' => $type ), $return ) . '#zest-form-' . $type;
	wp_safe_redirect( $url );
	exit;
}

/**
 * Handle submissions.
 */
function zest_handle_form() {
	$type   = isset( $_POST['form_type'] ) ? sanitize_key( $_POST['form_type'] ) : '';
	$return = isset( $_POST['return_to'] ) ? esc_url_raw( wp_unslash( $_POST['return_to'] ) ) : home_url( '/' );
	$return = wp_validate_redirect( $return, home_url( '/' ) );
	$forms  = zest_form_fields();

	if ( ! isset( $forms[ $type ] ) ) {
		wp_safe_redirect( home_url( '/' ) );
		exit;
	}
	if ( ! isset( $_POST['zest_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['zest_nonce'] ), 'zest_form_' . $type ) ) {
		zest_form_redirect( $return, $type, 'expired' );
	}
	// Bots fill the honeypot – pretend success.
	if ( ! empty( $_POST['website'] ) ) {
		zest_form_redirect( $return, $type, 'sent' );
	}

	$form = $forms[ $type ];
	$data = array();
	foreach ( $form['fields'] as $name => $field ) {
		if ( 'file' === $field['type'] ) {
			continue;
		}
		$raw   = isset( $_POST[ $name ] ) ? wp_unslash( $_POST[ $name ] ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- sanitised next.
		$value = 'textarea' === $field['type'] ? sanitize_textarea_field( $raw ) : ( 'email' === $field['type'] ? sanitize_email( $raw ) : sanitize_text_field( $raw ) );
		if ( ! empty( $field['required'] ) && '' === $value ) {
			zest_form_redirect( $return, $type, 'invalid' );
		}
		if ( 'email' === $field['type'] && $value && ! is_email( $value ) ) {
			zest_form_redirect( $return, $type, 'invalid' );
		}
		if ( 'tel' === $field['type'] && $value && strlen( preg_replace( '/\D/', '', $value ) ) < 8 ) {
			zest_form_redirect( $return, $type, 'invalid' );
		}
		$data[ $name ] = array( $field['label'], $value );
	}

	$attachment = '';
	if ( 'career' === $type ) {
		$attachment = zest_handle_cv_upload();
		if ( ! $attachment ) {
			zest_form_redirect( $return, $type, 'file' );
		}
	}

	// Build message.
	$lines = array();
	foreach ( $data as $row ) {
		$lines[] = $row[0] . ': ' . $row[1];
	}
	$lines[] = __( 'Page', 'zest' ) . ': ' . $return;
	$body    = implode( "\n", $lines );
	$subject = sprintf( '[%s] %s – %s', get_bloginfo( 'name' ), $form['subject'], $data['name'][1] );

	// Store in wp-admin.
	$post_id = wp_insert_post(
		array(
			'post_type'    => 'enquiry',
			'post_status'  => 'private',
			'post_title'   => $form['subject'] . ' – ' . $data['name'][1],
			'post_content' => $body . ( $attachment ? "\n" . __( 'CV file', 'zest' ) . ': ' . $attachment['url'] : '' ),
		)
	);
	if ( $post_id && ! is_wp_error( $post_id ) ) {
		update_post_meta( $post_id, '_zest_form_type', $type );
	}

	$headers = array( 'Reply-To: ' . $data['name'][1] . ' <' . $data['email'][1] . '>' );
	wp_mail( zest_opt( 'form_email' ), $subject, $body, $headers, $attachment ? array( $attachment['file'] ) : array() );

	zest_form_redirect( $return, $type, 'sent' );
}
add_action( 'admin_post_nopriv_zest_form', 'zest_handle_form' );
add_action( 'admin_post_zest_form', 'zest_handle_form' );

/**
 * Validate and store an uploaded CV in a non-indexed folder with a random name.
 *
 * @return array|false ['file' => path, 'url' => url] or false.
 */
function zest_handle_cv_upload() {
	// Nonce verified in zest_handle_form().
	if ( empty( $_FILES['cv']['name'] ) || ! empty( $_FILES['cv']['error'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
		return false;
	}
	if ( (int) $_FILES['cv']['size'] > 5 * MB_IN_BYTES ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
		return false;
	}
	$allowed = array(
		'pdf'  => 'application/pdf',
		'doc'  => 'application/msword',
		'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
	);
	$check = wp_check_filetype_and_ext( $_FILES['cv']['tmp_name'], sanitize_file_name( $_FILES['cv']['name'] ), $allowed ); // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	if ( empty( $check['ext'] ) ) {
		return false;
	}

	require_once ABSPATH . 'wp-admin/includes/file.php';

	$dir_filter = static function ( $dirs ) {
		$dirs['subdir'] = '/zest-cv';
		$dirs['path']   = $dirs['basedir'] . '/zest-cv';
		$dirs['url']    = $dirs['baseurl'] . '/zest-cv';
		return $dirs;
	};
	$name_filter = static function ( $file ) use ( $check ) {
		$file['name'] = 'cv-' . wp_generate_password( 20, false ) . '.' . $check['ext'];
		return $file;
	};
	add_filter( 'upload_dir', $dir_filter );
	add_filter( 'wp_handle_upload_prefilter', $name_filter );
	$upload = wp_handle_upload(
		$_FILES['cv'], // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		array(
			'test_form' => false,
			'mimes'     => $allowed,
		)
	);
	remove_filter( 'upload_dir', $dir_filter );
	remove_filter( 'wp_handle_upload_prefilter', $name_filter );

	if ( empty( $upload['file'] ) ) {
		return false;
	}

	// Block directory listing and search indexing of the CV folder.
	$folder = dirname( $upload['file'] );
	if ( ! file_exists( $folder . '/index.php' ) ) {
		file_put_contents( $folder . '/index.php', "<?php // Silence.\n" ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_file_put_contents
		file_put_contents( $folder . '/.htaccess', "Options -Indexes\n<IfModule mod_headers.c>\nHeader set X-Robots-Tag \"noindex, nofollow\"\n</IfModule>\n" ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_file_put_contents
	}
	return array(
		'file' => $upload['file'],
		'url'  => $upload['url'],
	);
}
