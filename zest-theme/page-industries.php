<?php
/**
 * Industries We Serve.
 *
 * @package zest
 */

get_header();

$industries = array(
	array( 'building', __( 'Corporates & MNCs', 'zest' ), __( 'Manned guarding, reception and access control, office housekeeping and employee cafeterias for corporate offices and campuses.', 'zest' ), array( 'security', 'housekeeping', 'cafeteria' ) ),
	array( 'building', __( 'IT Parks & Commercial Buildings', 'zest' ), __( 'Round-the-clock security, visitor and parking management, common-area housekeeping and building maintenance for multi-tenant properties.', 'zest' ), array( 'security', 'housekeeping' ) ),
	array( 'bank', __( 'Banks & Financial Institutions', 'zest' ), __( 'Branch and ATM security, ATM caretaking and upkeep, cash-in-transit, cash pick-up and vault services.', 'zest' ), array( 'security' ) ),
	array( 'factory', __( 'Factories, Plants & Warehouses', 'zest' ), __( 'Perimeter and gate security, industrial housekeeping, plant maintenance, warehouse operations support and industrial canteens.', 'zest' ), array( 'security', 'housekeeping', 'cafeteria' ) ),
	array( 'tools', __( 'Infrastructure', 'zest' ), __( 'Security for infrastructure projects, utilities and heritage sites, with secure transit and logistics support.', 'zest' ), array( 'security' ) ),
	array( 'display', __( 'Malls & Retail', 'zest' ), __( 'Crowd management, loss prevention, electronic surveillance, food-court support and deep cleaning for retail spaces.', 'zest' ), array( 'security', 'housekeeping', 'cafeteria' ) ),
	array( 'hospital', __( 'Hospitals & Healthcare', 'zest' ), __( 'Access control for critical zones, people-count and indoor safety solutions, and hospital-grade housekeeping.', 'zest' ), array( 'security', 'housekeeping' ) ),
	array( 'graduate', __( 'Educational Institutions', 'zest' ), __( 'Campus security, classroom and hostel housekeeping, and institutional catering for schools, colleges and training institutes.', 'zest' ), array( 'security', 'housekeeping', 'cafeteria' ) ),
	array( 'people', __( 'Residential Societies', 'zest' ), __( 'Trained guards, visitor management, common-area housekeeping, pest control and horticulture for housing societies.', 'zest' ), array( 'security', 'housekeeping' ) ),
	array( 'event', __( 'Events & Exhibitions', 'zest' ), __( 'Event security planning, crowd control, bouncers and VIP protection, with housekeeping support before, during and after the event.', 'zest' ), array( 'security', 'housekeeping' ) ),
	array( 'spark', __( 'Media & Entertainment', 'zest' ), __( 'Celebrity and executive protection, set and studio security, and event management support.', 'zest' ), array( 'security' ) ),
	array( 'cup', __( 'Hospitality', 'zest' ), __( 'Discreet security, kitchen stewarding and hygiene, and specialised cleaning for hotels and hospitality venues.', 'zest' ), array( 'security', 'housekeeping', 'cafeteria' ) ),
);

$verticals = array();
foreach ( zest_verticals() as $term ) {
	$verticals[ $term->slug ] = $term;
}
$slug_map = array(
	'security'     => 'security-services',
	'housekeeping' => 'housekeeping-facility-management',
	'cafeteria'    => 'cafeteria-food-services',
);

while ( have_posts() ) :
	the_post();
	zest_page_hero( zest_page_hero_args( __( 'Industries', 'zest' ), __( 'Our ever-expanding client base spans corporate offices, banks, factories, retail, hospitals, education, real estate and infrastructure.', 'zest' ) ) );
	?>

	<section class="section">
		<div class="container">
			<?php if ( get_the_content() ) : ?>
				<div class="prose container--narrow intro-block"><?php the_content(); ?></div>
			<?php endif; ?>
			<div class="card-grid card-grid--3">
				<?php foreach ( $industries as $industry ) : ?>
					<article class="card industry-card">
						<span class="card__icon"><?php zest_the_icon( $industry[0], 32 ); ?></span>
						<h2 class="card__title"><?php echo esc_html( $industry[1] ); ?></h2>
						<p class="card__text"><?php echo esc_html( $industry[2] ); ?></p>
						<ul class="mini-tags">
							<?php
							foreach ( $industry[3] as $key ) :
								$slug = $slug_map[ $key ];
								if ( empty( $verticals[ $slug ] ) ) {
									continue;
								}
								$label = get_term_meta( $verticals[ $slug ]->term_id, 'zest_menu_label', true );
								?>
								<li><a href="<?php echo esc_url( get_term_link( $verticals[ $slug ] ) ); ?>"><?php echo esc_html( $label ? $label : $verticals[ $slug ]->name ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php
	get_template_part( 'template-parts/cta-band', null, array( 'title' => __( 'Don’t see your industry? Tell us about your site.', 'zest' ) ) );
endwhile;

get_footer();
