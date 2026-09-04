<?php
/**
 * Two-column "labelled points" block: a heading and lede on the left, a list
 * of label + sentence pairs on the right.
 *
 * Used for "Signs You Need This" on a service page and "What We See on Trees
 * Here" on a town page — the sections that carry the specifics a competitor
 * can't copy without doing the work.
 *
 * @param array $args {
 *     @type array  $rows    Rows of [ label, copy ].
 *     @type string $heading Section heading.
 *     @type string $eyebrow Section eyebrow.
 *     @type string $lede    Optional paragraph under the heading.
 *     @type string $icon    Icon key for each bullet.
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
		'lede'    => '',
		'icon'    => 'check-circle',
		'class'   => '',
	)
);

if ( ! $args['rows'] ) {
	return;
}
?>
<section class="section <?php echo esc_attr( $args['class'] ); ?>">
	<div class="wrap">
		<div class="feature-split">
			<div class="feature-split__head">
				<?php if ( $args['eyebrow'] ) : ?>
					<p class="eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
				<?php endif; ?>
				<?php if ( $args['heading'] ) : ?>
					<h2><?php echo esc_html( $args['heading'] ); ?></h2>
				<?php endif; ?>
				<?php if ( $args['lede'] ) : ?>
					<p class="lede" style="margin-top:1.1rem;"><?php echo esc_html( $args['lede'] ); ?></p>
				<?php endif; ?>
			</div>

			<ul class="feature-list">
				<?php foreach ( $args['rows'] as $row ) : ?>
					<li class="feature-list__item">
						<span class="feature-list__icon"><?php jce_icon( $args['icon'] ); ?></span>
						<span>
							<strong><?php echo esc_html( $row[0] ); ?></strong>
							<?php if ( ! empty( $row[1] ) ) : ?>
								<span class="feature-list__copy"><?php echo esc_html( $row[1] ); ?></span>
							<?php endif; ?>
						</span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>
