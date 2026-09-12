<?php
/**
 * Single Location page (River Falls, Hudson, Prescott, + secondary towns).
 *
 * EVERY word below the hero is the creative brief's approved "SERVICE AREA
 * PAGES / RIVER FALLS" copy. The brief notes that each mention of the town is
 * a placeholder for whichever town the page is about, so the whole flow is
 * written against $town and reused for every Location post.
 *
 * Two deliberate exceptions to that substitution, both approved as written:
 *  - "JCE is located in River Falls, WI" in Locally Owned & Operated names the
 *    actual headquarters, not the page's town, so it stays fixed everywhere.
 *  - "across the St. Croix River Valley" is the region, not the town.
 *
 * Nothing here falls back to invented example text. Sections the brief has no
 * approved copy for — local tree conditions, neighborhoods, a per-town FAQ,
 * a distance/ZIP fact strip — are not rendered at all rather than filled with
 * plausible-sounding placeholder, because this page publishes under the
 * client's name. If approved copy arrives for any of them later, add the
 * section back with that copy.
 *
 * Guardrail from the creative brief: River Falls is defending organic rank it
 * already earned. Do not change that page's slug without a 301 redirect plan.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	$town      = get_the_title();
	$town_slug = get_post_field( 'post_name' );
	$years     = jce_biz( 'years_experience', '25' );
	$phone     = jce_biz( 'phone' );

	// Featured Image wins; otherwise fall back to the bundled town photo, which
	// is already produced at hero size (1600x900).
	$location_hero = '';
	$location_map  = jce_default_location_images();
	if ( has_post_thumbnail() ) {
		$location_hero = get_the_post_thumbnail_url( get_the_ID(), 'jce-hero' );
	} elseif ( isset( $location_map[ $town_slug ] ) && jce_img_exists( $location_map[ $town_slug ][0] ) ) {
		$location_hero = jce_img_uri( $location_map[ $town_slug ][0] );
	}

	// The hero renders the approved trust bar (4.9 rating, arborists, years,
	// HomeAdvisor) directly beneath itself — see template-parts/page-hero.php.
	get_template_part(
		'template-parts/page-hero',
		null,
		array(
			'eyebrow' => sprintf(
				/* translators: %s: town name */
				__( 'Local Tree Service Proudly Serving %s, WI', 'jce' ),
				$town
			),
			'title'   => __( 'The Highest Standard of Tree Care. No Exceptions.', 'jce' ),
			'sub'     => sprintf(
				/* translators: 1: town name, 2: years in business */
				__( 'Trusted in %1$s and throughout the St. Croix River Valley for %2$s years', 'jce' ),
				$town,
				$years
			),
			'image'   => $location_hero,
			'buttons' => true,
		)
	);

	jce_band( 'dark' ); // The hero and its trust band are dark — start the alternation on white.

	/* --------------------------------------------------------------
	 * Intro. A photo in the "Service Area Page Photos" box turns this into a
	 * photo split; without one it stays a narrow column of text.
	 * ------------------------------------------------------------ */
	$intro_image_id = (int) jce_field( '_jce_location_intro_image' );
	?>
	<article class="section section--tight <?php echo esc_attr( jce_band() ); ?>">
		<div class="wrap<?php echo $intro_image_id ? '' : ' wrap--narrow'; ?>">
			<div class="<?php echo $intro_image_id ? 'split split--photo' : ''; ?>">
				<?php if ( $intro_image_id ) : ?>
					<div class="split__media">
						<?php echo wp_get_attachment_image( $intro_image_id, 'large', false, array( 'loading' => 'lazy', 'decoding' => 'async' ) ); ?>
					</div>
				<?php endif; ?>
				<div class="<?php echo $intro_image_id ? 'split__content ' : ''; ?>entry-content">
					<?php if ( trim( get_the_content() ) ) : ?>
						<?php the_content(); ?>
					<?php else : ?>
						<p class="lede mt-0"><?php
							printf(
								/* translators: 1: town name, 2: years in business */
								esc_html__( "Anyone with a chainsaw can call themselves a tree service. Not everyone shows up with certified arborists, a fleet of equipment chosen to protect your lawn, and a professional, experienced crew that cleans up like they're leaving their own yard. That's the difference with JCE. For %2\$s years, we've earned the trust of homeowners in %1\$s by doing the job right, from start to finish.", 'jce' ),
								esc_html( $town ),
								esc_html( $years )
							);
						?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</article>

	<?php
	/* --------------------------------------------------------------
	 * The Highest Standard of Tree Care. No Exceptions.
	 *
	 * The brief follows this paragraph with a four-item bullet list that is
	 * the trust bar verbatim (4.9 rating, ISA arborists, 25 years locally
	 * owned, HomeAdvisor Elite). The hero already renders exactly those four
	 * a screen above, so they are not repeated here.
	 * ------------------------------------------------------------ */
	$standard_image_id = (int) jce_field( '_jce_location_standard_image' );
	?>
	<section class="section section--tight <?php echo esc_attr( jce_band() ); ?>">
		<div class="wrap<?php echo $standard_image_id ? '' : ' wrap--narrow'; ?>">
			<div class="<?php echo $standard_image_id ? 'split split--photo split--reverse' : ''; ?>">
				<?php if ( $standard_image_id ) : ?>
					<div class="split__media">
						<?php echo wp_get_attachment_image( $standard_image_id, 'large', false, array( 'loading' => 'lazy', 'decoding' => 'async' ) ); ?>
					</div>
				<?php endif; ?>
				<div class="<?php echo $standard_image_id ? 'split__content ' : 'text-center '; ?>entry-content">
					<h2 class="mt-0"><?php esc_html_e( 'The Highest Standard of Tree Care. No Exceptions.', 'jce' ); ?></h2>
					<p><?php esc_html_e( "We built JCE around one rule: the standard doesn't change, job to job, customer to customer. Same crew training. Same equipment. Same guy — usually the owner, Joe — walking your property, writing your estimate by hand, and explaining to you what your trees need. We offer the highest standard of tree care in the area. No exceptions.", 'jce' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<?php
	/* --------------------------------------------------------------
	 * Services — the brief highlights Tree Removal and Tree Pruning, so
	 * those two get the featured card treatment.
	 * ------------------------------------------------------------ */
	$most_requested = array(
		array(
			'slug'     => 'tree-removal',
			'icon'     => 'tree',
			'eyebrow'  => __( 'Tree Removal Near Me', 'jce' ),
			/* translators: %s: town name */
			'headline' => __( 'Tree Removal by Local Tree Experts in %s, WI', 'jce' ),
			'body'     => __( "A dead or hazardous tree isn't something to gamble on. Our arborists don't just take trees down, they know when a tree can be saved and when it can't, and they've got 25 years of judgment behind that call.", 'jce' ),
		),
		array(
			'slug'     => 'tree-pruning',
			'icon'     => 'scissors',
			'eyebrow'  => __( 'Tree Pruning & Trimming Near Me', 'jce' ),
			/* translators: %s: town name */
			'headline' => __( 'Tree Pruning & Trimming by Local Tree Experts in %s, WI', 'jce' ),
			'body'     => __( 'Regular pruning keeps your trees healthy, shaped, and safe. Our ISA-certified arborists and professional crew know how each species responds to a cut, and when in the season to make it.', 'jce' ),
		),
		array(
			'slug'     => 'plant-health-care',
			'icon'     => 'leaf',
			'eyebrow'  => __( 'Tree Health Care Near Me', 'jce' ),
			/* translators: %s: town name */
			'headline' => __( 'Tree Health Care by Local Tree Experts in %s, WI', 'jce' ),
			'body'     => __( "Most tree problems are easier (and cheaper!) to fix if you catch them early. Whether you're dealing with disease, pests or a tree in general decline, our certified arborists diagnose what's going on before recommending a treatment plan.", 'jce' ),
		),
	);

	$other_services = array(
		array(
			'emergency-tree-service',
			'zap',
			__( 'Emergency Tree Service:', 'jce' ),
			$phone
				? sprintf(
					/* translators: %s: phone number */
					__( 'Tree on the house, or a storm-damaged limb? We respond fast. Call %s', 'jce' ),
					$phone
				)
				: __( 'Tree on the house, or a storm-damaged limb? We respond fast.', 'jce' ),
		),
		array( 'tree-inspection', 'search', __( 'Tree Inspection:', 'jce' ), __( "An arborist's honest read on what a tree needs, before anything comes down.", 'jce' ) ),
		array( 'lot-land-clearing', 'layers', __( 'Lot & Land Clearing:', 'jce' ), __( 'Clear ground for a build, a pasture, or a project.', 'jce' ) ),
		array( 'brush-clean-up', 'wind', __( 'Brush Clean Up & Mowing:', 'jce' ), __( 'Reclaim overgrown areas of your property.', 'jce' ) ),
		array( 'stump-grinding', 'disc', __( 'Stump Grinding:', 'jce' ), __( 'Available as an add-on to any removal — just ask at your estimate.', 'jce' ) ),
	);
	?>
	<section class="section <?php echo esc_attr( jce_band() ); ?>" id="services">
		<div class="wrap">
			<div class="section-head section-head--center">
				<p class="eyebrow"><?php esc_html_e( 'Services', 'jce' ); ?></p>
				<h2><?php esc_html_e( 'Most Requested Services', 'jce' ); ?></h2>
			</div>

			<div class="services-grid">
				<?php foreach ( $most_requested as $i => $item ) : ?>
					<article class="service-card<?php echo $i < 2 ? ' service-card--featured' : ''; ?>">
						<div class="service-card__body">
							<div class="service-card__icon"><?php jce_icon( $item['icon'] ); ?></div>
							<p class="eyebrow"><?php echo esc_html( $item['eyebrow'] ); ?></p>
							<h3>
								<a href="<?php echo esc_url( jce_service_url( $item['slug'] ) ); ?>">
									<?php echo esc_html( sprintf( $item['headline'], $town ) ); ?>
								</a>
							</h3>
							<p><?php echo esc_html( $item['body'] ); ?></p>
							<a class="link-arrow" href="<?php echo esc_url( jce_service_url( $item['slug'] ) ); ?>">
								<?php esc_html_e( 'Learn more', 'jce' ); ?><?php jce_icon( 'arrow-right' ); ?>
								<span class="screen-reader-text"><?php echo esc_html( sprintf( $item['headline'], $town ) ); ?></span>
							</a>
						</div>
					</article>
				<?php endforeach; ?>
			</div>

			<ul class="service-list" style="margin-top:2.5rem;">
				<?php foreach ( $other_services as $item ) : ?>
					<li>
						<a class="service-list__link" href="<?php echo esc_url( jce_service_url( $item[0] ) ); ?>">
							<span class="service-list__icon"><?php jce_icon( $item[1] ); ?></span>
							<span class="service-list__body"><strong><?php echo esc_html( $item[2] ); ?></strong> <?php echo esc_html( $item[3] ); ?></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<?php
	/* --------------------------------------------------------------
	 * Process — the brief's three-step Personal Estimate.
	 * ------------------------------------------------------------ */
	get_template_part(
		'template-parts/personal-estimate-steps-3step',
		null,
		array( 'class' => jce_band() )
	);


	/* --------------------------------------------------------------
	 * Property-First Care
	 * ------------------------------------------------------------ */
	$before_image_id = (int) jce_field( '_jce_location_before_image' );
	$after_image_id  = (int) jce_field( '_jce_location_after_image' );
	?>
	<section class="section section--tight <?php echo esc_attr( jce_band() ); ?>">
		<div class="wrap wrap--narrow entry-content">
			<p class="eyebrow"><?php esc_html_e( 'Property-First Care', 'jce' ); ?></p>
			<h2 class="mt-0"><?php esc_html_e( "We Treat Your Yard Like It's Ours", 'jce' ); ?></h2>
			<p><?php esc_html_e( 'Property damage is the fear nobody tells you they have until it happens to them like the driveway that gets rutted, the flower bed that doesn\'t survive the truck, the "quick job" that leaves ruts in the lawn for a season. We\'ve spent 25 years buying equipment specifically chosen to avoid that. And we clean up like we\'re the ones who have to look at your yard tomorrow (because in this community, we probably will)!', 'jce' ); ?></p>

			<h3><?php esc_html_e( 'Removing the Tree Without Damaging the Property', 'jce' ); ?></h3>
			<p><?php esc_html_e( "Having the right equipment means the tree comes down without putting the rest of your property at risk. Whether that's your pool, your siding, a fence line, a garden, or landscaping you've spent years on, we plan around it before the work starts. A yard can take real damage from the wrong equipment, or work done at the wrong time of year, which is exactly why JCE has spent 25 years investing in the gear to avoid it.", 'jce' ); ?></p>

			<h3><?php esc_html_e( 'Meticulous Cleanup, Every Time', 'jce' ); ?></h3>
			<p><?php esc_html_e( "Thousands of times over twenty five years we've heard from homeowners that they were so impressed with our clean up. Our crew knows your yard should look better when we leave than it did when we got there. Others will say that, but we've proven over time we're committed to meticulous clean up on every job.", 'jce' ); ?></p>
		</div>

		<?php // Until both photos are set the slots stay labelled placeholders, so the page doubles as a shot list. ?>
		<div class="wrap" style="margin-top:clamp(2rem,1.5rem + 2vw,3rem);">
			<div class="proof-block__media proof-block__media--pair">
				<figure class="proof-shot"><?php
					jce_attachment_or_placeholder(
						$before_image_id,
						'large',
						'media-ph--wide',
						sprintf(
							/* translators: %s: town name */
							__( 'Before — property protection on a %s job', 'jce' ),
							$town
						)
					);
				?></figure>
				<figure class="proof-shot"><?php
					jce_attachment_or_placeholder(
						$after_image_id,
						'large',
						'media-ph--wide',
						sprintf(
							/* translators: %s: town name */
							__( 'After — same angle, %s', 'jce' ),
							$town
						)
					);
				?></figure>
			</div>
		</div>
	</section>

	<?php
	/* --------------------------------------------------------------
	 * Locally Owned & Operated
	 * ------------------------------------------------------------ */
	// A chosen photo wins; otherwise the bundled town photo, where one exists.
	$local_image_id = (int) jce_field( '_jce_location_local_image' );
	$has_town_photo = $local_image_id || ( isset( $location_map[ $town_slug ] ) && jce_img_exists( $location_map[ $town_slug ][0] ) );
	?>
	<section class="section section--tight <?php echo esc_attr( jce_band() ); ?>">
		<div class="wrap<?php echo $has_town_photo ? '' : ' wrap--narrow'; ?>">
			<div class="<?php echo $has_town_photo ? 'split split--photo split--reverse' : ''; ?>">
				<?php if ( $has_town_photo ) : ?>
					<div class="split__media">
						<?php if ( $local_image_id ) : ?>
							<?php echo wp_get_attachment_image( $local_image_id, 'large', false, array( 'loading' => 'lazy', 'decoding' => 'async' ) ); ?>
						<?php else : ?>
							<img src="<?php echo esc_url( jce_img_uri( $location_map[ $town_slug ][0] ) ); ?>"
								alt="<?php echo esc_attr( $location_map[ $town_slug ][1] ); ?>"
								width="1600" height="900" loading="lazy" decoding="async">
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<div class="<?php echo $has_town_photo ? 'split__content ' : ''; ?>entry-content">
					<h2 class="mt-0"><?php esc_html_e( 'Locally Owned & Operated', 'jce' ); ?></h2>
					<p><?php
						printf(
							/* translators: %s: town name. "River Falls, WI" is the JCE headquarters and stays fixed. */
							esc_html__( "JCE is located in River Falls, WI, and we've been doing work in %s and the surrounding area for the last 25 years. You can trust that you can reach JCE and the owner, Joe Cardin, after the job just as easily as before it. Many of our employees have been with us for many years, and every crew member receives ongoing training to ensure consistently high-quality work.", 'jce' ),
							esc_html( $town )
						);
					?></p>
					<p><?php
						printf(
							/* translators: %s: star rating */
							esc_html__( "JCE has a %s-star rating in Google which means your neighbors have already put our work to the test on their own properties. We don't filter reviews, and the majority of our business comes from our referrals and repeat customers.", 'jce' ),
							esc_html( jce_biz( 'aggregate_rating', '4.9' ) )
						);
					?></p>
				</div>
			</div>
		</div>
	</section>

	<?php
	/* --------------------------------------------------------------
	 * Reviews — "What Homeowners Say", the brief's own heading.
	 * ------------------------------------------------------------ */
	get_template_part(
		'template-parts/reviews',
		null,
		array(
			'related' => $town_slug,
			'heading' => __( 'What Homeowners Say', 'jce' ),
			'class'   => jce_band(),
		)
	);

	/* --------------------------------------------------------------
	 * Final CTA
	 * ------------------------------------------------------------ */
	get_template_part(
		'template-parts/cta-band',
		null,
		array(
			'title' => __( 'The Highest Standard of Tree Care. No Exceptions.', 'jce' ),
			'copy'  => __( 'Call now for a free estimate by a certified arborist.', 'jce' ),
			'email' => true,
		)
	);

endwhile;

get_footer();
