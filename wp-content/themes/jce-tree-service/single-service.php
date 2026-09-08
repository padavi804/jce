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

	$service_slug = get_post_field( 'post_name' );

	jce_band( 'dark' ); // The hero is a dark band — start the alternation on white.

	// Resolved up front so each section can claim an alternating ground only
	// if it is actually going to render — see jce_band_if().
	$steps_rows = jce_field_rows( '_jce_service_steps', 2 );
	$proof_rows = jce_field_rows( '_jce_service_proof', 5 );
	$sub_rows   = jce_field_rows( '_jce_service_subservices', 2 );
	$sub_notes  = jce_field_rows( '_jce_service_notes', 2 );
	$sub_intro  = jce_field( '_jce_service_note_intro' );

	$signs_rows    = jce_field_rows(
		'_jce_service_signs',
		2,
		null,
		array(
			array( __( 'Deadwood you can see from the ground', 'jce' ), __( 'Bare branches still bare in July are not late to leaf out. That wood is gone and it will come down on its own schedule if it does not come down on ours.', 'jce' ) ),
			array( __( 'A lean that is new', 'jce' ), __( 'Trees grow at an angle all the time and most of them are fine. A lean that changed after a storm, with soil heaving on the opposite side, is a different conversation.', 'jce' ) ),
			array( __( 'Mushrooms at the base', 'jce' ), __( 'Fungal brackets on the trunk or root flare usually mean decay is already well established inside the part of the tree holding it up.', 'jce' ) ),
			array( __( 'Cracks, cavities, or a split fork', 'jce' ), __( 'Two trunks growing tight against each other with bark trapped in the join is one of the most common failure points we get called out to after a storm.', 'jce' ) ),
			array( __( 'It is over something that matters', 'jce' ), __( 'The same tree is a low priority in the back forty and an urgent one twelve feet from a bedroom. Target matters as much as condition.', 'jce' ) ),
		)
	);

	$included_rows = jce_field_lines(
		'_jce_service_included',
		null,
		array(
			__( 'An on-site assessment by an ISA-certified arborist before any number is written', 'jce' ),
			__( 'A hand-written estimate given to you on the spot, not emailed three days later', 'jce' ),
			__( 'All equipment, rigging, and traffic control the job needs', 'jce' ),
			__( 'Full brush and debris removal — chipped and hauled out the same day', 'jce' ),
			__( 'Wood cut to length and stacked where you want it, if you are keeping it', 'jce' ),
			__( 'The lawn raked and blown clean before we leave', 'jce' ),
			__( 'Proof of liability and workers compensation insurance, before we start', 'jce' ),
		)
	);

	$pricing_rows = jce_field_rows(
		'_jce_service_pricing',
		2,
		null,
		array(
			array( __( 'Size and species', 'jce' ), __( 'A sixty-foot silver maple and a sixty-foot oak are not the same job. Wood density changes the rigging and the time.', 'jce' ) ),
			array( __( 'What is underneath it', 'jce' ), __( 'Open lawn is the cheap version. A tree over a roof, a fence, a pool, or a power line has to come out in pieces, and that is where the hours go.', 'jce' ) ),
			array( __( 'Access', 'jce' ), __( 'If the crane or the chipper can get within reach, the job is faster. A backyard behind a narrow gate is carried out by hand.', 'jce' ) ),
			array( __( 'Condition', 'jce' ), __( 'A dead or decayed tree cannot be climbed safely, so it takes equipment a healthy tree would not need.', 'jce' ) ),
			array( __( 'Cleanup you want', 'jce' ), __( 'Standard cleanup is included. Keeping the wood, grinding the stump, or hauling the chips away instead of leaving them all move the number.', 'jce' ) ),
		)
	);

	$faq_rows = jce_field_rows(
		'_jce_service_faq',
		2,
		null,
		array(
			array( __( 'How long does the job take?', 'jce' ), __( 'Most residential jobs are a single day, and a straightforward one is often a morning. Anything involving a crane over a structure runs longer because the rigging is the slow part, and we will tell you which one yours is when we quote it.', 'jce' ) ),
			array( __( 'Will your equipment damage my lawn?', 'jce' ), __( 'That is the question we get most, and it is the reason our equipment looks the way it does. Tracked machines spread weight instead of concentrating it, and we mat the ground when conditions call for it. Frozen or dry ground is ideal; we will tell you if waiting two weeks is worth it.', 'jce' ) ),
			array( __( 'Do I need to be home?', 'jce' ), __( 'Not for the work itself, as long as we have discussed access and where things go. We do want you there for the estimate — that conversation is most of the value.', 'jce' ) ),
			array( __( 'Do you need a permit?', 'jce' ), __( 'For a tree on private property, generally no. Boulevard and right-of-way trees belong to the municipality and we handle that permitting for you.', 'jce' ) ),
			array( __( 'What if I only want part of the work done?', 'jce' ), __( 'Then that is what we quote. Every item on the estimate is priced separately so you can take the urgent part now and leave the rest for next season.', 'jce' ) ),
		)
	);

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
			'sub'     => get_the_excerpt(),
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
	 * How the job goes
	 * ------------------------------------------------------------ */
	get_template_part(
		'template-parts/personal-estimate-steps',
		null,
		array(
			'rows'    => $steps_rows,
			'heading' => jce_field( '_jce_service_steps_heading', null, __( 'The Personal Estimate', 'jce' ) ),
			// The steps section always renders — it falls back to the brief's
			// standard three when the field is empty.
			'class'   => jce_band(),
		)
	);

	/* --------------------------------------------------------------
	 * Proof — claim, quote, photograph. No fallback copy: a fabricated
	 * customer quote is not an acceptable placeholder.
	 * ------------------------------------------------------------ */
	get_template_part(
		'template-parts/proof-blocks',
		null,
		array(
			'rows'    => $proof_rows,
			'eyebrow' => __( 'Proof', 'jce' ),
			'heading' => __( 'What That Looks Like on a Real Property', 'jce' ),
			'class'   => jce_band_if( $proof_rows ),
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
	 * Signs you need this
	 * ------------------------------------------------------------ */
	get_template_part(
		'template-parts/feature-list',
		null,
		array(
			'rows'    => $signs_rows,
			'eyebrow' => __( 'Worth a Look', 'jce' ),
			'heading' => __( 'Signs It Is Time to Call', 'jce' ),
			'lede'    => __( 'None of these mean the tree has to come down. All of them mean it is worth having someone qualified put eyes on it.', 'jce' ),
			'icon'    => 'alert',
			'class'   => jce_band_if( $signs_rows ),
		)
	);

	/* --------------------------------------------------------------
	 * What's included + what moves the price
	 * ------------------------------------------------------------ */
	get_template_part(
		'template-parts/service-scope',
		null,
		array(
			'class'    => jce_band_if( $included_rows || $pricing_rows ),
			'included' => $included_rows,
			'pricing'  => $pricing_rows,
		)
	);

	get_template_part( 'template-parts/credentials' );
	jce_band( 'dark' );

	/* --------------------------------------------------------------
	 * FAQ
	 * ------------------------------------------------------------ */
	get_template_part(
		'template-parts/faq',
		null,
		array(
			'rows'    => $faq_rows,
			'heading' => sprintf(
				/* translators: %s: service name */
				__( '%s: The Questions We Get', 'jce' ),
				get_the_title()
			),
			'class'   => jce_band_if( $faq_rows ),
		)
	);

	get_template_part( 'template-parts/service-area', null, array( 'class' => jce_band() ) );
	get_template_part( 'template-parts/reviews', null, array( 'related' => $service_slug, 'class' => jce_band() ) );
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
