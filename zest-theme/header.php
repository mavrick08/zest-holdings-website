<?php
/**
 * Site header.
 *
 * @package zest
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'zest' ); ?></a>

<div class="topbar">
	<div class="container topbar__inner">
		<span><?php echo esc_html( zest_opt( 'topbar' ) ); ?></span>
		<span class="topbar__contact">
			<a href="<?php echo esc_url( zest_phone_href() ); ?>"><?php zest_the_icon( 'phone', 14 ); ?><?php echo esc_html( zest_opt( 'phone' ) ); ?></a>
			<span class="topbar__sep" aria-hidden="true">|</span>
			<a href="mailto:<?php echo esc_attr( antispambot( zest_opt( 'email' ) ) ); ?>"><?php zest_the_icon( 'mail', 14 ); ?><?php echo esc_html( antispambot( zest_opt( 'email' ) ) ); ?></a>
		</span>
	</div>
</div>

<header class="site-header" id="site-header">
	<div class="container site-header__inner">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php zest_logo_img( 'full', 72, __( 'Zest Facility – home', 'zest' ) ); ?>
			<span class="brand__text">
				<span class="brand__name">ZEST HOLDINGS</span>
				<span class="brand__tag"><?php esc_html_e( 'Security · Facility · Food Services', 'zest' ); ?></span>
			</span>
		</a>

		<button class="nav-toggle" type="button" aria-controls="primary-nav" aria-expanded="false">
			<span class="nav-toggle__bars" aria-hidden="true"></span>
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'zest' ); ?></span>
		</button>

		<nav class="primary-nav" id="primary-nav" aria-label="<?php esc_attr_e( 'Main', 'zest' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'menu',
					'depth'          => 2,
					'fallback_cb'    => 'zest_fallback_menu',
				)
			);
			?>
			<a class="btn btn--primary primary-nav__cta" href="<?php echo esc_url( zest_page_url( 'request-a-quote' ) ); ?>"><?php esc_html_e( 'Request a Quote', 'zest' ); ?></a>
		</nav>
	</div>
</header>

<main id="main" class="site-main" tabindex="-1">
