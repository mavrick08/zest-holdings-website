<?php
/**
 * Careers – current openings (Job post type) + application form with CV upload.
 *
 * @package zest
 */

get_header();

$jobs = get_posts(
	array(
		'post_type'      => 'job',
		'posts_per_page' => 50,
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
	)
);

$perks = array(
	array( 'graduate', __( 'Paid training', 'zest' ), __( 'Pre-employment training at our Pusegaon and Wangani centres.', 'zest' ) ),
	array( 'shield', __( 'PF & ESIC', 'zest' ), __( 'Statutory PF, ESIC, gratuity and bonus for every eligible employee.', 'zest' ) ),
	array( 'clock', __( 'Wages on time', 'zest' ), __( 'Minimum-wage compliant pay, every month, on time.', 'zest' ) ),
	array( 'chart', __( 'Grow with us', 'zest' ), __( 'Clear path from guard to supervisor, area and divisional officer.', 'zest' ) ),
);

while ( have_posts() ) :
	the_post();
	zest_page_hero( zest_page_hero_args( __( 'Careers', 'zest' ), __( 'Join a 15,000+ strong team. We hire security officers, supervisors, housekeeping and facility staff, cafeteria teams and office professionals.', 'zest' ) ) );
	?>

	<section class="section">
		<div class="container">
			<?php zest_section_head( __( 'Why work with Zest', 'zest' ), __( 'A Career with Dignity and Security', 'zest' ) ); ?>
			<div class="card-grid card-grid--4">
				<?php foreach ( $perks as $perk ) : ?>
					<div class="card">
						<span class="card__icon"><?php zest_the_icon( $perk[0], 30 ); ?></span>
						<h3 class="card__title"><?php echo esc_html( $perk[1] ); ?></h3>
						<p class="card__text"><?php echo esc_html( $perk[2] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
			<?php if ( get_the_content() ) : ?>
				<div class="prose container--narrow intro-block"><?php the_content(); ?></div>
			<?php endif; ?>
		</div>
	</section>

	<section class="section section--light" id="openings">
		<div class="container">
			<?php zest_section_head( __( 'Open positions', 'zest' ), __( 'Current Openings', 'zest' ) ); ?>
			<?php if ( $jobs ) : ?>
				<ul class="job-list">
					<?php foreach ( $jobs as $job ) : ?>
						<li class="job-row">
							<div class="job-row__main">
								<h3 class="job-row__title"><a href="<?php echo esc_url( get_permalink( $job ) ); ?>"><?php echo esc_html( get_the_title( $job ) ); ?></a></h3>
								<p class="job-row__meta">
									<?php
									$meta = array_filter(
										array(
											zest_field( 'zest_location', '', $job->ID ),
											zest_field( 'zest_job_type', '', $job->ID ),
											zest_field( 'zest_experience', '', $job->ID ),
										)
									);
									echo esc_html( implode( ' · ', $meta ) );
									?>
								</p>
							</div>
							<span class="btn btn--outline-navy btn--sm" aria-hidden="true"><?php esc_html_e( 'View & apply', 'zest' ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php else : ?>
				<p class="center-text"><?php esc_html_e( 'There are no listed openings right now, but we are always hiring trained security and facility staff. Send us your CV below.', 'zest' ); ?></p>
			<?php endif; ?>
		</div>
	</section>

	<section class="section" id="apply">
		<div class="container container--narrow">
			<?php zest_section_head( __( 'Apply now', 'zest' ), __( 'Send Us Your Application', 'zest' ), __( 'Fill in your details and upload your CV. Our recruitment team will contact shortlisted candidates.', 'zest' ) ); ?>
			<div class="form-card">
				<?php zest_form( 'career' ); ?>
			</div>
		</div>
	</section>

	<?php
endwhile;

get_footer();
