<?php
/**
 * Photo reel — a browsable strip of real job photos, right after the body
 * copy.
 *
 * The body makes its argument in prose; this is where the photos that back
 * it up get room to actually be looked at, instead of being shrunk to fit
 * beside a paragraph. No fallback copy: a stock "job site" photo is not an
 * acceptable placeholder for a real one, so a Service with nothing entered
 * here simply has no reel.
 *
 * A slide with no photo yet still renders — labelled with its own caption —
 * so a filled-in caption list doubles as a shot list before the photos exist,
 * the same convention the sub-services grid uses.
 *
 * @param array $args {
 *     @type string[] $rows    One caption per slide.
 *     @type int[]    $images  Attachment ID per slide, positionally matched.
 *                              0 (or a missing index) falls back to the
 *                              placeholder.
 *     @type string   $heading Section heading.
 *     @type string   $eyebrow Section eyebrow.
 *     @type string   $class   Extra section classes.
 * }
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'rows'    => array(),
		'images'  => array(),
		'heading' => '',
		'eyebrow' => __( 'On the Job', 'jce' ),
		'class'   => '',
	)
);

if ( ! $args['rows'] ) {
	return;
}

$multiple = count( $args['rows'] ) > 1;
?>
<section class="section section--tight <?php echo esc_attr( $args['class'] ); ?>" id="photo-reel">
	<div class="wrap wrap--narrow">
		<?php if ( $args['heading'] || $args['eyebrow'] ) : ?>
			<div class="photo-reel__head">
				<?php if ( $args['eyebrow'] ) : ?>
					<p class="eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
				<?php endif; ?>
				<?php if ( $args['heading'] ) : ?>
					<h2><?php echo esc_html( $args['heading'] ); ?></h2>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="photo-reel" data-photo-reel>
			<div class="photo-reel__stage">
				<?php foreach ( $args['rows'] as $i => $caption ) : ?>
					<figure class="photo-reel__slide<?php echo 0 === $i ? ' is-active' : ''; ?>" data-index="<?php echo (int) $i; ?>">
						<?php jce_attachment_or_placeholder( isset( $args['images'][ $i ] ) ? $args['images'][ $i ] : 0, 'jce-hero', 'media-ph--wide', $caption ); ?>
						<?php if ( $caption ) : ?>
							<figcaption class="photo-reel__cap"><?php echo esc_html( $caption ); ?></figcaption>
						<?php endif; ?>
					</figure>
				<?php endforeach; ?>
			</div>

			<?php if ( $multiple ) : ?>
				<div class="photo-reel__nav">
					<button type="button" class="photo-reel__arrow photo-reel__arrow--prev" data-photo-reel-prev aria-label="<?php esc_attr_e( 'Previous photo', 'jce' ); ?>">
						<?php jce_icon( 'arrow-right' ); ?>
					</button>
					<div class="photo-reel__dots">
						<?php foreach ( $args['rows'] as $i => $caption ) : ?>
							<button type="button" class="photo-reel__dot<?php echo 0 === $i ? ' is-active' : ''; ?>" data-index="<?php echo (int) $i; ?>" aria-label="<?php echo esc_attr( sprintf( /* translators: %d: slide number */ __( 'Go to photo %d', 'jce' ), $i + 1 ) ); ?>"></button>
						<?php endforeach; ?>
					</div>
					<button type="button" class="photo-reel__arrow photo-reel__arrow--next" data-photo-reel-next aria-label="<?php esc_attr_e( 'Next photo', 'jce' ); ?>">
						<?php jce_icon( 'arrow-right' ); ?>
					</button>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
