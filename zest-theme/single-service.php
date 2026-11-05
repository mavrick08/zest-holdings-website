<?php
/**
 * Service detail: hero, overview, key features, industries, CTA.
 *
 * @package zest
 */

get_header();

while ( have_posts() ) :
	the_post();

	$vertical   = zest_service_vertical();
	$features   = zest_field_lines( 'zest_features' );
	$industries = zest_field_lines( 'zest_industries' );
	$siblings   = $vertical ? zest_services_in( $vertical, -1 ) : array();

	zest_page_hero(
		array(
			'eyebrow' => $vertical ? $vertical->name : '',
			'title'   => get_the_title(),
			'text'    => zest_field( 'zest_tagline', get_the_excerpt() ),
			'buttons' => true,
			'icon'    => zest_field( 'zest_icon', 'shield' ),
		)
	);
	?>

	<section class="section">
		<div class="container with-sidebar">
			<article class="with-sidebar__main">
				<p class="eyebrow"><?php esc_html_e( 'Overview', 'zest' ); ?></p>
				<div class="prose">
					<?php the_content(); ?>
				</div>
				<?php
				/* translators: %s: service name */
				zest_media( sprintf( __( 'Photo: %s', 'zest' ), get_the_title() ), '16 / 9' );
				?>
			</article>

			<aside class="with-sidebar__aside" aria-label="<?php esc_attr_e( 'Related services', 'zest' ); ?>">
				<?php if ( $siblings ) : ?>
					<div class="side-card">
						<h2 class="side-card__title"><?php echo esc_html( $vertical->name ); ?></h2>
						<ul class="side-nav">
							<?php foreach ( $siblings as $sibling ) : ?>
								<li>
									<a href="<?php echo esc_url( get_permalink( $sibling ) ); ?>"<?php echo get_the_ID() === $sibling->ID ? ' aria-current="page"' : ''; ?>>
										<?php echo esc_html( get_the_title( $sibling ) ); ?>
										<?php zest_the_icon( 'arrow', 16 ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
				<div class="side-card side-card--navy">
					<h2 class="side-card__title"><?php esc_html_e( 'Talk to our team', 'zest' ); ?></h2>
					<p><?php esc_html_e( 'Get a site survey and a no-obligation proposal for your premises.', 'zest' ); ?></p>
					<p><a class="side-contact" href="<?php echo esc_url( zest_phone_href() ); ?>"><?php zest_the_icon( 'phone', 18 ); ?><?php echo esc_html( zest_opt( 'phone' ) ); ?></a></p>
					<p><a class="side-contact" href="mailto:<?php echo esc_attr( antispambot( zest_opt( 'email' ) ) ); ?>"><?php zest_the_icon( 'mail', 18 ); ?><?php echo esc_html( antispambot( zest_opt( 'email' ) ) ); ?></a></p>
					<a class="btn btn--primary btn--block" href="<?php echo esc_url( add_query_arg( 'enquiry_for', rawurlencode( get_the_title() ), zest_page_url( 'request-a-quote' ) ) ); ?>"><?php esc_html_e( 'Request a Quote', 'zest' ); ?></a>
				</div>
			</aside>
		</div>
	</section>

	<?php if ( $features ) : ?>
	<section class="section section--light">
		<div class="container">
			<?php zest_section_head( __( 'What’s included', 'zest' ), __( 'Key Features', 'zest' ) ); ?>
			<ul class="why-grid why-grid--3">
				<?php foreach ( $features as $feature ) : ?>
					<li class="why-tile"><?php zest_the_icon( 'check', 22 ); ?><span><?php echo esc_html( $feature ); ?></span></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( $industries ) : ?>
	<section class="section">
		<div class="container">
			<?php zest_section_head( __( 'Who we serve', 'zest' ), __( 'Industries', 'zest' ) ); ?>
			<ul class="chip-row">
				<?php foreach ( $industries as $industry ) : ?>
					<li class="chip"><?php echo esc_html( $industry ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php endif; ?>

	<?php
	$related = $vertical ? zest_services_in( $vertical, 3, get_the_ID() ) : array();
	if ( $related ) :
		?>
	<section class="section section--light">
		<div class="container">
			<?php zest_section_head( __( 'Explore more', 'zest' ), __( 'Related Services', 'zest' ) ); ?>
			<div class="card-grid card-grid--3">
				<?php
				foreach ( $related as $item ) {
					get_template_part( 'template-parts/service-card', null, array( 'post' => $item ) );
				}
				?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php
	get_template_part( 'template-parts/cta-band' );
endwhile;

get_footer();
