<?php
/**
 * Row of titled cards, driven by the "Highlight Cards" page field.
 *
 * The About page uses them for what the company stands for; the Service Area
 * page uses them for what "we serve your town" actually commits us to.
 *
 * @param array $args {
 *     @type array    $rows    Rows of [ title, copy ].
 *     @type string[] $icons   Icon keys, cycled across the cards.
 *     @type string   $heading Section heading.
 *     @type string   $eyebrow Section eyebrow.
 *     @type string   $lede    Optional paragraph under the heading.
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
		'icons'   => array( 'shield', 'users', 'truck', 'award' ),
		'heading' => '',
		'eyebrow' => '',
		'lede'    => '',
		'class'   => '',
	)
);

if ( ! $args['rows'] ) {
	return;
}

$icons = $args['icons'] ? $args['icons'] : array( 'check-circle' );
?>
<section class="section <?php echo esc_attr( $args['class'] ); ?>">
	<div class="wrap">
		<?php if ( $args['heading'] ) : ?>
			<div class="section-head section-head--center">
				<?php if ( $args['eyebrow'] ) : ?>
					<p class="eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
				<?php endif; ?>
				<h2><?php echo esc_html( $args['heading'] ); ?></h2>
				<?php if ( $args['lede'] ) : ?>
					<p class="lede"><?php echo esc_html( $args['lede'] ); ?></p>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="highlight-grid">
			<?php foreach ( $args['rows'] as $i => $row ) : ?>
				<article class="highlight-card">
					<span class="highlight-card__icon"><?php jce_icon( $icons[ $i % count( $icons ) ] ); ?></span>
					<h3><?php echo esc_html( $row[0] ); ?></h3>
					<?php if ( ! empty( $row[1] ) ) : ?>
						<p><?php echo esc_html( $row[1] ); ?></p>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
