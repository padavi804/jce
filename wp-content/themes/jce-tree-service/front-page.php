<?php
/**
 * Homepage.
 *
 * Section order and copy follow the approved homepage content in the
 * creative brief exactly: hero → trust bar → proof paragraph → services →
 * the personal estimate → credentials → service area → reviews → closing
 * CTA. Do not add sections or reword approved copy here without going back
 * to Joe first.
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
?>
<section class="section section--tight">
	<div class="wrap wrap--narrow">
		<p class="lede text-center"><?php esc_html_e( "Anyone with a chainsaw can call themselves a tree service. Not everyone shows up with certified arborists, a fleet of equipment chosen to protect your lawn, and a professional, experienced crew that cleans up like they're leaving their own yard. That's the difference with JCE. For 25 years, we've earned the trust of local homeowners by doing the job right, from start to finish.", 'jce' ); ?></p>
	</div>
</section>
<?php
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
