<?php
/**
 * Landing Page (paid/LSA traffic). Deliberately stripped of primary nav
 * and secondary links — single CTA focus per the creative brief's scope
 * for "landing pages built to convert paid/LSA traffic specifically."
 */
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
<body <?php body_class( 'landing-page' ); ?>>
<?php wp_body_open(); ?>

<header class="landing-header">
	<div class="wrap landing-header__inner">
		<?php if ( has_custom_logo() ) : the_custom_logo(); else : bloginfo( 'name' ); endif; ?>
		<?php $phone = jce_biz( 'phone' ); ?>
		<?php if ( $phone ) : ?>
			<a class="button button--primary" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
		<?php endif; ?>
	</div>
</header>

<?php
while ( have_posts() ) :
	the_post();
	?>
	<main class="landing-main">
		<div class="wrap wrap--narrow">
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
			<a class="button button--primary button--large" href="<?php echo esc_url( jce_biz( 'estimate_url', '/estimate/' ) ); ?>"><?php esc_html_e( 'Get Your Personal Estimate', 'jce' ); ?></a>
		</div>
	</main>
	<?php
endwhile;
?>

<footer class="landing-footer">
	<div class="wrap">
		<p>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
