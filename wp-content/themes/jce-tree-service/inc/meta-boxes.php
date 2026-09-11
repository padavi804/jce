<?php
/**
 * Admin fields for the custom post types and the section-driven page templates.
 *
 * Everything a Service, Location, or About/Service Area page renders below its
 * editor content is a field here — so the whole page is editable in WordPress
 * without touching PHP. Fields that are left empty fall back to example copy
 * in the templates, which is what keeps a half-filled site looking finished.
 *
 * List formats are documented in inc/fields.php: one item per line, parts
 * separated by a pipe.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ---------------------------------------------------------------
 * Registration
 * ------------------------------------------------------------- */
function jce_add_meta_boxes() {
	add_meta_box( 'jce_service_icon', __( 'Tile Icon', 'jce' ), 'jce_render_service_icon_box', 'service', 'side' );
	add_meta_box( 'jce_service_sections', __( 'Service Page Sections', 'jce' ), 'jce_render_service_sections_box', 'service', 'normal', 'high' );

	add_meta_box( 'jce_location_priority', __( 'Location Priority', 'jce' ), 'jce_render_location_priority_box', 'location', 'side' );
	add_meta_box( 'jce_location_photos', __( 'Service Area Page Photos', 'jce' ), 'jce_render_location_photos_box', 'location', 'normal', 'high' );

	add_meta_box( 'jce_testimonial_details', __( 'Review Details', 'jce' ), 'jce_render_testimonial_meta_box', 'testimonial', 'normal', 'high' );

	add_meta_box( 'jce_page_sections', __( 'Page Sections', 'jce' ), 'jce_render_page_sections_box', 'page', 'normal', 'default' );
}
add_action( 'add_meta_boxes', 'jce_add_meta_boxes' );

/**
 * The photo-slots panel (Services) and the single-image picker (Pages) both
 * need the native media picker. Loaded only on the Service and Page edit
 * screens, not every admin page.
 */
function jce_admin_photo_slots_assets( $hook ) {
	if ( 'post.php' !== $hook && 'post-new.php' !== $hook ) {
		return;
	}

	$screen = get_current_screen();
	if ( ! $screen || ! in_array( $screen->post_type, array( 'service', 'page', 'location' ), true ) ) {
		return;
	}

	wp_enqueue_media();
	wp_enqueue_script( 'jce-admin-photo-slots', JCE_THEME_URI . '/assets/js/admin-photo-slots.js', array( 'jquery' ), JCE_THEME_VERSION, true );
}
add_action( 'admin_enqueue_scripts', 'jce_admin_photo_slots_assets' );

/**
 * Shared note explaining the line/pipe format, shown at the top of each box.
 */
function jce_format_note() {
	?>
	<p class="jce-box__intro">
		<?php esc_html_e( 'Each box below is a list: one item per line. Where a format shows a pipe character ( | ), put the short label before it and the sentence after it. Leave a box empty and that section falls back to the example copy currently on the site.', 'jce' ); ?>
	</p>
	<?php
}

/* ---------------------------------------------------------------
 * Service
 * ------------------------------------------------------------- */
function jce_render_service_icon_box( $post ) {
	wp_nonce_field( 'jce_save_service_meta', 'jce_service_meta_nonce' );
	$icon    = get_post_meta( $post->ID, '_jce_service_icon', true );
	$choices = array( 'tree', 'scissors', 'zap', 'leaf', 'search', 'layers', 'wind', 'disc', 'truck', 'shield', 'award', 'clipboard', 'droplet' );
	?>
	<p>
		<label for="jce_service_icon"><?php esc_html_e( 'Icon shown on the service card', 'jce' ); ?></label>
		<select id="jce_service_icon" name="jce_service_icon" class="widefat">
			<option value=""><?php esc_html_e( '— Choose automatically —', 'jce' ); ?></option>
			<?php foreach ( $choices as $choice ) : ?>
				<option value="<?php echo esc_attr( $choice ); ?>" <?php selected( $icon, $choice ); ?>><?php echo esc_html( $choice ); ?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p class="description"><?php esc_html_e( 'Set a Featured Image to replace the card photo, and an Excerpt for the card summary and hero subheading.', 'jce' ); ?></p>
	<?php
}

function jce_render_service_sections_box( $post ) {
	wp_nonce_field( 'jce_save_service_sections', 'jce_service_sections_nonce' );
	jce_format_note();

	echo '<h4 style="margin:0 0 .75em;">' . esc_html__( 'Hero', 'jce' ) . '</h4>';

	jce_field_text(
		'jce_service_eyebrow',
		__( 'Eyebrow', 'jce' ),
		__( 'Small label above the headline, e.g. "Tree Removal Near Me". Blank uses "Tree Care Services".', 'jce' ),
		get_post_meta( $post->ID, '_jce_service_eyebrow', true )
	);

	jce_field_text(
		'jce_service_headline',
		__( 'Page Headline (H1)', 'jce' ),
		__( 'The long-form headline for this page, e.g. "Tree Removal by Local Tree Experts in the St. Croix River Valley". Blank uses the post title. Keep the post title short — it is what appears on cards and in menus.', 'jce' ),
		get_post_meta( $post->ID, '_jce_service_headline', true )
	);

	echo '<hr><h4 style="margin:0 0 .75em;">' . esc_html__( 'Photo Reel (after the body)', 'jce' ) . '</h4>';

	jce_field_textarea(
		'jce_service_reel',
		__( 'Captions', 'jce' ),
		__( 'One caption per line, e.g. "Removing a declining ash — River Falls". Each line gets its own photo below. Leave empty to skip this section — there is no example fallback, since these are meant to be real job photos.', 'jce' ),
		get_post_meta( $post->ID, '_jce_service_reel', true ),
		5
	);

	jce_field_photo_slots(
		'jce_service_reel_images',
		get_post_meta( $post->ID, '_jce_service_reel_images', true ),
		'jce_service_reel'
	);

	echo '<hr><h4 style="margin:0 0 .75em;">' . esc_html__( 'How the job goes', 'jce' ) . '</h4>';

	jce_field_text(
		'jce_service_steps_heading',
		__( 'Process Heading', 'jce' ),
		__( 'e.g. "How the JCE team works with you to get it done." Blank uses "The Personal Estimate".', 'jce' ),
		get_post_meta( $post->ID, '_jce_service_steps_heading', true )
	);

	jce_field_textarea(
		'jce_service_steps',
		__( 'Process Steps', 'jce' ),
		__( 'Format: Step title | One or two sentences. They are numbered automatically. Blank uses the standard three-step Personal Estimate.', 'jce' ),
		get_post_meta( $post->ID, '_jce_service_steps', true ),
		7
	);

	echo '<hr><h4 style="margin:0 0 .75em;">' . esc_html__( 'Proof', 'jce' ) . '</h4>';

	jce_field_textarea(
		'jce_service_proof',
		__( 'Proof Blocks', 'jce' ),
		__( 'Format: Heading | Body paragraph | Customer quote | Who said it | Photo caption. Leave a part empty to skip it, but each block needs a heading plus a body or a quote. For a before/after pair, put two captions separated by //  — e.g. "Before, from the driveway // After, same angle".', 'jce' ),
		get_post_meta( $post->ID, '_jce_service_proof', true ),
		7
	);

	echo '<hr><h4 style="margin:0 0 .75em;">' . esc_html__( 'Kinds of this service', 'jce' ) . '</h4>';

	jce_field_text(
		'jce_service_sub_heading',
		__( 'Heading', 'jce' ),
		__( 'e.g. "Tree Removal Services". Leave the list below empty to skip this whole section.', 'jce' ),
		get_post_meta( $post->ID, '_jce_service_sub_heading', true )
	);

	jce_field_textarea(
		'jce_service_sub_intro',
		__( 'Intro Paragraphs', 'jce' ),
		__( 'One paragraph per line.', 'jce' ),
		get_post_meta( $post->ID, '_jce_service_sub_intro', true ),
		4
	);

	jce_field_textarea(
		'jce_service_subservices',
		__( 'The List', 'jce' ),
		__( 'Format: Title | Description. Each one gets its own photo slot below — until a photo is added, the placeholder is labelled with the title so this doubles as a shot list.', 'jce' ),
		get_post_meta( $post->ID, '_jce_service_subservices', true ),
		8
	);

	jce_field_photo_slots(
		'jce_service_subservices_images',
		get_post_meta( $post->ID, '_jce_service_subservices_images', true ),
		'jce_service_subservices'
	);

	jce_field_text(
		'jce_service_note_intro',
		__( '"Good to Know" Intro', 'jce' ),
		__( 'The sentence above the add-ons and exclusions.', 'jce' ),
		get_post_meta( $post->ID, '_jce_service_note_intro', true )
	);

	jce_field_textarea(
		'jce_service_notes',
		__( '"Good to Know" Points', 'jce' ),
		__( 'Format: Short label | The rest of the sentence. Add-ons, exclusions, and anything that would otherwise be a surprise on the estimate.', 'jce' ),
		get_post_meta( $post->ID, '_jce_service_notes', true ),
		5
	);

	echo '<hr><h4 style="margin:0 0 .75em;">' . esc_html__( 'Standard sections', 'jce' ) . '</h4>';
	echo '<p class="description" style="margin:0 0 1.25em;">'
		. esc_html__( 'These four come with example copy already written. Replace it, or type a single dash ( - ) to switch that section off for this page.', 'jce' )
		. '</p>';

	jce_field_textarea(
		'jce_service_signs',
		__( 'Signs You Need This', 'jce' ),
		__( 'Format: Short label | One sentence. Renders as the checklist beside the photo.', 'jce' ),
		get_post_meta( $post->ID, '_jce_service_signs', true ),
		6
	);

	jce_field_textarea(
		'jce_service_included',
		__( "What's Included", 'jce' ),
		__( 'One item per line, no pipe. Renders as the ticked list of what the price covers.', 'jce' ),
		get_post_meta( $post->ID, '_jce_service_included', true ),
		6
	);

	jce_field_textarea(
		'jce_service_pricing',
		__( 'What Affects the Price', 'jce' ),
		__( 'Format: Factor | One sentence explaining it.', 'jce' ),
		get_post_meta( $post->ID, '_jce_service_pricing', true ),
		5
	);

	jce_field_textarea(
		'jce_service_faq',
		__( 'Frequently Asked Questions', 'jce' ),
		__( 'Format: Question? | Answer. These are also published as FAQ schema for Google.', 'jce' ),
		get_post_meta( $post->ID, '_jce_service_faq', true ),
		6
	);

	jce_field_text(
		'jce_service_cta_title',
		__( 'Closing CTA Headline', 'jce' ),
		__( 'Optional. Overrides the standard green band headline at the foot of this page.', 'jce' ),
		get_post_meta( $post->ID, '_jce_service_cta_title', true )
	);
}

/* ---------------------------------------------------------------
 * Location
 * ------------------------------------------------------------- */
function jce_render_location_priority_box( $post ) {
	wp_nonce_field( 'jce_save_location_meta', 'jce_location_meta_nonce' );
	$priority = get_post_meta( $post->ID, '_jce_location_priority', true );
	if ( ! $priority ) {
		$priority = 'primary';
	}
	?>
	<p>
		<label>
			<input type="radio" name="jce_location_priority" value="primary" <?php checked( $priority, 'primary' ); ?>>
			<?php esc_html_e( 'Primary — gets a photo card', 'jce' ); ?>
		</label><br>
		<label>
			<input type="radio" name="jce_location_priority" value="secondary" <?php checked( $priority, 'secondary' ); ?>>
			<?php esc_html_e( 'Secondary — listed as a linked town', 'jce' ); ?>
		</label>
	</p>
	<p class="description"><?php esc_html_e( 'Primary towns (River Falls, Hudson, Prescott) lead the Service Area page. Secondary towns still get their own page — they just sit in the list below the cards.', 'jce' ); ?></p>
	<?php
}

/**
 * Photo slots for the Service Area page sections.
 *
 * Photos only — the copy on these pages is the approved Service Area text and
 * is the same for every town bar the town name, so there is nothing per-town
 * to type. A section with no photo here simply renders its text full width
 * rather than as a photo split.
 */
function jce_render_location_photos_box( $post ) {
	wp_nonce_field( 'jce_save_location_photos', 'jce_location_photos_nonce' );
	?>
	<p class="jce-box__intro">
		<?php esc_html_e( 'Optional photos for this town\'s page. Each one turns its section into a photo-and-text split, the same way the About Us page works. Leave any of them empty and that section stays full-width text. The Featured Image is separate — that is the hero banner at the top of the page.', 'jce' ); ?>
	</p>
	<?php

	jce_field_image(
		'jce_location_intro_image',
		__( 'Photo Next to the Intro', 'jce' ),
		__( 'Sits beside the "Anyone with a chainsaw…" opening paragraph.', 'jce' ),
		get_post_meta( $post->ID, '_jce_location_intro_image', true )
	);

	jce_field_image(
		'jce_location_standard_image',
		__( 'Photo Next to "The Highest Standard of Tree Care"', 'jce' ),
		__( 'Without a photo this section is centered text.', 'jce' ),
		get_post_meta( $post->ID, '_jce_location_standard_image', true )
	);

	echo '<hr><h4 style="margin:0 0 .75em;">' . esc_html__( 'Property-First Care — before / after pair', 'jce' ) . '</h4>';
	echo '<p class="description" style="margin:0 0 1.25em;">'
		. esc_html__( 'The creative brief calls for a before/after pair from a job in this town, shot from the same angle. Until both are set, the empty slots show as labelled placeholders so the page doubles as a shot list.', 'jce' )
		. '</p>';

	jce_field_image(
		'jce_location_before_image',
		__( 'Before', 'jce' ),
		__( 'The property before the work started.', 'jce' ),
		get_post_meta( $post->ID, '_jce_location_before_image', true )
	);

	jce_field_image(
		'jce_location_after_image',
		__( 'After', 'jce' ),
		__( 'Same angle, after the job and the cleanup.', 'jce' ),
		get_post_meta( $post->ID, '_jce_location_after_image', true )
	);

	echo '<hr>';

	jce_field_image(
		'jce_location_local_image',
		__( 'Photo Next to "Locally Owned & Operated"', 'jce' ),
		__( 'Leave blank to use the bundled town photo, where one ships with the theme.', 'jce' ),
		get_post_meta( $post->ID, '_jce_location_local_image', true )
	);
}

/**
 * Meta keys behind the Service Area page photo slots.
 */
function jce_location_image_fields() {
	return array(
		'jce_location_intro_image',
		'jce_location_standard_image',
		'jce_location_before_image',
		'jce_location_after_image',
		'jce_location_local_image',
	);
}

/* ---------------------------------------------------------------
 * Testimonial
 * ------------------------------------------------------------- */
function jce_render_testimonial_meta_box( $post ) {
	wp_nonce_field( 'jce_save_testimonial_meta', 'jce_testimonial_meta_nonce' );
	$location = get_post_meta( $post->ID, '_jce_reviewer_location', true );
	$job      = get_post_meta( $post->ID, '_jce_job_type', true );
	$rating   = get_post_meta( $post->ID, '_jce_rating', true );
	if ( ! $rating ) {
		$rating = '5';
	}
	$source  = get_post_meta( $post->ID, '_jce_review_source', true );
	$service = get_post_meta( $post->ID, '_jce_review_service', true );
	?>
	<p>
		<label for="jce_reviewer_location"><?php esc_html_e( 'Town / Street (e.g. "Cedar Street, River Falls")', 'jce' ); ?></label>
		<input type="text" id="jce_reviewer_location" name="jce_reviewer_location" value="<?php echo esc_attr( $location ); ?>" class="widefat">
	</p>
	<p>
		<label for="jce_job_type"><?php esc_html_e( 'Job (e.g. "Large ash removal")', 'jce' ); ?></label>
		<input type="text" id="jce_job_type" name="jce_job_type" value="<?php echo esc_attr( $job ); ?>" class="widefat">
	</p>
	<p>
		<label for="jce_rating"><?php esc_html_e( 'Star Rating', 'jce' ); ?></label>
		<select id="jce_rating" name="jce_rating">
			<?php foreach ( array( 5, 4, 3, 2, 1 ) as $n ) : ?>
				<option value="<?php echo esc_attr( $n ); ?>" <?php selected( $rating, (string) $n ); ?>><?php echo esc_html( $n ); ?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label for="jce_review_source"><?php esc_html_e( 'Source (Google, Facebook, HomeAdvisor...)', 'jce' ); ?></label>
		<input type="text" id="jce_review_source" name="jce_review_source" value="<?php echo esc_attr( $source ); ?>" class="widefat">
	</p>
	<p>
		<label for="jce_review_service"><?php esc_html_e( 'Related Service or Town slug', 'jce' ); ?></label>
		<input type="text" id="jce_review_service" name="jce_review_service" value="<?php echo esc_attr( $service ); ?>" class="widefat">
		<span class="description"><?php esc_html_e( 'Optional. e.g. "tree-removal" or "hudson" — that page will show this review first.', 'jce' ); ?></span>
	</p>
	<?php
}

/* ---------------------------------------------------------------
 * Pages (About Us / Service Area templates)
 * ------------------------------------------------------------- */
function jce_render_page_sections_box( $post ) {
	wp_nonce_field( 'jce_save_page_sections', 'jce_page_sections_nonce' );
	?>
	<p class="jce-box__intro">
		<?php esc_html_e( 'These fields are used by the "Services", "About Us", and "Service Area" page templates (Page Attributes > Template). On any other template they are ignored. One item per line; the pipe character separates the short label from the sentence.', 'jce' ); ?>
	</p>
	<?php

	echo '<h4 style="margin:0 0 .75em;">' . esc_html__( 'Hero', 'jce' ) . '</h4>';

	jce_field_text(
		'jce_page_headline',
		__( 'Page Headline (H1)', 'jce' ),
		__( 'The long-form headline shown as this page\'s H1, e.g. "Tree Removal by Local Tree Experts in the St. Croix River Valley". Blank uses the Title field above. Keep the Title field short — it is what appears in the browser tab, search results, and menus.', 'jce' ),
		get_post_meta( $post->ID, '_jce_page_headline', true )
	);

	jce_field_text(
		'jce_page_subheading',
		__( 'Sub Heading', 'jce' ),
		__( 'One line under the H1. Left blank, no sub heading prints — it never falls back to example copy.', 'jce' ),
		get_post_meta( $post->ID, '_jce_page_subheading', true )
	);

	jce_field_range(
		'jce_page_hero_focus',
		__( 'Hero Image Focus', 'jce' ),
		__( 'The Featured Image is cropped to fill the hero banner. If it\'s cutting off the wrong part (a head, a sign), nudge the crop here instead of re-editing the photo. 1 = top of the photo, 5 = center (default), 10 = bottom.', 'jce' ),
		get_post_meta( $post->ID, '_jce_page_hero_focus', true )
	);

	echo '<hr><h4 style="margin:0 0 .75em;">' . esc_html__( 'Our Story Photo (About Us)', 'jce' ) . '</h4>';

	jce_field_image(
		'jce_page_story_image',
		__( 'Photo Next to "Our Story"', 'jce' ),
		__( 'Separate from the Featured Image, which is the hero banner only. Leave blank to use the bundled crew photo.', 'jce' ),
		get_post_meta( $post->ID, '_jce_page_story_image', true )
	);

	echo '<hr>';

	jce_field_textarea(
		'jce_page_highlights',
		__( 'Highlight Cards', 'jce' ),
		__( 'Format: Title | One sentence. About Us renders these as the "what we stand for" cards; Service Area and Services use them as the coverage / "how we decide" promises.', 'jce' ),
		get_post_meta( $post->ID, '_jce_page_highlights', true ),
		6
	);

	jce_field_textarea(
		'jce_page_milestones',
		__( 'Timeline (About Us)', 'jce' ),
		__( 'Format: Year | Title | One sentence.', 'jce' ),
		get_post_meta( $post->ID, '_jce_page_milestones', true ),
		7
	);

	jce_field_textarea(
		'jce_page_faq',
		__( 'Frequently Asked Questions', 'jce' ),
		__( 'Format: Question? | Answer. Also published as FAQ schema.', 'jce' ),
		get_post_meta( $post->ID, '_jce_page_faq', true ),
		6
	);

	jce_field_textarea(
		'jce_page_standard',
		__( 'Our Standard (About Us)', 'jce' ),
		__( 'The "Why We Still Do It the Same Way" section. One paragraph per line.', 'jce' ),
		get_post_meta( $post->ID, '_jce_page_standard', true ),
		4
	);

	jce_field_image(
		'jce_page_standard_image',
		__( 'Photo Next to "Why We Still Do It the Same Way"', 'jce' ),
		__( 'Leave blank to use the bundled arborist-on-site photo.', 'jce' ),
		get_post_meta( $post->ID, '_jce_page_standard_image', true )
	);

	jce_field_textarea(
		'jce_page_yard',
		__( 'Yard Care (About Us)', 'jce' ),
		__( 'The "We Treat Your Yard Like It\'s Ours" section. One paragraph per line.', 'jce' ),
		get_post_meta( $post->ID, '_jce_page_yard', true ),
		3
	);

	jce_field_image(
		'jce_page_yard_image',
		__( 'Photo Next to "We Treat Your Yard Like It\'s Ours"', 'jce' ),
		__( 'Leave blank to use the bundled crew/equipment photo.', 'jce' ),
		get_post_meta( $post->ID, '_jce_page_yard_image', true )
	);

	jce_field_textarea(
		'jce_page_local',
		__( 'Local Roots (About Us)', 'jce' ),
		__( 'The "We\'re Proud to Be Located in River Falls" section. One paragraph per line.', 'jce' ),
		get_post_meta( $post->ID, '_jce_page_local', true ),
		4
	);

	jce_field_image(
		'jce_page_local_image',
		__( 'Photo Next to "We\'re Proud to Be Located in River Falls"', 'jce' ),
		__( 'Leave blank to use the bundled River Falls photo.', 'jce' ),
		get_post_meta( $post->ID, '_jce_page_local_image', true )
	);
}

/* ---------------------------------------------------------------
 * Save
 * ------------------------------------------------------------- */

/**
 * Meta keys saved as multi-line lists, grouped by the nonce that guards them.
 */
function jce_line_field_map() {
	return array(
		'jce_service_sections'  => array(
			'nonce'  => 'jce_service_sections_nonce',
			'fields' => array(
				'jce_service_signs',
				'jce_service_included',
				'jce_service_pricing',
				'jce_service_faq',
				'jce_service_steps',
				'jce_service_proof',
				'jce_service_sub_intro',
				'jce_service_subservices',
				'jce_service_notes',
				'jce_service_reel',
			),
			'text'   => array(
				'jce_service_cta_title',
				'jce_service_eyebrow',
				'jce_service_headline',
				'jce_service_steps_heading',
				'jce_service_sub_heading',
				'jce_service_note_intro',
			),
		),
		'jce_page_sections'     => array(
			'nonce'  => 'jce_page_sections_nonce',
			'fields' => array( 'jce_page_highlights', 'jce_page_milestones', 'jce_page_faq', 'jce_page_standard', 'jce_page_yard', 'jce_page_local' ),
			'text'   => array( 'jce_page_headline', 'jce_page_subheading' ),
		),
	);
}

function jce_save_meta_boxes( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['jce_service_meta_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['jce_service_meta_nonce'] ) ), 'jce_save_service_meta' ) ) {
		if ( isset( $_POST['jce_service_icon'] ) ) {
			update_post_meta( $post_id, '_jce_service_icon', sanitize_html_class( wp_unslash( $_POST['jce_service_icon'] ) ) );
		}
	}

	if ( isset( $_POST['jce_location_meta_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['jce_location_meta_nonce'] ) ), 'jce_save_location_meta' ) ) {
		if ( isset( $_POST['jce_location_priority'] ) ) {
			update_post_meta( $post_id, '_jce_location_priority', sanitize_key( wp_unslash( $_POST['jce_location_priority'] ) ) );
		}
	}

	if ( isset( $_POST['jce_location_photos_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['jce_location_photos_nonce'] ) ), 'jce_save_location_photos' ) ) {
		foreach ( jce_location_image_fields() as $field ) {
			if ( isset( $_POST[ $field ] ) ) {
				update_post_meta( $post_id, '_' . $field, absint( $_POST[ $field ] ) );
			}
		}
	}

	if ( isset( $_POST['jce_testimonial_meta_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['jce_testimonial_meta_nonce'] ) ), 'jce_save_testimonial_meta' ) ) {
		foreach ( array( 'jce_reviewer_location', 'jce_job_type', 'jce_review_source', 'jce_review_service' ) as $field ) {
			if ( isset( $_POST[ $field ] ) ) {
				update_post_meta( $post_id, '_' . $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
			}
		}
		if ( isset( $_POST['jce_rating'] ) ) {
			update_post_meta( $post_id, '_jce_rating', absint( $_POST['jce_rating'] ) );
		}
	}

	// Multi-line section fields. Newlines are structural here, so each line is
	// sanitized individually rather than the whole blob at once.
	foreach ( jce_line_field_map() as $action => $group ) {
		if ( ! isset( $_POST[ $group['nonce'] ] ) ) {
			continue;
		}
		if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ $group['nonce'] ] ) ), 'jce_save_' . str_replace( 'jce_', '', $action ) ) ) {
			continue;
		}

		foreach ( $group['fields'] as $field ) {
			if ( isset( $_POST[ $field ] ) ) {
				update_post_meta( $post_id, '_' . $field, jce_sanitize_lines( $_POST[ $field ] ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput -- sanitized line by line.
			}
		}

		foreach ( $group['text'] as $field ) {
			if ( isset( $_POST[ $field ] ) ) {
				update_post_meta( $post_id, '_' . $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
			}
		}

		// The photo slots panels ride along with their companion textarea
		// under the same nonce, but their value is a comma-separated ID
		// list, not lines of text.
		if ( 'jce_service_sections' === $action ) {
			if ( isset( $_POST['jce_service_subservices_images'] ) ) {
				update_post_meta( $post_id, '_jce_service_subservices_images', jce_sanitize_id_list( $_POST['jce_service_subservices_images'] ) );
			}
			if ( isset( $_POST['jce_service_reel_images'] ) ) {
				update_post_meta( $post_id, '_jce_service_reel_images', jce_sanitize_id_list( $_POST['jce_service_reel_images'] ) );
			}
		}

		// Same idea on the Page Sections box: single attachment IDs and a
		// number, not lines of text.
		if ( 'jce_page_sections' === $action ) {
			foreach ( array( 'jce_page_story_image', 'jce_page_standard_image', 'jce_page_yard_image', 'jce_page_local_image' ) as $image_field ) {
				if ( isset( $_POST[ $image_field ] ) ) {
					update_post_meta( $post_id, '_' . $image_field, absint( $_POST[ $image_field ] ) );
				}
			}
			if ( isset( $_POST['jce_page_hero_focus'] ) ) {
				$focus = absint( $_POST['jce_page_hero_focus'] );
				$focus = max( 1, min( 10, $focus ? $focus : 5 ) );
				update_post_meta( $post_id, '_jce_page_hero_focus', $focus );
			}
		}
	}
}
add_action( 'save_post', 'jce_save_meta_boxes' );
