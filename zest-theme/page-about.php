<?php
/**
 * About Us – story, vision/mission/values, organisation, training centres, compliance.
 * The "Our story" text is the page content and can be edited in wp-admin.
 *
 * @package zest
 */

get_header();

while ( have_posts() ) :
	the_post();
	zest_page_hero( zest_page_hero_args( __( 'About Zest Holdings', 'zest' ), __( 'A Mumbai-headquartered security and facility management company, serving clients across India since 2006.', 'zest' ) ) );

	$pillars = array(
		array( 'award', __( 'Vision', 'zest' ), __( 'Strengthen our nation by serving businesses with integrity and value.', 'zest' ) ),
		array( 'guard', __( 'Mission', 'zest' ), __( 'To be a leader in the Indian security industry, by being a trusted partner of our clients and our employees.', 'zest' ) ),
		array( 'people', __( 'Our Values', 'zest' ), __( 'Values are the foundation of how we approach our work and achieve our mission and vision. Integrity and accountability are at the core of Zest’s values.', 'zest' ) ),
	);

	$org = array(
		array( __( 'Leadership', 'zest' ), array( __( 'Managing Director', 'zest' ), __( 'CEO', 'zest' ), __( 'Directors', 'zest' ) ) ),
		array( __( 'Management', 'zest' ), array( __( 'Operation Heads', 'zest' ), __( 'Manager – HRD', 'zest' ), __( 'Manager – Business Development', 'zest' ), __( 'Asst. Manager – CRM', 'zest' ) ) ),
		array( __( 'Support & control', 'zest' ), array( __( 'Senior Admin Officer', 'zest' ), __( 'Senior Compliance Officer', 'zest' ), __( 'Vigilance Officer', 'zest' ), __( 'Recruitment Officer', 'zest' ), __( 'Asst. Manager – Finance', 'zest' ) ) ),
		array( __( 'Field operations', 'zest' ), array( __( 'Divisional Officers', 'zest' ), __( 'Training Officers', 'zest' ), __( 'Area Officers', 'zest' ), __( 'Supervisors', 'zest' ), __( 'Guards & service staff', 'zest' ) ) ),
	);

	$compliance = array(
		array( __( 'PSARA licence', 'zest' ), sprintf( /* translators: %s licence */ __( 'Licensed under the Private Security Agencies (Regulation) Act – %s', 'zest' ), zest_opt( 'licence' ) ) ),
		array( __( 'PSARA Act 2007', 'zest' ), __( 'Compliant with the Private Security Agencies Regulation Act and Government Act 2005', 'zest' ) ),
		array( __( 'Labour licence', 'zest' ), __( 'Registered under the Contract Labour Act', 'zest' ) ),
		array( __( 'Provident Fund (PF)', 'zest' ), __( 'Registered – PF deducted and deposited for all eligible employees', 'zest' ) ),
		array( __( 'ESIC', 'zest' ), __( 'Registered – ESIC coverage for all eligible employees', 'zest' ) ),
		array( __( 'Wages & benefits', 'zest' ), __( 'Minimum Wages, Gratuity, Bonus, National & Gazetted Holidays adhered to', 'zest' ) ),
		array( __( 'Udyog Aadhaar', 'zest' ), __( 'Registered MSME', 'zest' ) ),
		array( __( 'ASIS International', 'zest' ), __( 'Member of ASIS (American Society for Industrial Security)', 'zest' ) ),
	);
	?>

	<section class="section">
		<div class="container split split--center">
			<div class="split__copy">
				<p class="eyebrow"><?php esc_html_e( 'Our story', 'zest' ); ?></p>
				<h2 class="section-title"><?php esc_html_e( 'Strength You Can Rely On, Since 2006', 'zest' ); ?></h2>
				<div class="prose"><?php the_content(); ?></div>
			</div>
			<?php zest_media( __( 'Photo: Zest head office / leadership team', 'zest' ), '4 / 3' ); ?>
		</div>
	</section>

	<section class="stats" aria-label="<?php esc_attr_e( 'Zest at a glance', 'zest' ); ?>">
		<div class="container stats__grid">
			<div class="stat"><p class="stat__value">2006</p><p class="stat__label"><?php esc_html_e( 'Established', 'zest' ); ?></p></div>
			<div class="stat"><p class="stat__value">15,000+</p><p class="stat__label"><?php esc_html_e( 'Employees', 'zest' ); ?></p></div>
			<div class="stat"><p class="stat__value">100+</p><p class="stat__label"><?php esc_html_e( 'Customers', 'zest' ); ?></p></div>
			<div class="stat"><p class="stat__value"><?php esc_html_e( '4+ States', 'zest' ); ?></p><p class="stat__label">MH · KA · GA · RJ</p></div>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<?php zest_section_head( __( 'What drives us', 'zest' ), __( 'Vision, Mission & Values', 'zest' ) ); ?>
			<div class="card-grid card-grid--3">
				<?php foreach ( $pillars as $pillar ) : ?>
					<div class="card">
						<span class="card__icon"><?php zest_the_icon( $pillar[0], 32 ); ?></span>
						<h3 class="card__title"><?php echo esc_html( $pillar[1] ); ?></h3>
						<p class="card__text"><?php echo esc_html( $pillar[2] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="section section--navy">
		<div class="container">
			<header class="section-head section-head--center">
				<p class="eyebrow eyebrow--gold"><?php esc_html_e( 'Management', 'zest' ); ?></p>
				<h2 class="section-title section-title--light"><?php esc_html_e( 'A Strong, Accountable Management Team', 'zest' ); ?></h2>
				<p class="section-lead lead-light"><?php esc_html_e( 'Every site is backed by a clear chain of responsibility – from the Managing Director to the supervisor on duty – with dedicated compliance, vigilance, training and client-relationship functions.', 'zest' ); ?></p>
			</header>
			<ol class="org-chart">
				<?php foreach ( $org as $level ) : ?>
					<li class="org-chart__level">
						<h3 class="org-chart__title"><?php echo esc_html( $level[0] ); ?></h3>
						<ul>
							<?php foreach ( $level[1] as $role ) : ?>
								<li><?php echo esc_html( $role ); ?></li>
							<?php endforeach; ?>
						</ul>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<?php zest_section_head( __( 'Training', 'zest' ), __( 'Our Training Centres', 'zest' ), __( 'Every officer goes through pre-employment training before deployment, with refresher training on site.', 'zest' ) ); ?>
			<div class="card-grid card-grid--2">
				<?php
				$centres = array(
					array( __( 'Pusegaon, Satara', 'zest' ), __( 'Pre-employment training centre for security personnel.', 'zest' ) ),
					array( __( 'Wangani, Thane', 'zest' ), __( 'Pre-employment training centre serving the Mumbai metropolitan region.', 'zest' ) ),
				);
				foreach ( $centres as $centre ) :
					?>
					<div class="card card--media">
						<?php
						/* translators: %s: centre location */
						zest_placeholder( sprintf( __( 'Photo: Training centre, %s', 'zest' ), $centre[0] ), '16 / 9' );
						?>
						<div class="card__body">
							<h3 class="card__title"><?php zest_the_icon( 'graduate', 22 ); ?> <?php echo esc_html( $centre[0] ); ?></h3>
							<p class="card__text"><?php echo esc_html( $centre[1] ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<h3 class="sub-title"><?php esc_html_e( 'What every officer is trained in', 'zest' ); ?></h3>
			<?php zest_check_list( array( __( 'Physical fitness & drill', 'zest' ), __( 'First aid', 'zest' ), __( 'Firefighting & fire safety drills', 'zest' ), __( 'Self-defence', 'zest' ), __( 'Access control & patrolling', 'zest' ), __( 'Grooming, conduct & communication', 'zest' ) ), 'check-list--cols' ); ?>
		</div>
	</section>

	<section class="section section--light" id="compliance">
		<div class="container container--narrow">
			<?php zest_section_head( __( 'Certification & registration', 'zest' ), __( 'Fully Compliant, Every Site', 'zest' ) ); ?>
			<div class="table-wrap">
				<table class="data-table">
					<caption class="screen-reader-text"><?php esc_html_e( 'Statutory registrations and compliance', 'zest' ); ?></caption>
					<thead>
						<tr><th scope="col"><?php esc_html_e( 'Registration / compliance', 'zest' ); ?></th><th scope="col"><?php esc_html_e( 'Status', 'zest' ); ?></th></tr>
					</thead>
					<tbody>
						<?php foreach ( $compliance as $row ) : ?>
							<tr><th scope="row"><?php echo esc_html( $row[0] ); ?></th><td><?php echo esc_html( $row[1] ); ?></td></tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</section>

	<?php
	get_template_part( 'template-parts/cta-band' );
endwhile;

get_footer();
