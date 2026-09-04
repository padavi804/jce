<?php
/**
 * Template Name: About Us
 *
 * Assign to the "About" page. The editor content is the story; the timeline,
 * the values cards, and the FAQ come from the "Page Sections" box below the
 * editor. The credential, estimate, and service-area sections are shared with
 * the homepage so the proof stays consistent everywhere.
 *
 * Every section falls back to example copy while the real text is being
 * written — see inc/fields.php for the field formats.
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
			'title'   => get_the_title() ? get_the_title() : __( 'Twenty-Five Years in River Falls', 'jce' ),
			'sub'     => get_the_excerpt() ? get_the_excerpt() : __( 'Family-owned since 2001, still based in the same town, still run by the person who writes your estimate.', 'jce' ),
			'image'   => has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'jce-hero' ) : '',
		)
	);
	?>

	<section class="section <?php echo esc_attr( jce_band() ); ?>">
		<div class="wrap">
			<div class="split">
				<div class="split__media">
					<?php
					// A Featured Image on this page wins; otherwise the bundled
					// crew photo stands in rather than an empty placeholder.
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'large', array( 'loading' => 'lazy', 'decoding' => 'async' ) );
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
					<?php if ( trim( get_the_content() ) ) : ?>
						<?php the_content(); ?>
					<?php else : ?>
						<h2 class="mt-0"><?php esc_html_e( 'A local crew, not a franchise passing through.', 'jce' ); ?></h2>
						<p><?php esc_html_e( 'Joe Cardin founded JCE Tree Service in River Falls in 2001. Twenty-five years later the company is still family-owned, still based here, and still run by someone who lives in the same community as the people he works for.', 'jce' ); ?></p>
						<p><?php esc_html_e( 'That matters more than it sounds like it should. It means the person who wrote your estimate is the person you can call afterward. It means the crew knows which streets have the ash problem and which oaks should not be touched in July. And it means our reputation here is the only marketing that has ever really worked for us — most of our customers call us again, and most of the rest were sent by a neighbor.', 'jce' ); ?></p>
						<p><?php esc_html_e( 'People think anyone with a chainsaw can take down a tree. Sometimes that is true. The difference shows up in what your yard looks like the next morning.', 'jce' ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<?php
	/* --------------------------------------------------------------
	 * What we stand for — "Highlight Cards" field
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
					array( __( 'We tell you when not to do it', 'jce' ), __( 'The fastest way to lose a customer for twenty years is to take down a tree that did not need to come down. We would rather write the smaller estimate and keep the phone number.', 'jce' ) ),
					array( __( 'The owner is still on the property', 'jce' ), __( 'Joe walks most estimates himself. There is no sales department here, and nobody working on commission is deciding what your tree needs.', 'jce' ) ),
					array( __( 'The yard matters as much as the tree', 'jce' ), __( 'Every machine we own was bought with turf in mind. If the ground is too soft, we will tell you to wait rather than leave you with ruts to repair.', 'jce' ) ),
					array( __( 'The crew stays', 'jce' ), __( 'Most of our people have been here for years, and they train continuously. That is unusual in this trade, and it is the reason the work is consistent.', 'jce' ) ),
				)
			),
			'icons'   => array( 'shield', 'users', 'truck', 'award' ),
			'eyebrow' => __( 'How We Work', 'jce' ),
			'heading' => __( 'What Twenty-Five Years Taught Us', 'jce' ),
			'lede'    => __( 'Four things we will not trade away, whatever the job is worth.', 'jce' ),
			'class'   => jce_band(),
		)
	);

	/* --------------------------------------------------------------
	 * Timeline — "Timeline" field (dark band)
	 * ------------------------------------------------------------ */
	get_template_part(
		'template-parts/milestones',
		null,
		array(
			'rows' => jce_field_rows(
				'_jce_page_milestones',
				3,
				null,
				array(
					array( '2001', __( 'Joe starts JCE', 'jce' ), __( 'One truck, one chainsaw, and a phone number handed around River Falls. The first customers are neighbors, which sets the tone for everything after.', 'jce' ) ),
					array( '2008', __( 'First bucket truck', 'jce' ), __( 'The jobs stop being ones that can be climbed. Buying lift equipment means taking on the removals other companies were turning down.', 'jce' ) ),
					array( '2013', __( 'Emerald ash borer arrives', 'jce' ), __( 'The beetle reaches western Wisconsin and changes the work permanently. We add licensed pesticide applicators so we can treat the ash worth saving instead of only removing the ones that are gone.', 'jce' ) ),
					array( '2017', __( 'Crane and spider lift', 'jce' ), __( 'Equipment that can reach over a house without touching the lawn. It is what makes the difficult backyard removals possible at all.', 'jce' ) ),
					array( '2021', __( 'Four certified arborists on staff', 'jce' ), __( 'Two forestry degrees among them. The assessments stop being one person\'s judgement and start being a standard.', 'jce' ) ),
					array( '2026', __( 'Twenty-five years, same town', 'jce' ), __( 'Still family-owned, still based in River Falls, still mostly working for people who found us through someone they know.', 'jce' ) ),
				)
			),
		)
	);
	jce_band( 'dark' );

	get_template_part(
		'template-parts/feature-list',
		null,
		array(
			'rows'    => array(
				array( __( 'ISA Certified Arborists', 'jce' ), __( 'The certification means continuing education and a testable body of knowledge behind the diagnosis, not just years of holding a saw.', 'jce' ) ),
				array( __( 'Forestry degrees', 'jce' ), __( 'Two of our staff studied this formally. It shows up most in the calls about disease and decline, where being wrong costs a tree.', 'jce' ) ),
				array( __( 'Licensed pesticide applicators', 'jce' ), __( 'Four of them, which is what lets us treat ash and oak disease legally and correctly rather than referring it out.', 'jce' ) ),
				array( __( 'Fully licensed and insured', 'jce' ), __( 'Liability and workers compensation, certificate handed over before we start. An uninsured crew in your tree becomes your problem, not theirs.', 'jce' ) ),
				array( __( 'Continuous crew training', 'jce' ), __( 'Rigging, aerial rescue, and equipment operation, on an ongoing schedule. It is the least visible thing on this list and the reason nobody gets hurt.', 'jce' ) ),
			),
			'eyebrow' => __( 'Credentials', 'jce' ),
			'heading' => __( 'Who Actually Shows Up', 'jce' ),
			'lede'    => __( 'Anyone can print "certified" on a truck door. Here is what ours means.', 'jce' ),
			'icon'    => 'award',
			'class'   => jce_band(),
		)
	);

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
					array( __( 'Are you actually local, or a national brand with a local name?', 'jce' ), __( 'Local. One owner, one location, in River Falls since 2001. If you call the number on this site during business hours, you are calling an office a few miles from your house.', 'jce' ) ),
					array( __( 'How big is the crew?', 'jce' ), __( 'Big enough to run multiple jobs at once and bring real equipment to each of them, small enough that the owner still knows every property we are working on that week.', 'jce' ) ),
					array( __( 'Who will I actually deal with?', 'jce' ), __( 'Joe or one of our certified arborists for the estimate, and the same crew leader through the job itself. You will not be handed between a salesperson and a stranger.', 'jce' ) ),
					array( __( 'Do you do commercial and municipal work?', 'jce' ), __( 'Yes — property managers, HOAs, and municipal contracts alongside the residential work. The standards are the same either way.', 'jce' ) ),
				)
			),
			'heading' => __( 'Questions About Us', 'jce' ),
			'class'   => jce_band(),
		)
	);

	get_template_part( 'template-parts/reviews', null, array( 'class' => jce_band() ) );
	get_template_part( 'template-parts/service-area', null, array( 'class' => jce_band() ) );
	get_template_part( 'template-parts/cta-band' );

endwhile;

get_footer();
