<?php
/**
 * Service area. Primary towns get their own linked location page (the SEO
 * deliverable); secondary towns are named in text — the brief is explicit that
 * we name towns rather than saying "our service area".
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$primary = new WP_Query(
	array(
		'post_type'      => 'location',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
		'no_found_rows'  => true,
		'meta_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery
			'relation' => 'OR',
			array( 'key' => '_jce_location_priority', 'value' => 'primary' ),
			array( 'key' => '_jce_location_priority', 'compare' => 'NOT EXISTS' ),
		),
	)
);

$fallback_primary = array(
	array( 'river-falls', 'River Falls, WI', __( 'Home base since 2001. Most of our work happens within a few miles of downtown.', 'jce' ) ),
	array( 'hudson', 'Hudson, WI', __( 'Established neighborhoods, mature trees, and a lot of ash that needs a plan.', 'jce' ) ),
	array( 'prescott', 'Prescott, WI', __( 'Bluff properties and river lots where access and cleanup take real equipment.', 'jce' ) ),
);

$location_images = jce_default_location_images();

$secondary = array( 'Ellsworth', 'Beldenville', 'Roberts', 'Houlton', 'Hammond', 'Baldwin', 'New Richmond', 'Spring Valley', 'Hastings', 'Afton', 'Lake St. Croix Beach', 'Lakeland' );
?>
<section class="section section--cream" id="service-area">
	<div class="wrap">
		<div class="section-head">
			<p class="eyebrow"><?php esc_html_e( 'Where We Work', 'jce' ); ?></p>
			<h2><?php esc_html_e( 'Serving River Falls, Hudson &amp; Prescott', 'jce' ); ?></h2>
		</div>

		<div class="area-primary">
			<?php if ( $primary->have_posts() ) : ?>
				<?php
				while ( $primary->have_posts() ) :
					$primary->the_post();
					?>
					<a class="area-card" href="<?php the_permalink(); ?>">
						<span class="area-card__media"><?php jce_card_image( 'location' ); ?></span>
						<span class="area-card__body">
							<h3><?php the_title(); ?></h3>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
							<span class="link-arrow"><?php esc_html_e( 'See our work here', 'jce' ); ?><?php jce_icon( 'arrow-right' ); ?></span>
						</span>
					</a>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<?php foreach ( $fallback_primary as $town ) : ?>
					<div class="area-card">
						<?php if ( isset( $location_images[ $town[0] ] ) && jce_img_exists( $location_images[ $town[0] ][0] ) ) : ?>
							<span class="area-card__media">
								<img src="<?php echo esc_url( jce_img_uri( $location_images[ $town[0] ][0] ) ); ?>"
									alt="<?php echo esc_attr( $location_images[ $town[0] ][1] ); ?>"
									width="1600" height="900" loading="lazy" decoding="async">
							</span>
						<?php endif; ?>
						<span class="area-card__body">
							<h3><?php echo esc_html( $town[1] ); ?></h3>
							<p><?php echo esc_html( $town[2] ); ?></p>
						</span>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<p class="area-secondary">
			<strong><?php esc_html_e( 'Also serving:', 'jce' ); ?></strong>
			<?php echo esc_html( implode( ' · ', $secondary ) ); ?>
		</p>
	</div>
</section>
