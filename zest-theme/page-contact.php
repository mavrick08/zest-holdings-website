<?php
/**
 * Contact – details, enquiry form and map.
 *
 * @package zest
 */

get_header();

while ( have_posts() ) :
	the_post();
	zest_page_hero( zest_page_hero_args( __( 'Contact us', 'zest' ), __( 'Talk to our team about security, housekeeping & facility management or cafeteria services for your site.', 'zest' ) ) );
	?>
	<section class="section">
		<div class="container contact-layout">
			<div class="contact-info">
				<h2 class="section-title section-title--sm"><?php esc_html_e( 'Head Office', 'zest' ); ?></h2>
				<ul class="contact-list">
					<li><span class="contact-list__icon"><?php zest_the_icon( 'pin', 22 ); ?></span><div><strong><?php esc_html_e( 'Address', 'zest' ); ?></strong><address><?php echo nl2br( esc_html( zest_opt( 'address' ) ) ); ?></address></div></li>
					<li><span class="contact-list__icon"><?php zest_the_icon( 'phone', 22 ); ?></span><div><strong><?php esc_html_e( 'Phone', 'zest' ); ?></strong><a href="<?php echo esc_url( zest_phone_href() ); ?>"><?php echo esc_html( zest_opt( 'phone' ) ); ?></a></div></li>
					<li><span class="contact-list__icon"><?php zest_the_icon( 'mail', 22 ); ?></span><div><strong><?php esc_html_e( 'Email', 'zest' ); ?></strong><a href="mailto:<?php echo esc_attr( antispambot( zest_opt( 'email' ) ) ); ?>"><?php echo esc_html( antispambot( zest_opt( 'email' ) ) ); ?></a></div></li>
					<li><span class="contact-list__icon"><?php zest_the_icon( 'location', 22 ); ?></span><div><strong><?php esc_html_e( 'Presence', 'zest' ); ?></strong><span><?php esc_html_e( 'Maharashtra · Karnataka · Goa · Rajasthan', 'zest' ); ?></span></div></li>
				</ul>
				<?php if ( get_the_content() ) : ?>
					<div class="prose"><?php the_content(); ?></div>
				<?php endif; ?>
				<a class="btn btn--navy" href="<?php echo esc_url( zest_page_url( 'request-a-quote' ) ); ?>"><?php esc_html_e( 'Need a quotation? Request a Quote', 'zest' ); ?></a>
			</div>
			<div class="form-card">
				<h2 class="section-title section-title--sm"><?php esc_html_e( 'Send us a message', 'zest' ); ?></h2>
				<?php zest_form( 'contact' ); ?>
			</div>
		</div>
	</section>

	<section class="map-wrap" aria-label="<?php esc_attr_e( 'Map', 'zest' ); ?>">
		<iframe
			title="<?php esc_attr_e( 'Zest Holdings head office on Google Maps', 'zest' ); ?>"
			src="<?php echo esc_url( 'https://www.google.com/maps?q=' . rawurlencode( zest_opt( 'map_query' ) ) . '&output=embed' ); ?>"
			loading="lazy"
			referrerpolicy="no-referrer-when-downgrade"></iframe>
	</section>
	<?php
endwhile;

get_footer();
