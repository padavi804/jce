<?php
/**
 * Homepage hero.
 *
 * The headline sits in a narrow left column so it never covers the subject of
 * the photograph, and the scrim is weighted to the left for the same reason —
 * dark enough to carry white type, clear on the right so the work stays visible.
 * Headline, accent, subhead and image are all Customizer-editable.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero   = jce_hero_image( 'home' );
$accent = jce_biz( 'hero_headline_accent', 'No Exceptions.' );
?>
<section class="hero">
	<div class="hero__media">
		<?php if ( $hero ) : ?>
			<?php // fetchpriority=high: this is the LCP element, so it must not wait in the queue. ?>
			<img src="<?php echo esc_url( $hero['url'] ); ?>"
				<?php if ( $hero['srcset'] ) : ?>
					srcset="<?php echo esc_attr( $hero['srcset'] ); ?>"
					sizes="100vw"
				<?php endif; ?>
				alt="<?php echo esc_attr( $hero['alt'] ); ?>"
				width="1920" height="1080"
				fetchpriority="high" decoding="async">
		<?php else : ?>
			<?php jce_media_placeholder( 'media-ph--fill', __( 'Hero photo: JCE crew on a property', 'jce' ) ); ?>
		<?php endif; ?>
	</div>

	<div class="wrap">
		<div class="hero__inner">
			<h1>
				<?php echo esc_html( jce_biz( 'hero_headline', 'The Highest Standard of Tree Care.' ) ); ?>
				<?php if ( $accent ) : ?>
					<span class="hero__accent"><?php echo esc_html( $accent ); ?></span>
				<?php endif; ?>
			</h1>

			<p class="hero__subhead"><?php echo esc_html( jce_biz( 'hero_subhead' ) ); ?></p>

			<div class="btn-row hero__actions">
				<a class="btn btn--primary btn--lg" href="<?php echo esc_url( jce_url( 'estimate_url', '/contact/' ) ); ?>">
					<?php esc_html_e( 'Get Your Personal Estimate', 'jce' ); ?>
					<?php jce_icon( 'arrow-right' ); ?>
				</a>
				<?php if ( jce_biz( 'phone' ) ) : ?>
					<a class="btn btn--ghost btn--lg" href="tel:<?php echo esc_attr( jce_tel() ); ?>">
						<?php jce_icon( 'phone' ); ?>
						<?php echo esc_html( jce_biz( 'phone' ) ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
