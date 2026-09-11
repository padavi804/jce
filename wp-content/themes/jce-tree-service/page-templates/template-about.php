<?php
/**
 * Template Name: About Us
 *
 * Assign to the "About" page. Every named block in the approved brief gets
 * its own section here (Our Story, Why We Still Do It the Same Way, The
 * Crew Behind the Work, We Treat Your Yard Like It's Ours, We're Proud to
 * Be Located in River Falls, What 25 Years Actually Buys You) rather than
 * being flattened into one long editor-content block. The editor content is
 * "Our Story"; the rest come from the "Page Sections" box below the editor.
 * The estimate and service-area sections are shared with the homepage so
 * the proof stays consistent everywhere.
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
			'eyebrow' => __( 'About JCE Tree Service', 'jce' ),
			'title'   => get_the_title() ? get_the_title() : __( '25 Years of Doing Right by People and Trees in our Community', 'jce' ),
			'sub'     => get_the_excerpt() ? get_the_excerpt() : __( 'Locally-owned. Arborist-led. The highest standard of tree care. No exceptions.', 'jce' ),
			'image'   => has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'jce-hero' ) : '',
			'focus'   => jce_field( '_jce_page_hero_focus', null, 5 ),
		)
	);
	?>

	<?php
	/* --------------------------------------------------------------
	 * Our Story — photo + editor content
	 * ------------------------------------------------------------ */
	?>
	<section class="section <?php echo esc_attr( jce_band() ); ?>">
		<div class="wrap">
			<div class="split split--photo">
				<div class="split__media">
					<?php
					// The "Our Story" photo is its own field, kept separate from
					// the Featured Image (which drives the hero banner only) so
					// the two spots can carry different photos. Falls back to
					// the bundled crew photo if none has been chosen yet.
					$story_image_id = (int) jce_field( '_jce_page_story_image' );
					if ( $story_image_id ) {
						echo wp_get_attachment_image(
							$story_image_id,
							'large',
							false,
							array( 'loading' => 'lazy', 'decoding' => 'async' )
						);
					} else {
						jce_bundled_image(
							'crew-team-river-falls.jpg',
							__( 'Three JCE Tree Service crew members in front of a JCE bucket truck in River Falls, Wisconsin', 'jce' ),
							900,
							1200,
							'',
							__( 'Photo: Joe and the crew on site', 'jce' )
						);
					}
					?>
					<div class="split__badge">
						<strong><?php echo esc_html( jce_biz( 'years_experience', '25' ) ); ?></strong>
						<span><?php esc_html_e( 'Years, Locally Owned', 'jce' ); ?></span>
					</div>
				</div>
				<div class="split__content entry-content">
					<h2 class="mt-0"><?php esc_html_e( 'Our Story', 'jce' ); ?></h2>
					<?php if ( trim( get_the_content() ) ) : ?>
						<?php the_content(); ?>
					<?php else : ?>
						<p><?php esc_html_e( "JCE Tree Service started in River Falls in 2001. Twenty-five years later, we're still here, still local, and still running on the same high quality standard we started with.", 'jce' ); ?></p>
						<p><?php esc_html_e( "Today JCE is a crew of 10-12, led by Joe Cardin and Ross Zimmermann, right here in River Falls. Along the way we've added ISA-certified arborists, forestry degrees, licensed pesticide applicators, and a lot more equipment all so we can treat your trees and your property with the same care whether it's a big job or a small one.", 'jce' ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<?php
	/* --------------------------------------------------------------
	 * Why We Still Do It the Same Way — single-field paragraphs
	 * ------------------------------------------------------------ */
	$standard_paragraphs = jce_field_lines(
		'_jce_page_standard',
		null,
		array(
			__( "We built JCE around one rule: the standard doesn't change, job to job, customer to customer. Same crew training. Same equipment. Same guy — usually the owner, Joe — walking your property, writing your estimate by hand, and explaining to you what your trees need. We offer the highest standard of tree care in the area. No exceptions.", 'jce' ),
			__( "That's the whole business model. It's also why more than 8 out of 10 JCE customers call us again.", 'jce' ),
		)
	);
	if ( $standard_paragraphs ) :
		?>
		<section class="section <?php echo esc_attr( jce_band() ); ?>">
			<div class="wrap wrap--narrow">
				<div class="section-head section-head--center">
					<h2><?php esc_html_e( 'Why We Still Do It the Same Way', 'jce' ); ?></h2>
				</div>
				<div class="entry-content">
					<?php foreach ( $standard_paragraphs as $paragraph ) : ?>
						<p><?php echo esc_html( $paragraph ); ?></p>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	endif;

	/* --------------------------------------------------------------
	 * The Crew Behind the Work — "Highlight Cards" field
	 * ------------------------------------------------------------ */
	get_template_part(
		'template-parts/highlight-cards',
		null,
		array(
			'rows'    => jce_field_rows(
				'_jce_page_highlights',
				2,
				null,
				array(
					array( __( 'Four ISA-Certified Arborists', 'jce' ), __( "Which means the person diagnosing your tree's health has the training to be right about it, not just confident about it.", 'jce' ) ),
					array( __( 'Two Team Members with Forestry Degrees', 'jce' ), __( 'Which means we understand how trees behave in this climate, this soil, and these species — not tree care in general.', 'jce' ) ),
					array( __( 'Four Licensed Pesticide Applicators', 'jce' ), __( 'Which means treatment for disease or pests comes from people licensed to do the work.', 'jce' ) ),
					array( __( "An Owner Who's Spent Decades in These Woods", 'jce' ), __( 'Which means the estimate you get reflects 25 years of judgment calls on trees just like yours, in neighborhoods just like yours.', 'jce' ) ),
					array( __( 'A Crew That Sticks Around', 'jce' ), __( 'Many of our team members have been with JCE for years, and every one of them trains on the same quality standard, so the crew that shows up is never a variable.', 'jce' ) ),
				)
			),
			'icons'   => array( 'award', 'leaf', 'droplet', 'clock', 'users' ),
			'eyebrow' => __( 'Our Team', 'jce' ),
			'heading' => __( 'The Crew Behind the Work', 'jce' ),
			'class'   => jce_band(),
		)
	);

	/* --------------------------------------------------------------
	 * We Treat Your Yard Like It's Ours — single-field paragraph(s)
	 * ------------------------------------------------------------ */
	$yard_paragraphs = jce_field_lines(
		'_jce_page_yard',
		null,
		array(
			__( 'Property damage is the fear nobody tells you they have until it happens to them — the driveway that gets rutted, the flower bed that doesn\'t survive the truck, the "quick job" that leaves ruts in the lawn for a season. We\'ve spent 25 years buying equipment specifically chosen to avoid that, not just to get a tree down fast. And we clean up like we\'re the ones who have to look at your yard tomorrow (because in this community, we probably will)!', 'jce' ),
		)
	);
	if ( $yard_paragraphs ) :
		?>
		<section class="section <?php echo esc_attr( jce_band() ); ?>">
			<div class="wrap wrap--narrow">
				<div class="section-head section-head--center">
					<h2><?php esc_html_e( "We Treat Your Yard Like It's Ours", 'jce' ); ?></h2>
				</div>
				<div class="entry-content">
					<?php foreach ( $yard_paragraphs as $paragraph ) : ?>
						<p><?php echo esc_html( $paragraph ); ?></p>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	endif;

	// get_template_part( 'template-parts/personal-estimate-steps', null, array( 'class' => jce_band() ) );

	/* --------------------------------------------------------------
	 * We're Proud to Be Located in River Falls — single-field paragraphs
	 * ------------------------------------------------------------ */
	$local_paragraphs = jce_field_lines(
		'_jce_page_local',
		null,
		array(
			__( "We're not a franchise, and we're not a crew that drives in from out of the area to work a job and leave. Joe and Ross live here. So does most of the crew. When we talk about the ash borer problem hitting River Falls and the surrounding area, it's because we're dealing with it in our neighborhoods too.", 'jce' ),
			__( "We're proud to support our local community where we can. We enjoy being part of the River Falls Days and the Holidazzle parade, and we support local youth sports and local fundraisers throughout the year. We don't spend a lot of money on advertising, but when we do, we try to support local businesses like WEVR and the Falls Movie Theater. We live here, work here, and we're glad to show up for the community the same way we show up for our customers.", 'jce' ),
		)
	);
	if ( $local_paragraphs ) :
		?>
		<section class="section <?php echo esc_attr( jce_band() ); ?>">
			<div class="wrap wrap--narrow">
				<div class="section-head section-head--center">
					<h2><?php esc_html_e( "We're Proud to Be Located in River Falls", 'jce' ); ?></h2>
				</div>
				<div class="entry-content">
					<?php foreach ( $local_paragraphs as $paragraph ) : ?>
						<p><?php echo esc_html( $paragraph ); ?></p>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	endif;

	// get_template_part( 'template-parts/reviews', null, array( 'class' => jce_band() ) );
	// get_template_part( 'template-parts/service-area', null, array( 'class' => jce_band() ) );

	/* --------------------------------------------------------------
	 * What 25 Years Actually Buys You — credential recap, right before the
	 * closing CTA, same as the approved copy's own ordering.
	 * ------------------------------------------------------------ */
	get_template_part(
		'template-parts/stats',
		null,
		array(
			'heading' => __( 'What 25 Years Actually Buys You', 'jce' ),
			'stats'   => array(
				array( '4.9', __( 'Star Rating, Unfiltered', 'jce' ) ),
				array( '80%+', __( 'Repeat & Referral Customers', 'jce' ) ),
				array( '4', __( 'ISA-Certified Arborists on Staff', 'jce' ) ),
				array( 'Elite', __( 'HomeAdvisor Service Rating', 'jce' ) ),
				array( '2001', __( 'Locally Owned & Operated Since', 'jce' ) ),
			),
		)
	);

	get_template_part( 'template-parts/cta-band' );

endwhile;

get_footer();
