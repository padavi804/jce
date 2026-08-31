<?php
/**
 * Compact interior-page hero with breadcrumbs.
 *
 * Pass 'context' (services|about|contact|emergency|blog) to pick up the
 * bundled default photo; a Featured Image on the page overrides it.
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
?>
<section class="page-hero<?php echo $hero ? ' page-hero--has-image' : ''; ?>">
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
	</div>
</section>
