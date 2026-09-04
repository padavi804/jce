<?php
/**
 * Proof blocks: a claim, the customer quote that backs it, and the photograph
 * that shows it.
 *
 * This is the brief's claims-convergence answer in one component. Every tree
 * company says "meticulous cleanup"; almost none of them can put a named
 * customer and a photograph of the same job next to the sentence. The three
 * pieces are deliberately locked together — a block will not render a claim
 * with no evidence under it.
 *
 * Blocks alternate sides so a run of them reads as a sequence rather than a
 * list.
 *
 * @param array $args {
 *     @type array  $rows    Rows of [ heading, body, quote, attribution, caption ].
 *                           Two captions separated by " // " render a
 *                           before/after pair.
 *     @type string $heading Optional section heading.
 *     @type string $eyebrow Optional section eyebrow.
 *     @type string $class   Extra section classes.
 * }
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'rows'    => array(),
		'heading' => '',
		'eyebrow' => '',
		'class'   => '',
	)
);

// A block needs a heading and at least one of body/quote to be worth showing.
$blocks = array();
foreach ( $args['rows'] as $row ) {
	$row = array_pad( $row, 5, '' );
	if ( $row[0] && ( $row[1] || $row[2] ) ) {
		$blocks[] = $row;
	}
}

if ( ! $blocks ) {
	return;
}
?>
<section class="section <?php echo esc_attr( $args['class'] ); ?>" id="proof">
	<div class="wrap">
		<?php if ( $args['heading'] ) : ?>
			<div class="section-head">
				<?php if ( $args['eyebrow'] ) : ?>
					<p class="eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
				<?php endif; ?>
				<h2><?php echo esc_html( $args['heading'] ); ?></h2>
			</div>
		<?php endif; ?>

		<div class="proof-blocks">
			<?php
			foreach ( $blocks as $i => $block ) :
				list( $title, $body, $quote, $who, $caption ) = $block;

				// " // " marks a before/after pair; a single caption is one shot.
				$captions = array_values( array_filter( array_map( 'trim', explode( '//', $caption ) ) ) );
				$is_pair  = count( $captions ) > 1;
				?>
				<article class="proof-block<?php echo ( $i % 2 ) ? ' proof-block--reverse' : ''; ?>">
					<div class="proof-block__media<?php echo $is_pair ? ' proof-block__media--pair' : ''; ?>">
						<?php if ( $captions ) : ?>
							<?php foreach ( $captions as $shot ) : ?>
								<figure class="proof-shot">
									<?php jce_media_placeholder( 'media-ph--wide', $shot ); ?>
								</figure>
							<?php endforeach; ?>
						<?php else : ?>
							<figure class="proof-shot"><?php jce_media_placeholder( 'media-ph--wide' ); ?></figure>
						<?php endif; ?>
					</div>

					<div class="proof-block__body">
						<h3><?php echo esc_html( $title ); ?></h3>
						<?php if ( $body ) : ?>
							<p><?php echo esc_html( $body ); ?></p>
						<?php endif; ?>

						<?php if ( $quote ) : ?>
							<blockquote class="proof-quote">
								<div class="proof-quote__stars" role="img" aria-label="<?php esc_attr_e( '5 out of 5 stars', 'jce' ); ?>">
									<?php for ( $s = 0; $s < 5; $s++ ) : ?>
										<?php jce_icon( 'star', 'icon--filled' ); ?>
									<?php endfor; ?>
								</div>
								<p><?php echo esc_html( $quote ); ?></p>
								<?php if ( $who ) : ?>
									<cite class="proof-quote__cite"><?php echo esc_html( $who ); ?></cite>
								<?php endif; ?>
							</blockquote>
						<?php endif; ?>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
