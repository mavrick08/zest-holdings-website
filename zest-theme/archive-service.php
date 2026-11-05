<?php
/**
 * /services/ – overview of all three verticals and their services.
 *
 * @package zest
 */

get_header();

zest_page_hero(
	array(
		'eyebrow' => __( 'What we do', 'zest' ),
		'title'   => __( 'Our Services', 'zest' ),
		'text'    => __( 'Security services, housekeeping & facility management and cafeteria services – delivered by one compliant, well-trained workforce.', 'zest' ),
		'buttons' => true,
	)
);

foreach ( zest_verticals() as $i => $term ) :
	$services = zest_services_in( $term );
	?>
	<section class="section<?php echo 1 === $i % 2 ? ' section--light' : ''; ?>">
		<div class="container">
			<header class="section-head section-head--split">
				<div>
					<p class="eyebrow"><?php echo esc_html( get_term_meta( $term->term_id, 'zest_badge', true ) ); ?></p>
					<h2 class="section-title"><?php echo esc_html( $term->name ); ?></h2>
					<p class="section-lead"><?php echo esc_html( get_term_meta( $term->term_id, 'zest_short', true ) ); ?></p>
				</div>
				<a class="btn btn--navy" href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php esc_html_e( 'View all', 'zest' ); ?> <?php zest_the_icon( 'arrow', 18 ); ?></a>
			</header>
			<div class="card-grid">
				<?php
				foreach ( $services as $service ) {
					get_template_part( 'template-parts/service-card', null, array( 'post' => $service ) );
				}
				?>
			</div>
		</div>
	</section>
	<?php
endforeach;

get_template_part( 'template-parts/cta-band' );
get_footer();
