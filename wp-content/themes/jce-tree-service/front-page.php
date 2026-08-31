<?php
/**
 * Homepage.
 *
 * Section order follows the approved homepage content in the creative brief:
 * hero → trust proof → services → the personal estimate → credentials →
 * service area → reviews → closing CTA.
 *
 * Set this page under Settings > Reading > "A static page" so its editor
 * content flows into the About split below.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

if ( have_posts() ) {
	the_post();
}

get_template_part( 'template-parts/hero' );
get_template_part( 'template-parts/trust-band' );
get_template_part( 'template-parts/proof-cards' );
get_template_part( 'template-parts/about-split' );
// The charcoal stats band was removed as redundant.
// template-parts/stats.php and its styles are retained — re-add the
// get_template_part() call here to bring it back.
get_template_part( 'template-parts/services-grid' );
get_template_part( 'template-parts/personal-estimate-steps' );
get_template_part( 'template-parts/credentials' );
get_template_part( 'template-parts/service-area' );
get_template_part( 'template-parts/reviews' );
get_template_part( 'template-parts/cta-band' );

get_footer();
