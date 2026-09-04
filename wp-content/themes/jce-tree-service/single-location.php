<?php
/**
 * Single Location page (River Falls, Hudson, Prescott, + secondary towns).
 *
 * Guardrail from the creative brief: River Falls is defending organic rank it
 * already earned. Do not change that page's slug without a 301 redirect plan.
 *
 * The local specifics — what fails on trees in this town, which neighborhoods,
 * how far it is from the yard — are fields in the "Service Area Page Sections"
 * box, so each town page can be made genuinely different from the others
 * without touching PHP. Thin, near-identical town pages are the classic way
 * local SEO pages get discounted; these fields exist to prevent that.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	$town      = get_the_title();
	$town_slug = get_post_field( 'post_name' );

	// Featured Image wins; otherwise fall back to the bundled town photo, which
	// is already produced at hero size (1600x900).
	$location_hero = '';
	if ( has_post_thumbnail() ) {
		$location_hero = get_the_post_thumbnail_url( get_the_ID(), 'jce-hero' );
	} else {
		$location_map = jce_default_location_images();
		if ( isset( $location_map[ $town_slug ] ) && jce_img_exists( $location_map[ $town_slug ][0] ) ) {
			$location_hero = jce_img_uri( $location_map[ $town_slug ][0] );
		}
	}

	get_template_part(
		'template-parts/page-hero',
		null,
		array(
			'eyebrow' => __( 'Service Area', 'jce' ),
			'title'   => sprintf(
				/* translators: %s: town name */
				__( 'Tree Service in %s', 'jce' ),
				$town
			),
			'sub'     => get_the_excerpt(),
			'image'   => $location_hero,
		)
	);

	jce_band( 'dark' ); // The hero is a dark band — start the alternation on white.

	// Fact strip — only rendered when there is something to put in it.
	$distance = jce_field( '_jce_location_distance' );
	$zips     = jce_field( '_jce_location_zip' );
	?>

	<?php if ( $distance || $zips ) : ?>
		<div class="fact-strip">
			<div class="wrap fact-strip__inner">
				<?php if ( $distance ) : ?>
					<span class="fact"><?php jce_icon( 'truck' ); ?><?php echo esc_html( $distance ); ?></span>
				<?php endif; ?>
				<?php if ( $zips ) : ?>
					<span class="fact"><?php jce_icon( 'map-pin' ); ?><?php
						printf(
							/* translators: %s: comma-separated ZIP codes */
							esc_html__( 'ZIP codes served: %s', 'jce' ),
							esc_html( $zips )
						);
					?></span>
				<?php endif; ?>
				<span class="fact"><?php jce_icon( 'clock' ); ?><?php echo esc_html( jce_biz( 'emergency_note', '24/7 storm response' ) ); ?></span>
			</div>
		</div>
	<?php endif; ?>

	<article class="section <?php echo esc_attr( jce_band() ); ?>">
		<div class="wrap wrap--narrow entry-content">
			<?php if ( trim( get_the_content() ) ) : ?>
				<?php the_content(); ?>
			<?php else : ?>
				<?php // Stand-in body copy — replace it in the WordPress editor. ?>
				<h2 class="mt-0"><?php
					printf(
						/* translators: %s: town name */
						esc_html__( 'Working on trees in %s', 'jce' ),
						esc_html( $town )
					);
				?></h2>
				<p><?php
					printf(
						/* translators: %s: town name */
						esc_html__( 'This is placeholder copy so you can see the page with text in it. Replace it in the WordPress editor, and fill in the "Service Area Page Sections" box below the editor to change the local details, the neighborhoods, and the questions further down this page. Every one of those sections has example content in it right now for the same reason — so %s reads as a finished page while the real copy is being written.', 'jce' ),
						esc_html( $town )
					);
				?></p>
				<p><?php esc_html_e( 'What belongs here is the stuff only a company that actually works in this town could write. Which decade the neighborhoods went in and what got planted then. Which streets are boulevard trees the city owns. Where the soil is thin over rock and the roots stay shallow. How far a crane has to reach on the lots down by the river.', 'jce' ); ?></p>
				<p><?php esc_html_e( 'Two or three paragraphs of that does more for both a reader and a search engine than any amount of "proudly serving" language. It is also the part a competitor cannot copy without doing the work.', 'jce' ); ?></p>
			<?php endif; ?>
		</div>
	</article>

	<?php
	/* --------------------------------------------------------------
	 * What we see on trees here — the anti-thin-page section
	 * ------------------------------------------------------------ */
	get_template_part(
		'template-parts/feature-list',
		null,
		array(
			'rows'    => jce_field_rows(
				'_jce_location_conditions',
				2,
				null,
				array(
					array( __( 'Ash, and a lot of it', 'jce' ), __( 'Emerald ash borer has worked through this area and the trees planted along these streets in the seventies are the ones paying for it. Some can still be treated. Most of what we take down now is ash.', 'jce' ) ),
					array( __( 'Oak wilt in the wrong season', 'jce' ), __( 'Oaks pruned between April and July are the ones that catch it. We schedule oak work in the dormant season for exactly this reason, and we will push back if you ask us to do it in June.', 'jce' ) ),
					array( __( 'Storm corridors along the river', 'jce' ), __( 'The straight-line winds that come up the valley hit the same properties every few years. If you are on an exposed edge, the pruning conversation is really a wind-load conversation.', 'jce' ) ),
					array( __( 'Silver maples reaching the end', 'jce' ), __( 'Fast growers planted for quick shade forty years ago are now large, brittle, and directly over the garage. They shed limbs long before they fail outright.', 'jce' ) ),
					array( __( 'Tight lots and narrow access', 'jce' ), __( 'Older blocks here were not laid out for a chip truck. We know which alleys work, and when the answer is to carry it out by hand instead of tearing up a lawn.', 'jce' ) ),
				)
			),
			'eyebrow' => __( 'Local Conditions', 'jce' ),
			'heading' => sprintf(
				/* translators: %s: town name */
				__( 'What We See on Trees in %s', 'jce' ),
				$town
			),
			'lede'    => __( 'Twenty-five years on these streets means the assessment starts before we get out of the truck.', 'jce' ),
			'icon'    => 'leaf',
			'class'   => jce_band(),
		)
	);

	/* --------------------------------------------------------------
	 * Neighborhoods
	 * ------------------------------------------------------------ */
	$neighborhoods = jce_field_lines( '_jce_location_neighborhoods' );
	if ( $neighborhoods ) :
		?>
		<section class="section section--tight <?php echo esc_attr( jce_band() ); ?>">
			<div class="wrap">
				<div class="section-head">
					<p class="eyebrow"><?php esc_html_e( 'On These Streets', 'jce' ); ?></p>
					<h2 style="font-size:var(--step-3);"><?php
						printf(
							/* translators: %s: town name */
							esc_html__( 'Neighborhoods We Work in Around %s', 'jce' ),
							esc_html( $town )
						);
					?></h2>
				</div>
				<ul class="tag-list">
					<?php foreach ( $neighborhoods as $hood ) : ?>
						<li class="tag"><?php jce_icon( 'map-pin' ); ?><?php echo esc_html( $hood ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</section>
		<?php
	endif;

	get_template_part(
		'template-parts/services-grid',
		null,
		array(
			'heading' => sprintf(
				/* translators: %s: town name */
				__( 'What We Do in %s', 'jce' ),
				$town
			),
			'eyebrow' => __( 'Services Here', 'jce' ),
			'lede'    => __( 'The full list, with the same crew and the same equipment that works every other town on our map.', 'jce' ),
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
				'_jce_location_faq',
				2,
				null,
				array(
					array(
						sprintf(
							/* translators: %s: town name */
							__( 'Do you actually work in %s regularly?', 'jce' ),
							$town
						),
						sprintf(
							/* translators: %s: town name */
							__( 'Yes — it is a regular stop, not an outer edge we will drive to once. Ask the neighbors: a good share of our work here came from someone watching us take a tree out three doors down.', 'jce' ),
							$town
						),
					),
					array( __( 'Who owns the tree between the sidewalk and the street?', 'jce' ), __( 'Usually the municipality, not you — which means you cannot have it removed and you should not be paying to. We will tell you which side of that line your tree is on before quoting anything.', 'jce' ) ),
					array( __( 'How soon can someone come look?', 'jce' ), __( 'Estimates here are typically within the week. Storm damage and anything on a structure is same-day.', 'jce' ) ),
					array( __( 'Can you get equipment into a small backyard?', 'jce' ), __( 'Usually. Our smaller tracked machines fit through a standard gate, and a spider lift reaches over the house where a bucket truck cannot. Where nothing fits, we climb and rig it out by hand.', 'jce' ) ),
				)
			),
			'heading' => sprintf(
				/* translators: %s: town name */
				__( 'Questions From %s Homeowners', 'jce' ),
				$town
			),
			'class'   => jce_band(),
		)
	);

	get_template_part(
		'template-parts/reviews',
		null,
		array(
			'related' => $town_slug,
			'heading' => sprintf(
				/* translators: %s: town name */
				__( 'What %s Homeowners Say', 'jce' ),
				$town
			),
			'class'   => jce_band(),
		)
	);

	get_template_part(
		'template-parts/service-area',
		null,
		array(
			'exclude' => get_the_ID(),
			'eyebrow' => __( 'Nearby', 'jce' ),
			'heading' => __( 'Other Towns We Cover', 'jce' ),
			'class'   => jce_band(),
		)
	);

	get_template_part(
		'template-parts/cta-band',
		null,
		array(
			'title' => sprintf(
				/* translators: %s: town name */
				__( 'Got a tree in %s worth a second opinion?', 'jce' ),
				$town
			),
		)
	);

endwhile;

get_footer();
