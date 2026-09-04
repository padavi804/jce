<?php
/**
 * Single Service page.
 *
 * Every section below the editor content is driven by a field in the "Service
 * Page Sections" box, so the whole page is editable in WordPress. Any field
 * left empty falls back to the example copy defined here, which is why a
 * newly created Service still reads as a finished page.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	$service_slug = get_post_field( 'post_name' );

	jce_band( 'dark' ); // The hero is a dark band — start the alternation on white.

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

	<article class="section <?php echo esc_attr( jce_band() ); ?>">
		<div class="wrap wrap--narrow entry-content">
			<?php if ( trim( get_the_content() ) ) : ?>
				<?php the_content(); ?>
			<?php else : ?>
				<?php // Stand-in body copy — replace it in the WordPress editor. ?>
				<h2 class="mt-0"><?php
					printf(
						/* translators: %s: service name */
						esc_html__( 'What %s actually involves', 'jce' ),
						esc_html( strtolower( get_the_title() ) )
					);
				?></h2>
				<p><?php esc_html_e( 'This is placeholder copy so you can see how the page reads with real text in it. Replace it in the WordPress editor — everything else on this page is a field in the "Service Page Sections" box further down the same screen.', 'jce' ); ?></p>
				<p><?php esc_html_e( 'Two or three paragraphs works well here. Say what the job looks like from the homeowner\'s side: what we assess before quoting, what the crew brings, roughly how long a typical property takes, and what the yard looks like when we pull out of the driveway. Specifics land better than adjectives — "we chip on site and rake the beds" tells someone more than "meticulous cleanup" ever will.', 'jce' ); ?></p>
				<p><?php esc_html_e( 'If there is a season or a condition that changes the answer, say so here. That is the kind of detail that convinces a homeowner they are reading a company that has done this on their street rather than a page assembled from stock copy.', 'jce' ); ?></p>
			<?php endif; ?>
		</div>
	</article>

	<?php
	/* --------------------------------------------------------------
	 * Signs you need this
	 * ------------------------------------------------------------ */
	$signs = jce_field_rows(
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

	get_template_part(
		'template-parts/feature-list',
		null,
		array(
			'rows'    => $signs,
			'eyebrow' => __( 'Worth a Look', 'jce' ),
			'heading' => __( 'Signs It Is Time to Call', 'jce' ),
			'lede'    => __( 'None of these mean the tree has to come down. All of them mean it is worth having someone qualified put eyes on it.', 'jce' ),
			'icon'    => 'alert',
			'class'   => jce_band(),
		)
	);

	/* --------------------------------------------------------------
	 * What's included + what moves the price
	 * ------------------------------------------------------------ */
	get_template_part(
		'template-parts/service-scope',
		null,
		array(
			'class'    => jce_band(),
			'included' => jce_field_lines(
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
			),
			'pricing'  => jce_field_rows(
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
			),
		)
	);

	get_template_part( 'template-parts/credentials' );
	jce_band( 'dark' );
	get_template_part( 'template-parts/personal-estimate-steps', null, array( 'class' => jce_band() ) );

	/* --------------------------------------------------------------
	 * FAQ
	 * ------------------------------------------------------------ */
	get_template_part(
		'template-parts/faq',
		null,
		array(
			'rows'    => jce_field_rows(
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
			),
			'heading' => sprintf(
				/* translators: %s: service name */
				__( '%s: The Questions We Get', 'jce' ),
				get_the_title()
			),
			'class'   => jce_band(),
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
