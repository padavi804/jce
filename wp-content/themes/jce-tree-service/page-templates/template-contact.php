<?php
/**
 * Template Name: Contact / Estimate
 *
 * Use for both the Contact page and the Estimate page — they do the same job
 * (get the homeowner to book the personal property visit).
 *
 * The form below is plain HTML so the page is complete and styled out of the
 * box. Replace the <form> with your forms plugin shortcode once one is chosen
 * — see the note in the theme README.
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
			'context' => 'contact',
			'eyebrow' => __( 'Get In Touch', 'jce' ),
			'title'   => get_the_title() ? get_the_title() : __( 'Get Your Personal Estimate', 'jce' ),
			'sub'     => get_the_excerpt() ? get_the_excerpt() : __( 'An arborist comes to the property, looks at the actual tree, and hand-writes the estimate. Free, and there is no obligation attached to it.', 'jce' ),
		)
	);
	?>

	<section class="section">
		<div class="wrap">
			<div class="split">

				<div class="split__content">
					<?php if ( trim( get_the_content() ) ) : ?>
						<div class="entry-content" style="margin-bottom:2.5rem;"><?php the_content(); ?></div>
					<?php endif; ?>

					<p class="eyebrow"><?php esc_html_e( 'Reach Us', 'jce' ); ?></p>
					<h2 style="margin-bottom:2rem;"><?php esc_html_e( 'Call, email, or send the form.', 'jce' ); ?></h2>

					<div class="contact-list">
						<?php if ( jce_biz( 'phone' ) ) : ?>
							<div class="contact-item">
								<div class="contact-item__icon"><?php jce_icon( 'phone' ); ?></div>
								<div>
									<h3><?php esc_html_e( 'Phone', 'jce' ); ?></h3>
									<a href="tel:<?php echo esc_attr( jce_tel() ); ?>"><?php echo esc_html( jce_biz( 'phone' ) ); ?></a>
									<p style="font-size:.9rem;"><?php echo esc_html( jce_biz( 'business_hours' ) ); ?></p>
								</div>
							</div>
						<?php endif; ?>

						<?php if ( jce_biz( 'email' ) ) : ?>
							<div class="contact-item">
								<div class="contact-item__icon"><?php jce_icon( 'mail' ); ?></div>
								<div>
									<h3><?php esc_html_e( 'Email', 'jce' ); ?></h3>
									<a href="mailto:<?php echo esc_attr( jce_biz( 'email' ) ); ?>"><?php echo esc_html( jce_biz( 'email' ) ); ?></a>
								</div>
							</div>
						<?php endif; ?>

						<div class="contact-item">
							<div class="contact-item__icon"><?php jce_icon( 'map-pin' ); ?></div>
							<div>
								<h3><?php esc_html_e( 'Service Area', 'jce' ); ?></h3>
								<p><?php esc_html_e( 'River Falls, Hudson, and Prescott, plus the surrounding St. Croix River Valley towns.', 'jce' ); ?></p>
							</div>
						</div>

						<div class="contact-item">
							<div class="contact-item__icon"><?php jce_icon( 'alert' ); ?></div>
							<div>
								<h3><?php esc_html_e( 'Storm Emergency?', 'jce' ); ?></h3>
								<p><?php esc_html_e( 'Do not use the form. Call us directly and we will tell you what happens next.', 'jce' ); ?></p>
								<a href="<?php echo esc_url( jce_url( 'emergency_url', '/emergency-tree-service/' ) ); ?>"><?php esc_html_e( 'Emergency tree service', 'jce' ); ?></a>
							</div>
						</div>
					</div>
				</div>

				<div class="split__media">
					<div class="form-panel">
						<h2 style="font-size:var(--step-2);margin-bottom:1.5rem;"><?php esc_html_e( 'Request Your Free Estimate', 'jce' ); ?></h2>

						<?php
						/**
						 * Swap this block for your forms plugin, e.g.:
						 *   echo do_shortcode( '[contact-form-7 id="123" title="Estimate Request"]' );
						 * The markup below matches the theme styles so the plugin
						 * output can reuse the same classes.
						 */
						?>
						<form class="estimate-form" method="post" action="">
							<div class="form-grid">
								<div class="form-field">
									<label for="jce-name"><?php esc_html_e( 'Name', 'jce' ); ?> <span class="req">*</span></label>
									<input type="text" id="jce-name" name="jce-name" autocomplete="name" required>
								</div>
								<div class="form-field">
									<label for="jce-phone"><?php esc_html_e( 'Phone', 'jce' ); ?> <span class="req">*</span></label>
									<input type="tel" id="jce-phone" name="jce-phone" autocomplete="tel" required>
								</div>
							</div>

							<div class="form-field">
								<label for="jce-email"><?php esc_html_e( 'Email', 'jce' ); ?></label>
								<input type="email" id="jce-email" name="jce-email" autocomplete="email">
							</div>

							<div class="form-grid">
								<div class="form-field">
									<label for="jce-town"><?php esc_html_e( 'Town', 'jce' ); ?></label>
									<select id="jce-town" name="jce-town">
										<option value=""><?php esc_html_e( 'Select…', 'jce' ); ?></option>
										<option>River Falls</option>
										<option>Hudson</option>
										<option>Prescott</option>
										<option>Ellsworth</option>
										<option>Roberts</option>
										<option>Hammond</option>
										<option>Baldwin</option>
										<option>New Richmond</option>
										<option><?php esc_html_e( 'Other / nearby', 'jce' ); ?></option>
									</select>
								</div>
								<div class="form-field">
									<label for="jce-service"><?php esc_html_e( 'What do you need?', 'jce' ); ?></label>
									<select id="jce-service" name="jce-service">
										<option value=""><?php esc_html_e( 'Select…', 'jce' ); ?></option>
										<option><?php esc_html_e( 'Tree removal', 'jce' ); ?></option>
										<option><?php esc_html_e( 'Large tree removal', 'jce' ); ?></option>
										<option><?php esc_html_e( 'Ash tree removal', 'jce' ); ?></option>
										<option><?php esc_html_e( 'Pruning / trimming', 'jce' ); ?></option>
										<option><?php esc_html_e( 'Plant health care', 'jce' ); ?></option>
										<option><?php esc_html_e( 'Tree inspection', 'jce' ); ?></option>
										<option><?php esc_html_e( 'Lot / land clearing', 'jce' ); ?></option>
										<option><?php esc_html_e( 'Not sure — need an assessment', 'jce' ); ?></option>
									</select>
								</div>
							</div>

							<div class="form-field">
								<label for="jce-message"><?php esc_html_e( 'Tell us about the tree', 'jce' ); ?></label>
								<textarea id="jce-message" name="jce-message" placeholder="<?php esc_attr_e( 'How many trees, roughly how big, and anything close by we should know about — house, fence, power line, septic.', 'jce' ); ?>"></textarea>
							</div>

							<button type="submit" class="btn btn--primary btn--lg btn--block">
								<?php esc_html_e( 'Request My Estimate', 'jce' ); ?>
							</button>

							<p class="form-note"><?php esc_html_e( 'We will call to schedule a time to walk the property. No obligation, and we will tell you if the tree does not need to come down.', 'jce' ); ?></p>
						</form>
					</div>
				</div>

			</div>
		</div>
	</section>

	<?php
	get_template_part( 'template-parts/personal-estimate-steps' );
	get_template_part( 'template-parts/credentials' );

endwhile;

get_footer();
