<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$phone     = jce_biz( 'phone' );
$email     = jce_biz( 'email' );
$facebook  = jce_biz( 'facebook_url' );
$instagram = jce_biz( 'instagram_url' );
$street    = jce_biz( 'street_address' );
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
			<p><?php esc_html_e( 'Family-owned tree care in River Falls since 2001. Four ISA-certified arborists, a full equipment fleet, and a crew that cleans up like they\'re leaving their own yard.', 'jce' ); ?></p>

			<?php if ( $facebook || $instagram ) : ?>
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
				</div>
			<?php endif; ?>
		</div>

		<div class="footer-col">
			<h3><?php esc_html_e( 'Services', 'jce' ); ?></h3>
			<?php
			if ( has_nav_menu( 'services' ) ) {
				wp_nav_menu( array( 'theme_location' => 'services', 'container' => false, 'depth' => 1 ) );
			} else {
				$services = get_posts(
					array(
						'post_type'      => 'service',
						'posts_per_page' => 8,
						'orderby'        => 'menu_order title',
						'order'          => 'ASC',
					)
				);
				if ( $services ) {
					echo '<ul>';
					foreach ( $services as $service ) {
						printf( '<li><a href="%s">%s</a></li>', esc_url( get_permalink( $service ) ), esc_html( get_the_title( $service ) ) );
					}
					echo '</ul>';
				}
			}
			?>
		</div>

		<div class="footer-col">
			<h3><?php esc_html_e( 'Service Area', 'jce' ); ?></h3>
			<?php
			$locations = get_posts(
				array(
					'post_type'      => 'location',
					'posts_per_page' => 6,
					'orderby'        => 'menu_order title',
					'order'          => 'ASC',
				)
			);
			if ( $locations ) {
				echo '<ul>';
				foreach ( $locations as $location ) {
					printf( '<li><a href="%s">%s</a></li>', esc_url( get_permalink( $location ) ), esc_html( get_the_title( $location ) ) );
				}
				echo '</ul>';
			}
			?>
			<?php if ( has_nav_menu( 'footer' ) ) : ?>
				<h3 style="margin-top:1.75rem;"><?php esc_html_e( 'Company', 'jce' ); ?></h3>
				<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'depth' => 1 ) ); ?>
			<?php endif; ?>
		</div>

		<div class="footer-col">
			<h3><?php esc_html_e( 'Get In Touch', 'jce' ); ?></h3>
			<ul class="footer-contact">
				<?php if ( $phone ) : ?>
					<li><?php jce_icon( 'phone' ); ?><a href="tel:<?php echo esc_attr( jce_tel() ); ?>"><?php echo esc_html( $phone ); ?></a></li>
				<?php endif; ?>
				<?php if ( $email ) : ?>
					<li><?php jce_icon( 'mail' ); ?><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></li>
				<?php endif; ?>
				<li>
					<?php jce_icon( 'map-pin' ); ?>
					<span>
						<?php if ( $street ) : ?><?php echo esc_html( $street ); ?><br><?php endif; ?>
						<?php echo esc_html( jce_biz( 'city', 'River Falls' ) . ', ' . jce_biz( 'state', 'WI' ) . ' ' . jce_biz( 'zip' ) ); ?>
					</span>
				</li>
				<li><?php jce_icon( 'clock' ); ?><span><?php echo esc_html( jce_biz( 'business_hours' ) ); ?><br><?php echo esc_html( jce_biz( 'emergency_note', '24/7 storm response' ) ); ?></span></li>
			</ul>

			<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
				<div class="footer-widgets"><?php dynamic_sidebar( 'footer-1' ); ?></div>
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
