<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$facebook  = jce_biz( 'facebook_url' );
$instagram = jce_biz( 'instagram_url' );
$youtube   = jce_biz( 'youtube_url' );
?>
</main>

<footer class="site-footer">
	<div class="wrap site-footer__main">

		<div class="footer-brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php
				$logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
				if ( $logo ) :
					?>
					<img src="<?php echo esc_url( $logo[0] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="200" height="120" loading="lazy" decoding="async">
				<?php endif; ?>
			<?php elseif ( jce_img_exists( 'logo-jce-reverse.png' ) ) : ?>
				<?php // The footer ground is dark too, so it takes the same reverse lockup. ?>
				<img src="<?php echo esc_url( jce_img_uri( 'logo-jce-reverse.png' ) ); ?>"
					alt="<?php esc_attr_e( 'JCE Tree Service — River Falls, Wisconsin', 'jce' ); ?>"
					width="200" height="120" loading="lazy" decoding="async">
			<?php else : ?>
				<h3><?php bloginfo( 'name' ); ?></h3>
			<?php endif; ?>
			<p><?php esc_html_e( 'JCE Tree Service · River Falls, WI · Serving River Falls, Hudson, Prescott & the St. Croix Valley for 25 years', 'jce' ); ?></p>

			<?php if ( $facebook || $instagram || $youtube ) : ?>
				<div class="footer-socials">
					<?php if ( $facebook ) : ?>
						<a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener">
							<span class="screen-reader-text"><?php esc_html_e( 'Facebook', 'jce' ); ?></span>
							<?php jce_icon( 'facebook', 'icon--filled' ); ?>
						</a>
					<?php endif; ?>
					<?php if ( $instagram ) : ?>
						<a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener">
							<span class="screen-reader-text"><?php esc_html_e( 'Instagram', 'jce' ); ?></span>
							<?php jce_icon( 'instagram' ); ?>
						</a>
					<?php endif; ?>
					<?php if ( $youtube ) : ?>
						<a href="<?php echo esc_url( $youtube ); ?>" target="_blank" rel="noopener">
							<span class="screen-reader-text"><?php esc_html_e( 'YouTube', 'jce' ); ?></span>
							<?php jce_icon( 'youtube', 'icon--filled' ); ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>

	</div>

	<div class="wrap">
		<div class="site-footer__bottom">
			<p>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'jce' ); ?></p>
			<?php
			if ( has_nav_menu( 'legal' ) ) {
				wp_nav_menu( array( 'theme_location' => 'legal', 'container' => false, 'depth' => 1 ) );
			}
			?>
		</div>
	</div>
</footer>

<?php
// Sticky call bar on phones — most emergency and high-intent traffic is mobile.
if ( ! is_page_template( 'page-templates/template-emergency.php' ) ) :
	?>
	<div class="mobile-callbar">
		<a class="btn btn--emergency" href="tel:<?php echo esc_attr( jce_emergency_tel() ); ?>">
			<?php jce_icon( 'phone' ); ?><span><?php esc_html_e( 'Call Now', 'jce' ); ?></span>
		</a>
		<a class="btn btn--primary" href="<?php echo esc_url( jce_url( 'estimate_url', '/estimate/' ) ); ?>">
			<?php esc_html_e( 'Free Estimate', 'jce' ); ?>
		</a>
	</div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
