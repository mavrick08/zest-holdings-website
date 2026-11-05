<?php
/**
 * Inner page hero band.
 *
 * @package zest
 *
 * @var array $args eyebrow, title, text, buttons, icon.
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="page-hero">
	<div class="container page-hero__inner">
		<?php zest_breadcrumbs(); ?>
		<div class="page-hero__body">
			<?php if ( $args['icon'] ) : ?>
				<span class="page-hero__icon"><?php zest_the_icon( $args['icon'], 34 ); ?></span>
			<?php endif; ?>
			<?php if ( $args['eyebrow'] ) : ?>
				<p class="eyebrow eyebrow--gold"><?php echo esc_html( $args['eyebrow'] ); ?></p>
			<?php endif; ?>
			<h1 class="page-hero__title"><?php echo esc_html( $args['title'] ); ?></h1>
			<?php if ( $args['text'] ) : ?>
				<p class="page-hero__text"><?php echo esc_html( $args['text'] ); ?></p>
			<?php endif; ?>
			<?php if ( $args['buttons'] ) : ?>
				<div class="btn-row">
					<a class="btn btn--primary" href="<?php echo esc_url( is_singular( 'service' ) ? add_query_arg( 'enquiry_for', rawurlencode( get_the_title() ), zest_page_url( 'request-a-quote' ) ) : zest_page_url( 'request-a-quote' ) ); ?>"><?php esc_html_e( 'Request a Quote', 'zest' ); ?></a>
					<a class="btn btn--outline-light" href="<?php echo esc_url( zest_phone_href() ); ?>"><?php zest_the_icon( 'phone', 18 ); ?> <?php echo esc_html( zest_opt( 'phone' ) ); ?></a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
