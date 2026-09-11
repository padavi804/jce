<?php
/**
 * Every town we serve: primary towns as photo cards, secondary towns as a
 * linked list underneath.
 *
 * Differs from template-parts/service-area.php, which is the short version
 * embedded in other pages. This is the full inventory for the Service Area
 * landing page — every town gets a link, because each one is its own indexable
 * page and the brief is explicit about naming towns rather than describing
 * "our service area".
 *
 * @param array $args {
 *     @type string $heading Section heading.
 *     @type string $eyebrow Section eyebrow.
 *     @type string $lede    Optional paragraph under the heading.
 *     @type string $class   Extra section classes.
 * }
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'heading' => __( 'Where We Work', 'jce' ),
		'eyebrow' => __( 'Service Area', 'jce' ),
		'lede'    => '',
		'class'   => '',
	)
);

$base_query = array(
	'post_type'      => 'location',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order title',
	'order'          => 'ASC',
	'no_found_rows'  => true,
);

// A Location with no priority set yet is treated as primary, so a town added
// in a hurry still shows up with a card rather than vanishing.
$primary = new WP_Query(
	array_merge(
		$base_query,
		array(
			'meta_query' => array( // phpcs:ignore WordPress.DB.SlowDBQuery
				'relation' => 'OR',
				array( 'key' => '_jce_location_priority', 'value' => 'primary' ),
				array( 'key' => '_jce_location_priority', 'compare' => 'NOT EXISTS' ),
			),
		)
	)
);

$secondary = new WP_Query(
	array_merge(
		$base_query,
		array(
			'meta_query' => array( // phpcs:ignore WordPress.DB.SlowDBQuery
				array( 'key' => '_jce_location_priority', 'value' => 'secondary' ),
			),
		)
	)
);
?>
<section class="section <?php echo esc_attr( $args['class'] ); ?>" id="towns">
	<div class="wrap">
		<div class="section-head">
			<p class="eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
			<h2><?php echo esc_html( $args['heading'] ); ?></h2>
			<?php if ( $args['lede'] ) : ?>
				<p class="lede" style="margin-top:1.1rem;"><?php echo esc_html( $args['lede'] ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $primary->have_posts() ) : ?>
			<div class="area-primary">
				<?php
				while ( $primary->have_posts() ) :
					$primary->the_post();
					$distance = get_post_meta( get_the_ID(), '_jce_location_distance', true );
					?>
					<a class="area-card" href="<?php the_permalink(); ?>">
						<span class="area-card__media"><?php jce_card_image( 'location' ); ?></span>
						<span class="area-card__body">
							<h3><?php the_title(); ?></h3>
							<?php if ( $distance ) : ?>
								<span class="area-card__meta"><?php jce_icon( 'map-pin' ); ?><?php echo esc_html( $distance ); ?></span>
							<?php endif; ?>
							<?php
							// A town with no Excerpt and no body copy would otherwise
							// leave an empty paragraph under its name. Approved town
							// copy is still pending, so absent has to render as absent.
							$card_summary = trim( wp_trim_words( get_the_excerpt(), 20 ) );
							?>
							<?php if ( $card_summary ) : ?>
								<p><?php echo esc_html( $card_summary ); ?></p>
							<?php endif; ?>
							<span class="link-arrow"><?php esc_html_e( 'See our work here', 'jce' ); ?><?php jce_icon( 'arrow-right' ); ?></span>
						</span>
					</a>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		<?php endif; ?>

		<?php if ( $secondary->have_posts() ) : ?>
			<div class="town-list">
				<h3 class="town-list__title"><?php esc_html_e( 'Also serving, on the same schedule', 'jce' ); ?></h3>
				<ul class="chip-grid chip-grid--compact">
					<?php
					while ( $secondary->have_posts() ) :
						$secondary->the_post();
						?>
						<li>
							<a class="chip-link" href="<?php the_permalink(); ?>">
								<span class="chip-link__icon"><?php jce_icon( 'map-pin' ); ?></span>
								<span class="chip-link__label"><?php the_title(); ?></span>
								<?php jce_icon( 'arrow-right', 'chip-link__arrow' ); ?>
							</a>
						</li>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</ul>
			</div>
		<?php endif; ?>
	</div>
</section>
