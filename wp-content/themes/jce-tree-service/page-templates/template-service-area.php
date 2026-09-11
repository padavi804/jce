<?php
/**
 * Template Name: Service Area
 *
 * Assign to the page at /service-area/ — the hub every town page links up to.
 *
 * The Location post type has has_archive => false precisely so this page can
 * own that URL: an archive would be a bare list, and this needs to be a real
 * page with editable copy, a coverage promise, and its own FAQ.
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
			'eyebrow' => __( 'Service Area', 'jce' ),
			'title'   => jce_field( '_jce_page_headline', null, get_the_title() ? get_the_title() : __( 'Where JCE Works', 'jce' ) ),
			'sub'     => jce_field( '_jce_page_subheading' ),
			'image'   => has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'jce-hero' ) : '',
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
	get_template_part(
		'template-parts/locations-grid',
		null,
		array(
			// 'heading' => __( 'Where We Work', 'jce' ),
			'class'   => jce_band(),
		)
	);

	// get_template_part( 'template-parts/credentials' );
	// jce_band( 'dark' );	

	get_template_part( 'template-parts/cta-band' );

endwhile;

get_footer();
