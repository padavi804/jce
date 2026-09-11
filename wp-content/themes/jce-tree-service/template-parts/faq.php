<?php
/**
 * FAQ accordion.
 *
 * Rows come from a "Question? | Answer" field on the Service, Location, or
 * Page being viewed, so the questions are editable in WordPress. Built on
 * <details>/<summary> — it opens, is keyboard accessible, and is readable by
 * Google with no JavaScript at all.
 *
 * Also emits FAQPage schema, which is what earns the expandable questions
 * under the listing in search results.
 *
 * @param array $args {
 *     @type array  $rows    Rows of [ question, answer ].
 *     @type string $heading Section heading.
 *     @type string $eyebrow Section eyebrow.
 *     @type string $class   Extra section classes, e.g. 'section--cream'.
 * }
 *
 * Answers allow the same safe HTML as post content (wp_kses_post) rather than
 * plain text, so an answer can link to another page — e.g. "send us a
 * request" pointing at the contact form. The FAQPage schema strips tags back
 * out, since that field is meant to be plain text.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'rows'    => array(),
		'heading' => __( 'Questions We Get Asked', 'jce' ),
		'eyebrow' => __( 'Straight Answers', 'jce' ),
		'class'   => '',
	)
);

// Drop any row that lost its answer — a question with nothing under it is
// worse than no FAQ, and invalid as schema.
$faq_rows = array();
foreach ( $args['rows'] as $row ) {
	if ( ! empty( $row[0] ) && ! empty( $row[1] ) ) {
		$faq_rows[] = $row;
	}
}

if ( ! $faq_rows ) {
	return;
}

$faq_schema = array();
foreach ( $faq_rows as $row ) {
	$faq_schema[] = array(
		'@type'          => 'Question',
		'name'           => $row[0],
		'acceptedAnswer' => array(
			'@type' => 'Answer',
			'text'  => wp_strip_all_tags( $row[1] ),
		),
	);
}
?>
<section class="section <?php echo esc_attr( $args['class'] ); ?>" id="faq">
	<div class="wrap wrap--narrow">
		<div class="section-head section-head--center">
			<p class="eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
			<h2><?php echo esc_html( $args['heading'] ); ?></h2>
		</div>

		<div class="faq">
			<?php foreach ( $faq_rows as $row ) : ?>
				<details class="faq__item">
					<summary class="faq__q">
						<span><?php echo esc_html( $row[0] ); ?></span>
						<?php jce_icon( 'chevron-down', 'faq__chevron' ); ?>
					</summary>
					<div class="faq__a"><p><?php echo wp_kses_post( $row[1] ); ?></p></div>
				</details>
			<?php endforeach; ?>
		</div>
	</div>

	<script type="application/ld+json"><?php
		echo wp_json_encode(
			array(
				'@context'   => 'https://schema.org',
				'@type'      => 'FAQPage',
				'mainEntity' => $faq_schema,
			)
		);
	?></script>
</section>
