<?php
/**
 * Services grid. Order comes from each Service's Page Attributes > Order,
 * so removal leads and pruning follows, per the creative brief.
 *
 * Renders nothing when there are no Service posts. It used to fall back to a
 * hardcoded list, but that list was invented copy and went stale the moment
 * the real services were imported — it still advertised eight services and a
 * "Brush Clean Up & Mowing" that has since been split in two.
 *
 * @param array $args {
 *     @type int    $limit   Maximum cards, -1 for all.
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
		'limit'   => -1,
		'heading' => __( 'What We Do', 'jce' ),
		'eyebrow' => __( 'Our Services', 'jce' ),
		'lede'    => '',
		'class'   => 'section--cream',
	)
);

$services = new WP_Query(
	array(
		'post_type'      => 'service',
		'posts_per_page' => $args['limit'],
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
		'no_found_rows'  => true,
	)
);

if ( ! $services->have_posts() ) {
	return;
}
?>
<section class="section <?php echo esc_attr( $args['class'] ); ?>" id="services">
	<div class="wrap">
		<div class="section-head section-head--center">
			<p class="eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
			<h2><?php echo esc_html( $args['heading'] ); ?></h2>
			<?php if ( $args['lede'] ) : ?>
				<p class="lede"><?php echo esc_html( $args['lede'] ); ?></p>
			<?php endif; ?>
		</div>

		<div class="services-grid">
			<?php
			$i = 0;
			while ( $services->have_posts() ) :
				$services->the_post();
				$featured     = ( 0 === $i ) ? ' service-card--featured' : '';
				$card_summary = trim( get_the_excerpt() );
				$i++;
				?>
				<article class="service-card<?php echo esc_attr( $featured ); ?>">
					<div class="service-card__media"><?php jce_card_image( 'service' ); ?></div>
					<div class="service-card__body">
						<div class="service-card__icon"><?php jce_icon( jce_service_icon() ); ?></div>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php if ( $card_summary ) : ?>
							<p><?php echo esc_html( $card_summary ); ?></p>
						<?php endif; ?>
						<a class="link-arrow" href="<?php the_permalink(); ?>">
							<?php esc_html_e( 'Learn more', 'jce' ); ?><?php jce_icon( 'arrow-right' ); ?>
							<span class="screen-reader-text"><?php the_title(); ?></span>
						</a>
					</div>
				</article>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>
</section>
