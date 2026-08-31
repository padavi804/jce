<?php
/**
 * Single Service page.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	get_template_part(
		'template-parts/page-hero',
		null,
		array(
			// A Featured Image on the Service wins; otherwise the shared services
			// photo stands in (the per-service card images are card-sized and
			// would upscale badly across a full-width hero).
			'context' => 'services',
			'eyebrow' => __( 'Tree Care Services', 'jce' ),
			'title'   => get_the_title(),
			'sub'     => get_the_excerpt(),
		)
	);
	?>

	<article class="section">
		<div class="wrap wrap--narrow entry-content">
			<?php the_content(); ?>
		</div>
	</article>

	<?php
	get_template_part( 'template-parts/personal-estimate-steps' );
	get_template_part( 'template-parts/credentials' );
	get_template_part( 'template-parts/service-area' );
	get_template_part( 'template-parts/reviews' );
	get_template_part( 'template-parts/cta-band' );

endwhile;

get_footer();
