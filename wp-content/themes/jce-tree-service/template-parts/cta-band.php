<?php
/**
 * Closing CTA band. Pass 'variant' => 'emergency' for the calm/direct storm tone.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'variant' => 'default',
		'title'   => __( 'Ready for a straight answer about your trees?', 'jce' ),
		'copy'    => __( 'An arborist comes out, walks the property, and hand-writes the estimate. No cost, no pressure, no callback in three days.', 'jce' ),
		'email'   => false, // Adds a plain "Email Us Instead" link beside the buttons.
	)
);

$is_emergency = 'emergency' === $args['variant'];
?>
<section class="cta-band<?php echo $is_emergency ? ' cta-band--emergency' : ''; ?>">
	<div class="wrap cta-band__inner">
		<div>
			<h2><?php echo esc_html( $args['title'] ); ?></h2>
			<p><?php echo esc_html( $args['copy'] ); ?></p>
		</div>
		<div class="btn-row">
			<?php if ( $is_emergency ) : ?>
				<a class="btn btn--primary btn--lg" href="tel:<?php echo esc_attr( jce_emergency_tel() ); ?>">
					<?php jce_icon( 'phone' ); ?><?php echo esc_html( jce_emergency_phone() ); ?>
				</a>
			<?php else : ?>
				<a class="btn btn--primary btn--lg" href="<?php echo esc_url( jce_url( 'estimate_url', '/contact/' ) ); ?>">
					<?php esc_html_e( 'Get Your Personal Estimate', 'jce' ); ?>
				</a>
				<?php if ( jce_biz( 'phone' ) ) : ?>
					<a class="btn btn--ghost btn--lg" href="tel:<?php echo esc_attr( jce_tel() ); ?>">
						<?php jce_icon( 'phone' ); ?><?php echo esc_html( jce_biz( 'phone' ) ); ?>
					</a>
				<?php endif; ?>
				<?php if ( $args['email'] && jce_biz( 'email' ) ) : ?>
					<a class="link-arrow" href="mailto:<?php echo esc_attr( jce_biz( 'email' ) ); ?>">
						<?php esc_html_e( 'Email Us Instead', 'jce' ); ?>
					</a>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
</section>
