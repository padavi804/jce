<?php
/**
 * "The Personal Estimate" — the pillar that defuses the "am I being upsold"
 * fear, and the one section that appears on nearly every page: the homepage,
 * every service, every town, and the About / Service Area / Contact templates.
 *
 * Because it renders in seven places, neither the design nor the copy is
 * duplicated. The markup lives here, so a layout change applies everywhere at
 * once. The copy lives in the Customizer (Business Info > The Personal
 * Estimate), so a wording change also applies everywhere at once — and is made
 * in WordPress rather than in PHP.
 *
 * An empty argument means "use the shared default", so a caller only ever
 * passes what genuinely differs for that page. A single Service can override
 * the steps from its own "Process Steps" field.
 *
 * Beyond three steps the grid switches to three-up rows, so the approved five
 * read as 3 + 2 rather than a lopsided 4 + 1.
 *
 * @param array $args {
 *     @type array  $rows    Rows of [ title, copy ]. Empty = the Customizer steps.
 *     @type string $heading Empty = the Customizer heading.
 *     @type string $eyebrow Empty = the standard eyebrow.
 *     @type string $lede    Optional paragraph under the heading.
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
		'heading' => '',
		'eyebrow' => '',
		'lede'    => '',
		'class'   => '',
		'cta'     => true,
	)
);

if ( ! $args['rows'] ) {
	$args['rows'] = jce_process_steps();
}
if ( ! $args['heading'] ) {
	$args['heading'] = jce_biz( 'process_heading', jce_default_process_heading() );
}
if ( ! $args['eyebrow'] ) {
	$args['eyebrow'] = __( 'What Happens After You Reach Out', 'jce' );
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
