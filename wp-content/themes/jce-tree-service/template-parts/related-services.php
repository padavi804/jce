<?php
/**
 * Compact links to the other services, shown at the foot of a service page.
 *
 * Deliberately lighter than the full services grid: at this point in the page
 * the reader has already committed to a topic, so this is internal linking and
 * a way out — not a second pitch.
 *
 * @param array $args {
 *     @type int    $exclude Post ID to leave out (the current service).
 *     @type int    $limit   Maximum links.
 *     @type string $heading Section heading.
 * }
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'exclude' => get_the_ID(),
		'limit'   => 7,
		'heading' => __( 'Other Things We Do', 'jce' ),
		'class'   => '',
	)
);

$others = new WP_Query(
	array(
		'post_type'      => 'service',
		'posts_per_page' => $args['limit'],
		'post__not_in'   => array_filter( array( $args['exclude'] ) ),
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
		'no_found_rows'  => true,
	)
);

if ( ! $others->have_posts() ) {
	return;
}
?>
<section class="section section--tight <?php echo esc_attr( $args['class'] ); ?>" id="related-services">
	<div class="wrap">
		<div class="section-head section-head--center">
			<p class="eyebrow"><?php esc_html_e( 'Keep Looking', 'jce' ); ?></p>
			<h2 style="font-size:var(--step-3);"><?php echo esc_html( $args['heading'] ); ?></h2>
		</div>

		<div class="chip-grid">
			<?php
			while ( $others->have_posts() ) :
				$others->the_post();
				?>
				<a class="chip-link" href="<?php the_permalink(); ?>">
					<span class="chip-link__icon"><?php jce_icon( jce_service_icon() ); ?></span>
					<span class="chip-link__label"><?php the_title(); ?></span>
					<?php jce_icon( 'arrow-right', 'chip-link__arrow' ); ?>
				</a>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>
</section>
