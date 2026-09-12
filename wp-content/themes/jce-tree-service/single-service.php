<?php
/**
 * Single Service page.
 *
 * Every section is driven by a field in the "Service Page Sections" box, so
 * the whole page is editable in WordPress.
 *
 * Two different empty states, deliberately:
 *  - A field left blank falls back to example copy, so a newly created Service
 *    still reads as a finished page while its copy is being written.
 *  - A field containing a single dash renders nothing. That matters on a page
 *    carrying approved copy, where a fallback would publish invented text
 *    under the client's name.
 *
 * Sections the copy hasn't reached yet (proof blocks, sub-services) simply do
 * not render — they have no fallback, because inventing a customer quote is
 * not the same kind of placeholder as inventing a FAQ answer.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	jce_band( 'dark' ); // The hero is a dark band — start the alternation on white.

	// Resolved up front so each section can claim an alternating ground only
	// if it is actually going to render — see jce_band_if().
	$steps_rows = jce_field_rows( '_jce_service_steps', 2 );
	$proof_rows = jce_field_rows( '_jce_service_proof', 5 );
	$reel_rows  = jce_field_lines( '_jce_service_reel' );
	$reel_images = jce_field_ids( '_jce_service_reel_images' );
	$sub_rows   = jce_field_rows( '_jce_service_subservices', 2 );
	$sub_images = jce_field_ids( '_jce_service_subservices_images' );
	$sub_notes  = jce_field_rows( '_jce_service_notes', 2 );
	$sub_intro  = jce_field( '_jce_service_note_intro' );

	get_template_part(
		'template-parts/page-hero',
		null,
		array(
			// A Featured Image on the Service wins; otherwise the shared services
			// photo stands in (the per-service card images are card-sized and
			// would upscale badly across a full-width hero).
			'context' => 'services',
			'eyebrow' => jce_field( '_jce_service_eyebrow', null, __( 'Tree Care Services', 'jce' ) ),
			// The post title stays short — it is what appears on cards and in
			// menus — so the long keyword headline lives in its own field.
			'title'   => jce_field( '_jce_service_headline', null, get_the_title() ),
			// No standfirst here: the body copy that immediately follows the
			// hero already opens with its own — see the "Editor content"
			// block below. Printing the excerpt in both places is the usual
			// way that pattern breaks.
			'buttons' => true,
			'area'    => jce_area_sentence(),
		)
	);
	?>

	<?php
	/* --------------------------------------------------------------
	 * Editor content.
	 *
	 * The one section with no example-copy fallback. Every other section
	 * is visibly a component — a checklist, a card grid — and reads as
	 * scaffolding when it holds placeholder text. Body prose does not: it
	 * sits first under the hero at the largest body size, where invented
	 * copy is indistinguishable from approved copy at a glance. Some
	 * services (Tree Removal) carry their argument entirely in the proof
	 * and sub-service blocks and want no intro prose at all.
	 * ------------------------------------------------------------ */
	if ( trim( get_the_content() ) ) :
		?>
		<article class="section <?php echo esc_attr( jce_band() ); ?>">
			<div class="wrap wrap--narrow entry-content entry-content--service"><?php the_content(); ?></div>
		</article>
		<?php
	endif;
	?>

	<?php
	/* --------------------------------------------------------------
	 * Photo reel — real job photos, browsable, right after the body.
	 * ------------------------------------------------------------ */
	get_template_part(
		'template-parts/photo-reel',
		null,
		array(
			'rows'   => $reel_rows,
			'images' => $reel_images,
			'class'  => jce_band_if( $reel_rows ),
		)
	);

	/* --------------------------------------------------------------
	 * The kinds of this service
	 * ------------------------------------------------------------ */
	get_template_part(
		'template-parts/sub-services',
		null,
		array(
			'rows'       => $sub_rows,
			'images'     => $sub_images,
			'intro'      => jce_field_lines( '_jce_service_sub_intro' ),
			'heading'    => jce_field(
				'_jce_service_sub_heading',
				null,
				sprintf(
					/* translators: %s: service name */
					__( '%s Services', 'jce' ),
					get_the_title()
				)
			),
			'eyebrow'    => __( 'Every Situation', 'jce' ),
			'note_intro' => $sub_intro,
			'notes'      => $sub_notes,
			'class'      => jce_band_if( $sub_rows ),
		)
	);

	/* --------------------------------------------------------------
	 * How the job goes
	 * ------------------------------------------------------------ */
	// get_template_part(
	// 	'template-parts/personal-estimate-steps',
	// 	null,
	// 	array(
	// 		'rows'    => $steps_rows,
	// 		'heading' => jce_field( '_jce_service_steps_heading', null, __( 'The Personal Estimate', 'jce' ) ),
	// 		// The steps section always renders — it falls back to the brief's
	// 		// standard three when the field is empty.
	// 		'class'   => jce_band(),
	// 	)
	// );

	/* --------------------------------------------------------------
	 * Proof — claim, quote, photograph. No fallback copy: a fabricated
	 * customer quote is not an acceptable placeholder.
	 * ------------------------------------------------------------ */
	// get_template_part(
	// 	'template-parts/proof-blocks',
	// 	null,
	// 	array(
	// 		'rows'    => $proof_rows,
	// 		'eyebrow' => __( 'Proof', 'jce' ),
	// 		'heading' => __( 'What That Looks Like on a Real Property', 'jce' ),
	// 		'class'   => jce_band_if( $proof_rows ),
	// 	)
	// );

	// get_template_part( 'template-parts/credentials' );
	// jce_band( 'dark' );

	/* --------------------------------------------------------------
	 * FAQ
	 * ------------------------------------------------------------ */

	// get_template_part( 'template-parts/service-area', null, array( 'class' => jce_band() ) );
	get_template_part( 'template-parts/related-services', null, array( 'class' => jce_band() ) );

	get_template_part(
		'template-parts/cta-band',
		null,
		array(
			'title' => jce_field(
				'_jce_service_cta_title',
				null,
				sprintf(
					/* translators: %s: service name, lowercased */
					__( 'Need %s? Start with the estimate.', 'jce' ),
					strtolower( get_the_title() )
				)
			),
		)
	);

endwhile;

get_footer();
