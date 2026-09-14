<?php
/**
 * Template Name: Contact Us
 *
 * The site's one contact/estimate page (/contact/) — hours, phone, email,
 * and the estimate request form.
 *
 * The hours/phone/email below are literal text rather than jce_biz(), which
 * reads the site-wide Customizer contact info. This page's approved copy
 * gives two phone numbers (Wisconsin/Minnesota) and its own hours and email,
 * which do not map onto that single site-wide phone/email/hours setting, so
 * hardcoding them here keeps this page's approved copy from silently
 * drifting if the Customizer values are ever changed for an unrelated reason.
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
			'context' => 'contact',
			'eyebrow' => __( 'Get In Touch', 'jce' ),
			'title'   => jce_field( '_jce_page_headline', null, get_the_title() ? get_the_title() : __( 'Contact Us', 'jce' ) ),
			'sub'     => jce_field( '_jce_page_subheading' ),
			'image'   => has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'jce-hero' ) : '',
			'focus'   => jce_field( '_jce_page_hero_focus', null, 5 ),
		)
	);
	?>

	<section class="section <?php echo esc_attr( jce_band() ); ?>">
		<div class="wrap">
			<div class="split">

				<div class="split__content">
					<?php if ( trim( get_the_content() ) ) : ?>
						<div class="entry-content" style="margin-bottom:2.5rem;"><?php the_content(); ?></div>
					<?php endif; ?>

					<p class="eyebrow"><?php esc_html_e( 'Reach Us', 'jce' ); ?></p>
					<h2 style="margin-bottom:2rem;"><?php esc_html_e( 'Call, email, or send the form.', 'jce' ); ?></h2>

					<div class="contact-list">
						<div class="contact-item">
							<div class="contact-item__icon"><?php jce_icon( 'clock' ); ?></div>
							<div>
								<h3><?php esc_html_e( 'Office Hours', 'jce' ); ?></h3>
								<p><?php esc_html_e( 'Monday–Friday, 9am–4pm', 'jce' ); ?></p>
							</div>
						</div>

						<div class="contact-item">
							<div class="contact-item__icon"><?php jce_icon( 'phone' ); ?></div>
							<div>
								<h3><?php esc_html_e( 'Phone', 'jce' ); ?></h3>
								<p>
									<?php esc_html_e( 'Wisconsin residents:', 'jce' ); ?>
									<a href="tel:+17154260179">(715) 426-0179</a>
								</p>
								<p>
									<?php esc_html_e( 'Minnesota residents:', 'jce' ); ?>
									<a href="tel:+16514370498">(651) 437-0498</a>
								</p>
							</div>
						</div>

						<div class="contact-item">
							<div class="contact-item__icon"><?php jce_icon( 'mail' ); ?></div>
							<div>
								<h3><?php esc_html_e( 'Email', 'jce' ); ?></h3>
								<a href="mailto:jcetree@gmail.com">jcetree@gmail.com</a>
							</div>
						</div>
					</div>
				</div>

				<div class="split__media">
					<div class="form-panel">
						<h2 style="font-size:var(--step-2);margin-bottom:1.5rem;"><?php esc_html_e( 'Request Your Free Estimate', 'jce' ); ?></h2>

						<?php
						/**
						 * Contact request form — Contact Form 7. After creating the
						 * form in wp-admin → Contact → Contact Forms, replace the id
						 * below with the id CF7 assigns it (shown in the admin list
						 * and in the shortcode CF7 gives you to copy).
						 * The CF7 form content reuses the same field ids/classes the
						 * theme styles target (form-grid, form-field, req, btn--*).
						 *
						 * Approved confirmation message (set on the form's Messages
						 * tab, "Message sent" field): "Thank you! Estimate requests
						 * completed during the workweek are generally responded to
						 * the same day. Weekends will be replied the next day."
						 */
						if ( shortcode_exists( 'contact-form-7' ) ) {
							echo do_shortcode( '[contact-form-7 id="000" title="Contact Request"]' );
						} else {
							?>
							<form class="estimate-form" method="post" action="">
								<div class="form-field">
									<label for="jce-name"><?php esc_html_e( 'Name', 'jce' ); ?> <span class="req">*</span></label>
									<input type="text" id="jce-name" name="jce-name" autocomplete="name" required>
								</div>

								<div class="form-field">
									<label for="jce-address"><?php esc_html_e( 'Property Address', 'jce' ); ?> <span class="req">*</span></label>
									<input type="text" id="jce-address" name="jce-address" autocomplete="street-address" required>
								</div>

								<div class="form-grid">
									<div class="form-field">
										<label for="jce-phone"><?php esc_html_e( 'Phone Number', 'jce' ); ?> <span class="req">*</span></label>
										<input type="tel" id="jce-phone" name="jce-phone" autocomplete="tel" required>
									</div>
									<div class="form-field">
										<label for="jce-email"><?php esc_html_e( 'Email', 'jce' ); ?> <span class="req">*</span></label>
										<input type="email" id="jce-email" name="jce-email" autocomplete="email" required>
									</div>
								</div>

								<div class="form-field">
									<label for="jce-service"><?php esc_html_e( 'What can we help you with?', 'jce' ); ?> <span class="req">*</span></label>
									<select id="jce-service" name="jce-service" required>
										<option value="" disabled selected><?php esc_html_e( 'Select…', 'jce' ); ?></option>
										<option><?php esc_html_e( 'Tree removal', 'jce' ); ?></option>
										<option><?php esc_html_e( 'Tree trimming / pruning', 'jce' ); ?></option>
										<option><?php esc_html_e( 'Tree health or disease concern', 'jce' ); ?></option>
										<option><?php esc_html_e( 'Storm damage / emergency cleanup', 'jce' ); ?></option>
										<option><?php esc_html_e( 'Brush or lot clearing', 'jce' ); ?></option>
										<option><?php esc_html_e( "Not sure / need an arborist's recommendation", 'jce' ); ?></option>
									</select>
								</div>

								<div class="form-field">
									<label for="jce-message"><?php esc_html_e( 'Tell us a little about the project', 'jce' ); ?> <span class="req">*</span></label>
									<textarea id="jce-message" name="jce-message" required placeholder="<?php esc_attr_e( 'How many trees are involved? What are you noticing? Is the tree near a house, power line, driveway, or other structure?', 'jce' ); ?>"></textarea>
								</div>

								<button type="submit" class="btn btn--primary btn--lg btn--block">
									<?php esc_html_e( 'Request My Free Estimate', 'jce' ); ?>
								</button>
							</form>
							<?php
						}
						?>
					</div>
				</div>

			</div>
		</div>
	</section>

	<?php
	$faq = jce_field_rows( '_jce_page_faq', 2 );
	get_template_part(
		'template-parts/faq',
		null,
		array(
			'rows'  => $faq,
			'class' => jce_band_if( $faq ),
		)
	);

	get_template_part( 'template-parts/cta-band' );

endwhile;

get_footer();
