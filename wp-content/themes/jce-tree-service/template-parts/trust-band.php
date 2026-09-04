<?php
/**
 * Wood-grain trust band.
 *
 * On the homepage it sits directly under the hero as a border along the bottom
 * of the photograph. These proof points used to float over the image and got
 * lost in it — on the wood they carry real weight, and they lead with the
 * three things the brief says decide the comparison: satisfaction, expertise,
 * and longevity.
 *
 * Every interior page gets it too — template-parts/page-hero.php calls this
 * automatically (flat variant) right after itself, so the credentials show
 * up site-wide without each template having to remember to add it.
 *
 * Every value is Customizer-driven (Business Info > Trust Signals), including
 * the fourth slot, which defaults to the brief's approved "HomeAdvisor Elite
 * Service" credential. Only blank if that field is set to a value that later
 * evaluates falsy — see jce_biz()'s fallback behavior.
 *
 * @param array $args {
 *     @type string $class Extra classes, e.g. 'trust-band--flat' away from a hero.
 * }
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args( isset( $args ) ? $args : array(), array( 'class' => '' ) );

$items = array(
	array(
		'icon' => 'star',
		'lead' => jce_biz( 'aggregate_rating', '4.9' ),
		'text' => __( 'Rating', 'jce' ),
	),
	array(
		'icon' => 'award',
		'lead' => jce_biz( 'arborist_count', '4' ),
		'text' => __( 'ISA-Certified Arborists', 'jce' ),
	),
	array(
		'icon' => 'users',
		'lead' => '',
		'text' => sprintf(
			/* translators: %s: years in business */
			__( 'Locally Owned and Operated for %s Years', 'jce' ),
			jce_biz( 'years_experience', '25' )
		),
	),
);

$award = jce_biz( 'award_label', __( 'HomeAdvisor Elite Service', 'jce' ) );
if ( $award ) {
	$items[] = array(
		'icon' => 'shield',
		'lead' => '',
		'text' => $award,
	);
}
?>
<aside class="trust-band <?php echo esc_attr( $args['class'] ); ?>" aria-label="<?php esc_attr_e( 'Why homeowners choose JCE', 'jce' ); ?>">
	<div class="wrap trust-band__inner">
		<?php foreach ( $items as $item ) : ?>
			<span class="trust-item">
				<?php jce_icon( $item['icon'], 'star' === $item['icon'] ? 'icon--filled' : '' ); ?>
				<span>
					<?php if ( $item['lead'] ) : ?>
						<strong><?php echo esc_html( $item['lead'] ); ?></strong>
					<?php endif; ?>
					<?php echo esc_html( $item['text'] ); ?>
				</span>
			</span>
		<?php endforeach; ?>
	</div>
</aside>
