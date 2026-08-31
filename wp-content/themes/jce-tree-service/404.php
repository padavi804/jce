<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part(
	'template-parts/page-hero',
	null,
	array(
		'title' => __( 'That page came down.', 'jce' ),
		'sub'   => __( 'The page you were after has moved or no longer exists. Here is where most people are headed.', 'jce' ),
	)
);
?>

<section class="section">
	<div class="wrap wrap--narrow">
		<div class="btn-row">
			<a class="btn btn--primary btn--lg" href="<?php echo esc_url( jce_url( 'estimate_url', '/estimate/' ) ); ?>"><?php esc_html_e( 'Get Your Personal Estimate', 'jce' ); ?></a>
			<a class="btn btn--outline btn--lg" href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ); ?>"><?php esc_html_e( 'Browse Services', 'jce' ); ?></a>
		</div>
	</div>
</section>

<?php
get_template_part( 'template-parts/services-grid' );
get_template_part( 'template-parts/cta-band' );
get_footer();
