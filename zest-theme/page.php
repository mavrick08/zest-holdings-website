<?php
/**
 * Default page.
 *
 * @package zest
 */

get_header();

while ( have_posts() ) :
	the_post();
	zest_page_hero( zest_page_hero_args() );
	?>
	<section class="section">
		<div class="container container--narrow prose">
			<?php the_content(); ?>
		</div>
	</section>
	<?php
endwhile;

get_footer();
