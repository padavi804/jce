<?php
/**
 * Template Name: Service Area
 *
 * Assign to the page at /service-area/ — the hub every town page links up to.
 *
 * The Location post type has has_archive => false precisely so this page can
 * own that URL: an archive would be a bare list, and this needs to be a real
 * page with editable copy, a coverage promise, and its own FAQ.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	jce_band( 'dark' ); // The hero is a dark band — start the alternation on white.

	get_template_part(
		'template-parts/page-hero',
		null,
		array(
			'context' => 'about',
			'eyebrow' => __( 'Service Area', 'jce' ),
			'title'   => get_the_title() ? get_the_title() : __( 'Where JCE Works', 'jce' ),
			'sub'     => get_the_excerpt() ? get_the_excerpt() : __( 'River Falls, Hudson, Prescott, and the towns between them in the St. Croix River Valley.', 'jce' ),
			'image'   => has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'jce-hero' ) : '',
		)
	);
	?>

	<section class="section <?php echo esc_attr( jce_band() ); ?>">
		<div class="wrap wrap--narrow entry-content">
			<?php if ( trim( get_the_content() ) ) : ?>
				<?php the_content(); ?>
			<?php else : ?>
				<h2 class="mt-0"><?php esc_html_e( 'We work where we live.', 'jce' ); ?></h2>
				<p><?php esc_html_e( 'JCE has been based in River Falls since 2001, and the shape of our service area has more to do with driving time than with drawing a circle on a map. If we can get a crew, a chipper, and a crane to your property and back in a day without the drive eating the job, you are in it.', 'jce' ); ?></p>
				<p><?php esc_html_e( 'In practice that means Pierce and St. Croix counties on the Wisconsin side and the river towns just across it. We know which neighborhoods went in during the ash boom of the seventies, which bluff lots need a crane rather than a bucket, and which streets we cannot get a chip truck down. That is not local color — it is the difference between an accurate estimate and a surprise on the day.', 'jce' ); ?></p>
				<p><?php esc_html_e( 'Pick your town below for what we see on trees there and the reviews from that street. Do not see it listed? Call anyway. If you are close and we can get there, we will tell you; if you are not, we will point you to someone who can.', 'jce' ); ?></p>
			<?php endif; ?>
		</div>
	</section>

	<?php
	get_template_part(
		'template-parts/locations-grid',
		null,
		array(
			'heading' => __( 'Towns We Serve', 'jce' ),
			'eyebrow' => __( 'Pick Your Town', 'jce' ),
			'lede'    => __( 'Each town has its own page — the tree problems we actually see there, and reviews from people on those streets.', 'jce' ),
			'class'   => jce_band(),
		)
	);

	// Coverage promises — the "Highlight Cards" field on this page.
	get_template_part(
		'template-parts/highlight-cards',
		null,
		array(
			'rows'    => jce_field_rows(
				'_jce_page_highlights',
				2,
				null,
				array(
					array( __( 'The same crew, whichever town', 'jce' ), __( 'We do not sub out work to whoever is closest. The truck that pulls up in Prescott is the same one that pulls up in River Falls, with the same arborist on it.', 'jce' ) ),
					array( __( 'A real estimate, not a phone number', 'jce' ), __( 'Someone drives out and walks the property, wherever it is. We have never quoted a tree we have not stood under, and we are not going to start.', 'jce' ) ),
					array( __( 'Storm response across the whole area', 'jce' ), __( 'When a line of weather comes through, we triage by what the tree is touching, not by how far away you are. A limb through a roof in Ellsworth outranks a routine removal next door.', 'jce' ) ),
					array( __( 'We know the local tree problems', 'jce' ), __( 'Emerald ash borer, oak wilt, and the storm corridor along the river behave differently in each of these towns. Twenty-five years here is why we can tell you which one you have.', 'jce' ) ),
				)
			),
			'icons'   => array( 'truck', 'clipboard', 'zap', 'leaf' ),
			'eyebrow' => __( 'What Coverage Means', 'jce' ),
			'heading' => __( 'What "We Serve Your Town" Actually Commits Us To', 'jce' ),
			'class'   => jce_band(),
		)
	);

	get_template_part( 'template-parts/credentials' );
	jce_band( 'dark' );
	get_template_part( 'template-parts/personal-estimate-steps', null, array( 'class' => jce_band() ) );

	get_template_part(
		'template-parts/faq',
		null,
		array(
			'rows'    => jce_field_rows(
				'_jce_page_faq',
				2,
				null,
				array(
					array( __( 'Do you charge more for towns further out?', 'jce' ), __( 'No travel surcharge inside the area shown above. Beyond it, we will tell you honestly on the phone whether the drive makes us the wrong company for the job.', 'jce' ) ),
					array( __( 'My town is not on the list. Will you still come?', 'jce' ), __( 'Often yes, especially for larger jobs where the drive is a small share of the day. Call and describe the property and we will give you a straight answer rather than a maybe.', 'jce' ) ),
					array( __( 'How fast can you get here after a storm?', 'jce' ), __( 'Trees on structures and blocked driveways get triaged first, usually the same day across the whole area. Everything else is scheduled behind those, and we will tell you where in the line you are.', 'jce' ) ),
					array( __( 'Do you work on the Minnesota side?', 'jce' ), __( 'Yes — Hastings, Afton, Lakeland, and the Lake St. Croix Beach area are all regular stops for us.', 'jce' ) ),
				)
			),
			'heading' => __( 'Questions About Coverage', 'jce' ),
			'class'   => jce_band(),
		)
	);

	get_template_part( 'template-parts/reviews', null, array( 'class' => jce_band() ) );
	get_template_part( 'template-parts/cta-band' );

endwhile;

get_footer();
