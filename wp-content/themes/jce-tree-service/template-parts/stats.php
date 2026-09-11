<?php
/**
 * Credential counts, in a headed band.
 *
 * @param array $args {
 *     @type array  $stats   Rows of [ number, label, icon ]. Icon is an
 *                           optional jce_icon() key — omit it to leave that
 *                           stat without one. Defaults to the site-wide
 *                           credential counts if not supplied.
 *     @type string $heading Optional section heading.
 *     @type string $eyebrow Optional eyebrow above the heading.
 *     @type string $class   Extra section classes.
 * }
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'stats'   => array(),
		'heading' => '',
		'eyebrow' => '',
		'class'   => '',
	)
);

$stats = $args['stats'] ? $args['stats'] : array(
	array( '2001', __( 'Serving River Falls Since', 'jce' ), 'calendar' ),
	array( '4', __( 'Licensed Pesticide Applicators', 'jce' ), 'droplet' ),
	array( '2', __( 'Forestry Degrees on Staff', 'jce' ), 'leaf' ),
	array( '15', __( 'Towns Across the Valley', 'jce' ), 'map-pin' ),
);
?>
<section class="stats section--dark <?php echo esc_attr( $args['class'] ); ?>" aria-label="<?php esc_attr_e( 'JCE Tree Service by the numbers', 'jce' ); ?>">
	<div class="wrap">
		<?php if ( $args['heading'] ) : ?>
			<div class="section-head section-head--center">
				<?php if ( $args['eyebrow'] ) : ?>
					<p class="eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
				<?php endif; ?>
				<h2><?php echo esc_html( $args['heading'] ); ?></h2>
			</div>
		<?php endif; ?>

		<div class="stats__grid">
			<?php foreach ( $stats as $stat ) : ?>
				<div class="stat">
					<?php if ( ! empty( $stat[2] ) ) : ?>
						<span class="stat__icon"><?php jce_icon( $stat[2] ); ?></span>
					<?php endif; ?>
					<span class="stat__num"><?php echo esc_html( $stat[0] ); ?></span>
					<span class="stat__label"><?php echo esc_html( $stat[1] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
