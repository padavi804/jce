<?php
/**
 * Services landing page (/services/).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part(
	'template-parts/page-hero',
	null,
	array(
		'context' => 'services',
		'eyebrow' => __( 'Tree Care Services', 'jce' ),
		'title'   => __( 'Tree Services in River Falls, Hudson & Prescott', 'jce' ),
		'sub'     => __( 'Removal is about two-thirds of what we do. The rest is keeping the trees worth keeping healthy — and telling you honestly which is which.', 'jce' ),
	)
);

get_template_part( 'template-parts/services-grid', null, array( 'heading' => __( 'Every Service We Offer', 'jce' ) ) );
get_template_part( 'template-parts/personal-estimate-steps' );
get_template_part( 'template-parts/credentials' );
get_template_part( 'template-parts/reviews' );
get_template_part( 'template-parts/cta-band' );

get_footer();
