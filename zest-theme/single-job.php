<?php
/**
 * Job opening detail + application form.
 *
 * @package zest
 */

get_header();

while ( have_posts() ) :
	the_post();
	$meta = array(
		array( 'pin', __( 'Location', 'zest' ), zest_field( 'zest_location' ) ),
		array( 'briefcase', __( 'Job type', 'zest' ), zest_field( 'zest_job_type' ) ),
		array( 'award', __( 'Experience', 'zest' ), zest_field( 'zest_experience' ) ),
		array( 'people', __( 'Openings', 'zest' ), zest_field( 'zest_vacancies' ) ),
	);
	zest_page_hero(
		array(
			'eyebrow' => __( 'Careers at Zest', 'zest' ),
			'title'   => get_the_title(),
			'text'    => get_the_excerpt(),
		)
	);
	?>
	<section class="section">
		<div class="container with-sidebar">
			<article class="with-sidebar__main">
				<div class="prose"><?php the_content(); ?></div>
				<h2 class="sub-title" id="apply"><?php esc_html_e( 'Apply for this role', 'zest' ); ?></h2>
				<div class="form-card">
					<?php zest_form( 'career', array( 'position' => get_the_title() ) ); ?>
				</div>
			</article>
			<aside class="with-sidebar__aside">
				<div class="side-card">
					<h2 class="side-card__title"><?php esc_html_e( 'Job summary', 'zest' ); ?></h2>
					<dl class="job-facts">
						<?php foreach ( $meta as $row ) : ?>
							<?php if ( $row[2] ) : ?>
								<div><dt><?php zest_the_icon( $row[0], 18 ); ?><?php echo esc_html( $row[1] ); ?></dt><dd><?php echo esc_html( $row[2] ); ?></dd></div>
							<?php endif; ?>
						<?php endforeach; ?>
					</dl>
					<a class="btn btn--primary btn--block" href="#apply"><?php esc_html_e( 'Apply now', 'zest' ); ?></a>
				</div>
				<a class="text-link" href="<?php echo esc_url( zest_page_url( 'careers' ) ); ?>#openings"><?php esc_html_e( 'All openings', 'zest' ); ?> <?php zest_the_icon( 'arrow', 16 ); ?></a>
			</aside>
		</div>
	</section>
	<?php
endwhile;

get_footer();
