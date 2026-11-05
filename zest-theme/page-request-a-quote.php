<?php
/**
 * Request a Quote. Accepts ?enquiry_for=<Service title> to preselect the service.
 *
 * @package zest
 */

get_header();

$prefill = array();
if ( isset( $_GET['enquiry_for'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- prefill only.
	$prefill['service'] = sanitize_text_field( wp_unslash( $_GET['enquiry_for'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
}

$steps = array(
	array( 'mail', __( 'Share your requirement', 'zest' ), __( 'Tell us about your site, services and timelines.', 'zest' ) ),
	array( 'search', __( 'Site survey', 'zest' ), __( 'Our team visits to assess risks, area and manpower needs.', 'zest' ) ),
	array( 'chart', __( 'Proposal', 'zest' ), __( 'A clear, compliant and competitively priced proposal.', 'zest' ) ),
	array( 'guard', __( 'Deployment', 'zest' ), __( 'Trained staff deployed with supervision and reporting.', 'zest' ) ),
);

while ( have_posts() ) :
	the_post();
	zest_page_hero( zest_page_hero_args( __( 'Request a quote', 'zest' ), __( 'Tell us what you need and our team will get back within one working day with next steps.', 'zest' ) ) );
	?>
	<section class="section">
		<div class="container quote-layout">
			<div class="form-card">
				<?php zest_form( 'quote', $prefill ); ?>
			</div>
			<aside class="quote-aside">
				<h2 class="section-title section-title--sm"><?php esc_html_e( 'How it works', 'zest' ); ?></h2>
				<ol class="steps">
					<?php foreach ( $steps as $step ) : ?>
						<li><span class="steps__icon"><?php zest_the_icon( $step[0], 22 ); ?></span><div><strong><?php echo esc_html( $step[1] ); ?></strong><p><?php echo esc_html( $step[2] ); ?></p></div></li>
					<?php endforeach; ?>
				</ol>
				<div class="side-card side-card--navy">
					<h2 class="side-card__title"><?php esc_html_e( 'Prefer to talk?', 'zest' ); ?></h2>
					<p><a class="side-contact" href="<?php echo esc_url( zest_phone_href() ); ?>"><?php zest_the_icon( 'phone', 18 ); ?><?php echo esc_html( zest_opt( 'phone' ) ); ?></a></p>
					<p><a class="side-contact" href="mailto:<?php echo esc_attr( antispambot( zest_opt( 'email' ) ) ); ?>"><?php zest_the_icon( 'mail', 18 ); ?><?php echo esc_html( antispambot( zest_opt( 'email' ) ) ); ?></a></p>
				</div>
			</aside>
		</div>
	</section>
	<?php
endwhile;

get_footer();
