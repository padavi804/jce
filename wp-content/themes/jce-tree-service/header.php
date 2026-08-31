<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main-content"><?php esc_html_e( 'Skip to content', 'jce' ); ?></a>

<?php $phone = jce_biz( 'phone' ); ?>

<?php
/**
 * The header floats over the hero rather than sitting above it: a gradient
 * scrim at the top keeps the nav legible while the photograph runs full-bleed
 * behind it. Once the page scrolls past the hero it solidifies (see main.js).
 */
?>
<header class="site-header">
	<div class="site-header__bar">
		<div class="wrap site-header__inner">
			<div class="site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
					<?php if ( has_custom_logo() ) : ?>
						<?php
						$logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
						if ( $logo ) :
							?>
							<img src="<?php echo esc_url( $logo[0] ); ?>"
								alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
								width="220" height="132" fetchpriority="high" decoding="async">
						<?php endif; ?>
					<?php elseif ( jce_img_exists( 'logo-jce-reverse.png' ) ) : ?>
						<?php // Reverse lockup: the official mark with the wordmark in white, for dark/photo backgrounds. ?>
						<img src="<?php echo esc_url( jce_img_uri( 'logo-jce-reverse.png' ) ); ?>"
							alt="<?php esc_attr_e( 'JCE Tree Service — River Falls, Wisconsin', 'jce' ); ?>"
							width="220" height="132" fetchpriority="high" decoding="async">
					<?php else : ?>
						<span class="site-title">JCE <small><?php esc_html_e( 'Tree Service', 'jce' ); ?></small></span>
					<?php endif; ?>
				</a>
			</div>

			<nav id="primary-nav" class="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'jce' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'depth'          => 2,
						'fallback_cb'    => 'jce_primary_menu_fallback',
					)
				);
				?>
			</nav>

			<div class="header-actions">
				<?php if ( $phone ) : ?>
					<a class="header-phone" href="tel:<?php echo esc_attr( jce_tel() ); ?>">
						<?php jce_icon( 'phone' ); ?><span><?php echo esc_html( $phone ); ?></span>
					</a>
				<?php endif; ?>

				<a class="btn btn--emergency btn--emergency-nav" href="<?php echo esc_url( jce_url( 'emergency_url', '/emergency-tree-service/' ) ); ?>">
					<?php jce_icon( 'zap', 'icon--filled' ); ?>
					<span><?php echo esc_html( jce_biz( 'emergency_label', 'Storm Emergency' ) ); ?></span>
				</a>

				<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav">
					<span class="screen-reader-text"><?php esc_html_e( 'Toggle navigation menu', 'jce' ); ?></span>
					<span class="nav-toggle__box" aria-hidden="true"><span></span><span></span><span></span></span>
				</button>
			</div>
		</div>
	</div>
</header>

<main id="main-content" class="site-main">
