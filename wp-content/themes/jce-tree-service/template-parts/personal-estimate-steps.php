<?php
/**
 * "The Personal Estimate" — approved copy from the creative brief.
 * This is the pillar that defuses the "am I being upsold" fear.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args( isset( $args ) ? $args : array(), array( 'class' => '' ) );
?>
<section class="section <?php echo esc_attr( $args['class'] ); ?>" id="personal-estimate">
	<div class="wrap">
		<div class="section-head">
			<p class="eyebrow"><?php esc_html_e( 'What Happens After You Reach Out', 'jce' ); ?></p>
			<h2><?php esc_html_e( 'The Personal Estimate', 'jce' ); ?></h2>
			<p class="lede"><?php esc_html_e( 'No sales rep, no ballpark over the phone, no three-day wait for a PDF. Here is exactly how it goes.', 'jce' ); ?></p>
		</div>

		<div class="steps">
			<article class="step">
				<h3><?php esc_html_e( 'You call, we schedule your free estimate.', 'jce' ); ?></h3>
				<p><?php esc_html_e( "A local arborist walks your property and figures out what's going on. Sometimes that means the tree comes down. Sometimes it means we tell you it didn't need to. Either way, you get an expert assessment and a clear recommendation on next steps.", 'jce' ); ?></p>
			</article>
			<article class="step">
				<h3><?php esc_html_e( "We walk you through what's needed.", 'jce' ); ?></h3>
				<p><?php esc_html_e( "You get a hand-written estimate on the spot, and we walk you through it. No callback in three days, no fine print to decode. Just a straight answer while we're standing right there looking at the same tree you are.", 'jce' ); ?></p>
			</article>
			<article class="step">
				<h3><?php esc_html_e( 'We schedule the job to fit your needs and the season.', 'jce' ); ?></h3>
				<p><?php esc_html_e( "Once you give the go-ahead, we get you on the schedule, timed to the job and the season. A dead ash in July and a leaning oak in January don't call for the same approach, and we'll tell you why.", 'jce' ); ?></p>
			</article>
		</div>

		<div class="btn-row" style="margin-top:2.5rem;">
			<a class="btn btn--primary btn--lg" href="<?php echo esc_url( jce_url( 'estimate_url', '/estimate/' ) ); ?>">
				<?php esc_html_e( 'Get Your Personal Estimate', 'jce' ); ?><?php jce_icon( 'arrow-right' ); ?>
			</a>
		</div>
	</div>
</section>
