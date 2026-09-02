<?php
/**
 * Image + copy split. Pulls the Home page's own editor content when there is
 * some, so Joe's team can rewrite this block in WordPress without touching PHP.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$content = trim( get_the_content() );
?>
<section class="section" id="about">
	<div class="wrap">
		<div class="split">
			<div class="split__media">
				<?php
				jce_bundled_image(
					'crew-team-river-falls.jpg',
					__( 'Three JCE Tree Service crew members in front of a JCE bucket truck in River Falls, Wisconsin', 'jce' ),
					900,
					1200,
					'',
					__( 'Photo: Joe and the crew on site', 'jce' )
				);
				?>
				<div class="split__badge">
					<strong><?php echo esc_html( jce_biz( 'years_experience', '25' ) ); ?></strong>
					<span><?php esc_html_e( 'Years in River Falls', 'jce' ); ?></span>
				</div>
			</div>

			<div class="split__content">
				<p class="eyebrow"><?php esc_html_e( 'About JCE', 'jce' ); ?></p>
				<?php if ( $content ) : ?>
					<div class="entry-content"><?php the_content(); ?></div>
				<?php else : ?>
					<?php // Approved homepage copy — see the creative brief in content/. ?>
					<h2><?php esc_html_e( 'Anyone with a chainsaw can call themselves a tree service.', 'jce' ); ?></h2>
					<p class="lede" style="margin-top:1.25rem;"><?php esc_html_e( "Not everyone shows up with certified arborists, a fleet of equipment chosen to protect your lawn, and a professional, experienced crew that cleans up like they're leaving their own yard.", 'jce' ); ?></p>
					<p style="margin-top:1rem;"><?php esc_html_e( "That's the difference with JCE. For 25 years, we've earned the trust of local homeowners in River Falls, Hudson, and Prescott by doing the job right, from start to finish.", 'jce' ); ?></p>
				<?php endif; ?>

				<div class="btn-row" style="margin-top:2rem;">
					<a class="btn btn--outline" href="<?php echo esc_url( home_url( '/about/' ) ); ?>">
						<?php esc_html_e( 'About Us', 'jce' ); ?><?php jce_icon( 'arrow-right' ); ?>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
