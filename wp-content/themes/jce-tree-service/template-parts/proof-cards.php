<?php
/**
 * Three proof cards, one per communication pillar from the brand brief.
 *
 * Sits on the warm ground that carries down from the wood band, with the icon
 * medallion breaking out of the top edge of each card.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cards = array(
	array(
		'icon'  => 'award',
		'title' => __( 'Credentialed Arborists', 'jce' ),
		'copy'  => sprintf(
			/* translators: %s: number of ISA-certified arborists */
			__( '%s ISA-certified arborists and two forestry degrees on staff — which means the person diagnosing your tree has the training to be right about it.', 'jce' ),
			jce_biz( 'arborist_count', '4' )
		),
	),
	array(
		'icon'  => 'clipboard',
		'title' => __( 'The Personal Estimate', 'jce' ),
		// Joe is named here for the first time on the page, so he gets
		// introduced rather than referred to as if you already know him.
		'copy'  => __( 'Joe Cardin has owned JCE since 2001, and he still walks most properties himself — hand-writing your estimate and talking you through it before you agree to anything.', 'jce' ),
	),
	array(
		'icon'  => 'truck',
		'title' => __( 'Property-First Care', 'jce' ),
		'copy'  => __( 'We treat your yard like it\'s ours. Every piece of equipment we own was chosen to protect the lawn while getting the job done right.', 'jce' ),
	),
);
?>
<section class="proof-cards" aria-label="<?php esc_attr_e( 'Why homeowners choose JCE', 'jce' ); ?>">
	<div class="wrap">
		<div class="proof-cards__grid">
			<?php foreach ( $cards as $card ) : ?>
				<article class="proof-card">
					<span class="proof-card__icon"><?php jce_icon( $card['icon'] ); ?></span>
					<h3><?php echo esc_html( $card['title'] ); ?></h3>
					<p><?php echo esc_html( $card['copy'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
