<?php
/**
 * Service area, short version — the block embedded in the homepage, service
 * pages, and the About page.
 *
 * Primary towns get their own linked location page (the SEO deliverable);
 * secondary towns are named in text, and linked too once they exist as
 * Location posts. The brief is explicit that we name towns rather than saying
 * "our service area".
 *
 * The full inventory lives in template-parts/locations-grid.php, used by the
 * Service Area landing page.
 *
 * @param array $args {
 *     @type string $heading Section heading.
 *     @type string $eyebrow Section eyebrow.
 *     @type int    $exclude Location ID to leave out (the town being viewed).
 *     @type string $class   Extra section classes.
 * }
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'heading' => __( 'Serving River Falls, Hudson &amp; Prescott', 'jce' ),
		'eyebrow' => __( 'Where We Work', 'jce' ),
		'exclude' => 0,
		'class'   => 'section--cream',
	)
);

$primary = new WP_Query(
	array(
		'post_type'      => 'location',
		'posts_per_page' => 3,
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
		'no_found_rows'  => true,
		'post__not_in'   => array_filter( array( $args['exclude'] ) ),
		'meta_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery
			'relation' => 'OR',
			array( 'key' => '_jce_location_priority', 'value' => 'primary' ),
			array( 'key' => '_jce_location_priority', 'compare' => 'NOT EXISTS' ),
		),
	)
);

// Secondary towns link to their own page once one exists; otherwise they are
// named as plain text, which is still better than "and surrounding areas".
$secondary_posts = get_posts(
	array(
		'post_type'      => 'location',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
		'no_found_rows'  => true,
		'post__not_in'   => array_filter( array( $args['exclude'] ) ),
		'meta_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery
			array( 'key' => '_jce_location_priority', 'value' => 'secondary' ),
		),
	)
);

// Naming towns is the entire point of this section — with no Location posts
// there is nothing to name, so it does not render. It used to fall back to a
// hardcoded list of town blurbs, which was invented copy.
if ( ! $primary->have_posts() && ! $secondary_posts ) {
	return;
}
?>
<section class="section <?php echo esc_attr( $args['class'] ); ?>" id="service-area">
	<div class="wrap">
		<div class="section-head">
			<p class="eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
			<h2><?php echo esc_html( $args['heading'] ); ?></h2>
		</div>

		<?php if ( $primary->have_posts() ) : ?>
			<div class="area-primary">
				<?php
				while ( $primary->have_posts() ) :
					$primary->the_post();
					// A town with no Excerpt and no body copy would otherwise
					// leave an empty paragraph under its name. Approved town
					// copy is still pending, so absent has to render as absent.
					$card_summary = trim( wp_trim_words( get_the_excerpt(), 18 ) );
					?>
					<a class="area-card" href="<?php the_permalink(); ?>">
						<span class="area-card__media"><?php jce_card_image( 'location' ); ?></span>
						<span class="area-card__body">
							<h3><?php the_title(); ?></h3>
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

		<?php if ( $secondary_posts ) : ?>
			<p class="area-secondary">
				<strong><?php esc_html_e( 'Also serving:', 'jce' ); ?></strong>
				<?php
				$links = array();
				foreach ( $secondary_posts as $town ) {
					$links[] = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $town ) ), esc_html( get_the_title( $town ) ) );
				}
				echo wp_kses_post( implode( ' · ', $links ) );
				?>
			</p>
		<?php endif; ?>

	</div>
</section>
