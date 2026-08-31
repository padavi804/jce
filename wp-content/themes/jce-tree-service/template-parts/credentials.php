<?php
/**
 * Credentials, on the dark forest band. Each credential is paired with a
 * "which means…" consequence rather than left as a bare list, per the brief.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="section section--dark" id="credentials">
	<div class="wrap">
		<div class="section-head">
			<p class="eyebrow"><?php esc_html_e( 'Trusted & Credentialed', 'jce' ); ?></p>
			<h2><?php esc_html_e( "What Working with JCE's Crew Gets You", 'jce' ); ?></h2>
			<p class="lede"><?php esc_html_e( 'Anyone with a chainsaw can call themselves a tree service. Here is what shows up in your driveway when you call us.', 'jce' ); ?></p>
		</div>

		<div class="credentials">
			<article class="credential">
				<div class="credential__icon"><?php jce_icon( 'award' ); ?></div>
				<h3><?php esc_html_e( 'Local Tree Care Experts', 'jce' ); ?></h3>
				<p><?php
					printf(
						/* translators: %s: number of ISA-certified arborists */
						esc_html__( '%s ISA Certified Arborists, two forestry-degreed professionals, and four licensed pesticide applicators on staff — which means the person assessing your tree understands how trees grow, decline, and fail, and can tell you when removal is necessary and when a tree can be saved.', 'jce' ),
						esc_html( jce_biz( 'arborist_count', '4' ) )
					);
				?></p>
			</article>

			<article class="credential">
				<div class="credential__icon"><?php jce_icon( 'users' ); ?></div>
				<h3><?php
					printf(
						/* translators: %s: years in business */
						esc_html__( 'Locally Owned and Operated for %s Years', 'jce' ),
						esc_html( jce_biz( 'years_experience', '25' ) )
					);
				?></h3>
				<p><?php esc_html_e( 'The owner lives in the same community you do — which means you can reach him after the job just as easily as before it. Many of our employees have been with us for years, and every crew member gets ongoing training.', 'jce' ); ?></p>
			</article>

			<article class="credential">
				<div class="credential__icon"><?php jce_icon( 'star', 'icon--filled' ); ?></div>
				<h3><?php
					printf(
						/* translators: %s: star rating */
						esc_html__( '%s-Star Rating Across the Valley', 'jce' ),
						esc_html( jce_biz( 'aggregate_rating', '4.9' ) )
					);
				?></h3>
				<p><?php esc_html_e( "Which means your neighbors have already put our work to the test on their own properties. We don't filter reviews, and most of our business comes from referrals and repeat customers.", 'jce' ); ?></p>
			</article>
		</div>
	</div>
</section>
