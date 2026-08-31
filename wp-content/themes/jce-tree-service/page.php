<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	get_template_part(
		'template-parts/page-hero',
		null,
		array(
			'title' => get_the_title(),
			'sub'   => get_the_excerpt(),
			'image' => has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'jce-hero' ) : '',
		)
	);
	?>

	<article <?php post_class( 'section' ); ?>>
		<div class="wrap wrap--narrow entry-content">
			<?php the_content(); ?>
		</div>
	</article>

	<?php
	get_template_part( 'template-parts/cta-band' );

endwhile;

get_footer();
