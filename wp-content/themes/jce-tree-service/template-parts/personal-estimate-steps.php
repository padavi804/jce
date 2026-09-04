<?php
/**
 * "The Personal Estimate" — the pillar that defuses the "am I being upsold"
 * fear. Approved copy from the creative brief is the default; a Service can
 * override the whole list with its own steps.
 *
 * Beyond three steps the grid switches to three-up rows, so five steps read
 * as 3 + 2 rather than a lopsided 4 + 1.
 *
 * @param array $args {
 *     @type array  $rows    Rows of [ title, copy ]. Defaults to the brief's three.
 *     @type string $heading Section heading.
 *     @type string $eyebrow Section eyebrow.
 *     @type string $lede    Paragraph under the heading.
 *     @type string $class   Extra section classes.
 *     @type bool   $cta     Show the estimate button under the steps.
 * }
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'rows'    => array(),
		'heading' => __( 'The Personal Estimate', 'jce' ),
		'eyebrow' => __( 'What Happens After You Reach Out', 'jce' ),
		'lede'    => '',
		'class'   => '',
		'cta'     => true,
	)
);

if ( ! $args['rows'] ) {
	$args['rows'] = array(
		array(
			__( 'You call, we schedule your free estimate.', 'jce' ),
			__( "A local arborist walks your property and figures out what's going on. Sometimes that means the tree comes down. Sometimes it means we tell you it didn't need to. Either way, you get an expert assessment and a clear recommendation on next steps.", 'jce' ),
		),
		array(
			__( "We walk you through what's needed.", 'jce' ),
			__( "You get a hand-written estimate on the spot, and we walk you through it. No callback in three days, no fine print to decode. Just a straight answer while we're standing right there looking at the same tree you are.", 'jce' ),
		),
		array(
			__( 'We schedule the job to fit your needs and the season.', 'jce' ),
			__( "Once you give the go-ahead, we get you on the schedule, timed to the job and the season. A dead ash in July and a leaning oak in January don't call for the same approach, and we'll tell you why.", 'jce' ),
		),
	);
}

$steps_class = count( $args['rows'] ) > 3 ? 'steps steps--3up' : 'steps';
?>
<section class="section <?php echo esc_attr( $args['class'] ); ?>" id="personal-estimate">
	<div class="wrap">
		<div class="section-head">
			<?php if ( $args['eyebrow'] ) : ?>
				<p class="eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
			<?php endif; ?>
			<h2><?php echo esc_html( $args['heading'] ); ?></h2>
			<?php if ( $args['lede'] ) : ?>
				<p class="lede"><?php echo esc_html( $args['lede'] ); ?></p>
			<?php endif; ?>
		</div>

		<div class="<?php echo esc_attr( $steps_class ); ?>">
			<?php foreach ( $args['rows'] as $row ) : ?>
				<article class="step">
					<h3><?php echo esc_html( $row[0] ); ?></h3>
					<?php if ( ! empty( $row[1] ) ) : ?>
						<p><?php echo esc_html( $row[1] ); ?></p>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
		</div>

		<?php if ( $args['cta'] ) : ?>
			<div class="btn-row" style="margin-top:2.5rem;">
				<a class="btn btn--primary btn--lg" href="<?php echo esc_url( jce_url( 'estimate_url', '/estimate/' ) ); ?>">
					<?php esc_html_e( 'Get Your Personal Estimate', 'jce' ); ?><?php jce_icon( 'arrow-right' ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>
