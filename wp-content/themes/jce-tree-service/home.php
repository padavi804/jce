<?php
/**
 * Blog index (Settings > Reading > "Posts page").
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part(
	'template-parts/page-hero',
	null,
	array(
		'context' => 'blog',
		'eyebrow' => __( 'Seasonal Tree Care', 'jce' ),
		'title'   => __( 'Notes from the Crew', 'jce' ),
		'sub'     => __( 'What to do about your trees, and when — written by the arborists who work on them in River Falls, Hudson, and Prescott.', 'jce' ),
	)
);
?>

<section class="section">
	<div class="wrap">
		<?php if ( have_posts() ) : ?>
			<div class="post-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article <?php post_class( 'post-card' ); ?>>
						<a class="post-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
							<?php jce_image_or_placeholder( get_the_ID(), 'jce-card', 'media-ph--wide' ); ?>
						</a>
						<p class="post-meta"><?php echo esc_html( get_the_date() ); ?></p>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p><?php echo esc_html( get_the_excerpt() ); ?></p>
						<a class="link-arrow" href="<?php the_permalink(); ?>">
							<?php esc_html_e( 'Read more', 'jce' ); ?><?php jce_icon( 'arrow-right' ); ?>
							<span class="screen-reader-text"><?php the_title(); ?></span>
						</a>
					</article>
				<?php endwhile; ?>
			</div>

			<?php
			the_posts_pagination(
				array(
					'class'     => 'pagination',
					'mid_size'  => 1,
					'prev_text' => __( 'Previous', 'jce' ),
					'next_text' => __( 'Next', 'jce' ),
				)
			);
			?>
		<?php else : ?>
			<p><?php esc_html_e( 'No posts yet — seasonal tree care articles are on the way.', 'jce' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php
get_template_part( 'template-parts/cta-band' );
get_footer();
