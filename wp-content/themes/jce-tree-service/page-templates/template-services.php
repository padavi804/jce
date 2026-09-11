<?php
/**
 * Template Name: Services
 *
 * Assign to the page at /services/ — the hub every Service post links up to.
 *
 * The Service post type has has_archive => false precisely so this page can
 * own that URL: an archive would be a bare list with nowhere to hold its own
 * title, subheading, intro copy, "how we decide" cards, or FAQ, and this page
 * needs all of those to be real, editable content rather than a second,
 * hidden Page bolted onto the archive.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	jce_band( 'dark' ); // The hero and its trust band are dark — start the alternation on white.

	get_template_part(
		'template-parts/page-hero',
		null,
		array(
			'context' => 'services',
			'eyebrow' => __( 'Tree Removal Near Me', 'jce' ),
			'title'   => jce_field( '_jce_page_headline', null, get_the_title() ? get_the_title() : __( 'Tree Removal by Local Tree Experts in the St. Croix River Valley', 'jce' ) ),
			'sub'     => jce_field( '_jce_page_subheading' ),
			'buttons' => true,
			'area'    => jce_area_sentence(),
			'image'   => has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'jce-hero' ) : '',
		)
	);

	// Intro prose, only when the editor content actually has some.
	if ( trim( get_the_content() ) ) :
		?>
		<section class="section section--tight <?php echo esc_attr( jce_band() ); ?>">
			<div class="wrap wrap--narrow entry-content entry-content--service">
				<?php the_content(); ?>
			</div>
		</section>
		<?php
	endif;

	get_template_part(
		'template-parts/services-grid',
		null,
		array(
			'heading' => __( 'Every Service We Offer', 'jce' ),
			'eyebrow' => __( 'The Full List', 'jce' ),
			'class'   => jce_band(),
		)
	);

	// "How we decide" — the Highlight Cards field on this page.
	$highlights = jce_field_rows( '_jce_page_highlights', 2 );
	get_template_part(
		'template-parts/highlight-cards',
		null,
		array(
			'rows'    => $highlights,
			'icons'   => array( 'leaf', 'shield', 'calendar', 'truck' ),
			'eyebrow' => __( 'How We Decide', 'jce' ),
			'heading' => __( 'What an Arborist Weighs Before Quoting', 'jce' ),
			'class'   => jce_band_if( $highlights ),
		)
	);

	get_template_part( 'template-parts/credentials' );
	jce_band( 'dark' );
	get_template_part( 'template-parts/personal-estimate-steps', null, array( 'class' => jce_band() ) );

	$faq = jce_field_rows( '_jce_page_faq', 2 );
	get_template_part(
		'template-parts/faq',
		null,
		array(
			'rows'    => $faq,
			'heading' => __( 'Before You Call', 'jce' ),
			'class'   => jce_band_if( $faq ),
		)
	);

	// get_template_part( 'template-parts/service-area', null, array( 'class' => jce_band() ) );
	get_template_part( 'template-parts/reviews', null, array( 'class' => jce_band() ) );
	get_template_part( 'template-parts/cta-band' );

endwhile;

get_footer();
