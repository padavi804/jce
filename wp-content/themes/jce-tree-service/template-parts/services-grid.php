<?php
/**
 * Services grid. Order comes from each Service's Page Attributes > Order,
 * so removal leads and pruning follows, per the creative brief.
 *
 * Falls back to the brief's service list when no Service posts exist yet, so
 * the homepage never renders an empty section during build-out.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args     = wp_parse_args( isset( $args ) ? $args : array(), array( 'limit' => -1, 'heading' => __( 'What We Do', 'jce' ) ) );
$services = new WP_Query(
	array(
		'post_type'      => 'service',
		'posts_per_page' => $args['limit'],
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
		'no_found_rows'  => true,
	)
);

// Icon lookup by slug, so a new Service picks up a sensible icon automatically.
$icon_map = array(
	'tree-removal'           => 'tree',
	'tree-pruning'           => 'scissors',
	'emergency-tree-service' => 'zap',
	'plant-health-care'      => 'leaf',
	'tree-inspection'        => 'search',
	'lot-land-clearing'      => 'layers',
	'brush-clean-up'         => 'wind',
	'stump-grinding'         => 'disc',
);

// Label, icon, copy, and the slug used to look up the bundled photo.
$fallback = array(
	array( 'Tree Removal', 'tree', __( 'Large and complex removals handled safely, from a dying ash to an oak leaning over the roofline.', 'jce' ), 'tree-removal' ),
	array( 'Tree Pruning', 'scissors', __( 'Structural and health pruning timed to the season and the species, not just whatever week we\'re in the neighborhood.', 'jce' ), 'tree-pruning' ),
	array( 'Emergency Tree Service', 'zap', __( 'Storm damage, a tree on a structure, or a hazardous leaner. Call and we will tell you straight what happens next.', 'jce' ), 'emergency-tree-service' ),
	array( 'Plant Health Care', 'leaf', __( 'Four licensed pesticide applicators treating the diseases and pests actually showing up in our area.', 'jce' ), 'plant-health-care' ),
	array( 'Tree Inspection', 'search', __( 'An arborist assessment that tells you when a tree needs to come down, and when it can be saved.', 'jce' ), 'tree-inspection' ),
	array( 'Lot & Land Clearing', 'layers', __( 'Clearing for building sites, fence lines, and overgrown acreage on larger country properties.', 'jce' ), 'lot-land-clearing' ),
	array( 'Brush Clean Up & Mowing', 'wind', __( 'Overgrown brush cut back and hauled out, leaving the property usable again.', 'jce' ), 'brush-clean-up' ),
	array( 'Stump Grinding', 'disc', __( 'Grinding down what\'s left so you can put grass, garden, or patio back where the tree stood.', 'jce' ), 'stump-grinding' ),
);
?>
<section class="section section--cream" id="services">
	<div class="wrap">
		<div class="section-head section-head--center">
			<p class="eyebrow"><?php esc_html_e( 'Our Services', 'jce' ); ?></p>
			<h2><?php echo esc_html( $args['heading'] ); ?></h2>
			<p class="lede"><?php esc_html_e( 'Removal is most of what we do, but the crew that shows up is trained for everything on this list.', 'jce' ); ?></p>
		</div>

		<div class="services-grid">
			<?php if ( $services->have_posts() ) : ?>
				<?php
				$i = 0;
				while ( $services->have_posts() ) :
					$services->the_post();
					$slug = get_post_field( 'post_name' );
					$icon = get_post_meta( get_the_ID(), '_jce_service_icon', true );
					if ( ! $icon ) {
						$icon = isset( $icon_map[ $slug ] ) ? $icon_map[ $slug ] : 'tree';
					}
					$featured = ( 0 === $i ) ? ' service-card--featured' : '';
					$i++;
					?>
					<article class="service-card<?php echo esc_attr( $featured ); ?>">
						<div class="service-card__media"><?php jce_card_image( 'service' ); ?></div>
						<div class="service-card__body">
							<div class="service-card__icon"><?php jce_icon( $icon ); ?></div>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo esc_html( get_the_excerpt() ); ?></p>
							<a class="link-arrow" href="<?php the_permalink(); ?>">
								<?php esc_html_e( 'Learn more', 'jce' ); ?><?php jce_icon( 'arrow-right' ); ?>
								<span class="screen-reader-text"><?php the_title(); ?></span>
							</a>
						</div>
					</article>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<?php
				$fallback_images = jce_default_service_images();
				foreach ( $fallback as $i => $item ) :
					$slug = isset( $item[3] ) ? $item[3] : '';
					?>
					<article class="service-card<?php echo 0 === $i ? ' service-card--featured' : ''; ?>">
						<?php if ( $slug && isset( $fallback_images[ $slug ] ) && jce_img_exists( $fallback_images[ $slug ][0] ) ) : ?>
							<div class="service-card__media">
								<img src="<?php echo esc_url( jce_img_uri( $fallback_images[ $slug ][0] ) ); ?>"
									alt="<?php echo esc_attr( $fallback_images[ $slug ][1] ); ?>"
									width="800" height="500" loading="lazy" decoding="async">
							</div>
						<?php endif; ?>
						<div class="service-card__body">
							<div class="service-card__icon"><?php jce_icon( $item[1] ); ?></div>
							<h3><?php echo esc_html( $item[0] ); ?></h3>
							<p><?php echo esc_html( $item[2] ); ?></p>
						</div>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>
