<?php
/**
 * Template Name: Careers
 *
 * Hiring page — what it's like to work at JCE, and how to apply. The job
 * description is a single flowing narrative (editor content, with H2s for
 * each named section), the same way a Service page's body works. Reuses the
 * "Frequently Asked Questions" and "Fine Print" fields every other Page
 * template has (Page Attributes > Page Sections) for an optional applicant
 * FAQ and the closing EEO statement.
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
			'eyebrow' => __( 'Join the Team', 'jce' ),
			'title'   => jce_field( '_jce_page_headline', null, get_the_title() ? get_the_title() : __( 'Careers at JCE Tree Service', 'jce' ) ),
			'sub'     => jce_field( '_jce_page_subheading' ),
			'image'   => has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'jce-hero' ) : '',
			'focus'   => jce_field( '_jce_page_hero_focus', null, 5 ),
		)
	);
	?>

	<?php if ( trim( get_the_content() ) ) : ?>
		<section class="section <?php echo esc_attr( jce_band() ); ?>">
			<div class="wrap wrap--narrow entry-content">
				<?php the_content(); ?>
			</div>
		</section>
	<?php endif; ?>

	<?php
	/**
	 * How to apply. The phone/email here are the two ways to reach the
	 * company that the approved copy names for this page, given as literal
	 * text rather than jce_biz() — that helper reads the site-wide
	 * Customizer contact info, which may not (yet) match the approved
	 * numbers below, and this section should not silently drift if it does
	 * not.
	 */
	?>
	<section class="section <?php echo esc_attr( jce_band() ); ?>">
		<div class="wrap wrap--narrow">
			<div class="section-head section-head--center">
				<p class="eyebrow"><?php esc_html_e( 'Apply', 'jce' ); ?></p>
				<h2><?php esc_html_e( 'Ready to Apply?', 'jce' ); ?></h2>
			</div>

			<div class="contact-list">
				<div class="contact-item">
					<div class="contact-item__icon"><?php jce_icon( 'phone' ); ?></div>
					<div>
						<h3><?php esc_html_e( 'Call Us', 'jce' ); ?></h3>
						<a href="tel:+17154260179">(715) 426-0179</a>
					</div>
				</div>

				<div class="contact-item">
					<div class="contact-item__icon"><?php jce_icon( 'mail' ); ?></div>
					<div>
						<h3><?php esc_html_e( 'Email Us', 'jce' ); ?></h3>
						<a href="mailto:jcetree@gmail.com">jcetree@gmail.com</a>
					</div>
				</div>

				<div class="contact-item">
					<div class="contact-item__icon"><?php jce_icon( 'mail' ); ?></div>
					<div>
						<h3><?php esc_html_e( 'Or Write to Us', 'jce' ); ?></h3>
						<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Fill out our contact form', 'jce' ); ?></a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
	$faq = jce_field_rows( '_jce_page_faq', 2 );
	get_template_part(
		'template-parts/faq',
		null,
		array(
			'rows'    => $faq,
			'heading' => __( 'Questions About Working Here', 'jce' ),
			'class'   => jce_band_if( $faq ),
		)
	);

	/* --------------------------------------------------------------
	 * EEO statement — small type, always last on the page.
	 * ------------------------------------------------------------ */
	$legal_paragraphs = jce_field_lines( '_jce_page_legal' );
	if ( $legal_paragraphs ) :
		?>
		<section class="section <?php echo esc_attr( jce_band() ); ?>">
			<div class="wrap wrap--narrow" style="font-size:.85rem;color:var(--muted);">
				<?php foreach ( $legal_paragraphs as $paragraph ) : ?>
					<p><?php echo esc_html( $paragraph ); ?></p>
				<?php endforeach; ?>
			</div>
		</section>
		<?php
	endif;

endwhile;

get_footer();
