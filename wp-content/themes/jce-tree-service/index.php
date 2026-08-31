<?php
/**
 * Mandatory fallback template (WordPress requires index.php in every theme).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part(
	'template-parts/page-hero',
	null,
	array(
		'title' => is_search()
			/* translators: %s: search query */
			? sprintf( __( 'Search results for “%s”', 'jce' ), get_search_query() )
			: wp_strip_all_tags( get_the_archive_title() ),
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
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p><?php echo esc_html( get_the_excerpt() ); ?></p>
						<a class="link-arrow" href="<?php the_permalink(); ?>">
							<?php esc_html_e( 'Read more', 'jce' ); ?><?php jce_icon( 'arrow-right' ); ?>
							<span class="screen-reader-text"><?php the_title(); ?></span>
						</a>
					</article>
				<?php endwhile; ?>
			</div>
			<?php the_posts_pagination( array( 'class' => 'pagination', 'mid_size' => 1 ) ); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Nothing found. Try the services list, or give us a call.', 'jce' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php
get_template_part( 'template-parts/cta-band' );
get_footer();
