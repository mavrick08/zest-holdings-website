<?php
/**
 * Smart (electronic) security solutions – content from the JH × ZH solutions deck.
 *
 * @package zest
 */

get_header();

$solutions = array(
	array(
		'id'       => 'visitor-management',
		'icon'     => 'scan',
		'title'    => __( 'Visitor Management', 'zest' ),
		'lead'     => __( 'A virtual receptionist that saves staff time, improves security and gives visitors a smooth check-in experience.', 'zest' ),
		'text'     => __( 'Our tablet-based, web-enabled visitor management system simplifies check-in using facial recognition. First-time visitors complete a quick photo capture, confirm visit details, sign NDAs and print a badge; repeat visitors are recognised instantly and skip straight past the check-in screens.', 'zest' ),
		'features' => array(
			__( 'Pre-register visitors to speed up check-in', 'zest' ),
			__( 'QR-code express entry for VIP visitors', 'zest' ),
			__( 'Watch list for unauthorised or problematic visitors', 'zest' ),
			__( 'Custom workflows and NDAs for every visitor type', 'zest' ),
			__( 'Walk-in registration with ID proof upload', 'zest' ),
			__( 'Capture luggage, parking and special requirements', 'zest' ),
			__( 'Visitor audit log and analytics', 'zest' ),
			__( 'Visit feedback and opt-in communication', 'zest' ),
		),
	),
	array(
		'id'       => 'parking-management',
		'icon'     => 'car',
		'title'    => __( 'Parking Management (LPR)', 'zest' ),
		'lead'     => __( 'Licence Plate Recognition that opens the barrier for authorised vehicles – and integrates with visitor management.', 'zest' ),
		'text'     => __( 'Employees enrol their vehicle number on the portal (with optional supporting documents). When the vehicle reaches the gate, the LPR unit reads the number plate, checks it against the database and opens the barrier on a match. Visitor vehicles can be pre-registered by the host, or registered instantly at the gate – the host is notified and a visitor pass is generated.', 'zest' ),
		'features' => array(
			__( 'Automatic number-plate reading at entry and exit', 'zest' ),
			__( 'Employee vehicle enrolment portal', 'zest' ),
			__( 'Pre-registered and instant visitor vehicle entry', 'zest' ),
			__( 'Host notification on visitor arrival', 'zest' ),
			__( 'Automatic visitor pass generation', 'zest' ),
			__( 'Optional outdoor display to greet drivers', 'zest' ),
		),
	),
	array(
		'id'       => 'facial-recognition',
		'icon'     => 'user',
		'title'    => __( 'Facial Recognition', 'zest' ),
		'lead'     => __( 'Presence analytics based on deep neural networks, for access control and surveillance.', 'zest' ),
		'text'     => __( 'The system picks out faces in live camera feeds and compares them against a database such as an employee access list or a watch list. Depending on the match it can lock or unlock a door, alert security personnel, or log attendance – and it can integrate with Time & Attendance and HRMS systems.', 'zest' ),
		'features' => array(
			__( 'Real-time multiple face detection and matching', 'zest' ),
			__( 'Reliable identification against large watch lists', 'zest' ),
			__( 'Face tracking across frames, robust to occlusion', 'zest' ),
			__( 'Optional gender and age estimation', 'zest' ),
			__( 'Web panel with capture time, camera ID and employee details', 'zest' ),
			__( 'Search by name and camera; multi-angle enrolment', 'zest' ),
		),
	),
	array(
		'id'       => 'indoor-premises',
		'icon'     => 'location',
		'title'    => __( 'Indoor Premises Solution', 'zest' ),
		'lead'     => __( 'Know who is where – for operational efficiency, faster emergency response and people safety.', 'zest' ),
		'text'     => __( 'Premises are mapped into zones by risk profile – critical, regular and low risk – with access managed on a need basis for patients, visitors and vendors. BLE-based ID cards with Real-Time Location Services (RTLS) and a built-in SOS button report through gateways in every zone to a live dashboard, hosted on-premises or in the cloud.', 'zest' ),
		'features' => array(
			__( 'Zone-wise mapping by capacity, users and risk', 'zest' ),
			__( 'BLE ID cards with real-time location and SOS', 'zest' ),
			__( 'Need-based access for visitors and vendors', 'zest' ),
			__( 'Faster response in medical emergencies', 'zest' ),
			__( 'Live dashboard – on-premises or cloud', 'zest' ),
		),
	),
	array(
		'id'       => 'people-count',
		'icon'     => 'people',
		'title'    => __( 'People Count & Crowd Management', 'zest' ),
		'lead'     => __( 'Control occupancy and keep crowds safe with live, zone-wise counts.', 'zest' ),
		'text'     => __( 'Camera-based people counting lets only a set number of patients or visitors enter, raises crowd alerts, and monitors each zone – main gate, waiting area, OPD, passages – on a single dashboard. The same data strengthens perimeter security.', 'zest' ),
		'features' => array(
			__( 'Occupancy limits at entry points', 'zest' ),
			__( 'Crowd alerts', 'zest' ),
			__( 'Zone-wise monitoring dashboard', 'zest' ),
			__( 'Temperature and mask detection (optional)', 'zest' ),
			__( 'People-count data for perimeter security', 'zest' ),
		),
	),
	array(
		'id'       => 'digital-display',
		'icon'     => 'display',
		'title'    => __( 'Digital Display Boards', 'zest' ),
		'lead'     => __( 'Centrally managed screens for public information, announcements and wayfinding.', 'zest' ),
		'text'     => __( 'Digital boards keep visitors, patients, students and vendors informed – from key facilities and departments to announcements and policy changes.', 'zest' ),
		'features' => array(
			__( 'Highlight major facilities and key departments', 'zest' ),
			__( 'Announcements and policy updates', 'zest' ),
			__( 'Information for visitors, patients, students and vendors', 'zest' ),
			__( 'Showcase achievements and public schemes', 'zest' ),
		),
	),
);

while ( have_posts() ) :
	the_post();
	zest_page_hero( zest_page_hero_args( __( 'Smart security solutions', 'zest' ), __( 'Man and machine work together to achieve better results. Our electronic solutions complement trained manpower to make premises safer and operations more efficient.', 'zest' ) ) );
	?>

	<nav class="jump-nav" aria-label="<?php esc_attr_e( 'Solutions on this page', 'zest' ); ?>">
		<div class="container">
			<ul>
				<?php foreach ( $solutions as $solution ) : ?>
					<li><a href="#<?php echo esc_attr( $solution['id'] ); ?>"><?php zest_the_icon( $solution['icon'], 18 ); ?><?php echo esc_html( $solution['title'] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</nav>

	<?php if ( get_the_content() ) : ?>
		<section class="section section--tight">
			<div class="container container--narrow prose"><?php the_content(); ?></div>
		</section>
	<?php endif; ?>

	<?php foreach ( $solutions as $i => $solution ) : ?>
		<section class="section<?php echo 1 === $i % 2 ? ' section--light' : ''; ?>" id="<?php echo esc_attr( $solution['id'] ); ?>">
			<div class="container split split--center<?php echo 1 === $i % 2 ? ' split--reverse' : ''; ?>">
				<div class="split__copy">
					<span class="card__icon card__icon--lg"><?php zest_the_icon( $solution['icon'], 36 ); ?></span>
					<h2 class="section-title"><?php echo esc_html( $solution['title'] ); ?></h2>
					<p class="lead"><?php echo esc_html( $solution['lead'] ); ?></p>
					<p><?php echo esc_html( $solution['text'] ); ?></p>
				</div>
				<div class="feature-box">
					<h3 class="feature-box__title"><?php esc_html_e( 'Key features', 'zest' ); ?></h3>
					<?php zest_check_list( $solution['features'] ); ?>
				</div>
			</div>
		</section>
	<?php endforeach; ?>

	<?php
	get_template_part( 'template-parts/cta-band', null, array( 'title' => __( 'Want a demo of our smart security solutions?', 'zest' ) ) );
endwhile;

get_footer();
