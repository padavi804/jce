<?php
/**
 * Vertical timeline on the dark band, driven by the "Timeline" page field.
 *
 * Twenty-five years in one town is the single hardest claim for a franchise
 * competitor to match, so the About page states it as dated events rather than
 * as an adjective.
 *
 * @param array $args {
 *     @type array  $rows    Rows of [ year, title, copy ].
 *     @type string $heading Section heading.
 *     @type string $eyebrow Section eyebrow.
 * }
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'rows'    => array(),
		'heading' => __( 'How We Got Here', 'jce' ),
		'eyebrow' => __( 'Our Story', 'jce' ),
	)
);

if ( ! $args['rows'] ) {
	return;
}
?>
<section class="section section--dark" id="story">
	<div class="wrap">
		<div class="section-head">
			<p class="eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
			<h2><?php echo esc_html( $args['heading'] ); ?></h2>
		</div>

		<ol class="timeline">
			<?php foreach ( $args['rows'] as $row ) : ?>
				<li class="timeline__item">
					<span class="timeline__year"><?php echo esc_html( $row[0] ); ?></span>
					<div class="timeline__body">
						<h3><?php echo esc_html( $row[1] ); ?></h3>
						<?php if ( ! empty( $row[2] ) ) : ?>
							<p><?php echo esc_html( $row[2] ); ?></p>
						<?php endif; ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
