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
<section class="section section--tight proof-statement">
	<div class="wrap wrap--narrow">
		<span class="proof-statement__mark" aria-hidden="true"><?php jce_icon( 'tree' ); ?></span>
		<p class="lede">
			<?php
			printf(
				/* translators: 1: opening markup, 2: closing markup around the approved payoff line — wording is unchanged, only the highlight is added */
				esc_html__( "Anyone with a chainsaw can call themselves a tree service. Not everyone shows up with certified arborists, a fleet of equipment chosen to protect your lawn, and a professional, experienced crew that cleans up like they're leaving their own yard. %1\$sThat's the difference with JCE.%2\$s For 25 years, we've earned the trust of local homeowners by doing the job right, from start to finish.", 'jce' ),
				'<strong class="proof-statement__punch">',
				'</strong>'
			);
			?>
		</p>
	</div>
</section>
<?php
// The charcoal stats band was removed as redundant.
// template-parts/stats.php and its styles are retained — re-add the
// get_template_part() call here to bring it back.
get_template_part( 'template-parts/services-grid' );
// Three-step version of the Personal Estimate, same as the Service Area
// pages. Keeps the estimate-button CTA rather than the phone-only version.
get_template_part(
	'template-parts/personal-estimate-steps-3step',
	null,
	array( 'cta' => true )
);
get_template_part( 'template-parts/credentials' );
get_template_part( 'template-parts/service-area' );
get_template_part( 'template-parts/cta-band' );
get_template_part( 'template-parts/reviews' );

get_footer();
