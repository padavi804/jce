<?php
/**
 * The kinds of a service — "Standard Removal", "Large & Difficult",
 * "Hazardous & Dead", and so on.
 *
 * This is the section that answers "is my situation one you handle?", which is
 * the question a homeowner with an unusual tree is actually carrying. Each
 * card gets its own photo slot; until a photo exists the branded placeholder
 * carries the card title as its label, so the page doubles as a shot list.
 *
 * The "Good to Know" panel sits above the cards deliberately: it is where the
 * add-ons and exclusions are stated, and the brief is explicit that surprises
 * on an estimate are the thing to design out.
 *
 * @param array $args {
 *     @type array    $rows    Rows of [ title, copy ].
 *     @type string[] $intro   Paragraphs above the cards.
 *     @type string   $heading Section heading.
 *     @type string   $eyebrow Section eyebrow.
 *     @type string   $note_title Heading for the Good to Know panel.
 *     @type string   $note_intro Paragraph inside that panel.
 *     @type array    $notes   Rows of [ label, copy ] inside that panel.
 *     @type string   $class   Extra section classes.
 * }
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'rows'       => array(),
		'intro'      => array(),
		'heading'    => '',
		'eyebrow'    => '',
		'note_title' => __( 'Good to Know', 'jce' ),
		'note_intro' => '',
		'notes'      => array(),
		'class'      => '',
	)
);

if ( ! $args['rows'] ) {
	return;
}
?>
<section class="section <?php echo esc_attr( $args['class'] ); ?>" id="sub-services">
	<div class="wrap">
		<?php if ( $args['heading'] ) : ?>
			<div class="section-head">
				<?php if ( $args['eyebrow'] ) : ?>
					<p class="eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
				<?php endif; ?>
				<h2><?php echo esc_html( $args['heading'] ); ?></h2>
				<?php foreach ( $args['intro'] as $i => $paragraph ) : ?>
					<p class="<?php echo 0 === $i ? 'lede' : ''; ?>" style="margin-top:1.1rem;"><?php echo esc_html( $paragraph ); ?></p>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( $args['notes'] || $args['note_intro'] ) : ?>
			<aside class="good-to-know">
				<div class="good-to-know__head">
					<span class="good-to-know__icon"><?php jce_icon( 'clipboard' ); ?></span>
					<h3><?php echo esc_html( $args['note_title'] ); ?></h3>
				</div>
				<?php if ( $args['note_intro'] ) : ?>
					<p class="good-to-know__intro"><?php echo esc_html( $args['note_intro'] ); ?></p>
				<?php endif; ?>
				<?php if ( $args['notes'] ) : ?>
					<ul class="good-to-know__list">
						<?php foreach ( $args['notes'] as $note ) : ?>
							<li>
								<?php jce_icon( 'check-circle' ); ?>
								<span>
									<strong><?php echo esc_html( $note[0] ); ?></strong>
									<?php if ( ! empty( $note[1] ) ) : ?>
										<?php echo esc_html( $note[1] ); ?>
									<?php endif; ?>
								</span>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</aside>
		<?php endif; ?>

		<div class="sub-service-grid">
			<?php foreach ( $args['rows'] as $row ) : ?>
				<article class="sub-service">
					<div class="sub-service__media">
						<?php jce_media_placeholder( 'media-ph--wide', $row[0] ); ?>
					</div>
					<div class="sub-service__body">
						<h3><?php echo esc_html( $row[0] ); ?></h3>
						<?php if ( ! empty( $row[1] ) ) : ?>
							<p><?php echo esc_html( $row[1] ); ?></p>
						<?php endif; ?>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
