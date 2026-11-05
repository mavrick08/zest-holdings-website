<?php
/**
 * Site footer.
 *
 * @package zest
 */

?>
</main>

<footer class="site-footer">
	<div class="container site-footer__grid">
		<div class="site-footer__about">
			<?php if ( is_active_sidebar( 'footer-about' ) ) : ?>
				<?php dynamic_sidebar( 'footer-about' ); ?>
			<?php else : ?>
				<a class="footer-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php zest_logo_img( 'emblem', 48, '' ); ?>
					<span>ZEST HOLDINGS</span>
				</a>
				<p><?php esc_html_e( 'Security, housekeeping & facility management and cafeteria services since 2006. PSARA licensed. Member of ASIS International.', 'zest' ); ?></p>
				<ul class="footer-badges">
					<li><?php esc_html_e( 'PSARA Licensed', 'zest' ); ?></li>
					<li><?php esc_html_e( 'ASIS Member', 'zest' ); ?></li>
					<li><?php esc_html_e( 'PF & ESIC Compliant', 'zest' ); ?></li>
				</ul>
			<?php endif; ?>
		</div>

		<?php foreach ( zest_verticals() as $term ) : ?>
			<?php $label = get_term_meta( $term->term_id, 'zest_menu_label', true ); ?>
			<div>
				<h2 class="footer-title"><a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $label ? $label : $term->name ); ?></a></h2>
				<ul class="footer-links">
					<?php foreach ( zest_services_in( $term, 6 ) as $service ) : ?>
						<li><a href="<?php echo esc_url( get_permalink( $service ) ); ?>"><?php echo esc_html( get_the_title( $service ) ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endforeach; ?>

		<div>
			<h2 class="footer-title"><?php esc_html_e( 'Head Office', 'zest' ); ?></h2>
			<address class="footer-contact">
				<p><?php zest_the_icon( 'pin', 18 ); ?><span><?php echo nl2br( esc_html( zest_opt( 'address' ) ) ); ?></span></p>
				<p><?php zest_the_icon( 'phone', 18 ); ?><a href="<?php echo esc_url( zest_phone_href() ); ?>"><?php echo esc_html( zest_opt( 'phone' ) ); ?></a></p>
				<p><?php zest_the_icon( 'mail', 18 ); ?><a href="mailto:<?php echo esc_attr( antispambot( zest_opt( 'email' ) ) ); ?>"><?php echo esc_html( antispambot( zest_opt( 'email' ) ) ); ?></a></p>
			</address>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => 'nav',
					'container_aria_label' => __( 'Footer', 'zest' ),
					'menu_class'     => 'footer-quick',
					'depth'          => 1,
					'fallback_cb'    => false,
				)
			);
			?>
		</div>
	</div>

	<?php if ( is_active_sidebar( 'footer-bottom' ) ) : ?>
		<div class="container site-footer__widgets"><?php dynamic_sidebar( 'footer-bottom' ); ?></div>
	<?php endif; ?>

	<div class="site-footer__bottom">
		<div class="container">
			<?php
			printf(
				/* translators: 1: year, 2: licence number */
				esc_html__( '© %1$s Zest Holdings Pvt. Ltd. · PSARA Licence %2$s', 'zest' ),
				esc_html( wp_date( 'Y' ) ),
				esc_html( zest_opt( 'licence' ) )
			);
			?>
			<span aria-hidden="true"> · </span>
			<a href="<?php echo esc_url( zest_page_url( 'privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'zest' ); ?></a>
		</div>
	</div>
</footer>

<a class="call-fab" href="<?php echo esc_url( zest_phone_href() ); ?>" aria-label="<?php esc_attr_e( 'Call Zest Holdings', 'zest' ); ?>"><?php zest_the_icon( 'phone', 22 ); ?></a>

<?php wp_footer(); ?>
</body>
</html>
