<?php
/**
 * Template Name: Emergency Tree Service
 *
 * Target of the nav's Storm Emergency button. Tone shifts here per the brand
 * brief: calm, direct, reassuring — no jokes, no marketing warm-up. The phone
 * number is the first thing on the page and the only primary action.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	?>

	<?php $emergency_hero = jce_hero_image( 'emergency' ); ?>
	<section class="emergency-hero<?php echo $emergency_hero ? ' emergency-hero--has-image' : ''; ?>">
		<?php if ( $emergency_hero ) : ?>
			<div class="emergency-hero__media">
				<img src="<?php echo esc_url( $emergency_hero['url'] ); ?>"
					alt="<?php echo esc_attr( $emergency_hero['alt'] ); ?>"
					width="1920" height="1080" fetchpriority="high" decoding="async">
			</div>
		<?php endif; ?>
		<div class="wrap">
			<p class="eyebrow" style="color:var(--amber);"><?php echo esc_html( jce_biz( 'emergency_note', '24/7 storm response' ) ); ?></p>
			<h1><?php echo esc_html( get_the_title() ? get_the_title() : __( 'Emergency Tree Service', 'jce' ) ); ?></h1>
			<p class="emergency-hero__sub"><?php esc_html_e( 'A tree on the house, a limb through the roof, or one leaning that was not leaning yesterday. Call us — do not use the contact form. We will tell you straight away whether we can get there and what to do until we do.', 'jce' ); ?></p>

			<a class="emergency-call" href="tel:<?php echo esc_attr( jce_emergency_tel() ); ?>">
				<span class="emergency-call__label"><?php esc_html_e( 'Call now', 'jce' ); ?></span>
				<span class="emergency-call__num"><?php echo esc_html( jce_emergency_phone() ); ?></span>
			</a>
		</div>
	</section>

	<section class="section">
		<div class="wrap">
			<div class="split">
				<div class="split__content">
					<p class="eyebrow"><?php esc_html_e( 'Before We Arrive', 'jce' ); ?></p>
					<h2 style="margin-bottom:1.5rem;"><?php esc_html_e( 'What to do right now', 'jce' ); ?></h2>

					<ul class="checklist checklist--warn" style="margin-bottom:2rem;">
						<li><?php jce_icon( 'alert' ); ?><span><strong><?php esc_html_e( 'Stay away from downed lines.', 'jce' ); ?></strong> <?php esc_html_e( 'Assume any wire in contact with a tree is live. Call your utility first, then us.', 'jce' ); ?></span></li>
						<li><?php jce_icon( 'alert' ); ?><span><strong><?php esc_html_e( 'Keep clear of the tree.', 'jce' ); ?></strong> <?php esc_html_e( 'A tree resting on a structure is holding tension. It can shift without warning.', 'jce' ); ?></span></li>
						<li><?php jce_icon( 'alert' ); ?><span><strong><?php esc_html_e( 'Leave the room underneath it.', 'jce' ); ?></strong> <?php esc_html_e( 'If a limb is through the roof, move people and pets out of that part of the house.', 'jce' ); ?></span></li>
					</ul>

					<ul class="checklist">
						<li><?php jce_icon( 'check-circle' ); ?><span><?php esc_html_e( 'Take photos from a safe distance — your insurer will want them.', 'jce' ); ?></span></li>
						<li><?php jce_icon( 'check-circle' ); ?><span><?php esc_html_e( 'Note whether the tree is touching the structure, a line, or just the ground.', 'jce' ); ?></span></li>
						<li><?php jce_icon( 'check-circle' ); ?><span><?php esc_html_e( 'Have your address and cross street ready when you call.', 'jce' ); ?></span></li>
					</ul>
				</div>

				<div class="split__media">
					<div class="form-panel">
						<p class="eyebrow"><?php esc_html_e( 'What Happens Next', 'jce' ); ?></p>
						<h2 style="font-size:var(--step-2);margin-bottom:1.5rem;"><?php esc_html_e( 'How we handle a storm call', 'jce' ); ?></h2>
						<div class="steps" style="grid-template-columns:1fr;gap:1.75rem;">
							<article class="step" style="padding-top:2.8rem;">
								<h3><?php esc_html_e( 'We triage on the phone.', 'jce' ); ?></h3>
								<p><?php esc_html_e( 'An arborist asks what the tree is touching and how it is loaded. That tells us whether this is a today job or a this-week job, and we say which one it is.', 'jce' ); ?></p>
							</article>
							<article class="step" style="padding-top:2.8rem;">
								<h3><?php esc_html_e( 'We bring the equipment for it.', 'jce' ); ?></h3>
								<p><?php esc_html_e( 'Storm work is rigging work. Our crane, bucket, and rigging gear let us take weight off a structure in pieces instead of dropping it.', 'jce' ); ?></p>
							</article>
							<article class="step" style="padding-top:2.8rem;">
								<h3><?php esc_html_e( 'We document it for your claim.', 'jce' ); ?></h3>
								<p><?php esc_html_e( 'You get photos and a written description of the damage and the work, in the form insurers actually accept.', 'jce' ); ?></p>
							</article>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php if ( trim( get_the_content() ) ) : ?>
		<section class="section section--cream">
			<div class="wrap wrap--narrow entry-content"><?php the_content(); ?></div>
		</section>
	<?php endif; ?>

	<?php
	get_template_part(
		'template-parts/cta-band',
		null,
		array(
			'variant' => 'emergency',
			'title'   => __( 'Storm damage in River Falls, Hudson, or Prescott?', 'jce' ),
			'copy'    => __( 'Call the crew that already knows the trees on your street. We will tell you honestly whether it needs to happen tonight.', 'jce' ),
		)
	);

	get_template_part( 'template-parts/credentials' );

endwhile;

get_footer();
