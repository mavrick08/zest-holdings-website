<?php
/**
 * Service card (gold top border).
 *
 * @package zest
 *
 * @var array $args post (WP_Post).
 */

defined( 'ABSPATH' ) || exit;

$service = $args['post'];
$icon    = zest_field( 'zest_icon', 'shield', $service->ID );
?>
<article class="card service-card">
	<span class="card__icon"><?php zest_the_icon( $icon, 32 ); ?></span>
	<h3 class="card__title"><a href="<?php echo esc_url( get_permalink( $service ) ); ?>"><?php echo esc_html( get_the_title( $service ) ); ?></a></h3>
	<p class="card__text"><?php echo esc_html( get_the_excerpt( $service ) ); ?></p>
	<span class="card__link" aria-hidden="true"><?php esc_html_e( 'Learn more', 'zest' ); ?> <?php zest_the_icon( 'arrow', 16 ); ?></span>
</article>
