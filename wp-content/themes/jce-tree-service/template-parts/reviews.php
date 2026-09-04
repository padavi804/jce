<?php
/**
 * Reviews surfaced with specifics — the actual street, job, and outcome —
 * rather than star ratings alone. That specificity is the whole point per the
 * brief's claims-convergence guardrail: a competitor can't say it on command.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'related' => '',
		'heading' => __( 'What Homeowners Say', 'jce' ),
		'eyebrow' => __( 'From Your Neighbors', 'jce' ),
		'class'   => 'section--cream',
	)
);

$query_args = array(
	'post_type'      => 'testimonial',
	'posts_per_page' => 3,
	'no_found_rows'  => true,
);

// A service or town page shows reviews tagged to it first. Tagged reviews are
// the point of the section — a generic five-star quote proves nothing that the
// star rating in the header hasn't already said.
if ( $args['related'] ) {
	$tagged = new WP_Query(
		array_merge(
			$query_args,
			array(
				'meta_query' => array( // phpcs:ignore WordPress.DB.SlowDBQuery
					array( 'key' => '_jce_review_service', 'value' => $args['related'] ),
				),
			)
		)
	);
	if ( $tagged->have_posts() ) {
		$query_args['post__in'] = wp_list_pluck( $tagged->posts, 'ID' );
		$query_args['orderby']  = 'post__in';
	}
	wp_reset_postdata();
}

$reviews = new WP_Query( $query_args );

if ( ! $reviews->have_posts() ) {
	return;
}
?>
<section class="section <?php echo esc_attr( $args['class'] ); ?>" id="reviews">
	<div class="wrap">
		<div class="section-head section-head--center">
			<p class="eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
			<h2><?php echo esc_html( $args['heading'] ); ?></h2>
		</div>

		<div class="reviews-grid">
			<?php
			while ( $reviews->have_posts() ) :
				$reviews->the_post();
				$job      = get_post_meta( get_the_ID(), '_jce_job_type', true );
				$location = get_post_meta( get_the_ID(), '_jce_reviewer_location', true );
				$rating   = (int) get_post_meta( get_the_ID(), '_jce_rating', true );
				$source   = get_post_meta( get_the_ID(), '_jce_review_source', true );
				$rating   = $rating ? $rating : 5;
				?>
				<blockquote class="review">
					<div class="review__stars" role="img" aria-label="<?php echo esc_attr( sprintf( /* translators: %d: star rating */ __( '%d out of 5 stars', 'jce' ), $rating ) ); ?>">
						<?php for ( $s = 0; $s < $rating; $s++ ) : ?>
							<?php jce_icon( 'star', 'icon--filled' ); ?>
						<?php endfor; ?>
					</div>

					<div class="review__body"><?php the_content(); ?></div>

					<footer class="review__meta">
						<cite class="review__name" style="font-style:normal;"><?php the_title(); ?></cite>
						<span class="review__detail">
							<?php
							$detail = array_filter( array( $location, $source ) );
							echo esc_html( implode( ' · ', $detail ) );
							?>
						</span>
						<?php if ( $job ) : ?>
							<span class="review__job"><?php echo esc_html( $job ); ?></span>
						<?php endif; ?>
					</footer>
				</blockquote>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>

		<?php if ( jce_biz( 'google_review_url' ) ) : ?>
			<p class="text-center" style="margin-top:2.5rem;">
				<a class="btn btn--outline" href="<?php echo esc_url( jce_biz( 'google_review_url' ) ); ?>" target="_blank" rel="noopener">
					<?php esc_html_e( 'Read all reviews on Google', 'jce' ); ?><?php jce_icon( 'arrow-right' ); ?>
				</a>
			</p>
		<?php endif; ?>
	</div>
</section>
