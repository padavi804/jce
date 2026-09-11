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
		</div>

		<div class="credentials">
			<article class="credential">
				<div class="credential__icon"><?php jce_icon( 'award' ); ?></div>
				<h3><?php esc_html_e( 'Local Tree Care Experts', 'jce' ); ?></h3>
				<p><?php
					printf(
						/* translators: %s: number of ISA-certified arborists */
						esc_html__( '%s ISA Certified Arborists and 2 forestry-degreed tree professionals on staff mean the person assessing your tree has the training to understand how trees grow, decline, and fail, and can tell you when removal is necessary and when a tree can be saved. It also means the crews working on your property bring deep knowledge of the trees, diseases, and conditions common to our area.', 'jce' ),
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
				<p><?php esc_html_e( 'That means the owner lives in the same community you do, and you can reach him after the job just as easily as before it. Many of our employees have been with us for many years, and every crew member receives ongoing training to ensure consistently high-quality work.', 'jce' ); ?></p>
			</article>

			<article class="credential">
				<div class="credential__icon"><?php jce_icon( 'star', 'icon--filled' ); ?></div>
				<h3><?php
					printf(
						/* translators: %s: star rating */
						esc_html__( '%s-Star Rating Across the St. Croix River Valley', 'jce' ),
						esc_html( jce_biz( 'aggregate_rating', '4.9' ) )
					);
				?></h3>
				<p><?php esc_html_e( "That means your neighbors have already put our work to the test on their own properties. We don't filter reviews, and the majority of our business comes from our referrals and repeat customers. We take great pride in our work, and you can expect us to bring that same level of care to your property.", 'jce' ); ?></p>
			</article>
		</div>
	</div>
</section>
