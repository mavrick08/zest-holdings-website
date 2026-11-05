<?php
/**
 * Vertical landing page (Security / Housekeeping & FM / Cafeteria).
 * Lists every service in the vertical automatically.
 *
 * @package zest
 */

get_header();

$term       = get_queried_object();
$tagline    = get_term_meta( $term->term_id, 'zest_tagline', true );
$icon       = get_term_meta( $term->term_id, 'zest_icon', true );
$badge      = get_term_meta( $term->term_id, 'zest_badge', true );
$highlights = array();
foreach ( preg_split( '/\r\n|\r|\n/', (string) get_term_meta( $term->term_id, 'zest_highlights', true ) ) as $line ) {
	$parts = array_map( 'trim', explode( '|', $line ) );
	if ( '' !== $parts[0] ) {
		$highlights[] = array( $parts[0], isset( $parts[1] ) ? $parts[1] : '' );
	}
}

zest_page_hero(
	array(
		'eyebrow' => $badge ? $badge : __( 'Our services', 'zest' ),
		'title'   => $term->name,
		'text'    => $tagline,
		'buttons' => true,
		'icon'    => $icon,
	)
);
?>

<?php if ( $term->description ) : ?>
<section class="section">
	<div class="container split split--center">
		<div class="split__copy prose">
			<p class="eyebrow"><?php esc_html_e( 'Overview', 'zest' ); ?></p>
			<?php echo wp_kses_post( wpautop( $term->description ) ); ?>
		</div>
		<?php
		/* translators: %s: vertical name */
		zest_placeholder( sprintf( __( 'Photo: Zest %s team on site', 'zest' ), $term->name ), '4 / 3' );
		?>
	</div>
</section>
<?php endif; ?>

<section class="section section--light">
	<div class="container">
		<?php
		/* translators: %s: vertical name */
		zest_section_head( __( 'What we offer', 'zest' ), sprintf( __( '%s We Provide', 'zest' ), get_term_meta( $term->term_id, 'zest_menu_label', true ) ? get_term_meta( $term->term_id, 'zest_menu_label', true ) : $term->name ) );
		?>
		<?php if ( have_posts() ) : ?>
			<div class="card-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/service-card', null, array( 'post' => get_post() ) );
				endwhile;
				?>
			</div>
		<?php else : ?>
			<p class="center-text"><?php esc_html_e( 'Service details are being updated. Please contact us for a full list.', 'zest' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php if ( $highlights ) : ?>
<section class="section">
	<div class="container">
		<?php zest_section_head( __( 'Why Zest', 'zest' ), __( 'How We Deliver', 'zest' ) ); ?>
		<div class="feature-grid">
			<?php foreach ( $highlights as $i => $highlight ) : ?>
				<div class="feature">
					<span class="feature__num"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
					<h3 class="feature__title"><?php echo esc_html( $highlight[0] ); ?></h3>
					<?php if ( $highlight[1] ) : ?>
						<p><?php echo esc_html( $highlight[1] ); ?></p>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php
get_template_part( 'template-parts/cta-band' );
get_footer();
