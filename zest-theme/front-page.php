<?php
/**
 * Home page – follows the approved homepage mockup.
 *
 * @package zest
 */

get_header();

$home_id = (int) get_option( 'page_on_front' );
$badges  = zest_field_lines( 'zest_home_badges', $home_id );
$badges  = $badges ? $badges : array( __( 'PSARA Licensed', 'zest' ), __( 'ASIS Member', 'zest' ), __( 'PF & ESIC Compliant', 'zest' ) );

$stats = array();
foreach ( zest_field_lines( 'zest_home_stats', $home_id ) as $line ) {
	$parts = array_map( 'trim', explode( '|', $line ) );
	if ( 2 === count( $parts ) ) {
		$stats[] = $parts;
	}
}
if ( ! $stats ) {
	$stats = array(
		array( '2006', __( 'Established', 'zest' ) ),
		array( '15,000+', __( 'Employees', 'zest' ) ),
		array( '100+', __( 'Customers', 'zest' ) ),
		array( '4+ States', __( 'MH · KA · GA · RJ', 'zest' ) ),
	);
}

$solutions_page = get_page_by_path( 'smart-solutions' );
$solutions      = array(
	array( 'scan', __( 'Visitor Management', 'zest' ) ),
	array( 'car', __( 'Parking Management (LPR)', 'zest' ) ),
	array( 'user', __( 'Facial Recognition', 'zest' ) ),
	array( 'people', __( 'People Count & Crowd Management', 'zest' ) ),
	array( 'location', __( 'Indoor Premises Solutions', 'zest' ) ),
	array( 'display', __( 'Digital Display Boards', 'zest' ) ),
);
$industries = array(
	__( 'Corporates & MNCs', 'zest' ),
	__( 'IT Parks & Commercial Buildings', 'zest' ),
	__( 'Banks & Financial Institutions', 'zest' ),
	__( 'Factories & Warehouses', 'zest' ),
	__( 'Infrastructure', 'zest' ),
	__( 'Malls & Retail', 'zest' ),
	__( 'Hospitals', 'zest' ),
	__( 'Educational Institutions', 'zest' ),
	__( 'Residential Societies', 'zest' ),
	__( 'Events & Exhibitions', 'zest' ),
);
$why = array(
	__( 'PSARA Act 2007 compliant', 'zest' ),
	__( 'PF, ESIC & labour compliance', 'zest' ),
	__( 'Trained & groomed personnel', 'zest' ),
	__( 'Strong management team', 'zest' ),
	__( 'Growing service network', 'zest' ),
	__( 'Competitive pricing', 'zest' ),
);
?>

<section class="hero">
	<div class="container hero__inner">
		<div class="hero__copy">
			<p class="eyebrow eyebrow--gold"><?php echo esc_html( zest_field( 'zest_home_eyebrow', __( 'Trusted since 2006 · Mumbai', 'zest' ), $home_id ) ); ?></p>
			<h1 class="hero__title"><?php echo esc_html( zest_field( 'zest_home_title', __( 'Security, Facility & Food Services Powered by Zest Strength', 'zest' ), $home_id ) ); ?></h1>
			<p class="hero__text"><?php echo esc_html( zest_field( 'zest_home_text', __( 'Trained guards, dog squads, electronic surveillance, housekeeping, integrated facility management and cafeteria services for corporates, banks, factories, malls, hospitals and infrastructure across India.', 'zest' ), $home_id ) ); ?></p>
			<div class="btn-row">
				<a class="btn btn--primary btn--lg" href="<?php echo esc_url( zest_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'Talk to Our Team', 'zest' ); ?></a>
				<a class="btn btn--outline-light btn--lg" href="#services"><?php esc_html_e( 'Explore Services', 'zest' ); ?></a>
			</div>
		</div>
		<div class="hero__card">
			<?php zest_logo_img( 'full', 260, __( 'Zest Facility emblem', 'zest' ) ); ?>
			<ul class="badge-row">
				<?php foreach ( $badges as $badge ) : ?>
					<li class="badge"><?php echo esc_html( $badge ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>

<section class="stats" aria-label="<?php esc_attr_e( 'Zest at a glance', 'zest' ); ?>">
	<div class="container stats__grid">
		<?php foreach ( $stats as $stat ) : ?>
			<div class="stat">
				<p class="stat__value"><?php echo esc_html( $stat[0] ); ?></p>
				<p class="stat__label"><?php echo esc_html( $stat[1] ); ?></p>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<section class="section" id="services">
	<div class="container">
		<?php zest_section_head( __( 'What we do', 'zest' ), __( 'Our Services', 'zest' ), __( 'Three focused business divisions, backed by one compliant, well-trained workforce and a common management team.', 'zest' ) ); ?>
		<div class="vertical-grid">
			<?php foreach ( zest_verticals() as $term ) : ?>
				<?php
				$icon     = get_term_meta( $term->term_id, 'zest_icon', true );
				$badge    = get_term_meta( $term->term_id, 'zest_badge', true );
				$short    = get_term_meta( $term->term_id, 'zest_short', true );
				$services = zest_services_in( $term, 6 );
				?>
				<article class="card vertical-card">
					<div class="vertical-card__head">
						<span class="card__icon card__icon--lg"><?php zest_the_icon( $icon ? $icon : 'shield', 36 ); ?></span>
						<?php if ( $badge ) : ?>
							<span class="tag"><?php echo esc_html( $badge ); ?></span>
						<?php endif; ?>
					</div>
					<h3 class="card__title card__title--lg"><?php echo esc_html( $term->name ); ?></h3>
					<p class="card__text"><?php echo esc_html( $short ? $short : wp_trim_words( $term->description, 24 ) ); ?></p>
					<?php if ( $services ) : ?>
						<ul class="link-list">
							<?php foreach ( $services as $service ) : ?>
								<li><a href="<?php echo esc_url( get_permalink( $service ) ); ?>"><?php zest_the_icon( 'check', 16 ); ?><?php echo esc_html( get_the_title( $service ) ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<a class="btn btn--navy vertical-card__btn" href="<?php echo esc_url( get_term_link( $term ) ); ?>">
						<?php
						/* translators: %s: vertical name */
						printf( esc_html__( 'Explore %s', 'zest' ), esc_html( get_term_meta( $term->term_id, 'zest_menu_label', true ) ? get_term_meta( $term->term_id, 'zest_menu_label', true ) : $term->name ) );
						?>
						<?php zest_the_icon( 'arrow', 18 ); ?>
					</a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section section--navy">
	<div class="container split split--center">
		<div class="split__copy">
			<p class="eyebrow eyebrow--gold"><?php esc_html_e( 'Smart security solutions', 'zest' ); ?></p>
			<h2 class="section-title section-title--light"><?php esc_html_e( 'Man and Machine, Working Together', 'zest' ); ?></h2>
			<p class="lead-light"><?php esc_html_e( 'Technology-led solutions that make your premises safer and operations more efficient – integrated with our trained manpower on the ground.', 'zest' ); ?></p>
			<?php if ( $solutions_page ) : ?>
				<a class="btn btn--primary" href="<?php echo esc_url( get_permalink( $solutions_page ) ); ?>"><?php esc_html_e( 'View Smart Solutions', 'zest' ); ?></a>
			<?php endif; ?>
		</div>
		<ul class="solution-grid">
			<?php foreach ( $solutions as $solution ) : ?>
				<li class="solution-tile"><?php zest_the_icon( $solution[0], 22 ); ?><span><?php echo esc_html( $solution[1] ); ?></span></li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<section class="section">
	<div class="container">
		<?php zest_section_head( '', __( 'Industries We Serve', 'zest' ) ); ?>
		<ul class="chip-row">
			<?php foreach ( $industries as $industry ) : ?>
				<li class="chip"><?php echo esc_html( $industry ); ?></li>
			<?php endforeach; ?>
		</ul>
		<p class="center-link"><a class="text-link" href="<?php echo esc_url( zest_page_url( 'industries' ) ); ?>"><?php esc_html_e( 'See how we serve each industry', 'zest' ); ?> <?php zest_the_icon( 'arrow', 16 ); ?></a></p>
	</div>
</section>

<section class="section section--light">
	<div class="container split">
		<div class="split__copy">
			<p class="eyebrow"><?php esc_html_e( 'Why Zest', 'zest' ); ?></p>
			<h2 class="section-title"><?php esc_html_e( 'Integrity & Accountability at Our Core', 'zest' ); ?></h2>
			<p><?php esc_html_e( 'Dedicated pre-employment training centres at Pusegaon (Satara) and Wangani (Thane) prepare every officer in fitness, first aid, firefighting and self-defence. Statutory compliance – PSARA, minimum wages, PF, ESIC, gratuity and bonus – is followed for every employee, at every site.', 'zest' ); ?></p>
			<a class="text-link" href="<?php echo esc_url( zest_page_url( 'about' ) ); ?>"><?php esc_html_e( 'More about Zest', 'zest' ); ?> <?php zest_the_icon( 'arrow', 16 ); ?></a>
		</div>
		<ul class="why-grid">
			<?php foreach ( $why as $item ) : ?>
				<li class="why-tile"><?php zest_the_icon( 'check', 22 ); ?><span><?php echo esc_html( $item ); ?></span></li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<?php
get_template_part( 'template-parts/cta-band' );
get_footer();
