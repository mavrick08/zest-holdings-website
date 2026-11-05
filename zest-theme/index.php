<?php
/**
 * Fallback template (blog posts, search, generic archives).
 *
 * @package zest
 */

get_header();

zest_page_hero(
	array(
		'title' => is_search()
			/* translators: %s: search query */
			? sprintf( __( 'Search results for “%s”', 'zest' ), get_search_query() )
			: ( is_archive() ? wp_strip_all_tags( get_the_archive_title() ) : __( 'News & Updates', 'zest' ) ),
	)
);
?>
<section class="section">
	<div class="container container--narrow">
		<?php if ( have_posts() ) : ?>
			<div class="post-list">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article <?php post_class( 'post-row' ); ?>>
						<h2 class="post-row__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p class="post-row__meta"><?php echo esc_html( get_the_date() ); ?></p>
						<p><?php echo esc_html( get_the_excerpt() ); ?></p>
					</article>
				<?php endwhile; ?>
			</div>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Nothing found.', 'zest' ); ?></p>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
