<?php
/**
 * "What's included" + "what affects the price", side by side.
 *
 * Pairing them is deliberate: the brief's central fear is being upsold, and
 * naming the price drivers next to the deliverables answers that in the one
 * place a homeowner is actually looking for it.
 *
 * @param array $args {
 *     @type string[] $included Plain lines — what the price covers.
 *     @type array    $pricing  Rows of [ factor, copy ].
 *     @type string   $heading  Section heading.
 * }
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'included' => array(),
		'pricing'  => array(),
		'heading'  => __( 'What the Job Includes', 'jce' ),
		'class'    => '',
	)
);

if ( ! $args['included'] && ! $args['pricing'] ) {
	return;
}
?>
<section class="section <?php echo esc_attr( $args['class'] ); ?>" id="scope">
	<div class="wrap">
		<div class="scope">
			<?php if ( $args['included'] ) : ?>
				<div class="scope__panel">
					<p class="eyebrow"><?php esc_html_e( 'Included', 'jce' ); ?></p>
					<h2 class="scope__title"><?php echo esc_html( $args['heading'] ); ?></h2>
					<ul class="checklist">
						<?php foreach ( $args['included'] as $item ) : ?>
							<li><?php jce_icon( 'check-circle' ); ?><span><?php echo esc_html( $item ); ?></span></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>

			<?php if ( $args['pricing'] ) : ?>
				<div class="scope__panel scope__panel--dark">
					<p class="eyebrow"><?php esc_html_e( 'Estimating', 'jce' ); ?></p>
					<h2 class="scope__title"><?php esc_html_e( 'What Moves the Price', 'jce' ); ?></h2>
					<p class="scope__note"><?php esc_html_e( 'No two trees price the same. These are the things an arborist is actually weighing while walking your property.', 'jce' ); ?></p>
					<dl class="price-factors">
						<?php foreach ( $args['pricing'] as $row ) : ?>
							<div class="price-factor">
								<dt><?php echo esc_html( $row[0] ); ?></dt>
								<?php if ( ! empty( $row[1] ) ) : ?>
									<dd><?php echo esc_html( $row[1] ); ?></dd>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</dl>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
