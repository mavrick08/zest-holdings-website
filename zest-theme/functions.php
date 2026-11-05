<?php
/**
 * Zest Holdings theme bootstrap.
 *
 * @package zest
 */

defined( 'ABSPATH' ) || exit;

define( 'ZEST_VERSION', '1.0.0' );
define( 'ZEST_DIR', get_template_directory() );
define( 'ZEST_URI', get_template_directory_uri() );

require ZEST_DIR . '/inc/setup.php';
require ZEST_DIR . '/inc/enqueue.php';
require ZEST_DIR . '/inc/customizer.php';
require ZEST_DIR . '/inc/cpt.php';
require ZEST_DIR . '/inc/fields.php';
require ZEST_DIR . '/inc/template-tags.php';
require ZEST_DIR . '/inc/forms.php';
require ZEST_DIR . '/inc/seo.php';
require ZEST_DIR . '/inc/seed.php';
