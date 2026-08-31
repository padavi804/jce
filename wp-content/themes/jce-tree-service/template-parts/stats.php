<?php
/**
 * Credential counts.
 *
 * Deliberately different numbers from the wood trust band above — that one
 * carries rating / arborists / years, so this one goes a layer deeper into the
 * things a newer competitor can't staff up overnight.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$stats = array(
	array( '2001', __( 'Serving River Falls Since', 'jce' ) ),
	array( '4', __( 'Licensed Pesticide Applicators', 'jce' ) ),
	array( '2', __( 'Forestry Degrees on Staff', 'jce' ) ),
	array( '15', __( 'Towns Across the Valley', 'jce' ) ),
);
?>
<section class="stats" aria-label="<?php esc_attr_e( 'JCE Tree Service by the numbers', 'jce' ); ?>">
	<div class="wrap">
		<div class="stats__grid">
			<?php foreach ( $stats as $stat ) : ?>
				<div class="stat">
					<span class="stat__num"><?php echo esc_html( $stat[0] ); ?></span>
					<span class="stat__label"><?php echo esc_html( $stat[1] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
