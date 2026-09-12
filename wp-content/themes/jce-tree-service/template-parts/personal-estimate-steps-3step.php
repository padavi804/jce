<?php
/**
 * "The Personal Estimate" — three-step version.
 *
 * The five-step version in template-parts/personal-estimate-steps.php is the
 * Customizer-driven default used on the Services pages. This is the other
 * approved copy: a tighter, three-step version used where the page calls for
 * a shorter version of the same section (currently the Service Area pages).
 *
 * It's its own template part — rather than an inline args array repeated at
 * each call site — so the copy lives in one place and every caller stays in
 * sync automatically.
 *
 * @param array $args {
 *     @type string $class Extra section classes, passed through.
 *     @type bool|string $cta Passed through; default 'call' to match the
 *                           approved copy for this shorter version.
 * }
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'class' => '',
		'cta'   => 'call',
	)
);

get_template_part(
	'template-parts/personal-estimate-steps',
	null,
	array(
		'heading' => __( 'The Personal Estimate', 'jce' ),
		'rows'    => array(
			array(
				__( 'You call, we schedule your free estimate.', 'jce' ),
				__( "A local arborist walks your property and figures out what's going on. Sometimes that means the tree comes down. Sometimes it means we tell you it didn't need to. Either way, you get an expert assessment and a clear recommendation on next steps.", 'jce' ),
			),
			array(
				__( "We walk you through what's needed", 'jce' ),
				__( "You get a hand-written estimate on the spot, and we walk you through it. No callback in three days, no fine print to decode. Just a straight answer while we're standing right there looking at the same tree you are.", 'jce' ),
			),
			array(
				__( 'We schedule the job to fit your needs and the season.', 'jce' ),
				__( "Once you give the go-ahead, we get you on the schedule, timed to the job and the season. A dead ash in July and a leaning oak in January don't call for the same approach, and we'll tell you why.", 'jce' ),
			),
		),
		'cta'     => $args['cta'],
		'class'   => $args['class'],
	)
);
