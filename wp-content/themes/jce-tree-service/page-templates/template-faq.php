<?php
/**
 * Template Name: FAQ
 *
 * A standalone page of general, company-wide questions — reuses the same
 * "Frequently Asked Questions" field and accordion every Service/Page
 * template already has, so it needs no new admin fields of its own.
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
			'eyebrow' => __( 'Straight Answers', 'jce' ),
			'title'   => jce_field( '_jce_page_headline', null, get_the_title() ? get_the_title() : __( 'Frequently Asked Questions', 'jce' ) ),
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
	$faq = jce_field_rows( '_jce_page_faq', 2 );
	get_template_part(
		'template-parts/faq',
		null,
		array(
			'rows'    => $faq,
			'heading' => __( 'Questions We Get Asked', 'jce' ),
			'class'   => jce_band_if( $faq ),
		)
	);

	get_template_part( 'template-parts/cta-band' );

endwhile;

get_footer();
