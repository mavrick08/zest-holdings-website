<?php
/**
 * 404.
 *
 * @package zest
 */

get_header();

zest_page_hero(
	array(
		'eyebrow' => __( 'Error 404', 'zest' ),
		'title'   => __( 'Page Not Found', 'zest' ),
		'text'    => __( 'The page you are looking for may have moved. Try one of these instead.', 'zest' ),
	)
);
?>
<section class="section">
	<div class="container">
		<div class="card-grid card-grid--3">
			<?php foreach ( zest_verticals() as $term ) : ?>
				<a class="card card--link" href="<?php echo esc_url( get_term_link( $term ) ); ?>">
					<span class="card__icon"><?php zest_the_icon( get_term_meta( $term->term_id, 'zest_icon', true ), 30 ); ?></span>
					<span class="card__title"><?php echo esc_html( $term->name ); ?></span>
					<span class="card__link"><?php esc_html_e( 'View services', 'zest' ); ?> <?php zest_the_icon( 'arrow', 16 ); ?></span>
				</a>
			<?php endforeach; ?>
		</div>
		<p class="center-text btn-row btn-row--center">
			<a class="btn btn--navy" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to home', 'zest' ); ?></a>
			<a class="btn btn--outline-navy" href="<?php echo esc_url( zest_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'Contact us', 'zest' ); ?></a>
		</p>
	</div>
</section>
<?php
get_footer();
