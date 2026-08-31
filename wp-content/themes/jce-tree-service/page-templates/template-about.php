<?php
/**
 * Template Name: About Us
 *
 * Assign to the "About" page. Editor content renders in the intro; the
 * credential, stats, and estimate sections are shared with the homepage so
 * the proof stays consistent everywhere.
 */
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
			'context' => 'about',
			'eyebrow' => __( 'About JCE Tree Service', 'jce' ),
			'title'   => get_the_title() ? get_the_title() : __( 'Twenty-Five Years in River Falls', 'jce' ),
			'sub'     => get_the_excerpt(),
			'image'   => has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'jce-hero' ) : '',
		)
	);
	?>

	<section class="section">
		<div class="wrap">
			<div class="split">
				<div class="split__media">
					<?php jce_image_or_placeholder( get_the_ID(), 'large', '', __( 'Photo: the JCE crew on site', 'jce' ) ); ?>
					<div class="split__badge">
						<strong><?php echo esc_html( jce_biz( 'years_experience', '25' ) ); ?></strong>
						<span><?php esc_html_e( 'Years, Locally Owned', 'jce' ); ?></span>
					</div>
				</div>
				<div class="split__content entry-content">
					<?php if ( trim( get_the_content() ) ) : ?>
						<?php the_content(); ?>
					<?php else : ?>
						<h2><?php esc_html_e( 'A local crew, not a franchise passing through.', 'jce' ); ?></h2>
						<p><?php esc_html_e( 'Joe Cardin founded JCE Tree Service in River Falls in 2001. Twenty-five years later the company is still family-owned, still based here, and still run by someone who lives in the same community as the people he works for.', 'jce' ); ?></p>
						<p><?php esc_html_e( 'That matters more than it sounds like it should. It means the person who wrote your estimate is the person you can call afterward. It means the crew knows which streets have the ash problem and which oaks should not be touched in July. And it means our reputation here is the only marketing that has ever really worked for us — most of our customers call us again, and most of the rest were sent by a neighbour.', 'jce' ); ?></p>
						<p><?php esc_html_e( 'People think anyone with a chainsaw can take down a tree. Sometimes that is true. The difference shows up in what your yard looks like the next morning.', 'jce' ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<?php
	// Stats band removed sitewide — see front-page.php.
	get_template_part( 'template-parts/credentials' );
	get_template_part( 'template-parts/personal-estimate-steps' );
	get_template_part( 'template-parts/service-area' );
	get_template_part( 'template-parts/reviews' );
	get_template_part( 'template-parts/cta-band' );

endwhile;

get_footer();
