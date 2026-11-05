<?php
/**
 * Gold call-to-action band.
 *
 * @package zest
 *
 * @var array $args title.
 */

defined( 'ABSPATH' ) || exit;

$title = ! empty( $args['title'] ) ? $args['title'] : __( 'Need security, housekeeping or cafeteria support for your site?', 'zest' );
?>
<section class="cta-band">
	<div class="container cta-band__inner">
		<h2 class="cta-band__title"><?php echo esc_html( $title ); ?></h2>
		<div class="btn-row">
			<a class="btn btn--navy" href="<?php echo esc_url( zest_phone_href() ); ?>"><?php zest_the_icon( 'phone', 18 ); ?> <?php /* translators: %s phone */ printf( esc_html__( 'Call %s', 'zest' ), esc_html( zest_opt( 'phone' ) ) ); ?></a>
			<a class="btn btn--outline-navy" href="<?php echo esc_url( zest_page_url( 'request-a-quote' ) ); ?>"><?php esc_html_e( 'Request a Quote', 'zest' ); ?></a>
		</div>
	</div>
</section>
