<?php
/**
 * Single Location page (River Falls, Hudson, Prescott, + secondary towns).
 *
 * Guardrail from the creative brief: River Falls is defending organic rank it
 * already earned. Do not change that page's slug without a 301 redirect plan.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	// Featured Image wins; otherwise fall back to the bundled town photo, which
	// is already produced at hero size (1600x900).
	$location_hero = '';
	if ( has_post_thumbnail() ) {
		$location_hero = get_the_post_thumbnail_url( get_the_ID(), 'jce-hero' );
	} else {
		$location_map  = jce_default_location_images();
		$location_slug = get_post_field( 'post_name' );
		if ( isset( $location_map[ $location_slug ] ) && jce_img_exists( $location_map[ $location_slug ][0] ) ) {
			$location_hero = jce_img_uri( $location_map[ $location_slug ][0] );
		}
	}

	get_template_part(
		'template-parts/page-hero',
		null,
		array(
			'eyebrow' => __( 'Service Area', 'jce' ),
			'title'   => get_the_title(),
			'sub'     => get_the_excerpt(),
			'image'   => $location_hero,
		)
	);
	?>

	<article class="section">
		<div class="wrap wrap--narrow entry-content">
			<?php the_content(); ?>
		</div>
	</article>

	<?php
	get_template_part( 'template-parts/services-grid', null, array( 'heading' => __( 'What We Do Here', 'jce' ) ) );
	get_template_part( 'template-parts/credentials' );
	get_template_part( 'template-parts/reviews' );
	get_template_part( 'template-parts/cta-band' );

endwhile;

get_footer();
