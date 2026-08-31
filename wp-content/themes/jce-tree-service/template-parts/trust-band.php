<?php
/**
 * Wood-grain trust band.
 *
 * Sits directly under the hero as a border along the bottom of the photograph.
 * These proof points used to float over the image and got lost in it — on the
 * wood they carry real weight, and they lead with the three things the brief
 * says decide the comparison: satisfaction, expertise, and longevity.
 *
 * Every value is Customizer-driven (Business Info > Trust Signals).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$items = array(
	array(
		'icon' => 'star',
		'lead' => jce_biz( 'aggregate_rating', '4.9' ),
		'text' => __( 'Star Rating', 'jce' ),
	),
	array(
		'icon' => 'award',
		'lead' => jce_biz( 'arborist_count', '4' ),
		'text' => __( 'ISA-Certified Arborists', 'jce' ),
	),
	array(
		'icon' => 'users',
		'lead' => jce_biz( 'years_experience', '25' ),
		'text' => __( 'Years Locally Owned', 'jce' ),
	),
);
?>
<aside class="trust-band" aria-label="<?php esc_attr_e( 'Why homeowners choose JCE', 'jce' ); ?>">
	<div class="wrap trust-band__inner">
		<?php foreach ( $items as $item ) : ?>
			<span class="trust-item">
				<?php jce_icon( $item['icon'], 'star' === $item['icon'] ? 'icon--filled' : '' ); ?>
				<span><strong><?php echo esc_html( $item['lead'] ); ?></strong> <?php echo esc_html( $item['text'] ); ?></span>
			</span>
		<?php endforeach; ?>
	</div>
</aside>
