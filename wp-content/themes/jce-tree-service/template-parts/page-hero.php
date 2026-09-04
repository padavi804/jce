<?php
/**
 * Compact interior-page hero with breadcrumbs.
 *
 * Pass 'context' (services|about|contact|emergency|blog) to pick up the
 * bundled default photo; a Featured Image on the page overrides it.
 *
 * Every interior page gets the trust band directly underneath, flat variant,
 * so the credentials are visible site-wide and no template has to remember
 * to add it — see template-parts/trust-band.php. The homepage's own hero
 * calls the (non-flat) trust band itself, since it isn't built on this part.
 *
 * @param array $args {
 *     @type string $title   H1. Falls back to the post title in the loop.
 *     @type string $sub     Standfirst paragraph.
 *     @type string $eyebrow Small label above the H1.
 *     @type string $context Bundled photo key.
 *     @type string $image   Explicit image URL, wins over 'context'.
 *     @type bool   $buttons Render the estimate + call pair.
 *     @type string $area    "Proudly serving…" line under the buttons.
 * }
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'title'   => '',
		'sub'     => '',
		'eyebrow' => '',
		'context' => '',
		'image'   => '',
		'buttons' => false,
		'area'    => '',
	)
);

// Only fall back to the post title when a caller didn't supply one — archives
// and 404s have no post in scope at this point.
if ( ! $args['title'] && in_the_loop() ) {
	$args['title'] = get_the_title();
}

$hero = null;
if ( $args['image'] ) {
	$hero = array( 'url' => $args['image'], 'alt' => '', 'srcset' => '' );
} elseif ( $args['context'] ) {
	$hero = jce_hero_image( $args['context'] );
}

// A long, keyword-bearing H1 ("Tree Removal by Local Tree Experts in the
// St. Croix River Valley") at the full display size runs to four or five
// lines and swamps the hero. Past roughly forty characters it steps down a
// size and gets a wider measure.
$long_title = mb_strlen( wp_strip_all_tags( $args['title'] ) ) > 40;
?>
<section class="page-hero<?php echo $hero ? ' page-hero--has-image' : ''; ?><?php echo $long_title ? ' page-hero--long' : ''; ?>">
	<?php if ( $hero ) : ?>
		<div class="page-hero__media">
			<img src="<?php echo esc_url( $hero['url'] ); ?>"
				alt="<?php echo esc_attr( $hero['alt'] ); ?>"
				width="1920" height="1080"
				fetchpriority="high" decoding="async">
		</div>
	<?php endif; ?>

	<div class="wrap">
		<?php jce_breadcrumbs(); ?>
		<?php if ( $args['eyebrow'] ) : ?>
			<p class="eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
		<?php endif; ?>
		<h1><?php echo esc_html( $args['title'] ); ?></h1>
		<?php if ( $args['sub'] ) : ?>
			<p class="page-hero__sub"><?php echo esc_html( $args['sub'] ); ?></p>
		<?php endif; ?>

		<?php if ( $args['buttons'] ) : ?>
			<div class="btn-row page-hero__actions">
				<a class="btn btn--primary btn--lg" href="<?php echo esc_url( jce_url( 'estimate_url', '/estimate/' ) ); ?>">
					<?php esc_html_e( 'Get Your Personal Estimate', 'jce' ); ?>
				</a>
				<?php if ( jce_biz( 'phone' ) ) : ?>
					<a class="btn btn--ghost btn--lg" href="tel:<?php echo esc_attr( jce_tel() ); ?>">
						<?php jce_icon( 'phone' ); ?>
						<?php
						printf(
							/* translators: %s: phone number */
							esc_html__( 'Call now: %s', 'jce' ),
							esc_html( jce_biz( 'phone' ) )
						);
						?>
					</a>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( $args['area'] ) : ?>
			<p class="page-hero__area"><?php jce_icon( 'map-pin' ); ?><span><?php echo esc_html( $args['area'] ); ?></span></p>
		<?php endif; ?>
	</div>
</section>

<?php get_template_part( 'template-parts/trust-band', null, array( 'class' => 'trust-band--flat' ) ); ?>
